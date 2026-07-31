<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
       /*  // set the public path to this directory
		 $this->app->bind('path.public', function() {
			 return base_path().'/public_html/oxygen.ktonline.in/';
		 });*/
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function ($view) {
            $wishlistedProductIds = [];
            if (session()->has('customer_id')) {
                $wishlistedProductIds = \DB::table('ecom_wishlist')
                    ->leftJoin('products_details', 'products_details.id', '=', 'ecom_wishlist.ecom_product_id')
                    ->where('ecom_wishlist.customer_id', session('customer_id'))
                    ->pluck('products_details.products_id')
                    ->toArray();
            }
            $view->with('wishlistedProductIds', $wishlistedProductIds);
        });
    }
}
