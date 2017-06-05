<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('professions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('companyId')->references('id')->on('companies')->index();
            $table->integer('user_id')->references('id')->on('users')->index();
            $table->string('name');
            $table->string('branch')->nullable();
            $table->integer('salaryHigh');
            $table->integer('salaryLow');
            $table->string('city')->index();
            $table->tinyInteger('workYear')->default(0);
            $table->tinyInteger('edu')->default(0);
            $table->tinyInteger('nature')->default(0);
            $table->string('welfare');
            $table->text('desc');
            $table->string('address');
            $table->string('email');
            $table->integer('category_id')->references('id')->on('categories');
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
        Schema::drop('professions');
    }
}
