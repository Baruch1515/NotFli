@include('header')
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda</title>
</head>
<body>
<div style="color:white;">
@if(count($results) > 0)
    <ul>
        @foreach($results as $result)
            <li>{{ $result->nota }}</li>
        @endforeach
    </ul>
@else
    <p>No se encontraron resultados.</p>
@endif
</div>
</body>
</html>