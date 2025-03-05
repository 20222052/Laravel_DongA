<?php

namespace App\Providers;

use App\Models\Cart;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

        view()->composer('*', function ($view) {
            $cats_home = Category::orderBy('name', 'ASC')->where('status', 1)->get();
            $carts = Cart::where('customer_id', auth('cus')->id())->get();
            $view->with(compact('cats_home', 'carts'));
        });

        Gate::define('admin', function (User $user) {
            return $user->role === 'admin';
        });
        Gate::define('editor', function (User $user) {
            return $user->role === 'editor';
        });
        Gate::define('staff', function (User $user) {
            return $user->role === 'staff';
        });
    }
}
