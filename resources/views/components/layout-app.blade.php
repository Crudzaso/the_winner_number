<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/layout-styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/details-lottery.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
    <div class="hero-homepage">
        <header id="header" class="">
            <a href=""><img src="{{ asset('images/logo.png') }}" alt=""></a>
      
          <nav class="desktop-nav hidden xl:flex">
            <a href="">Inicio</a>
            <a href="">Rifas activas</a>
            <a href="">Rifas jugadas</a>
            <a href="">Transpariencia</a>
            <a href="">Informacion</a>
            <div class="user-buttons-header">
              <a href="">Iniciar sesion</a>
              <a href="">Registrarse</a>
            </div>
          </nav>
          <div>
            
          </div>
          <button id="toggle-header" class="flex xl:hidden w-20 mt-5"><img src="https://cdn-icons-png.flaticon.com/512/9451/9451364.png" alt=""></button>
        </header>
        <nav class="mobile-nav hidden bg-black xl:hidden z-50" id="mobile-nav">
          <a href="">Inicio</a>
          <a href="">Rifas activas</a>
          <a href="">Rifas jugadas</a>
          <a href="">Transpariencia</a>
          <a href="">Informacion</a>
          <div class="user-buttons-header pb-7">
            <a href="">Iniciar sesion</a>
            <a href="">Registrarse</a>
          </div>
        </nav>         
        <main>
            {{$slot}}
        </main>
        <footer>
            <img class="transparency-img" src="{{ asset('images/transparency.jpg') }}" alt="">
            <div class="footer-content">
              <div>
                <h5>Contacto:</h5>
                <a href=""><i class="bi bi-instagram"></i>Instagram</a>
                <a href=""><i class="bi bi-envelope"></i>Email</a>
                <a href=""><i class="bi bi-whatsapp"></i>WhatsApp</a>
                <a href=""><i class="bi bi-twitter-x"></i>X</a>
                <a href=""><i class="bi bi-browser-chrome"></i>Web</a>
              </div>
              <div>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.3378179448664!2d-75.58618982416107!3d6.219106326624008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e44293f0e114eef%3A0x99610cdd44c7c081!2sRiwi!5e0!3m2!1ses!2sco!4v1733285131294!5m2!1ses!2sco" width="250" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
              </div>
            </div>
            <p class="copy-message">Todos los derechos reservados || The winner number</p>
          </footer>
   <script src="{{ asset('js/main-layout.js') }}"></script>       
</body>
</html>