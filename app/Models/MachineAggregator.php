<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MachineAggregator extends Model
{
    protected $fillable = [
        'store_name',           // 店舗名
        'total_machines',       // 店舗設置マシン数
        'active_machines',      // 稼働中
        'inactive_machines',    // 休止中
        'failure_count',        // 故障停止件数
        'utilization_rate',     // 稼働率（％）
        'tentative_cases',      // 暫定案件（保留中など）
    ];
}
