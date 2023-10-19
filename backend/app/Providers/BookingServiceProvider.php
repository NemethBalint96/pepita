<?php

namespace App\Providers;

use App\Services\BookingService;
use App\Services\BookingServiceInterface;
use Illuminate\Support\ServiceProvider;

class BookingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(BookingServiceInterface::class, BookingService::class);
    }
}
