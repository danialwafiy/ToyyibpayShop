<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;


class ToyyibpayController extends Controller
{
    public function createBill()
    {
        $option = array(
            'userSecretKey' => config('toyyibpay.secret'),
            'categoryCode' => config('toyyibpay.category'),
            'billName' => 'Car Rental WXX123',
            'billDescription' => 'Car Rental WXX123 On Sunday',
            'billPriceSetting' => 1,
            'billPayorInfo' => 1,
            'billAmount' => auth()->user()->total_cart_price * 100,
            'billReturnUrl' => route('toyyibpay.status'),
            'billCallbackUrl' => route('toyyibpay.callback'),
            'billExternalReferenceNo' => 'AFR341DFI',
            'billTo' => auth()->user()->name,
            'billEmail' => auth()->user()->email,
            'billPhone' => '0194342411',
            'billSplitPayment' => 0,
            'billSplitPaymentArgs' => '',
            'billPaymentChannel' => '0',
            'billDisplayMerchant' => 1,
            'billContentEmail' => 'Thank you for purchasing our product!',
            'billChargeToCustomer' => 2
        );

        $response = Http::asForm()->post('https://dev.toyyibpay.com/index.php/api/createBill', $option);
        $billCode = $response[0]['BillCode'];

        return redirect('https://dev.toyyibpay.com/' . $billCode);
    }

    public function paymentStatus()
    {
        $response = request()->all(['status_id', 'billcode', 'order_id']);
        if (request()->status_id == 1) {
            Payment::create([
                'status' => request()->status_id,
                'billcode' => request()->billcode,
                'order_id' => request()->order_id,
            ]);
            auth()->user()->total_cart_price = 0;
            auth()->user()->save();
            return redirect('/shop')->with('success', 'Your payment was successful. Thank you');
        }
        return redirect('/shop')->with('error', 'Your payment failed. Please try again');
    }

    public function callback()
    {
        $response = request()->all(['refno', 'status', 'reason', 'billcode', 'order_id', 'amount']);
        Log::info($response);
    }
}
