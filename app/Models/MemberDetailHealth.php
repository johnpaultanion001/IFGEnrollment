<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberDetailHealth extends Model
{
    use HasFactory;
    protected $connection = 'sqlsrv';
    public $table = 'member_detail_healths';

    protected $fillable = [
        'member_id',
        'previos_healthcare_company',
        'free_previos_healthcare_company',
        'hospitalized_previous_healthcare',
        'free_hospitalized_previous_healthcare',
        'rejected_previous_healthcare',
        'free_rejected_previous_healthcare',
        'drink_alcohol',
        'pick_drink_alcohol',
        'free_drink_alcohol',
        'smoke_cigarettes',
        'free_smoke_cigarettes',
        'quit_smoke_cigarettes',
        'physical_exam_history',
        'free_physical_exam_history',
        'advised_surgery',
        'free_advised_surgery',
        'times_visited_physician',

        'alcoholism',
        'heart_attack',
        'anemia',
        'heart_murmur',
        'arthritis',
        'hypertension',
        'astma',
        'hernia',
        'chronic',
        'immune_deficiency',
        'back_injury',
        'stomach',
        'disability',
        'venereal',
        'cancer',
        'peptic_sysptoms',
        'convulsions',
        'kidney_condition',
        'diabetes',
        'urination',
        'diarrhea',
        'prostate',
        'ear_problems',
        'liver_conditions',
        'etitis_media',
        'paralysis',
        'eye_condition',
        'serious_skin',
        'glaucoma',
        'organ_abnormality',
        'gall_bladder',
        'irregular_vaginal',
        'goiter',
        'mental',
        'fever',
        'drug_addiction',
        'migraine_headache',
        'treated_condition',
        'free_treated_condition',
        'undiagnosed_sysmtoms',
        'free_undiagnosed_sysmtoms',
        'taking_medications',
        'free_taking_medications',
        'condition_present',
        'free_condition_present',
        'hazard_sports',
        'free_hazard_sports',
        'name_physician',

        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function member()
    {
        return $this->belongsTo(MemberDetail::class, 'member_id');
    }
}
