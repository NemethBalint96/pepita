<?php

namespace App\Models;

use App\Common\DateTimeFormat;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = ['title', 'start', 'end'];

    public static function createReservation($validatedData)
    {
        // Create a new Reservation instance and assign the values
        $reservation = new self();
        $reservation->title = $validatedData['title'];
        $reservation->start = Carbon::parse($validatedData['start'])->format(DateTimeFormat::DATETIME_FORMAT);
        $reservation->end = Carbon::parse($validatedData['end'])->format(DateTimeFormat::DATETIME_FORMAT);
        
        return $reservation;
    }
}
