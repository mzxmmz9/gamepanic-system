<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
	public function index()
	{
		$user = Auth::user();

		$latestPosts = Post::latest()->limit(5)->get();

		return view('dashboard', compact('latestPosts'));
	}
}
