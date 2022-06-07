<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\RequestLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function __construct()
    {

    }

    public function welcome()
    {
        return view('welcome');
    }

    public function index($cp_code)
    {
        $parseUrl = '/tt/' . $cp_code;
        $url = Partner::query()->where('url', '=', $parseUrl)->where('status', '=', 1)->first();
        $data = compact('url');
        return view('index', $data);
    }

    public function logRequest(Request $request) {
        $data = $request->except('_token');
        $msisdn = $_SERVER['HTTP_MSISDN'];
        $transId = microtime(true) * 10000 .'0';

        $log = RequestLog::query()->create([
            'msisdn' => $msisdn,
            'created_date' => date('Y-m-d'),
            'created_time' => date('Y-m-d H:i:s'),
            'package_code' => $data['pkg'],
            'trans_id' => $transId,
            'cp_id' => $data['cp'],
            'status' => 0,
        ]);
        $urlRedirect = "http://support.funring.vn/support/funringonline/confirmsub_v1.jsp?id=601816&pkg=". $data['pkg']."&transid=" .$transId. "&mmisdn=";
        if ($log) {
            return response()->json([
                'url' => $urlRedirect
            ]);
        }

        return response()->json([
            'url' => '/404'
        ]);
    }

    public function backLog(Request $request)
    {
        $transId = $request->get('req_id');
        $rsCode = $request->get('rs_code');
        $msisdn = $request->get('isdn');
        
        $log = RequestLog::query()->where([
            ['trans_id', '=', $transId],
            ['msisdn', '=', $msisdn]
        ])->update([
            'result' => $rsCode[0]
        ]);

        if ($rsCode[0]) {
            return Redirect::away('http://funring.vn');
        }

        return Redirect::route('welcome');
    }
}
