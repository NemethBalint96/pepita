<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DAL\AppointmentService;
use App\Services\DAL\AppointmentServiceInterface;

class AppointmentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AppointmentServiceInterface::class, AppointmentService::class);
    }
}
