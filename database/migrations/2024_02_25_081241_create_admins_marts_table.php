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
        Schema::create('admins_marts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("id_mart");
            $table->unsignedBigInteger("id_admin");
            $table->foreign("id_mart")->references("id")->on("marts")->onDelete("cascade");
            $table->foreign("id_admin")->references("id")->on("admins")->onDelete("cascade");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins_marts');
    }
};
