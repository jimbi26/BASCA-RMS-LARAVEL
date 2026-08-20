<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>BASCA-RMS - Dashboard</title>
</head>

<body class="bg-slate-100 text-slate-800 antialiased font-sans">

    <div class="flex min-h-screen">
        <x-sidebar />
        <x-page-loader />
        <x-fetching-overlay />
        <main id="main-content" class="w-full flex-1 space-y-6 p-4 pt-24 sm:p-6 lg:ml-[22rem] lg:p-8">

            @php
                $total = $totalSeniors ?? $seniors->count();
                $male = $maleCount ?? $seniors->where('sex', 'Male')->count();
                $female = $femaleCount ?? $seniors->where('sex', 'Female')->count();
                // Tappable action button styling with solid contrast
                $btnAction = "inline-flex h-9 w-9 items-center justify-center rounded-xl bg-slate-100 text-slate-600 transition-all hover:scale-105 active:scale-95 text-sm shadow-xs";
            @endphp

            <!-- WELCOME CARD -->
            <div class="relative overflow-hidden rounded-2xl bg-[#14294D] p-6 text-white shadow-xl sm:p-8">
                <div
                    class="pointer-events-none absolute -right-12 -top-12 h-48 w-48 rounded-full bg-[#C69A2E]/20 blur-2xl">
                </div>
                <div
                    class="pointer-events-none absolute right-20 -bottom-10 h-32 w-32 rounded-full bg-blue-500/10 blur-xl">
                </div>

                <div class="relative flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <span class="text-xs font-extrabold uppercase tracking-widest text-[#C69A2E]">
                            {{ now()->translatedFormat('l, F j, Y') }}
                        </span>
                        <h1 class="mt-1 font-serif text-3xl font-extrabold tracking-tight sm:text-4xl">
                            Welcome back, {{ auth()->user()->name ?? 'Admin' }} 👋
                        </h1>
                        <p class="mt-1 text-base font-medium text-slate-300">
                            Here's today's snapshot of senior citizen records.
                        </p>
                    </div>

                    <!-- Stats Counter Grid -->
                    <div class="grid grid-cols-3 gap-3">
                        @foreach([['Total', $total], ['Male', $male], ['Female', $female]] as [$label, $val])
                            <div
                                class="min-w-[95px] rounded-xl border border-white/15 bg-white/10 px-4 py-3 text-center backdrop-blur-md shadow-inner">
                                <p class="text-2xl font-extrabold text-white">{{ $val }}</p>
                                <p class="text-[11px] font-bold uppercase tracking-wider text-slate-200">{{ $label }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- RECORDS CARD -->
            <div class="rounded-2xl border border-slate-200 bg-white shadow-md overflow-hidden">

                <!-- TOOLBAR -->
                <div
                    class="flex flex-col gap-4 border-b border-slate-200 bg-white p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
                    <div>
                        <h2 class="font-serif text-2xl font-extrabold text-slate-900 sm:text-3xl tracking-tight">Recent
                            Senior Citizen Records</h2>
                        <p class="mt-0.5 text-base font-medium text-slate-500">Showing the 5 most recently added records
                        </p>
                    </div>

                    <a href="{{ route('seniors.senior-records') }}"
                        class="inline-flex items-center justify-center gap-2 rounded-xl border-2 border-[#14294D] bg-white px-5 py-2.5 text-base font-bold text-[#14294D] shadow-xs transition hover:bg-[#14294D] hover:text-white shrink-0">
                        <i class="fa-solid fa-list-check text-sm"></i>
                        <span>View All Records</span>
                    </a>
                </div>

                @if($seniors->isEmpty())
                    <!-- UNIFIED EMPTY STATE -->
                    <div class="flex flex-col items-center justify-center p-14 text-center">
                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400 border border-slate-200">
                            <i class="fa-solid fa-folder-open text-2xl"></i>
                        </div>
                        <p class="mt-4 text-lg font-bold text-slate-800">No senior citizen records found</p>
                        <p class="mt-1 text-sm text-slate-500 max-w-xs">There are no recent entries to display at the
                            moment.</p>
                    </div>
                @else
                    <!-- DESKTOP TABLE (md and up) -->
                    <div class="hidden overflow-x-auto md:block">
                        <table class="w-full text-left border-collapse">
                            <!-- High Contrast Header -->
                            <thead
                                class="border-b border-slate-200 bg-slate-100/90 text-sm font-bold uppercase tracking-wider text-slate-700 select-none">
                                <tr>
                                    <th class="px-6 py-4.5 text-sm"><i
                                            class="fa-solid fa-hashtag mr-1.5 text-slate-500 text-sm"></i> Senior ID</th>
                                    <th class="px-6 py-4.5 text-sm"><i
                                            class="fa-solid fa-user mr-1.5 text-slate-500 text-sm"></i> Full Name</th>
                                    <th class="px-6 py-4.5 text-center text-sm"><i
                                            class="fa-solid fa-cake-candles mr-1.5 text-slate-500 text-sm"></i> Age</th>
                                    <th class="px-6 py-4.5 text-sm"><i
                                            class="fa-solid fa-venus-mars mr-1.5 text-slate-500 text-sm"></i> Sex</th>
                                    <th class="px-6 py-4.5 text-sm"><i
                                            class="fa-solid fa-location-dot mr-1.5 text-slate-500 text-sm"></i> Barangay
                                    </th>
                                    <th class="px-6 py-4.5 text-right text-sm">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 text-slate-800">
                                @foreach ($seniors as $senior)
                                    @php $isMale = strtolower($senior->sex) === 'male'; @endphp
                                    <tr class="transition-colors hover:bg-amber-50/40">

                                        <!-- Senior ID Badge (Enlarged) -->
                                        <td class="px-6 py-4.5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-1.5 font-mono text-base font-bold text-slate-800 bg-slate-100 px-3.5 py-2 rounded-lg border border-slate-300 shadow-2xs">
                                                <i class="fa-solid fa-hashtag text-xs text-slate-400"></i>
                                                {{ $senior->senior_id }}
                                            </span>
                                        </td>

                                        <!-- Full Name with Avatar -->
                                        <td class="px-6 py-4.5 whitespace-nowrap">
                                            <div class="flex items-center gap-3.5">
                                                <div
                                                    class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#14294D] text-sm font-extrabold text-[#C69A2E] shadow-xs">
                                                    {{ substr($senior->first_name, 0, 1) }}{{ substr($senior->last_name, 0, 1) }}
                                                </div>
                                                <span class="font-bold uppercase text-slate-900 text-lg tracking-wide">
                                                    {{ $senior->first_name }} {{ $senior->middle_name }}
                                                    {{ $senior->last_name }}
                                                </span>
                                            </div>
                                        </td>

                                        <!-- Age -->
                                        <td class="px-6 py-4.5 text-center whitespace-nowrap">
                                            <span class="text-xl font-bold text-slate-900">{{ $senior->age }}</span>
                                            <span class="text-sm font-medium text-slate-500"> yrs</span>
                                        </td>

                                        <!-- Sex Badge -->
                                        <td class="px-6 py-4.5 whitespace-nowrap">
                                            <span
                                                class="inline-flex items-center gap-1.5 rounded-full px-3.5 py-1.5 text-sm font-bold uppercase tracking-wider {{ $isMale ? 'bg-blue-100 text-blue-800 border border-blue-200' : 'bg-pink-100 text-pink-800 border border-pink-200' }}">
                                                <i
                                                    class="fa-solid {{ $isMale ? 'fa-mars text-blue-600 text-sm' : 'fa-venus text-pink-600 text-sm' }}"></i>
                                                {{ $senior->sex }}
                                            </span>
                                        </td>

                                        <!-- Barangay -->
                                        <td class="px-6 py-4.5 whitespace-nowrap text-lg font-semibold text-slate-700">
                                            {{ $senior->barangay }}
                                        </td>

                                        <!-- High Vis Actions -->
                                        <td class="px-6 py-4.5 text-right whitespace-nowrap">
                                            <div class="flex justify-end gap-2">
                                                <!-- View Button -->
                                                <a href="{{ route('seniors.show', $senior->senior_id) }}"
                                                    onclick="showFetchingOverlay('Please wait, data is fetching...')"
                                                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-slate-100 text-slate-600 transition-all duration-150 hover:border-[#14294D] hover:bg-[#14294D] hover:text-white hover:shadow-sm"
                                                    title="View Profile">
                                                    <i class="fa-solid fa-eye text-base"></i>
                                                </a>

                                                <!-- Edit Button -->
                                                <!-- <a href="{{ route('seniors.edit', $senior->senior_id) }}"
                                                                                                    class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-slate-100 text-slate-600 transition-all duration-150 hover:border-[#C69A2E] hover:bg-[#C69A2E] hover:text-white hover:shadow-sm"
                                                                                                    title="Edit Record">
                                                                                                    <i class="fa-solid fa-pen-to-square text-base"></i>
                                                                                                </a> -->

                                                <!-- Delete Button -->
                                                <button type="button"
                                                    onclick="openDeleteModal('{{ route('seniors.destroy', $senior->senior_id) }}')"
                                                    class="{{ $btnAction }} h-8 w-8 text-xs hover:bg-red-600 hover:text-white"
                                                    title="Delete">
                                                    <i class="fa-solid fa-trash-can"></i>
                                                </button>
                                            </div>
                                        </td>

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- MOBILE CARD LIST (below md) -->
                    <div class="divide-y divide-slate-200 md:hidden">
                        @foreach ($seniors as $senior)
                            @php $isMale = strtolower($senior->sex) === 'male'; @endphp
                            <div class="flex flex-col gap-3.5 p-4 bg-white hover:bg-slate-50/50">

                                <div class="flex items-start justify-between gap-3">
                                    <div class="flex items-center gap-3 min-w-0">
                                        <div
                                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#14294D] text-xs font-extrabold text-[#C69A2E]">
                                            {{ substr($senior->first_name, 0, 1) }}{{ substr($senior->last_name, 0, 1) }}
                                        </div>
                                        <div class="min-w-0">
                                            <h3 class="truncate font-bold uppercase text-slate-900 text-base tracking-wide">
                                                {{ $senior->first_name }} {{ $senior->last_name }}
                                            </h3>
                                            <span
                                                class="inline-block font-mono text-xs font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded border border-slate-200 mt-0.5">
                                                #{{ $senior->senior_id }}
                                            </span>
                                        </div>
                                    </div>

                                    <!-- Actions -->
                                    <div class="flex items-center shrink-0 gap-1">
                                        <a href="{{ route('seniors.show', $senior->senior_id) }}"
                                            onclick="showFetchingOverlay('Please wait, data is fetching...')"
                                            class="{{ $btnAction }} h-8 w-8 text-xs hover:bg-[#14294D] hover:text-white"
                                            title="View"><i class="fa-solid fa-eye"></i></a>
                                        <!-- <a href="{{ route('seniors.edit', $senior->senior_id) }}"
                                                                                    class="{{ $btnAction }} h-8 w-8 text-xs hover:bg-[#C69A2E] hover:text-white"
                                                                                    title="Edit"><i class="fa-solid fa-pen-to-square"></i></a> -->
                                        <button type="button"
                                            onclick="openDeleteModal('{{ route('seniors.destroy', $senior->senior_id) }}')"
                                            class="{{ $btnAction }} h-8 w-8 text-xs hover:bg-red-600 hover:text-white"
                                            title="Delete">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </div>
                                </div>

                                <!-- Mobile Info Grid -->
                                <div
                                    class="grid grid-cols-4 gap-2 rounded-xl bg-slate-50 p-2.5 text-xs border border-slate-200/80">
                                    <div>
                                        <span class="block text-slate-400 font-bold uppercase text-[10px]">Age</span>
                                        <span class="font-bold text-slate-900 text-xs">{{ $senior->age }} yrs</span>
                                    </div>
                                    <div>
                                        <span class="block text-slate-400 font-bold uppercase text-[10px]">Sex</span>
                                        <span
                                            class="font-bold text-xs {{ $isMale ? 'text-blue-700' : 'text-pink-700' }}">{{ $senior->sex }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-slate-400 font-bold uppercase text-[10px]">Size</span>
                                        <span
                                            class="font-mono font-bold text-slate-800 text-xs uppercase">{{ $senior->size ?? $senior->shirt_size ?? 'N/A' }}</span>
                                    </div>
                                    <div>
                                        <span class="block text-slate-400 font-bold uppercase text-[10px]">Barangay</span>
                                        <span
                                            class="font-bold text-slate-800 text-xs truncate block">{{ $senior->barangay }}</span>
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </main>

    </div>

    <x-developer-modal />
    <!-- Include your Delete Modal Component Here -->
    @include('components.confirm-delete-modal')
</body>

</html>