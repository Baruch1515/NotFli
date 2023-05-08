<!DOCTYPE html>
<html>

<head>

  <title>Muro de Red Social</title>
  <!-- enlazar los archivos CSS -->
  <link rel="stylesheet" href="{{ asset('estilos/dashboard.css') }}">
</head>

<body>
  <!-- contenedor principal -->
  <div class="contenedor">
    <!-- menú de la izquierda -->
    <div class="menu-izquierda">
      <ul>
        <li><a href="#">Inicio</a></li>
        <li><a href="{{ route('trending') }}">Tedencia</a></li>
        <li><a href="#">Buscar</a></li>
        <li><a href="#">Ajustes</a></li>
      </ul>
    </div>
    <!-- sección central -->

    <div class="seccion-central">
      <form method="POST" action="{{ route('guardar.nota') }}">
        @csrf
        <textarea name="nota" placeholder="Escribe aquí tu publicación"></textarea>
        <button type="submit">Publicar</button>
      </form>
      @foreach($notas as $nota)
      <div class="publicaciones">
        <div class="publicacion-card">
          <div class="publicacion-info">
            <h3><a href="{{ route('perfil.show', $nota->user->id) }}">{{ $nota->user->name }}</a></h3>

          </div>
          <div class="publicacion-contenido">
            <p>{{$nota->nota}}</p>
          </div>
          <div class="publicacion-acciones">
            @if($nota->likes()->where('user_id', $user->id)->exists())
            <form action="{{ route('likes.destroy', $nota->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn-like">Quitar Like</button>
            </form>
            @else
            <form action="{{ route('likes.store') }}" method="POST" id="like-form">
    @csrf
    <input type="hidden" name="nota_id" value="{{ $nota->id }}">
    <button type="submit" class="btn-like" id="like-btn">Like</button>
</form>


            @endif


            <p class="nota-likes">{{ $nota->likes()->count() }} likes</p>


          </div>
        </div>
      </div>
      @endforeach
    </div>






    <!-- lista de tendencias en la derecha -->
    <div class="tendencias">
      <h1>Tendencias</h1>
      <ul>
        @foreach($notes as $note)
        <li><a href="#">{{ $note->nota }}</a></li>
        @endforeach
      </ul>
    </div>
  </div>
  <!-- enlazar el archivo JavaScript -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>

</html>