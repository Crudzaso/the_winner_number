const printDataIntoContainer = (container) => {
      container.innerHTML += `
        <article class="played-lottery-card">
          <h4>Lotería del Año</h4>
          <p>12/12/2024</p>
          <p>Ganador: 1234567890</p>
          <a href="">Ver detalles</a>
        </article>
      `;
   
  }
  
  const getPlayedLoteries = async () => {
    const containerOfPlayedLotteries = document.querySelector('#lottery-container-playedd');
   
   try {
     const response = await fetch('https://api-resultadosloterias.com/api/results');
     const lotteries = await response.json();
     const { data } = lotteries;
  
     if (containerOfPlayedLotteries) {
       data.forEach(lottery => {
         console.log(lottery);
         printDataIntoContainer(containerOfPlayedLotteries);
         console.log(containerOfPlayedLotteries);
         
       });
     } else {
       console.error('No se encontró el contenedor de loterias');
     }
   } catch (error) {
     console.error('Error al obtener las loterías:', error);
   }
  }
  getPlayedLoteries()

  document.addEventListener('DOMContentLoaded', getPlayedLoteries)
  
  