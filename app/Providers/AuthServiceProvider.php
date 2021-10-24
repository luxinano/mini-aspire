<?php

namespace App\Providers;

use App\Models\LoanApplication;
use App\Models\LoanRepayment;
use App\Policies\LoanApplicationPolicy;
use App\Policies\LoanRepaymentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        LoanApplication::class => LoanApplicationPolicy::class,
        LoanRepaymentPolicy::class => LoanRepayment::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
