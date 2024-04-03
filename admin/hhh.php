<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/dist/tabler-icons.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <style>
        .sidebar-link::before {
            position: absolute;
            top: 0;
            bottom: 0;
            left: -16px;
            content: "";
            width: 0;
            height: 100%;
            z-index: -1;
            border-radius: 0 24px 24px 0;
            transition: all .4s ease-in-out;
            background-color: #e5f3fb
        }

        #sidebarnav .sidebar-item .sidebar-link:hover:before {
            width: calc(100% + 16px)
        }

        #sidebarnav .sidebar-item .sidebar-link.active:before {
            width: calc(100% + 16px)
        }

        #sidebarnav .sidebar-item .sidebar-link.active {
            color: #006aaf
        }

        #sidebarnav .sidebar-item .sidebar-link:hover {
            color: #006aaf
        }

        .page-wrapper {
            margin-left: 270px
        }

        @media (max-width:1280px) {
            .page-wrapper {
                margin-left: 0
            }
        }
    </style>
</head>

<body>
    <main>
        <!--start the project-->
        <div id="main-wrapper" class=" flex p-5 xl:pr-0">
            <aside id="application-sidebar-brand" class="hs-overlay hs-overlay-open:translate-x-0 -translate-x-full  transform hidden xl:block xl:translate-x-0 xl:end-auto xl:bottom-0 fixed xl:top-5 xl:left-auto top-0 left-0 with-vertical h-screen z-[999] shrink-0  w-[270px] shadow-md xl:rounded-md rounded-none bg-white left-sidebar   transition-all duration-300">
                <!-- ---------------------------------- -->
                <!-- Start Vertical Layout Sidebar -->
                <!-- ---------------------------------- -->
                <div class="p-4">

                    <a href="../" class="text-nowrap">
                        <img src="./assets/images/logos/logo-light.svg" alt="Logo-Dark" />
                    </a>
                    <div class="scroll-sidebar" data-simplebar="">
                        <nav class=" w-full flex flex-col sidebar-nav px-4 mt-5">
                            <ul id="sidebarnav" class="text-gray-600 text-sm">
                                <li class="text-xs font-bold pb-[5px]">
                                    <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                                    <span class="text-xs text-gray-400 font-semibold">HOME</span>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base flex items-center rounded-md text-[#AC87C5] relative w-full" href="./index.html">
                                        <i class="ti ti-dashboard ps-2 text-2xl"></i><span>Beranda</span>
                                    </a>
                                </li>

                                <li class="text-xs font-bold mb-4 mt-6">
                                    <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                                    <span class="text-xs text-gray-400 font-semibold">UI COMPONENTS</span>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="./components/buttons.html">
                                        <i class="ti ti-article ps-2 text-2xl"></i> <span>Buttons</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="./components/alerts.html">
                                        <i class="ti ti-alert-circle ps-2 text-2xl"></i> <span>Alerts</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="./components/cards.html">
                                        <i class="ti ti-cards ps-2 text-2xl"></i> <span>Card</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="./components/forms.html">
                                        <i class="ti ti-file-description ps-2 text-2xl"></i> <span>Forms</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="./components/typography.html">
                                        <i class="ti ti-typography ps-2 text-2xl"></i> <span>Typography</span>
                                    </a>
                                </li>

                                <li class="text-xs font-bold mb-4 mt-8">
                                    <i class="ti ti-dots nav-small-cap-icon  text-lg hidden text-center"></i>
                                    <span class="text-xs text-gray-400 font-semibold">AUTH</span>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="./pages/authentication-login.html">
                                        <i class="ti ti-login ps-2 text-2xl"></i> <span>Login</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="./pages/authentication-register.html">
                                        <i class="ti ti-user-plus ps-2 text-2xl"></i> <span>Register</span>
                                    </a>
                                </li>

                                <li class="text-xs font-bold mb-4 mt-8">
                                    <i class="ti ti-dots nav-small-cap-icon text-lg hidden text-center"></i>
                                    <span class="text-xs text-gray-400 font-semibold">EXTRA</span>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="./pages/icons.html">
                                        <i class="ti ti-mood-happy ps-2 text-2xl"></i> <span>Icons</span>
                                    </a>
                                </li>

                                <li class="sidebar-item">
                                    <a class="sidebar-link gap-3 py-2.5 my-1 text-base   flex items-center relative  rounded-md text-gray-500  w-full" href="./pages/sample-page.html">
                                        <i class="ti ti-aperture ps-2 text-2xl"></i> <span>Sample Page</span>
                                    </a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>
    </main>




</body>

</html>