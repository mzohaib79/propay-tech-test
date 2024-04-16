<?php

namespace App\Providers;

use App\Repositories\Eloquent\InterestRepository;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\InterestRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(InterestRepositoryInterface::class, InterestRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
