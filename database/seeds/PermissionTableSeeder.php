<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		$data = [
			['name' => 'user.view'],
			['name' => 'user.create'],
			['name' => 'user.update'],
			['name' => 'user.delete'],

			['name' => 'language.view'],
			['name' => 'language.create'],
			['name' => 'language.update'],
			['name' => 'language.delete'],

			['name' => 'role.view'],
			['name' => 'role.create'],
			['name' => 'role.update'],
			['name' => 'role.delete'],

			['name' => 'configuration.view'],
			['name' => 'configuration.create'],
			['name' => 'configuration.update'],

			['name' => 'case_stage.view'],
			['name' => 'case_stage.create'],
			['name' => 'case_stage.update'],
			['name' => 'case_stage.delete'],

			['name' => 'act.view'],
			['name' => 'act.create'],
			['name' => 'act.update'],
			['name' => 'act.delete'],

			['name' => 'court.view'],
			['name' => 'court.create'],
			['name' => 'court.update'],
			['name' => 'court.delete'],

			['name' => 'location.view'],
			['name' => 'location.create'],
			['name' => 'location.update'],
			['name' => 'location.delete'],

			['name' => 'case_category.view'],
			['name' => 'case_category.create'],
			['name' => 'case_category.update'],
			['name' => 'case_category.delete'],

			['name' => 'court_category.view'],
			['name' => 'court_category.create'],
			['name' => 'court_category.update'],
			['name' => 'court_category.delete'],

			['name' => 'client_category.view'],
			['name' => 'client_category.create'],
			['name' => 'client_category.update'],

			['name' => 'case.view'],
			['name' => 'case.create'],
			['name' => 'case.update'],
			['name' => 'case.delete'],

			['name' => 'client.view'],
			['name' => 'client.create'],
			['name' => 'client.update'],
			['name' => 'client.delete'],

			['name' => 'bank.view'],
			['name' => 'bank.create'],
			['name' => 'bank.update'],
			['name' => 'bank.delete'],

			['name' => 'chartAccount.view'],
			['name' => 'chartAccount.create'],
			['name' => 'chartAccount.update'],
			['name' => 'chartAccount.delete'],


			['name' => 'payePayer.view'],
			['name' => 'payePayer.create'],
			['name' => 'payePayer.update'],
			['name' => 'payePayer.delete'],

			['name' => 'income.view'],
			['name' => 'income.create'],
			['name' => 'income.update'],
			['name' => 'income.delete'],

			['name' => 'expense.view'],
			['name' => 'expense.create'],
			['name' => 'expense.update'],
			['name' => 'expense.delete'],

			['name' => 'report.view'],

		];

		$insert_data = [];
		$time_stamp = Carbon::now();
		foreach ($data as $d) {
			$d['guard_name'] = 'web';
			$d['created_at'] = $time_stamp;
			$insert_data[] = $d;
		}
		Permission::insert($insert_data);
	}
}
