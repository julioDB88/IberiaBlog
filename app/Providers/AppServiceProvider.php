<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Blade;
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
//dd(Auth::user());
        Blade::if('admin', function () {return auth()->user()->has===1;    });
        Blade::if('writer', function () {return auth()->user()->teamRole('editor');    });
    }
}
