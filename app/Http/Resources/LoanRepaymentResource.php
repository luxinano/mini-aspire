<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanRepaymentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->loan_repayment_id,
            'weeklyAmount' => number_format($this->weekly_amount, 4),
            'weekTerm' => $this->week_term,
            'repaymentDate' => $this->repayment_date,
            'loanApplication' => LoanApplicationResource::make($this->loanApplication),
        ];
    }
}
