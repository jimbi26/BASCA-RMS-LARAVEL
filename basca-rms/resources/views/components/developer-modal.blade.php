<!-- floating-developer-modal.blade.php -->
<div>
    <!-- FLOATING BUTTON -->
    <button onclick="toggleDevModal(true)" type="button"
        class="fixed bottom-6 right-6 z-[90] flex h-14 w-14 items-center justify-center rounded-full bg-[#14294D] text-[#C69A2E] shadow-xl ring-4 ring-white/20 transition-all duration-300 hover:scale-110 hover:bg-[#1b345f] focus:outline-none"
        title="Meet the Developers">
        <i class="fa-solid fa-code text-xl"></i>
    </button>

    <!-- MODAL OVERLAY (Set to z-[9999] to cover full screen & sidebar) -->
    <div id="dev-modal" onclick="if(event.target === this) toggleDevModal(false)"
        class="fixed inset-0 z-[9999] hidden opacity-0 backdrop-blur-none bg-slate-900/0 flex items-center justify-center p-4 transition-all duration-300">

        <!-- CARD CONTAINER -->
        <div id="dev-modal-card"
            class="relative w-full max-w-md scale-95 overflow-hidden rounded-2xl border border-slate-100 bg-white p-6 shadow-2xl opacity-0 transition-all duration-300">

            <button onclick="toggleDevModal(false)" type="button"
                class="absolute right-4 top-4 flex h-8 w-8 items-center justify-center rounded-full text-slate-400 transition hover:bg-slate-100 hover:text-slate-600">
                <i class="fa-solid fa-xmark text-lg"></i>
            </button>

            <div class="text-center">
                <span class="text-xs font-bold uppercase tracking-widest text-[#C69A2E]">
                    Behind the System
                </span>

                <h3 class="mt-1 font-serif text-2xl font-bold text-[#14294D]">
                    System Developer
                </h3>
            </div>

            <div class="mt-6 space-y-4">
                <div class="flex items-center gap-4 rounded-xl border border-slate-100 bg-slate-50/80 p-4">
                    <img src="{{ asset('storage/developer.png') }}" alt="Developer Photo"
                        class="h-20 w-20 rounded-full object-cover object-center ring-2 ring-[#C69A2E]/40 shadow-md" />

                    <div>
                        <h4 class="text-base font-bold text-slate-900">
                            JIMBERT LUCERO
                        </h4>

                        <p class="text-xs font-semibold text-[#C69A2E]">
                            Full Stack Developer Laravel
                        </p>

                        <p class="mt-1 text-xs text-slate-500">
                            BS Information Technology (2026)
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6 border-t border-slate-100 pt-4 text-center">
                <p class="text-xs text-slate-400">
                    BASCA-RMS &copy; {{ date('Y') }} All Rights Reserved
                </p>
            </div>

        </div>
    </div>
</div>

<script>
    window.toggleDevModal = function (show) {
        const modal = document.getElementById('dev-modal');
        const card = document.getElementById('dev-modal-card');

        if (!modal || !card) return;

        if (show) {
            modal.classList.remove('hidden');

            requestAnimationFrame(() => {
                modal.classList.remove('opacity-0', 'backdrop-blur-none', 'bg-slate-900/0');
                modal.classList.add('opacity-100', 'backdrop-blur-sm', 'bg-slate-900/60');

                card.classList.remove('opacity-0', 'scale-95');
                card.classList.add('opacity-100', 'scale-100');
            });
        } else {
            modal.classList.remove('opacity-100', 'backdrop-blur-sm', 'bg-slate-900/60');
            modal.classList.add('opacity-0', 'backdrop-blur-none', 'bg-slate-900/0');

            card.classList.remove('opacity-100', 'scale-100');
            card.classList.add('opacity-0', 'scale-95');

            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }
    };
</script>