<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGoatRequest;
use App\Http\Requests\StoreGoatRequest;
use App\Http\Requests\UpdateGoatRequest;
use App\Models\Goat;
use App\Models\Project;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class GoatController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('goat_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goats = Goat::with(['project'])->get();

        return view('admin.goats.index', compact('goats'));
    }

    public function create()
    {
        abort_if(Gate::denies('goat_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.goats.create', compact('projects'));
    }

    public function store(StoreGoatRequest $request)
    {
        $goat = Goat::create($request->all());

        return redirect()->route('admin.goats.index');
    }

    public function edit(Goat $goat)
    {
        abort_if(Gate::denies('goat_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $goat->load('project');

        return view('admin.goats.edit', compact('goat', 'projects'));
    }

    public function update(UpdateGoatRequest $request, Goat $goat)
    {
        $goat->update($request->all());

        return redirect()->route('admin.goats.index');
    }

    public function show(Goat $goat)
    {
        abort_if(Gate::denies('goat_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goat->load('project');

        return view('admin.goats.show', compact('goat'));
    }

    public function destroy(Goat $goat)
    {
        abort_if(Gate::denies('goat_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $goat->delete();

        return back();
    }

    public function massDestroy(MassDestroyGoatRequest $request)
    {
        $goats = Goat::find(request('ids'));

        foreach ($goats as $goat) {
            $goat->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
