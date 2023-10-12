<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $table = 'appointments';

    protected $fillable = [
        'start_time',
        'end_time',
        'repetition',
        'day_of_week',
        'time_within_day',
    ];
}
