<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_details', function (Blueprint $table) {
            $table->id();
            $table->string('referral_code')->nullable();
            $table->string('principal_id')->nullable();

            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('suffix')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('mobile_no')->nullable();
            $table->string('email_address')->nullable();
            $table->string('place_of_birth')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('age')->nullable();
            $table->string('height')->nullable();
            $table->string('weight')->nullable();
            $table->string('citizenship')->nullable();
            $table->string('gender')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('employment_status')->nullable();
            $table->string('employer_business_name')->nullable();
            $table->string('nature_of_business')->nullable();
            $table->string('business_address')->nullable();
            $table->string('type_of_account')->nullable();
            $table->string('type_of_program')->nullable();
            $table->boolean('dental')->default(false);
            $table->string('membership_type')->nullable();
            $table->string('philhealth_no')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_philhealth_no')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('cellphone_number')->nullable();
            $table->string('name_beneficial_owner')->nullable();
            $table->string('name_beneficiary')->nullable();
            $table->string('nationality')->nullable();
            $table->string('proof_id')->nullable();
            $table->string('source_fund')->nullable();
            $table->string('tin')->nullable();
            $table->string('sss_gsis')->nullable();
            $table->boolean('isSaveByUser')->default(false);

            $table->string('endorse_to')->nullable();
            $table->string('status')->nullable();
            $table->string('statusUser')->default('MEMBERSHIP NOT COMPLETED');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('member_details');
    }
}
