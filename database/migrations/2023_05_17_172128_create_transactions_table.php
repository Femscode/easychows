<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('rest_id');
            $table->decimal('amount');
            $table->decimal('before');
            $table->decimal('after');
            $table->string('reference');
            $table->string('type');
            $table->string('title');
            $table->string('details');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('transactions');
    }
}
