<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BulkController;
use App\Http\Controllers\Admin\WalletLogController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PayoutController;
use App\Http\Controllers\Admin\WebsiteEnquiryController;
use App\Http\Controllers\Admin\SupportTicketController;
use App\Http\Controllers\Admin\ConversationController;
use App\Http\Controllers\Admin\NewsLetterController;
use App\Http\Controllers\Admin\EmailComposerController;
use App\Http\Controllers\Admin\LeadController;
use App\Http\Controllers\Admin\UserNoteController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\PayoutDetailController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\MailSmsTemplateController;
use App\Http\Controllers\Admin\CategoryTypeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SliderTypeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ParagraphContentController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LocationController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\FeatureActivationController;
use App\Http\Controllers\Admin\WebsitePageController;
use App\Http\Controllers\Admin\GeneralController;
use App\Http\Controllers\Admin\MailController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\SeoTagController;
use App\Http\Controllers\Admin\BroadcastController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\UserAddressController;
use App\Http\Controllers\Admin\ZDeployerController;
use App\Http\Middleware\Authenticate;




Route::group(
    ['middleware' => 'web', 'prefix' => 'deployer', 'as' => 'deployer.', 'controller' => ZDeployerController::class], function () {
        Route::get('/', 'handle')->name('index');
    }
);
Route::group(
    ['middleware' => ['auth','2fa','role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    
    
        Route::group(
            ['prefix' => 'media', 'as' => 'media.', 'controller' => MediaController::class], function () {
                Route::get('/destroy', 'destroy')->name('destroy');
                Route::get('/destroy/{id}', 'destroyById')->name('single-destroy');
                Route::post('ckeditor/upload', 'ckeditorUpload')->name('ckeditor.upload');
                // Route::get('/module/create', 'createModule')->name('module.crud');
            }
        );
        Route::group(
            ['prefix' => 'dashboard', 'as' => 'dashboard.', 'controller' => DashboardController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/logout-as', 'logoutAs')->name('logout-as');
                // Route::get('/module/create', 'createModule')->name('module.crud');
            }
        );
        Route::group(
            ['prefix' => 'broadcast', 'as' => 'broadcast.', 'controller' => BroadcastController::class], function () {
                Route::post('/', 'index')->name('index');
                Route::post('role/record', 'roleWiseRecord');
            }
        );
        Route::group(
            ['prefix' => 'profile', 'as' => 'profile.', 'controller' => ProfileController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::post('update/{id}', 'update')->name('update');
                Route::post('update/password/{id}', 'updatePassword')->name('update.password');
                Route::post('update/profile-img/{id}', 'updateProfileImg')->name('update.profile-img');
            }
        );
        Route::group(
            ['prefix' => 'orders', 'as' => 'orders.', 'controller' => OrderController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_orders');
                Route::any('print', 'print')->name('print');
                Route::get('create', 'create')->name('create')->middleware('permission:add_order');
                Route::post('store', 'store')->name('store');
                Route::get('show/{order}', 'show')->name('show')->middleware('permission:show_order');
                Route::get('update/status/{order}', 'updateStatus')->name('status-update');
                Route::get('update/payment-status/{order}', 'updatePaymentStatus')->name('payment-status-update');
                Route::get('invoice/{order}', 'invoice')->name('invoice');
                Route::get('delivery-receipt', 'deliveryReceipt')->name('delivery-receipt');
                Route::post('bulk-action', 'bulkAction')->name('bulk-action');
                Route::get('/getUser', 'getUser')->name('getUser');
                Route::post('/get-user-address', 'getUserAddress')->name('getUserAddress');
                Route::post('/get-seller-address', 'getSellerAddress')->name('getSellerAddress');
            }
        );
        Route::group(
            ['prefix' => 'users','as'=> 'users.','controller' => UserController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::any('print', 'print')->name('print');
                Route::get('create', 'create')->name('create')->middleware('permission:add_user');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{user}', 'edit')->name('edit')->middleware('permission:edit_user');
                Route::get('show/{user}', 'show')->name('show');
                Route::get('destroy/{user}', 'destroy')->name('destroy');
                Route::post('update/{user}', 'update')->name('update');
                Route::get('update/status/{id}/{s}', 'updateStatus')->name('update-status');
                Route::get('login-as/{id}/', 'loginAs')->name('login-as');
                Route::post('bulk-action', 'bulkAction')->name('bulk-action');
                Route::post('/kyc-status', 'updateKycStatus')->name('update-kyc-status');
                Route::post('/user/update-password/{id}', 'updateUserPassword')->name('update-user-password');
                Route::get('get/users', 'getUsers')->name('get-users');
                Route::get('/user-delete', 'userDelete')->name('userDelete');
            }
        );
        Route::group(
            ['prefix' => 'addresses','as'=> 'addresses.','controller' => UserAddressController::class], function () {
                Route::post('store', 'store')->name('store');
                Route::post('update', 'update')->name('update');
                Route::get('destroy/{userAddress}', 'destroy')->name('destroy');
            }
        );
        Route::group(
            ['prefix' => 'payout-details', 'as' => 'payout-details.', 'controller' => PayoutDetailController::class], function () {
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::get('/destroy/{payoutDetail}', 'destroy')->name('destroy');
            }
        );
        Route::group(
            ['prefix' => 'roles', 'as' => 'roles.','controller' => RoleController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_roles');
                Route::post('store', 'store')->name('store');
                Route::get('edit/{role}', 'edit')->name('edit')->middleware('permission:edit_role');
                Route::post('update/{id}', 'update')->name('update');
                Route::get('destroy/{role}', 'destroy')->name('destroy');
            }
        );
        Route::group(
            ['prefix' =>'permissions','as' => 'permissions.','controller' => PermissionController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_permissions');
                Route::post('store', 'store')->name('store');
                Route::get('destroy/{id}', 'destroy')->name('destroy');
            }
        );
        Route::group(
            ['prefix' => 'bulk', 'as' => 'bulk.', 'controller' => BulkController::class], function () {
                Route::post('user', 'user')->name('user');
            }
        );
        Route::group(
            ['prefix' => 'wallet-logs', 'as' => 'wallet-logs.', 'controller' => WalletLogController::class], function () {
                Route::get('user/{id}/', 'index')->name('index')->middleware('permission:control_wallet');
                Route::get('status/{walletLog}/{status}', 'status')->name('status');
                Route::post('/update', 'update')->name('update');
            }
        );
    
        Route::group(
            ['prefix' => 'website-pages', 'as' => 'website-pages.', 'controller' => WebsitePageController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_pages');
                Route::get('/create', 'create')->name('create')->middleware('permission:add_page');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{id}', 'edit')->name('edit')->middleware('permission:edit_page');
                Route::get('/show/{websitePage}', 'show')->name('show');
                Route::post('/update/{websitePage}', 'update')->name('update');
                Route::get('/destroy/{websitePage}', 'destroy')->name('destroy')->middleware('permission:delete_page');
                Route::get('/delete-media/{websitePage}', 'destroyMedia')->name('destroy-media');
                Route::get('/appearance', 'appearance')->name('appearance');
                Route::post('/bulk-action', 'bulkAction')->name('bulk-action');
            }
        );
        Route::group(
            ['prefix' => 'payouts', 'as' => 'payouts.', 'controller' => PayoutController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_payouts');
                Route::get('/create', 'create')->name('create')->middleware('permission:add_payouts');
                Route::post('/store', 'store')->name('store');
                Route::get('/show/{payout}', 'show')->name('show')->middleware('permission:show_payout');
                Route::get('/delete/{payout}', 'destroy')->name('delete');
                Route::post('/status/{payout}', 'status')->name('status');
                Route::any('/print', 'print')->name('print');
                Route::any('/bulk-action', 'bulkAction')->name('bulk-action');
            }
        );
        Route::group(
            ['prefix' => 'support-tickets', 'as' => 'support-tickets.', 'controller' => SupportTicketController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_tickets');
                Route::get('/create', 'create')->name('create')->middleware('permission:add_ticket');
                Route::post('/store', 'store')->name('store');
                Route::post('/bulk-delete', 'bulkAction')->name('bulk-delete');
                Route::get('/edit/{supportTicket}', 'edit')->name('edit')->middleware('permission:edit_ticket');
                Route::get('/show/{supportTicket}', 'show')->name('show')->middleware('permission:show_ticket');
                Route::post('/add-attachment/{supportTicket}', 'addAttachment')->name('add-attachment');
                Route::get('/status/{supportTicket}/{status}', 'status')->name('status');
                Route::post('/update/{supportTicket}', 'update')->name('update');
                Route::get('/reply', 'reply')->name('reply');
                Route::any('/print', 'print')->name('print');
                Route::get('/destroy/{supportTicket}', 'destroy')->name('destroy')->middleware('permission:delete_ticket');
            }
        );
        Route::group(
            ['prefix' => 'conversations', 'as' => 'conversations.', 'controller' => ConversationController::class], function () {
                Route::post('/store', 'store')->name('store');
                Route::any('/destroy', 'destroy')->name('destroy');
            }
        );
        Route::group(
            ['prefix' => 'news-letters', 'as' => 'news-letters.', 'controller' => NewsLetterController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_newletters');
                Route::get('/create', 'create')->name('create')->middleware('permission:add_newletter');
                Route::post('/store', 'store')->name('store')->middleware('permission:add_newletter');
                Route::get('/edit/{newsLetter}', 'edit')->name('edit')->middleware('permission:edit_newletter');
                Route::get('/show/{newsLetter}', 'show')->name('show')->middleware('permission:show_newletter');
                Route::post('/update/{newsLetter}', 'update')->name('update');
                Route::any('/print', 'print')->name('print');
                Route::get('/destroy/{newsLetter}', 'destroy')->name('destroy')->middleware('permission:delete_newletter');
                Route::get('/launchcampaign', 'launchcampaign')->name('launchcampaign');
                Route::post('/runcampaign', 'runcampaign')->name('runcampaign');
                Route::post('bulk-action', 'bulkAction')->name('bulk-action');
            }
        );
        Route::group(
            ['prefix' => 'compose-emails', 'as' => 'compose-emails.', 'controller' => EmailComposerController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::post('/get-template', 'getTemplate')->name('get-template');
                Route::post('/send', 'send')->name('send');
            }
        );
        Route::group(
            ['prefix' => 'website-enquiries', 'as' => 'website-enquiries.', 'controller' => WebsiteEnquiryController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_enquiries');
                Route::get('/create', 'create')->name('create')->middleware('permission:add_enquiry');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{websiteEnquiry}', 'edit')->name('edit')->middleware('permission:edit_enquiry');
                Route::get('/show/{websiteEnquiry}', 'show')->name('show')->middleware('permission:show_enquiry');
                Route::post('/update/{websiteEnquiry}', 'update')->name('update');
                Route::any('/print', 'print')->name('print');
                Route::get('/destroy/{websiteEnquiry}', 'destroy')->name('destroy')->middleware('permission:delete_enquiry');
                Route::post('bulk-action', 'bulkAction')->name('bulk-action');
                Route::get('update/status/{websiteEnquiry}', 'status')->name('status-update');
            }
        );
        Route::group(
            ['prefix' => 'leads', 'as' => 'leads.', 'controller' => LeadController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_leads');
                Route::get('/create', 'create')->name('create')->middleware('permission:add_lead');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{lead}', 'edit')->name('edit')->middleware('permission:edit_lead');
                Route::get('/show/{lead}', 'show')->name('show');
                Route::post('/update/{lead}', 'update')->name('update');
                Route::any('/print', 'print')->name('print');
                Route::get('/destroy/{lead}', 'destroy')->name('destroy')->middleware('permission:delete_lead');


                Route::post('bulk-action', 'bulkAction')->name('bulk-action');

                Route::post('/bulk-delete', 'bulkAction')->name('bulk-delete');
            }
        );
        Route::group(
            ['prefix' => 'user-notes', 'as' => 'user-notes.', 'controller' => UserNoteController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{userNote}', 'edit')->name('edit');
                Route::get('/show/{userNote}', 'show')->name('show');
                Route::post('/update/{userNote}', 'update')->name('update');
                Route::any('/print', 'print')->name('print');
                Route::get('/destroy/{userNote}', 'destroy')->name('destroy');
                Route::post('bulk-action', 'bulkAction')->name('bulk-action');
            }
        );
        Route::group(
            ['prefix' => 'contacts', 'as' => 'contacts.', 'controller' => ContactController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{contact}', 'edit')->name('edit');
                Route::get('/show/{contact}', 'show')->name('show');
                Route::post('/update/{contact}', 'update')->name('update');
                Route::any('/print', 'print')->name('print');
                Route::get('/destroy/{contact}', 'destroy')->name('destroy');
                Route::post('bulk-action', 'bulkAction')->name('bulk-action');
            }
        );
        Route::group(
            ['prefix' => 'blogs', 'as' => 'blogs.', 'controller' => BlogController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_blogs');
                Route::get('/create', 'create')->name('create')->middleware('permission:add_blog');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{blog}', 'edit')->name('edit')->middleware('permission:edit_blog');
                Route::get('/{blog}', 'show')->name('show')->middleware('permission:edit_blog');
                Route::post('/update/{blog}', 'update')->name('update');
                Route::any('/print', 'print')->name('print');
                Route::get('/destroy/{blog}', 'destroy')->name('destroy')->middleware('permission:delete_blog');
                Route::get('/delete-media/{blog}', 'destroyMedia')->name('destroy-media');
                Route::post('bulk-action', 'bulkAction')->name('bulk-action');
                Route::post('ckeditor/upload', 'ckeditorUpload')->name('ckeditor.upload');
            }
        );
      
    Route::group(['prefix' => 'mail-sms-templates', 'as' => 'mail-sms-templates.', 'controller' => MailSmsTemplateController::class],function () {
        Route::get('/', 'index')->name('index')->middleware('permission:view_mail_templates');
        Route::get('/create', 'create')->name('create')->middleware('permission:add_mail_template');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{mailSmsTemplate}', 'edit')->name('edit')->middleware('permission:edit_mail_template');
        Route::get('/show/{mailSmsTemplate}', 'show')->name('show');
        Route::post('/update/{mailSmsTemplate}', 'update')->name('update');
        Route::any('/print','print')->name('print');
        Route::get('/destroy/{mailSmsTemplate}', 'destroy')->name('destroy')->middleware('permission:delete_mail_template');
        Route::post('bulk-action', 'bulkAction')->name('bulk-action');
    });
    Route::group(['prefix' => 'category-types', 'as' => 'category-types.', 'controller' => CategoryTypeController::class],function () {
        Route::get('/', 'index')->name('index')->middleware('permission:view_categories');
        Route::get('/create', 'create')->name('create')->middleware('permission:add_category');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{categoryType}', 'edit')->name('edit')->middleware('permission:edit_category');
        Route::get('/show/{categoryType}', 'show')->name('show');
        Route::post('/update/{categoryType}', 'update')->name('update');
        Route::post('more-action', 'moreAction',)->name('more-action');
        Route::any('/print','print')->name('print');
        Route::get('/destroy/{categoryType}', 'destroy')->name('destroy')->middleware('permission:delete_category');
        Route::post('bulk-action', 'bulkAction')->name('bulk-action');
    });
    Route::group(['prefix' => 'categories', 'as' => 'categories.', 'controller' => CategoryController::class],function () {
        Route::get('/{categoryTypeId}', 'index')->name('index');
        Route::get('/create/{categoryTypeId}/{level?}/{parent_id?}', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{category}', 'edit')->name('edit');
        Route::get('/show/{category}', 'show')->name('show');
        Route::post('/update/{category}', 'update')->name('update');
        Route::post('more-action', 'moreAction',)->name('more-action');
        Route::any('/print','print')->name('print');
        Route::get('/destroy/{category}', 'destroy')->name('destroy');
        Route::post('bulk-action', 'bulkAction')->name('bulk-action');
    });
    Route::group(['prefix' => 'slider-types', 'as' => 'slider-types.', 'controller' => SliderTypeController::class],function () {
        Route::get('/', 'index')->name('index')->middleware('permission:view_sliders');
        Route::get('/create', 'create')->name('create')->middleware('permission:add_slider');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{sliderType}', 'edit')->name('edit')->middleware('permission:edit_slider');
        Route::get('/show/{sliderType}', 'show')->name('show');
        Route::post('/update/{sliderType}', 'update')->name('update');
        Route::any('/print','print')->name('print');
        Route::get('/destroy/{sliderType}', 'destroy')->name('destroy')->middleware('permission:delete_slider');
        Route::post('bulk-action', 'bulkAction')->name('bulk-action');
    });
    Route::group(['prefix' => 'sliders', 'as' => 'sliders.', 'controller' => SliderController::class],function () {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{slider}', 'edit')->name('edit');
        Route::get('/show/{slider}', 'show')->name('show');
        Route::post('/update/{slider}', 'update')->name('update');
        Route::any('/print','print')->name('print');
        Route::get('/destroy/{slider}', 'destroy')->name('destroy');
        Route::get('/delete-media/{slider}', 'destroyMedia')->name('destroy-media');
        Route::post('bulk-action', 'bulkAction')->name('bulk-action');
    });
    Route::group(['prefix' => 'paragraph-contents', 'as' => 'paragraph-contents.', 'controller' => ParagraphContentController::class],function () {
        Route::get('/', 'index')->name('index')->middleware('permission:view_paragraph_contents');
        Route::get('/create', 'create')->name('create')->middleware('permission:add_paragraph_content');
        Route::post('/store', 'store')->name('store');
        Route::post('/custom-update', 'customUpdate')->name('custom-update');
        Route::get('/edit/{ParagraphContent}', 'edit')->name('edit')->middleware('permission:edit_paragraph_content');
        Route::get('/show/{ParagraphContent}', 'show')->name('show');
        Route::post('/update/{paragraphContent}', 'update')->name('update');
        Route::get('/destroy/{ParagraphContent}', 'destroy')->name('destroy')->middleware('permission:delete_paragraph_content');
        Route::post('bulk-action', 'bulkAction')->name('bulk-action');
    });
    Route::group(['prefix' => 'faqs', 'as' => 'faqs.', 'controller' => FaqController::class],function () {
        Route::get('/', 'index')->name('index')->middleware('permission:view_faqs');
        Route::get('/create', 'create')->name('create')->middleware('permission:add_faq');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{faq}', 'edit')->name('edit')->middleware('permission:edit_faq');
        Route::get('/show/{faq}', 'show')->name('show');
        Route::post('/update/{faq}', 'update')->name('update');
        Route::any('/print','print')->name('print');
        Route::get('/destroy/{faq}', 'destroy')->name('destroy')->middleware('permission:delete_faq');
        Route::post('bulk-action', 'bulkAction')->name('bulk-action');
    });
    Route::group(['prefix' => 'locations', 'as' => 'locations.', 'controller' => LocationController::class],function () {
        Route::get('/country','country')->name('country')->middleware('permission:view_locations');
        Route::get('/country/create','create')->name('country.create')->middleware('permission:add_location');
        Route::post('/country/store','store')->name('country.store');
        Route::get('/country/edit/{id}','edit')->name('country.edit')->middleware('permission:edit_location');
        Route::post('/country/update/{id}','update')->name('country.update');
        Route::get('/state','state')->name('state');
        Route::post('/state/store','stateStore')->name('state.store');
        Route::post('/state/update','stateUpdate')->name('state.update');
        Route::get('/city','city')->name('city');
        Route::post('/city/store','cityStore')->name('city.store');
        Route::post('/city/update','cityUpdate')->name('city.update');
    });
    Route::group(['prefix' => 'setting', 'as' => 'setting.', 'controller' => SettingController::class],function () {
        Route::get('/','index')->name('index')->middleware('permission:control_basic_details');
        Route::post('/store','store')->name('store');
    });
    Route::group(['prefix' => 'setting', 'as' => 'setting.', 'controller' => FeatureActivationController::class],function () {
            Route::get('/features-activation', 'featuresActivationIndex')->name('features-activation');
            Route::post('/features-activation/store', 'featuresActivationStore')->name('features-activation.store');
        }
    );
        Route::group(
            ['prefix' => 'website-pages', 'as' => 'website-pages.', 'controller' => WebsitePageController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_pages');
                Route::get('/create', 'create')->name('create')->middleware('permission:add_page');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{websitePage}', 'edit')->name('edit')->middleware('permission:edit_page');
                Route::get('/show/{websitePage}', 'show')->name('show');
                Route::post('/update/{websitePage}', 'update')->name('update');
                Route::get('/destroy/{websitePage}', 'destroy')->name('destroy')->middleware('permission:delete_page');
                Route::get('/delete-media/{websitePage}', 'destroyMedia')->name('destroy-media');
                Route::get('/appearance', 'appearance')->name('appearance');
                Route::get('/social-login', 'socialLogin')->name('social-login')->middleware('permission:control_social_logins_details');
                Route::post('/bulk-action', 'bulkAction')->name('bulk-action');
            }
        );
        Route::group(
            ['prefix' => 'general', 'as' => 'general.', 'controller' => GeneralController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:access_general_setting');
                Route::get('/storage-link', 'storageLink')->name('storage-link');
                Route::get('/optimize-clear', 'optimizeClear')->name('optimize-clear');
                Route::get('/session-clear', 'sessionClear')->name('session-clear');
                Route::get('/content-group', 'contentGroup')->name('content-group');

            }
        );
        Route::group(
            ['prefix' => 'notifications', 'as' => 'notifications.', 'controller' =>NotificationController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/update/{notification}', 'update')->name('update');
            }
        );
        Route::group(
            ['prefix' => 'mail-sms-configuration', 'as' => 'mail-sms-configuration.', 'controller' => MailController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::post('/mail', 'storeMail')->name('mail.store');
                Route::post('/sms', 'storeSMS')->name('sms.store');
                Route::post('/notification', 'storePushNotification')->name('notification.store');
                Route::post('test', 'testSend')->name('test.send');

            }
        );
        Route::group(
            ['prefix' => 'seo-tags', 'as' => 'seo-tags.', 'controller' => SeoTagController::class], function () {
                Route::get('/', 'index')->name('index')->middleware('permission:view_seo_tags');
                Route::any('print', 'print')->name('print');
                Route::get('/create', 'create')->name('create');
                Route::post('/store', 'store')->name('store');
                Route::get('/edit/{seoTag}', 'edit')->name('edit')->middleware('permission:edit_seo_tag');
                Route::get('/show/{seoTag}', 'show')->name('show');
                Route::post('/update/{seoTag}', 'update')->name('update');
                Route::get('/destroy/{seoTag}', 'destroy')->name('destroy')->middleware('permission:delete_seo_tag');
                Route::post('bulk-action', 'bulkAction')->name('bulk-delete');
            }
        );

        Route::group(
            ['namespace' => 'App\Http\Controllers\Admin', 'prefix' => '/items','as' =>'items.'], function () {
                Route::get('', ['uses' => 'ItemController@index', 'as' => 'index'])->middleware('permission:view_items');
                Route::any('/print', ['uses' => 'ItemController@print', 'as' => 'print']);
                Route::get('create', ['uses' => 'ItemController@create', 'as' => 'create'])->middleware('permission:add_item');
                Route::post('store', ['uses' => 'ItemController@store', 'as' => 'store']);
                Route::get('/{item}', ['uses' => 'ItemController@show', 'as' => 'show']);
                Route::get('edit/{item}', ['uses' => 'ItemController@edit', 'as' => 'edit'])->middleware('permission:edit_item');
                Route::post('update/{item}', ['uses' => 'ItemController@update', 'as' => 'update']);
                Route::get('delete/{item}', ['uses' => 'ItemController@destroy', 'as' => 'destroy'])->middleware('permission:delete_item');      
                Route::get('delete-media/{item}', ['uses' => 'ItemController@destroyMedia', 'as' => 'destroy-media']);
                Route::post('bulk-action', ['uses' => 'ItemController@bulkAction', 'as' => 'bulk-action']);
                Route::get('get/items', ['uses' => 'ItemController@getItems', 'as' => 'get-items']);
            }
        );
        Route::group(
            ['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'subscriptions','as' =>'subscriptions.'], function () {
                Route::get('', ['uses' => 'SubscriptionController@index', 'as' => 'index'])->middleware('permission:view_subscription_plans');
                Route::any('/print', ['uses' => 'SubscriptionController@print', 'as' => 'print']);
                Route::get('create', ['uses' => 'SubscriptionController@create', 'as' => 'create'])->middleware('permission:add_subscription_plan');
                Route::post('store', ['uses' => 'SubscriptionController@store', 'as' => 'store'])->middleware('permission:add_subscription_plan');
                Route::get('/{subscription}', ['uses' => 'SubscriptionController@show', 'as' => 'show']);
                Route::get('edit/{subscription}', ['uses' => 'SubscriptionController@edit', 'as' => 'edit'])->middleware('permission:edit_subscription_plan');
                Route::post('update/{subscription}', ['uses' => 'SubscriptionController@update', 'as' => 'update']);
                Route::get('delete/{subscription}', ['uses' => 'SubscriptionController@destroy', 'as' => 'destroy'])->middleware('permission:delete_subscription_plan');;
                Route::post('/bulk-action', ['uses' => 'SubscriptionController@bulkAction', 'as' => 'bulk-action']);
            }
        ); 

        Route::group(
            ['namespace' => 'App\Http\Controllers\Admin', 'prefix' => 'user-subscriptions','as' =>'user-subscriptions.'], function () {
                Route::get('', ['uses' => 'UserSubscriptionController@index', 'as' => 'index']);
                Route::any('/print', ['uses' => 'UserSubscriptionController@print', 'as' => 'print']);
                Route::get('create', ['uses' => 'UserSubscriptionController@create', 'as' => 'create']);
                Route::post('store', ['uses' => 'UserSubscriptionController@store', 'as' => 'store']);
                Route::get('/{user_subscription}', ['uses' => 'UserSubscriptionController@show', 'as' => 'show']);
                Route::get('edit/{user_subscription}', ['uses' => 'UserSubscriptionController@edit', 'as' => 'edit']);
                Route::post('update/{user_subscription}', ['uses' => 'UserSubscriptionController@update', 'as' => 'update']);
                Route::get('delete/{user_subscription}', ['uses' => 'UserSubscriptionController@destroy', 'as' => 'destroy']);
                Route::get('get/user-subscription-data', ['uses' => 'UserSubscriptionController@getUserSubscriptionData', 'as' => 'get-user-subscription-data']);
            }
        ); 

    
    
    }
);