<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHiEventsTable extends Migration
{
    public function up()
    {
        Schema::create('hi_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('game_type');
            $table->string('game_level')->nullable();
            $table->integer('price')->nullable();
            $table->string('player_type');
            $table->datetime('start_date');
            $table->datetime('finish_date')->nullable();
            $table->string('format')->nullable();
            $table->longText('information')->nullable();
            $table->string('venue')->nullable();
            $table->decimal('fee', 15, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
