<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sends', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_profession_id')->references('id')->on('user_profession');
            $table->string('auditionAddress')->default('');
            $table->string('auditionLinkMan')->default('');
            $table->string('auditionLinkPhone')->default('');
            $table->integer('auditionTime')->default(0);
            $table->tinyInteger('sendType')->default(0);
            $table->tinyInteger('sendSuccessState')->default(0);
            $table->integer('sendSuccessTime')->default(0);
            $table->tinyInteger('viewedState')->default(0);
            $table->integer('viewedTime')->default(0);
            $table->tinyInteger('pendingState')->default(0);
            $table->integer('pendingTime')->default(0);
            $table->tinyInteger('auditionState')->default(0);
            $table->integer('auditionStateTime')->default(0);
            $table->tinyInteger('inappropriateState')->default(0);
            $table->integer('inappropriateStateTime')->default(0);
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
        Schema::drop('sends');
    }
}
