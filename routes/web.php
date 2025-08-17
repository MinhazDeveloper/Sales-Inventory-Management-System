<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\SalesReportController;
use App\Http\Middleware\TokenverifyMiddleware;

// Page routes
Route::get('/', [UserController::class, 'index'])->name('login');
Route::get('registration', [UserController::class, 'registrationPage'])->name('regPage');
Route::get('send-otp', [UserController::class, 'sendOTPCode'])->name('sendOTP');
Route::get('submit-otp', [UserController::class, 'submitOTP']);

// User routes
Route::post('saveRegistration', [UserController::class, 'saveRegistration'])->name('saveReg');
Route::post('userLogin', [UserController::class, 'userLogin'])->name('userLog');
Route::post('get-otp', [UserController::class, 'getOTPCode'])->name('getOTP')
        ->middleware(TokenverifyMiddleware::class); 

Route::post('verify-otp', [UserController::class, 'verifyOTP'])->name('verifyOTPcode')
        ->middleware(TokenverifyMiddleware::class); 

Route::post('reset-password', [UserController::class, 'resetPassword'])
        ->name('resetPassword')
        ->middleware(TokenverifyMiddleware::class); 
Route::post('forgetPassword', [UserController::class, 'forgetPassword'])->name('forgetPass');

// Dashboard route
Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard')
        ->middleware(TokenverifyMiddleware::class);

//user profile
Route::get('userProfile', [UserController::class, 'userProfilePage'])->name('userProfile')
        ->middleware(TokenverifyMiddleware::class); 
Route::get('user-profile', [UserController::class, 'userProfileData'])->name('profileData')
        ->middleware(TokenverifyMiddleware::class); 
Route::put('profile-update', [UserController::class, 'userProfileUpdate'])->name('profileUpdate')
        ->middleware(TokenverifyMiddleware::class); 

//Category route
Route::middleware([TokenverifyMiddleware::class])->group(function () {
    Route::get('category-page', [CategoryController::class, 'categoryPage'])->name('categoryPage');
    Route::get('category-create', [CategoryController::class, 'categoryCreate'])->name('categoryCreate');
    Route::post('category-save', [CategoryController::class, 'categorySave'])->name('categorySave');
    Route::get('categories/{id}/edit', [CategoryController::class, 'categoryId'])->name('categories.id');
    Route::put('category-update/{id}', [CategoryController::class, 'categoryUpdate'])->name('categoryUpdate');
    Route::delete('/categories/{id}', [CategoryController::class, 'categoryDelete'])->name('category.destroy');
});
//customer route
Route::middleware([TokenverifyMiddleware::class])->group(function () {
    Route::get('customer-page', [CustomerController::class, 'customerPage'])->name('customerPage');
    Route::get('customer-create', [CustomerController::class, 'customerCreate'])->name('customerCreate');
    Route::post('customer-save', [CustomerController::class, 'customerSave'])->name('customerSave');
    Route::get('customer/{id}/edit', [CustomerController::class, 'customerId'])->name('customerId');
    Route::put('customer-update/{id}', [CustomerController::class, 'customerUpdate'])->name('customerUpdate');
    Route::delete('/customer/{id}', [CustomerController::class, 'customerDelete'])->name('customer.destroy');
});
//product route
Route::middleware([TokenverifyMiddleware::class])->group(function () {
    Route::get('product-page', [ProductController::class, 'productPage'])->name('productPage');
    Route::get('product-create', [ProductController::class, 'productCreate'])->name('productCreate');
    Route::post('product-store', [ProductController::class, 'productStore'])->name('productStore');
    Route::get('product/{id}/edit', [ProductController::class, 'productId'])->name('productId');
    Route::put('product-update/{id}', [ProductController::class, 'productUpdate'])->name('productUpdate');
    Route::delete('product/{id}', [ProductController::class, 'productDelete'])->name('product.destroy');    
});
//invoice route
Route::middleware([TokenverifyMiddleware::class])->group(function () {
    Route::get('/create-invoice', [InvoiceController::class, 'invoiceCreate'])->name('invoiceCreate');
    Route::post('invoice-save', [InvoiceController::class, 'invoiceSave'])->name('invoiceSave');
    Route::get('/sales-invoice/{id}', [InvoiceController::class, 'invoice'])->name('sales.invoice');
    Route::get('invoice/{id}/download', [InvoiceController::class, 'downloadInvoice'])->name('invoice.download');

});
//report route
Route::middleware([TokenverifyMiddleware::class])->group(function () {
        Route::get('/sales-report', [SalesReportController::class, 'index'])->name('reportForm');
        Route::post('/sales-report-generate', [SalesReportController::class, 'generate'])->name('sales.report.generate');

});
//dashboard route
Route::middleware([TokenverifyMiddleware::class])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('summary', [DashboardController::class, 'summary'])->name('summary');

});

//logout
Route::post('logout',[UserController::class,'userLogout'])->name('logout');
