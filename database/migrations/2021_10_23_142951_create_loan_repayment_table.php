<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanRepaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_repayment', function (Blueprint $table) {
            $table->id('loan_repayment_id');
            $table->integer('loan_application_id');
            $table->decimal('weekly_amount', 13, 4, true);
            $table->integer('week_term', false, true);
            $table->date('repayment_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loan_repayment');
    }
}
