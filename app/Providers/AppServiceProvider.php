<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton('ErrorServices', function ($app) {
            return new \App\Services\ErrorServices();
        });
        $this->app->singleton('UserServices', function ($app) {
            return new \App\Services\UserServices();
        });
        $this->app->singleton('AppointmentServices', function ($app) {
            return new \App\Services\AppointmentServices();
        });
        $this->app->singleton('MedicalHistoryServices', function ($app) {
            return new \App\Services\MedicalHistoryServices();
        });
        $this->app->singleton('PermissionServices', function ($app) {
            return new \App\Services\PermissionServices();
        });
        $this->app->singleton('RoleServices', function ($app) {
            return new \App\Services\RoleServices();
        });
        $this->app->singleton('SpecialityServices', function ($app) {
            return new \App\Services\SpecialityServices();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
