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
        Schema::create('marts', function (Blueprint $table) {
            $table->id();
            $table->string("mart_name");
            $table->string("mart_logo")->nullable();
            $table->string("mart_country");
            $table->string("mart_email")->unique();
            $table->string("mart_city");
            $table->json("mart_localisation")->nullable();
            $table->bigInteger("mtn_number");
            $table->bigInteger("orange_number");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('marts');
    }
};
