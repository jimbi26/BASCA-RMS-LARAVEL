<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BASCA-RMS | Sign In</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600;9..144,700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite(['resources/css/app.css'])
</head>

<body
    class="min-h-screen bg-[#EEF2F8] font-['Poppins'] flex items-center justify-center p-4 sm:p-6 lg:p-8selection:bg-[#C69A2E] selection:text-white">

    <!-- MAIN CARD -->
    <!-- Changed: Parent now holds the dark blue color so the white panel can curve over it -->
    <main
        class="relative w-full max-w-[1150px] bg-[#14294D] rounded-[2.5rem] shadow-2xl shadow-slate-400/40 overflow-hidden flex flex-col md:flex-row">

        <!-- Decorative Blurs (Moved to background of the main container) -->
        <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
            <div class="absolute -top-32 -left-20 w-96 h-96 rounded-full bg-[#C69A2E]/20 blur-[80px]"></div>
            <div class="absolute bottom-10 left-40 w-72 h-72 rounded-full bg-blue-400/10 blur-[60px]"></div>
        </div>

        <!-- LEFT PANEL -->
        <section
            class="relative z-10 md:w-[45%] text-white px-8 py-12 sm:px-12 sm:py-16 lg:px-16 flex flex-col justify-between min-h-[400px] md:min-h-full">

            <div>
                <!-- Brand -->
                <div class="flex items-center gap-4 mb-14">
                    <div
                        class="w-12 h-12 rounded-2xl bg-gradient-to-br from-[#C69A2E] to-[#b38a29] flex items-center justify-center text-[#14294D] shadow-[0_8px_16px_rgba(198,154,46,0.3)]">
                        <i class="fa-solid fa-folder-open text-xl"></i>
                    </div>
                    <div>
                        <p class="text-base font-bold tracking-wider text-white">
                            BASCA-RMS
                        </p>
                        <p class="text-[11px] font-medium tracking-wide text-white/60 uppercase">
                            Records Management System
                        </p>
                    </div>
                </div>
                <!-- Heading -->
                <div class="max-w-md">
                    <div
                        class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-white/5 border border-white/10 mb-6">
                        <span class="w-2 h-2 rounded-full bg-[#C69A2E] animate-pulse"></span>
                        <p class="text-xs font-semibold uppercase tracking-widest text-[#C69A2E]">
                            Senior Citizens Affairs
                        </p>
                    </div>

                    <h1
                        class="font-['Fraunces'] text-4xl sm:text-5xl lg:text-[54px] font-semibold leading-[1.1] text-white">
                        Bagabag <br>
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-white to-white/70">senior
                            records.</span>
                    </h1>

                    <p class="mt-6 text-[15px] text-white/70 leading-relaxed max-w-sm">
                        Keep Bagabag, Nueva Vizcaya's senior citizen records organized, accessible, and highly secure in
                        one reliable system.
                    </p>
                </div>

                <!-- Feature -->
                <div
                    class="mt-10 flex items-center gap-3 p-4 rounded-2xl bg-white/5 border border-white/10 backdrop-blur-sm max-w-sm">
                    <div class="w-10 h-10 rounded-full bg-[#C69A2E]/20 flex items-center justify-center flex-shrink-0">
                        <i class="fa-solid fa-bolt text-[#C69A2E]"></i>
                    </div>
                    <span class="text-sm font-medium text-white/90">
                        Lightning fast record retrieval and unified data management.
                    </span>
                </div>
            </div>

            <!-- Footer -->
            <div class="mt-12 flex items-center gap-2 text-xs text-white/40 font-medium">
                <i class="fa-regular fa-copyright"></i>
                <p>2026 Barangay Council Records Management</p>
            </div>

        </section>


        <!-- RIGHT PANEL (With the curved split) -->
        <!-- Added rounded-t-[3rem] for mobile curve, and rounded-l-[3rem] for desktop curve -->
        <section
            class="relative z-20 flex-1 bg-white rounded-t-[3rem] md:rounded-t-none md:rounded-l-[3rem] p-8 sm:p-12 lg:p-16 flex items-center justify-center shadow-[-20px_0_40px_rgba(0,0,0,0.15)]">

            <form method="POST" action="{{ route('login') }}" onsubmit="showLoginLoading()"
                class="w-full max-w-[400px]">

                @csrf

                <!-- HEADER -->
                <header class="text-center mb-10">

                    <!-- Logos Grouping -->
                    <div class="flex items-center justify-center gap-5 mb-8">
                        <div
                            class="w-16 h-16 rounded-full bg-white shadow-md border border-slate-100 flex items-center justify-center p-1 hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('storage/mfscapLogo.jpg') }}" alt="MFSCAP Logo"
                                class="w-full h-full object-contain rounded-full">
                        </div>

                        <div class="flex flex-col gap-1">
                            <div class="w-1.5 h-1.5 rounded-full bg-slate-200"></div>
                            <div class="w-1.5 h-1.5 rounded-full bg-slate-200"></div>
                            <div class="w-1.5 h-1.5 rounded-full bg-slate-200"></div>
                        </div>

                        <div
                            class="w-16 h-16 rounded-full bg-white shadow-md border border-slate-100 flex items-center justify-center p-1 hover:scale-105 transition-transform duration-300">
                            <img src="{{ asset('storage/bagabagLogo.jpg') }}" alt="Bagabag Logo"
                                class="w-full h-full object-contain rounded-full">
                        </div>
                    </div>

                    <h2 class="font-['Fraunces'] text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight">
                        Welcome back
                    </h2>

                    <p class="mt-3 text-[15px] text-slate-500 font-medium">
                        Sign in to access your dashboard.
                    </p>

                </header>


                <!-- USERNAME -->
                <div class="mb-5 group">

                    <label for="username"
                        class="block mb-2 text-sm font-semibold text-slate-700 group-focus-within:text-[#14294D] transition-colors">
                        Username
                    </label>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i
                                class="fa-solid fa-user text-slate-400 group-focus-within:text-[#14294D] transition-colors"></i>
                        </div>

                        <input id="username" type="text" name="username" required autocomplete="username"
                            placeholder="Enter your username" value="{{ old('username') }}" class="w-full h-14 pl-11 pr-4 rounded-2xl border-2 border-slate-100 bg-slate-50
                            text-[15px] font-medium text-slate-800 placeholder:text-slate-400 placeholder:font-normal
                            focus:outline-none focus:bg-white focus:border-[#14294D]
                            focus:ring-4 focus:ring-[#14294D]/10 transition-all duration-200">
                    </div>

                </div>


                <!-- PASSWORD -->
                <div class="mb-6 group">

                    <div class="flex items-center justify-between mb-2">
                        <label for="password"
                            class="block text-sm font-semibold text-slate-700 group-focus-within:text-[#14294D] transition-colors">
                            Password
                        </label>
                        <!-- Optional: Forgot Password Link could go here -->
                    </div>

                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <i
                                class="fa-solid fa-lock text-slate-400 group-focus-within:text-[#14294D] transition-colors"></i>
                        </div>

                        <input id="password" type="password" name="password" required autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full h-14 pl-11 pr-12 rounded-2xl border-2 border-slate-100 bg-slate-50
                            text-[15px] font-medium text-slate-800 placeholder:text-slate-400
                            focus:outline-none focus:bg-white focus:border-[#14294D]
                            focus:ring-4 focus:ring-[#14294D]/10 transition-all duration-200 tracking-wider placeholder:tracking-normal">

                        <!-- PASSWORD TOGGLE -->
                        <button type="button" onclick="
                                const p = document.getElementById('password');
                                const i = this.querySelector('i');
                                p.type = p.type === 'password' ? 'text' : 'password';
                                i.classList.toggle('fa-eye');
                                i.classList.toggle('fa-eye-slash');
                            " aria-label="Show or hide password"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-400 hover:text-[#14294D] transition-colors focus:outline-none">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                    </div>

                </div>


                <!-- ERROR MESSAGE -->
                @error('username')
                    <div
                        class="flex items-start gap-3 mb-6 p-4 rounded-2xl bg-red-50 border border-red-100 animate-fade-in">
                        <i class="fa-solid fa-circle-exclamation text-red-500 mt-0.5"></i>
                        <span class="text-sm font-medium text-red-700">{{ $message }}</span>
                    </div>
                @enderror


                <!-- LOGIN BUTTON -->
                <button type="submit" id="loginButton" class="w-full h-14 mt-2 rounded-2xl bg-[#14294D] hover:bg-[#0F1F3D] active:scale-[0.98]
                    text-white text-[15px] font-semibold tracking-wide
                    transition-all duration-200 ease-out
                    shadow-[0_8px_20px_rgba(20,41,77,0.2)] hover:shadow-[0_12px_25px_rgba(20,41,77,0.3)]
                    flex items-center justify-center gap-3 group/btn relative overflow-hidden">

                    <!-- Button Hover Effect Overlay -->
                    <div
                        class="absolute inset-0 bg-white/20 translate-y-full group-hover/btn:translate-y-0 transition-transform duration-300 ease-in-out rounded-2xl">
                    </div>

                    <i id="loginSpinner"
                        class="hidden relative z-10 w-5 h-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></i>

                    <span id="loginButtonText" class="relative z-10 flex items-center gap-2">
                        Sign In <i
                            class="fa-solid fa-arrow-right-to-bracket text-sm opacity-70 group-hover/btn:translate-x-1 transition-transform"></i>
                    </span>

                </button>


                <!-- SECURITY NOTE -->
                <div class="flex items-center justify-center gap-2 mt-8 text-xs font-medium text-slate-400">
                    <i class="fa-solid fa-shield-check text-[#C69A2E]"></i>
                    <span>Securely encrypted for authorized personnel</span>
                </div>

            </form>

        </section>

    </main>

    <!-- Tailwind Config for Custom Animations (Optional: add to your tailwind.config.js if you want the fade-in) -->
    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeIn 0.3s ease-out forwards;
        }
    </style>

    <script>
        function showLoginLoading() {
            const button = document.getElementById('loginButton');
            const spinner = document.getElementById('loginSpinner');
            const text = document.getElementById('loginButtonText');

            button.disabled = true;
            spinner.classList.remove('hidden');

            // Keep the text simple while loading and hide the arrow
            text.innerHTML = 'Signing in...';

            button.classList.add('opacity-90', 'cursor-not-allowed');
            button.classList.remove('active:scale-[0.98]', 'hover:bg-[#0F1F3D]', 'hover:shadow-[0_12px_25px_rgba(20,41,77,0.3)]');
        }
    </script>

</body>

</html>