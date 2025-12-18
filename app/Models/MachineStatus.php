<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MachineStatus extends Model
{
    use HasFactory;
    protected $table = 'machine_statuses';

    // 更新可能なカラムを指定
    protected $fillable = [
        'machine_code',
        'status_id',       
        'created_at',
        'updated_at',
    ];

    // 日付型カラムを Carbon インスタンスにキャスト
    protected $dates = [
        'created_at',
        'updated_at',
    ];
}