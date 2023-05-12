<link rel="stylesheet" href="{{ asset('estilos/header.css') }}">
<div class='head'>
  <span class='title'>NotFli.</span>
  <div class='head-tools'>
    <input style="font-family: Favorit, " Helvetica Neue", HelveticaNeue, Helvetica, Arial, sans-serif;;" class='search' placeholder='Search' />
    <a href="{{ route('dashboard') }}"><i style="color:white;" class="fa-solid fa-house"></i></a>
    <a href="{{ route('trending') }}"><i style="color:white;" class="fa-solid fa-arrow-trend-up"></i></a>
    <i class="fa-solid fa-magnifying-glass"></i>
    <i class="fa-solid fa-user"></i>
    <i style="color: #01B9FF;" id="edit-button" class="fa-solid fa-pen"></i>
  </div>
  <hr />
</div>