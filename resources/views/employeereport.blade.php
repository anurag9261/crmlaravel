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
        body {
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
        <img src="{{ public_path('/images/profile/'. $config[0]->site_logo ) }}">
        <h2 class="">Employee Report</h2>
    </header>
    <br>
    <br>
    <hr>
    <br>
    <h3>Employee Report: {{ $pdfReviewMonth }}</h3>
    <table class="table">
        <tr>
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
</body>

</html>
