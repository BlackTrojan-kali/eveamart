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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->string("offer_name");
            $table->integer("offer_value");
            $table->string("offer_sequence");
            $table->unsignedBigInteger("id_product");
            $table->unsignedBigInteger("id_mart");
            $table->foreign("id_mart")->references("id")->on("marts")->onDelete("cascade");
            $table->foreign("id_product")->references("id")->on("products")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
