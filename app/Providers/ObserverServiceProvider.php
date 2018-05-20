<?php

namespace App\Providers;

use App\User;
use App\Observers\UserObserver;
    //we need to bring both of these in.

use Illuminate\Support\ServiceProvider;

class ObserverServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //here we will tell it to tie the user model to the user observer.
        User::observe(UserObserver::class);
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
