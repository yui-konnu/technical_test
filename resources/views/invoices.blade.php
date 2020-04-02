<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Technical Test</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
            flex-direction: column;
        }

        .position-ref {
            position: relative;
        }

        .flex-center > * {
            margin: 20px 0;
        }
    </style>
</head>
<body>
<div class="flex-center position-ref full-height">
    <div class="filters">
        <form method="get" action="{{ url('/') }}">
            <label>
                Start Date
                <input type="date" name="date_start">
            </label>

            <label>
                End Date
                <input type="date" name="date_end">
            </label>

            <label>
                Status
                <select name="status">
                    <option value="">Select Filter</option>
                    @foreach($statusValues as $statusValue)
                        <option value="{{ $statusValue }}">{{ $statusValue }}</option>
                    @endforeach
                </select>
            </label>

            <label>
                Locations
                <select name="location_id">
                    <option value="">Select Filter</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->getKey() }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </label>

            <button>Filter</button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>Location</th>
                <th>Date</th>
                <th>Status</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->location->name }}</td>
                    <td>{{ $invoice->created_at }}</td>
                    <td>{{ $invoice->status }}</td>
                    <td>{{ number_format($invoice->invoiceLines->sum('value'), 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>
        <form method="get" action="{{ url('/') }}">
            <label>
                Get totals by status for location
                <select name="aggregrate_location_id">
                    <option value="">Select Filter</option>
                    @foreach($locations as $location)
                        <option value="{{ $location->getKey() }}">{{ $location->name }}</option>
                    @endforeach
                </select>
            </label>

            <button>Filter</button>
        </form>
    </div>

    <table>
        <thead>
        <tr>
            <th>Status</th>
            <th>Total</th>
        </tr>
        </thead>
        <tbody>
        @foreach($statusTotals as $line)
            <tr>
                <td>{{ $line->status }}</td>
                <td>{{ number_format($line->total, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
