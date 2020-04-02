<?php

class LocationSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $table = $this->getDatabaseConnection()->table('locations');

        $table->insertOrIgnore($this->withTimestampsAndId('location_id', [
            'name' => 'LOCATION 001',
        ]));

        $table->insertOrIgnore($this->withTimestampsAndId('location_id', [
            'name' => 'LOCATION 002',
        ]));
    }
}
