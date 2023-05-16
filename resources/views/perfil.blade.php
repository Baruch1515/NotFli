<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('estilos/dashboard.css') }}">

    <link rel="stylesheet" href="{{ asset('estilos/perfil.css') }}">
    <meta charset="UTF-8">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    @include('header')

    <main>
        <section class="profile">
            <figure class="profile-photo">
                <img src="{{ asset($user->imagen) }}" alt="Imagen de perfil">



            </figure>
            <div class="profile-details">
                <h2>{{ $user->name }}</h2>
                <p style="color:white;">Segidores: {{ $user->followersCount() }}</p>
                <p style="color:white;">Pais: {{$user->pais}}</p>
                <p style="color:white;">Orientacion: {{$user->orientacion}}</p>
                </p>
                <div class="buttons-container">
                    @if($isOwner)
                    <a role="button" class="button-name" href="{{ route('perfil.edit', ['id' => $user->id]) }}">Editar Perfil</a>

                    @endif


                    @if (auth()->user()->following($user))
                    <form action="{{ route('unfollow', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="unfollow-button">Dejar de seguir</button>
                    </form>
                    @else
                    <form action="{{ route('follow', $user) }}" method="POST">
                        @csrf
                        <button class="follow-button">Seguir</button>
                    </form>
                    @endif
                </div>

            </div>
        </section>
    </main>
</body>

</html>