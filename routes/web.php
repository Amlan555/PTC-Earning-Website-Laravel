<?php

use App\Http\Controllers\Admin\adminController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\monthlycommisionController;
use App\Http\Controllers\Admin\notificationController;
use App\Http\Controllers\Admin\pinCodeController;
use App\Http\Controllers\Admin\referBonusController;
use App\Http\Controllers\Admin\submitedTaskController;
use App\Http\Controllers\Admin\taskController;
use App\Http\Controllers\Admin\userController;
use App\Http\Controllers\Admin\withdrawrequestController;
use App\Http\Controllers\Home\homepageController;
use App\Http\Controllers\Home\jobController;
use App\Http\Controllers\Home\profileController;
use App\Http\Controllers\Home\withdrawControll;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('refer/{name}',function($name){
    $user = User::where('slug',$name)->first();
    if(!isset($user)){
        return redirect()->back();
    }
    return view('auth.register',['refer'=>$name]);
})->middleware('guest');

Route::group(["prefix"=>"admin","as"=>"admin.","middleware"=>["auth","admin"]],function(){
    Route::get('dashboard',[adminController::class,'index'])->name('dashboard');
    Route::resource('level', LevelController::class);
    Route::resource('pincode', pinCodeController::class);
    Route::get('headline',[adminController::class,'headlineShow'])->name('headline');
    Route::put('headline/store/{id}',[adminController::class,'headlineStore'])->name('headline.update');
    Route::get('refer-bonus',[referBonusController::class,'referBonusShow'])->name('referBonus');
    Route::put('refer-bonus/store/{id}',[referBonusController::class,'referBonusUpdate'])->name('referBonus.update');
    Route::resource('task', taskController::class);
    Route::resource('submission', submitedTaskController::class);
    Route::resource('withdrawals', withdrawrequestController::class);
    Route::get('notification',[notificationController::class,'index'])->name('notification');
    Route::get('notification/create/',[notificationController::class,'create'])->name('notification.create');
    Route::post('notification/store',[notificationController::class,'store'])->name('notification.store');
    Route::get('notification/edit/{id}',[notificationController::class,'edit'])->name('notification.edit');
    Route::get('notification/selectall',[notificationController::class,'selectAll'])->name('notification.selectAll');
    Route::put('notification/update/{id}',[notificationController::class,'update'])->name('notification.update');
    Route::delete('notification/destroy/{id}',[notificationController::class,'delete'])->name('notification.delete');
    Route::post('notification/deleteall/',[notificationController::class,'deleteAll'])->name('notification.delete.all');
    Route::resource('users', userController::class);
    Route::put('user/block-unblock/{id}', [userController::class,'blockUnblock'])->name('user.blockUnblock');
    Route::get('monthly-commision',[monthlycommisionController::class,'index'])->name('monthlyCommision');
    Route::get('monthly-commision/edit/{id}',[monthlycommisionController::class,'edit'])->name('monthlyCommision.edit');
    Route::put('monthly-commision/update/{id}',[monthlycommisionController::class,'update'])->name('monthlyCommision.update');
});

Route::group(["middleware"=>["auth","online"]],function(){
    Route::get('/',[homepageController::class,'index']);
    Route::get('profile',[profileController::class,'index'])->name('profile');
    Route::post('profile/update',[profileController::class,'update'])->name('profile.update');
    Route::post('profile/update/image',[profileController::class,'updateImage'])->name('profile.image.update');
    Route::get('jobs',[jobController::class,'index']);
    Route::get('job',[jobController::class,'index'])->name('job');
    Route::get('job/{slug}',[jobController::class,'singleJob'])->name('job.single');
    Route::post('job/submit/{id}',[jobController::class,'jobSubmit'])->name('job.submit');
    Route::get('profile/balance',[withdrawControll::class,'balance'])->name('balance');
    Route::post('profile/withdraw',[withdrawControll::class,'withdraw'])->name('withdraw');
    Route::get('profile/notification',[profileController::class,'notificationShow'])->name('notification');
    Route::get('profile/notification/{id}',[profileController::class,'Singlenotification'])->name('single_notification');
    Route::get('notification/markasread',function(){
        $user = Auth::user();
        $user->unreadNotifications->markAsRead();
        return redirect()->back();
    })->name('markRead');
});

