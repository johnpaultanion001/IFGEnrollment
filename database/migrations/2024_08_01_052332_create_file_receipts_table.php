<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFileReceiptsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_receipts', function (Blueprint $table) {
            $table->id();
            $table->string('file')->nullable();
            $table->string('member_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('reference_number')->nullable();
            $table->string('status')->default('PAYMENT REVIEW');
            $table->string('amount_paid')->nullable();

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
        Schema::dropIfExists('file_receipts');
    }
}