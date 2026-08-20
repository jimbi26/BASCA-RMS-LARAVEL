@php
    $successMessage = session('success');
    $errorMessage = session('error');
    $hasMessage = $successMessage || $errorMessage;
@endphp

@if($hasMessage)
    @php
        if ($successMessage) {
            $title = 'Success!';
            $message = $successMessage;
            $iconClass = 'fa-solid fa-circle-check text-green-500';
            $iconBg = 'bg-green-100';
            $accentBorder = 'border-green-200';
            $accentBg = 'bg-green-50';
            $textColor = 'text-green-800';
        } else {
            $title = 'Something went wrong!';
            $message = $errorMessage;
            $iconClass = 'fa-solid fa-circle-exclamation text-red-500';
            $iconBg = 'bg-red-100';
            $accentBorder = 'border-red-200';
            $accentBg = 'bg-red-50';
            $textColor = 'text-red-800';
        }
    @endphp

    <div id="notification-modal"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-slate-900/60 backdrop-blur-sm">

        <div id="notification-modal-card"
            class="relative w-full max-w-md rounded-2xl border {{ $accentBorder }} {{ $accentBg }} p-6 shadow-2xl transform transition-all duration-300">

            <div class="flex items-start gap-4">
                <div class="flex-shrink-0">
                    <div class="flex h-12 w-12 items-center justify-center rounded-full {{ $iconBg }}">
                        <i class="{{ $iconClass }} text-2xl"></i>
                    </div>
                </div>

                <div class="flex-1">
                    <h3 class="font-serif text-xl font-bold {{ $textColor }} mb-1">
                        {{ $title }}
                    </h3>
                    <p class="text-sm {{ $textColor }} font-medium">
                        {{ $message }}
                    </p>
                </div>

                <button type="button" onclick="closeNotificationModal()"
                    class="flex-shrink-0 rounded-xl p-2 {{ $textColor }} hover:bg-black/5 transition-colors">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        function closeNotificationModal() {
            const modal = document.getElementById('notification-modal');
            if (!modal) return;

            modal.style.opacity = '0';
            setTimeout(function () {
                if (modal.parentNode) {
                    modal.parentNode.removeChild(modal);
                }
            }, 300);
        }

        document.addEventListener('DOMContentLoaded', function () {
            setTimeout(function () {
                closeNotificationModal();
            }, 4500);
        });
    </script>
@endif
