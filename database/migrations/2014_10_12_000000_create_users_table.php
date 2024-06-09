<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->date("birth_date");
            $table->tinyInteger('type')->default(0); //Users: 0=>Student, 1=>Admin, 2=> Lecturer
            $table->text('description')->nullable();
            $table->tinyInteger('approved')->default(0)->nullable();
            $table->string('lecturer_cv')->nullable(); //Lecturer Only
            $table->text('lecturer_description')->nullable();//Lecturer Only
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
};
