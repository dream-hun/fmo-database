<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSchoolFeedingRequest;
use App\Http\Requests\Admin\UpdateSchoolFeedingRequest;
use App\Models\SchoolFeeding;
use App\Models\Traits\CsvImport;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class SchoolFeedingController extends Controller
{
    use CsvImport;

    public function index()
    {
        abort_if(Gate::denies('school_feeding_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schoolFeedings = SchoolFeeding::all();

        return view('admin.schoolFeedings.index', compact('schoolFeedings'));
    }

    public function create()
    {
        abort_if(Gate::denies('school_feeding_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.schoolFeedings.create');
    }

    public function store(StoreSchoolFeedingRequest $request)
    {
        $schoolFeeding = SchoolFeeding::create($request->all());

        return redirect()->route('admin.school-feedings.index');
    }

    public function edit(SchoolFeeding $schoolFeeding)
    {
        abort_if(Gate::denies('school_feeding_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.schoolFeedings.edit', compact('schoolFeeding'));
    }

    public function update(UpdateSchoolFeedingRequest $request, SchoolFeeding $schoolFeeding)
    {
        $schoolFeeding->update($request->all());

        return redirect()->route('admin.school-feedings.index');
    }

    public function destroy(SchoolFeeding $schoolFeeding)
    {
        abort_if(Gate::denies('school_feeding_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schoolFeeding->delete();

        return back();
    }
}
