<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table='materi_pembeljaran';
    public $timestamps = false;

    public function course()
    {
        return $this->belongsTo(MataPelajaran::class,'course_id','id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class,'class_id','id');
    }
}
