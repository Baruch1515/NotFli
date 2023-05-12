<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://kit.fontawesome.com/0c07597779.js" crossorigin="anonymous"></script>
    <script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
    <link rel="stylesheet" href="{{ asset('estilos/repost.css') }}">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Repostear</title>
</head>
<body style="background-color:#232322;">
@include('header')
<br><br>


<div id="my-content">
  <!-- Tu contenido aquí -->
  <div class="code-editor image-with-text">
    <div class="header">
      <span class="titlec">NotFli/{{$nota->user->name}}</span>
    </div>
    <div class="editor-content">
      <code class="code">
        <br>{{$nota->nota}}
      </code>
    </div>
  </div>
</div>
<br>

 <center><i id="download-btn" style=" margin: 0 auto; color:black; background-color: white;color: black;border-radius: 10em;font-size: 17px;padding: 1em 2em;cursor: pointer;transition: all 0.3s ease-in-out;border: 1px solid black;box-shadow: 0 0 0 0 black;"class="fa-solid fa-download"></i></center>

<script>
  const downloadBtn = document.getElementById('download-btn');
downloadBtn.addEventListener('click', function() {
  downloadImage();
});
function downloadImage() {
  const divToConvert = document.querySelector('.image-with-text');

  html2canvas(divToConvert).then(function(canvas) {
    const imgData = canvas.toDataURL('image/jpeg');
    const img = new Image();
    img.src = imgData;
    const link = document.createElement('a');
    link.download = 'nombre-de-tu-imagen.png'; // cambia el nombre y la extensión a tu gusto
    link.href = imgData;
    link.click();
  });
}
</script>
</body>
</html>