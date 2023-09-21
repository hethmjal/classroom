<?php

namespace App\Http\Controllers\Webhooks;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Stripe\StripeClient;

class StripeController extends Controller
{
    public function __invoke(StripeClient $stripe)
    {


        // This is your Stripe CLI webhook secret for testing your endpoint locally.
        $endpoint_secret = 'whsec_33ee2e9c130bd986d0ac19aa8ee4cc7398c1a321daefc732cfa41fc13e43a5c7';

        $payload = @file_get_contents('php://input');
        $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];
        $event = null;

        try {
        $event = \Stripe\Webhook::constructEvent(
        $payload, $sig_header, $endpoint_secret
        );
        } catch(\UnexpectedValueException $e) {
        // Invalid payload
        http_response_code(400);
        exit();
        } catch(\Stripe\Exception\SignatureVerificationException $e) {
        // Invalid signature
        http_response_code(400);
        exit();
        }

        switch ($event->type) {
            case 'checkout.session.completed':
              $session = $event->data->object;
              Payment::where('payment_gateway_reference_id',$session->id)->update([
                'payment_gateway_reference_id' => $session->payment_intent ,
              ]);
              break;
            case 'payment_intent.canceled':
              $paymentIntent = $event->data->object;
              Log::info('payment_canceled');
              break;
            case 'payment_intent.payment_failed':
              $paymentIntent = $event->data->object;
              Log::info('payment_failed');

              break;
            case 'payment_intent.succeeded':
              $paymentIntent = $event->data->object;
              $payment = Payment::where('payment_gateway_reference_id',$paymentIntent->id)->first();
              Log::info('paymnet: ');
              Log::info($payment);
              $payment->forceFill([
                'status' => 'completed'
              ])->save(); 
              $subscription = Subscription::findOrFail($payment->subscription_id);
              $subscription->update([
                'status' => 'active',
                'expires_at' => now()->addMonths(3),
              ]);
              break;
            default:
              echo 'Received unknown event type ' . $event->type;
          }

        }
}
