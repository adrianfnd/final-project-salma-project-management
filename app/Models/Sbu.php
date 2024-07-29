<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sbu extends Model
{
    use HasFactory;

    protected $fillable = [
        'sbu_name',
        'location',
        'latitude',
        'longitude',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'sbu_id');
    }
}

