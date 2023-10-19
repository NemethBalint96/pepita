<?php

namespace App\Providers;

use App\Services\DAL\EventService;
use App\Services\DAL\EventServiceInterface;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(EventServiceInterface::class, EventService::class);
    }
}
