<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:wght@600&family=Poppins:wght@400;500;600&display=swap"
        rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body class="min-h-screen bg-slate-50 font-['Poppins'] text-slate-900 antialiased">

    <!-- MOBILE HEADER -->
    <header
        class="lg:hidden fixed top-0 inset-x-0 h-20 bg-[#14294D] text-white flex items-center justify-between px-5 z-40 shadow-md">
        <div class="flex items-center gap-3 min-w-0">
            <img src="{{ asset('storage/mfscapLogo.jpg') }}"
                class="size-11 rounded-xl bg-white p-0.5 object-contain shrink-0" alt="Logo">
            <div class="leading-tight truncate">
                <p class="font-['Fraunces'] text-lg font-semibold">BASCA-RMS</p>
                <p class="text-xs text-white/60">Barangay Bagabag N.V</p>
            </div>
        </div>
        <button onclick="toggleMenu()"
            class="size-11 rounded-xl bg-white/10 hover:bg-white/20 transition flex items-center justify-center shrink-0">
            <i id="menuIcon" class="fa-solid fa-bars text-lg"></i>
        </button>
    </header>

    <!-- OVERLAY -->
    <div id="overlay" onclick="toggleMenu()"
        class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden lg:hidden transition-opacity"></div>

    <!-- SIDEBAR -->
    <aside id="sidebar"
        class="fixed inset-y-0 left-0 z-50 w-72 lg:w-[22rem] bg-[#14294D] text-white flex flex-col -translate-x-full lg:translate-x-0 transition-transform duration-300 shadow-2xl lg:shadow-none overflow-hidden">

        <!-- GLOW EFFECT -->
        <div class="absolute -top-32 -right-32 size-96 bg-[#C69A2E]/20 rounded-full blur-[80px] pointer-events-none">
        </div>

        <!-- BRANDING -->
        <div class="relative z-10 flex items-center justify-between px-6 py-8">
            <div class="flex items-center gap-4 min-w-0">
                <img src="{{ asset('storage/mfscapLogo.jpg') }}"
                    class="size-12 lg:size-14 rounded-xl bg-white p-1 object-contain shrink-0 shadow-sm" alt="Logo">
                <div class="leading-tight truncate">
                    <p class="font-['Fraunces'] text-xl lg:text-2xl font-semibold tracking-wide">BASCA-RMS</p>
                    <p class="text-sm text-white/60">Barangay Bagabag N.V</p>
                </div>
            </div>

            <button onclick="toggleMenu()"
                class="lg:hidden size-10 rounded-xl bg-white/10 hover:bg-white/20 flex items-center justify-center transition">
                <i class="fa-solid fa-xmark"></i>
            </button>
        </div> <br>

        <!-- NAVIGATION -->
        <nav class="relative z-10 flex-1 px-4 space-y-2 overflow-y-auto">
            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" onclick="handleNavClick(this)" class="nav-link group flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all
    {{ request()->routeIs('dashboard')
    ? 'bg-[#C69A2E] text-[#14294D] font-semibold shadow-lg shadow-[#C69A2E]/25 hover:-translate-y-0.5'
    : 'text-white/70 hover:bg-white/10 hover:text-white' }}">

                <i class="fa-solid fa-gauge-high w-6 text-center text-lg
        {{ request()->routeIs('dashboard')
    ? 'text-[#14294D]'
    : 'text-white/40 group-hover:text-white/80' }}
        transition-colors"></i>

                <span class="text-base lg:text-lg font-bold flex-1">DASHBOARD</span>

                <!-- SPINNER (Right Aligned) -->
                <i
                    class="nav-spinner hidden size-5 border-2 border-current/30 border-t-current rounded-full animate-spin shrink-0"></i>
            </a>

            <!-- Senior Records -->
            <div class="space-y-1">

                <!-- Main Nav -->
                <a href="{{ route('seniors.senior-records') }}" onclick="handleNavClick(this)" class="nav-link group flex items-center gap-4 px-4 py-3.5 rounded-xl transition-all
        {{ request()->routeIs('seniors.senior-records', 'seniors.create', 'seniors.show', 'seniors.edit')
    ? 'bg-[#C69A2E] text-[#14294D] font-semibold shadow-lg shadow-[#C69A2E]/20'
    : 'text-white/70 hover:bg-white/10 hover:text-white' }}">

                    <i class="fa-solid fa-address-book w-6 text-center text-lg
            {{ request()->routeIs('seniors.senior-records', 'seniors.create', 'seniors.show', 'seniors.edit')
    ? 'text-[#14294D]'
    : 'text-white/40 group-hover:text-white/80' }}">
                    </i>

                    <span class="text-base lg:text-lg font-bold flex-1">
                        ALL SENIORS
                    </span>

                    @if(request()->routeIs('seniors.create', 'seniors.show', 'seniors.edit'))
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    @endif

                    <!-- SPINNER (Right Aligned) -->
                    <i
                        class="nav-spinner hidden size-5 border-2 border-current/30 border-t-current rounded-full animate-spin shrink-0"></i>
                </a>

                <!-- Sub Nav -->
                @if(request()->routeIs('seniors.create'))
                    <div class="ml-6 pl-4 border-l-2 border-[#C69A2E]/30">

                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-lg
                                                bg-white/10 text-[#C69A2E] font-semibold
                                                border border-white/5">

                            <i class="fa-solid fa-user-plus w-5 text-center text-sm"></i>

                            <span class="text-sm lg:text-base">
                                ADDING NEW SENIOR
                            </span>

                            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-[#C69A2E]"></span>
                        </div>

                    </div>
                @endif

                @if(request()->routeIs('seniors.edit'))
                    <div class="ml-6 pl-4 border-l-2 border-[#C69A2E]/30">

                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-lg
                                                bg-white/10 text-[#C69A2E] font-semibold
                                                border border-white/5">

                            <i class="fa-solid fa-pen-to-square w-5 text-center text-sm"></i>

                            <span class="text-sm lg:text-base">
                                EDITING SENIOR RECORD
                            </span>

                            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-[#C69A2E]"></span>
                        </div>

                    </div>
                @endif

                @if(request()->routeIs('seniors.show'))
                    <div class="ml-6 pl-4 border-l-2 border-[#C69A2E]/30">

                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-lg
                                                bg-white/10 text-[#C69A2E] font-semibold
                                                border border-white/5">

                            <i class="fa-solid fa-eye w-5 text-center text-sm"></i>

                            <span class="text-sm lg:text-base">
                                VIEWING SENIOR PROFILE
                            </span>

                            <span class="ml-auto w-1.5 h-1.5 rounded-full bg-[#C69A2E]"></span>
                        </div>

                    </div>
                @endif

            </div>
        </nav>

        <!-- BOTTOM SECTION -->
        <div class="relative z-10 p-4 border-t border-white/10 mt-auto">
            <form method="POST" action="{{ url('/logout') }}" id="logoutForm">
                @csrf
                <button type="submit" id="logoutButton"
                    class="group w-full flex items-center justify-center gap-3 px-4 py-3.5 rounded-xl text-white/70 hover:bg-rose-500/10 hover:text-rose-400 transition-all">

                    <i id="logoutSpinner"
                        class="hidden size-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></i>

                    <i id="logoutIcon"
                        class="fa-solid fa-right-from-bracket w-6 text-center text-lg text-white/40 group-hover:text-rose-400/80 transition-colors"></i>

                    <span id="logoutButtonText" class="text-base lg:text-lg font-bold">
                        LOGOUT
                    </span>
                </button>
            </form>
            <p class="text-xs text-center text-white/30 mt-4">&copy; 2026 Records Management System</p>
        </div>
    </aside>

    <script>
        function toggleMenu() {
            document.getElementById('sidebar').classList.toggle('-translate-x-full');
            document.getElementById('overlay').classList.toggle('hidden');
            const icon = document.getElementById('menuIcon');
            if (icon) { icon.classList.toggle('fa-bars'); icon.classList.toggle('fa-xmark'); }
        }

        function handleNavClick(element) {
            // Hide all other spinners
            document.querySelectorAll('.nav-spinner').forEach(s => s.classList.add('hidden'));

            // Show the spinner for the clicked link
            const spinner = element.querySelector('.nav-spinner');
            if (spinner) {
                spinner.classList.remove('hidden');
            }
        }

        function showFetchingOverlay(message) {
            const overlay = document.getElementById('fetching-overlay');
            const text = document.getElementById('fetching-overlay-text');
            if (overlay) {
                if (text && message) {
                    text.textContent = message;
                }
                overlay.classList.remove('hidden');
            }
        }

        function hideFetchingOverlay() {
            const overlay = document.getElementById('fetching-overlay');
            if (overlay) {
                overlay.classList.add('hidden');
            }
        }
    </script>
</body>

</html>