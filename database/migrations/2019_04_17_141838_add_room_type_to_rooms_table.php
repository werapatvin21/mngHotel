<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRoomTypeToRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rooms', function (Blueprint $table) {
            $table->integer('room_type')->nullable();
            $table->integer('room_special_price')->nullable();
            $table->integer('room_season_price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rooms', function (Blueprint $table) {
            //
        });
    }
}
