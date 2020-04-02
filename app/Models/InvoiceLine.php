<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceLine extends Model {

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'invoice_line_id';

    public function invoiceHeader() {
        return $this->belongsTo(InvoiceHeader::class, 'invoice_header_id');
    }

}
