document.addEventListener("DOMContentLoaded", () => {
    const itemsPerPage = 10;
    let currentPage = 1,
        filtered = [];

    const desktopItems = document.querySelectorAll(
        "#desktop-table tbody tr.senior-item",
    );
    const mobileItems = document.querySelectorAll(
        "#mobile-list div.senior-item",
    );
    const searchInput = document.getElementById("client-search");
    const noMatchMsg = document.getElementById("no-match-message");
    const recordsContainer = document.getElementById("records-container");
    const paginationContainer = document.getElementById("js-pagination");

    // Expose globally for inline buttons
    window.changePage = (page) => {
        currentPage = page;
        renderView();
    };

    const renderView = () => {
        const total = filtered.length;
        const pages = Math.ceil(total / itemsPerPage) || 1;
        const start = (currentPage - 1) * itemsPerPage;
        const pageIndices = filtered.slice(start, start + itemsPerPage);

        // Safely update visibility based strictly on paginated indices
        desktopItems.forEach((el, i) => {
            const isVisible = pageIndices.includes(i);
            el.style.display = isVisible ? "" : "none";
            if (mobileItems[i])
                mobileItems[i].style.display = isVisible ? "" : "none";
        });

        // Toggle matching states
        noMatchMsg.classList.toggle("hidden", total > 0);
        noMatchMsg.classList.toggle("flex", total === 0);
        recordsContainer.classList.toggle("hidden", total === 0);
        paginationContainer.classList.toggle("hidden", total === 0);

        if (total === 0) return;

        // Render dynamic pagination UI
        const end = Math.min(currentPage * itemsPerPage, total);
        let html = `<span class="text-sm font-medium text-slate-500 order-2 sm:order-1">Showing <span class="font-bold text-slate-900">${start + 1}</span> to <span class="font-bold text-slate-900">${end}</span> of <span class="font-bold text-slate-900">${total}</span></span>`;

        if (pages > 1) {
            html += `<div class="flex items-center gap-1.5 order-1 sm:order-2">`;
            html += `<button onclick="changePage(${currentPage - 1})" class="px-3.5 py-2 rounded-lg text-sm font-semibold border ${currentPage === 1 ? "text-slate-400 bg-slate-100 cursor-not-allowed" : "text-slate-700 bg-white hover:bg-slate-50"}" ${currentPage === 1 ? "disabled" : ""}>Prev</button>`;

            let last = null;
            for (let i = 1; i <= pages; i++) {
                if (
                    pages <= 7 ||
                    i === 1 ||
                    i === pages ||
                    Math.abs(i - currentPage) <= 1
                ) {
                    const activeClass =
                        i === currentPage
                            ? "bg-[#14294D] text-white"
                            : "bg-white text-slate-600 border-slate-300 hover:bg-slate-50";
                    html += `<button onclick="changePage(${i})" class="h-9 w-9 flex items-center justify-center border rounded-lg text-sm font-bold ${activeClass}">${i}</button>`;
                    last = i;
                } else if (last !== "...") {
                    html += `<span class="px-2 text-slate-400 font-medium">...</span>`;
                    last = "...";
                }
            }
            html += `<button onclick="changePage(${currentPage + 1})" class="px-3.5 py-2 rounded-lg text-sm font-semibold border ${currentPage === pages ? "text-slate-400 bg-slate-100 cursor-not-allowed" : "text-slate-700 bg-white hover:bg-slate-50"}" ${currentPage === pages ? "disabled" : ""}>Next</button></div>`;
        }

        paginationContainer.innerHTML = html;
    };

    const triggerSearch = () => {
        const term = searchInput ? searchInput.value.toLowerCase().trim() : "";
        filtered = [];
        // Collect valid match indices
        desktopItems.forEach((el, i) => {
            if (el.innerText.toLowerCase().includes(term)) filtered.push(i);
        });
        currentPage = 1;
        renderView();
    };

    // Init listeners
    if (searchInput) searchInput.addEventListener("input", triggerSearch);
    triggerSearch();
});
