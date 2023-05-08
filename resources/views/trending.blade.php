


<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>NotFli</title>
    <link rel="stylesheet" href="{{ asset('estilos/dashboard.css') }}">
    <script src="script.js"></script>
</head>

<body>

    <body>
        <div class="sidebar">
            <ul>
                <li><a href="{{ route('dashboard') }}" >Inicio</a></li>
                <li><a class="active" href="{{ route('trending') }}">Trending</a></li>
                <li><a href="#">Buscar</a></li>
                <li><a href="#">Ajustes</a></li>
            </ul>
        </div>
        <div class="main-content">
            <h1>NotFli /Trending</h1>
            <form method="POST" action="{{ route('guardar.nota') }}">
                @csrf
                <textarea name="nota" placeholder="Escribe tu nota corta aquí..."></textarea>
                <button type="submit">Publicar</button>
            </form>
            <div class="notes-list">
                <!-- Aquí se listarán las notas cortas publicadas -->
                <div class="notas-container">
                    @foreach($notes as $note)
                    <div class="nota">
                        <p>{{ $note->nota }}</p>
                        <p><a href="{{ route('perfil.show', $note->user->id) }}">{{ $note->user->name }}</a></p>
                        <div class="nota-actions">
                            <form action="{{ route('likes.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="nota_id" value="{{ $note->id }}">
                                <button type="submit" class="btn-like">Like</button>
                            </form>
                            <button class="btn-repost">Repost</button>
                            <p class="nota-likes">{{ $note->likes()->count() }} likes</p>
                        </div>
                    </div>
                    @endforeach

                </div>

            </div>
        </div>
    </body>

</body>

</html>









