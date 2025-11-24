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
		DB::statement("
			CREATE VIEW view_machine_aggregator AS
			SELECT 
			branch.name AS branch
			,machine.code  AS code
			,machine.name AS name
			,downtime.downtime_start
            ,downtime.downtime_end
            ,category.name
            ,status.name
            ,plan.name
			FROM machine_downtimes downtime

            INNER JOIN machines machine
            ON downtime.machine_code = machine.code

			LEFT JOIN (
				SELECT mb.machine_code AS machine_code, b.name AS name
				FROM machine_branches mb
				INNER JOIN branches b
				ON mb.branch_id = b.id
			) branch
			ON downtime.machine_code = branch.machine_code

			LEFT JOIN (
				SELECT mc.machine_code AS machine_code, c.name AS name
				FROM machine_categories mc
				INNER JOIN categories c
				ON mc.category_id = c.id
			) category
			ON downtime.machine_code = category.machine_code

			LEFT JOIN (
				SELECT ms.machine_code AS machine_code, s.name AS name
				FROM machine_statuses ms
				INNER JOIN statuses s
				ON ms.status_id = s.id
			) status
			ON downtime.machine_code = status.machine_code

			LEFT JOIN (
				SELECT mp.machine_code AS machine_code, p.name AS name
				FROM machine_plans mp
				INNER JOIN plans p
				ON mp.plan_id = p.id
			) plan
			ON downtime.machine_code = plan.machine_code

		");
	}

	public function down()
	{
		DB::statement("DROP VIEW IF EXISTS view_machine_aggregator");
	}

};
