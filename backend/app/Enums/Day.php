<?php

namespace App\Enums;

/**
 * Enum for representing days of the week.
 */
enum Day: int
{
    case Monday = 0;
    case Tuesday = 1;
    case Wednesday = 2;
    case Thursday = 3;
    case Friday = 4;
    case Saturday = 5;
    case Sunday = 6;
}
