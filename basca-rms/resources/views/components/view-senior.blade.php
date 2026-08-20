<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-browse-top />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>BASCA-RMS - {{ $senior->first_name }} {{ $senior->last_name }}</title>
</head>

<body class="bg-slate-100 text-slate-800 antialiased font-sans">

    <div class="flex min-h-screen">
        <x-sidebar />

        <main class="w-full flex-1 space-y-6 p-4 pt-24 sm:p-6 lg:ml-[360px] lg:p-8">

            @php
                // Read-only field display styling — mirrors input styling but clearly non-editable
                $labelClass = "block text-sm font-bold uppercase tracking-wider text-slate-500 mb-2";
                $valueClass = "w-full rounded-xl border border-slate-200 bg-slate-50 px-4 py-3 text-base md:text-lg text-slate-900 font-medium";
                $sectionHeaderClass = "flex items-center gap-3 px-5 py-3.5 bg-gradient-to-r from-[#14294D]/10 via-[#14294D]/5 to-transparent border-l-4 border-[#C69A2E] text-[#14294D] text-lg md:text-xl font-bold tracking-tight rounded-r-xl mb-6";
                $isMale = strtolower($senior->sex) === 'male';
            @endphp

            @if(session('success'))
                <div class="rounded-xl border border-green-200 bg-green-50 p-4 text-green-700 font-medium mb-4">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-red-700 font-medium mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- CONTAINER CARD -->
            <div class="rounded-2xl border border-slate-200 bg-white shadow-md overflow-hidden">

                <!-- HEADER / TOOLBAR -->
                <div
                    class="flex flex-col gap-4 border-b border-slate-200 bg-white p-6 sm:p-8 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h1 class="font-serif text-3xl font-extrabold text-slate-900 sm:text-4xl tracking-tight">
                            Senior Citizen Profile
                        </h1>
                        <p class="mt-1 text-base font-medium text-slate-500">
                            Viewing record for {{ $senior->first_name }} {{ $senior->middle_name }}
                            {{ $senior->last_name }}
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <!-- BACK BUTTON -->
                        <a href="{{ route('seniors.senior-records') }}"
                            class="inline-flex items-center justify-center gap-2.5 rounded-2xl bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold px-6 py-3.5 text-base md:text-lg border border-slate-300 transition-all duration-150 active:scale-[0.98] shadow-sm">
                            <i class="fa-solid fa-arrow-left-long text-lg"></i>
                            BACK
                        </a>

                        <!-- EDIT BUTTON -->
                        <a href="{{ route('seniors.edit', $senior->senior_id) }}"
                            class="inline-flex items-center justify-center gap-2.5 rounded-2xl bg-[#14294D] hover:bg-[#1b345f] text-white font-bold px-6 py-3.5 text-base md:text-lg border border-transparent transition-all duration-150 active:scale-[0.98] shadow-md hover:shadow-lg">
                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                            EDIT
                        </a>
                    </div>
                </div>

                <!-- CONTENT SECTIONS -->
                <div class="p-6 sm:p-8 space-y-10">

                    <!-- 1. PERSONAL INFORMATION -->
                    <div>
                        <div class="{{ $sectionHeaderClass }}">
                            <i class="fa-solid fa-user-vcard text-[#14294D] text-xl"></i>
                            <span>1. Personal & Identification Info</span>
                        </div>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-3 lg:grid-cols-4">
                            <div>
                                <label class="{{ $labelClass }}">Senior ID</label>
                                <div class="{{ $valueClass }} font-mono font-bold tracking-wide">
                                    <i
                                        class="fa-solid fa-hashtag text-xs text-slate-400 mr-1"></i>{{ $senior->senior_id }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">RRN</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->rrn ?? '—' }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">First Name</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->first_name }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Middle Name</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->middle_name ?? '—' }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Last Name</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->last_name }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Birth Date</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->birth_date ? \Carbon\Carbon::parse($senior->birth_date)->format('F d, Y') : '—' }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Age</label>
                                <div class="{{ $valueClass }}">
                                    @if($senior->age)
                                        {{ $senior->age }} <span class="text-slate-500 font-medium text-sm">years old</span>
                                    @else
                                        —
                                    @endif
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Sex</label>
                                <div class="{{ $valueClass }}">
                                    @if($senior->sex)
                                        <span
                                            class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-sm font-bold uppercase tracking-wider {{ $isMale ? 'bg-blue-100 text-blue-800 border border-blue-200' : 'bg-pink-100 text-pink-800 border border-pink-200' }}">
                                            <i
                                                class="fa-solid {{ $isMale ? 'fa-mars text-blue-600' : 'fa-venus text-pink-600' }} text-sm"></i>{{ $senior->sex }}
                                        </span>
                                    @else
                                        —
                                    @endif
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
                            <div>
                                <label class="{{ $labelClass }}">Barangay</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->barangay ?? '—' }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Purok</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->purok ?? '—' }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Contact Number</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->contact_number ?? '—' }}
                                </div>
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
                                <div class="{{ $valueClass }}">
                                    {{ $senior->pension ?? '—' }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">PhilHealth Number</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->philhealth_number ?? '—' }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Household Dependency</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->dependency ?? '—' }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Housing Status</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->housing ?? '—' }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Health Problems</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->health_problems ?? '—' }}
                                </div>
                            </div>

                            <div>
                                <label class="{{ $labelClass }}">Disability</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->disability ?? '—' }}
                                </div>
                            </div>

                            <div class="md:col-span-2">
                                <label class="{{ $labelClass }}">Regular Medicines</label>
                                <div class="{{ $valueClass }}">
                                    {{ $senior->medicines ?? '—' }}
                                </div>
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

                            <!-- Photo -->
                            <div>
                                <label class="{{ $labelClass }}">Photo (2x2 / Profile)</label>
                                <div class="mt-2 flex flex-col xl:flex-row items-start xl:items-center gap-4">
                                    @if($senior->photo)
                                        <img src="{{ $senior->photo_url }}"
                                            alt="{{ $senior->first_name }} {{ $senior->last_name }}"
                                            class="w-28 h-28 rounded-xl object-cover border border-slate-200 shadow-sm">

                                        <div class="flex items-center gap-3">
                                            <button type="button" onclick="printPhotoA4(this)"
                                                data-photo-url="{{ $senior->photo_url }}"
                                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#14294D] hover:bg-[#1b345f] text-white font-bold px-4 py-2.5 text-base border border-transparent transition-all duration-150 active:scale-[0.98] shadow-md">
                                                <i class="fa-solid fa-print text-lg"></i>
                                                <span>Print on A4</span>
                                            </button>

                                            <form
                                                action="{{ route('seniors.document.destroy', ['senior_id' => $senior->senior_id, 'field' => 'photo']) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this photo? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-red-100 hover:bg-red-200 text-red-700 font-bold border border-transparent transition-all duration-150 active:scale-[0.98] shadow-sm">
                                                    <i class="fa-solid fa-trash-can text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div
                                            class="flex flex-col items-center justify-center w-28 h-28 rounded-xl border border-dashed border-slate-300 bg-slate-50 text-slate-400">
                                            <i class="fa-solid fa-image text-xl"></i>
                                            <span class="text-[10px] font-semibold uppercase mt-1">No Photo</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Senior ID Image -->
                            <div>
                                <label class="{{ $labelClass }}">Senior ID Image</label>
                                <div class="mt-2 flex flex-col xl:flex-row items-start xl:items-center gap-4">
                                    @if($senior->senior_id_image)
                                        <img src="{{ $senior->senior_id_image_url }}" alt="Senior ID"
                                            class="w-28 h-28 rounded-xl object-cover border border-slate-200 shadow-sm">

                                        <div class="flex items-center gap-3">
                                            <button type="button" onclick="printPhotoA4(this)"
                                                data-photo-url="{{ $senior->senior_id_image_url }}"
                                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#14294D] hover:bg-[#1b345f] text-white font-bold px-4 py-2.5 text-base border border-transparent transition-all duration-150 active:scale-[0.98] shadow-md">
                                                <i class="fa-solid fa-print text-lg"></i>
                                                <span>Print on A4</span>
                                            </button>

                                            <form
                                                action="{{ route('seniors.document.destroy', ['senior_id' => $senior->senior_id, 'field' => 'senior_id_image']) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this Senior ID image? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-red-100 hover:bg-red-200 text-red-700 font-bold border border-transparent transition-all duration-150 active:scale-[0.98] shadow-sm">
                                                    <i class="fa-solid fa-trash-can text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div
                                            class="flex flex-col items-center justify-center w-28 h-28 rounded-xl border border-dashed border-slate-300 bg-slate-50 text-slate-400">
                                            <i class="fa-solid fa-id-card text-xl"></i>
                                            <span class="text-[10px] font-semibold uppercase mt-1">No File</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- PSA Birth Certificate -->
                            <div>
                                <label class="{{ $labelClass }}">PSA Birth Certificate</label>
                                <div class="mt-2 flex flex-col xl:flex-row items-start xl:items-center gap-4">
                                    @if($senior->psa)
                                        <img src="{{ $senior->psa_url }}" alt="PSA Certificate"
                                            class="w-28 h-28 rounded-xl object-cover border border-slate-200 shadow-sm">

                                        <div class="flex items-center gap-3">
                                            <button type="button" onclick="printPhotoA4(this)"
                                                data-photo-url="{{ $senior->psa_url }}"
                                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#14294D] hover:bg-[#1b345f] text-white font-bold px-4 py-2.5 text-base border border-transparent transition-all duration-150 active:scale-[0.98] shadow-md">
                                                <i class="fa-solid fa-print text-lg"></i>
                                                <span>Print on A4</span>
                                            </button>

                                            <form
                                                action="{{ route('seniors.document.destroy', ['senior_id' => $senior->senior_id, 'field' => 'psa']) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this PSA certificate? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-red-100 hover:bg-red-200 text-red-700 font-bold border border-transparent transition-all duration-150 active:scale-[0.98] shadow-sm">
                                                    <i class="fa-solid fa-trash-can text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div
                                            class="flex flex-col items-center justify-center w-28 h-28 rounded-xl border border-dashed border-slate-300 bg-slate-50 text-slate-400">
                                            <i class="fa-solid fa-file-lines text-xl"></i>
                                            <span class="text-[10px] font-semibold uppercase mt-1">No File</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- NCSC Form -->
                            <div>
                                <label class="{{ $labelClass }}">NCSC Form</label>
                                <div class="mt-2 flex flex-col xl:flex-row items-start xl:items-center gap-4">
                                    @if($senior->ncsc_form)
                                        <img src="{{ $senior->ncsc_form_url }}" alt="NCSC Form"
                                            class="w-28 h-28 rounded-xl object-cover border border-slate-200 shadow-sm">

                                        <div class="flex items-center gap-3">
                                            <button type="button" onclick="printPhotoA4(this)"
                                                data-photo-url="{{ $senior->ncsc_form_url }}"
                                                class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#14294D] hover:bg-[#1b345f] text-white font-bold px-4 py-2.5 text-base border border-transparent transition-all duration-150 active:scale-[0.98] shadow-md">
                                                <i class="fa-solid fa-print text-lg"></i>
                                                <span>Print on A4</span>
                                            </button>

                                            <form
                                                action="{{ route('seniors.document.destroy', ['senior_id' => $senior->senior_id, 'field' => 'ncsc_form']) }}"
                                                method="POST"
                                                onsubmit="return confirm('Delete this NCSC form? This action cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-red-100 hover:bg-red-200 text-red-700 font-bold border border-transparent transition-all duration-150 active:scale-[0.98] shadow-sm">
                                                    <i class="fa-solid fa-trash-can text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @else
                                        <div
                                            class="flex flex-col items-center justify-center w-28 h-28 rounded-xl border border-dashed border-slate-300 bg-slate-50 text-slate-400">
                                            <i class="fa-solid fa-file-lines text-xl"></i>
                                            <span class="text-[10px] font-semibold uppercase mt-1">No File</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    @include('components.confirm-delete-modal')

    <script>
        function printPhotoA4(btn) {
            const photoUrl = btn.getAttribute('data-photo-url');
            window.open('/print/photo?url=' + encodeURIComponent(photoUrl), '_blank', 'width=800,height=600');
        }
    </script>

</body>

</html>