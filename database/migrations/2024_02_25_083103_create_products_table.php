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
        Schema::create('products', function (Blueprint $table) {
            $table->id();  
            $table->string("product_name");
            $table->string("product_image");
            $table->float("product_price");
            $table->text("product_description")->nullable();
            $table->float("product_weight")->nullable();
            $table->integer("product_outcomes")->nullable();
            $table->string("product_type")->nullable();
            $table->bigInteger("qty_in_stock");
            $table->integer("promo_on_product");
            $table->unsignedBigInteger("id_category");
            $table->unsignedBigInteger("id_mart");

            $table->foreign("id_category")->references("id")->on("categories")->onDelete("cascade");
            $table->foreign("id_mart")->references("id")->on("marts")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
