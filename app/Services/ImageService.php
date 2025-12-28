<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ImageService
{
    protected $manager;

    public function __construct()
    {
        // v3 は Driver クラスを渡す必要がある
        $this->manager = new ImageManager(new Driver());
    }

    public function saveTemp($file)
    {
        $filename = $file->hashName();
        $path = "temp-images/{$filename}";

        $file->storeAs('temp-images', $filename, 'public');

        return $path;
    }

    public function moveToPermanent($tempPath)
    {
        $filename = pathinfo($tempPath, PATHINFO_FILENAME) . '.jpg';
        $newPath = "images/{$filename}";

        // v3 の読み込み
        $img = $this->manager
            ->read(storage_path("app/public/{$tempPath}"))
            ->toJpeg(75);

        // 保存
        Storage::disk('public')->put($newPath, (string) $img);

        // temp 削除
        Storage::disk('public')->delete($tempPath);

        return $newPath;
    }
}