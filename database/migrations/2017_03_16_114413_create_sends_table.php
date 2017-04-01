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
            $table->integer('userId')->references('id')->on('users');
            $table->integer('professionId')->references('id')->on('professions');
            $table->string('auditionAddress');
            $table->string('auditionLinkMan');
            $table->string('auditionLinkPhone');
            $table->string('auditionTime');
            $table->tinyInteger('sendType')->default(0);
            $table->tinyInteger('sendState')->default(0);
            $table->timestamp('sendStateTime');
            $table->tinyInteger('pendingState')->default(0);
            $table->timestamp('pendingStateTime');
            $table->tinyInteger('auditionState')->default(0);
            $table->timestamp('auditionStateTime');
            $table->tinyInteger('inappropriateState')->default(0);
            $table->timestamp('inappropriateStateTime');
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
