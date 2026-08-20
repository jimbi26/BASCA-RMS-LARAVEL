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

    protected function getSupabaseFileUrl($field)
    {
        $value = $this->$field;
        if (!$value) {
            return null;
        }
        $url = rtrim(config('services.supabase.url', ''), '/');
        $bucket = config('services.supabase.bucket', 'senior-documents');
        return $url . '/storage/v1/object/public/' . $bucket . '/' . ltrim($value, '/');
    }

    public function getPhotoUrlAttribute()
    {
        return $this->getSupabaseFileUrl('photo');
    }

    public function getSeniorIdImageUrlAttribute()
    {
        return $this->getSupabaseFileUrl('senior_id_image');
    }

    public function getPsaUrlAttribute()
    {
        return $this->getSupabaseFileUrl('psa');
    }

    public function getNcscFormUrlAttribute()
    {
        return $this->getSupabaseFileUrl('ncsc_form');
    }
}