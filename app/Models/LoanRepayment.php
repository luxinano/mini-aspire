<?php

namespace App\Models;

class LoanRepayment extends BaseModel
{
    protected $table = 'loan_repayment';

    protected $primaryKey = 'loan_repayment_id';

    protected $fillable = [
        'repayment_date'
    ];

    protected $guarded = [
        'loan_application_id',
        'weekly_amount',
        'week_term'
    ];

    public function setRepaymentDateAttribute($value)
    {
        $this->attributes['repayment_date'] = $value ?? now()->format('Y-m-d');
    }

    public function loanApplication()
    {
        return $this->belongsTo(LoanApplication::class, 'loan_application_id', 'loan_application_id');
    }
}
