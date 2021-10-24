<?php

namespace App\Models;


class LoanApplication extends BaseModel
{
    protected $table = 'loan_application';

    protected $primaryKey = 'loan_application_id';

    protected $attributes = [
        'approver_id' => null,
        'approved_date' => null,
    ];

    protected $fillable = [
        'amount_required',
        'loan_term_by_week',
        'approved_date'
    ];

    protected $guarded = [
        'user_id',
        'approver_id'
    ];

    public function getApprovedAttribute()
    {
        return $this->attributes['approver_id'] && $this->attributes['approved_date'];
    }

    public function getNextWeekTermNoAttribute()
    {
        return $this->loanRepayments()->count() + 1;
    }

    public function getWeeklyAmountAttribute()
    {
        return round($this->amount_required / $this->loan_term_by_week, 4);
    }

    public function setApprovedDateAttribute($value)
    {
        $this->attributes['approved_date'] = $value ?? now()->format('Y-m-d');
    }

    public function scopeApproved($query)
    {
        $query->whereNotNull('approver_id')->whereNotNull('approved_date');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'user_id');
    }

    public function loanRepayments()
    {
        return $this->hasMany(LoanRepayment::class, 'loan_application_id', 'loan_application_id');
    }
}
