<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class CleanupTempImages extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'app:cleanup-temp-images';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Command description';

	/**
	 * Execute the console command.
	 */

	public function handle()
	{
		$files = Storage::disk('public')->files('temp-images/');
		Log::debug('取得したファイル一覧:', $files);

		foreach ($files as $file) {
			try {
				$timestamp = Storage::disk('public')->lastModified($file);

				if ($timestamp === false) {
					Log::warning("lastModified が取得できませんでした: {$file}");
					continue;
				}

				$lastModified = Carbon::createFromTimestamp($timestamp)->setTimezone('Asia/Tokyo');
				$now = Carbon::now('Asia/Tokyo');
				$age = $lastModified->diffInMinutes($now);

				if ($age > 60) {
					if (Storage::disk('public')->exists($file)) {
						Storage::disk('public')->delete($file);
						Log::info("古い一時画像を削除しました: {$file}");
					} else {
						Log::warning("削除対象のファイルが存在しません: {$file}");
					}
				}
			} catch (\Exception $e) {
				Log::error("ファイル削除中にエラーが発生しました: {$file} | エラー: " . $e->getMessage());
			}
		}
		Log::debug("対象ファイルのフルパス: " . Storage::disk('public')->path($file));
		Log::debug("ファイル: {$file} | 最終更新: {$lastModified->toDateTimeString()} | 経過分: {$age}");
		Log::info('cleanup:temp-images コマンドが正常に完了しました');

		Log::debug("Carbon::now(): " . $now->toDateTimeString());
		Log::debug("lastModified: " . $lastModified->toDateTimeString());
		Log::debug("経過分: " . $age);
	}
	
}
