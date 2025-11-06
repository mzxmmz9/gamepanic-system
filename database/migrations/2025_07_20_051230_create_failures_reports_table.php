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
		Schema::create('failure_reports', function (Blueprint $table) {
			$table->id();
			$table->string('branch_id')->nullable();
			$table->dateTime('occurred_at')->nullable();
			$table->string('occurred_by')->nullable();
			$table->dateTime('resumed_at')->nullable();
			$table->string('resumed_by')->nullable();
			$table->string('machine_code')->nullable();
			$table->string('machine_name')->nullable();
			$table->string('st_num')->nullable();
			$table->string('process')->nullable();
			$table->string('malfunction')->nullable();
			$table->string('note')->nullable();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('failure_reports');
	}
};
