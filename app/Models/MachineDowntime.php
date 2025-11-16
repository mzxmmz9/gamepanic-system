<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class MachineDowntime extends Model
{
    protected $fillable = [
        'machine_code'
        ,'downtime_start'
        ,'downtime_end'
        ,'reason'
        ,'created_at'
        ,'updated_at'
    ];
}
