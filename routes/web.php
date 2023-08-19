<?php

use App\Models\Permission;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\MFAController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\FaqController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\SiteMapController;
use App\Http\Controllers\WorldController;
use Illuminate\Support\Str;

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

Route::get('/qb', function () {
    function calculateExclusivePrice($inclusivePrice, $taxRate) {
        // Convert the tax rate to a decimal (e.g., 10% -> 0.1)
        $taxRateDecimal = $taxRate / 100;
    
        // Calculate the exclusive price
        $exclusivePrice = $inclusivePrice / (1 + $taxRateDecimal);
    
        return $exclusivePrice;
    }
//     $inclusivePrice = 120; // The inclusive price
// $taxRate = 10; // The tax rate as a percentage (10% in this example)
    $inclusivePrice = 34; // The inclusive price
$taxRate = 3; // The tax rate as a percentage (10% in this example)

$exclusivePrice = calculateExclusivePrice($inclusivePrice, $taxRate);
echo "Exclusive price: " . $exclusivePrice;
return;
    // $inclusivePrice - ($inclusivePrice / (1 + $taxRateDecimal));
    // dd( (34/(1+(3/100))));
        // File::put(base_path(), $load_data);
    return  format_price(565.45);
    }
);
// Auth

Route::get('{role}/login', [LoginController::class,'loginForm'])->name('login');
Route::post('{role}/login', [LoginController::class,'login']);
Route::post('logout', [LoginController::class,'logout'])->name('logout');
Route::post('/login-validate', [LoginController::class,'validateLoginByNumber'])->name('login-validate');
Route::get('/otp', [LoginController::class,'otp'])->name('otp-index');
Route::get('/auth-signup', [LoginController::class,'signup'])->name('signup');
Route::post('/signup-validate', [LoginController::class,'validateSignup'])->name('signup-validate');
Route::get('{role}/register', [RegisterController::class,'showRegistrationForm'])->name('register');
Route::post('/auth-otp-validate', [LoginController::class,'validateOTP'])->name('otp-validate');
Route::post('{role}/register', [RegisterController::class,'register']);

// Password
Route::get(
    'password/forget', function () {
        return view('auth.passwords.forgot');
    }
)->name('password.forget');
Route::post('password/email', [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class,'reset'])->name('password.update');

// Country State
Route::get('get-states', [WorldController::class,'getStates'])->name('world.get-states');
Route::get('get-cities', [WorldController::class,'getCities'])->name('world.get-cities');

// Site Route
Route::get('/', [HomeController::class,'index'])->name('index');
Route::get('/about', [HomeController::class,'about'])->name('about');
Route::get('page-error', [HomeController::class,'notFound'])->name('error.index');
Route::post('/newsletter/store', [HomeController::class,'newsletterStore'])->name('newsletter.store');
Route::get('/blogs', [BlogController::class,'index'])->name('blogs');
Route::get('/blog/{slug}', [BlogController::class,'show'])->name('blog.show');
// Route::get('/faqs', [FaqController::class,'index'])->name('faqs');
Route::get('/sub/categories/{id}', [HomeController::class,'subCategories'])->name('sub.categories');
Route::get('/category/{c_id}/sub-category/{s_id}/faq/{id?}', [FaqController::class,'index'])->name('faqs.index');



// Contact
Route::get('/contact', [ContactController::class,'index'])->name('contact');
Route::post('/contact/store', [ContactController::class,'store'])->name('contact.store');

// Page
Route::get('/page/{slug}', [HomeController::class,'page'])->name('page.slug');
Route::get('/thank-you', [HomeController::class,'thankYou'])->name('page.custom');

// Sitemap
Route::get('sitemap.xml', [SiteMapController::class,'index'])->name('sitemap.index');

// MFA
// Route::group(['middleware' => '2fa'], function () {
    Route::get('/mfa-checkpoint', [MFAController::class,'index'])->name('mfa-index');
    Route::post('/mfa-checkpoint', [MFAController::class,'store'])->name('mfa-store');
    Route::post(
        '/2fa', function () {
            return redirect(URL()->previous());
        }
    )->name('2fa')->middleware('2fa');
    Route::get('/mfa-reset-form', [MFAController::class,'resetForm'])->name('mfa-reset-form');
    Route::post('/mfa-reset', [MFAController::class,'mfaReset'])->name('mfa-reset');
    Route::get('/mfa-enabled', [MFAController::class,'mfaEnabled'])->name('mfa-enabled');
    // });


    Route::group(
        [], function () {
            include_once __DIR__ . '/user.php';
            include_once __DIR__ . '/admin.php';
            include_once __DIR__ . '/crudgen.php';
        }
    );