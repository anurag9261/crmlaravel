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
        <h2 class="">Payslip</h2>
    </header>
    <br>
    <br>
    <hr>
    <br>
    <h3>Payslip: {{ $pdfReviewMonth }}</h3>
    <div class="row">
        <div class="col-md-4 mt-3 mb-3">
            <h3>Employee Name: {{ $employeData[0]->fname }} {{ $employeData[0]->lname }}</h3>
        </div>
    </div>
    <table class="table">
        <tr>
            <th>No</th>
            <th>Date</th>
            <th>Attendance</th>
            <th>Total Time</th>
        </tr>
        @foreach($employeData as $data)
        <?php
            $time1 = new DateTime($data->intime);
            $time2 = new DateTime($data->outtime);
            $interval = $time1->diff($time2);
            $hours = $interval->format('%H:%I:%S');
            $totalTime[] = $hours;
        ?>
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->currentdate}}</td>
            <td>{{$data->attandance}}</td>
            <td>{{ $hours }}</td>
        </tr>
        @endforeach
        <tr>
            <?php
            $time = $totalTime;
            $total = 0;
            foreach ($time as $element) :
                $temp = explode(":", $element);
                $total += (int) $temp[0] * 3600;
                $total += (int) $temp[1] * 60;
                $total += (int) $temp[2];
            endforeach;
            $totalHours = sprintf(
                '%02d:%02d:%02d',
                ($total / 3600),
                ($total / 60 % 60),
                $total % 60
            );
            ?>
            <td></td>
            <td></td>
            <td>Total Hours:</td>
            <td><b>{{ $totalHours }}</b></td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td>Total Present Days:</td>
            <td><b>{{ $attandance }} - Days</b></td>
        </tr>
        @if($employeData[0]->salary_type == 2)
        <tr>
            <td></td>
            <td></td>
            <td>Total Salary:</td>
            <td><b>{{ ($employeData[0]->salary_amount * $attandance)/30 }}</b></td>
        </tr>
        @else
        <tr>
            <?php
                $iCostPerHour = $employeData[0]->salary_amount;
                $timespent = $totalHours;
                $timeparts = explode(':', $timespent);
                $pay = $timeparts[0] * $iCostPerHour + $timeparts[1] / 60 * $iCostPerHour;
                $payAmount['salaryTotal'] = round($pay);
            ?>
            <?php $Amount = array_sum($payAmount);
                $totalSalary = $Amount;
                $totalAmount =  number_format((float)$totalSalary, 2, '.', '');
            ?>
            <td></td>
            <td></td>
            <td>Total Salary(CAD):</td>
            <td><b>{{ $totalAmount }}</b></td>
        </tr>
        @endif
    </table>
</body>

</html>
