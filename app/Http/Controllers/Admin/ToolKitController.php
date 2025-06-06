<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EditToolKitRequest;
use App\Http\Requests\Admin\StoreToolKitRequest;
use App\Models\Toolkit;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class ToolKitController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('toolkit_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolkits = Toolkit::all();

        return view('admin.toolkits.index', compact('toolkits'));
    }

    public function create()
    {
        abort_if(Gate::denies('toolkit_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolkits.create');
    }

    public function store(StoreToolKitRequest $request)
    {
        $toolKit = Toolkit::create($request->all());

        return to_route('admin.toolkits.index')->with('success', $toolKit->name.' has been created.');
    }

    public function edit(Toolkit $toolKit)
    {
        abort_if(Gate::denies('toolkit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolkits.edit', compact('toolKit'));
    }

    public function update(EditToolKitRequest $request, Toolkit $toolKit)
    {
        $toolKit->update($request->all());

        return to_route('admin.toolkits.index')->with('success', $toolKit->name.'  data has been updated.');
    }

    public function destroy(Toolkit $toolKit)
    {
        abort_if(Gate::denies('toolkit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolKit->delete();

        return to_route('admin.toolkits.index')->with('success', $toolKit->name.' data has been deleted.');
    }
}
