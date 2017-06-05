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
            $table->integer('user_id')->references('id')->on('users');
            $table->string('name')->default('');
            $table->tinyInteger('sex')->default(0);
            $table->tinyInteger('education')->default(0);
            $table->tinyInteger('workYear')->default(0);
            $table->string('phone')->index()->default('');
            $table->string('email')->index()->default('');
            $table->string('image')->default('');
            $table->text('introduction')->default('');
            $table->tinyInteger('state')->default(0);
            $table->tinyInteger('deliver')->default(0);
            $table->string('annex')->default('');
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
