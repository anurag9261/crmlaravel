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
</table>
<footer>CRM-Admin Panel</footer>

</body>

</html>
