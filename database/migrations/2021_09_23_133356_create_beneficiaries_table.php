<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBeneficiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beneficiaries', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('receipt_country')->nullable();
            $table->string('payment_mode')->nullable();
            //Payout Location
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            //Beneficiary Details
            $table->string('beneficiary_firstname')->nullable();
            $table->string('beneficiary_middlename')->nullable();
            $table->string('beneficiary_lastname')->nullable();
            $table->string('mobile_number')->nullable();
            //Address Details
            $table->string('address')->nullable();
            $table->string('purpose_of_remit')->nullable();
            $table->string('relation_with_beneficiary')->nullable();


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
        Schema::dropIfExists('beneficiaries');
    }
}
