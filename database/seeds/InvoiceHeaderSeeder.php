<?php

use App\Models\InvoiceHeader;

class InvoiceHeaderSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->getDatabaseConnection()->table('invoice_headers')->insertOrIgnore($this->withTimestampsAndId('invoice_header_id', [
            'status' => InvoiceHeader::STATUS_DRAFT,
            'location_id' => 1
        ]));

        $this->getDatabaseConnection()->table('invoice_headers')->insertOrIgnore($this->withTimestampsAndId('invoice_header_id', [
            'status' => InvoiceHeader::STATUS_OPEN,
            'location_id' => 1
        ]));

        $this->getDatabaseConnection()->table('invoice_headers')->insertOrIgnore($this->withTimestampsAndId('invoice_header_id', [
            'status' => InvoiceHeader::STATUS_PROCESSED,
            'location_id' => 2
        ]));
    }
}
