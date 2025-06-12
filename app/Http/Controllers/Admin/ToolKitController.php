<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreToolkitRequest;
use App\Http\Requests\Admin\UpdateToolKitRequest;
use App\Models\Toolkit;
use App\Models\Traits\CsvImport;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class ToolKitController extends Controller
{
    use CsvImport;

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

    public function store(StoreToolkitRequest $request)
    {
        $toolkit = Toolkit::create($request->all());

        return redirect()->route('admin.toolkits.index');
    }

    public function edit(Toolkit $toolkit)
    {
        abort_if(Gate::denies('toolkit_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolkits.edit', compact('toolkit'));
    }

    public function update(UpdateToolKitRequest $request, Toolkit $toolkit)
    {
        $toolkit->update($request->all());

        return redirect()->route('admin.toolkits.index');
    }

    public function show(Toolkit $toolkit)
    {
        abort_if(Gate::denies('toolkit_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.toolkits.show', compact('toolkit'));
    }

    public function destroy(Toolkit $toolkit)
    {
        abort_if(Gate::denies('toolkit_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $toolkit->delete();

        return back();
    }
}
