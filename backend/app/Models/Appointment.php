<?php

namespace App\Models;

use App\Enums\Repetition;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'repetition' => Repetition::class,
    ];
}
