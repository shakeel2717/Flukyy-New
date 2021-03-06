<?php

use App\Http\Controllers\adminAuth;
use App\Http\Controllers\adminDashboard;
use App\Http\Controllers\AdvertisementController;
use App\Http\Controllers\contestController;
use App\Http\Controllers\convertController;
use App\Http\Controllers\dashboard;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\profile;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\userAuth;
use App\Http\Controllers\VoteController;
use App\Models\transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CouponController;

Route::get('/',[LandingPageController::class ,'index'])->name('landing.index');
Route::redirect('/login', 'authentication/login');
Route::redirect('/register', 'authentication/register');
Route::redirect('/reset', 'authentication/reset');
Route::redirect('/logout', 'authentication/logout');
Route::redirect('/dashboard', 'dashboard/index');
Route::prefix('/authentication')->group(function () {
    Route::get('/login', [userAuth::class, 'login'])->name('login');
    Route::post('/loginReq', [userAuth::class, 'loginReq'])->name('loginReq');

    Route::get('/register', [userAuth::class, 'register'])->name('register');
    Route::post('/registerReq', [userAuth::class, 'registerReq'])->name('registerReq');

    // user Created, Email Verification Notice
    Route::get('/email-verification', [userAuth::class, 'emailVerification'])->name('emailVerification');
    Route::get('/resendEmail', [userAuth::class, 'resendEmail'])->name('resendEmail');

    // Reset Password Request
    Route::get('/reset', [userAuth::class, 'resetPassword'])->name('resetPassword');
    Route::post('/resetPasswordReq', [userAuth::class, 'resetPasswordReq'])->name('resetPasswordReq');

    // Logout from System
    Route::get('/logout', [userAuth::class, 'logout'])->name('logout');
});
// user Click on Email from Their Email
Route::get('/verify/{token?}', [userAuth::class, 'verifyUserEmail'])->name('verifyUserEmail');
Route::get('/email-verified', [userAuth::class, 'emailVerified'])->name('emailVerified');

Route::get('/reset/{token?}', [userAuth::class, 'setPassword'])->name('setPassword');
Route::post('/setPasswordReq', [userAuth::class, 'setPasswordReq'])->name('setPasswordReq');
Route::get('/password-changed', [userAuth::class, 'passwordChanged'])->name('passwordChanged');




Route::prefix('dashboard')->middleware(['auth'])->group(function () {
    Route::get('/index', [dashboard::class, 'index'])->name('dashboard');
    Route::resource('support', SupportController::class);
    Route::get('/profile', [profile::class, 'index'])->name('profile');
    Route::post('/profile', [profile::class, 'profileReq'])->name('profileReq');
    Route::post('/changePasswordReq', [profile::class, 'changePasswordReq'])->name('changePasswordReq');
    
    // // Convert USD To Token
    // Route::get('/usd-token', [convertController::class, 'usdToToken'])->name('usdToToken');
    // Route::post('/usd-token', [convertController::class, 'usdToTokenReq'])->name('usdToTokenReq');
    
    Route::get('/token-usd', [convertController::class, 'tokenToUsd'])->name('tokenToUsd');
    Route::post('/token-usd', [convertController::class, 'tokenToUsdReq'])->name('tokenToUsdReq');
    Route::get('/token-share', [convertController::class, 'tokenShare'])->name('tokenShare');
    Route::post('/token-share', [convertController::class, 'tokenShareReq'])->name('tokenShareReq');
    
    
    Route::resource('advertisement', AdvertisementController::class);
    Route::resource('vote', VoteController::class);
    Route::post('/contestParticepateReq', [contestController::class, 'contestParticepateReq'])->name('contestParticepateReq');
    
    
    Route::get('/contest-record', [dashboard::class, 'contestRecord'])->name('contestRecord');
    
    
    Route::get('/usd/history', [HistoryController::class, 'usdHistory'])->name('usdHistory');
    Route::get('/token/history', [HistoryController::class, 'tokenHistory'])->name('tokenHistory');
    Route::get('/reward/history', [HistoryController::class, 'rewardHistory'])->name('rewardHistory');
    Route::get('/refer/history', [HistoryController::class, 'referHistory'])->name('referHistory');
    Route::get('/coupon/activate', [CouponController::class, 'couponActivate'])->name('coupon.activate');
    Route::post('/coupon/activate', [CouponController::class, 'couponActiveReq'])->name('couponActive.store');
    
    Route::resource('coupon', CouponController::class);


    


});


Route::prefix('admin')->group(function () {
    Route::get('/authenticate/login', [adminAuth::class, 'login'])->name('adminlogin');
    Route::post('/authenticate/login', [adminAuth::class, 'loginReq'])->name('adminLoginReq');
});



Route::prefix('admin/dashboard')->middleware(['admin'])->group(function () {
    Route::get('/index', [adminDashboard::class, 'index'])->name('adminDashboard');
    Route::get('/all-users', [adminDashboard::class, 'allUsers'])->name('allUsers');
    Route::get('/all-supports', [adminDashboard::class, 'allSupports'])->name('allSupports');
    Route::get('/insert-balance', [adminDashboard::class, 'insertBalance'])->name('insertBalance');
    Route::post('/insert-balance', [adminDashboard::class, 'insertBalanceReq'])->name('insertBalanceReq');
    Route::post('/contestStore', [contestController::class, 'store'])->name('contest.store');
    Route::post('/couponAdmin', [adminDashboard::class, 'couponAdmin'])->name('coupon.admin.store');
    
    
});