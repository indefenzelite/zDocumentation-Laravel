<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\User\AuthController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Api\User\SocialLoginController;
use App\Http\Controllers\Api\User\UserAddressController;
use App\Http\Controllers\Api\User\UserEkycController;
use App\Http\Controllers\Api\User\SubscriptionController;
use App\Http\Controllers\Api\User\ItemController;
use App\Http\Controllers\Api\User\NotificationController;
use App\Http\Controllers\Api\User\PayoutController;
use App\Http\Controllers\Api\User\PayoutDetailController;
use App\Http\Controllers\Api\User\SliderController;
use App\Http\Controllers\Api\User\CategoryController;
use App\Http\Controllers\Api\User\OrderController;
use App\Http\Controllers\Api\User\SupportTicketController;
use App\Http\Controllers\Api\User\ConversationController;
use App\Http\Controllers\Api\RolesController;
use App\Http\Controllers\Api\HomeController;
use App\Http\Controllers\Api\PermissionController;
use App\Http\Controllers\Api\UserEnquiryController;
use App\Http\Controllers\Api\WebsiteEnquiryController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\ParagraphContentController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\WebsitePageController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\BlogController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/



Route::post('login', [AuthController::class,'login']);
Route::post('login-with-phone', [AuthController::class, 'loginWithPhone']);
Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('get-states', [AuthController::class,'getStates']);
Route::post('get-cities', [AuthController::class,'getCities']);
Route::post('reset-password', [AuthController::class,'resetPassword']);
Route::post('register', [AuthController::class,'register']);
Route::post('reset-change-password', [AuthController::class,'changeResetPassword']);
Route::post('helpdesk', [AuthController::class,'helpdesk']);
Route::post('google-login', [SocialLoginController::class, 'googleLogin']);

// Route::group(['controller' => SocialLoginController::class], function () {
    // Route::get('auth/google', 'redirectToGoogle');
    // Route::get('auth/google/callback', 'handleGoogleCallback');
// });

Route::group(
    ['middleware' => 'auth:api'], function () {
        Route::group(
            ['controller' => AuthController::class], function () {
                Route::post('update-device-token', 'updateDeviceToken');
                Route::post('change-password', 'changePassword');
                Route::get('logout', 'logout');
                Route::get('/profile', 'profile');
                Route::post('/update-profile', 'updateProfile');
            }
        );
    
        Route::group(
            ['controller' => HomeController::class], function () {
                Route::get('home-slider', 'homeSlider');
                Route::get('bottom-slider', 'bottomSlider');
                Route::get('page/{slug}', 'pageContent');
            }
        );
    
        Route::group(
            ['prefix' => 'users', 'as' => 'users.', 'controller' => UserController::class], function () {
                Route::get('/profile', 'profile');
                Route::get('/user-data', 'userData');
                Route::get('/wallet', 'walletBalanceIndex');
                Route::get('/', 'list');
                Route::post('/create', 'store');
                Route::get('/delete/{user}', 'delete');
                Route::post('/change-role/{user}', 'changeRole');
            }
        );
        Route::group(
            ['prefix' => 'user-addresses', 'as' => 'user-addresses.', 'controller' => UserAddressController::class], function () {
                Route::get('/index', 'index');
                Route::post('/create', 'store');
                Route::post('/edit/{id}', 'update');
                Route::get('/delete/{id}', 'destroy');
            }
        );
        Route::group(
            ['prefix' => 'orders', 'as' => 'orders.', 'controller' => OrderController::class], function () {
                Route::get('/index', 'index');
                Route::post('/store', 'store');
                Route::get('/{id}/show', 'show');
                Route::get('/{id}/invoice', 'invoice');
                Route::post('/{id}/refund', 'orderRefund');
            }
        );
        Route::group(
            ['prefix' => 'article', 'as' => 'article.', 'controller' => ArticleController::class], function () {
                Route::post('/index', 'index');
                Route::post('/store', 'store');
            }
        );
    
        Route::group(
            ['prefix' => 'payout-details', 'as' => 'payout-details.', 'controller' => PayoutDetailController::class], function () {
                Route::get('/index', 'index');
                Route::post('/store', 'store');
            }
        );
        Route::group(
            ['prefix' => 'payouts', 'as' => 'payouts.', 'controller' => PayoutController::class], function () {
                Route::get('/index', 'index');
                Route::get('/{id}/show', 'show');
                Route::post('/store', 'store');
            }
        );

        Route::group(
            ['prefix' => 'user-ekyc', 'as' => 'user-ekyc.', 'controller' => UserEkycController::class], function () {
                Route::get('/index', 'index');
                Route::post('/store', 'store');
            }
        );
    
        Route::group(
            ['prefix' => 'roles', 'as' => 'roles.', 'controller' => RolesController::class], function () {
                Route::get('/', 'list');
                Route::post('/create', 'store');
                Route::get('/{role}', 'show');
                Route::get('/delete/{role}', 'delete');
                Route::post('/change-permission/{role}', 'changePermissions');
            }
        );

        //only those have manage_permission permission will get access
        Route::group(
            ['prefix' => 'permissions', 'as' => 'permissions.', 'controller' => PermissionController::class], function () {
                Route::get('/', 'list');
                Route::post('/create', 'store');
                Route::get('/{permission}', 'show');
                Route::get('/delete/{permission}', 'delete');
            }
        );

        Route::group(
            ['prefix' => 'notifications', 'as' => 'notifications.', 'controller' => NotificationController::class], function () {
                Route::get('/', 'index');
            }
        );

        Route::group(
            ['prefix' => 'support-tickets', 'as' => 'support-tickets.', 'controller' => SupportTicketController::class], function () {
                Route::get('/index', 'index');
                Route::post('/create', 'store');
                Route::get('/show', 'show');
                Route::get('/{id}/chat', 'chat');
                Route::get('/{id}/attachment', 'attachment');
            }
        );
        Route::group(
            ['prefix' => 'user-enquiries', 'as' => 'user-enquiries.', 'controller' => UserEnquiryController::class], function () {
                Route::get('/index', 'index');
                Route::post('/create', 'store');
                Route::get('/{id}/show', 'show');
            }
        );
        Route::group(
            ['prefix' => 'support-tickets', 'as' => 'support-tickets.', 'controller' => SupportTicketController::class], function () {
                Route::get('/index', 'index');
                Route::post('/create', 'store');
                Route::get('/{id}/show', 'show');
                Route::get('/{id}/chat', 'chat');
                Route::get('/{id}/attachment', 'attachment');
            }
        );

        Route::group(
            ['prefix' => 'website-enquiries', 'as' => 'website-enquiries.', 'controller' => WebsiteEnquiryController::class], function () {
                Route::post('/create', 'store');
            }
        );

        Route::group(
            ['prefix' => 'faqs', 'as' => 'faqs.', 'controller' => FaqController::class], function () {
                Route::get('/index', 'index');
                Route::get('/{category_id}/show', 'show');
            }
        );

        Route::group(
            ['prefix' => 'paragraph-contents', 'as' => 'paragraph-contents.', 'controller' => ParagraphContentController::class], function () {
                Route::get('/', 'list');
            }
        );

        Route::group(
            ['prefix' => 'settings', 'as' => 'settings.', 'controller' => SettingController::class], function () {
                Route::get('/', 'list');
            }
        );

        Route::group(
            ['prefix' => 'website-pages', 'as' => 'website-pages.', 'controller' => WebsitePageController::class], function () {
                Route::get('/{slug}', 'list');
            }
        );

        Route::group(
            ['prefix' => 'sliders', 'as' => 'sliders.', 'controller' => SliderController::class], function () {
                Route::get('/{type}', 'list');
            }
        );

        Route::group(
            ['prefix' => 'locations', 'as' => 'locations.', 'controller' => LocationController::class], function () {
                Route::get('/country', 'countryList');
                Route::get('/state/{countryId}', 'stateList');
                Route::get('/city/{stateId}', 'cityList');
            }
        );

        Route::group(
            ['prefix' => 'categories', 'as' => 'categories.', 'controller' => CategoryController::class], function () {
                Route::get('/index', 'list');
                Route::get('/faq-categories', 'faqCategory');
                Route::get('/support-ticket-categories', 'supportTicketCategory');
                Route::get('/get-category-data', 'getCategoryData');
            }
        );
        Route::group(
            ['prefix' => 'items', 'as' => 'items.', 'controller' => ItemController::class], function () {
                Route::get('/index', 'list');
                Route::get('/{id}/show', 'show');
                Route::get('/cart', 'cartIndex');
                Route::get('/wishlists', 'myWishlist');
                Route::post('/{item_id}/wishlist/add', 'wishlistAddItem');
                Route::get('/wishlist/{w_id}/remove', 'wishlistRemove');
                Route::get('/cart/product-checkout', 'productCheckout');
            }
        );

        Route::group(
            ['prefix' => 'blogs', 'as' => 'blogs.', 'controller' => BlogController::class], function () {
                Route::get('/index', 'index');
                Route::get('/categories-list', 'categoryList');
                Route::get('/', 'list');
                Route::get('/show/{slug}', 'show');
            }
        );
        Route::group(
            ['prefix' => 'subscriptions', 'as' => 'subscriptions.', 'controller' => SubscriptionController::class], function () {
                Route::get('/user/plans', 'index');
                Route::post('/user/plan/{id}/checkout', 'checkoutIndex');
            }
        );
    
    }
);

    
Route::group(
    ['namespace' => 'Api','prefix' => 'expenses','as' =>'expenses.','middleware' =>  ["api", "auth:api"]], function () {
        Route::get('/', ['uses' => 'ExpenseController@index']);
        Route::post('/', ['uses' => 'ExpenseController@store']);
        Route::get('/{expense}', ['uses' => 'ExpenseController@show']);
        Route::put('/{expense}', ['uses' => 'ExpenseController@update']);
        Route::delete('/{expense}', ['uses' => 'ExpenseController@destroy']);
    }
); 



Route::group(
    ['namespace' => 'Api','prefix' => 'expenses','as' =>'expenses.','middleware' =>  ["api", "auth:api"]], function () {
        Route::get('/', ['uses' => 'ExpenseController@index']);
        Route::post('/', ['uses' => 'ExpenseController@store']);
        Route::get('/{expense}', ['uses' => 'ExpenseController@show']);
        Route::put('/{expense}', ['uses' => 'ExpenseController@update']);
        Route::delete('/{expense}', ['uses' => 'ExpenseController@destroy']);
    }
); 



Route::group(
    ['namespace' => 'Api','prefix' => 'charges','as' =>'charges.','middleware' =>  ["api", "auth:api"]], function () {
        Route::get('/', ['uses' => 'ChargeController@index']);
        Route::post('/', ['uses' => 'ChargeController@store']);
        Route::get('/{charge}', ['uses' => 'ChargeController@show']);
        Route::put('/{charge}', ['uses' => 'ChargeController@update']);
        Route::delete('/{charge}', ['uses' => 'ChargeController@destroy']);
    }
); 



Route::group(
    ['namespace' => 'Api','prefix' => 'expenditures','as' =>'expenditures.','middleware' =>  ["api", "auth:api"]], function () {
        Route::get('/', ['uses' => 'ExpenditureController@index']);
        Route::post('/', ['uses' => 'ExpenditureController@store']);
        Route::get('/{expenditure}', ['uses' => 'ExpenditureController@show']);
        Route::put('/{expenditure}', ['uses' => 'ExpenditureController@update']);
        Route::delete('/{expenditure}', ['uses' => 'ExpenditureController@destroy']);
    }
); 







    
    

