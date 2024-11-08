<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: MetronicProduct Version: 8.2.8
Purchase: https://1.envato.market/Vm7VRE
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head>
		<meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link href="{{ asset('css/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />

        <link href="{{ asset('css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('css/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />

        <title>Document</title>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_app_body" data-kt-app-header-fixed-mobile="true" data-kt-app-sidebar-enabled="true" data-kt-app-sidebar-fixed="true" data-kt-app-sidebar-push-header="true" data-kt-app-sidebar-push-toolbar="true" data-kt-app-sidebar-push-footer="true" data-kt-app-sidebar-stacked="true" data-kt-app-sidebar-secondary-enabled="true" data-kt-app-toolbar-enabled="true" class="app-default">
		<!--begin::Theme mode setup on page load-->
		<script>var defaultThemeMode = "light"; var themeMode; if ( document.documentElement ) { if ( document.documentElement.hasAttribute("data-bs-theme-mode")) { themeMode = document.documentElement.getAttribute("data-bs-theme-mode"); } else { if ( localStorage.getItem("data-bs-theme") !== null ) { themeMode = localStorage.getItem("data-bs-theme"); } else { themeMode = defaultThemeMode; } } if (themeMode === "system") { themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light"; } document.documentElement.setAttribute("data-bs-theme", themeMode); }</script>
		<!--end::Theme mode setup on page load-->
		<!--begin::App-->
		<div class="d-flex flex-column flex-root app-root" id="kt_app_root">
			<!--begin::Page-->
			<div class="app-page flex-column flex-column-fluid" id="kt_app_page">
				<!--begin::Header-->
				<div id="kt_app_header" class="app-header d-flex d-lg-none" data-kt-sticky="true" data-kt-sticky-activate="{default: false, lg: true}" data-kt-sticky-name="app-header-sticky" data-kt-sticky-offset="{default: false, lg: '300px'}">
					<!--begin::Header container-->
					<div class="app-container container-xxl d-flex align-items-center justify-content-between" id="kt_app_header_container">
						<!--begin::Logo-->
						<div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0 me-lg-15">
                            <a href="index.html">
                                <img alt="Logo" src="{{ asset('img/winnu.png')}}" class="h-80px" />
                            </a>
                        </div>

						<!--end::Logo-->
						<!--begin::Header mobile toggle-->
						<div class="d-flex align-items-center d-lg-none ms-2" title="Show sidebar menu">
							<div class="btn btn-icon btn-color-white bg-white bg-opacity-0 bg-hover-opacity-10 w-35px h-35px" id="kt_app_sidebar_mobile_toggle">
								<i class="ki-outline ki-abstract-14 fs-2"></i>
							</div>
						</div>
						<!--end::Header mobile toggle-->
					</div>
					<!--end::Header container-->
				</div>
				<!--end::Header-->
				<!--begin::Wrapper-->
				<div class="app-wrapper flex-column flex-row-fluid" id="kt_app_wrapper">
					<!--begin::Sidebar-->
					<div id="kt_app_sidebar" class="app-sidebar" data-kt-drawer="true" data-kt-drawer-name="app-sidebar" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="auto" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_app_sidebar_mobile_toggle">
						<!--begin::Sidebar primary-->
						<div class="app-sidebar-primary">
							<!--begin::Logo-->
							<div class="app-sidebar-logo d-none d-md-flex flex-center pt-10 pb-2" id="kt_app_sidebar_logo">
								<!--begin::Logo image-->
								<a href="index.html">
									<img alt="Logo" src="assets/media/logos/default-small.svg" class="h-30px" />
								</a>
								<!--end::Logo image-->
							</div>
							<!--end::Logo-->
							<!--begin::Primary menu-->
							<div class="app-sidebar-menu flex-grow-1 hover-scroll-overlay-y scroll-ps mx-2 my-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer" data-kt-scroll-wrappers="#kt_app_sidebar_menu" data-kt-scroll-offset="5px">
								<!--begin::Footer-->
								<div class="d-flex flex-column flex-center pb-4 pb-lg-8" id="kt_app_sidebar_footer">
									<!--begin::User menu-->
									<div class="cursor-pointer symbol symbol-40px symbol-circle" data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-attach="parent" data-kt-menu-placement="right-end">
										<img src="assets/media/avatars/300-2.jpg" alt="user" />
									</div>
									<!--begin::User account menu-->
									<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px" data-kt-menu="true">
										<!--begin::Menu item-->
										<div class="menu-item px-3">
											<div class="menu-content d-flex align-items-center px-3">
												<!--begin::Avatar-->
												<div class="symbol symbol-50px me-5">
													<img alt="Logo" src="assets/media/avatars/300-2.jpg" />
												</div>
												<!--end::Avatar-->
												<!--begin::Username-->
												<div class="d-flex flex-column">
													<div class="fw-bold d-flex align-items-center fs-5">Max Smith 
														<span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
															Pro
														</span>
													</div>
													<a href="#" class="fw-semibold text-muted text-hover-primary fs-7">max@kt.com</a>
												</div>
												<!--end::Username-->
											</div>
										</div>
										<!--end::Menu item-->
									</div>
									<!--end::User account menu-->
								</div>
								<!--begin:Menu item-->
								<div data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-placement="right-start" class="menu-item py-2">
									<!--begin:Menu link-->
									<span class="menu-link menu-center">
										<span class="menu-icon me-0">
											<i class="ki-outline ki-notification-status fs-2x"></i>
										</span>
									</span>
									<!--end:Menu link-->
								</div>
							</div>
							<!--end::Primary menu-->
						</div>
						<!--end::Sidebar primary-->
						<!--begin::Sidebar secondary-->
						<div class="app-sidebar-secondary">
							<!--begin::Sidebar secondary menu-->
							<div class="menu menu-sub-indention menu-rounded menu-column menu-active-bg menu-title-gray-600 menu-icon-gray-500 menu-state-primary menu-arrow-gray-500 fw-semibold fs-6 py-4 py-lg-6" id="kt_app_sidebar_secondary_menu" data-kt-menu="true">
								<div id="kt_app_sidebar_secondary_menu_wrapper" class="hover-scroll-y mx-2 px-2" data-kt-scroll="true" data-kt-scroll-activate="{default: true, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-wrappers="#kt_app_sidebar_secondary_menu" data-kt-scroll-offset="20px">
									<!--begin:Menu item-->
									<div class="menu-item">
										<!--begin:Menu content-->
										<div class="menu-content">
											<span class="menu-section fs-5 fw-bolder ps-1 py-1">Home</span>
										</div>
										<!--end:Menu content-->
									</div>
									<!--end:Menu item-->
									<!--begin:Menu item-->
									<div class="menu-item">
										<!--begin:Menu link-->
										<a class="menu-link" href="index.html">
											<span class="menu-bullet">
												<span class="bullet bullet-dot"></span>
											</span>
											<span class="menu-title">Default</span>
										</a>
										<!--end:Menu link-->
									</div>
									<!--end:Menu item-->
									
								</div>
							</div>
							<!--end::Sidebar secondary menu-->
						</div>
						<!--end::Sidebar secondary-->
						<!--begin::Sidebar secondary toggle-->
						<button id="kt_app_sidebar_secondary_toggle" class="app-sidebar-secondary-toggle btn btn-sm btn-icon bg-body btn-color-gray-600 btn-active-color-primary position-absolute translate-middle z-index-1 start-100 end-0 bottom-0 shadow-sm d-none d-lg-flex mb-4" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="app-sidebar-secondary-collapse">
							<i class="ki-outline ki-arrow-left fs-2 rotate-180"></i>
						</button>
						<!--end::Sidebar secondary toggle-->
					</div>
					<!--end::Sidebar-->
					<!--begin::Activities drawer-->
				</div>
			</div>
		</div>		
        <script src="{{ asset('js/scripts.bundle.js') }}"></script>
	</body>
	<!--end::Body-->
</html>