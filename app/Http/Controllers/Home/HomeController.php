<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use App\Models\RequestLog;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $msisdn = $this->getMsisdn(true);
        $data = compact('msisdn');
        return view('welcome', $data);
    }

    public function index(Request $request, $cp_code)
    {
        $msisdn = $this->getMsisdn(true);
        $transId = microtime(true) * 10000 .'0';
        $urlRedirect = "http://support.funring.vn/support/funringonline/confirmsub_v1.jsp?id=601816&pkg=N3&transid=" .$transId. "&mmisdn=" . $msisdn;
        $options = [
            'query' => [
                'code' => $cp_code
            ]
        ];

        try {
            $response = $this->client->request('GET', 'http://localhost:5556/v1/fun/get_url', $options);
            $url = json_decode($response->getBody()->getContents());

//            $data = compact('url', 'msisdn');
//            return view('index', $data);

            // redirect without click

            $optionsLogReq = [
                'form_params' => [
                    'code' => $cp_code,
                    'msisdn' => $msisdn,
                    'req_id' => $transId,
                ]
            ];

            $response = $this->client->request('POST', 'http://localhost:5556/v1/fun/log_req', $optionsLogReq);
            $dataResp = json_decode($response->getBody()->getContents());
            $redirectData = [
                'id' => 601816,
                'pkg' => $url->data->packageCodea ? $url->data->packageCode : 'N3',
                'transid' => $transId,
                'msisdn' => $msisdn
            ];
            $urlRedirect = "http://support.funring.vn/support/funringonline/confirmsub_v1.jsp?id=601816&pkg=". $url->data->packageCodea."&transid=" .$transId. "&mmisdn=" . $msisdn;
            Log::info("FUNRING;REDIRECT;" . '/confirmsub_v1.jsp?'.http_build_query($redirectData) , [
                'ip' => $request->ip(),
                'log_req' => $dataResp
            ]);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        return Redirect::away($urlRedirect);
    }

    public function logRequest(Request $request) {
        $data = $request->except('_token');
        $msisdn = $this->getMsisdn(true);
        $transId = microtime(true) * 10000 .'0';

        $options = [
            'form_params' => [
                'code' => $data['code'],
                'msisdn' => $msisdn,
                'req_id' => $transId,
            ]
        ];

        $response = $this->client->request('POST', 'http://localhost:5556/v1/fun/log_req', $options);
        $dataResp = json_decode($response->getBody()->getContents());
        $redirectData = [
            'id' => 601816,
            'pkg' => $data['pkg'],
            'transid' => $transId,
            'msisdn' => $msisdn
        ];
        $urlRedirect = "http://support.funring.vn/support/funringonline/confirmsub_v1.jsp?id=601816&pkg=". $data['pkg']."&transid=" .$transId. "&mmisdn=" . $msisdn;

        Log::info("FUNRING;REDIRECT;" . '/confirmsub_v1.jsp?'.http_build_query($redirectData) , [
            'ip' => $request->ip(),
            'log_req' => $dataResp
        ]);

        return response()->json([
            'url' => $urlRedirect
        ]);
    }

    public function backLog(Request $request)
    {
        $transId = $request->get('req_id');
        $rsCode = $request->get('rs_code');

        $options = [
            'form_params' => [
                'type' => 'RESPONSE',
                'rs_code' => $rsCode,
                'resp_date' => microtime(true) * 10000 .'0',
                'resp_data' => '',
                'req_id' => $transId
            ]
        ];

        try {
            $response = $this->client->request('POST', 'http://localhost:5556/v1/fun/update_log', $options);
            $dataResp = json_decode($response->getBody()->getContents());
            Log::info("FUNRING;BACKURL;" . 'DATA;transId=' . $transId . ";rs_code=" . $rsCode . ";url=" . URL::full(), [
                'dataResp' => $dataResp
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
        }

        return Redirect::away('http://funring.vn');
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
            if (substr($key, 0, 5) == 'HTTP_') {
                $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 5)))));
                $headers[$header] = $value;
            }

            if (substr($key, 0, 7) == 'REMOTE_') {
                $header = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($key, 7)))));
                $headers[$header] = $value;
            }
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
