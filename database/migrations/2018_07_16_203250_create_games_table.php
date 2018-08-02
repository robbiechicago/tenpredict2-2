<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->increments('id');
            $table->string('season_id');
            $table->integer('week_id');
            $table->integer('game_num');
            $table->string('home_team');
            $table->string('away_team');
            $table->datetime('kickoff_datetime')->nullable();
            $table->integer('inplay_home')->nullable();
            $table->integer('inplay_away')->nullable();
            $table->integer('final_home')->nullable();
            $table->integer('final_away')->nullable();
            $table->integer('active')->default(1);
            $table->integer('created_by');
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('games');
    }
}
