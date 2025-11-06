<?php

// InitController.php
namespace App\Http\Controllers;

class InitController extends Controller
{
	public function __invoke()
	{
		return auth()->check()
			? redirect()->route('dashboard')
			: view('auth.login');
	}
}
