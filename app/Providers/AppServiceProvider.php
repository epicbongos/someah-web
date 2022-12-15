<?php

namespace App\Providers;

use App\Contact;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Builder;

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
        Builder::defaultStringLength(191);
        view()->composer('*', function($view)
        {
            $kontakk = Contact::find(1);
            $view->with(compact('kontakk'));
        });


    }
}
