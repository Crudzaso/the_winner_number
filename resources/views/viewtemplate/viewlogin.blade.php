<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

    <title>Document</title>
</head>
<body id="kt_body" class="app-blank">
    <!--begin::Theme mode setup on page load-->
    <script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <!--begin::Authentication - Sign-in -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-80 p-10 d-flex justify-content-center align-items-center">
                        <!--begin::Form-->
                        <form class="form w-100 p-10 h-100" novalidate="novalidate" id="kt_sign_in_form" data-kt-redirect-url="index.html" method="POST" action="{{ route('login') }}">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11 w-100">
                                <!--begin::Title-->
                                <h1 class="text-gray-900 fw-bolder mb-3">Sign In</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">Your Social Campaigns</div>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Heading-->

                            <!--begin::Login options-->
                            <div class="d-flex justify-content-center mb-4 w-100">
                                <div class="d-inline-flex w-100">
                                    <!--begin::Google link-->
                                    <a href="{{ route('auth.google') }}" class="btn btn-flex btn-outline btn-text-gray-700 btn-active-color-primary bg-state-light flex-center text-nowrap w-100">
                                        <img alt="Logo" src="{{ asset('img/google-icon.svg') }}" class="h-15px me-3" />Sign in with Google
                                    </a>
                                    <!--end::Google link-->
                                </div>
                            </div>
                            <!--end::Login options-->

                            <!--begin::Separator-->
                            <div class="separator separator-content my-14 w-100">
                                <span class="w-125px text-gray-500 fw-semibold fs-7">Or with email</span>
                            </div>
                            <!--end::Separator-->

                            <!--begin::Input group-->
                            <div class="fv-row mb-8 w-100">
                                <input type="email" placeholder="Email" name="email" autocomplete="off" class="form-control bg-transparent" :value="old('email')" required autofocus autocomplete="username" />
                            </div>
                            <!--end::Input group-->

                            <div class="fv-row mb-3 w-100">
                                <input type="password" placeholder="Password" name="password" required autocomplete="current-password" class="form-control bg-transparent" />
                            </div>
                            <!--end::Input group-->

                            <!--begin::Wrapper-->
                            <div class="d-flex flex-stack flex-wrap gap-3 fs-base fw-semibold mb-8 w-100">
                                <div></div>
                                @if (Route::has('password.request'))
                                    <a class="link-primary" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            <!--end::Wrapper-->

                            <!--begin::Submit button-->
                            <div class="d-grid mb-10 w-100">
                                <button type="submit" id="kt_sign_in_submit" class="btn btn-primary w-100">
                                    <span class="indicator-label">{{ __('Log in') }}</span>
                                </button>
                            </div>
                            <!--end::Submit button-->

                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6 w-100">
                                Not a Member yet?
                                <a href="http://127.0.0.1:8000/register" class="link-primary">Sign up</a>
                            </div>
                            <!--end::Sign up-->
                        </form>


                     
                    </div>
                </div>
                <!--end::Form-->
                <!--begin::Footer-->
                
            </div>
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2" style="background-image: url({{ asset('img/bg10-dark.jpeg') }})">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->
                    <a href="/" class="mb-0 mb-lg-12">
                        <img 
                            alt="Logo" 
                            src="{{ asset('img/the-winner-number-logo.png') }}" 
                            class="d-none d-lg-block mx-auto w-75 w-md-100 w-xl-150 mb-10 mb-lg-20" 
                            style="max-width: 500px;" 
                        />
                    </a>
                    <!--end::Logo-->
            
                    <!--begin::Image-->
                    <img 
                        class="h-150px h-lg-200px mx-auto" 
                        src="{{ asset('img/winnu.png') }}" 
                        alt="" 
                        style="max-width: 300px;" 
                    />
                    <!--end::Image-->
            
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-white fs-1x fw-bold text-center mb-7">The winner number</h1>
                    <!--end::Title-->
                </div>
                <!--end::Content-->
            </div>
            
            
        </div>
        <!--end::Authentication - Sign-in-->
    </div>
    <!--end::Root-->
    <!--begin::Javascript-->
    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('js/plugins.bundle.js') }}"></script>
    <script src="{{ asset('js/scripts.bundle.js') }}"></script>
    
</body>
<!--end::Body-->
</html>