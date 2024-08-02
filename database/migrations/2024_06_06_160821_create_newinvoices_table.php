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
        Schema::create('newinvoices', function (Blueprint $table) {
            $table->id();
            $table->string("order_code")->nullable();
            $table->json("product_details");
            $table->float("total_price");
            $table->float("total_shipping");
            $table->integer("client_phone");
            $table->string("Payment_mode");
            $table->string("client_email");
            $table->string("client_name");
            $table->string("region");
            $table->string("city");
            $table->string("Mart_name");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newinvoices');
    }
};
