<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('vendor_id');
            $table->string('order_id');
            $table->string('name');
            $table->string('phone');
            $table->string('location')->nullable();
            $table->string('address');
            $table->decimal('total_price');
            $table->longText('cart');
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
        Schema::dropIfExists('app_orders');
    }
}
