<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Allowing the mass assignment instead of using $fillable on the listing model
        // BE CAUTIOUS OF WHATS GOING INTO THE DB
       Model::unguard();

            // could add boostrap paginator here
    }
}
