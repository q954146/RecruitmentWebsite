<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanyTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_tag', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('companyId')->references('id')->on('companies');
            $table->integer('tegId')->references('id')->on('tags');
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
        Schema::table('company_tag', function (Blueprint $table) {
            //
        });
    }
}
