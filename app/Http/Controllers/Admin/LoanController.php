<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLoanRequest;
use App\Http\Requests\Admin\UpdateLoanRequest;
use App\Models\Individual;
use App\Models\Loan;
use App\Models\Traits\CsvImport;
use Illuminate\Support\Facades\Gate;
use Symfony\Component\HttpFoundation\Response;

final class LoanController extends Controller
{
    use CsvImport;

    public function index()
    {
        abort_if(Gate::denies('loan_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loans = Loan::with(['individual'])->get();

        return view('admin.loans.index', compact('loans'));
    }

    public function create()
    {
        abort_if(Gate::denies('loan_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $individuals = Individual::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.loans.create', compact('individuals'));
    }

    public function store(StoreLoanRequest $request)
    {
        $loan = Loan::create($request->all());

        return to_route('admin.loans.index')->with('message', $loan->individual->name.' Loan created');
    }

    public function edit(Loan $loan)
    {
        abort_if(Gate::denies('loan_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $individuals = Individual::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $loan->load('individual');

        return view('admin.loans.edit', compact('individuals', 'loan'));
    }

    public function update(UpdateLoanRequest $request, Loan $loan)
    {
        $loan->update($request->all());

        return to_route('admin.loans.index')->with('message', $loan->individual->name.' Loan updated');
    }

    public function show(Loan $loan)
    {
        abort_if(Gate::denies('loan_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loan->load('individual');

        return view('admin.loans.show', compact('loan'));
    }

    public function destroy(Loan $loan)
    {
        abort_if(Gate::denies('loan_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $loan->delete();

        return back();
    }
}
