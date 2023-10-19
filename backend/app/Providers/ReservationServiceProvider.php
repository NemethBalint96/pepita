<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\DAL\ReservationService;
use App\Services\DAL\ReservationServiceInterface;

class ReservationServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ReservationServiceInterface::class, ReservationService::class);
    }
}
