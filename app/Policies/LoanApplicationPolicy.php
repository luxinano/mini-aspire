<?php

namespace App\Policies;

use App\Models\LoanApplication;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class LoanApplicationPolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user)
    {
        return $user->approver ?
            Response::allow() :
            Response::deny('Only approver can view other loan application!', 403);
    }

    public function view(User $user, LoanApplication $loanApplication)
    {
        return $user->approver || $user->user_id === $loanApplication->user_id ?
            Response::allow() : Response::deny('Only owner or approver can view this loan application!', 403);
    }

    public function create(User $user)
    {
        return !$user->approver ?
            Response::allow() :
            Response::deny('An approver can not create loan application!', 403);
    }

    public function update(User $user, LoanApplication $loanApplication)
    {
        return $user->approver && !$loanApplication->approved ?
            Response::allow() :
            Response::deny('Only approver can update unapproved loan application!', 403);
    }
}
