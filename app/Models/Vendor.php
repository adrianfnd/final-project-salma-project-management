<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'contact_person',
        'phone',
        'email',
        'address',
    ];

    public function suratJalan()
    {
        return $this->hasMany(SuratJalan::class);
    }

    public function riwayatSuratJalan()
    {
        return $this->hasMany(RiwayatSuratJalan::class);
    }
}