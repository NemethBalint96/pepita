<?php

namespace App\Enums;

enum Repetition: string
{
    case NoRepetition = 'NoRepetition';
    case Weekly = 'Weekly';
    case EvenWeek = 'EvenWeek';
    case OddWeek = 'OddWeek';

    public static function getAllValues(): array
    {
        return array_column(Repetition::cases(), 'value');
    }
}