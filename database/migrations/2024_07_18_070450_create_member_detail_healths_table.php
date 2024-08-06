<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemberDetailHealthsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_detail_healths', function (Blueprint $table) {
            $table->id();
            
            $table->string('member_id')->nullable();
            $table->boolean('previos_healthcare_company')->default(false);
            $table->string('free_previos_healthcare_company')->nullable();
            $table->boolean('hospitalized_previous_healthcare')->default(false);
            $table->string('free_hospitalized_previous_healthcare')->nullable();
            $table->boolean('rejected_previous_healthcare')->default(false);
            $table->string('free_rejected_previous_healthcare')->nullable();
            $table->boolean('drink_alcohol')->default(false);
            $table->string('pick_drink_alcohol')->nullable();
            $table->string('free_drink_alcohol')->nullable();
            $table->boolean('smoke_cigarettes')->default(false);
            $table->string('free_smoke_cigarettes')->nullable();
            $table->string('quit_smoke_cigarettes')->nullable();
            $table->string('physical_exam_history')->nullable();
            $table->string('free_physical_exam_history')->nullable();
           
            $table->boolean('advised_surgery')->default(false);
            $table->string('free_advised_surgery')->nullable();
            $table->string('times_visited_physician')->nullable();
            $table->boolean('alcoholism')->default(false);
            $table->boolean('heart_attack')->default(false);
            $table->boolean('anemia')->default(false);
            $table->boolean('heart_murmur')->default(false);
            $table->boolean('arthritis')->default(false);
            $table->boolean('hypertension')->default(false);
            $table->boolean('astma')->default(false);
            $table->boolean('hernia')->default(false);
            $table->boolean('chronic')->default(false);
            $table->boolean('immune_deficiency')->default(false);
            $table->boolean('back_injury')->default(false);
            $table->boolean('stomach')->default(false);
            $table->boolean('disability')->default(false);
            $table->boolean('venereal')->default(false);
            $table->boolean('cancer')->default(false);
            $table->boolean('peptic_sysptoms')->default(false);
            $table->boolean('convulsions')->default(false);
            $table->boolean('kidney_condition')->default(false);
            $table->boolean('diabetes')->default(false);
            $table->boolean('urination')->default(false);
            $table->boolean('diarrhea')->default(false);
            $table->boolean('prostate')->default(false);
            $table->boolean('ear_problems')->default(false);
            $table->boolean('liver_conditions')->default(false);
            $table->boolean('etitis_media')->default(false);
            $table->boolean('paralysis')->default(false);
            $table->boolean('eye_condition')->default(false);
            $table->boolean('serious_skin')->default(false);
            $table->boolean('glaucoma')->default(false);
            $table->boolean('organ_abnormality')->default(false);
            $table->boolean('gall_bladder')->default(false);
            $table->boolean('irregular_vaginal')->default(false);
            $table->boolean('goiter')->default(false);
            $table->boolean('mental')->default(false);
            $table->boolean('fever')->default(false);
            $table->boolean('drug_addiction')->default(false);
            $table->boolean('allergy_injection')->default(false);
            $table->boolean('migraine_headache')->default(false);
            $table->boolean('treated_condition')->default(false);
            $table->string('free_treated_condition')->nullable();
            $table->boolean('undiagnosed_sysmtoms')->default(false);
            $table->string('free_undiagnosed_sysmtoms')->nullable();
            $table->boolean('taking_medications')->default(false);
            $table->string('free_taking_medications')->nullable();
            $table->boolean('condition_present')->default(false);
            $table->string('free_condition_present')->nullable();
            $table->boolean('hazard_sports')->default(false);
            $table->string('free_hazard_sports')->nullable();
            $table->string('name_physician')->nullable();
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
        Schema::dropIfExists('member_detail_healths');
    }
}
