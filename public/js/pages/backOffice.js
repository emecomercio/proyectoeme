document.querySelectorAll('.sidebar-item').forEach(item => {
    item.addEventListener('click', (e) => {
      e.preventDefault();
  
      // Obtener el id de la sección que se desea mostrar
      const targetId = item.getAttribute('data-target');
  
      // Ocultar todas las secciones
      document.querySelectorAll('.content-section').forEach(section => {
        section.classList.remove('active');
      });
  
      // Mostrar la sección correspondiente
      const targetSection = document.getElementById(targetId);
      if (targetSection) {
        targetSection.classList.add('active');
      }
  
      // Cambiar la clase activa del sidebar
      document.querySelectorAll('.sidebar-item').forEach(link => {
        link.classList.remove('active');
      });
      item.classList.add('active');
    });
  });
  