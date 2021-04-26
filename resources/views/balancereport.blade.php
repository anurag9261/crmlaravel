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
        <img src="{{ public_path('/images/profile/'.$config[0]->site_logo ) }}">
        <h2 class="">Balancesheet Report</h2>
    </header>
    <br>
    <br>
    <hr>
    <br>
    <h3>Paid Invoice</h3>
    <table class="table table-bordered">
        <tr class="tr-bg-color">
            <th>No</th>
            <th>Title</th>
            <th>Bill To</th>
            <th>Due Date</th>
            <th>Total</th>
        </tr>
        @foreach($invoiceRecord as $data)
        <tr>
            <td>{{$data->id}}</td>
            <td>{{$data->title}}</td>
            <td>{{$data->bill_to}}</td>
            <td>{{$data->due_date}}</td>
            <td style="text-align: right">{{$data->total_amount}}</td>
        </tr>
        <?php
            $totalPaidAmount[] = $data->total_amount;
        ?>
        @endforeach
    </table>
    <br>
    <h3>Expense</h3>
    <table class="table table-bordered">
        <tr class="tr-bg-color">
            <th>No</th>
            <th>Category Name</th>
            <th>Entry Date</th>
            <th>Amount</th>
        </tr>

        @foreach($expenseRecord as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->category}}</td>
            <td>{{$data->entry_date}}</td>
            <td style="text-align: right">{{$data->amount}}</td>
        </tr>
<?php
$totalExpences[] = $data->amount;
?>
        @endforeach
    </table>
<?php
        $totalPaidAmounts = array_sum($totalPaidAmount);
        $totalExpenceAmounts = array_sum($totalExpences); ?>
    <div class="" style="margin-top:50px">
        <h3>Total paid invoice amount: {{ $totalPaidAmounts }} </h3>
        <h3>Total expence amount: {{ $totalExpenceAmounts }}</h3>
        <h3>Available Balance: {{ $totalPaidAmounts-$totalExpenceAmounts }}</h3>
    </div>
    <footer>CRM-Admin Panel</footer>
</body>
</html>
