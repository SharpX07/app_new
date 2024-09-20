console.log("Script cargado correctamente");

setInterval(() => {
    images[currentImageIndex].classList.remove('imagen-activa');
    images[currentImageIndex].classList.add('imagen-inactiva');
    
    currentImageIndex = (currentImageIndex + 1) % images.length;
    
    images[currentImageIndex].classList.remove('imagen-inactiva');
    images[currentImageIndex].classList.add('imagen-activa');
}, 20000); // Cambia la imagen cada 3 segundos
