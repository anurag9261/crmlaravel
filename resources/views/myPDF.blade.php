<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        th {
           background-color: #4d97b4
        }
        body{
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <header style="text-align:right">{{ $title }}</header>
    <h1 style="text-align: center;text-decoration:underline">Timesheet Report</h1>
    <img src="{{ public_path('/images/profile/crm.png') }}" style="width: 100px; height: 100px">
    <h3 style="float:right;">Employee Name:-{{ $employee }}</h3>
    <table>
        <tr>
            <th>No</th>
            <th>Attendance</th>
            <th>Date</th>
            <th>Total Time</th>
        </tr>
        <?php //echo "<pre>"; print_r($employeData); die;?>
        @foreach($employeData as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->attandance}}</td>
            <td>{{$data->currentdate}}</td>
            <td></td>
        </tr>
        @endforeach
    </table>
    <footer style="background-color:gray;padding:05px">CRM-Admin Panel</footer>
</body>

</html>
