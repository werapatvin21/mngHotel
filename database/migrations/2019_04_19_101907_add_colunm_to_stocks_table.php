<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColunmToStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->string('list_name')->nullable();
            $table->string('product_name')->nullable();
            $table->string('number_report')->nullable();
            $table->integer('type')->nullable();
            $table->string('status')->nullable();
            $table->integer('by')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn(['list_name','product_name','number_report','type','by']);
        });
    }
}
