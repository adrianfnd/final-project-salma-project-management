<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_id',
        'project_name',
        'olt_hostname',
        'no_sp2k_spa',
        'sbu_id',
        'ip_olt',
        'kendala',
        'progress',
        'status_id',
        'start_date',
        'target',
        'end_date',
        'latitude',
        'longitude',
        'radius',
        'link_file',
        'images',
        'is_active',
        'technician_id',
        'created_by',
        'updated_by',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id');
    }

    public function sbu()
    {
        return $this->belongsTo(Sbu::class, 'sbu_id');
    }

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function suratjalans()
    {
        return $this->hasMany(SuratJalan::class, 'project_id');
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }
}