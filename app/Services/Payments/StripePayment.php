<?php 

namespace App\Services\Payments;

use App\Models\Payment;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;

class StripePayment
{
    public function createCheckoutSession(Subscription $subscription)
    {
        $stripe = app(StripeClient::class); //app()->make(StripeClient::class)
        $checkout_session = $stripe->checkout->sessions->create([
            'line_items' => [
              [
              'price_data' => [
                  'currency' => 'usd',
                  'product_data' =>[
                      'name' => $subscription->plan->name,
                  ],
                  'unit_amount' => $subscription->plan->price * 100,
              ],
              'quantity' => 3,//$subscription->expires_at->diffInMonths($subscription->created_at),
            ]
          ],

          'client_reference_id' => $subscription->id,
          'metadata' => [
              'subscription_id' => $subscription->id,
          ],
            'mode' => 'payment',
            'success_url' => route('payments.success',$subscription->id),
            'cancel_url' => route('payments.cancel',$subscription->id),
          ]);

          Payment::forceCreate([
            'user_id' => Auth::id(),
            'subscription_id' => $subscription->id,
            'amount' => $subscription->price * 100,
            'currency_code' => 'usd',
            'payment_gateway' => 'stripe',
            'payment_gateway_reference_id' => $checkout_session->id,
            'data' => $checkout_session,
          ]);
          return redirect()->away($checkout_session->url);
    }


}