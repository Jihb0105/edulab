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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('chapter_no');
            $table->foreignId('course_id')->constrained('courses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('lecture_type_id')->constrained('lecture_types');
            $table->string('title');
            $table->text('overview');
            $table->string('lecture');
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
        Schema::dropIfExists('chapters');
    }
};
