<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCvheadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cv_headers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cv_id')->unsigned()->index();
            $table->foreign('cv_id')->references('id')->on('cvs')
                ->onDelete('cascade');
            $table->string('name');
            $table->string('value');
            $table->integer('created_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('cv_headers');
    }
}
