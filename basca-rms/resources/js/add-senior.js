// --- ACCURATE AGE CALCULATION ---
document.getElementById("birth_date")?.addEventListener("change", function () {
    if (!this.value) return;

    // Parse explicitly in local timezone to avoid UTC offset shifts
    const [year, month, day] = this.value.split("-").map(Number);
    const birthDate = new Date(year, month - 1, day);
    const today = new Date();

    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDiff = today.getMonth() - birthDate.getMonth();

    if (
        monthDiff < 0 ||
        (monthDiff === 0 && today.getDate() < birthDate.getDate())
    ) {
        age--;
    }

    const ageInput = document.getElementById("age");
    if (ageInput) ageInput.value = age >= 0 ? age : 0;
});

// --- DOB DROPDOWN SELECTION ---
const dobValues = { month: "", day: "", year: "" };

function toggleDobMenu(type) {
    const targetMenu = document.getElementById(`menu-${type}`);
    const isHidden = targetMenu?.classList.contains("hidden");

    closeAllDropdowns();

    if (isHidden) {
        targetMenu?.classList.remove("hidden");
    }
}

function selectDobOption(type, value, label) {
    dobValues[type] = value;

    const labelSpan = document.getElementById(`selected-${type}`);
    if (labelSpan) {
        labelSpan.textContent = label;
        labelSpan.classList.remove("text-slate-400");
        labelSpan.classList.add("text-slate-900", "font-semibold");
    }

    closeAllDropdowns();

    if (dobValues.month && dobValues.day && dobValues.year) {
        const dateInput = document.getElementById("birth_date");
        if (dateInput) {
            dateInput.value = `${dobValues.year}-${dobValues.month}-${dobValues.day}`;
            dateInput.dispatchEvent(new Event("change"));
        }
    }
}

// --- SEX DROPDOWN SELECTION ---
function toggleSexMenu() {
    const menu = document.getElementById("menu-sex");
    const isHidden = menu?.classList.contains("hidden");

    closeAllDropdowns();

    if (isHidden) {
        menu?.classList.remove("hidden");
    }
}

function selectSexOption(value, iconClass, colorClass) {
    const sexInput = document.getElementById("sex_input");
    const textSpan = document.getElementById("selected-sex-text");
    const iconI = document.getElementById("selected-sex-icon");

    if (sexInput) sexInput.value = value;

    if (textSpan) {
        textSpan.textContent = value;
        textSpan.classList.remove("text-slate-400");
        textSpan.classList.add("text-slate-900", "font-semibold");
    }

    if (iconI) {
        iconI.className = `fa-solid ${iconClass} ${colorClass} text-lg`;
        iconI.classList.remove("hidden");
    }

    closeAllDropdowns();
}

// --- BARANGAY DROPDOWN SELECTION ---
function toggleBarangayMenu() {
    const menu = document.getElementById("menu-barangay");
    const isHidden = menu?.classList.contains("hidden");

    closeAllDropdowns();

    if (isHidden) {
        menu?.classList.remove("hidden");
    }
}

function selectBarangayOption(value) {
    const barangayInput = document.getElementById("barangay");
    const labelSpan = document.getElementById("selected-barangay");

    if (barangayInput) {
        barangayInput.value = value;
        barangayInput.dispatchEvent(new Event("change"));
    }

    if (labelSpan) {
        labelSpan.textContent = value;
        labelSpan.classList.remove("text-slate-400");
        labelSpan.classList.add("text-slate-800", "font-bold");
    }

    closeAllDropdowns();
}

// --- DROPDOWN STATE HELPER ---
function closeAllDropdowns() {
    ["month", "day", "year"].forEach((t) => {
        document.getElementById(`menu-${t}`)?.classList.add("hidden");
    });
    document.getElementById("menu-barangay")?.classList.add("hidden");
    document.getElementById("menu-sex")?.classList.add("hidden");
}

// --- FORM RESET FUNCTION ---
function resetSeniorForm() {
    const seniorForm = document.getElementById("seniorForm");
    if (seniorForm) seniorForm.reset();

    dobValues.month = "";
    dobValues.day = "";
    dobValues.year = "";

    const selectedMonth = document.getElementById("selected-month");
    if (selectedMonth) {
        selectedMonth.textContent = "Month";
        selectedMonth.className = "text-slate-800 font-poppins font-bold";
    }

    const selectedDay = document.getElementById("selected-day");
    if (selectedDay) {
        selectedDay.textContent = "Day";
        selectedDay.className = "text-slate-800 font-poppins font-bold";
    }

    const selectedYear = document.getElementById("selected-year");
    if (selectedYear) {
        selectedYear.textContent = "Year";
        selectedYear.className = "text-slate-800 font-poppins font-bold";
    }

    const selectedSexText = document.getElementById("selected-sex-text");
    if (selectedSexText) {
        selectedSexText.textContent = "Select Sex";
        selectedSexText.className = "";
    }

    const selectedSexIcon = document.getElementById("selected-sex-icon");
    if (selectedSexIcon) {
        selectedSexIcon.className = "hidden text-base";
    }

    const selectedBarangay = document.getElementById("selected-barangay");
    if (selectedBarangay) {
        selectedBarangay.textContent = "Select Barangay";
        selectedBarangay.className = "text-slate-800 font-poppins font-bold";
    }

    closeAllDropdowns();
}

// --- SINGLE GLOBAL OUTSIDE-CLICK LISTENER ---
document.addEventListener("click", function (e) {
    const isDob = e.target.closest(".custom-dob-dropdown");
    const isBarangay = e.target.closest(".custom-barangay-dropdown");
    const isSex = e.target.closest(".custom-sex-dropdown");

    if (!isDob && !isBarangay && !isSex) {
        closeAllDropdowns();
    }
});

// --- GLOBAL WINDOW EXPORTS ---
Object.assign(window, {
    toggleDobMenu,
    selectDobOption,
    toggleSexMenu,
    selectSexOption,
    toggleBarangayMenu,
    selectBarangayOption,
    resetSeniorForm,
});

document.addEventListener("DOMContentLoaded", function () {
    const seniorForm = document.getElementById("seniorForm");

    if (!seniorForm) return;

    seniorForm.addEventListener("submit", function () {
        const button = document.getElementById("saveSeniorBtn");
        const spinner = document.getElementById("saveSeniorSpinner");
        const icon = document.getElementById("saveSeniorIcon");
        const text = document.getElementById("saveSeniorText");

        if (!button || !spinner || !icon || !text) return;

        button.disabled = true;
        spinner.classList.remove("hidden");
        icon.classList.add("hidden");
        text.textContent = "Saving...";
        button.classList.add("opacity-80", "cursor-not-allowed");
    });
});
