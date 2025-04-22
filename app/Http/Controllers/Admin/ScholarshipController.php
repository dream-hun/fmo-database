<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreScholarshipRequest;
use App\Http\Requests\Admin\UpdateScholarshipRequest;
use App\Models\Project;
use App\Models\Scholarship;
use Illuminate\Support\Facades\Gate;
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

    public function destroy(Scholarship $scholarship)
    {
        abort_if(Gate::denies('scholarship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scholarship->delete();

        return back();
    }
}
