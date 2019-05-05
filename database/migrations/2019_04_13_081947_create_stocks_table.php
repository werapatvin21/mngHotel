<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            /*$table->bigIncrements('id');
            $table->date('date')->nullable();
            $table->string('reference')->nullable();
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('document no')->nullable();
            $table->string('stock_item_no')->nullable();
            $table->string('supplier')->nullable();
            $table->string('product_code')->nullable();
            $table->string('location')->nullable();
            $table->string('in_qty')->nullable();
            $table->string('in_cost')->nullable();
            $table->string('in_value')->nullable();
            $table->string('out_qty')->nullable();
            $table->string('out_cost')->nullable();
            $table->string('out_value')->nullable();
            $table->string('balance_qty')->nullable();
            $table->string('balance_cost')->nullable();
            $table->string('balance_value')->nullable();
            $table->string('note')->nullable();
            $table->string('file')->nullable();
            $table->string('sign')->nullable();
            */
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
        Schema::dropIfExists('stocks');
    }
}
