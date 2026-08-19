<!-- Delete Confirmation Modal Component -->
<div id="deleteModal" role="dialog" aria-modal="true" aria-labelledby="deleteModalTitle"
    aria-describedby="deleteModalDesc"
    class="hidden fixed inset-0 z-50 items-center justify-center bg-slate-900/50 backdrop-blur-sm p-4"
    onclick="closeDeleteModal()">

    <!-- Modal Panel -->
    <div id="deleteModalPanel" class="bg-white rounded-2xl p-6 w-full max-w-sm shadow-xl text-center max-h-[90vh] overflow-y-auto
               scale-95 opacity-0 motion-safe:transition-all motion-safe:duration-150 motion-safe:ease-out"
        onclick="event.stopPropagation()">

        <div class="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
            <i class="fa-solid fa-trash-can text-red-600" aria-hidden="true"></i>
        </div>

        <h3 id="deleteModalTitle" class="text-lg font-bold text-slate-800">Remove Record?</h3>
        <p id="deleteModalDesc" class="text-sm text-slate-500 mt-2 leading-5">
            Are you sure you want to remove this record? This action cannot be undone.
        </p>

        <div class="flex gap-3 mt-6">
            <button id="cancelDeleteButton" type="button" onclick="closeDeleteModal()" class="flex-1 rounded-xl border border-slate-300 py-2.5 text-sm sm:text-base font-semibold text-slate-700
                       hover:bg-slate-50 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-400
                       transition">
                Cancel
            </button>

            <form id="deleteForm" method="POST" class="flex-1" onsubmit="showDeleteLoading()">
                @csrf
                @method('DELETE')
                <button id="deleteButton" type="submit" aria-live="polite" class="w-full rounded-xl bg-red-600 py-2.5 text-sm sm:text-base font-semibold text-white
                           hover:bg-red-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-400
                           transition">
                    <span id="deleteText" class="inline-flex items-center justify-center">
                        <i class="fa-solid fa-trash-can mr-2" aria-hidden="true"></i> Remove
                    </span>
                    <span id="deleteLoading" class="hidden items-center justify-center">
                        <i class="fa-solid fa-circle-notch animate-spin mr-2" aria-hidden="true"></i> Removing...
                    </span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    const dm = {
        modal: document.getElementById('deleteModal'),
        panel: document.getElementById('deleteModalPanel'),
        form: document.getElementById('deleteForm'),
        deleteBtn: document.getElementById('deleteButton'),
        cancelBtn: document.getElementById('cancelDeleteButton'),
        deleteText: document.getElementById('deleteText'),
        deleteLoading: document.getElementById('deleteLoading'),
        lastFocused: null,
    };

    function openDeleteModal(actionUrl) {
        dm.lastFocused = document.activeElement;
        dm.form.action = actionUrl;

        dm.modal.classList.replace('hidden', 'flex');
        document.body.classList.add('overflow-hidden');
        resetDeleteButton();

        // Animate in on the next frame so the transition actually runs
        requestAnimationFrame(() => {
            dm.panel.classList.remove('scale-95', 'opacity-0');
            dm.panel.classList.add('scale-100', 'opacity-100');
        });

        // Default focus goes to Cancel, not the destructive action
        dm.cancelBtn.focus();
    }

    function closeDeleteModal() {
        dm.panel.classList.remove('scale-100', 'opacity-100');
        dm.panel.classList.add('scale-95', 'opacity-0');

        setTimeout(() => {
            dm.modal.classList.replace('flex', 'hidden');
            document.body.classList.remove('overflow-hidden');
            resetDeleteButton();
            if (dm.lastFocused) dm.lastFocused.focus();
        }, 150);
    }

    function showDeleteLoading() {
        dm.deleteText.classList.replace('inline-flex', 'hidden');
        dm.deleteLoading.classList.replace('hidden', 'inline-flex');
        dm.deleteBtn.setAttribute('aria-busy', 'true');

        [dm.deleteBtn, dm.cancelBtn].forEach(btn => btn.classList.add('opacity-75', 'pointer-events-none'));

        // Defer disabling so the native form POST isn't cancelled by the browser
        setTimeout(() => {
            dm.deleteBtn.disabled = true;
            dm.cancelBtn.disabled = true;
        }, 0);
    }

    function resetDeleteButton() {
        dm.deleteText.classList.replace('hidden', 'inline-flex');
        dm.deleteLoading.classList.replace('inline-flex', 'hidden');
        dm.deleteBtn.removeAttribute('aria-busy');

        [dm.deleteBtn, dm.cancelBtn].forEach(btn => {
            btn.disabled = false;
            btn.classList.remove('opacity-75', 'pointer-events-none');
        });
    }

    window.addEventListener('keydown', e => {
        if (dm.modal.classList.contains('hidden')) return;

        if (e.key === 'Escape') {
            closeDeleteModal();
            return;
        }

        // Keep Tab focus inside the modal while it's open
        if (e.key === 'Tab') {
            const focusable = Array.from(dm.panel.querySelectorAll('button:not([disabled])'));
            const first = focusable[0];
            const last = focusable[focusable.length - 1];

            if (e.shiftKey && document.activeElement === first) {
                e.preventDefault();
                last.focus();
            } else if (!e.shiftKey && document.activeElement === last) {
                e.preventDefault();
                first.focus();
            }
        }
    });
</script>