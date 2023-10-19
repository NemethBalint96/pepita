<?php

namespace App\Services\Repetition;

use App\Enums\Repetition;
use Nette\NotImplementedException;

class RepetitionFactory
{
    /**
     * Create an instance of an AbstractRepetition subclass based on the provided repetition type.
     *
     * @param Repetition $repetition
     * @return AbstractRepetition
     *
     * @throws NotImplementedException If the specified repetition type does not exist.
     */
    public static function create(Repetition $repetition): AbstractRepetition
    {
        $class = __NAMESPACE__ . '\\' . $repetition->value;

        if (!class_exists($class)) {
            throw new NotImplementedException("Repetition type $repetition does not exist");
        }

        return new $class();
    }
}
