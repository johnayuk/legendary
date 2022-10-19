<?php

namespace App\Providers;

use App\Interface\AdminInterface;
use App\Interface\ManagerInterface;
use App\Repositories\AdminRepo;
use App\Repositories\ManagerRepo;
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
        $this->app->bind(
            ManagerInterface::class,
            ManagerRepo::class
        );

        $this->app->bind(
            AdminInterface::class,
            AdminRepo::class
        );
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
