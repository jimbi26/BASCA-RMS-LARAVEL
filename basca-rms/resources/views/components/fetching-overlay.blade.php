<!-- resources/views/components/fetching-overlay.blade.php -->
<div id="fetching-overlay"
    class="fixed inset-0 z-[999] flex flex-col items-center justify-center bg-gray-50/90 backdrop-blur-sm lg:ml-[360px] transition-opacity duration-300 hidden">

    <div
        class="h-20 w-20 animate-spin [animation-duration:0.5s] rounded-full border-4 border-solid border-indigo-600 border-t-transparent">
    </div>

    <p id="fetching-overlay-text" class="mt-5 text-sm font-medium text-gray-600 animate-pulse">
        Please wait, data is fetching...
    </p>

</div>