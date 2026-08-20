<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-browse-top />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/add-senior.js'])
    <title>BASCA-RMS - Edit Senior Citizen</title>
</head>

<body class="bg-slate-100 text-slate-800 antialiased font-sans">

    <div class="flex min-h-screen">
        <x-sidebar />

        <main class="w-full flex-1 space-y-6 p-4 pt-24 sm:p-6 lg:ml-[360px] lg:p-8">

            @php
                // Same styling variables as the Add Senior page
                $labelClass = "block text-sm font-bold uppercase tracking-wider text-slate-700 mb-2";
                $inputClass = "w-full rounded-2xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base md:text-lg text-slate-900 font-medium placeholder-slate-400 focus:border-[#14294D] focus:bg-white focus:ring-2 focus:ring-[#14294D]/20 focus:outline-none transition-all shadow-sm [color-scheme:light]";
                $fileInputClass = "w-full text-base text-slate-600 file:mr-4 file:py-3 file:px-5 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-[#14294D]/10 file:text-[#14294D] hover:file:bg-[#14294D]/20 cursor-pointer border border-slate-300 bg-slate-50 rounded-2xl p-2 focus:outline-none shadow-sm transition-all";
                $sectionHeaderClass = "flex items-center gap-3 px-5 py-3.5 bg-gradient-to-r from-[#14294D]/10 via-[#14294D]/5 to-transparent border-l-4 border-[#C69A2E] text-[#14294D] text-lg md:text-xl font-bold tracking-tight rounded-r-xl mb-6";
            @endphp

            <!-- CONTAINER CARD -->
            <div class="rounded-2xl border border-slate-200 bg-white shadow-md overflow-hidden">

                <!-- HEADER / TOOLBAR -->
                <div
                    class="flex flex-col gap-4 border-b border-slate-200 bg-white p-6 sm:p-8 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="font-serif text-3xl font-extrabold text-slate-900 sm:text-4xl tracking-tight">
                            Edit Senior Citizen
                        </h1>
                        <p class="mt-1 text-base font-medium text-slate-500">
                            Update the information of an existing senior citizen record
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <!-- BACK BUTTON -->
                        <button type="button" onclick="history.back()"
                            class="inline-flex items-center justify-center gap-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3.5 text-base md:text-lg border border-slate-300 transition-all duration-150 active:scale-[0.98] shadow-sm">
                            <i class="fa-solid fa-arrow-left-long text-lg"></i>
                            BACK
                        </button>
                    </div>
                </div>

                <x-notification-modal />

                <!-- FORM SECTION -->
                <form action="{{ route('seniors.update', $senior->senior_id) }}" method="POST"
                    enctype="multipart/form-data" id="editSeniorForm" class="p-6 sm:p-8 space-y-10">
                    @csrf
                    @method('PUT')

                    <!-- 1. PERSONAL INFORMATION -->
                    <div>
                        <div class="{{ $sectionHeaderClass }}">
                            <i class="fa-solid fa-user-vcard text-[#14294D] text-xl"></i>
                            <span>1. Personal & Identification Info</span>
                        </div>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3 lg:grid-cols-4">
                            <div>
                                <label class="{{ $labelClass }}">Senior ID</label>
                                <input type="text" name="senior_id" value="{{ $senior->senior_id }}"
                                    class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">RRN</label>
                                <input type="text" name="rrn" placeholder="Registration Ref. No."
                                    value="{{ $senior->rrn ?? '' }}" class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">First Name <span class="text-red-500">*</span></label>
                                <input type="text" name="first_name" placeholder="First Name" required
                                    value="{{ $senior->first_name }}" class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Middle Name</label>
                                <input type="text" name="middle_name" placeholder="Middle Name"
                                    value="{{ $senior->middle_name ?? '' }}" class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Last Name <span class="text-red-500">*</span></label>
                                <input type="text" name="last_name" placeholder="Last Name" required
                                    value="{{ $senior->last_name }}" class="{{ $inputClass }}">
                            </div>

                            <!-- ENHANCED USER-FRIENDLY DATE PICKER -->
                            <div>
                                <label class="{{ $labelClass }}">Birth Date</label>
                                <div class="relative">
                                    <div class="grid grid-cols-3 gap-3 font-poppins">
                                        <!-- Hidden input for backend store function & JS age calculation -->
                                        <input type="hidden" id="birth_date" name="birth_date"
                                            value="{{ $senior->birth_date ?? '' }}">

                                        <!-- MONTH DROPDOWN -->
                                        <div class="relative custom-dob-dropdown">
                                            <button type="button" onclick="toggleDobMenu('month')"
                                                class="w-full flex items-center justify-between rounded-xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base font-medium text-slate-900 focus:border-[#14294D] focus:bg-white focus:ring-2 focus:ring-[#14294D]/20 transition-all shadow-sm">
                                                <span id="selected-month"
                                                    class="text-slate-800 font-poppins font-bold">Month</span>
                                                <i class="fa-solid fa-chevron-down text-xs text-slate-500"></i>
                                            </button>

                                            <!-- STRICTLY OPEN AT BOTTOM BELOW BUTTON -->
                                            <div id="menu-month" style="top: 100%; bottom: auto;"
                                                class="hidden absolute left-0 mt-2 w-full rounded-xl border border-slate-200 bg-white shadow-xl z-[999] max-h-56 overflow-y-auto py-1.5 font-poppins">
                                                @foreach(['01' => 'Jan', '02' => 'Feb', '03' => 'Mar', '04' => 'Apr', '05' => 'May', '06' => 'Jun', '07' => 'Jul', '08' => 'Aug', '09' => 'Sep', '10' => 'Oct', '11' => 'Nov', '12' => 'Dec'] as $num => $month)
                                                    <div onclick="selectDobOption('month', '{{ $num }}', '{{ $month }}')"
                                                        class="px-4 py-2.5 text-sm font-medium text-slate-800 hover:bg-[#14294D]/10 hover:text-[#14294D] cursor-pointer transition-colors">
                                                        {{ $month }}
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- DAY DROPDOWN -->
                                        <div class="relative custom-dob-dropdown">
                                            <button type="button" onclick="toggleDobMenu('day')"
                                                class="w-full flex items-center justify-between rounded-xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base font-medium text-slate-900 focus:border-[#14294D] focus:bg-white focus:ring-2 focus:ring-[#14294D]/20 transition-all shadow-sm">
                                                <span id="selected-day"
                                                    class="text-slate-800 font-poppins font-bold">Day</span>
                                                <i class="fa-solid fa-chevron-down text-xs text-slate-500"></i>
                                            </button>

                                            <!-- STRICTLY OPEN AT BOTTOM BELOW BUTTON -->
                                            <div id="menu-day" style="top: 100%; bottom: auto;"
                                                class="hidden absolute left-0 mt-2 w-full rounded-xl border border-slate-200 bg-white shadow-xl z-[999] max-h-56 overflow-y-auto py-1.5 font-poppins">
                                                @for($d = 1; $d <= 31; $d++)
                                                    @php $dayVal = sprintf('%02d', $d); @endphp
                                                    <div onclick="selectDobOption('day', '{{ $dayVal }}', '{{ $d }}')"
                                                        class="px-4 py-2.5 text-sm font-medium text-slate-800 hover:bg-[#14294D]/10 hover:text-[#14294D] cursor-pointer transition-colors">
                                                        {{ $d }}
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>

                                        <!-- YEAR DROPDOWN (1966 down to 1900) -->
                                        <div class="relative custom-dob-dropdown">
                                            <button type="button" onclick="toggleDobMenu('year')"
                                                class="w-full flex items-center justify-between rounded-xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base font-medium text-slate-900 focus:border-[#14294D] focus:bg-white focus:ring-2 focus:ring-[#14294D]/20 transition-all shadow-sm">
                                                <span id="selected-year"
                                                    class="text-slate-800 font-poppins font-bold">Year</span>
                                                <i class="fa-solid fa-chevron-down text-xs text-slate-500"></i>
                                            </button>

                                            <!-- STRICTLY OPEN AT BOTTOM BELOW BUTTON -->
                                            <div id="menu-year" style="top: 100%; bottom: auto;"
                                                class="hidden absolute left-0 mt-2 w-full rounded-xl border border-slate-200 bg-white shadow-xl z-[999] max-h-56 overflow-y-auto py-1.5 font-poppins">
                                                @for($y = 1966; $y >= 1900; $y--)
                                                    <div onclick="selectDobOption('year', '{{ $y }}', '{{ $y }}')"
                                                        class="px-4 py-2.5 text-sm font-medium text-slate-800 hover:bg-[#14294D]/10 hover:text-[#14294D] cursor-pointer transition-colors">
                                                        {{ $y }}
                                                    </div>
                                                @endfor
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- AUTO-CALCULATED AGE -->
                            <div>
                                <label class="{{ $labelClass }}">Age</label>
                                <input type="number" id="age" name="age" placeholder="Auto-calculated" min="0"
                                    value="{{ $senior->age ?? '' }}" class="{{ $inputClass }} bg-slate-100/80">
                            </div>

                            <div class="relative custom-sex-dropdown font-poppins">
                                <label class="{{ $labelClass }}">Sex</label>

                                <!-- Hidden Input for Laravel backend submission -->
                                <input type="hidden" name="sex" id="sex_input" value="{{ $senior->sex ?? '' }}">

                                <!-- Trigger Button -->
                                <button type="button" onclick="toggleSexMenu()"
                                    class="w-full flex items-center justify-between rounded-xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base font-medium text-slate-900 focus:border-[#14294D] focus:bg-white focus:ring-2 focus:ring-[#14294D]/20 transition-all shadow-sm">
                                    <span id="selected-sex-display"
                                        class="flex items-center gap-2.5 text-slate-800 font-poppins font-bold">
                                        <i id="selected-sex-icon" class="hidden text-base"></i>
                                        <span id="selected-sex-text">Select Sex</span>
                                    </span>
                                    <i class="fa-solid fa-chevron-down text-xs text-slate-500"></i>
                                </button>

                                <!-- Dropdown Content (Strictly drops at bottom) -->
                                <div id="menu-sex" style="top: 100%; bottom: auto;"
                                    class="hidden absolute left-0 mt-2 w-full rounded-xl border border-slate-200 bg-white shadow-xl z-[999] py-1.5 font-poppins">
                                    <!-- Male Option -->
                                    <div onclick="selectSexOption('Male', 'fa-mars', 'text-blue-500', 'bg-blue-50')"
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-blue-50 hover:text-blue-600 cursor-pointer transition-colors">
                                        <div
                                            class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-500">
                                            <i class="fa-solid fa-mars text-base"></i>
                                        </div>
                                        <span>Male</span>
                                    </div>

                                    <!-- Female Option -->
                                    <div onclick="selectSexOption('Female', 'fa-venus', 'text-pink-500', 'bg-pink-50')"
                                        class="flex items-center gap-3 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-pink-50 hover:text-pink-600 cursor-pointer transition-colors">
                                        <div
                                            class="w-8 h-8 rounded-full bg-pink-100 flex items-center justify-center text-pink-500">
                                            <i class="fa-solid fa-venus text-base"></i>
                                        </div>
                                        <span>Female</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- 2. CONTACT & LOCATION -->
                    <div>
                        <div class="{{ $sectionHeaderClass }}">
                            <i class="fa-solid fa-location-dot text-[#14294D] text-xl"></i>
                            <span>2. Address & Contact Details</span>
                        </div>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
                            <!-- BARANGAY DROPDOWN -->
                            <div class="relative custom-barangay-dropdown font-poppins">
                                <label class="{{ $labelClass }}">Barangay <span class="text-red-500">*</span></label>

                                <div class="relative mt-1">
                                    <!-- Hidden input for backend form submission -->
                                    <input type="hidden" id="barangay" name="barangay"
                                        value="{{ $senior->barangay ?? '' }}" required>

                                    <button type="button" onclick="toggleBarangayMenu()"
                                        class="w-full flex items-center justify-between rounded-xl border border-slate-300 bg-slate-50 px-4 py-3.5 text-base font-medium text-slate-900 focus:border-[#14294D] focus:bg-white focus:ring-2 focus:ring-[#14294D]/20 transition-all shadow-sm">
                                        <span id="selected-barangay"
                                            class="text-slate-800 font-poppins font-bold">Select Barangay</span>
                                        <i class="fa-solid fa-chevron-down text-xs text-slate-500"></i>
                                    </button>

                                    <!-- DROPDOWN MENU -->
                                    <div id="menu-barangay" style="top: 100%; bottom: auto;"
                                        class="hidden absolute left-0 mt-2 w-full rounded-xl border border-slate-200 bg-white shadow-xl z-[999] max-h-56 overflow-y-auto py-1.5 font-poppins">
                                        @php
                                            $barangays = [
                                                'Bakir',
                                                'Baretbet',
                                                'Careb',
                                                'Lantap',
                                                'Murong',
                                                'Nangalisan',
                                                'Paniki',
                                                'Pogonsino',
                                                'San Geronimo (Poblacion)',
                                                'San Pedro (Poblacion)',
                                                'Santa Cruz',
                                                'Santa Lucia',
                                                'Tuao North',
                                                'Tuao South',
                                                'Villa Coloma (Poblacion)',
                                                'Villa Quirino (Poblacion)',
                                                'Villaros'
                                            ];
                                        @endphp
                                        @foreach($barangays as $barangay)
                                            <div onclick="selectBarangayOption('{{ $barangay }}')"
                                                class="px-4 py-2.5 text-sm font-medium text-slate-800 hover:bg-[#14294D]/10 hover:text-[#14294D] cursor-pointer transition-colors">
                                                {{ $barangay }}
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Purok <span class="text-red-500">*</span></label>
                                <input type="text" name="purok" placeholder="Purok / Zone"
                                    value="{{ $senior->purok ?? '' }}" class="{{ $inputClass }}" required>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Contact Number <span
                                        class="text-red-500">*</span></label>
                                <input type="text" name="contact_number" placeholder="09123456789"
                                    value="{{ $senior->contact_number ?? '' }}" class="{{ $inputClass }}" required>
                            </div>
                        </div>
                    </div>

                    <!-- 3. SOCIO-ECONOMIC & HEALTH -->
                    <div>
                        <div class="{{ $sectionHeaderClass }}">
                            <i class="fa-solid fa-heart-pulse text-[#14294D] text-xl"></i>
                            <span>3. Socio-Economic & Health Details</span>
                        </div>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                            <div>
                                <label class="{{ $labelClass }}">Pension Provider</label>
                                <input type="text" name="pension" placeholder="e.g. Social Pension, SSS, None"
                                    value="{{ $senior->pension ?? '' }}" class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">PhilHealth Number</label>
                                <input type="text" name="philhealth_number" placeholder="12-345678901-2"
                                    value="{{ $senior->philhealth_number ?? '' }}" class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Household Dependency</label>
                                <input type="text" name="dependency" placeholder="e.g. Living Alone, With Family"
                                    value="{{ $senior->dependency ?? '' }}" class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Housing Status</label>
                                <input type="text" name="housing"
                                    placeholder="e.g. Owned, Rented, Living with Relatives"
                                    value="{{ $senior->housing ?? '' }}" class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Health Problems</label>
                                <input type="text" name="health_problems" placeholder="e.g. Hypertension, Diabetes"
                                    value="{{ $senior->health_problems ?? '' }}" class="{{ $inputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Disability</label>
                                <input type="text" name="disability" placeholder="e.g. Visual Impairment, None"
                                    value="{{ $senior->disability ?? '' }}" class="{{ $inputClass }}">
                            </div>

                            <div class="md:col-span-2">
                                <label class="{{ $labelClass }}">Regular Medicines</label>
                                <input type="text" name="medicines" placeholder="e.g. Maintenance drugs"
                                    value="{{ $senior->medicines ?? '' }}" class="{{ $inputClass }}">
                            </div>
                        </div>
                    </div>

                    <!-- 4. ATTACHMENTS & DOCUMENTS -->
                    <div>
                        <div class="{{ $sectionHeaderClass }}">
                            <i class="fa-solid fa-paperclip text-[#14294D] text-xl"></i>
                            <span>4. Documents & Attachments</span>
                        </div>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">
                            <div>
                                <label class="{{ $labelClass }}">Photo (2x2 / Profile)</label>
                                @if($senior->photo)
                                    <div
                                        class="mb-2 flex items-center gap-2 rounded-xl bg-[#14294D]/5 border border-[#14294D]/15 px-3 py-2 text-sm text-[#14294D] font-medium">
                                        <i class="fa-solid fa-image text-xs"></i>
                                        <span class="truncate">Current file uploaded</span>
                                    </div>
                                @endif
                                <input type="file" name="photo" accept="image/*" class="{{ $fileInputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Senior ID Image</label>
                                @if($senior->senior_id_image)
                                    <div
                                        class="mb-2 flex items-center gap-2 rounded-xl bg-[#14294D]/5 border border-[#14294D]/15 px-3 py-2 text-sm text-[#14294D] font-medium">
                                        <i class="fa-solid fa-image text-xs"></i>
                                        <span class="truncate">Current file uploaded</span>
                                    </div>
                                @endif
                                <input type="file" name="senior_id_image" accept="image/*"
                                    class="{{ $fileInputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">PSA Birth Certificate</label>
                                @if($senior->psa)
                                    <div
                                        class="mb-2 flex items-center gap-2 rounded-xl bg-[#14294D]/5 border border-[#14294D]/15 px-3 py-2 text-sm text-[#14294D] font-medium">
                                        <i class="fa-solid fa-file text-xs"></i>
                                        <span class="truncate">Current file uploaded</span>
                                    </div>
                                @endif
                                <input type="file" name="psa" accept="image/*,.pdf" class="{{ $fileInputClass }}">
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">NCSC Form</label>
                                @if($senior->ncsc_form)
                                    <div
                                        class="mb-2 flex items-center gap-2 rounded-xl bg-[#14294D]/5 border border-[#14294D]/15 px-3 py-2 text-sm text-[#14294D] font-medium">
                                        <i class="fa-solid fa-file text-xs"></i>
                                        <span class="truncate">Current file uploaded</span>
                                    </div>
                                @endif
                                <input type="file" name="ncsc_form" accept="image/*,.pdf" class="{{ $fileInputClass }}">
                            </div>
                        </div>
                    </div>

                    <!-- FORM ACTIONS -->
                    <div class="flex items-center justify-end gap-4 pt-8 border-t border-slate-200">

                        <!-- Submit Button -->
                        <button type="submit" id="updateSeniorBtn"
                            class="inline-flex items-center justify-center gap-2.5 rounded-2xl bg-[#14294D] hover:bg-[#1b345f] text-white font-bold px-8 py-3.5 text-base md:text-lg border border-transparent transition-all duration-150 active:scale-[0.98] shadow-md hover:shadow-lg disabled:opacity-80 disabled:cursor-not-allowed">

                            <!-- Spinner -->
                            <i id="updateSeniorSpinner"
                                class="hidden size-5 border-2 border-white/30 border-t-white rounded-full animate-spin"></i>

                            <!-- Icon -->
                            <i id="updateSeniorIcon" class="fa-solid fa-floppy-disk text-lg"></i>

                            <!-- Text -->
                            <span id="updateSeniorText">UPDATE RECORD</span>
                        </button>
                    </div>
                </form>

            </div>
        </main>
    </div>

    <script>
        // --- PRE-POPULATE DROPDOWNS ON PAGE LOAD ---
        document.addEventListener('DOMContentLoaded', function () {

            // DOB: parse stored birth_date and set dropdown labels
            const birthDate = '{{ $senior->birth_date ?? "" }}';
            if (birthDate) {
                const [year, month, day] = birthDate.split('-');
                const monthMap = { '01': 'Jan', '02': 'Feb', '03': 'Mar', '04': 'Apr', '05': 'May', '06': 'Jun', '07': 'Jul', '08': 'Aug', '09': 'Sep', '10': 'Oct', '11': 'Nov', '12': 'Dec' };

                // Set dropdown labels directly (bypass selectDobOption to avoid age re-calc issues)
                const monthSpan = document.getElementById('selected-month');
                if (monthSpan && monthMap[month]) {
                    monthSpan.textContent = monthMap[month];
                    monthSpan.classList.remove('text-slate-400');
                    monthSpan.classList.add('text-slate-900', 'font-semibold');
                }

                const daySpan = document.getElementById('selected-day');
                if (daySpan) {
                    daySpan.textContent = parseInt(day);
                    daySpan.classList.remove('text-slate-400');
                    daySpan.classList.add('text-slate-900', 'font-semibold');
                }

                const yearSpan = document.getElementById('selected-year');
                if (yearSpan) {
                    yearSpan.textContent = year;
                    yearSpan.classList.remove('text-slate-400');
                    yearSpan.classList.add('text-slate-900', 'font-semibold');
                }

                // Sync dobValues so dropdown interactions continue to work correctly
                if (typeof dobValues !== 'undefined') {
                    dobValues.month = month;
                    dobValues.day = day;
                    dobValues.year = year;
                }
            }

            // SEX: pre-select based on stored value
            const sex = '{{ $senior->sex ?? "" }}';
            if (sex === 'Male' || sex === 'Female') {
                const sexInput = document.getElementById('sex_input');
                const sexText = document.getElementById('selected-sex-text');
                const sexIcon = document.getElementById('selected-sex-icon');

                if (sexInput) sexInput.value = sex;
                if (sexText) {
                    sexText.textContent = sex;
                    sexText.classList.remove('text-slate-400');
                    sexText.classList.add('text-slate-900', 'font-semibold');
                }
                if (sexIcon) {
                    if (sex === 'Male') {
                        sexIcon.className = 'fa-solid fa-mars text-blue-500 text-lg';
                    } else {
                        sexIcon.className = 'fa-solid fa-venus text-pink-500 text-lg';
                    }
                    sexIcon.classList.remove('hidden');
                }
            }

            // BARANGAY: pre-select based on stored value
            const barangay = '{{ $senior->barangay ?? "" }}';
            if (barangay) {
                const barangayInput = document.getElementById('barangay');
                const barangayLabel = document.getElementById('selected-barangay');
                if (barangayInput) barangayInput.value = barangay;
                if (barangayLabel) {
                    barangayLabel.textContent = barangay;
                    barangayLabel.classList.remove('text-slate-400');
                    barangayLabel.classList.add('text-slate-800', 'font-bold');
                }
            }

            // --- SUBMIT HANDLER (mirrors add-senior.js pattern but for update) ---
            const editForm = document.getElementById('editSeniorForm');
            if (editForm) {
                editForm.addEventListener('submit', function () {
                    const button = document.getElementById('updateSeniorBtn');
                    const spinner = document.getElementById('updateSeniorSpinner');
                    const icon = document.getElementById('updateSeniorIcon');
                    const text = document.getElementById('updateSeniorText');

                    if (!button || !spinner || !icon || !text) return;

                    button.disabled = true;
                    spinner.classList.remove('hidden');
                    icon.classList.add('hidden');
                    text.textContent = 'Updating...';
                    button.classList.add('opacity-80', 'cursor-not-allowed');
                });
            }
        });
    </script>

</body>

</html>