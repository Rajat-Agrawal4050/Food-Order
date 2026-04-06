<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$sub}}</title>
</head>

<body>

    <h1>{{$sub}}</h1>
    <br><br>
    <table>
        <tr>
            <td>Name: {{$msg['name']}}</td>
        </tr>
        <tr>
            <td>Email: {{$msg['email']}}</td>
        </tr>
        <tr>
            <td>Message: {{$msg['msg']}}</td>
        </tr>
    </table>

</body>

</html>