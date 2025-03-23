<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void {}

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        function admin_abort($code, $message = 'Akses Ditolak')
        {
            if ($code == 404) {
                return response()->view('Admin.Errors.404', ['message' => $message], $code);
            }
            abort(403, $message);
        }
    }
}
