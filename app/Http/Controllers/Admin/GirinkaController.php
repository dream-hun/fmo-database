<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGirinkaRequest;
use App\Http\Requests\StoreGirinkaRequest;
use App\Http\Requests\UpdateGirinkaRequest;
use App\Models\Girinka;
use App\Models\Project;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class GirinkaController extends Controller
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

    public function show(Girinka $girinka)
    {
        abort_if(Gate::denies('girinka_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $girinka->load('project');

        return view('admin.girinkas.show', compact('girinka'));
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
