<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\InvoiceHeader;

class CreateInvoiceHeadersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_headers', function (Blueprint $table) {
            $table->id('invoice_header_id');
            $table->timestamps();
            $table->foreignId('location_id')->constrained()->references('location_id');
            $table->enum('status', [ InvoiceHeader::STATUS_DRAFT, InvoiceHeader::STATUS_OPEN, InvoiceHeader::STATUS_PROCESSED ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_headers');
    }
}
