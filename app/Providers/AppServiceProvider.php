<?php

namespace App\Providers;

use Auth;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Session;

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
        Inertia::version(function () {
            return md5_file(public_path('mix-manifest.json'));
        });

        Inertia::share('flash', function () {
            return [
                'message' => Session::get('message')
            ];
        });

        Inertia::share('auth', function () {
            return [
                'user' => Auth::user() ?? null
            ];
        });
    }
}
