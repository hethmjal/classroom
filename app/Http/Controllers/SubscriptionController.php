<?php

namespace App\Http\Controllers;

use App\Actions\CreateSubscription;
use App\Http\Requests\CreateSubscriptionRequest;
use App\Models\Plan;
use Illuminate\Support\Facades\Auth;
use Throwable;

class SubscriptionController extends Controller
{
    public function store(CreateSubscriptionRequest $request, CreateSubscription $create)
    {
       
        

        $plan = Plan::findOrFail( $request->input('plan_id') );
        $months = $request->input('period');
        try {
          
            $subscription = $create([
                'plan_id' => $plan->id,
                'user_id' => Auth::id(),
                'price' => $plan->price * $months,
                'expires_at' => now()->addMonths($months),
                'status' => 'pending',
                ]);
                return to_route('checkout',$subscription->id);
        } 
        catch(Throwable $e){
            return to_route('plans');
        }
    

        
    }
}
