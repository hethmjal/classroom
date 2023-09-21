<?php

namespace App\Actions;

use App\Models\Subscription;

class CreateSubscription
{
    public function __invoke(array $data): Subscription
    {
        return Subscription::forceCreate($data);
    }

	
}
