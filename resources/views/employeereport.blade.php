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
        <img src="{{ public_path('/images/profile/'. $config[0]->site_logo ) }}">
        <h2 class="">Employee Report</h2>
    </header>
    <br>
    <br>
    <hr>
    <br>
    <table class="table table-bordered">
        <tr class="tr-bg-color">
            <th>No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Mob No</th>
            <th>Email</th>
            <th>Joining Date</th>
            <th>image</th>
        </tr>
        @foreach($employeData as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->fname}}</td>
            <td>{{$data->lname}}</td>
            <td>{{$data->mobno}}</td>
            <td>{{$data->email}}</td>
            <td>{{ $data->joining_date }}</td>
            <td><img src="{{ public_path('/images/'.$data->image) }}" style="width: 30px; height:auto"></td>
        </tr>
        @endforeach
    </table>
    <footer>CRM-Admin Panel</footer>

</body>

</html>
