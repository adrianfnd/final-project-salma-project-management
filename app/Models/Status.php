<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = [
        'status_name',
        'description',
    ];

    public function projects()
    {
        return $this->hasMany(Project::class, 'status_id');
    }
}
