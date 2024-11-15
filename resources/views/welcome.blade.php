<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>The Winner Number</title>

        <!-- Fonts -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href="{{ asset('css/landing.css') }}">

       
    </head>
    <body class="font-sans antialiased">
                    <header class="grid grid-cols-2 items-center gap-2 py-10 lg:grid-cols-3">
                        @if (Route::has('login'))
                            <nav class="-mx-3 flex flex-1 justify-end">
                                @auth
                                    <a
                                        href="{{ url('/dashboard') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Dashboard
                                    </a>
                                @else
                                    <a
                                        href="{{ route('view.viewlogin') }}"
                                        class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                    >
                                        Log in
                                    </a>

                                    @if (Route::has('register'))
                                        <a
                                            href="{{ route('register') }}"
                                            class="rounded-md px-3 py-2 text-black ring-1 ring-transparent transition hover:text-black/70 focus:outline-none focus-visible:ring-[#FF2D20]"
                                        >
                                            Register
                                        </a>
                                    @endif
                                @endauth
                            </nav>
                        @endif
                    </header>

                    <div class="container px-4 px-lg-5">
                        <!-- Heading Row-->
                        <div class="row gx-4 gx-lg-5 align-items-center my-5">
                            <div class="col-lg-7" style="background-image: url({{ asset('img/bg10-dark.jpeg') }})"><img class="d-none d-lg-block mx-auto w-75 w-md-100 w-xl-150 mb-10 mb-lg-20" src="{{ asset('img/the-winner-number-logo.png') }}" alt="..." /></div>
                            <div class="col-lg-5">
                                <h1 class="font-weight-light">The Winner Number</h1>
                                <p>Bienvenido a tu aplicación de rifas favoritas, escoge una y juega para ganar!!</p>
                                <a class="btn btn-primary" href="#!">Ver todas las rifas</a>
                            </div>
                        </div>
                        <!-- Call to Action-->
                        <div class="card text-white bg-secondary my-5 py-4 text-center">
                            <div class="card-body"><p class="text-white m-0">This call to action card is a great place to showcase some important information or display a clever tagline!</p></div>
                        </div>
                        <!-- Content Row-->
                        <div class="row gx-4 gx-lg-5">

                            <!-- Primera card--> 
                            <div class="col-md-4 mb-5">
                                <div class="card h-100" data-id="1">
                                    <div class="card-body">
                                        <h2 class="card-title">Raffle</h2>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
                                    </div>
                                    <div class="card-footer"><a class="btn btn-primary btn-sm card-button" href="#!">More Info</a></div>
                                </div>
                            </div>

                            <!-- Segunda card--> 
                            <div class="col-md-4 mb-5">
                                <div class="card h-100" data-id="2">
                                    <div class="card-body">
                                        <h2 class="card-title">Raffle</h2>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod tenetur ex natus at dolorem enim! Nesciunt pariatur voluptatem sunt quam eaque, vel, non in id dolore voluptates quos eligendi labore.</p>
                                    </div>
                                    <div class="card-footer"><a class="btn btn-primary btn-sm card-button" href="#!">More Info</a></div>
                                </div>
                            </div>

                            <!-- Tercera card--> 
                            <div class="col-md-4 mb-5">
                                <div class="card h-100" data-id="3">
                                    <div class="card-body">
                                        <h2 class="card-title">Raffle</h2>
                                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem magni quas ex numquam, maxime minus quam molestias corporis quod, ea minima accusamus.</p>
                                    </div>
                                    <div class="card-footer"><a class="btn btn-primary btn-sm card-button" href="#!">More Info</a></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <footer class="py-16 text-center text-sm text-black">
                        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
                    </footer>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/landing.js') }}"></script>
    </body>
</html>
