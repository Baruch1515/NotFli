<!DOCTYPE html>
<html lang="en">

<head>
  <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="{{ asset('estilos/dashboard.css') }}">
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>NotFli</title>
</head>

<body>
  @include('header')
  <br /><br />
  @foreach($notas as $nota)
  <center>
    <div class='post-content' style="background-color:#232322;">
      <div style="display: flex; align-items: center;">
        <b><a style="color:white; text-decoration:none; font-size:14px; margin: 10px;" href="{{ route('perfil.show', $nota->user->name) }}">@ {{ $nota->user->name }}</a></b>
      </div> <br />
      <p style="color:white; font-family:'Times New Roman', Times, serif;">{!! nl2br($nota->nota) !!}</p>

      @if ($nota->imagen)

      <div class="imagen-container">
        <img src="{{ asset($nota->imagen) }}" alt="Descripción de la imagen">
      </div>
      @endif
      @if($nota->likes()->where('user_id', $user->id)->exists())
      <hr><br><br>


      <div class="likec" style="display: flex; align-items: center;">
        <form action="{{ route('likes.destroy', $nota->id) }}" method="POST">
          @csrf
          @method('DELETE')
          <button id="fuera" style="background-color: transparent; color:blank;" type="submit">
            <i class="fa-solid fa-star"></i></button>
        </form>


        @else
        <hr><br><br>
        <div class="likec" style="display: flex; align-items: center;">
          <form id="like-button" action="{{ route('likes.store') }}" method="POST">
            @csrf
            <input type="hidden" name="nota_id" value="{{ $nota->id }}">
            <button id="fuera" style="background-color: transparent;" type="submit">
              <i class="fa-regular fa-star"></i>
            </button>
          </form>

          @endif
          <p style="color:white;" class="nota-likes">{{ $nota->likes()->count() }} likes</p>


          @if (auth()->check() && $nota->user_id == auth()->id())
          <form action="{{ route('posts.destroy', $nota->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button id="delete" style="background-color: transparent; color:white;  background: none;border: none;cursor: pointer;padding: 0;" type="submit" class="btn btn-danger btn-sm">
              <i class="fa-solid fa-trash"></i>
            </button>
          </form>
          @endif



        </div>
      </div>

  </center>
  @endforeach


  </div>
  <script src="{{ asset('dashboard.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>