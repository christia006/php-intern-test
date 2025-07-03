<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'nomor',
        'nama',
        'jabatan',
        'talahir',
        'photo_upload_path',
        'created_on',
        'updated_on',
        'created_by',
        'updated_by',
        'deleted_on',
    ];

    protected $casts = [
        'talahir' => 'date',
        'created_on' => 'datetime',
        'updated_on' => 'datetime',
    ];

    public function setCreatedOnAttribute($value)
    {
        $this->attributes['created_on'] = $value ?? Carbon::now();
    }

    public function setUpdatedOnAttribute($value)
    {
        $this->attributes['updated_on'] = $value ?? Carbon::now();
    }
}
