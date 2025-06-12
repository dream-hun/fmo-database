<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreZamukaRequest;
use App\Http\Requests\Admin\UpdateZamukaRequest;
use App\Models\Traits\CsvImport;
use App\Models\Zamuka;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class ZamukaController extends Controller
{
    use CsvImport;

    public function index()
    {
        abort_if(Gate::denies('zamuka_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zamukas = Zamuka::all();

        return view('admin.zamukas.index', compact('zamukas'));
    }

    public function create()
    {
        abort_if(Gate::denies('zamuka_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zamukas.create');
    }

    public function store(StoreZamukaRequest $request)
    {
        $zamuka = Zamuka::create($request->all());

        return redirect()->route('admin.zamukas.index');
    }

    public function edit(Zamuka $zamuka)
    {
        abort_if(Gate::denies('zamuka_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zamukas.edit', compact('zamuka'));
    }

    public function update(UpdateZamukaRequest $request, Zamuka $zamuka)
    {
        $zamuka->update($request->all());

        return redirect()->route('admin.zamukas.index');
    }

    public function show(Zamuka $zamuka)
    {
        abort_if(Gate::denies('zamuka_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.zamukas.show', compact('zamuka'));
    }

    public function destroy(Zamuka $zamuka)
    {
        abort_if(Gate::denies('zamuka_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $zamuka->delete();

        return back();
    }
}
