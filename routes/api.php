<?php

use App\Http\Controllers\LoanApplicationController;
use App\Http\Controllers\LoanRepaymentController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('loan-application', LoanApplicationController::class)->except(['destroy']);
    Route::post('/loan-application/{loanApplication}/loan-repayment', [LoanRepaymentController::class, 'store']);
});
