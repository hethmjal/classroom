<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkNotificationsAsread
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $id = $request->query('nid');
        $user = $request->user();
        if($id && $user)
        {
            $notification = $user->unreadNotifications()->find($id);
            if($notification)
            {
                $notification->markAsread();
                 //$user->unreadNotifications->markAsread();
            }
            
           
        }
        return $next($request);
    }
}
