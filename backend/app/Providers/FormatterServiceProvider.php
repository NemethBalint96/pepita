<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Formatter\AppointmentFormatter;
use App\Services\Formatter\ReservationFormatter;
use App\Services\Formatter\AppointmentFormatterInterface;
use App\Services\Formatter\ReservationFormatterInterface;

class FormatterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(AppointmentFormatterInterface::class, AppointmentFormatter::class);
        $this->app->bind(ReservationFormatterInterface::class, ReservationFormatter::class);
    }
}
