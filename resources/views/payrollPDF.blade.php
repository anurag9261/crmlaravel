<!DOCTYPE html>
<html>

<head>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            border:1px solid #525252;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
            border:1px solid #525252;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tr-bg-color {
            background-color:rgb(38, 146, 165);
            color:white;
        }
        body{
            border-collapse: collapse;
        }
        footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        background-color:#1f1f1f;
        color: white;
        padding:8px 0px;
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
        <h2 class="">Payroll Report</h2>
    </header>
    <br>
    <br>
    <hr>
    <br>
    <table class="table table-bordered">
        <tr class="tr-bg-color">
            <th>No</th>
            <th>Name</th>
            <th>Present Days</th>
            <th>Total Hours</th>
            <th>Salary Type</th>
            <th>Total Salary</th>
        </tr>

        @foreach ($employeSalaryData as $data)
            <?php $totalAmountSalary[] = $data['salaryTotal']; ?>
            <tr>
                <td>{{ $data['id'] }}</td>
                <td>{{ $data['fname'] }} {{$data['lname']}}</td>
                <td>{{ $data['presentDay']}}</td>
                <td>{{ $data['hours']}}</td>
                @if($data['salary_type'] == 2)
                <td>Monthly</td>
                @else
                <td>Hourly</td>
                @endif
                <td style="text-align:right">{{ $data['salaryTotal'] }}</td>
            </tr>
        @endforeach
        <?php $totalAmount = array_sum($totalAmountSalary);?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>TotalAmount</b></td>
            <td style="text-align:right"><b>{{ $totalAmount }}</b></td>

        </tr>
    </table>
    <footer>CRM-Admin Panel</footer>
</body>
</html>
