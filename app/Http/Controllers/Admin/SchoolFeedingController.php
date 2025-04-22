<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySchoolFeedingRequest;
use App\Http\Requests\StoreSchoolFeedingRequest;
use App\Http\Requests\UpdateSchoolFeedingRequest;
use App\Models\Project;
use App\Models\SchoolFeeding;
use Gate;
use Symfony\Component\HttpFoundation\Response;

final class SchoolFeedingController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('school_feeding_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schoolFeedings = SchoolFeeding::with(['project'])->get();

        return view('admin.schoolFeedings.index', compact('schoolFeedings'));
    }

    public function create()
    {
        abort_if(Gate::denies('school_feeding_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.schoolFeedings.create', compact('projects'));
    }

    public function store(StoreSchoolFeedingRequest $request)
    {
        $schoolFeeding = SchoolFeeding::create($request->all());

        return redirect()->route('admin.school-feedings.index');
    }

    public function edit(SchoolFeeding $schoolFeeding)
    {
        abort_if(Gate::denies('school_feeding_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $projects = Project::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $schoolFeeding->load('project');

        return view('admin.schoolFeedings.edit', compact('projects', 'schoolFeeding'));
    }

    public function update(UpdateSchoolFeedingRequest $request, SchoolFeeding $schoolFeeding)
    {
        $schoolFeeding->update($request->all());

        return redirect()->route('admin.school-feedings.index');
    }

    public function show(SchoolFeeding $schoolFeeding)
    {
        abort_if(Gate::denies('school_feeding_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schoolFeeding->load('project');

        return view('admin.schoolFeedings.show', compact('schoolFeeding'));
    }

    public function destroy(SchoolFeeding $schoolFeeding)
    {
        abort_if(Gate::denies('school_feeding_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schoolFeeding->delete();

        return back();
    }

    public function massDestroy(MassDestroySchoolFeedingRequest $request)
    {
        $schoolFeedings = SchoolFeeding::find(request('ids'));

        foreach ($schoolFeedings as $schoolFeeding) {
            $schoolFeeding->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
