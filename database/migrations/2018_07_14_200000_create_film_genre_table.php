<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilmGenreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('film_genre', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('film_id')->unsigned()->nullable();
            $table->foreign('film_id')->references('id')->on('films')->onDelete('set null');
            $table->integer('genre_id')->unsigned()->nullable();
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('set null');
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
        Schema::dropIfExists('film_genre');
    }
}
