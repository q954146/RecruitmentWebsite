<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateResumesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resumes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('userId')->references('id')->on('users');
            $table->string('name');
            $table->tinyInteger('sex')->default(0);
            $table->tinyInteger('education')->default(0);
            $table->tinyInteger('workYear')->default(0);
            $table->string('phone')->index();
            $table->string('email')->index();
            $table->string('city');
            $table->string('image');
            $table->text('introduction');
            $table->tinyInteger('state')->default(0);
            $table->tinyInteger('deliver')->default(0);
            $table->string('annex');
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
        Schema::drop('resumes');
    }
}
