<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLoanRepaymentRequest;
use App\Http\Resources\LoanRepaymentResource;
use App\Models\LoanApplication;
use App\Models\LoanRepayment;

class LoanRepaymentController extends Controller
{
    public function store(StoreLoanRepaymentRequest $request, LoanApplication $loanApplication)
    {
        $this->authorize('create', [LoanRepayment::class, $loanApplication]);
        $validatedInputs = $request->safe(['repayment_date']);

        $loanRepayment = new LoanRepayment(empty($validatedInputs) ? ['repayment_date' => null] : $validatedInputs);
        $loanRepayment->loan_application_id = $loanApplication->loan_application_id;
        $loanRepayment->week_term = $loanApplication->next_week_term_no;
        $loanRepayment->weekly_amount = $loanApplication->weekly_amount;
        $loanRepayment->save();

        return new LoanRepaymentResource($loanRepayment);
    }
}
