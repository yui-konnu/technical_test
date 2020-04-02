<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceHeader extends Model {

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'invoice_header_id';

    /*
     * Possible values for enum field "status"
     */
    const STATUS_DRAFT = 'draft';
    const STATUS_OPEN = 'open';
    const STATUS_PROCESSED = 'processed';

    const ALL_STATUS_VALUES = [ self::STATUS_DRAFT, self::STATUS_OPEN, self::STATUS_PROCESSED ];

    public function location() {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function invoiceLines() {
        return $this->hasMany(InvoiceLine::class, 'invoice_header_id');
    }

    public function scopeDateRange($query, $start = null, $end = null) {
        if($start) {
            $query->where('created_at', '>=', $start);
        }

        if($end) {
            $query->where('created_at', '<=', $end);
        }
    }

    /**
     * Calculate total value for all invoice lines in this invoice
     *
     * @return int
     */
    public function getTotal() {
        return $this->invoiceLines->sum('value');
    }

}
