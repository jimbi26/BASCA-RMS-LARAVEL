// LOGOUT LOADING SPINNER
document.addEventListener("DOMContentLoaded", function () {
    const logoutForm = document.getElementById("logoutForm");

    if (!logoutForm) {
        return;
    }

    logoutForm.addEventListener("submit", function () {
        const button = document.getElementById("logoutButton");
        const spinner = document.getElementById("logoutSpinner");
        const icon = document.getElementById("logoutIcon");
        const text = document.getElementById("logoutButtonText");

        if (!button || !spinner || !icon || !text) {
            return;
        }

        button.disabled = true;

        // Show spinner
        spinner.classList.remove("hidden");

        // Hide logout icon
        icon.classList.add("hidden");

        // Change text
        text.textContent = "Signing out...";

        // Disable hover effect
        button.classList.remove("hover:bg-white/5", "hover:text-white");

        // Disabled appearance
        button.classList.add("opacity-80", "cursor-not-allowed");
    });
});
