<?php
namespace App\Http\Controllers;

use Blinqpay\PaymentRouter\PaymentRouter;
use Illuminate\Http\Request;

class BlinqPayController extends Controller
{
    protected $paymentRouter;

    public function __construct(PaymentRouter $paymentRouter)
    {
        $this->paymentRouter = $paymentRouter;
    }

    public function payment(Request $request)
    {
        $amount = 100;
        $currency = 'NGN';
        $details ='Payment for Order #123';

        try {
            // Use the PaymentRouter to process the payment
            $result = $this->paymentRouter->route($amount, $currency, $details);


            return response()->json(['message' => $result], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
