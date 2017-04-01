<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('shortName');
            $table->string('tel');
            $table->string('email');
            $table->string('logo');
            $table->string('web');
            $table->string('city')->index();
            $table->tinyInteger('scale')->default(0)->index();
            $table->tinyInteger('stage')->dufault(0)->index();
            $table->text('desc');
            $table->string('oneDesc')->index();
            $table->tinyInteger('state')->default(0);
            $table->string('username');
            $table->integer('tradeId')->references('id')->on('trades')->index();
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
        Schema::drop('companies');
    }
}
