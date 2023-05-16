<link rel="stylesheet" href="{{ asset('estilos/header.css') }}">
<link rel="stylesheet" href="{{ asset('estilos/dashboard.css') }}">
<script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>

<header>
  <nav>
    <div class="logo">
      <a href="#">NotFli</a>
      <form id="formpub" action="{{ url('buscar') }}" method="GET">
    <input autocomplete="off" id="formsearch" style="outline:none;" type="text" name="query" placeholder="Buscar...">
</form>

    </div>
    <ul class="icons">
      <li><a href="{{ route('dashboard') }}"><i style="color:white;" class="fa-solid fa-house"></i></a></li>
      <li><a href="{{ route('trending') }}"><i style="color:white;" class="fa-solid fa-arrow-trend-up"></i></a></li>
      <li><a href="#"><i class="fas fa-user"></i></a></li>
      <li><i style="color: #01B9FF;" id="edit-button" class="fa-solid fa-pen"></i></li>

    </ul>
  </nav>
</header>
<hr />


<div id="edit-modal">
  <div id="new-post-modal">
    <div class="modal-content">
      <form method="POST" action="{{ route('guardar.nota') }}" enctype="multipart/form-data">
        @csrf
        <textarea id="teztarea" name="nota" placeholder="Tu nota desde el <3"></textarea>
        <label for="imagen">Seleccionar imagen</label>
        <input type="file" id="imagen" name="imagen" accept="image/*">
        <div class="button-container">
          <br><br><br><br>

          <button type="submit" id="postbtn">Publicar</button>
          <button style="background-color: white;color: black;border-radius: 10em;font-size: 17px;padding: 1em 2em;cursor: pointer;transition: all 0.3s ease-in-out;border: 1px solid black;box-shadow: 0 0 0 0 black;" n type="button" id="close-modal">Cerrar</button>
        </div>
      </form>
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