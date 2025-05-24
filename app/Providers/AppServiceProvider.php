<?php

namespace App\Providers;

use App\Http\Middleware\CheckRole;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    protected $policies = [
        Feature::class => FeaturePolicy::class,
    ];

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the role middleware
        $this->app->bind('middleware.role', CheckRole::class);
    }
}