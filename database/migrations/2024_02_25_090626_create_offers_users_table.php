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
        Schema::create('offers_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_user");
            $table->unsignedBigInteger("id_Offer");
            $table->boolean("subscription_value");
            $table->foreign("id_user")->references("id")->on("users")->onDelete("cascade");
            $table->foreign("id_offer")->references("id")->on("offers")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers_users');
    }
};
