<?php

namespace App\Providers;

use App\Models\Tenant;
use Illuminate\Support\ServiceProvider;
use Tenancy\Identification\Contracts\ResolvesTenants;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->app->resolving(ResolvesTenants::class, function (ResolvesTenants $resolvesTenants) {
            $resolvesTenants->addModel(Tenant::class);

            return $resolvesTenants;
        });
    }
}
