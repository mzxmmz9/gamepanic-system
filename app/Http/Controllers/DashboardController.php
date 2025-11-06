<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Review;
use App\Models\Answer;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
	public function index()
	{
		$user = Auth::user();

		$latestPosts = Post::latest()->limit(5)->get();

		$storeStats = [
			'answers'	=> Answer::where('store_id', $user->store_id)->count(),
			'bookmarks'	=> Bookmark::where('store_id', $user->store_id)->count(),
		];

		return view('dashboard', compact('latestPosts', 'storeStats'));
	}
}
