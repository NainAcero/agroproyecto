<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Api\PaymentExecution;
use App\Models\Historial;
use App\Models\Factura;
use App\Models\DetalleFactura;
use Cart;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    private $apiContext;

    public function __construct()
    {
        $payPalConfig = Config::get('paypal');

        $this->apiContext = new ApiContext(
            new OAuthTokenCredential(
                $payPalConfig['client_id'],
                $payPalConfig['secret']
            )
        );

        $this->apiContext->setConfig($payPalConfig['settings']);
    }


    public function payWithPayPal()
    {
        $historial = Historial::whereDate('created_at', '=', date('Y-m-d'))
        ->where('usado','0')->first();

        $total = 0;
        if(Cart::total() != null){
            $total = Cart::total();
        }

        if($total == 0){
            $status = 'Realize una compra!. gracias.';
            return redirect('/user/dashboard')->with(compact('status'));
        }

        if($historial != null){
            if($historial->type == "money"){
                $total = number_formt($total)  - (double)$historial->descuento;
            }else{
                $total = number_formt($total) - number_formt($total)*(double)($historial->descuento / 100);
            }
        }

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $amount = new Amount();
        $amount->setTotal(number_formt($total));
        $amount->setCurrency('USD');

        $transaction = new Transaction();
        $transaction->setAmount($amount);
        // $transaction->setDescription('See your IQ results');

        $callbackUrl = url('/paypal/status');

        $redirectUrls = new RedirectUrls();
        $redirectUrls->setReturnUrl($callbackUrl)
            ->setCancelUrl($callbackUrl);

        $payment = new Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);

        try {
            $payment->create($this->apiContext);
            return redirect()->away($payment->getApprovalLink());
        } catch (PayPalConnectionException $ex) {
            echo $ex->getData();
        }
    }

    public function payPalStatus(Request $request)
    {
        $paymentId = $request->input('paymentId');
        $payerId = $request->input('PayerID');
        $token = $request->input('token');

        if (!$paymentId || !$payerId || !$token) {
            $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
            return redirect('/paypal/failed')->with(compact('status'));
        }

        $payment = Payment::get($paymentId, $this->apiContext);

        $execution = new PaymentExecution();
        $execution->setPayerId($payerId);

        /** Execute the payment **/
        $result = $payment->execute($execution, $this->apiContext);

        if ($result->getState() === 'approved') {

            $historial = Historial::whereDate('created_at', '=', date('Y-m-d'))
            ->where('usado','0')->first();
            $id = null;
            if($historial != null){
                $id = $historial->id;

                $historial->usado = 1;
                $historial->save();
            }

            $factura = Factura::create([
                "total" => Cart::total(),
                "tax" => Cart::tax(),
                "subtotal" => Cart::subtotal(),
                "user_id" => Auth::user()->id,
                "historial_id" => $id
            ]);

            foreach(Cart::content() as $item){
                DetalleFactura::create([
                    "precio" => $item->model->regular_price,
                    "cantidad" => $item->qty,
                    "nombre" => $item->model->name,
                    "imagen" => $item->model->image,
                    "user_id" => Auth::user()->id,
                    "factura_id" => $factura->id
                ]);

            }
            Cart::destroy();
            $status = 'Gracias! El pago a través de PayPal se ha ralizado correctamente.';
            return redirect('/user/dashboard')->with(compact('status'));
        }

        $status = 'Lo sentimos! El pago a través de PayPal no se pudo realizar.';
        return redirect('/user/dashboard')->with(compact('status'));
    }
}

function number_formt($number){
    return (double)floatval(str_replace(',','',$number));
}
