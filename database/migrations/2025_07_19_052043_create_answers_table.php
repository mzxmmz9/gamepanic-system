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
		if (!Schema::hasTable('answers')) {
			Schema::create('answers', function (Blueprint $table) {
				// テーブル定義
				$table->id();
				$table->foreignId('user_id')->constrained()->onDelete('cascade');
				$table->foreignId('post_id')->constrained()->onDelete('cascade');
				$table->text('comment');
				$table->boolean('is_best')->default(false);
				$table->timestamps();
			});
		}
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('answers');
	}
};
