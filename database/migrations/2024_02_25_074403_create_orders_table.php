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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string("order_code")->unique();
            $table->json("super_cart");
            $table->float("total_weight")->nullable();
            $table->float("total_shipping");
            $table->float("total_price");
            $table->string("client_name");
            $table->bigInteger("client_phone");
            $table->string("payment_mode");
            $table->string("client_email");
            $table->string("order_region")->nullable();
            $table->string("order_city");
            $table->boolean("order_status");
            $table->boolean("client_status");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
