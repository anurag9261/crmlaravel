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
        <h2 class="">Timesheet Report</h2>
    </header>
    <br>
    <br>
    <hr>
    <div class="row">
        <div class="col-md-4 mt-3 mb-3">
            <h3>Employee Name: {{ $employeData[0]->fname }} {{ $employeData[0]->lname }}</h3>
        </div>
    </div>
    <table class="table table-bordered">
        <tr class="tr-bg-color">
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
    function explode_time($time) {
        $time = explode(':', $time);
        $time = $time[0] * 3600 + $time[1] * 60;
        return $time;
}

function second_to_hhmm($time) {
        $hour = floor($time / 3600);
        $minute = strval(floor(($time % 3600) / 60));
         $second = strval(floor(($minute % 3600) / 60));
        if ($minute == 0) {
            $minute = "00";
        }elseif($second == 0) {
            $second = "00";
        }
         else {
            $minute = $minute;
            $second = $second;
        }

        $time = $hour . ":" . $minute. ":" . $second;
        return $time;
}

$time = 0;
$time_arr = $totalTime;
 foreach ($time_arr as $time_val) {
    $time +=explode_time($time_val);
}

$totalHours = second_to_hhmm($time);
?>
<td></td>
<td></td>
<td>Total Hours:</td>
<td><b>{{ $totalHours }}</b></td>
</tr>
</table>
<footer>CRM-Admin Panel</footer>

</body>

</html>
