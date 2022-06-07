<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RequestLog extends Model
{
    use HasFactory;

    protected $table = 'fr_request_log';
    public $timestamps = false;
    protected $fillable = [
        'name', 'cp_id', 'package_code', 'created_date', 'created_time', 'status', 'trans_id', 'msisdn', 'rbt', 'xt', 'msg', 'result', 'refg_date', 'resp_time', 'req_data', 'req_url', 'resp_date', 'state_scan', 'status_check_before'
    ];
}
