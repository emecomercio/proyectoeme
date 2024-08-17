document.addEventListener('DOMContentLoaded', () => {
    // Establece el tiempo en milisegundossetTimeout(() => {
      const alert = document.getElementById('cookie-alert');
      alert.classList.add('show');
  
      const acceptButton = document.getElementById('accept-btn');
      acceptButton.addEventListener('click', () => {
        alert.classList.remove('show');
      });
    }, 60000); // 30 segundos en milisegundos
  ;
  