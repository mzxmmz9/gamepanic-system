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
        if (!Schema::hasTable('machines')) {
            Schema::create('machines', function (Blueprint $table) {
                $table->string('code')->primary();
                $table->string('name');
                $table->string('serial')->nullable();
                $table->string('system_id')->nullable();
                $table->decimal('price', 10, 2)->nullable();
                $table->string('area')->nullable();
                $table->text('note')->nullable();
            });
        }
        if (!Schema::hasTable('machine_downtimes')) {
            Schema::create('machine_downtimes', function (Blueprint $table) {
                $table->string('machine_code');
                $table->timestamp('downtime_start');
                $table->timestamp('downtime_end')->nullable();
                $table->string('reason')->nullable();
                $table->timestamps();

                $table->foreign('machine_code')->references('code')->on('machines');
            });
        }
        if (!Schema::hasTable('statuses')) {
            Schema::create('statuses', function (Blueprint $table) {
                $table->id();
                $table->string('name');
            });
        }
        if (!Schema::hasTable('machine_statuses')) {
            Schema::create('machine_statuses', function (Blueprint $table) {
                $table->string('machine_code');
                $table->foreignId('status_id')->constrained('status');
                $table->timestamps();

                $table->foreign('machine_code')->references('code')->on('machines');
            });
        }
        if (!Schema::hasTable('categories')) {
            Schema::create('categories', function (Blueprint $table) {
                $table->id();
                $table->string('name');
            });
        }
        if (!Schema::hasTable('machine_categories')) {
            Schema::create('machine_categories', function (Blueprint $table) {
                $table->string('machine_code');
                $table->foreignId('category_id')->constrained('categories');
                $table->timestamps();

                $table->foreign('machine_code')->references('code')->on('machines');
            });
        }
        if (!Schema::hasTable('companies')) {
            Schema::create('companies', function (Blueprint $table) {
                $table->id();
                $table->string('name');
            });
        }
        if (!Schema::hasTable('machine_ownerships')) {
            Schema::create('machine_ownerships', function (Blueprint $table) {
                $table->string('machine_code');
                $table->foreignId('company_id')->constrained('companies');
                $table->timestamps();

                $table->foreign('machine_code')->references('code')->on('machines');
            });
        }
        if (!Schema::hasTable('machine_locations')) {
            Schema::create('machine_locations', function (Blueprint $table) {
                $table->string('machine_code');
                $table->string('location');
                $table->timestamps();
                
                $table->foreign('machine_code')->references('code')->on('machines');
            });
        }
        if (!Schema::hasTable('machine_branches')) {
            Schema::create('machine_branches', function (Blueprint $table) {
                $table->string('machine_code');
                $table->foreignId('branch_id')->constrained('branches');

                $table->foreign('machine_code')->references('code')->on('machines');
            });
        }
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('machines');
        Schema::dropIfExists('machine_downtimes');
        Schema::dropIfExists('statuses');
        Schema::dropIfExists('machine_status');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('machine_categories');
        Schema::dropIfExists('companies');
        Schema::dropIfExists('machine_ownerships');
        Schema::dropIfExists('machine_locations');
        Schema::dropIfExists('machine_branches');
    }
};
