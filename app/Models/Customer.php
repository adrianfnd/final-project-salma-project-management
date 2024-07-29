<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'address',
        'project_id',
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function suratJalan()
    {
        return $this->hasMany(SuratJalan::class);
    }

    public function riwayatSuratJalan()
    {
        return $this->hasMany(RiwayatSuratJalan::class);
    }
}