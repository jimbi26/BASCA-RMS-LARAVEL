<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        BASCA-RMS | Senior Citizen Records Management System
    </title>
 <x-browse-top />
    <meta name="description"
        content="Barangay Association of Senior Citizens Affairs Records Management System - Bagabag, Nueva Vizcaya">
    {{-- Tailwind --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:wght@500;600;700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">


    <style>
        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Poppins', sans-serif;
        }

        .font-fraunces {
            font-family: 'Fraunces', serif;
        }

        .hero-overlay {
            background:
                linear-gradient(90deg,
                    rgba(20, 41, 77, 0.96) 0%,
                    rgba(20, 41, 77, 0.90) 48%,
                    rgba(20, 41, 77, 0.40) 100%);
        }

        .gold-line {
            width: 70px;
            height: 4px;
            background: #C69A2E;
        }

        .news-card {
            transition: all 0.25s ease;
        }

        .news-card:hover {
            transform: translateY(-5px);
        }


        /* =========================================================
       STICKY HEADER
    ========================================================= */

        header {
            position: sticky;
            top: 0;
            z-index: 50;
        }


        /* =========================================================
       SECTION SCROLL OFFSET
    ========================================================= */

        section[id] {
            scroll-margin-top: 100px;
        }


        /* =========================================================
       DESKTOP NAVIGATION
    ========================================================= */

        .nav-link {
            position: relative;
            transition:
                color 0.2s ease,
                opacity 0.2s ease;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;

            height: 3px;

            background: #C69A2E;

            transform: scaleX(0);
            transform-origin: center;

            transition:
                transform 0.25s ease;
        }

        .nav-link:hover {
            color: #14294D;
        }

        .nav-link.active {
            color: #14294D;
        }

        .nav-link.active::after {
            transform: scaleX(1);
        }


        /* =========================================================
       MOBILE MENU
    ========================================================= */

        #mobileMenu {
            max-height: 0;
            overflow: hidden;
            opacity: 0;

            transition:
                max-height 0.3s ease,
                opacity 0.2s ease;
        }

        #mobileMenu.open {
            max-height: 500px;
            opacity: 1;
        }


        /* =========================================================
       MOBILE NAV LINKS
    ========================================================= */

        .mobile-nav-link {
            position: relative;
            transition:
                color 0.2s ease,
                background-color 0.2s ease;
        }

        .mobile-nav-link.active {
            color: #14294D;
            background-color: #f8fafc;
            font-weight: 600;
        }

        .mobile-nav-link.active::before {
            content: '';

            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;

            width: 4px;

            background: #C69A2E;
        }


        /* =========================================================
       HAMBURGER
    ========================================================= */

        .hamburger-line {
            width: 22px;
            height: 2px;

            background: #14294D;

            transition:
                transform 0.25s ease,
                opacity 0.2s ease;
        }

        #mobileMenuButton.open .line-1 {
            transform: translateY(7px) rotate(45deg);
        }

        #mobileMenuButton.open .line-2 {
            opacity: 0;
        }

        #mobileMenuButton.open .line-3 {
            transform: translateY(-7px) rotate(-45deg);
        }


        /* =========================================================
       MOBILE HEADER
    ========================================================= */

        @media (max-width: 1023px) {

            header {
                box-shadow: 0 2px 8px rgba(15, 23, 42, 0.06);
            }

        }
    </style>

</head>


<body class="bg-white text-slate-800">


    {{-- =========================================================
    TOP GOVERNMENT BAR
    ========================================================= --}}

    <div class="bg-[#0d1b33] text-white">

        <div class="w-full px-5 sm:px-8 lg:px-12">

            <div class="min-h-[38px] flex items-center justify-between gap-5">

                <p class="text-[11px] sm:text-xs text-slate-300">
                    REPUBLIC OF THE PHILIPPINES
                </p>

                <p class="hidden sm:block text-[11px] text-slate-400">
                    BAGABAG • NUEVA VIZCAYA
                </p>

            </div>

        </div>

    </div>



    {{-- =========================================================
    MAIN HEADER
    ========================================================= --}}
    <header class="sticky top-0 z-50 w-full bg-white border-b border-slate-200">

        <div class="w-full px-5 sm:px-8 lg:px-12">

            <div class="min-h-[92px] flex items-center justify-between gap-8">

                {{-- =====================================================
                LOGO / BRAND
                ====================================================== --}}

                <a href="{{ url('/') }}" class="flex items-center gap-4 flex-shrink-0">

                    {{-- TWO LOGOS --}}
                    <div class="flex items-center gap-3">

                        {{-- FIRST LOGO --}}
                        <div class="w-[52px] h-[52px] flex items-center justify-center">
                            <img src="{{ asset('storage/mfscapLogo.jpg') }}" alt="MFSCAP Logo"
                                class="w-full h-full object-contain" onerror="this.style.display='none';">
                        </div>


                        {{-- DIVIDER --}}
                        <div class="h-10 w-px bg-slate-300"></div>


                        {{-- SECOND LOGO --}}
                        <div class="w-[52px] h-[52px] flex items-center justify-center">
                            <img src="{{ asset('storage/bagabagLogo.jpg') }}" alt="Bagabag Logo"
                                class="w-full h-full object-contain" onerror="this.style.display='none';">
                        </div>

                    </div>


                    {{-- SYSTEM NAME --}}
                    <div class="leading-tight border-l border-slate-200 pl-4">

                        <p class="font-fraunces text-[24px] font-semibold text-[#14294D]">
                            BASCA-RMS
                        </p>

                        <p class="text-[10px] sm:text-xs text-slate-500 uppercase tracking-wide max-w-[280px]">
                            Barangay Association of Senior Citizens Affairs
                        </p>

                        <p class="text-[9px] text-[#C69A2E] font-semibold tracking-wider mt-0.5">
                            BAGABAG, NUEVA VIZCAYA
                        </p>

                    </div>

                </a>


                {{-- =====================================================
                DESKTOP NAVIGATION
                ====================================================== --}}

                <nav class="hidden lg:flex items-center flex-1 justify-end">

                    <div class="flex items-center gap-7 xl:gap-9">

                        <a href="#home" class="nav-link active py-8 text-sm font-semibold text-slate-600">

                            Home

                        </a>


                        <a href="#about" class="nav-link py-8 text-sm font-semibold text-slate-600">

                            About

                        </a>


                        <a href="#services" class="nav-link py-8 text-sm font-semibold text-slate-600">

                            Services

                        </a>


                        <a href="#information" class="nav-link py-8 text-sm font-semibold text-slate-600">

                            Information

                        </a>


                        <a href="#contact" class="nav-link py-8 text-sm font-semibold text-slate-600">

                            Contact

                        </a>


                        <a href="{{ route('login') }}"
                            class="inline-flex items-center justify-center px-6 py-2.5 bg-[#14294D] text-white text-sm font-semibold hover:bg-[#1c3968] transition">

                            System Login

                        </a>

                    </div>

                </nav>


                {{-- =====================================================
                MOBILE HAMBURGER
                ====================================================== --}}

                <button type="button" id="mobileMenuButton" aria-label="Open navigation menu" aria-expanded="false"
                    class="lg:hidden w-11 h-11 border border-slate-200 flex flex-col items-center justify-center gap-[5px] text-[#14294D] hover:bg-slate-50 transition">

                    <span class="hamburger-line line-1"></span>

                    <span class="hamburger-line line-2"></span>

                    <span class="hamburger-line line-3"></span>

                </button>

            </div>


            {{-- =====================================================
            MOBILE NAVIGATION
            ====================================================== --}}

            <div id="mobileMenu" class="lg:hidden border-t border-slate-100">

                <div class="flex flex-col py-2">


                    <a href="#home" class="mobile-nav-link active px-5 py-3.5 text-sm text-slate-600">

                        Home

                    </a>


                    <a href="#about" class="mobile-nav-link px-5 py-3.5 text-sm text-slate-600">

                        About

                    </a>


                    <a href="#services" class="mobile-nav-link px-5 py-3.5 text-sm text-slate-600">

                        Services

                    </a>


                    <a href="#information" class="mobile-nav-link px-5 py-3.5 text-sm text-slate-600">

                        Information

                    </a>


                    <a href="#contact" class="mobile-nav-link px-5 py-3.5 text-sm text-slate-600">

                        Contact

                    </a>


                    <a href="{{ route('login') }}"
                        class="mx-5 my-3 px-5 py-3 text-center bg-[#14294D] text-white text-sm font-semibold hover:bg-[#1c3968] transition">

                        System Login

                    </a>

                </div>

            </div>

        </div>

    </header>



    {{-- =========================================================
    HERO / BANNER
    ========================================================= --}}

    <section id="home" class="relative min-h-[590px] lg:min-h-[650px] overflow-hidden bg-[#14294D]">


        {{-- Background image area --}}

        <div class="absolute inset-0">

            <img src="{{ asset('storage/senior-banner.jpg') }}" alt="Senior Citizens" class="w-full h-full object-cover"
                onerror="this.style.display='none';">

        </div>


        {{-- Overlay --}}

        <div class="absolute inset-0 hero-overlay"></div>


        {{-- Decorative background --}}

        <div class="absolute right-0 top-0 w-[45%] h-full bg-gradient-to-l from-[#C69A2E]/10 to-transparent">
        </div>



        <div class="relative z-10 w-full px-5 sm:px-8 lg:px-12 xl:px-20">

            <div class="min-h-[590px] lg:min-h-[650px] flex items-center">

                <div class="w-full grid lg:grid-cols-2 gap-10 lg:gap-14 items-center">

                    {{-- LEFT: HERO CONTENT --}}
                    <div class="max-w-3xl py-20">

                        <div class="flex items-center gap-3 mb-6">

                            <div class="gold-line"></div>

                            <p class="text-[#E0B94E] text-sm font-semibold uppercase tracking-[0.18em]">
                                Office for Senior Citizens Affairs
                            </p>

                        </div>

                        <h1
                            class="font-fraunces text-5xl sm:text-6xl lg:text-7xl leading-[1.05] text-white font-semibold">

                            Better Records.

                            <br>

                            <span class="text-[#E0B94E]">
                                Better Service.
                            </span>

                        </h1>

                        <p class="mt-7 max-w-2xl text-base sm:text-lg lg:text-xl leading-8 text-slate-200">

                            The Barangay Association of Senior Citizens Affairs
                            Records Management System provides a centralized and
                            organized way to manage senior citizen records
                            throughout Bagabag, Nueva Vizcaya.

                        </p>

                        <div class="mt-9 flex flex-col sm:flex-row gap-3">

                            <a href="{{ route('login') }}"
                                class="inline-flex items-center justify-center gap-3 px-7 py-3.5 bg-[#C69A2E] text-white font-semibold text-sm hover:bg-[#b88d28] transition">

                                Access BASCA-RMS

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 7l5 5m0 0l-5 5m5-5H6" />

                                </svg>

                            </a>

                            <a href="#about"
                                class="inline-flex items-center justify-center px-7 py-3.5 border border-white/40 text-white font-semibold text-sm hover:bg-white hover:text-[#14294D] transition">

                                Learn More

                            </a>

                        </div>

                        <div class="mt-9 flex items-center gap-3">

                            <div class="w-9 h-9 rounded-full border border-white/30 flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-[#E0B94E]" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                        d="M9 12l2 2 4-4" />

                                </svg>

                            </div>

                            <p class="text-sm text-slate-300">
                                Centralized • Organized • Accessible
                            </p>

                        </div>

                    </div>


                    {{-- RIGHT: SYSTEM PREVIEW --}}
                    <div class="hidden lg:flex justify-center items-center">

                        <div class="relative w-full max-w-[620px]">

                            {{-- Glow --}}
                            <div class="absolute -inset-6 bg-[#C69A2E]/10 blur-3xl rounded-full"></div>

                            {{-- Browser Window --}}
                            <div class="relative rounded-xl overflow-hidden
                                border border-white/20
                                bg-white/10
                                backdrop-blur-sm
                                shadow-2xl">

                                {{-- Browser Header --}}
                                <div class="h-10 bg-[#0d1d38] flex items-center px-4 gap-2">

                                    <span class="w-3 h-3 rounded-full bg-red-400/80"></span>
                                    <span class="w-3 h-3 rounded-full bg-yellow-400/80"></span>
                                    <span class="w-3 h-3 rounded-full bg-green-400/80"></span>

                                    <div class="ml-4 flex-1 h-5 rounded bg-white/5"></div>

                                </div>

                                {{-- System Screenshot --}}
                                <div class="bg-white">

                                    <img src="{{ asset('storage/image.png') }}" alt="BASCA-RMS Dashboard Preview"
                                        class="w-full h-auto block">

                                </div>

                            </div>

                            {{-- Floating Label --}}
                            <div class="absolute -bottom-5 -left-5
                                bg-white px-5 py-3
                                shadow-xl rounded-lg
                                flex items-center gap-3">

                                <div class="w-9 h-9 rounded-full
                                    bg-[#14294D]
                                    flex items-center justify-center">

                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-[#E0B94E]" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">

                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4 6h16M4 10h16M4 14h10M4 18h7" />

                                    </svg>

                                </div>

                                <div>
                                    <p class="text-xs text-slate-500">
                                        Powered by
                                    </p>

                                    <p class="text-sm font-bold text-[#14294D]">
                                        BASCA-RMS
                                    </p>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Bottom gold line --}}

        <div class="absolute bottom-0 left-0 right-0 h-1 bg-[#C69A2E]"></div>

    </section>



    {{-- =========================================================
    QUICK ACCESS BAR
    ========================================================= --}}

    <section class="bg-white border-b border-slate-200">

        <div class="w-full px-5 sm:px-8 lg:px-12">

            <div class="grid sm:grid-cols-2 lg:grid-cols-4">

                <div class="px-6 py-7 border-b lg:border-b-0 lg:border-r border-slate-200">

                    <p class="text-xs uppercase tracking-wider text-slate-400">
                        System
                    </p>

                    <p class="mt-1 text-lg font-semibold text-[#14294D]">
                        Senior Records
                    </p>

                </div>


                <div class="px-6 py-7 border-b lg:border-b-0 lg:border-r border-slate-200">

                    <p class="text-xs uppercase tracking-wider text-slate-400">
                        Coverage
                    </p>

                    <p class="mt-1 text-lg font-semibold text-[#14294D]">
                        Bagabag, Nueva Vizcaya
                    </p>

                </div>


                <div class="px-6 py-7 border-b sm:border-b-0 lg:border-r border-slate-200">

                    <p class="text-xs uppercase tracking-wider text-slate-400">
                        Purpose
                    </p>

                    <p class="mt-1 text-lg font-semibold text-[#14294D]">
                        Records Management
                    </p>

                </div>


                <div class="px-6 py-7">

                    <p class="text-xs uppercase tracking-wider text-slate-400">
                        Access
                    </p>

                    <a href="{{ route('login') }}"
                        class="mt-1 inline-flex items-center gap-2 text-lg font-semibold text-[#C69A2E] hover:text-[#14294D]">

                        Login to System

                        <span>→</span>

                    </a>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
    ABOUT SECTION
    ========================================================= --}}

    <section id="about" class="py-24 lg:py-28 bg-slate-50">

        <div class="w-full px-5 sm:px-8 lg:px-12 xl:px-20">

            <div class="grid lg:grid-cols-2 gap-16 items-center">


                {{-- LEFT --}}

                <div>

                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#C69A2E]">
                        About the System
                    </p>

                    <h2
                        class="mt-4 font-fraunces text-4xl sm:text-5xl lg:text-6xl leading-tight font-semibold text-[#14294D]">

                        A digital foundation for
                        <span class="text-[#C69A2E]">
                            better senior services.
                        </span>

                    </h2>


                    <div class="gold-line mt-7"></div>


                    <p class="mt-7 text-slate-600 leading-8">

                        BASCA-RMS is a records management system developed to
                        support the organization and administration of senior
                        citizen information in Bagabag, Nueva Vizcaya.

                    </p>


                    <p class="mt-5 text-slate-600 leading-8">

                        Instead of relying solely on physical documents and
                        fragmented records, authorized personnel can use the
                        system to efficiently search, update, review, and
                        maintain senior citizen information.

                    </p>

                </div>



                {{-- RIGHT --}}

                <div class="relative">

                    <div class="bg-white border border-slate-200 shadow-xl p-7 sm:p-9">


                        <div class="flex items-start gap-5">

                            <div class="w-14 h-14 flex-shrink-0 bg-[#14294D] flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-white" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                        d="M4 5a2 2 0 012-2h8l6 6v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" />

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                        d="M14 3v6h6M8 13h8M8 17h5" />

                                </svg>

                            </div>


                            <div>

                                <p class="text-xl font-semibold text-[#14294D]">
                                    Centralized Records
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    One system for organized information.
                                </p>

                            </div>

                        </div>


                        <div class="mt-8 space-y-5">


                            <div class="flex gap-4">

                                <div
                                    class="w-8 h-8 flex-shrink-0 bg-[#C69A2E] text-white flex items-center justify-center text-sm font-bold">
                                    01
                                </div>

                                <div>

                                    <p class="font-semibold text-[#14294D]">
                                        Record
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500 leading-6">
                                        Maintain complete senior citizen records
                                        in a centralized database.
                                    </p>

                                </div>

                            </div>


                            <div class="flex gap-4">

                                <div
                                    class="w-8 h-8 flex-shrink-0 bg-[#14294D] text-white flex items-center justify-center text-sm font-bold">
                                    02
                                </div>

                                <div>

                                    <p class="font-semibold text-[#14294D]">
                                        Manage
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500 leading-6">
                                        Update and maintain information whenever
                                        changes are needed.
                                    </p>

                                </div>

                            </div>


                            <div class="flex gap-4">

                                <div
                                    class="w-8 h-8 flex-shrink-0 bg-[#14294D] text-white flex items-center justify-center text-sm font-bold">
                                    03
                                </div>

                                <div>

                                    <p class="font-semibold text-[#14294D]">
                                        Retrieve
                                    </p>

                                    <p class="mt-1 text-sm text-slate-500 leading-6">
                                        Find records quickly through search,
                                        filtering, and organized information.
                                    </p>

                                </div>

                            </div>


                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
    SERVICES
    ========================================================= --}}

    <section id="services" class="py-24 bg-white">

        <div class="w-full px-5 sm:px-8 lg:px-12 xl:px-20">


            <div class="text-center max-w-3xl mx-auto">

                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#C69A2E]">
                    What BASCA-RMS Provides
                </p>

                <h2 class="mt-4 font-fraunces text-4xl sm:text-5xl font-semibold text-[#14294D]">

                    Tools designed for
                    <span class="text-[#C69A2E]">
                        efficient records management.
                    </span>

                </h2>

                <p class="mt-5 text-slate-600 leading-7">
                    A practical digital system for authorized personnel
                    managing senior citizen records in Bagabag.
                </p>

            </div>



            <div class="mt-14 grid md:grid-cols-2 lg:grid-cols-4 gap-0 border border-slate-200">


                {{-- CARD 1 --}}

                <div class="p-8 border-b md:border-b-0 md:border-r border-slate-200 hover:bg-slate-50 transition">

                    <div class="w-12 h-12 bg-[#14294D] flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                d="M4 5a2 2 0 012-2h8l6 6v10a2 2 0 01-2 2H6a2 2 0 01-2-2V5z" />

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M14 3v6h6" />

                        </svg>

                    </div>


                    <h3 class="mt-6 text-xl font-semibold text-[#14294D]">
                        Senior Records
                    </h3>

                    <p class="mt-3 text-sm leading-7 text-slate-500">
                        Maintain complete and organized information for
                        registered senior citizens.
                    </p>

                </div>



                {{-- CARD 2 --}}

                <div class="p-8 border-b md:border-b-0 lg:border-r border-slate-200 hover:bg-slate-50 transition">

                    <div class="w-12 h-12 bg-[#C69A2E] flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7"
                                d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4z" />

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.7" d="M9 12l2 2 4-4" />

                        </svg>

                    </div>


                    <h3 class="mt-6 text-xl font-semibold text-[#14294D]">
                        Secure Access
                    </h3>

                    <p class="mt-3 text-sm leading-7 text-slate-500">
                        System access is limited to authorized personnel
                        responsible for managing records.
                    </p>

                </div>



                {{-- CARD 3 --}}

                <div class="p-8 border-b md:border-b-0 md:border-r border-slate-200 hover:bg-slate-50 transition">

                    <div class="w-12 h-12 bg-[#14294D] flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="m21 21-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z" />

                        </svg>

                    </div>


                    <h3 class="mt-6 text-xl font-semibold text-[#14294D]">
                        Quick Search
                    </h3>

                    <p class="mt-3 text-sm leading-7 text-slate-500">
                        Locate senior citizen information quickly through
                        search and filtering functions.
                    </p>

                </div>



                {{-- CARD 4 --}}

                <div class="p-8 hover:bg-slate-50 transition">

                    <div class="w-12 h-12 bg-[#C69A2E] flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M4 19V5M4 19h16M8 16v-4M12 16V8M16 16v-7" />

                        </svg>

                    </div>


                    <h3 class="mt-6 text-xl font-semibold text-[#14294D]">
                        Monitoring
                    </h3>

                    <p class="mt-3 text-sm leading-7 text-slate-500">
                        Organized records can support monitoring and
                        administrative decision-making.
                    </p>

                </div>


            </div>

        </div>

    </section>



    {{-- =========================================================
    INFORMATION SECTION
    ========================================================= --}}

    <section id="information" class="py-24 bg-[#14294D]">

        <div class="w-full px-5 sm:px-8 lg:px-12 xl:px-20">


            <div class="grid lg:grid-cols-2 gap-16 items-center">


                <div>

                    <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#E0B94E]">
                        Why It Matters
                    </p>


                    <h2
                        class="mt-4 font-fraunces text-4xl sm:text-5xl lg:text-6xl font-semibold leading-tight text-white">

                        Organized information
                        creates better
                        <span class="text-[#E0B94E]">
                            public service.
                        </span>

                    </h2>


                    <p class="mt-7 text-slate-300 leading-8">

                        Senior citizen records contain important personal,
                        demographic, and supporting information. BASCA-RMS
                        provides a structured environment for authorized
                        personnel to manage these records efficiently.

                    </p>


                    <div class="mt-8">

                        <a href="{{ route('login') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 bg-[#C69A2E] text-white text-sm font-semibold hover:bg-[#b58d29] transition">

                            Enter the System

                            <span>→</span>

                        </a>

                    </div>

                </div>



                <div class="grid sm:grid-cols-2 gap-px bg-white/10">


                    <div class="bg-[#14294D] border border-white/10 p-7">

                        <p class="text-3xl font-bold text-[#E0B94E]">
                            01
                        </p>

                        <h3 class="mt-5 text-lg font-semibold text-white">
                            Centralized
                        </h3>

                        <p class="mt-2 text-sm text-slate-400 leading-6">
                            Records are maintained in a centralized
                            digital environment.
                        </p>

                    </div>


                    <div class="bg-[#14294D] border border-white/10 p-7">

                        <p class="text-3xl font-bold text-[#E0B94E]">
                            02
                        </p>

                        <h3 class="mt-5 text-lg font-semibold text-white">
                            Organized
                        </h3>

                        <p class="mt-2 text-sm text-slate-400 leading-6">
                            Information can be categorized and
                            retrieved efficiently.
                        </p>

                    </div>


                    <div class="bg-[#14294D] border border-white/10 p-7">

                        <p class="text-3xl font-bold text-[#E0B94E]">
                            03
                        </p>

                        <h3 class="mt-5 text-lg font-semibold text-white">
                            Accessible
                        </h3>

                        <p class="mt-2 text-sm text-slate-400 leading-6">
                            Authorized personnel can access records
                            when needed.
                        </p>

                    </div>


                    <div class="bg-[#14294D] border border-white/10 p-7">

                        <p class="text-3xl font-bold text-[#E0B94E]">
                            04
                        </p>

                        <h3 class="mt-5 text-lg font-semibold text-white">
                            Efficient
                        </h3>

                        <p class="mt-2 text-sm text-slate-400 leading-6">
                            Digital tools reduce the time needed to
                            locate and manage information.
                        </p>

                    </div>


                </div>

            </div>

        </div>

    </section>



    {{-- =========================================================
    CONTACT
    ========================================================= --}}

    <section id="contact" class="py-20 bg-white">

        <div class="w-full px-5 sm:px-8 lg:px-12 xl:px-20">


            <div class="max-w-2xl">

                <p class="text-sm font-semibold uppercase tracking-[0.18em] text-[#C69A2E]">
                    Contact & Location
                </p>


                <h2 class="mt-4 font-fraunces text-4xl sm:text-5xl font-semibold text-[#14294D]">

                    BASCA-RMS
                    <span class="text-[#C69A2E]">
                        Bagabag
                    </span>

                </h2>

            </div>



            <div class="mt-12 grid md:grid-cols-3 gap-6">


                <div class="border border-slate-200 p-7">

                    <div class="w-11 h-11 bg-[#14294D] flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 21s7-5.5 7-12a7 7 0 10-14 0c0 6.5 7 12 7 12z" />

                            <circle cx="12" cy="9" r="2.5" />

                        </svg>

                    </div>


                    <h3 class="mt-5 font-semibold text-[#14294D]">
                        Location
                    </h3>

                    <p class="mt-2 text-sm text-slate-500 leading-6">
                        Bagabag, Nueva Vizcaya
                        <br>
                        Philippines
                    </p>

                </div>



                <div class="border border-slate-200 p-7">

                    <div class="w-11 h-11 bg-[#C69A2E] flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M4 6h16v12H4z" />

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="m4 7 8 6 8-6" />

                        </svg>

                    </div>


                    <h3 class="mt-5 font-semibold text-[#14294D]">
                        Records Office
                    </h3>

                    <p class="mt-2 text-sm text-slate-500 leading-6">
                        Senior Citizens Affairs
                        <br>
                        Bagabag, Nueva Vizcaya
                    </p>

                </div>



                <div class="border border-slate-200 p-7">

                    <div class="w-11 h-11 bg-[#14294D] flex items-center justify-center">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8"
                                d="M12 15v2m0-10a4 4 0 00-4 4v1h8v-1a4 4 0 00-4-4z" />

                            <rect x="5" y="11" width="14" height="9" rx="2" />

                        </svg>

                    </div>


                    <h3 class="mt-5 font-semibold text-[#14294D]">
                        System Access
                    </h3>

                    <p class="mt-2 text-sm text-slate-500 leading-6">
                        Authorized personnel only.
                        <br>
                        Login required to access records.
                    </p>

                </div>


            </div>

        </div>

    </section>



    {{-- =========================================================
    FOOTER
    ========================================================= --}}

    <footer class="bg-[#0d1b33] text-white">


        <div class="w-full px-5 sm:px-8 lg:px-12 xl:px-20 py-12">


            <div class="grid lg:grid-cols-2 gap-10">


                {{-- BRAND --}}

                <div>

                    <div class="flex items-center gap-4">

                        <div class="w-14 h-14 rounded-full bg-white flex items-center justify-center overflow-hidden">

                            <img src="{{ asset('storage/mfscapLogo.jpg') }}" alt="BASCA-RMS Logo"
                                class="w-full h-full object-contain p-1">

                        </div>


                        <div>

                            <p class="font-fraunces text-xl font-semibold">
                                BASCA-RMS
                            </p>

                            <p class="text-xs text-slate-400 mt-1">
                                Barangay Association of Senior Citizens Affairs
                            </p>

                        </div>

                    </div>


                    <p class="mt-6 max-w-xl text-sm text-slate-400 leading-7">

                        Senior Citizen Records Management System for
                        Bagabag, Nueva Vizcaya.

                    </p>

                </div>



                {{-- LINKS --}}

                <div class="lg:text-right">

                    <p class="text-sm font-semibold text-white">
                        Quick Links
                    </p>


                    <div class="mt-5 flex flex-wrap lg:justify-end gap-x-7 gap-y-3">

                        <a href="#home" class="text-sm text-slate-400 hover:text-white transition">
                            Home
                        </a>

                        <a href="#about" class="text-sm text-slate-400 hover:text-white transition">
                            About
                        </a>

                        <a href="#services" class="text-sm text-slate-400 hover:text-white transition">
                            Services
                        </a>

                        <a href="#information" class="text-sm text-slate-400 hover:text-white transition">
                            Information
                        </a>

                        <a href="#contact" class="text-sm text-slate-400 hover:text-white transition">
                            Contact
                        </a>

                        <a href="{{ route('login') }}" class="text-sm text-[#E0B94E] hover:text-white transition">
                            Login
                        </a>

                    </div>

                </div>

            </div>

            {{-- =========================================================
            FLOATING DEVELOPER CARD
            ========================================================= --}}

            <div id="developerWidget" class="fixed bottom-6 right-6 z-[9999]">

                {{-- Developer Card --}}
                <div id="developerCard" class="w-[320px] sm:w-[350px]
               bg-white
               rounded-2xl
               border border-slate-200
               shadow-2xl
               overflow-hidden">

                    {{-- Header --}}
                    <div class="bg-[#14294D] px-6 py-5">

                        <div class="flex items-center gap-4">

                            {{-- Developer Photo --}}
                            <div class="w-16 h-16 rounded-full
                                    bg-white
                                    border-2 border-[#C69A2E]
                                    overflow-hidden
                                    flex items-center justify-center
                                    flex-shrink-0
                                    shadow-md">

                                <img src="{{ asset('storage/2x2 photos.png') }}" alt="Jimbert M. Lucero"
                                    class="w-full h-full object-cover">

                            </div>
                            <div>

                                <p class="text-[10px] uppercase
                              tracking-[0.18em]
                              text-[#E0B94E]
                              font-semibold">

                                    System Developer

                                </p>

                                <p class="mt-1 text-lg font-semibold text-white">
                                    BASCA-RMS
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Developer Information --}}
                    <div class="px-6 py-6 text-center">

                        <p class="text-xs uppercase tracking-widest text-slate-400">
                            Developed by
                        </p>

                        <h3 class="mt-2 text-xl font-bold text-[#14294D]">
                            Jimbert M. Lucero
                        </h3>

                        <p class="mt-2 text-sm font-medium text-slate-600">
                            Full Stack Developer
                        </p>

                        <p class="mt-1 text-sm text-slate-400">
                            BS Information Technology Graduate
                        </p>

                    </div>


                    {{-- Close --}}
                    <button type="button" onclick="closeDeveloperCard()" class="absolute top-3 right-3
                   w-8 h-8
                   rounded-full
                   flex items-center justify-center
                   text-white/70
                   hover:text-white
                   hover:bg-white/10
                   transition">

                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />

                        </svg>

                    </button>

                </div>


                {{-- Reopen Button --}}
                <button id="developerButton" type="button" onclick="openDeveloperCard()" class="hidden
               w-16 h-16
               rounded-full
               bg-[#14294D]
               border-4 border-white
               shadow-xl
               items-center justify-center
               text-[#E0B94E]
               hover:bg-[#C69A2E]
               hover:text-white
               hover:scale-105
               transition-all duration-300">

                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-linecap="round" stroke-linecap="round" stroke-width="1.8"
                            d="M16 18l6-6-6-6M8 6l-6 6 6 6M14 4l-4 16" />

                    </svg>

                </button>

            </div>


            <script>

                function closeDeveloperCard() {

                    document.getElementById('developerCard').classList.add('hidden');

                    const button = document.getElementById('developerButton');

                    button.classList.remove('hidden');
                    button.classList.add('flex');

                }


                function openDeveloperCard() {

                    document.getElementById('developerCard').classList.remove('hidden');

                    const button = document.getElementById('developerButton');

                    button.classList.add('hidden');
                    button.classList.remove('flex');

                }

            </script>

            <div class="mt-10 pt-7 border-t border-white/10 flex flex-col sm:flex-row justify-between gap-3">

                <p class="text-xs text-slate-500">
                    © {{ date('Y') }} BASCA-RMS. All rights reserved.
                </p>


                <p class="text-xs text-slate-500">
                    Bagabag, Nueva Vizcaya, Philippines
                </p>

            </div>

        </div>


    </footer>



    {{-- =========================================================
    MOBILE MENU SCRIPT
    ========================================================= --}}

    <script>

        document.addEventListener('DOMContentLoaded', function () {


            /*
            |--------------------------------------------------------------------------
            | ELEMENTS
            |--------------------------------------------------------------------------
            */

            const header =
                document.querySelector('header');

            const mobileMenuButton =
                document.getElementById('mobileMenuButton');

            const mobileMenu =
                document.getElementById('mobileMenu');

            const navLinks =
                document.querySelectorAll('.nav-link');

            const mobileNavLinks =
                document.querySelectorAll('.mobile-nav-link');

            const sections =
                document.querySelectorAll('section[id]');


            /*
            |--------------------------------------------------------------------------
            | MOBILE MENU TOGGLE
            |--------------------------------------------------------------------------
            */

            mobileMenuButton.addEventListener('click', function () {

                const isOpen =
                    mobileMenu.classList.contains('open');


                if (isOpen) {

                    mobileMenu.classList.remove('open');

                    mobileMenuButton.classList.remove('open');

                    mobileMenuButton.setAttribute(
                        'aria-expanded',
                        'false'
                    );

                    mobileMenuButton.setAttribute(
                        'aria-label',
                        'Open navigation menu'
                    );

                } else {

                    mobileMenu.classList.add('open');

                    mobileMenuButton.classList.add('open');

                    mobileMenuButton.setAttribute(
                        'aria-expanded',
                        'true'
                    );

                    mobileMenuButton.setAttribute(
                        'aria-label',
                        'Close navigation menu'
                    );

                }

            });


            /*
            |--------------------------------------------------------------------------
            | CLOSE MOBILE MENU
            |--------------------------------------------------------------------------
            */

            function closeMobileMenu() {

                mobileMenu.classList.remove('open');

                mobileMenuButton.classList.remove('open');

                mobileMenuButton.setAttribute(
                    'aria-expanded',
                    'false'
                );

                mobileMenuButton.setAttribute(
                    'aria-label',
                    'Open navigation menu'
                );

            }


            /*
            |--------------------------------------------------------------------------
            | ACTIVE NAVIGATION
            |--------------------------------------------------------------------------
            */

            function updateActiveNavigation() {

                const scrollPosition =
                    window.scrollY;

                const headerHeight =
                    header.offsetHeight;


                let currentSection =
                    'home';


                /*
                --------------------------------------------------------------
                At the very top = HOME
                --------------------------------------------------------------
                */

                if (scrollPosition < 200) {

                    currentSection = 'home';

                } else {

                    sections.forEach(function (section) {

                        const sectionTop =
                            section.offsetTop - headerHeight - 80;

                        const sectionBottom =
                            sectionTop + section.offsetHeight;


                        if (
                            scrollPosition >= sectionTop &&
                            scrollPosition < sectionBottom
                        ) {

                            currentSection =
                                section.getAttribute('id');

                        }

                    });

                }


                /*
                --------------------------------------------------------------
                Desktop navigation
                --------------------------------------------------------------
                */

                navLinks.forEach(function (link) {

                    const target =
                        link.getAttribute('href');


                    if (target === '#' + currentSection) {

                        link.classList.add('active');

                    } else {

                        link.classList.remove('active');

                    }

                });


                /*
                --------------------------------------------------------------
                Mobile navigation
                --------------------------------------------------------------
                */

                mobileNavLinks.forEach(function (link) {

                    const target =
                        link.getAttribute('href');


                    if (target === '#' + currentSection) {

                        link.classList.add('active');

                    } else {

                        link.classList.remove('active');

                    }

                });

            }


            /*
            |--------------------------------------------------------------------------
            | NAVIGATION CLICK
            |--------------------------------------------------------------------------
            */

            function scrollToSection(event) {

                const link =
                    event.currentTarget;

                const targetId =
                    link.getAttribute('href');


                /*
                --------------------------------------------------------------
                Ignore normal URLs
                --------------------------------------------------------------
                */

                if (
                    !targetId ||
                    !targetId.startsWith('#')
                ) {

                    return;

                }


                const target =
                    document.querySelector(targetId);


                if (!target) {

                    return;

                }


                event.preventDefault();


                /*
                --------------------------------------------------------------
                Get actual sticky header height
                --------------------------------------------------------------
                */

                const headerHeight =
                    header.offsetHeight;


                const targetPosition =
                    target.getBoundingClientRect().top +
                    window.scrollY -
                    headerHeight;


                window.scrollTo({

                    top: targetPosition,

                    behavior: 'smooth'

                });


                /*
                --------------------------------------------------------------
                Close mobile menu
                --------------------------------------------------------------
                */

                closeMobileMenu();


                /*
                --------------------------------------------------------------
                Update URL hash
                --------------------------------------------------------------
                */

                history.replaceState(
                    null,
                    '',
                    targetId
                );

            }


            /*
            |--------------------------------------------------------------------------
            | DESKTOP NAV CLICK EVENTS
            |--------------------------------------------------------------------------
            */

            navLinks.forEach(function (link) {

                link.addEventListener(
                    'click',
                    scrollToSection
                );

            });


            /*
            |--------------------------------------------------------------------------
            | MOBILE NAV CLICK EVENTS
            |--------------------------------------------------------------------------
            */

            mobileNavLinks.forEach(function (link) {

                link.addEventListener(
                    'click',
                    scrollToSection
                );

            });


            /*
            |--------------------------------------------------------------------------
            | UPDATE WHILE SCROLLING
            |--------------------------------------------------------------------------
            */

            window.addEventListener(
                'scroll',
                updateActiveNavigation,
                {
                    passive: true
                }
            );


            /*
            |--------------------------------------------------------------------------
            | UPDATE WHEN PAGE LOADS
            |--------------------------------------------------------------------------
            */

            window.addEventListener(
                'load',
                updateActiveNavigation
            );


            /*
            |--------------------------------------------------------------------------
            | INITIAL STATE
            |--------------------------------------------------------------------------
            */

            updateActiveNavigation();


            /*
            |--------------------------------------------------------------------------
            | CLOSE MENU WHEN RESIZING TO DESKTOP
            |--------------------------------------------------------------------------
            */

            window.addEventListener(
                'resize',
                function () {

                    if (window.innerWidth >= 1024) {

                        closeMobileMenu();

                    }

                    updateActiveNavigation();

                }
            );


            /*
            |--------------------------------------------------------------------------
            | CLOSE MOBILE MENU WHEN CLICKING OUTSIDE
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'click',
                function (event) {

                    const clickedInsideHeader =
                        header.contains(event.target);


                    if (
                        !clickedInsideHeader &&
                        mobileMenu.classList.contains('open')
                    ) {

                        closeMobileMenu();

                    }

                }
            );

        });

    </script>


</body>

</html>
