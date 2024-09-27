document.addEventListener('DOMContentLoaded', function() {

    const imagenes = document.querySelectorAll('.img');

    imagenes.forEach(imagen => {
        
        imagen.addEventListener('mouseover', function() {

            titulo = this.getAttribute('data-titulo');
            tema = this.getAttribute('data-tema');

            let ventanaEmergente = this.parentNode.querySelector('.ventanaEmergente');
            
            if (!ventanaEmergente) {
                ventanaEmergente = document.createElement('div');
                ventanaEmergente.classList.add('ventanaEmergente');
                this.parentNode.appendChild(ventanaEmergente);
            }

            ventanaEmergente.innerHTML = `<strong>Título:</strong> ${titulo}<br>
                                          <strong>Tema:</strong> ${tema}<br>`;

            ventanaEmergente.style.display = 'block';
        });

        imagen.addEventListener('mouseout', function() {
            const ventanaEmergente = this.parentNode.querySelector('.ventanaEmergente');
            if (ventanaEmergente) {
                ventanaEmergente.style.display = 'none';
            }
        });
    });
});