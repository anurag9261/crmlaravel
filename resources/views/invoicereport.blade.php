<!DOCTYPE html>
<html>

<head>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border: 1px solid #525252;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border: 1px solid #525252;
        }

        tr{
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tr-bg-color {
            background-color: rgb(38, 146, 165);
            color: white;
        }

        body {
            border-collapse: collapse;
        }

        footer {
            position: fixed;
            left: 0;
            bottom: 0;
            width: 100%;
            background-color: #1f1f1f;
            color: white;
            padding: 8px 0px;
            text-align: center;
        }

        .header img {
            float: left;
            width: 80px;
            height: auto;
            background: #555;
        }

        .header h2 {
            position: relative;
            top: 18px;
            left: 28%;
        }
    </style>
</head>

<body>
    <header class="header">
        <img src="{{ public_path('/images/profile/'.$config[0]->site_logo) }}">
        <h2 class="">Invoice Report</h2>
    </header>
    <br>
    <br>
    <hr>
    <div class="row">
        <div class="col-md-5">
            <b>Bill From:</b><br>{{ $config[0]->company_name }}, <br>
            {{ $config[0]->address}},<br> {{ $config[0]->city }},{{ $config[0]->zipcode }},<br> {{ $config[0]->state }},
            {{ $config[0]->country }}, <br>Mob no: {{ $config[0]->mobno }}, <br>Vat no: {{ $config[0]->vat_number }}.
        </div>
        <br>
        <div class="col-md-4 mt-3 mb-3">
            <b>Title:</b> {{ $invoice->title }}<br>
            <p style="float: right">Current Date: {{ $invoice->current_date }}</p>
        </div>
        <br>
      <div class="col-md-5">
        <b>Bill To:</b> {{ $invoice->bill_to }}<br>
        <p style="float: right">Due Date: {{ $invoice->due_date }}</p>
      </div>
      <br>
        <div class="col-md-5">
            <b>Ship To:</b> {{ $invoice->ship_to }}
        </div>
    </div>
    <br>
    <br>
    <div>
        <table class="table table-bordered">
            <tr class="tr-bg-color">
                <th style="text-align: center">Product</th>
                <th style="text-align: center">Quantity</th>
                <th style="text-align: center">Price(CAD)</th>
                <th style="text-align: center">Total(CAD)</th>
            </tr>
            @foreach ($productData as $product)
                <tr>
                    <td>{{ $product->product }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>{{ $product->price }}</td>
                    <td style="text-align: right">{{ $product->total }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td><b>SubTotal(CAD)</b></td>
                <td style="text-align:right">{{ $invoice->sub_total }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>Tax Amount(CAD) ({{ $invoice->tax_percentage }}%)</b></td>
                <td style="text-align:right">{{ $invoice->tax_amount }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>Total Amount(CAD)</b></td>
                <td style="text-align: right">{{ $invoice->total_amount }}</td>
            </tr>
        </table>
        </div>
    <footer>CRM-Admin Panel</footer>
</body>
</html>
