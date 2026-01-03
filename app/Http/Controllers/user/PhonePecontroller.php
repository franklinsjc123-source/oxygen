<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Ixudra\Curl\Facades\Curl;
class PhonePecontroller extends Controller
{

    public function phonePe()

    {
       
       // Retrieve the values from the session
        $order_id = session('order_id');
        $product_id = session('product_id');
        $quantity = session('quantity');
        $grandtotal = session('grandtotal');
        //dd($order_id);
        
         $order_id = $order_id; // Assuming these are sent via HTTP request
        
        $product_id = $product_id;
        $quantity = $quantity;
        $total_price = $grandtotal;
        
        //$amount_in_paisa =  $total_price * 100; // 100 INR in paisa
       $amount_in_paisa =  1 * 100;
        $data = array (
            'merchantId' => 'PGTESTPAYUAT',
            'merchantTransactionId' => 'MT7850590068188104',
            'merchantUserId' => 'MUID123',
            'amount' => $amount_in_paisa,
            'redirectUrl' => route('response'),
            'redirectMode' => 'POST',
            'callbackUrl' => route('response'),
            'mobileNumber' => '9999999999',
            'paymentInstrument' => 
                array (
                    'type' => 'PAY_PAGE',
                    'order_id' =>$order_id,
				// 		'product_id' =>$product_id,
				// 		'quantity' =>$quantity,
				// 		'total_price'=>$amount_in_paisa
                ),
        );

        // Encode the request data
        $encode = base64_encode(json_encode($data));
       

        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;

        $string = $encode.'/pg/v1/pay'.$saltKey;
        $sha256 = hash('sha256',$string);

        $finalXHeader = $sha256.'###'.$saltIndex;
        
        // $response = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay')
        //         ->withHeader('Content-Type:application/json')
        //         // ->withHeader('accept:application/json')
        //         ->withHeader('X-VERIFY:'.$finalXHeader)
        //         ->withData(json_encode(['request' => $encode]))
        //         // ->withHeader('X-MERCHANT-ID:'.$input['transactionId'])
        //         ->post();
        //         $rData = json_decode($response);
                // dd($rData);

        $url = "https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/pay";

        // Create a new Guzzle HTTP client
        $client = new Client();

        // Make the POST request using Guzzle
        $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'X-VERIFY' => $finalXHeader,
            ],
            'body' => json_encode(['request' => $encode]),
        ]);

        // Decode the response body
        $rData = json_decode($response->getBody()->getContents());
        //dd($rData);
        // Redirect to the payment URL
        return redirect()->to($rData->data->instrumentResponse->redirectInfo->url);
    }

    public function response(Request $request)
    {
        $input = $request->all();
        dd($input);
        $saltKey = '099eb0cd-02cf-4e2a-8aca-3e6c6aff0399';
        $saltIndex = 1;

        $finalXHeader = hash('sha256','/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'].$saltKey).'###'.$saltIndex;

        // $response = Curl::to('https://api-preprod.phonepe.com/apis/pg-sandbox/pg/v1/status/'.$input['merchantId'].'/'.$input['transactionId'])
        //         ->withHeader('Content-Type:application/json')
        //         ->withHeader('accept:application/json')
        //         ->withHeader('X-VERIFY:'.$finalXHeader)
        //         ->withHeader('X-MERCHANT-ID:'.$input['transactionId'])
        //         ->get();

        // dd(json_decode($response));

        $client = new Client();
        // Make the GET request using Guzzle
     $response = $client->post($url, [
            'headers' => [
                'Content-Type' => 'application/json',
                'X-VERIFY' => $finalXHeader,
            ],
            'body' => json_encode(['request' => $encode]),
        ]);

    // Get the response body
    $responseData = json_decode($response->getBody()->getContents());

    // Dump the response data for debugging
    dd($responseData);
    }
}
