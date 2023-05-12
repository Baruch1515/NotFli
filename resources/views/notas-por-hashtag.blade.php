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
  <center>
    <h1 style="color:white;">#{{ $tag }}</h1>
  </center>
  @foreach($notas as $nota)
  <center>
    <div class='post-content' style="background-color:#232322;">
      <div style="display: flex; align-items: center;">
        <b><a style="color:white; text-decoration:none; font-size:14px; margin: 10px;" href="{{ route('perfil.show', $nota->user->id) }}">{{ $nota->user->name }}</a></b>
        @if (auth()->user()->following($user))
        <form action="{{ route('unfollow', $user) }}" method="POST">
          @csrf
          @method('DELETE')
          <button class="btn btn-link" style="color: #00B9FE; text-decoration: underline; background-color: transparent; border:none; text-decoration:none;" class="btn btn-primary">Dejar de seguir</button>
        </form>
        @else
        <form action="{{ route('follow', $user) }}" method="POST">
          @csrf
          <button class="btn btn-link" style="color: #00B9FE; text-decoration: underline; background-color: transparent; border:none; text-decoration:none;" class="btn btn-primary">Seguir</button>
        </form>
        @endif
      </div> <br /><br>
      <p style="color:white;">{!! $nota->nota !!}</p>




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
          <p><a id="repost" style="color:white;" href="{{ route('repost.show', $nota->id) }}" class="repost"><i class="fa-solid fa-share"></i></a></p>
        </div>
      </div>

  </center>
  @endforeach




  <div id="edit-modal">
    <div id="new-post-modal">

      <div class="modal-content">
        <form method="POST" action="{{ route('guardar.nota') }}">
          @csrf
          <textarea id="teztarea" name="nota" placeholder="Tu nota desde el <3"></textarea>
          <div class="button-container">
            <button type="submit" id="postbtn">Publicar</button>
            <button style="background-color: white;color: black;border-radius: 10em;font-size: 17px;padding: 1em 2em;cursor: pointer;transition: all 0.3s ease-in-out;border: 1px solid black;box-shadow: 0 0 0 0 black;" type="button" id="close-modal">Cerrar</button>
          </div>
        </form>
      </div>


    </div>

  </div>

  </div>

  <script>
    const editButton = document.getElementById('edit-button');
    const editModal = document.getElementById('edit-modal');
    const closeButton = document.getElementById('close-modal');

    editButton.addEventListener('click', function() {
      editModal.style.display = 'block';
    });

    closeButton.addEventListener('click', function() {
      editModal.style.display = 'none';
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#like-form').on('submit', function(event) {
        event.preventDefault(); // Previene el comportamiento predeterminado del formulario
        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: $(this).serialize(),
          success: function(response) {
            $('#nota-likes').text(response.likes + ' likes'); // Actualiza el número de likes en la vista
          }
        });
      });
    });
  </script>



  <script src="{{ asset('dashboard.js') }}"></script>



</body>

</html>