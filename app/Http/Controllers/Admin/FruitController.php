<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreFruitRequest;
use App\Http\Requests\Admin\UpdateFruitRequest;
use App\Models\Fruit;
use App\Models\Traits\CsvImport;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class FruitController extends Controller
{
    use CsvImport;

    public function index()
    {
        abort_if(Gate::denies('fruit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fruits = Fruit::all();

        return view('admin.fruits.index', compact('fruits'));
    }

    public function create()
    {
        abort_if(Gate::denies('fruit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fruits.create');
    }

    public function store(StoreFruitRequest $request)
    {
        $fruit = Fruit::create($request->all());

        return redirect()->route('admin.fruits.index');
    }

    public function edit(Fruit $fruit)
    {
        abort_if(Gate::denies('fruit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.fruits.edit', compact('fruit'));
    }

    public function update(UpdateFruitRequest $request, Fruit $fruit)
    {
        $fruit->update($request->all());

        return redirect()->route('admin.fruits.index');
    }

    public function destroy(Fruit $fruit)
    {
        abort_if(Gate::denies('fruit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $fruit->delete();

        return back();
    }
}
