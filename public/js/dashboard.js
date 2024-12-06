const sidebar = document.getElementById('sidebar-to-hidden');

const button = document.querySelector('#burguer-button-sidebar');

button.addEventListener('click', () => {
  sidebar.classList.toggle('hidden');
});