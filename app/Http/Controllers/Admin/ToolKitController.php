<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditToolKitRequest;
use App\Http\Requests\Admin\ImportRequest;
use App\Http\Requests\Admin\StoreToolKitRequest;
use App\Imports\ToolkitImport;
use App\Models\Toolkit;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\ValidationException;
use Symfony\Component\HttpFoundation\Response;

final class ToolKitController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('toolkit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolkits = Toolkit::with(['project'])->get();

        return view('admin.toolkits.index', compact('toolkits'));
    }

    public function create()
    {
        abort_if(Gate::denies('toolkit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolkits.create');
    }

    public function store(StoreToolKitRequest $request)
    {
        $toolKit = Toolkit::create($request->all());

        return redirect()->route('admin.toolkits.index')->with('success', 'New toolkit has been created.');
    }

    public function edit(Toolkit $toolKit)
    {
        abort_if(Gate::denies('toolkit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolkits.edit', compact('toolKit'));
    }

    public function update(EditToolKitRequest $request, Toolkit $toolKit)
    {
        $toolKit->update($request->all());

        return redirect()->route('admin.toolkits.index')->with('success', 'Toolkit has been updated.');
    }

    public function destroy(Toolkit $toolKit)
    {
        abort_if(Gate::denies('toolkit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolKit->delete();

        return redirect()->route('admin.toolkits.index')->with('success', 'Toolkit has been deleted.');
    }

    public function importData(ImportRequest $request)
    {
        abort_if(Gate::denies('toolkit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // Enable maximum error reporting during import
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        error_reporting(E_ALL);

        // Log the import attempt
        Log::info('Starting toolkit import', [
            'user_id' => auth()->id(),
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_size' => $request->file('file')->getSize(),
        ]);

        try {
            // Store file temporarily for debugging if needed
            $path = $request->file('file')->store('temp');
            Log::info('Stored import file at: '.$path);

            DB::beginTransaction();

            // Create import object to track statistics
            $import = new ToolkitImport();

            // Import the data - let's catch specific exceptions
            Excel::import($import, $request->file('file'));

            DB::commit();

            // Get import statistics
            $rowsImported = $import->getRowsImported();

            // Log success
            Log::info('Toolkit import completed', [
                'rows_imported' => $rowsImported,
                'errors' => count($import->failures()),
            ]);

            if (count($import->failures()) > 0) {
                $failureCount = count($import->failures());

                return back()->with('warning', "Imported {$rowsImported} records, but {$failureCount} records had validation errors. Check logs for details.");
            }

            if ($rowsImported > 0) {
                return back()->with('success', "Successfully imported {$rowsImported} toolkits records.");
            }

            return back()->with('error', 'No records were imported. Please check your file format and data.');

        } catch (ValidationException $e) {
            DB::rollBack();

            $failures = $e->failures();
            $errorDetails = [];

            // Get detailed validation errors for logging
            foreach (array_slice($failures, 0, 3) as $failure) {
                $errorDetails[] = [
                    'row' => $failure->row(),
                    'attribute' => $failure->attribute(),
                    'errors' => $failure->errors(),
                ];
            }

            Log::error('Import validation failed', [
                'error_count' => count($failures),
                'examples' => $errorDetails,
            ]);

            return back()->with('error', 'Import validation failed: '.count($failures).' rows had errors. Please check data format.');

        } catch (Exception $e) {
            DB::rollBack();

            // Get detailed error information
            $errorInfo = [
                'message' => $e->getMessage(),
                'class' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => array_slice($e->getTrace(), 0, 5), // First 5 elements of trace
            ];

            Log::error('Import exception', $errorInfo);

            // Show simpler error message to user
            return back()->with('error', 'Import failed: '.$e->getMessage());
        }
    }
}
