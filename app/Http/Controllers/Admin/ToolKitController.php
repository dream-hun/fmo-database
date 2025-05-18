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

        $file = $request->file('file');

        try {
            // Create import object to track statistics
            $import = new ToolkitImport();

            // Import the data
            Excel::import($import, $file);

            // Get import statistics
            $rowsImported = $import->getRowsImported();
            $failures = $import->getFailures();

            if (count($failures) > 0) {
                $failureCount = count($failures);

                return back()->with('warning', "Imported {$rowsImported} records, but {$failureCount} records had validation errors. Check logs for details.");
            }

            if ($rowsImported > 0) {
                return back()->with('success', "Successfully imported {$rowsImported} toolkits records.");
            }

            return back()->with('error', 'No records were imported. Please check your file format and data.');

        } catch (ValidationException $e) {
            $failures = $e->failures();
            Log::error('Import validation failed: '.count($failures).' rows had errors', [
                'first_few_errors' => array_slice($failures, 0, 5),
            ]);

            return back()->with('error', 'Import validation failed: '.count($failures).' rows had errors. Check the server logs for details.');
        } catch (Exception $e) {
            Log::error('Import failed: '.$e->getMessage(), [
                'exception' => get_class($e),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);

            return back()->with('error', 'Import failed: '.$e->getMessage());
        }
    }
}
