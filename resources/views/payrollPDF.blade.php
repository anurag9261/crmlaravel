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
        body{
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
    <h3>Payroll Report: {{ $pdfReviewMonth }}</h3>
    <table class="table">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Present Days</th>
            <th>Total Hours</th>
            <th>Salary Type</th>
            <th>Total Salary(CAD)</th>
        </tr>
        @foreach ($employeSalaryData as $data)
            @if($data != '')
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
                    <?php
                        $amount = $data['salaryTotal'];
                        $data['total'] =  number_format((float)$amount, 2, '.', '');
                    ?>
                    <td style="text-align:right">{{ $data['total'] }}</td>
                </tr>
            @endif

        @endforeach
        <?php $Amount = array_sum($totalAmountSalary);
            $totalSalary = $Amount;
            $totalAmount =  number_format((float)$totalSalary, 2, '.', '');
        ?>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td><b>TotalAmount(CAD)</b></td>
            <td style="text-align:right"><b>{{ $totalAmount }}</b></td>
        </tr>
    </table>
</body>
</html>
