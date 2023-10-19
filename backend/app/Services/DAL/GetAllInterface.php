<?php

namespace App\Services\DAL;

/**
 * Interface GetAllInterface
 *
 * This interface defines a method for retrieving all items of a specific type from the data access layer.
 */
interface GetAllInterface
{
    /**
     * Get all items of a specific type from the data access layer.
     *
     * @return array
     */
    public function getAll();
}
