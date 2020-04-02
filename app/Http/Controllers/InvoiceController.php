<?php

namespace App\Http\Controllers;

use App\Models\InvoiceHeader;
use App\Models\InvoiceLine;
use App\Models\Location;
use App\Services\InvoiceService;
use Illuminate\Http\Request;

class InvoiceController extends Controller {

    public function index(Request $request, InvoiceService $invoiceService) {

        $dateStart = $request->get('date_start');
        $dateEnd = $request->get('date_end');
        $status = $request->get('status');
        $locationId = $request->get('location_id');

        $invoices = $invoiceService->getFilteredInvoices($dateStart, $dateEnd, $status, $locationId);

        $statusValues = InvoiceHeader::ALL_STATUS_VALUES;
        $locations = Location::all();

        $aggLocationId = $request->get('aggregrate_location_id');

        $statusTotals = $invoiceService->getTotalByStatusForLocation($aggLocationId);

        return view('invoices')
            ->with('statusValues', $statusValues)
            ->with('locations', $locations)
            ->with('invoices', $invoices)
            ->with('statusTotals', $statusTotals);
    }

}
