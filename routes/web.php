<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BlogController as AdminBlogController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CustomerController as AdminCustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\BannerController as ControllersBannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;


Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/about-us', [HomeController::class, 'about'])->name('home.about');
Route::get('/contact', [HomeController::class, 'contact'])->name('home.contact');
Route::get('/our_blog', [HomeController::class, 'our_blog'])->name('home.our_blog');
Route::get('/services_details', [HomeController::class, 'services_details'])->name('home.services_details');
Route::get('/services', [HomeController::class, 'services'])->name('home.services');
Route::get('/team_details', [HomeController::class, 'team_details'])->name('home.team_details');
Route::get('/blog_details/{blog}', [HomeController::class, 'blog_details'])->name('home.blog_details');
Route::get('/category/{cat?}', [HomeController::class, 'category'])->name('home.category');
Route::get('/product/{product}', [HomeController::class, 'product'])->name('home.product');
Route::get('/favorite/{product}', [HomeController::class, 'favorite'])->name('home.favorite');
Route::post('/comment/{blog_id}', [HomeController::class, 'post_comment'])->name('home.comment');
Route::post('/contact', [HomeController::class, 'post_contact']);

// Route to delete a comment
Route::delete('/comment/{id}', [HomeController::class, 'delete_comment'])->name('home.comment.delete');

// Route to edit a comment
Route::get('/comment/{id}/edit', [HomeController::class, 'edit_comment'])->name('home.comment.edit');
Route::post('/comment/{id}/update', [HomeController::class, 'update_comment'])->name('home.comment.update');




Route::group(['prefix' => 'account'], function() {

    Route::get('/login', [AccountController::class, 'login'])->name('account.login');
    Route::get('/logout', [AccountController::class, 'logout'])->name('account.logout');
    Route::get('/veryfy-account/{email}', [AccountController::class, 'veryfy'])->name('account.veryfy');
    Route::post('/login', [AccountController::class, 'check_login']);

    Route::get('/register', [AccountController::class, 'register'])->name('account.register');
    Route::get('/favorite', [AccountController::class, 'favorite'])->name('account.favorite');
    Route::post('/register', [AccountController::class, 'check_register'])->name('account.check_register');

    Route::group(['middleware' => 'customer'], function() {
        Route::get('/profile', [AccountController::class, 'profile'])->name('account.profile');
        Route::post('/profile', [AccountController::class, 'check_profile']);

        Route::get('/profilemain', [AccountController::class, 'profilemain'])->name('account.profilemain');
        Route::post('/profilemain', [AccountController::class, 'check_profilemain']);

        Route::get('/change-password', [AccountController::class, 'change_password'])->name('account.change_password');
        Route::post('/change-password', [AccountController::class, 'check_change_password']);
    });

    Route::get('/forgot-password', [AccountController::class, 'forgot_password'])->name('account.forgot_password');
    Route::post('/forgot-password', [AccountController::class, 'check_forgot_password']);

    Route::get('/reset-password/{token}', [AccountController::class, 'reset_password'])->name('account.reset_password');
    Route::post('/reset-password/{token}', [AccountController::class, 'check_reset_password']);

});

Route::group(['prefix' => 'cart','middleware' => 'customer'], function() {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::get('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/delete/{product}', [CartController::class, 'delete'])->name('cart.delete');
    Route::get('/update/{product?}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/clear', [CartController::class, 'clear'])->name('cart.clear');
});


Route::group(['prefix' => 'order','middleware' => 'customer'], function() {

    Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('order.checkout');
    Route::get('/history', [CheckoutController::class, 'history'])->name('order.history');
    Route::get('/detail/{order}', [CheckoutController::class, 'detail'])->name('order.detail');
    Route::post('/checkout', [CheckoutController::class, 'post_checkout'])->name('order.place');

    Route::get('/verify/{token}', [CheckoutController::class, 'verify'])->name('order.verify');

});


Route::get('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'check_login']);

Route::group(['prefix' => 'admin', 'middleware'=>'auth'], function() {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/order', [OrderController::class, 'index'])->name('order.index');
    Route::get('/order/detail/{order}', [OrderController::class, 'show'])->name('order.show');
    Route::get('/order/update-status/{order}', [OrderController::class, 'update'])->name('order.update');

    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::resource('user', UserController::class);
    Route::get('product-delete-image/{image}', [ProductController::class,'destroyImage'])->name('product.destroyImage');
    Route::resource('banner', BannerController::class);
    Route::resource('customer', AdminCustomerController::class);
    Route::resource('comment', AdminCommentController::class);
    Route::resource('contact', ContactController::class);
    Route::resource('blog', AdminBlogController::class);
});


