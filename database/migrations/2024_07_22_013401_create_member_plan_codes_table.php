<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberPlanCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_plan_codes', function (Blueprint $table) {
            $table->id();
            $table->string('plm_id')->nullable();
            $table->string('plm_code')->nullable();
            $table->string('plm_room')->nullable();
            $table->string('plm_acct_type')->nullable();
            $table->string('plm_mop')->nullable();
            $table->string('plm_bvat')->nullable();
            $table->string('plm_evat')->nullable();
            $table->string('plm_mem_fee')->nullable();
            $table->string('member_id')->nullable();
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
        Schema::dropIfExists('member_plan_codes');
    }
}
