<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TestController extends Controller
{
    public function index() {

//$header = array(
//    'Content-Type' => 'application/json',
//    'X-LINE-ChannelId' => '1591487530',
//    'X-LINE-Authorization-Nonce' => $nonce,
//    'X-LINE-Authorization' => $channel_secret,
//);

        $postData = array(
            'amount' => 1,
            'currency' =>'https://curio-shiki.com/form_certification/images/linepay-iconimage.png',
            'orderId' => '1',
            'packeges' => array(
                'id' => '1',
                'amount' => 1,
                'products' => array(
                    'id' => 'p_id',
                    'name' => 'p_test',
                    'quantity' => 1,
                    'price' => 1
                )
            ),
            'redirectUrls' => array(
                'confirmUrl' => 'https://google.com',
                'cancelUrl' => 'https://google.com',
            )
        );

        $nonce = time();
        $channel_secret = hash_hmac(
            'sha256',
            '5a7b4e69abd18093894a787a4a4234f3' . '/v3/payments/request'  . $nonce,
//            '5a7b4e69abd18093894a787a4a4234f3' . '/v3/payments/request' . json_encode($postData)  . $nonce,
            '5a7b4e69abd18093894a787a4a4234f3'
        );

        var_dump($channel_secret);

        $opts = [
                    'http' => [
                        'method' => 'POST',
                        'header' => "Content-Type: application/json\r\n".
                            "X-LINE-ChannelId: 1591487530\r\n".
                            "X-LINE-Authorization-Nonce:" . $nonce . "\r\n".
                            "X-LINE-Authorization:" . $channel_secret . "\r\n",
//                        'context' => json_encode($postData)
                    ],
        ];

        $ctx = stream_context_create($opts);


        $response = file_get_contents(
            'https://sandbox-api-pay.line.me/v3/payments/request',
            false,
            $ctx
        );

        echo "<pre>";
        var_dump($response);
        echo "</pre>";
    }
}
