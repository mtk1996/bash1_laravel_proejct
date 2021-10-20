<?php

namespace App\Providers;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //$this->registerPolicies();
        View::share('category', Category::withCount('product')->get());


        view()->composer('*', function ($view) {
            $cart_count = Cart::where('user_id', auth()->id())->count();
            $view->with('cart_count', $cart_count);
        });


        Paginator::useBootstrap();

        Passport::routes();
    }
}
