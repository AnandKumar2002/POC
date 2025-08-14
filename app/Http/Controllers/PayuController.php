<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PayUController extends Controller
{
    private $merchant_key = "UUG5xI";
    private $salt = "YQ7F4Ik4QIvRmOBY0A4lHM3J8T9P3rBA";
    private $payu_base_url = "https://test.payu.in/_payment"; // Change to live for production

    public function payment()
    {
        return view('payu.payment');
    }

    public function process(Request $request)
    {
        $data = $request->all();
        $data['key'] = $this->merchant_key;
        $data['txnid'] = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
        $data['surl'] = route('payu.success');
        $data['furl'] = route('payu.failure');

        $hash_string = $data['key'] . '|' . $data['txnid'] . '|' . $data['amount'] . '|' . $data['productinfo'] . '|' . $data['firstname'] . '|' . $data['email'] . '|||||||||||' . $this->salt;
        $data['hash'] = strtolower(hash('sha512', $hash_string));

        $data['action'] = $this->payu_base_url;

        return view('payu.redirect', compact('data'));
    }

    public function success(Request $request)
    {
        return "Payment Successful: " . json_encode($request->all());
    }

    public function failure(Request $request)
    {
        return "Payment Failed: " . json_encode($request->all());
    }
}

