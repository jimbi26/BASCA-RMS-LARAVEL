<!-- resources/views/components/page-loader.blade.php -->
<div id="page-loader"
    class="fixed inset-0 z-[999] flex flex-col items-center justify-center bg-gray-50/90 backdrop-blur-sm lg:ml-[360px] transition-opacity duration-300">

    <div
        class="h-20 w-20 animate-spin [animation-duration:0.5s] rounded-full border-4 border-solid border-indigo-600 border-t-transparent">
    </div>

    <p class="mt-5 text-sm font-medium text-gray-600 animate-pulse">
        Loading content...
    </p>

</div>

<script>
    document.addEventListener("DOMContentLoaded", () => {
        // Reduced wait time to 2.0 seconds (2000ms)
        setTimeout(() => {
            const loader = document.getElementById('page-loader');
            const mainContent = document.getElementById('main-content');

            if (loader) {
                loader.classList.add('opacity-0');

                setTimeout(() => {
                    loader.style.display = 'none';

                    if (mainContent) {
                        mainContent.classList.remove('hidden');
                        mainContent.classList.add('animate-fade-in-up');
                    }
                }, 300);
            }
        }, 2000);
    });
</script>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.5s ease-out forwards;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>