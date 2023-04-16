<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->integer('weekday');
            $table->time('start_time');
            $table->time('end_time');
//            $table->dateTime('date_of_meeting');
//            $table->dateTime('start_time');
//            $table->dateTime('end_time');
            $table->unsignedBigInteger('room_id');
            $table->integer('number_of_attendees');
            $table->boolean('meeting_status');
            $table->timestamps();

            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
