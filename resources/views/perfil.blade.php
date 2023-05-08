<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
<h1>Perfil de {{ $user->name }}</h1>

<div>{{ $user->followersCount() }} seguidores</div>

<br>

@if (auth()->user()->following($user))
    <form action="{{ route('unfollow', $user) }}" method="POST">
        @csrf
        @method('DELETE')
        <button class="btn btn-primary">Dejar de seguir</button>
    </form>
@else
<form action="{{ route('follow', $user) }}" method="POST">
    @csrf
    <button class="btn btn-primary">Seguir</button>
</form>
@endif


</body>
</html>