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
            $table->id()->startingValue(1001);
            $table->string('user_id');
            $table->string('country_exchange_id')->nullable();
            $table->string('beneficiary_id');
            $table->float('send_amount');
            $table->float('receive_amount');
            $table->float('service_charge');
            $table->float('total');
            $table->string('reference_number');
            $table->string('transaction_payment_mode');
            $table->string('transaction_purpose_of_remit');
            $table->string('transaction_source_of_fund');
            $table->integer('isConfirm')->default(0);
            $table->integer('status')->default(0);
            $table->boolean('isPaid')->default(false);

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
