<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\RequestLog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function index($cp_code)
    {
        $options = [
            'query' => [
                'code' => $cp_code
            ]
        ];
        $response = $this->client->request('GET', 'http://localhost:5556/v1/fun/get_url', $options);
        $url = json_decode($response->getBody()->getContents());
        $data = compact('url');
        return view('index', $data);
    }

    public function logRequest(Request $request) {
        $data = $request->except('_token');
        $msisdn = $_SERVER['HTTP_MSISDN'];
        $transId = microtime(true) * 10000 .'0';

        $options = [
            'query' => [
                'code' => $data[''],
                'msisdn' => $msisdn,
                'req_id' => $transId,
            ]
        ];

        $response = $this->client->request('GET', 'http://localhost:5556/v1/fun/log_req', $options);
        $dataResp = json_decode($response->getBody()->getContents());
        $urlRedirect = "http://support.funring.vn/support/funringonline/confirmsub_v1.jsp?id=601816&pkg=". $data['pkg']."&transid=" .$transId. "&mmisdn=";
        if ($dataResp->code == 1) {
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
