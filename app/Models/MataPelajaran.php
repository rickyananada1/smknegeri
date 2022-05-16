<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MataPelajaran extends Model
{
    protected $table='mata_pelajaran';
    public $timestamps = false;

    public function guru()
    {
        return $this->belongsTo(User::class,'guru_id','id');
    }
}
