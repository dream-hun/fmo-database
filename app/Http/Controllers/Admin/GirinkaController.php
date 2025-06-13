<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreGirinkaRequest;
use App\Http\Requests\Admin\UpdateGirinkaRequest;
use App\Models\Girinka;
use App\Models\Traits\CsvImport;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class GirinkaController extends Controller
{
    use CsvImport;

    public function index()
    {
        abort_if(Gate::denies('girinka_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $girinkas = Girinka::all();

        return view('admin.girinkas.index', compact('girinkas'));
    }

    public function create()
    {
        abort_if(Gate::denies('girinka_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.girinkas.create');
    }

    public function store(StoreGirinkaRequest $request)
    {
        $girinka = Girinka::create($request->all());

        return redirect()->route('admin.girinkas.index');
    }

    public function edit(Girinka $girinka)
    {
        abort_if(Gate::denies('girinka_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.girinkas.edit', compact('girinka'));
    }

    public function update(UpdateGirinkaRequest $request, Girinka $girinka)
    {
        $girinka->update($request->all());

        return redirect()->route('admin.girinkas.index');
    }

    public function destroy(Girinka $girinka)
    {
        abort_if(Gate::denies('girinka_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $girinka->delete();

        return back();
    }
}
