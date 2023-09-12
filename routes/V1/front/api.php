<?php

use App\Http\Controllers\Api\V1\Front\AccountAddressController;
use App\Http\Controllers\Api\V1\Front\AccountController;
use App\Http\Controllers\Api\V1\Front\Auth\ForgotPasswordController;
use App\Http\Controllers\Api\V1\Front\Auth\LoginController;
use App\Http\Controllers\Api\V1\Front\Auth\LogoutController;
use App\Http\Controllers\Api\V1\Front\Auth\PasswordResetController;
use App\Http\Controllers\Api\V1\Front\Auth\RegistrationController;
use App\Http\Controllers\Api\V1\Front\Auth\SocialAuthController;
use App\Http\Controllers\Api\V1\Front\Auth\VerifyEmailController;
use App\Http\Controllers\Api\V1\Front\CartController;
use App\Http\Controllers\Api\V1\Front\CartProductsController;
use App\Http\Controllers\Api\V1\Front\CategoryFilterController;
use App\Http\Controllers\Api\V1\Front\CategoryListController;
use App\Http\Controllers\Api\V1\Front\CategoryPostController;
use App\Http\Controllers\Api\V1\Front\CategoryProductController;
use App\Http\Controllers\Api\V1\Front\DeliveryProvidersController;
use App\Http\Controllers\Api\V1\Front\ExternalApi\NewPost\SearchSettlementsController;
use App\Http\Controllers\Api\V1\Front\GuestOrderController;
use App\Http\Controllers\Api\V1\Front\LatestPostController;
use App\Http\Controllers\Api\V1\Front\NewProductController;
use App\Http\Controllers\Api\V1\Front\OrderController;
use App\Http\Controllers\Api\V1\Front\PostCommentController;
use App\Http\Controllers\Api\V1\Front\PostController;
use App\Http\Controllers\Api\V1\Front\ProductController;
use App\Http\Controllers\Api\V1\Front\ShopAdvantageController;
use App\Http\Controllers\Api\V1\Front\SocialController;
use App\Http\Controllers\Api\V1\Front\TagController;
use App\Http\Controllers\Api\V1\Front\ViewedProductController;
use App\Http\Controllers\Api\V1\Front\WidgetController;
use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::delete('logout', LogoutController::class);
    Route::get('email/verify', VerifyEmailController::class)->name('verification.notice');
    Route::apiResource('carts', CartController::class)->except('update', 'index', 'show');
    Route::singleton('account', AccountController::class)->except('edit');
    Route::singleton('account-address', AccountAddressController::class)->only('update');
    Route::apiResource('orders', OrderController::class)->only('index', 'store');
});

Route::post('guest/orders', [GuestOrderController::class, 'store'])->name('guest.orders');

Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return response()->json([
        'status' => 'success',
        'message' => 'Пошту верифіковано'
    ]);
})->middleware(['signed'])
    ->name('verification.verify');

Route::apiResource('tags', TagController::class)->only('index');
Route::apiResource('socials', SocialController::class)->only('index');
Route::apiResource('posts', PostController::class)->only('index', 'show');


Route::get('posts/{post}/comments', [PostCommentController::class, 'show']);
Route::post('posts/{post}/comments', [PostCommentController::class, 'store']);
Route::get('latest-posts', LatestPostController::class);
Route::get('blog-categories', CategoryPostController::class);

Route::get('categories-products', [CategoryProductController::class, 'index']);

Route::get('categories', [CategoryListController::class, 'index'])->name('categories.index');
Route::get('categories/{category}', [CategoryListController::class, 'show'])->name('category.show');
Route::get('categories/{category}/products', [CategoryProductController::class, 'show']);

Route::get('categories/{category}/filters', [CategoryFilterController::class, 'show']);

Route::get('new-products', [NewProductController::class, 'index']);
Route::get('widgets', [WidgetController::class, 'index'])->name('widgets.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('viewed-products', [ViewedProductController::class, 'index'])->name('viewed-products.index');
Route::get('shop-advantages', [ShopAdvantageController::class, 'index'])->name('shop-advantages.index');

Route::post('login', LoginController::class);
Route::post('registration', RegistrationController::class);

Route::post('forgot-password', ForgotPasswordController::class)->name('password.email');
Route::post('reset-password', PasswordResetController::class)->middleware('guest')->name('password.update');

Route::get('authorize/{provider}/redirect', [SocialAuthController::class, 'redirectToProvider'])->name('social.redirect');
Route::get('authorize/{provider}/callback', [SocialAuthController::class, 'handleProviderCallback'])->name('social.callback');

Route::post('cart', [CartProductsController::class, 'index'])->name('view-cart-products.index');

Route::get('delivery-providers', [DeliveryProvidersController::class, 'index'])->name('delivery-providers.index');

Route::post('external/new-post/search-settlements', SearchSettlementsController::class)->name('external.new-post.search-settlements');


