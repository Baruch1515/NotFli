
const likeButton = document.getElementById('like-button');

likeButton.addEventListener('click', () => {
  // Envía una solicitud de Ajax al servidor
  fetch('{{ route("likes.store", $nota->id) }}', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': '{{ csrf_token() }}'
    },
    body: JSON.stringify({
      nota_id: '{{ $nota->id }}'
    })
  })
  
  .then(response => {
    if (response.ok) {
      // Actualiza el botón de like
      likeButton.innerHTML = '<i class="fa-solid fa-star"></i>';
    } else {
      console.error('Error al dar like');
    }
  })
  .catch(error => {
    console.error(error);
  });
});
