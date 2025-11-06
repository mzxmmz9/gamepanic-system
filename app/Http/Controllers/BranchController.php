<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
	public function index()
	{
		$branches = Branch::orderBy('name')->get(); // 名前順で一覧取得
		return view('branches.index', compact('branches'));
	}

	public function create()
	{
		return view('branches.create');
	}

	public function store(Request $request)
	{
		$request->validate([
			'name' => 'required|string|max:255',
			'code' => 'required|string|max:100',
		]);

		Branch::create($request->all());
		return redirect()->route('branches.index')->with('success', '支店を登録しました');
	}
}