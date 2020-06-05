<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePapersStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('papers_students', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id')->unsigned();
            $table->integer('paper_id')->unsigned();
            $table->integer('status_id')->unsigned();
            $table->string('score', 100);
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
        Schema::dropIfExists('papers_students');
    }
}
