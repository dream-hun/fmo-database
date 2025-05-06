<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ImportRequest;
use App\Http\Requests\MassDestroyGirinkaRequest;
use App\Http\Requests\StoreGirinkaRequest;
use App\Http\Requests\UpdateGirinkaRequest;
use App\Imports\GirinkaImport;
use App\Models\Girinka;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\Response;

final class GirinkaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('girinka_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $girinkas = Girinka::with(['project'])->get();

        return view('admin.girinkas.index', compact('girinkas'));
    }

    public function create()
    {
        abort_if(Gate::denies('girinka_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.girinkas.create', compact('projects'));
    }

    public function store(StoreGirinkaRequest $request)
    {
        $girinka = Girinka::create($request->all());

        return redirect()->route('admin.girinkas.index');
    }

    public function edit(Girinka $girinka)
    {
        abort_if(Gate::denies('girinka_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $girinka->load('project');

        return view('admin.girinkas.edit', compact('girinka', 'projects'));
    }

    public function update(UpdateGirinkaRequest $request, Girinka $girinka)
    {
        $girinka->update($request->all());

        return redirect()->route('admin.girinkas.index');
    }

    public function Import(ImportRequest $request)
    {
        $file = $request->file('file');

        try {
            // Create import object to track statistics
            $import = new GirinkaImport();

            // Import the data
            Excel::import($import, $file);

            // Get import statistics
            $rowsImported = $import->getRowsImported();

            if ($rowsImported > 0) {
                return back()->with('success', "Successfully imported {$rowsImported} girinka records.");
            }

            return back()->with('error', 'No records were imported. Please check your file format and data.');

        } catch (Exception $e) {
            Log::error('Import failed: '.$e->getMessage(), [
                'exception' => $e,
            ]);

            return back()->with('error', 'Import failed: '.$e->getMessage());
        }
    }

    public function destroy(Girinka $girinka)
    {
        abort_if(Gate::denies('girinka_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $girinka->delete();

        return back();
    }

    public function massDestroy(MassDestroyGirinkaRequest $request)
    {
        $girinkas = Girinka::find(request('ids'));

        foreach ($girinkas as $girinka) {
            $girinka->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
