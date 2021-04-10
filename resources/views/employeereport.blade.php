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
    <h1 style="text-align: center;text-decoration:underline">Employee Report</h1>
    <img src="{{ public_path('/images/profile/crm.png') }}" style="width: 100px; height: 100px">
    <table>
        <tr>
            <th>No</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Mob No</th>
            <th>Email</th>
            <th>image</th>
        </tr>
        <?php //echo "<pre>"; print_r($employeData); die;?>
        @foreach($employeData as $data)
        <tr>
            <td>{{$loop->iteration}}</td>
            <td>{{$data->fname}}</td>
            <td>{{$data->lname}}</td>
            <td>{{$data->mobno}}</td>
            <td>{{$data->email}}</td>
            <td><img src="{{ public_path('/images/'.$data->image) }}" style="width: 30px; height:auto"></td>
            <td></td>
        </tr>
        @endforeach
    </table>
    <footer style="background-color:gray;padding:05px">CRM-Admin Panel</footer>
</body>

</html>
