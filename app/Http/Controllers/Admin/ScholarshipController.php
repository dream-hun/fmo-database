<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportRequest;
use App\Http\Requests\Admin\StoreScholarshipRequest;
use App\Http\Requests\Admin\UpdateScholarshipRequest;
use App\Imports\ScholarshipImport;
use App\Models\Project;
use App\Models\Scholarship;
use Exception;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

final class ScholarshipController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('scholarship_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scholarships = Scholarship::with(['project'])->get();

        return view('admin.scholarships.index', compact('scholarships'));
    }

    public function create()
    {
        abort_if(Gate::denies('scholarship_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.scholarships.create', compact('projects'));
    }

    public function store(StoreScholarshipRequest $request)
    {
        $scholarship = Scholarship::create($request->all());

        return redirect()->route('admin.scholarships.index');
    }

    public function edit(Scholarship $scholarship)
    {
        abort_if(Gate::denies('scholarship_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $scholarship->load('project');

        return view('admin.scholarships.edit', compact('projects', 'scholarship'));
    }

    public function update(UpdateScholarshipRequest $request, Scholarship $scholarship)
    {
        $scholarship->update($request->all());

        return redirect()->route('admin.scholarships.index');
    }

    public function import(ImportRequest $request)
    {
        try {
            // Validate that we have a file
            if (! $request->hasFile('file')) {
                return redirect()->route('admin.scholarships.index')
                    ->with('error', 'No file was uploaded');
            }

            $file = $request->file('file');

            // Debug information
            logger()->info('Import file details', [
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
            ]);

            $import = new ScholarshipImport();

            // Use queue for large files
            if ($file->getSize() > 5 * 1024 * 1024) { // 5MB
                Excel::queueImport($import, $file);
                $message = 'Scholarship data import has been queued and will be processed in the background.';
            } else {
                // Import the file directly
                try {
                    Excel::import($import, $file);

                    // Get information about failures
                    $failures = $import->failures();
                    $errors = $import->errors();

                    if ($failures->isNotEmpty() || $errors->isNotEmpty()) {
                        $errorCount = $failures->count() + $errors->count();
                        $message = "Import completed with {$errorCount} errors. Some records may not have been imported.";

                        return redirect()->route('admin.scholarships.index')
                            ->with('warning', $message);
                    }

                    $message = 'Scholarship data imported successfully.';
                } catch (Throwable $importError) {
                    logger()->error('Import error', ['error' => $importError->getMessage()]);

                    return redirect()->route('admin.scholarships.index')
                        ->with('error', 'Error during import: '.$importError->getMessage());
                }
            }

            return redirect()->route('admin.scholarships.index')
                ->with('success', $message);
        } catch (Exception $e) {
            logger()->error('Exception during import', ['error' => $e->getMessage()]);

            return redirect()->route('admin.scholarships.index')
                ->with('error', 'Error importing data: '.$e->getMessage());
        }
    }

    public function destroy(Scholarship $scholarship)
    {
        abort_if(Gate::denies('scholarship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scholarship->delete();

        return back();
    }
}
