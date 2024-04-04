<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\ {SupportRepositoryInterface,
                    SupportEloquentORM,
                    AddressRepositoryInterface,
                    AddressEloquentORM};

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SupportRepositoryInterface::class, SupportEloquentORM::class);
        $this->app->bind(AddressRepositoryInterface::class, AddressEloquentORM::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
