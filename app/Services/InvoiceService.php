<?php


namespace App\Services;


use App\Models\InvoiceHeader;
use Illuminate\Support\Collection;

class InvoiceService extends Service {

    /**
     * Return a collection of invoices, using a number of optional filters
     *
     * @param string|null $dateStart
     * @param string|null $dateEnd
     * @param string|null $status
     * @param int|string|null $locationId
     * @return Collection
     */
    public function getFilteredInvoices($dateStart = null, $dateEnd = null, $status = null, $locationId = null) {
        $query = InvoiceHeader::query()
            ->dateRange($dateStart, $dateEnd);

        if($status) {
            $query->whereStatus($status);
        }

        if($locationId) {
            $query->whereLocationId($locationId);
        }

        return $query->get();
    }

    /**
     * Takes a location_id and returns the sum of all invoice records, grouped by status
     *
     * @param $locationId
     * @return Collection
     */
    public function getTotalByStatusForLocation($locationId = null) {
        $query = \DB::table('invoice_headers')
            ->join('invoice_lines', 'invoice_lines.invoice_header_id', '=', 'invoice_headers.invoice_header_id')
            ->groupBy('status')
            ->select('status', \DB::raw('SUM(value) as total'));

        if($locationId) {
            $query->where('location_id', $locationId);
        }

        return $query->get();
    }

}
