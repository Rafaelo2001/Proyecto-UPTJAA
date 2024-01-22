// Define la función que muestra la alerta de éxito.
function mostrarAlertaExito() {
  Swal.fire({
    title: '¡Éxito!',
    text: 'Los datos del formulario se han enviado correctamente.',
    icon: 'success',
    confirmButtonText: '¡Entendido!'
  }).then((result) => {
    if (result.isConfirmed) {
      location.reload();
    }
  });
}

// Define la función que muestra la alerta de error.
function mostrarAlertaError() {
    Swal.fire({
        title: '¡Error!',
        text: 'Los datos del formulario no se han enviado correctamente.',
        icon: 'error',
        confirmButtonText: 'Volver a intentar'
      });
  }
  


