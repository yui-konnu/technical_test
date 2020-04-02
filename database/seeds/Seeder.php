<?php

use Illuminate\Database\Connection;
use Illuminate\Database\Seeder as BaseSeeder;
use Illuminate\Database\DatabaseManager;

class Seeder extends BaseSeeder {

    /**
     * Helper function to get a database connection instance.
     *
     * @param  string|null  $name
     * @return Connection
     */
    public function getDatabaseConnection($name = null) {
        /** @var DatabaseManager $db */
        $db = app(DatabaseManager::class);
        return $db->connection($name);
    }

    /**
     * Returns an integer that increments after every invocation
     *
     * @param int $delta An offset to apply to the resulting id
     * @return int
     */
    public function incrementingId($delta = 0) {
        static $id = 1;
        $id += $delta;
        return ($id++);
    }

    /**
     * Gets current timestamp. Used for created_at/updated_at timestamps
     *
     * @return \Carbon\Carbon
     */
    public function timestamp() {
        return \Carbon\Carbon::now();
    }

    /**
     * Merge input array with populated created_at/updated_at timestamps
     *
     * @param $attributes
     * @return array
     */
    public function withTimestamps($attributes) {
        return array_merge([
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp(),
        ], $attributes);
    }

    /**
     * Applies an incremented ID and timestamps to the input attribute array
     *
     * @param $idColumn
     * @param $attributes
     * @return array
     */
    public function withTimestampsAndId($idColumn, $attributes) {
        return array_merge([ $idColumn => $this->incrementingId() ], $this->withTimestamps($attributes));
    }

}
