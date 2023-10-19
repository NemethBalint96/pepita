<?php

namespace App\Models;

use App\Common\DateTimeFormat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    /**
     * Create a new Reservation instance from validated data.
     *
     * @param array $validatedData
     * @return Reservation
     */
    public static function createReservation(array $validatedData): Reservation
    {
        // Create a new Reservation instance and assign the values
        $reservation = new self();
        $reservation->title = $validatedData['title'];
        $reservation->start = Carbon::parse($validatedData['start'])->format(DateTimeFormat::DATETIME_FORMAT);
        $reservation->end = Carbon::parse($validatedData['end'])->format(DateTimeFormat::DATETIME_FORMAT);

        return $reservation;
    }
}
