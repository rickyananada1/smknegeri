<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMateriPembelajaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('materi_pembelajaran', function (Blueprint $table) {
            $table->id();
            $table->integer('course_id');
            $table->integer('class_id');
            $table->string('judul');
            $table->string('deskripsi');
            $table->string('berkas_materi');
            $table->timestamp('start_at');
            $table->timestamp('end_at');
            $table->timestamp('batas_submitan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('materi_pembelajaran');
    }
}
