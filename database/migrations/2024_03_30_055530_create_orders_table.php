<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //
        Schema::create('orders', function (Blueprint $table) {
            $table->id();  // creates primary key col with auto increment
            $table->string('product_id');
            $table->integer('user_id');
            $table->string('qty');
            $table->integer('discount');
            $table->integer('amount');
            $table->integer('address');
            $table->string('payment_method',20);
            $table->string('order_status',20);
            $table->string('payment_status',20);
            $table->string('payment_id',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
        Schema::dropIfExists('orders');
    }
};
