<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('room_id')->nullable();
            $table->integer('id_guest')->nullable();
            $table->integer('no_guest')->nullable();
            $table->timestamp('check_in')->nullable();
            $table->integer('total_night')->nullable();
            $table->decimal('price',8,2)->nullable();
            $table->decimal('total_price',8,2)->nullable();
            $table->string('promotion_code')->nullable();
            $table->string('special_request')->nullable();
            $table->integer('remark_by')->nullable();
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
        Schema::dropIfExists('reservations');
    }
}
