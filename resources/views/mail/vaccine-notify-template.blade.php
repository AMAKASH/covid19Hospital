<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
</head>

<body>
    Dear {{ $user->name }},<br>
    Please be present at <strong>{{ $hospital->name }}</strong> on
    <strong>{{ $date }}</strong> to recieve
    {{ $dose }} dose of covid 19 vaccine.
    <br>
    <br>
    Regards,<br>
    {{ $hospital->name }}<br>
    Covid19 Hospital Website<br>
</body>

</html>
