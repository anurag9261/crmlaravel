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
        <div class="col-md-4 mt-3 mb-3">
            <h3>Title: {{ $invoice->title }}</h3>
        </div>
        <div class="row">
        <div class="col-md-5">
            Bill To: {{ $invoice->bill_to }}
            <p style="float: right">Current Date: {{ $invoice->current_date }}</p>
        </div>
        <br>
        <div class="col-md-5">
            Ship To: {{ $invoice->ship_to }}
            <p style="float: right">Due Date: {{ $invoice->due_date }}</p>
        </div>
    </div>
    <div>
        <table class="table table-bordered">
            <tr class="tr-bg-color">
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total</th>
            </tr>
            @foreach ($productData as $product)
                <tr>
                    <td>{{ $product->product }}</td>
                    <td>{{ $product->qty }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->total }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td><b>SubTotal</b></td>
                <td style="float: right">{{ $invoice->sub_total }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>Tax Amount ({{ $invoice->tax_percentage }}%)</b></td>
                <td style="float: right">{{ $invoice->tax_amount }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td><b>Total Amount</b></td>
                <td>{{ $invoice->total_amount }}</td>
            </tr>
        </table>
        </div>
    {{--  <?php echo "<pre>"; print_r($invoice); die;?>  --}}
    <footer>CRM-Admin Panel</footer>
</body>

</html>
