<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHiEventInfosTable extends Migration
{
    public function up()
    {
        Schema::table('hi_event_infos', function (Blueprint $table) {
            $table->unsignedBigInteger('event_id');
            $table->foreign('event_id', 'event_fk_3602009')->references('id')->on('hi_events');
        });
    }
}
