<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTrainingRequest;
use App\Http\Requests\Admin\UpdateTrainingRequest;
use App\Models\Training;
use App\Models\Traits\CsvImportTrait;
use Gate;
use Symfony\Component\HttpFoundation\Response;

final class TrainingController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('training_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $trainings = Training::all();

        return view('admin.trainings.index', compact('trainings'));
    }

    public function create()
    {
        abort_if(Gate::denies('training_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trainings.create');
    }

    public function store(StoreTrainingRequest $request)
    {
        $training = Training::create($request->all());

        return redirect()->route('admin.trainings.index');
    }

    public function edit(Training $training)
    {
        abort_if(Gate::denies('training_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.trainings.edit', compact('training'));
    }

    public function update(UpdateTrainingRequest $request, Training $training)
    {
        $training->update($request->all());

        return redirect()->route('admin.trainings.index');
    }

    public function destroy(Training $training)
    {
        abort_if(Gate::denies('training_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $training->delete();

        return back();
    }
}
