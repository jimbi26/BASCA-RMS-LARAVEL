<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SeniorCitizen extends Model
{
    protected $table = 'senior_citizens';

    protected $fillable = [
        'senior_id',
        'rrn',
        'first_name',
        'middle_name',
        'last_name',
        'birth_date',
        'sex',
        'barangay',
        'contact_number',
        'photo',
        'status',
        'is_deceased',
        'psa',
        'ncsc_form',
        'senior_id_image',
        'purok',
        'age',
        'pension',
        'philhealth_number',
        'dependency',
        'housing',
        'health_problems',
        'disability',
        'medicines',
    ];

    public $timestamps = false;
}