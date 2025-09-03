<?php


use Illuminate\Support\Facades\Route;

// Controller for Frontend home
Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');

// Controller for Frontend Collection
Route::get('/collections', [App\Http\Controllers\Frontend\CollectionController::class, 'index'])->name('collection');
// Controller for Showing Category Products
Route::get('collection/{categorySlug}/{subcategorySlug}', [App\Http\Controllers\Frontend\CollectionController::class, 'show'])->name('collection.show');

// Controller for Frontend Shop
Route::get('/products', [App\Http\Controllers\Frontend\ShopController::class, 'index'])->name('shop');
// Controller for showing single shop product
Route::get('/product/{categorySlug}/{subcategorySlug}/{productSlug}', [App\Http\Controllers\Frontend\ShopController::class, 'showDetails'])->name('shop.details');

// Controller for product quick view modal
Route::get('/product/quick-view/{id}', [App\Http\Controllers\Frontend\ModalController::class, 'quickView'])->name('product-quickview');

// Controller for Frontend Contact
Route::get('/contact-us', [App\Http\Controllers\Frontend\ContactController::class, 'index'])->name('contact');
Route::post('/contact-us/submitting', [App\Http\Controllers\Frontend\ContactController::class, 'contactSubmit'])->name('contact.submit');

// Controller for Newsletter 
Route::post('/newsletter/subscribe', [App\Http\Controllers\Frontend\NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');
Route::post('/newsletter/hide-popup', [App\Http\Controllers\Frontend\NewsletterController::class, 'hidePopup'])->name('newsletter.hidePopup');
Route::get('/test-cookie', function () {
    return response('Cookie set')->cookie('hide_newsletter_popup', true, 5);
});

// User Authentication
Route::get('/user-login', [App\Http\Controllers\Frontend\LoginController::class, 'showLoginForm'])->name('user.login');
Route::post('/user-login-processing', [App\Http\Controllers\Frontend\LoginController::class, 'login'])->name('user.login.submit');

Route::get('/logout', [App\Http\Controllers\Frontend\LoginController::class, 'logout'])->name('user.logout');

Route::get('/user-register', [App\Http\Controllers\Frontend\LoginController::class, 'showRegisterForm'])->name('user.register');
Route::post('/user-register', [App\Http\Controllers\Frontend\LoginController::class, 'register'])->name('user.register.submit');

// OTP Verification
Route::get('/verify-code', [App\Http\Controllers\Frontend\LoginController::class, 'showVerifyCode'])->name('user.verify.code');
Route::post('/verify-code', [App\Http\Controllers\Frontend\LoginController::class, 'verifyCode'])->name('user.verify.code.submit');

// Password reset
Route::get('/forgot-password', [App\Http\Controllers\Password\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [App\Http\Controllers\Password\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [App\Http\Controllers\Password\ResetPasswordController::class, 'showResetForm'])->name('password.reset')->middleware('signed');
Route::post('/reset-password', [App\Http\Controllers\Password\ResetPasswordController::class, 'reset'])->name('password.update');


// Frontend Route with user auth middlelware
Route::middleware('user')->group(function () {
    // Controller for Frontend Cart
    Route::get('/cart-product', [App\Http\Controllers\Frontend\CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add/{id}', [App\Http\Controllers\Frontend\CartController::class, 'addToCart'])->name('cart.add');

    // Controller for Profile
    Route::get('/user/profile', [App\Http\Controllers\Frontend\ProfileController::class, 'index'])->name('user.profile');
    Route::get('/user/profile/edit', [App\Http\Controllers\Frontend\ProfileController::class, 'editProfile'])->name('user.profile.edit');
    Route::post('/user/profile/edit', [App\Http\Controllers\Frontend\ProfileController::class, 'updateProfile'])->name('user.profile.update');
    Route::get('/order/invoice/{id}', [App\Http\Controllers\Frontend\OrderController::class, 'download'])->name('order.invoice');
    Route::get('/order/success', [App\Http\Controllers\Frontend\OrderController::class, 'success'])->name('order.success');
    Route::get('/download/invoice/{filename}', [App\Http\Controllers\Frontend\OrderController::class, 'downloadInvoice'])->name('download.invoice');

    // Controller for product Review
    Route::post('/submit-review/{id}', [App\Http\Controllers\Frontend\ReviewController::class, 'store'])->name('review.store');
});

Route::prefix('administration')->group(function () {

    Route::get('/', function () {
        return redirect()->route('login'); // or route('admin.login') if renamed
    });

    // Auth Controller for Backend or Admin Panel
    Route::get('/login', [App\Http\Controllers\Backend\LoginController::class, 'loginForm'])->name('login');
    Route::post('/login-processing', [App\Http\Controllers\Backend\LoginController::class, 'login'])->name('login.submit');
    Route::post('/logout', [App\Http\Controllers\Backend\LoginController::class, 'logout'])->name('logout');

    // Backend Route with auth middleware
    Route::middleware('auth:admin')->group(function () {
        Route::get('/admin-dashboard', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('admin.dashboard');
        Route::resource('/banner', App\Http\Controllers\Backend\BannerController::class);
        Route::resource('/category', App\Http\Controllers\Backend\CategoryController::class);
        Route::resource('/sub-category', App\Http\Controllers\Backend\SubCategoryController::class);
        Route::resource('/products', App\Http\Controllers\Backend\ProductController::class);
        Route::resource('/users', App\Http\Controllers\Backend\UserController::class);
        Route::resource('/coupon', App\Http\Controllers\Backend\CouponController::class);
        Route::resource('/orders', App\Http\Controllers\Backend\OrderController::class);

        // Order Push Notification
        Route::get('notification/{id}', [App\Http\Controllers\Backend\NotificationController::class, 'show'])->name('notification.show');

        // Route group for settings
        Route::prefix('settings')->name('admin.setting.')->group(function () {
            // Route for general setting page
            Route::get('/', [App\Http\Controllers\Backend\SettingController::class, 'index'])->name('index');

            // Route for stmp mail setting
            Route::get('/smtp-email', [App\Http\Controllers\Backend\EmailSettingController::class, 'editEmailSettings'])->name('email.index');
            Route::post('/smtp-email/update', [App\Http\Controllers\Backend\EmailSettingController::class, 'updateEmailSettings'])->name('email.update');

            // For general setting
            Route::get('/general-setting', [App\Http\Controllers\Backend\GeneralSettingController::class, 'generalSettingIndex'])->name('general.index');
            Route::post('/general-setting/update', [App\Http\Controllers\Backend\GeneralSettingController::class, 'generalSettingUpdate'])->name('general.edit');
            
            // For settings for seo setting
            Route::resource('/seo', App\Http\Controllers\Backend\SeoSettingController::class);

            // For About shop page
            Route::get('/about', [App\Http\Controllers\Backend\AboutController::class, 'aboutIndex'])->name('about.index');
            Route::post('/about/update', [App\Http\Controllers\Backend\AboutController::class, 'aboutUpdate'])->name('about.update');

            // For Order Return page
            Route::get('/order-return-policy', [App\Http\Controllers\Backend\OrderReturnController::class, 'orderReturnIndex'])->name('order.return.policy');
        });
    });
});

// Error 404 Not Found
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
