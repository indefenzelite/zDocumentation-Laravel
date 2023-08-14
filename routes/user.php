<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\DashboardController;
use App\Http\Controllers\User\WalletController;
use App\Http\Controllers\User\PayoutController;
use App\Http\Controllers\User\PayoutDetailController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\NotificationController;
use App\Http\Controllers\User\SettingController;
use App\Http\Controllers\User\SupportTicketController;
use App\Http\Controllers\User\ConversationController;
use App\Http\Controllers\User\UserAddressController;
// use App\Http\Controllers\User\RegisterController;




Route::group(
    ['prefix' => 'user', 'as' => 'user.'], function () {
        // Route::group(
        //     ['prefix' => 'register', 'as' => 'register.', 'controller' => RegisterController::class], function () {
        //         Route::get('/', 'showRegistrationForm')->name('index');
        //         Route::post('/store', 'register')->name('store');
        //     }
        // );
    }
);
Route::group(
    ['middleware' => 'auth','prefix' => 'user', 'as' => 'user.'], function () {
    
        Route::group(
            ['prefix' => 'dashboard', 'as' => 'dashboard.', 'controller' => DashboardController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/logout-as', 'logoutAs')->name('logout-as');
            }
        );
        Route::group(
            ['prefix' => 'wallet', 'as' => 'wallet.', 'controller' => WalletController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
            }
        );
        Route::group(
            ['prefix' => 'payout', 'as' => 'payout.', 'controller' => PayoutController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
            }
        );
        Route::group(
            ['prefix' => 'payout-detail', 'as' => 'payout-detail.', 'controller' => PayoutDetailController::class], function () {
                // Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::get('/destroy/{payoutDetail}', 'destroy')->name('destroy');
            }
        );
        Route::group(
            ['prefix' => 'order', 'as' => 'order.', 'controller' => OrderController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/invoice/{id}', 'invoice')->name('invoice');
                Route::post('/store', 'store')->name('store');
                Route::get('/getItem', 'getItem')->name('getItem');
        
            }
        );

        Route::group(
            ['prefix' => 'support-ticket', 'as' => 'support-ticket.', 'controller' => SupportTicketController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store', 'store')->name('store');
                Route::post('/add-attachment/{supportTicket}', 'addAttachment')->name('add-attachment');
                Route::get('/show/{supportTicket}', 'show')->name('show');
            }
        );
        Route::group(
            ['prefix' => 'conversation', 'as' => 'conversation.', 'controller' => ConversationController::class], function () {
                Route::post('/store', 'store')->name('store');
                Route::get('/destroy/{conversation}', 'destroy')->name('delete');
            }
        );
        Route::group(
            ['prefix' => 'notification', 'as' => 'notification.', 'controller' => NotificationController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/mark-read/{notification}', 'markRead')->name('mark-read');
            }
        );
        Route::group(
            ['prefix' => 'setting', 'as' => 'setting.', 'controller' => SettingController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::post('/store/{id}', 'store')->name('store');
                Route::post('/ekyc/verify', 'ekycVerify')->name('ekyc-verify');
                Route::post('/update/password', 'updatePassword')->name('update-password');
                Route::post('/update/profile-img/{id}', 'updateProfileImg')->name('update-profile-img');
            }
        );
        Route::group(
            ['prefix' => 'address', 'as' => 'address.', 'controller' => UserAddressController::class], function () {
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::get('/destroy/{userAddress}', 'destroy')->name('destroy');
            }
        );
    }
);