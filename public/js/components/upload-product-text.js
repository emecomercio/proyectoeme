function autoExpand(field) {
    field.style.height = 'auto'; // Resetea la altura para calcular el nuevo tamaño
    field.style.height = field.scrollHeight + 'px'; // Ajusta la altura al contenido
}