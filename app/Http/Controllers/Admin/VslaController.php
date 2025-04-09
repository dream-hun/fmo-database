<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVslaRequest;
use App\Http\Requests\StoreVslaRequest;
use App\Http\Requests\UpdateVslaRequest;
use App\Models\Project;
use App\Models\Vsla;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

class VslaController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('vsla_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vslas = Vsla::with(['project'])->get();

        return view('admin.vslas.index', compact('vslas'));
    }

    public function create()
    {
        abort_if(Gate::denies('vsla_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.vslas.create', compact('projects'));
    }

    public function store(StoreVslaRequest $request)
    {
        $vsla = Vsla::create($request->all());

        return redirect()->route('admin.vslas.index');
    }

    public function edit(Vsla $vsla)
    {
        abort_if(Gate::denies('vsla_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $vsla->load('project');

        return view('admin.vslas.edit', compact('projects', 'vsla'));
    }

    public function update(UpdateVslaRequest $request, Vsla $vsla)
    {
        $vsla->update($request->all());

        return redirect()->route('admin.vslas.index');
    }

    public function show(Vsla $vsla)
    {
        abort_if(Gate::denies('vsla_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vsla->load('project');

        return view('admin.vslas.show', compact('vsla'));
    }

    public function destroy(Vsla $vsla)
    {
        abort_if(Gate::denies('vsla_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $vsla->delete();

        return back();
    }

    public function massDestroy(MassDestroyVslaRequest $request)
    {
        $vslas = Vsla::find(request('ids'));

        foreach ($vslas as $vsla) {
            $vsla->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
