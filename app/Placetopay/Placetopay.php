<?php

namespace App\Placetopay;

use App\Models\Order;
use Dnetix\Redirection\PlacetoPay as DnetixPlacetoPay;

class Placetopay
{
    /**
     * @var DnetixPlacetoPay|null
     */
    protected $placetopay;

    public function __construct()
    {
        $this->placetopay = new DnetixPlacetoPay([
            'login' => '6dd490faf9cb87a9862245da41170ff2',
            'tranKey' => '024h1IlD',
            'url' => 'https://test.placetopay.com/redirection',
            'rest' => [
                'timeout' => 45, // (optional) 15 by default
                'connect_timeout' => 30, // (optional) 5 by default
            ]
        ]);
    }

    public function request(Order $order)
    {
        // Creating a random reference for the test
        $reference = $order->getKey();
        $request = [
            'payment' => [
                'reference' => $reference,
                'description' => 'Pago orden '.$reference,
                'amount' => [
                    'currency' => 'COP',
                    'total' => $order->getAttribute('total'),
                ],
            ],
            'expiration' => date('c', strtotime('+1 days')),
            'returnUrl' => 'http://localhost:8000/orderPay/' . $reference,
            'ipAddress' => '127.0.0.1',
            'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
        ];


        $response = $this->placetopay->request($request);
        return $response;
    }
    public function requestId(Order $order)
    {
        $response = $this->placetopay->query($order->setAttribute('request_id'));
        return $response;
    }
}
