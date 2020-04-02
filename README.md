# Technical Test

## Tasks
1. Create an Application that connects to MySQL
2. Create a routine that receive: Range Date, Status and Location (The filters are not mandatory) and return the list of invoices with the following information: Location name, date, status and total value.
3. Create a routine that receive the location id and return the sum of values grouped by status.
4. Create a simple list page to show the result

## Info
- The structure or the DB with some examples can be find on /dump
- Use the framework of your preference
- Submit your code via pull request

## Implementation

I have created this in [Laravel](https://laravel.com/) PHP framework, with connection to a MySQL server.

Scaffolding the database is done via the migrations in database/migrations and seeding via seed files in database/seeds.

The relevant HTTP entrypoint to the application is in app/Http/Controllers/InvoiceController.php

You can see in here I pick up the requested filters from the $request object, and then call my main logic in my
$invoiceService class. This is located at app/Services/InvoiceService.php. This class has two main functions:
getFilteredInvoices() and getTotalByStatusForLocation(). These cover tasks 2 & 3.

In the controller, the results from my service class is passed into my view, which is at resources/view/invoices.blade.php.
