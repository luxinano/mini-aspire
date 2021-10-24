<?php

namespace App\Policies;

use App\Models\LoanApplication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LoanRepaymentPolicy
{
    use HandlesAuthorization;

    public function create(User $user, LoanApplication $loanApplication)
    {
        return $user->user_id === $loanApplication->user_id &&
        $loanApplication->approved &&
        !$this->isFullLocated($loanApplication) ?
            Response::allow() :
            Response::deny(
                'Only loan owner can submit the weekly loan repayments for an approved loan application!',
                403
            );
    }

    private function isFullLocated(LoanApplication $loanApplication)
    {
        return $loanApplication->loanRepayments()->count() === $loanApplication->loan_term_by_week;
    }
}
