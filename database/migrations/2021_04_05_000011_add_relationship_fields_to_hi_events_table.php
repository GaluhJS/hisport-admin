<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHiEventsTable extends Migration
{
    public function up()
    {
        Schema::table('hi_events', function (Blueprint $table) {
            $table->unsignedBigInteger('game_id');
            $table->foreign('game_id', 'game_fk_3601991')->references('id')->on('hi_games');
        });
    }
}
