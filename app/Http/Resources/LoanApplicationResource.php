<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LoanApplicationResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->loan_application_id,
            'amountRequired' => number_format($this->amount_required, 4),
            'loanTerm' => $this->loan_term_by_week,
            'owner' => UserResource::make($this->owner),
            'approved' => $this->when(!$this->approved, $this->approved),
            'approver' => $this->when($this->approved, UserResource::make($this->approver)),
            'approvedDate' => $this->when($this->approved, $this->approved_date)
        ];
    }
}
