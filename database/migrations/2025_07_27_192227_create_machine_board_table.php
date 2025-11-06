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
        Schema::create('machine_boards', function (Blueprint $table) {
            $table->unsignedBigInteger('machine_code');
            $table->unsignedBigInteger('board_id');
            $table->timestamps();

            $table->foreign('machine_code')->references('code')->on('machines');
            $table->foreign('board_id')->references('id')->on('boards');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_boards');
    }
};
