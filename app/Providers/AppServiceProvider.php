<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Enums\Role;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
	protected $policies = [
		\App\Models\Answer::class => \App\Policies\AnswerPolicy::class,
	];
	/**
	 * Register any application services.
	 */
	public function register(): void
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 */
	public function boot()
	{
		// すべての店舗を閲覧できるか？
		Gate::define('view-any-store', function ($user) {
			return in_array($user->role, [Role::Developer->value, Role::Admin->value]);
		});

		// 自分の店舗だけ閲覧できるか？
		Gate::define('view-store', function ($user, $store) {
			return $user->store_id === $store->id || in_array($user->role, [Role::Developer->value, Role::Admin->value]);
		});

		if (DB::getDriverName() === 'sqlite') {
		DB::statement('PRAGMA foreign_keys = OFF');
		}

	}

}
