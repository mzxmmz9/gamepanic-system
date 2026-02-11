<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('machine_plans', function (Blueprint $table) {
            $table->string('machine_code');
            $table->unsignedBigInteger('plan_id');
            $table->timestamps();

            $table->foreign('machine_code')->references('code')->on('machines');
            $table->foreign('plan_id')->references('id')->on('plans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machine_plans');
    }
};
