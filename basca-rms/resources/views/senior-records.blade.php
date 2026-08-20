<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <x-browse-top />
    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/senior-record.js'])
    <title>BASCA-RMS - Senior Citizen Directory</title>
</head>

<body class="bg-slate-100 text-slate-800 antialiased font-sans">
    <div class="flex min-h-screen">
        <x-sidebar />
        <x-page-loader />
        <x-fetching-overlay />
        <main id="main-content" class="w-full flex-1 space-y-6 p-4 pt-24 sm:p-6 lg:ml-[360px] lg:p-8">

            @php
                $btnAction = "inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-600 transition-all hover:scale-105 active:scale-95 text-base shadow-xs";
            @endphp

            <!-- CONTAINER CARD -->
            <div class="rounded-2xl border border-slate-200 bg-white shadow-md overflow-hidden">

                <!-- TOOLBAR -->
                <div
                    class="flex flex-col gap-4 border-b border-slate-200 bg-white p-6 sm:p-8 lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h1 class="font-serif text-3xl font-extrabold text-slate-900 sm:text-4xl tracking-tight">
                            Senior Citizen Records
                        </h1>
                        <p class="mt-1 text-base font-medium text-slate-500">
                            Manage, filter, and review registered senior citizen profiles
                        </p>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center">
                        <div class="relative w-full sm:w-96">
                            <i
                                class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-xl text-slate-400"></i>
                            <input type="text" id="client-search" placeholder="Search by name, ID, or RRN..."
                                class="w-full rounded-xl border border-slate-300 bg-slate-50 pl-12 pr-4 py-3.5 text-lg text-slate-900 font-medium placeholder:text-slate-400 focus:border-[#14294D] focus:bg-white focus:ring-2 focus:ring-[#14294D]/20 focus:outline-none transition-all shadow-inner" />
                        </div>

                        <a href="{{ route('seniors.create') }}"
                            class="inline-flex items-center gap-2.5 rounded-xl bg-[#14294D] px-6 py-3.5 text-lg font-bold text-white transition hover:bg-[#1b345f] shadow-sm">
                            <i class="fa-solid fa-user-plus text-lg"></i> Add Senior Citizen
                        </a>
                    </div>
                </div>

                @if($seniors->isEmpty())
                    <div class="flex flex-col items-center justify-center p-16 text-center">
                        <div
                            class="flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-slate-400 border border-slate-200">
                            <i class="fa-solid fa-folder-open text-3xl"></i>
                        </div>
                        <p class="mt-4 text-xl font-bold text-slate-800">No senior citizen records found</p>
                        <p class="mt-1 text-base text-slate-500 max-w-sm">Register a new senior record to get started.</p>
                    </div>
                @else
                    <div id="no-match-message" class="hidden flex-col items-center justify-center px-4 py-16 text-center">
                        <div
                            class="flex h-20 w-20 items-center justify-center rounded-full bg-slate-100 text-slate-500 ring-8 ring-slate-50 border border-slate-200/80 shadow-xs">
                            <i class="fa-solid fa-magnifying-glass text-3xl"></i>
                        </div>
                        <h3 class="mt-5 text-2xl font-bold tracking-tight text-slate-900">No matching records found</h3>
                        <p class="mt-2 max-w-sm text-base leading-relaxed text-slate-500">Try searching with a different
                            name, ID, or RRN.</p>
                    </div>

                    <div id="records-container">
                        <!-- DESKTOP TABLE -->
                        <div class="hidden overflow-x-auto md:block">
                            <table class="w-full text-left border-collapse" id="desktop-table">
                                <thead
                                    class="border-b border-slate-200 bg-slate-100/90 text-sm font-bold uppercase tracking-wider text-slate-700 select-none">
                                    <tr>
                                        <th class="px-6 py-4.5 text-sm"><i
                                                class="fa-solid fa-hashtag mr-1.5 text-slate-500 text-sm"></i> Senior ID
                                        </th>
                                        <th class="px-6 py-4.5 text-sm"><i
                                                class="fa-solid fa-user mr-1.5 text-slate-500 text-sm"></i> Full Name</th>
                                        <th class="px-6 py-4.5 text-center text-sm"><i
                                                class="fa-solid fa-cake-candles mr-1.5 text-slate-500 text-sm"></i> Age</th>
                                        <th class="px-6 py-4.5 text-sm"><i
                                                class="fa-solid fa-venus-mars mr-1.5 text-slate-500 text-sm"></i> Sex</th>
                                        <th class="px-6 py-4.5 text-sm"><i
                                                class="fa-solid fa-id-card mr-1.5 text-slate-500 text-sm"></i> RRN</th>
                                        <th class="px-6 py-4.5 text-sm"><i
                                                class="fa-solid fa-location-dot mr-1.5 text-slate-500 text-sm"></i> Barangay
                                        </th>
                                        <th class="px-6 py-4.5 text-right text-sm">Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 text-slate-800">
                                    @foreach ($seniors as $senior)
                                        @php $isMale = strtolower($senior->sex) === 'male'; @endphp
                                        <tr class="senior-item transition-colors hover:bg-amber-50/40">
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center gap-1.5 font-mono text-base font-bold text-slate-800 bg-slate-100 px-3.5 py-2 rounded-lg border border-slate-300 shadow-2xs">
                                                    <i
                                                        class="fa-solid fa-hashtag text-xs text-slate-400"></i>{{ $senior->senior_id }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <div class="flex items-center gap-4">
                                                    <div
                                                        class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-[#14294D] text-sm font-extrabold text-[#C69A2E] shadow-xs">
                                                        {{ substr($senior->first_name, 0, 1) }}{{ substr($senior->last_name, 0, 1) }}
                                                    </div>
                                                    <div class="flex flex-col">
                                                        <span
                                                            class="font-bold uppercase text-slate-900 text-lg tracking-wide searchable-name">
                                                            {{ $senior->first_name }} {{ $senior->middle_name }}
                                                            {{ $senior->last_name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-5 text-center whitespace-nowrap">
                                                <span class="text-xl font-bold text-slate-900">{{ $senior->age }}</span><span
                                                    class="text-sm font-medium text-slate-500"> yrs</span>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <span
                                                    class="inline-flex items-center gap-1.5 rounded-full px-3.5 py-1.5 text-sm font-bold uppercase tracking-wider {{ $isMale ? 'bg-blue-100 text-blue-800 border border-blue-200' : 'bg-pink-100 text-pink-800 border border-pink-200' }}">
                                                    <i
                                                        class="fa-solid {{ $isMale ? 'fa-mars text-blue-600' : 'fa-venus text-pink-600' }} text-sm"></i>{{ $senior->sex }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap">
                                                <span
                                                    class="font-mono font-semibold {{ $senior->rrn ? 'text-slate-800' : 'text-slate-400' }} text-base searchable-rrn">{{ $senior->rrn ?? 'N/A' }}</span>
                                            </td>
                                            <td class="px-6 py-5 whitespace-nowrap text-lg font-semibold text-slate-700">
                                                {{ $senior->barangay }}
                                            </td>
                                            <td class="px-6 py-5 text-right whitespace-nowrap">
                                                <div class="flex justify-end gap-2">
                                                    <a href="{{ route('seniors.show', $senior->senior_id) }}"
                                                        onclick="showFetchingOverlay('Please wait, data is fetching...')"
                                                        class="inline-flex h-10 w-10 items-center justify-center rounded-lg border border-slate-200 bg-slate-100 text-slate-600 transition-all hover:border-[#14294D] hover:bg-[#14294D] hover:text-white hover:shadow-sm"
                                                        title="View Profile">
                                                        <i class="fa-solid fa-eye text-base"></i>
                                                    </a>

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

                        <!-- MOBILE CARD LIST (below md) - UPDATED TO USE MODAL -->
                        <div class="divide-y divide-slate-200 md:hidden" id="mobile-list">
                            @foreach ($seniors as $senior)
                                @php $isMale = strtolower($senior->sex) === 'male'; @endphp
                                <div class="senior-item flex flex-col gap-4 p-5 bg-white hover:bg-slate-50/50">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="flex items-center gap-3.5 min-w-0">
                                            <div
                                                class="flex h-12 w-12 shrink-0 items-center justify-center rounded-full bg-[#14294D] text-sm font-extrabold text-[#C69A2E]">
                                                {{ substr($senior->first_name, 0, 1) }}{{ substr($senior->last_name, 0, 1) }}
                                            </div>
                                            <div class="min-w-0">
                                                <h3
                                                    class="truncate font-bold uppercase text-slate-900 text-base tracking-wide searchable-name">
                                                    {{ $senior->first_name }} {{ $senior->last_name }}
                                                </h3>
                                                <div class="flex items-center gap-2 mt-0.5">
                                                    <span
                                                        class="font-mono text-xs font-bold text-slate-600 bg-slate-100 px-2 py-0.5 rounded">#{{ $senior->senior_id }}</span>
                                                    <span
                                                        class="inline-flex items-center gap-1 rounded-full px-2 py-0.5 text-xs font-bold {{ $isMale ? 'bg-blue-100 text-blue-800' : 'bg-pink-100 text-pink-800' }}">{{ $senior->sex }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center shrink-0 gap-1.5">
                                            <a href="{{ route('seniors.show', $senior->senior_id) }}"
                                                onclick="showFetchingOverlay('Please wait, data is fetching...')"
                                                class="{{ $btnAction }} h-9 w-9 text-sm hover:bg-[#14294D] hover:text-white"><i
                                                    class="fa-solid fa-eye"></i></a>

                                            <!-- FIXED: Replaced standard form submit with openDeleteModal call -->
                                            <button type="button"
                                                onclick="openDeleteModal('{{ route('seniors.destroy', $senior->senior_id) }}')"
                                                class="{{ $btnAction }} h-9 w-9 text-sm hover:bg-red-600 hover:text-white"
                                                title="Delete">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div
                                        class="grid grid-cols-3 gap-2 rounded-xl bg-slate-50 p-3 text-xs font-medium border border-slate-200/80 text-slate-600">
                                        <div><span
                                                class="block text-slate-400 font-semibold uppercase text-[10px]">Age</span><span
                                                class="font-bold text-slate-900 text-sm">{{ $senior->age }} yrs</span></div>
                                        <div><span
                                                class="block text-slate-400 font-semibold uppercase text-[10px]">RRN</span><span
                                                class="font-mono font-bold {{ $senior->rrn ? 'text-slate-800' : 'text-slate-400' }} text-xs truncate block searchable-rrn">{{ $senior->rrn ?? 'N/A' }}</span>
                                        </div>
                                        <div><span
                                                class="block text-slate-400 font-semibold uppercase text-[10px]">Barangay</span><span
                                                class="font-bold text-slate-800 text-xs truncate block">{{ $senior->barangay }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- JS PAGINATION CONTAINER -->
                    <div id="js-pagination"
                        class="border-t border-slate-200 bg-slate-50 px-6 py-4 sm:px-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                    </div>
                @endif
            </div>
        </main>
    </div>
    <!-- Include your Delete Modal Component Here -->
    @include('components.confirm-delete-modal')

</body>

</html>