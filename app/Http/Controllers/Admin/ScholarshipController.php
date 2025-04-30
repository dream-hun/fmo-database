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
use Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

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
        $scholarship = Scholarship::create($request->validated());

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
        $scholarship->update($request->validated());

        return redirect()->route('admin.scholarships.index');
    }

    public function Import(ImportRequest $request)
    {
        $file = $request->file('file');

        try {
            // Create import object to track statistics
            $import = new ScholarshipImport();

            // Import the data
            Excel::import($import, $file);

            // Get import statistics
            $rowsImported = $import->getRowsImported();

            if ($rowsImported > 0) {
                return back()->with('success', "Successfully imported {$rowsImported} scholarship records.");
            }

            return back()->with('error', 'No records were imported. Please check your file format and data.');

        } catch (Exception $e) {
            Log::error('Import failed: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return back()->with('error', 'Import failed: '.$e->getMessage());
        }
    }

    public function destroy(Scholarship $scholarship)
    {
        abort_if(Gate::denies('scholarship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scholarship->delete();

        return back();
    }
}
