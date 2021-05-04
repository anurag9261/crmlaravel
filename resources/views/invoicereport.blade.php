<!DOCTYPE html>
<html>

<head>

    <style>
    table {
        border-collapse: collapse;
        width: 100%;
    }
    th,td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid rgba(33, 33, 33, 0.1);
    }
    body {
            border-collapse: collapse;
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
        .row {
        text-align:justify;
        }
        .row > div {
        display:inline-block;
        }
        .fix {
        width:100%;
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
    <br>
    <br>
    <div class="row">
        <div class="col-md-5">
            <b>Bill From:</b><br>{{ $config[0]->company_name }}, <br>
            {{ $config[0]->address}},<br> {{ $config[0]->city }},{{ $config[0]->zipcode }},<br> {{ $config[0]->state }},
            {{ $config[0]->country }}, <br>Mobile No: {{ $config[0]->mobno }}, <br>Vat No: {{ $config[0]->vat_number }}.
        </div>
        <br>
        <div class="col-md-4 mt-3 mb-3">
            <b>Title:</b> {{ $invoice->title }}<br>
        </div>
        <br>
        <br>
        <div class="col-md-5">
            <div class="row">
                <div style="float:left">
                    <b>Bill To:</b> {{ $invoice->bill_to }}
                </div>
                <div style="float:right">
                    <b>Current Date:</b> {{ $invoice->current_date }}
                </div>
            </div>
        </div>
      <br>
      <br>
        <div class="col-md-10">
            <div class="row">
                <div style="float: left">
                    <b>Ship To:</b> {{ $invoice->ship_to }}
                </div>
                <div style="float:right">
                    <b>Due Date:</b> {{ $invoice->due_date }}
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <div>
        <table class="table">
            <tr class="tr-bg-color">
                <th style="text-align: center">Product</th>
                <th style="text-align: center">Quantity</th>
                <th style="text-align: center">Price(CAD)</th>
                <th style="text-align: right">Total(CAD)</th>
            </tr>
            @foreach ($productData as $product)
                <tr>
                    <td style="text-align: center">{{ $product->product }}</td>
                    <td style="text-align: center">{{ $product->qty }}</td>
                    <td style="text-align: center">{{ $product->price }}</td>
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
</body>
</html>
