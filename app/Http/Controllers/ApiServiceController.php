<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;
use DateTime;

class ApiServiceController extends Controller
{
    public function refresh()
    {
        
        $user = User::find(\Auth::user()->id);
        $token = md5(microtime() . \Auth::user()->email . time());
        $user->api_token = $token;
        $user->save();
        return redirect('/');
    }

    public function send(Request $req)
    {
        if(\Auth::check()) {

            $date = new DateTime($req->date);
            $date = $date->format('d-m-Y');

            $user = User::find(\Auth::user()->id);

            if (\Auth::user()->api_token == $req->api_token) {

                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => "http://www.cbr.ru/scripts/XML_daily.asp?date_req=" . $date,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => "",
                    CURLOPT_TIMEOUT => 30000,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => "GET",
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                    ),
                ));
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);

                if ($err) {
                    echo "cURL Error #:" . $err;
                } else {
                    $xml = simplexml_load_string($response);
                    $json = json_encode($xml);
                    $array = json_decode($json,TRUE);
                    $contains = Arr::has($array, 'Valute.0.NumCode');

                    if ( $contains ) {
                        return redirect('/api/quotation/' . $date)->with( ['data' => $array] );
                    } else {                        
                        header('HTTP/1.0 404 Not Found');
                        exit;
                    }                    
                }
            } else {
                return redirect()->back()->with('token_error', 'Неправильный токен');
            }
        } else {
            header('HTTP/1.0 401 Unauthorized');
            exit;
        }
    }
    public function response($date)
    {
        $data = \Session::get('data');

        if ($data == null) {
            header('HTTP/1.0 401 Unauthorized');
            exit;
        } else {
            $data = $data['Valute'];
            return view('response')->with('data', $data);
        }

               
    }
}
