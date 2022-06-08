<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\RequestLog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

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
        $msisdn = $this->getMsisdn(true);
        $transId = microtime(true) * 10000 .'0';

        $options = [
            'query' => [
                'code' => $data['code'],
                'msisdn' => $msisdn,
                'req_id' => $transId,
            ]
        ];

        $response = $this->client->request('GET', 'http://localhost:5556/v1/fun/log_req', $options);
        $dataResp = json_decode($response->getBody()->getContents());
        $urlRedirect = "http://support.funring.vn/support/funringonline/confirmsub_v1.jsp?id=601816&pkg=". $data['pkg']."&transid=" .$transId. "&mmisdn=" . $msisdn;
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

        $options = [
            'query' => [
                'req_id' => $transId,
                'type' => 'RESPONSE',
                'rs_code' => $rsCode,
                'resp_data' => URL::full()
            ]
        ];

        $response = $this->client->request('GET', 'http://localhost:5556/v1/fun/update_log', $options);
        $dataResp = json_decode($response->getBody()->getContents());

        if ($dataResp->code == 1) {
            return Redirect::away('http://funring.vn');
        }

        return Redirect::route('welcome');
    }

    public function showHeader(Request $request)
    {
        echo "<pre>";
        if ($request->get('show') == 'all') {
            print_r($_SERVER);
        } else {
            print_r($this->getMsisdn());
        }
    }

    private function getMsisdn($isGetMsisdn = false) {
        $headers = array();
        foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) <> 'HTTP_') {
                continue;
            }
            $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
            $headers[$header] = $value;
        }
        if ($isGetMsisdn) {
            $msisdn = '';
            if (!empty($headers['Msisdn']))
            {
                $msisdn = '84'.substr($headers['Msisdn'], '-9');
            }

            if (!empty($headers['Msisdn1']))
            {
                $msisdn = '84'.substr($headers['Msisdn1'], '-9');
            }

            if (!empty($headers['X-Wap-Msisdn']))
            {
                $msisdn = '84'.substr($headers['X-Wap-Msisdn'], '-9');
            }

            return $msisdn;
        }

        return $headers;
    }
}
