<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nisn',30)->unique()->nullable();
            $table->string('nip',30)->unique()->nullable();
            $table->string('phone',13)->unique()->nullable();
            $table->string('email')->unique();
            $table->string('name',150);
            $table->string('place_birth')->nullable();
            $table->date('date_birth')->nullable();
            $table->string('religion')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('address')->nullable();
            $table->string('photo')->nullable();
            $table->integer('class_id')->default(0);
            $table->enum('gender',['l','p'])->nullable();
            $table->enum('role',['a','g','s'])->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
