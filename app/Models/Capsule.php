<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Capsule extends Model
{
    protected $table = 'tbl_01';
    protected $primaryKey = 'id';
    protected $fillable  = ['capsule_serial', 'capsule_id', 'status', 'original_launch', 'original_launch_unix', 'missions', 'landings', 'type', 'details', 'reuse_count'];
    protected $hidden = ['id', 'created_at', 'updated_at'];
    protected $casts = [
        'missions' => 'array'
    ];

    //SCOPES
    public function scopeOfStatus($query, $status)
    {
        return $query->where('status', $status);
    }
}
