<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTemplateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cv_id')->unsigned()->index();
            $table->foreign('cv_id')->references('id')->on('cvs')
                ->onDelete('cascade');
            $table->boolean('show')->nullable();
            $table->text('template')->nullable();
            $table->text('css')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('user_templates');
    }
}
