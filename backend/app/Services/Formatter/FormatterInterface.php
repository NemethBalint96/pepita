<?php

namespace App\Services\Formatter;

/**
 * Interface FormatterInterface
 *
 * This interface defines a method for formatting data.
 */
interface FormatterInterface
{
    /**
     * Format the provided data.
     *
     * @param mixed $data
     * @return mixed
     */
    public function format($data);
}
