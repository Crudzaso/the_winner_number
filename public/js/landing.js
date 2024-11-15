document.addEventListener('DOMContentLoaded', function() {
    const cards = document.querySelectorAll('.card');
    const body = document.body;

    cards.forEach(card => {
      card.addEventListener('click', function() {
        // Crear un contenedor de card maximizada
        const cardClone = card.cloneNode(true);
        cardClone.classList.remove('card');
        // cardClone.classList.add('no-hover');
        cardClone.classList.add('card-maximized');
        cardClone.innerHTML += `
          <button class="close-btn">X</button>
          <div class="extra-info">
            <h3>Más información del servicio</h3>
            <p>Descripción detallada del servicio seleccionado. Aquí puedes agregar toda la información relevante, beneficios, precios, etc.</p>
          </div>
        `;

        // Agregar el contenedor al body
        body.appendChild(cardClone);

        // Agregar un evento de cierre
        const closeButton = cardClone.querySelector('.close-btn');
        closeButton.addEventListener('click', function() {
          body.removeChild(cardClone);
        });
      });
    });
  });