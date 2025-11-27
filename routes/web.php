<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
	InitController,
	ProfileController,
	DashboardController,
	PostController,
	AnswerController,
	BookmarkController,
	BranchController,
	ReplyController,
	MaintenanceReportController,
	FailureReportController,
	ImageController,
	MachineDowntimeController,
	MachineAggregatorController,
};


// 初期表示
Route::get('/', InitController::class)->name('init');

// ログイン時に閲覧可能
Route::middleware('auth')->group(function () {
	// プロフィール設定
	Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
	Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
	Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

	//ダッシュボード
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	
	// 不具合報告メニュー
	Route::get('/report-selector', function () {
		return view('report_selector');
	})->name('report.selector');

	// 故障発生書作成フォーム
	Route::resource('failure-reports', FailureReportController::class);
	Route::post('/failure-reports/back', function () {
		session()->flashInput(request()->input());
		return redirect()->route('failure-reports.create');
	})->name('failure-reports.back');
	
	// 集計

	// 画像アップロード
	Route::post('/images/temp', [ImageController::class, 'temporaryStore'])->name('images.temp');

	// 投稿・回答管理
	Route::resource('posts', PostController::class);
	Route::post('/answers/{answer}/best', [AnswerController::class, 'markBest'])->name('answers.best');
	Route::post('/answers/confirm', [AnswerController::class, 'confirm'])->name('answers.confirm');
	Route::post('/answers/back', [AnswerController::class, 'back'])->name('answers.back');
	Route::post('/answers/store', [AnswerController::class, 'store'])->name('answers.store');

	// ブックマーク操作
	Route::get('/bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
	Route::post('/bookmarks/toggle/{post}', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');

	// 返信処理
	Route::post('/replies', [ReplyController::class, 'store'])->name('replies.store');

	// 店舗・分類など
	Route::resource('branches', BranchController::class)->only(['create', 'index']);

	Route::get('/failure_reports/create', [FailureReportController::class, 'create'])->name('failure_reports.create');
	// 入力処理（POST）
	Route::post('/failure_reports/submit', [FailureReportController::class, 'submit'])->name('failure_reports.submit');
	// 確認画面（GET）
	Route::get('/failure_reports/confirm', [FailureReportController::class, 'confirm'])->name('failure_reports.confirm');
	// 登録処理（POST）
	Route::post('/failure_reports/store', [FailureReportController::class, 'store'])->name('failure_reports.store');

	// マシン休止情報登録
	Route::resource('machine_downtimes', MachineDowntimeController::class);
	Route::get('machine_downtimes/confirm', [MachineDowntimeController::class, 'confirm'])->name('machine_downtimes.confirm');

	// 休止一覧と損失
	Route::resource('machine_aggregators', MachineAggregatorController::class);
});


// 認証関連
require __DIR__.'/auth.php';
