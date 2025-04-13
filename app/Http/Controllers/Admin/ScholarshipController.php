<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyScholarshipRequest;
use App\Http\Requests\StoreScholarshipRequest;
use App\Http\Requests\UpdateScholarshipRequest;
use App\Models\Scholarship;
use Gate;
use Symfony\Component\HttpFoundation\Response;

class ScholarshipController extends Controller
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

        return view('admin.scholarships.create');
    }

    public function store(StoreScholarshipRequest $request)
    {
        $scholarship = Scholarship::create($request->all());

        return redirect()->route('admin.scholarships.index');
    }

    public function edit(Scholarship $scholarship)
    {
        abort_if(Gate::denies('scholarship_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scholarship->load('project');

        return view('admin.scholarships.edit', compact('scholarship'));
    }

    public function update(UpdateScholarshipRequest $request, Scholarship $scholarship)
    {
        $scholarship->update($request->all());

        return redirect()->route('admin.scholarships.index');
    }

    public function show(Scholarship $scholarship)
    {
        abort_if(Gate::denies('scholarship_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scholarship->load('project');

        return view('admin.scholarships.show', compact('scholarship'));
    }

    public function destroy(Scholarship $scholarship)
    {
        abort_if(Gate::denies('scholarship_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $scholarship->delete();

        return back();
    }

    public function massDestroy(MassDestroyScholarshipRequest $request)
    {
        $scholarships = Scholarship::find(request('ids'));

        foreach ($scholarships as $scholarship) {
            $scholarship->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
