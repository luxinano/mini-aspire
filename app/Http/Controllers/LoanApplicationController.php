<?php

namespace App\Http\Controllers;

use App\Http\Requests\ApproveLoanApplicationRequest;
use App\Http\Requests\StoreLoanApplicationRequest;
use App\Http\Resources\LoanApplicationCollection;
use App\Http\Resources\LoanApplicationResource;
use App\Models\LoanApplication;
use Illuminate\Support\Facades\Auth;

class LoanApplicationController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', LoanApplication::class);
        return new LoanApplicationCollection(LoanApplication::all());
    }

    public function store(StoreLoanApplicationRequest $request)
    {
        $this->authorize('create', LoanApplication::class);

        $validatedInputs = $request->safe(['amount_required', 'loan_term_by_week']);
        $loanApplication = new LoanApplication($validatedInputs);
        $loanApplication->user_id = Auth::user()->user_id;
        $loanApplication->save();

        return new LoanApplicationResource($loanApplication);
    }

    public function show(LoanApplication $loanApplication)
    {
        $this->authorize('view', $loanApplication);
        return new LoanApplicationResource($loanApplication);
    }

    public function update(ApproveLoanApplicationRequest $request, LoanApplication $loanApplication)
    {
        $this->authorize('update', $loanApplication);

        $validatedInputs = $request->safe(['approved_date']);
        $loanApplication->fill(empty($validatedInputs) ? ['approved_date' => null] : $validatedInputs);
        $loanApplication->approver_id = Auth::user()->user_id;
        $loanApplication->save();

        return new LoanApplicationResource($loanApplication);

    }
}
