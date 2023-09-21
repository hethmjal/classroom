<?php

use App\Http\Controllers\Api\V1\ClassroomMessagesController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ClassroomPeopleController;
use App\Http\Controllers\ClassWorkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\JoinClassroomController;
use App\Http\Controllers\PaymentsController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\Webhooks\StripeController;
use App\Models\Classwork;
<<<<<<< HEAD
use App\Models\Subscription;
=======
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/test', function () {
    $arr =[11,12,13,16];
    for($i=$arr[0],$j=0; $j < count($arr);$i++,$j++) { 
      if($i !== $arr[$j]){
        return $i;
      }
    }
 });


//require __DIR__.'/auth.php';
Route::get('/', function () {
<<<<<<< HEAD
   return to_route('plans');
=======

    return view('welcome');
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9
});

Route::get('plans',[PlanController::class,'index'])->name('plans');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware(['auth'])->group(function () {
    Route::resource('classrooms.messages',ClassroomMessagesController::class);
    // subscription
    Route::post('subscribe',[SubscriptionController::class,'store'])->name('subscribe');
    Route::get('subscription/{subscription}/checkout',[PaymentsController::class,'create'])->name('checkout');

<<<<<<< HEAD
    //payments 
    Route::post('payments',[PaymentsController::class,'store'])->name('payments.store');
    Route::get('payments/{subscription}/success',[PaymentsController::class,'success'])->name('payments.success');
    Route::get('payments/{subscription}/cancel',[PaymentsController::class,'cancel'])->name('payments.cancel');
=======

Route::middleware(['auth', 'user.preferences'])->group(function () {
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9

    // Classrooms routes
    Route::prefix('/classrooms/trached')->controller(ClassroomController::class)->group(function () {
        Route::get('/', 'trached')->name('classrooms.trached');
        Route::put('/restore/{id}', 'restore')->name('classrooms.restore');
        Route::delete('/forceDelete/{id}', 'forceDelete')->name('classrooms.forceDelete');
    });
    /*    Route::resource('classrooms',ClassroomController::class)
          // ->names([ 'index'=>'classrooms','create'=>'classrooms' ]); 
            */

    // Join classrooms routes
    Route::get('/classrooms/{classroom}/join', [JoinClassroomController::class, 'create'])
        ->middleware('signed')
        ->name('classrooms.join');
    Route::post('/classrooms/{classroom}/join', [JoinClassroomController::class, 'store'])
        ->name('classrooms.join');


    // trached topics routes
    Route::prefix('classrooms/{classroom}/topics/trached')->controller(TopicController::class)->group(function () {
        Route::get('/', 'trached')->name('topics.trached');
        Route::put('/restore/{topic}', 'restore')->name('topics.restore');
        Route::delete('/forceDelete/{topic}', 'forceDelete')->name('topics.forceDelete');
    });

    Route::resources([
        'classrooms.topics' => TopicController::class,
        'classrooms' => ClassroomController::class,
        'classrooms.classworks' => ClassWorkController::class,
    ]);

    Route::get('/classrooms/{classroom}/people', [ClassroomPeopleController::class, 'index'])->name('classrooms.people');
    Route::delete('/classrooms/{classroom}/people', [ClassroomPeopleController::class, 'destroy'])->name('classrooms.people.destroy');
<<<<<<< HEAD
    Route::get('/classrooms/{classroom}/chat', [ClassroomController::class, 'chat'])
    ->name('classrooms.chat');
=======
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9

    // Comments

    Route::post('comments', [CommentController::class, 'store'])
        ->name('comments.store');

    Route::post('classwork/{classwork}/submission', [SubmissionController::class, 'store'])
        ->name('submissions.store')
        // ->middleware('can:submissions.create,classwork');
        // ->middleware('can:submissions.create,app\Model\Classwork');
    ;

    Route::get('submissions/{submission}/file', [SubmissionController::class, 'file'])
        ->name('submissions.file');
<<<<<<< HEAD
=======


>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9

    // Nested resources
    //Route::resource('classrooms.topics',TopicController::class);

    // Class Works routes
    //Route::resource('classrooms.classworks',ClassWorkController::class)->shallow();

<<<<<<< HEAD
=======

});
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9

});

<<<<<<< HEAD
Route::post('/payment/stripe/webhooks',StripeController::class);
=======

Route::get('/charts', function () {
    return view('charts');
});
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9




<<<<<<< HEAD


































Route::get('/charts', function () {
    return view('charts');
});



/* Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
 */


=======
>>>>>>> b7d8f16501e243d7bce8ac65fa2acc728ba028b9
require __DIR__ . '/auth.php';
