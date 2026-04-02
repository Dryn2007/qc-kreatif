<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;

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
        if ($this->app->environment('production')) {
            try {
                // In some serverless environments (like Vercel) the request
                // or URL generator may not be available at provider boot time.
                // Guard the call so boot doesn't throw and cause a 500.
                if ($this->app->has('request') && $this->app['request'] instanceof \Illuminate\Http\Request) {
                    URL::forceScheme('https');
                }
            } catch (\Throwable $e) {
                // Swallow any bootstrap-time exceptions here to avoid
                // failing the whole request. The real error (missing
                // configuration) should be fixed via env vars instead.
            }
        }
    }
}
