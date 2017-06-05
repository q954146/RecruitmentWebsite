<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHopeProfessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hope_professions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('resume_id')->references('id')->on('resumes');
            $table->string('city');
            $table->tinyInteger('nature')->default(0);
            $table->string('profession');
            $table->tinyInteger('salary')->default(0);
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
        Schema::drop('hope_professions');
    }
}
