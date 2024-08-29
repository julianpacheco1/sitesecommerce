<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Stripe\StripeClient;

class StripePaymentController extends Controller
{

    public function createCheckoutSessionAjax($id)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $product = Product::findOrFail($id);

            $amount = $product->price * 100;

            $paymentIntent = \Stripe\PaymentIntent::create([
                'amount' => $amount,
                'currency' => 'usd',
                'automatic_payment_methods' => ['enabled' => true],
                'metadata' => [
                    'product_name' => $product->name,
                    'product_image' => $product->image,
                    'product_id' => $product->id,
                ],
            ]);

            return response()->json([
                'clientSecret' => $paymentIntent->client_secret,
                'amount' => $amount,
                'currency' => $paymentIntent->currency,
            ]);


        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    public function checkoutSingle($id)
    {
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $product = Product::findOrFail($id);

        $productoComprado[] = [
            'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                    'name' => $product->name,
                    'images' => [$product->image]
                ],
                'unit_amount' => $product->price * 100,
            ],
            'quantity' => 1,
        ];

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $productoComprado,
            'mode' => 'payment',
            'success_url' => route('payment.successapi', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('payment.cancel', [], true),
        ]);

        $order = new Order();
        $order->order_id = $session->id;
        $order->user_id = Auth::user()->id;
        $order->total_amount = $product->price;
        $order->payment_status = 'unpaid';
        $order->save();

        return redirect($session->url);
    }


    public function checkoutAll()
    {

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $lineItems = [];
        $totalAmount = 0;

        $products = Product::all();

        foreach ($products as $product) {
            $totalAmount += $product->price;
            $lineItems[] = [
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $product->name,
                        'images' => [$product->image]
                    ],
                    'unit_amount' => $product->price * 100,
                ],
                'quantity' => 1,
            ];
        }

        $session = \Stripe\Checkout\Session::create([
            'line_items' => $lineItems,
            'mode' => 'payment',
            'success_url' => route('payment.successapi', [], true) . "?session_id={CHECKOUT_SESSION_ID}",
            'cancel_url' => route('payment.cancel', [], true),
        ]);


        $order = new Order();
        $order->order_id = $session->id;
        $order->user_id = Auth::user()->id;
        $order->total_amount = $totalAmount;
        $order->payment_status = 'unpaid';
        $order->save();

        return redirect($session->url);
    }


    public function successApi(Request $request)
    {

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $sessionId = $request->get('session_id');

        try {
            $session = \Stripe\Checkout\Session::retrieve($sessionId);
            if (!$session) {
                throw new NotFoundHttpException;
            }

            $order = Order::where('order_id', $session->id)->first();
            if (!$order) {
                throw new NotFoundHttpException();
            }

            $order->payment_status = $session->payment_status;
            $order->save();

            return view('payment.successapi', compact('session'));

        } catch (\Exception $e) {
            throw new NotFoundHttpException();
        }
    }


    public function successLocal(Request $request)
{
    $paymentIntentId = $request->query('payment_intent'); 

    if (!$paymentIntentId) {
        return redirect('/')->with('error', 'No payment intent provided');
    }

    try {
        $stripe = new StripeClient(env('STRIPE_SECRET')); 
        $paymentIntent = $stripe->paymentIntents->retrieve($paymentIntentId);

        if (!$paymentIntent) {
            return redirect('/')->with('error', 'Payment details not found.');
        }

        $amount = $paymentIntent->amount;
        $currency = $paymentIntent->currency;
        $quantity = $paymentIntent->quantity ?? 1;
        $metadata = $paymentIntent->metadata;

        $products[] = [
            'product_name' => $metadata['product_name'] ?? 'N/A',
            'product_image' => $metadata['product_image'] ?? '',
            'product_id' => $metadata['product_id'] ?? '',
            'amount' => $amount,
            'currency' => $currency,
            'quantity' => $quantity,
        ];

        return view('payment.successlocal', compact('products'));

    } catch (\Stripe\Exception\ApiErrorException $e) {
        return redirect('/')->with('error', 'An error occurred while processing your payment: ' . $e->getMessage());
    } catch (\Exception $e) {
        return redirect('/')->with('error', 'An unexpected error occurred: ' . $e->getMessage());
    }
}


    public function cancel()
    {
        return view('payment.cancel');
    }
}
