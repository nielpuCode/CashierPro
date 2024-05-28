<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('placed_order', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('order_history');
            $table->string('order_code', 8);
            $table->foreignId('item_id')->constrained('inventory_items');
            $table->integer('quantity');
            $table->float('item_price');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('placed_order');
    }
};
