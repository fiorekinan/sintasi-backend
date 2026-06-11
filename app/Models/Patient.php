<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $fillable = [
        'medical_record_number',
        'nik',
        'name',
        'email',
        'address',
        'birth_date'
    ];

    public function visits()
    {
        return $this->hasMany(Visit::class);
    }
}