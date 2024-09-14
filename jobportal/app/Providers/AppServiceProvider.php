<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Include Policies
use App\Models\Order;
use App\Policies\OrderPolicy;
use Illuminate\Support\Facades\Gate;

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
        // Register Policies
        Gate::policy(Position::class, PositionPolicy::class);
        Gate::policy(Company::class, CompanyPolicy::class);
        Gate::policy(Category::class, CategoryPolicy::class);
    }
}
