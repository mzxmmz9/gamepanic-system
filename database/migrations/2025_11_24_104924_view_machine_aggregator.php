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
		DB::statement("DROP VIEW IF EXISTS view_machine_aggregator");
		DB::statement("
			CREATE VIEW view_machine_aggregator AS
			SELECT
				machine_downtimes.machine_code AS machine_code 
				,machines.name AS machine_name
				,machine_downtimes.downtime_start AS downtime_start
				,machine_downtimes.downtime_end AS downtime_end
				,machine_branches.branch_id AS branch_id
				,branches.name AS branch_name
				,machine_categories.category_id AS category_id
				,categories.name AS category_name
			FROM machine_downtimes
			INNER JOIN machines 
				ON machine_downtimes.machine_code = machines.code
			INNER JOIN machine_branches 
				ON machine_downtimes.machine_code = machine_branches.machine_code
				INNER JOIN branches
					ON machine_branches.branch_id = branches.id
			INNER JOIN machine_categories
				ON machine_downtimes.machine_code = machine_categories.machine_code
				INNER JOIN categories
					ON machine_categories.category_id = categories.id

		");
	}

	public function down()
	{
		DB::statement("DROP VIEW IF EXISTS view_machine_aggregator");
	}

};
