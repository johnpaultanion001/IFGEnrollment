<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            
            //Tell Us About You
                //Personal Info
            $table->string('email')->unique();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('occupation')->nullable();
            $table->string('id_type')->nullable();
            $table->string('id_number')->nullable();
            $table->string('id_issued_country')->nullable();
            $table->date('id_issue_date')->nullable();
            $table->date('id_expiry_date')->nullable();
            $table->string('gender')->nullable();
            $table->string('source_of_fund')->nullable();
            $table->string('id_card_front')->nullable();
            $table->string('id_card_back')->nullable();
            $table->string('nationality')->nullable();
            //Contact Info
            $table->string('country')->nullable();
            $table->longtext('address')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('telephone')->nullable();
            $table->boolean('terms_and_conditions')->default(false);
            $table->boolean('isRegistered')->default(false);

            $table->datetime('email_verified_at')->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
            $table->timestamps();

            $table->softDeletes();
        });
    }
}
