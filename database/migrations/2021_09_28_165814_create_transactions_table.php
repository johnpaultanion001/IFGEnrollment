<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('beneficiary_id');
            $table->float('send_amount', 8, 2);
            $table->float('receive_amount', 8, 2);
            $table->float('service_charge', 8, 2);
            $table->float('total', 8, 2);
            $table->string('reference_number');
            $table->string('transaction_payment_mode');
            $table->string('transaction_purpose_of_remit');
            $table->string('transaction_source_of_fund');
            $table->integer('isConfirm')->default(0);
            $table->integer('status')->default(0);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
