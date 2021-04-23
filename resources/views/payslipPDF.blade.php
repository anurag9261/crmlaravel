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
        <h2 class="">Payslip</h2>
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
        <?php //echo "<pre>"; print_r($employeData); die;?>
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
                function explode_time($time) { //explode time and convert into seconds
                    $time = explode(':', $time);
                    $time = $time[0] * 3600 + $time[1] * 60;
                    return $time;
                }

                function second_to_hhmm($time) { //convert seconds to hh:mm
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
                    $time +=explode_time($time_val); // this fucntion will convert all hh:mm to seconds
                }

                $totalHours = second_to_hhmm($time);
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
            <td><b>{{ $attandance }}</b></td>
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
            <td></td>
            <td></td>
            <td>Total Salary:</td>
            <td><b>{{ $payAmount['salaryTotal'] }}</b></td>
        </tr>
        @endif
    </table>
<footer>CRM-Admin Panel</footer>
</body>

</html>
