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
			CREATE VIEW view_machines AS
			SELECT 
			branch.name AS branch
			,machine.code  AS code
			,machine.name AS name
			,board.name AS board
			,category.name AS category
			,location.location AS location
			,status.name AS status
			,machine.serial AS serial
			,machine.system_id AS system_id
			,plan.name AS plan
			,machine.price AS price
			,machine.area AS area
			,owner.name AS ownership
			,machine.note AS note
			FROM machines machine

			LEFT JOIN (
				SELECT mb.machine_code AS machine_code, b.name AS name
				FROM machine_branches mb
				INNER JOIN branches b
				ON mb.branch_id = b.id
			) branch
			ON machine.code = branch.machine_code

			LEFT JOIN (
				SELECT mb.machine_code AS machine_code, b.name AS name
				FROM machine_boards mb
				INNER JOIN boards b
				ON mb.board_id = b.id
			) board
			ON machine.code = board.machine_code

			LEFT JOIN (
				SELECT mc.machine_code AS machine_code, c.name AS name
				FROM machine_categories mc
				INNER JOIN categories c
				ON mc.category_id = c.id
			) category
			ON machine.code = category.machine_code

			LEFT JOIN machine_locations location
			ON machine.code = location.machine_code

			LEFT JOIN (
				SELECT ms.machine_code AS machine_code, s.name AS name
				FROM machine_statuses ms
				INNER JOIN statuses s
				ON ms.status_id = s.id
			) status
			ON machine.code = status.machine_code

			LEFT JOIN (
				SELECT mp.machine_code AS machine_code, p.name AS name
				FROM machine_plans mp
				INNER JOIN plans p
				ON mp.plan_id = p.id
			) plan
			ON machine.code = plan.machine_code

			LEFT JOIN (
				SELECT mo.machine_code AS machine_code, o.name AS name
				FROM machine_ownerships mo
				INNER JOIN companies o
				ON mo.company_id = o.id
			) owner
			ON machine.code = owner.machine_code
		");
	}

	public function down()
	{
		DB::statement("DROP VIEW IF EXISTS view_machines");
	}

};
