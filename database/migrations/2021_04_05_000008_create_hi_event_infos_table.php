<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHiEventInfosTable extends Migration
{
    public function up()
    {
        Schema::create('hi_event_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('overview')->nullable();
            $table->longText('rules')->nullable();
            $table->longText('price')->nullable();
            $table->longText('location')->nullable();
            $table->longText('contact')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
