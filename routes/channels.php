<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

// NewClassworkNotification
Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});


// ClassworkCreated
Broadcast::channel('classroom.{id}',function($user,$id){
    return $user->classrooms()->where('id',$id)->exists();
});

Broadcast::channel('classroom.{id}',function($user,$id){
     if($user->classrooms()->where('id',$id)->exists());
         return $user;
});