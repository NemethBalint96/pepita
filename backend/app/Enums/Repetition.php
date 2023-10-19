<?php

namespace App\Enums;

/**
 * Enum for representing repetition options.
 */
enum Repetition: string
{
    /**
     * No repetition option.
     */
    case NoRepetition = 'NoRepetition';

    /**
     * Weekly repetition option.
     */
    case Weekly = 'Weekly';

    /**
     * Even week repetition option.
     */
    case EvenWeek = 'EvenWeek';

    /**
     * Odd week repetition option.
     */
    case OddWeek = 'OddWeek';

    /**
     * Get an array of all possible enum values.
     *
     * @return string[]
     */
    public static function getAllValues(): array
    {
        return array_column(Repetition::cases(), 'value');
    }
}
