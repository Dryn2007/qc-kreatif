<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QC Creative Board - LokaVira</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Custom scrollbar for dark theme */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #0f172a;
        }

        ::-webkit-scrollbar-thumb {
            background: #334155;
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #475569;
        }

        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        .gradient-text {
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }
    </style>
</head>

<body
    class="bg-slate-950 text-slate-300 antialiased font-sans min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-slate-900 via-[#0f172a] to-black selection:bg-indigo-500/30">

    <!-- Top Navigation / Header area -->
    <div class="max-w-[1600px] mx-auto p-4 sm:p-6 lg:p-8">

        <!-- Header Card -->
        <div class="glass-card p-6 md:p-8 rounded-3xl shadow-2xl mb-8 relative overflow-hidden">
            <!-- Decorative blur blobs -->
            <div
                class="absolute -top-24 -right-24 w-96 h-96 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none">
            </div>
            <div
                class="absolute -bottom-24 -left-24 w-96 h-96 bg-fuchsia-600/20 rounded-full blur-3xl pointer-events-none">
            </div>

            <div class="relative z-10 flex flex-col md:flex-row items-center md:items-start gap-8">

                <!-- Avatar / Logo -->
                <div class="flex-shrink-0 relative group">
                    <div
                        class="absolute inset-0 bg-gradient-to-r from-indigo-500 to-fuchsia-500 rounded-full blur opacity-40 group-hover:opacity-75 transition duration-500">
                    </div>
                    <img src="{{ asset('images/team.jpg') }}"
                        onerror="this.src='https://ui-avatars.com/api/?name=QC+Team&background=6366f1&color=fff&size=200'"
                        alt="Creative Team LokaVira"
                        class="relative w-36 h-36 md:w-44 md:h-44 rounded-full object-cover border-4 border-slate-800 shadow-2xl mx-auto z-10">
                    <div
                        class="absolute bottom-2 right-2 bg-gradient-to-r from-emerald-500 to-teal-400 text-white p-2.5 rounded-full shadow-lg border-2 border-slate-900 z-20">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                </div>

                <!-- Info & Actions -->
                <div class="flex-grow flex flex-col gap-6 w-full mt-2">
                    <div
                        class="flex flex-col xl:flex-row justify-between items-center xl:items-start gap-6 border-b border-slate-800/60 pb-6">
                        <div class="text-center xl:text-left">
                            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight text-white mb-2">
                                Board <span
                                    class="bg-gradient-to-r from-indigo-400 to-fuchsia-400 gradient-text">Creative
                                    QC</span>
                            </h1>
                            <p
                                class="text-slate-400 text-sm md:text-base font-medium flex items-center justify-center xl:justify-start gap-2">
                                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                                Real-time Quality Control System
                            </p>
                        </div>

                        <div class="flex flex-wrap justify-center xl:justify-end gap-3 flex-shrink-0">
                            <button onclick="copyLaporanFull()"
                                class="group relative px-4 py-2.5 bg-slate-800 hover:bg-slate-700 text-slate-200 rounded-xl font-semibold shadow-lg transition-all duration-300 text-xs sm:text-sm flex items-center gap-2 border border-slate-700 hover:border-indigo-500/50">
                                <span class="text-lg">📋</span> Copy WA
                            </button>
                            <button onclick="showCreateModal()"
                                class="group relative px-4 py-2.5 bg-gradient-to-r from-indigo-600 to-violet-600 hover:from-indigo-500 hover:to-violet-500 text-white rounded-xl font-semibold shadow-[0_0_20px_rgba(79,70,229,0.3)] transition-all duration-300 text-xs sm:text-sm flex items-center gap-2 border border-indigo-400/20 hover:scale-105">
                                <span class="text-lg">✨</span> + Jadwal
                            </button>
                            <a href="{{ route('export.excel') }}"
                                class="group relative px-4 py-2.5 bg-indigo-900/30 hover:bg-indigo-800/40 text-indigo-300 rounded-xl font-semibold shadow-lg transition-all duration-300 text-xs sm:text-sm flex items-center gap-2 border border-indigo-500/20 hover:border-indigo-400/50">
                                <span class="text-lg">📊</span> Excel
                            </a>
                            <a href="{{ route('export.pdf') }}"
                                class="group relative px-4 py-2.5 bg-fuchsia-900/30 hover:bg-fuchsia-800/40 text-fuchsia-300 rounded-xl font-semibold shadow-lg transition-all duration-300 text-xs sm:text-sm flex items-center gap-2 border border-fuchsia-500/20 hover:border-fuchsia-400/50">
                                <span class="text-lg">📄</span> PDF
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Kanban Board: Minimalist Clients Only -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 pb-8">
            @php
                $all_clients = ['BIG', 'HH', 'HFC', 'Lokavira'];
            @endphp
            @foreach($all_clients as $klien)
                @php
                    $items_klien = isset($contents[$klien]) ? $contents[$klien] : collect([]);
                @endphp
                <div onclick="openClientModal('{{ $klien }}')"
                    class="glass-card rounded-3xl p-6 sm:p-8 flex flex-col justify-center items-center cursor-pointer hover:-translate-y-2 transition-transform duration-300 border border-slate-700/50 hover:border-indigo-500/50 shadow-2xl relative overflow-hidden group">
                    <div
                        class="absolute -top-4 -left-4 w-32 h-32 bg-indigo-600/10 rounded-full blur-3xl group-hover:bg-indigo-500/20 transition-all">
                    </div>
                    <span
                        class="text-5xl mb-5 shadow-[0_0_20px_rgba(99,102,241,0.3)] bg-slate-800 border border-indigo-500/30 rounded-2xl w-20 h-20 flex items-center justify-center group-hover:rotate-12 transition-transform">🚀</span>
                    <h2 class="text-3xl font-extrabold text-white tracking-widest text-center uppercase">{{ $klien }}</h2>
                    <span
                        class="mt-4 bg-slate-900/80 text-sm font-bold text-slate-300 px-4 py-2 rounded-xl border border-slate-700/50 shadow-inner">
                        Total: {{ count($items_klien) }} Task
                    </span>
                </div>
            @endforeach
        </div>

        <!-- Hidden Data Container for Modals & Copy -->
        <div id="all-data-container" class="hidden">
            @foreach($contents as $klien => $items_klien)
                <div class="klien-data-block" data-klien="{{ $klien }}">
                    @php $grouped_minggu = $items_klien->groupBy('minggu'); @endphp
                    @foreach($grouped_minggu as $minggu_name => $items_minggu)
                        <div id="data-{{ Str::slug($klien) }}-{{ Str::slug($minggu_name) }}" class="minggu-data-block"
                            data-minggu="{{ $minggu_name }}">
                            @foreach($items_minggu as $item)
                                @php
                                    $colorOpts = [
                                        'kosong' => 'bg-slate-800 text-slate-400 border-slate-700 focus:ring-slate-500',
                                        'take' => 'bg-violet-900/30 text-violet-300 border-violet-700/50 focus:ring-violet-500',
                                        'edit' => 'bg-amber-900/30 text-amber-300 border-amber-700/50 focus:ring-amber-500',
                                        'acc' => 'bg-blue-900/30 text-blue-300 border-blue-700/50 focus:ring-blue-500',
                                        'upload' => 'bg-emerald-900/30 text-emerald-300 border-emerald-700/50 focus:ring-emerald-500'
                                    ];
                                    $selectColor = $colorOpts[$item->status] ?? $colorOpts['kosong'];
                                    $cardGlow = '';
                                    if ($item->status == 'upload')
                                        $cardGlow = 'hover:border-emerald-500/40 hover:shadow-[0_0_15px_rgba(16,185,129,0.15)] glow-emerald';
                                    elseif ($item->status == 'acc')
                                        $cardGlow = 'hover:border-blue-500/40 hover:shadow-[0_0_15px_rgba(59,130,246,0.15)]';
                                    elseif ($item->status == 'edit')
                                        $cardGlow = 'hover:border-amber-500/40 hover:shadow-[0_0_15px_rgba(245,158,11,0.15)]';
                                    elseif ($item->status == 'take')
                                        $cardGlow = 'hover:border-violet-500/40 hover:shadow-[0_0_15px_rgba(139,92,246,0.15)]';
                                    else
                                        $cardGlow = 'hover:border-indigo-500/30 hover:shadow-[0_0_15px_rgba(99,102,241,0.1)]';
                                @endphp

                                <div class="bg-slate-800/60 p-4 rounded-xl border border-slate-700/60 transition-all duration-300 cursor-pointer group {{ $cardGlow }} relative overflow-hidden"
                                    onclick="openModal(this)" data-id="{{ $item->id }}" data-klien="{{ $item->klien }}"
                                    data-pilar="{{ $item->pilar_konten }}" data-script="{{ $item->script_video }}"
                                    data-caption="{{ $item->caption }}" data-linkref="{{ $item->link_referensi }}"
                                    data-linkdrive="{{ $item->link_gdrive }}">
                                    <!-- Ribbon Hari -->
                                    <div
                                        class="absolute top-0 left-0 w-1 h-full bg-slate-700 group-hover:bg-indigo-500 transition-colors">
                                    </div>

                                    <div class="flex justify-between items-center mb-3">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-300 text-sm tracking-wide">{{ $item->hari }}</span>
                                            @if($item->tanggal)
                                                <span class="text-[10px] text-slate-500 tracking-wider">
                                                    {{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}
                                                </span>
                                            @endif
                                        </div>

                                        <form action="{{ route('update.status', $item->id) }}" method="POST"
                                            onclick="event.stopPropagation()">
                                            @csrf @method('PUT')
                                            <select name="status" onchange="this.form.submit()"
                                                class="text-[10px] sm:text-xs px-2 py-1 rounded-md font-bold cursor-pointer outline-none border {{ $selectColor }} appearance-none text-center">
                                                <option value="kosong" {{ $item->status == 'kosong' ? 'selected' : '' }}>⏳ KOSONG
                                                </option>
                                                <option value="take" {{ $item->status == 'take' ? 'selected' : '' }}>🎥 TAKE</option>
                                                <option value="edit" {{ $item->status == 'edit' ? 'selected' : '' }}>✂️ EDIT</option>
                                                <option value="acc" {{ $item->status == 'acc' ? 'selected' : '' }}>⭐ ACC</option>
                                                <option value="upload" {{ $item->status == 'upload' ? 'selected' : '' }}>🚀 UPLOAD
                                                </option>
                                            </select>
                                        </form>
                                    </div>

                                    <div class="bg-slate-900/50 p-2.5 rounded-lg border border-slate-800/80">
                                        <p class="text-xs sm:text-sm text-slate-300 font-medium truncate">
                                            <span class="text-indigo-400 mr-1 font-bold">#</span>{{ $item->pilar_konten }}
                                        </p>
                                    </div>

                                    <div
                                        class="mt-3 flex justify-between items-center opacity-70 group-hover:opacity-100 transition-opacity">
                                        <div class="flex gap-2">
                                            @if($item->script_video)<span title="Script" class="text-xs">📄</span>@endif
                                            @if($item->caption)<span title="Caption" class="text-xs">💬</span>@endif
                                            @if($item->link_referensi)<span title="Referensi" class="text-xs">🔗</span>@endif
                                            @if($item->link_gdrive)<span title="Drive" class="text-xs">📁</span>@endif
                                        </div>
                                        <span
                                            class="text-[10px] text-fuchsia-400 font-bold bg-fuchsia-500/10 px-2 py-1 rounded-md border border-fuchsia-500/20">Edit
                                            Detail ↗</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>

        <!-- Footer Danger Zone -->
        <div class="mt-8 text-center pb-8">
            <form action="{{ route('jadwal.delete_all') }}" method="POST"
                onsubmit="return confirm('HATI-HATI! Yakin hapus SEMUA data secara permanen?')">
                @csrf @method('DELETE')
                <button type="submit"
                    class="text-slate-500 hover:text-red-400 text-xs font-bold transition-colors border border-transparent hover:border-red-500/30 hover:bg-red-500/10 px-4 py-2 rounded-lg">
                    ⚠️ Hapus Semua Data & Reset Board
                </button>
            </form>
        </div>
    </div>

    <!-- Glass Modal -->
    <x-create-modal />

    <!-- Explorer / Client Modal -->
    <div id="explorerModal"
        class="fixed inset-0 bg-slate-950/80 backdrop-blur-md z-40 invisible opacity-0 transition-all duration-300 flex items-center justify-center p-4">
        <div class="bg-slate-900 rounded-3xl shadow-[0_0_50px_rgba(0,0,0,0.5)] border border-slate-700 w-full max-w-4xl max-h-[90vh] overflow-y-auto relative transform scale-95 transition-transform duration-300"
            id="explorerModalContent">

            <div
                class="border-b border-slate-800 p-6 flex justify-between items-center sticky top-0 bg-slate-900/90 backdrop-blur-md z-10">
                <div>
                    <h2 class="text-2xl font-extrabold text-white">Client: <span
                            class="bg-gradient-to-r from-indigo-400 to-fuchsia-400 bg-clip-text text-transparent"
                            id="viewModalClientName"></span></h2>
                </div>
                <button onclick="closeClientModal()"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-800 text-slate-400 hover:text-white hover:bg-slate-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="p-6">
                <!-- Step 1: Choose Week -->
                <div id="step-choose-week">
                    <p class="text-slate-400 mb-6 font-bold text-sm uppercase flex items-center gap-2"><span
                            class="w-2 h-2 rounded-full bg-fuchsia-500"></span> Pilih Minggu Laporan</p>
                    <div class="grid grid-cols-2 sm:grid-cols-3 gap-4">
                        @foreach(['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4', 'Minggu 5'] as $m)
                            <button onclick="selectWeek('{{ $m }}')"
                                class="p-6 bg-slate-800/60 hover:bg-indigo-600/30 rounded-2xl border border-slate-700 hover:border-indigo-500/50 text-white font-extrabold text-lg transition-all group relative overflow-hidden flex flex-col items-center justify-center text-center">
                                {{ $m }}
                                <div class="text-xs text-slate-400 mt-2 group-hover:text-indigo-300 font-normal">Buka
                                    Laporan &rarr;</div>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Step 2: Show Tasks -->
                <div id="step-tasks" class="hidden">
                    <div class="flex justify-between items-center mb-6 border-b border-slate-800 pb-4">
                        <button onclick="backToWeeks()"
                            class="text-slate-400 hover:text-white flex items-center gap-2 font-bold bg-slate-800 hover:bg-slate-700 px-4 py-2 rounded-xl transition text-sm">
                            &larr; Kembali
                        </button>
                        <h3 class="text-xl font-bold text-white"><span id="lblWeekName"></span></h3>
                        <button onclick="openCreateForCurrent()"
                            class="bg-indigo-600 hover:bg-indigo-500 text-white px-4 py-2 rounded-xl font-bold transition flex items-center gap-2 shadow-lg text-sm">
                            + Target Baru
                        </button>
                    </div>

                    <div id="task-container" class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <!-- dynamically populated by JS -->
                    </div>
                    <div id="task-empty-state"
                        class="hidden text-center py-12 bg-slate-800/30 rounded-2xl border border-dashed border-slate-700">
                        <span class="text-4xl">✨</span>
                        <p class="text-slate-400 mt-3 font-semibold">Belum ada target di minggu ini.</p>
                        <p class="text-slate-500 text-sm">Klik + Target Baru untuk membuat jadwal.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Detail Modal -->
    <div id="detailModal"
        class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 invisible opacity-0 transition-all duration-300 flex items-center justify-center p-4">
        <div class="bg-slate-900 rounded-3xl shadow-[0_0_50px_rgba(0,0,0,0.5)] border border-slate-700 w-full max-w-3xl max-h-[90vh] overflow-y-auto relative transform scale-95 transition-transform duration-300"
            id="modalContent">

            <div
                class="sticky top-0 bg-slate-900/90 backdrop-blur-md border-b border-slate-800 p-5 sm:p-6 flex justify-between items-center z-10">
                <div>
                    <h2 class="text-2xl font-extrabold text-white flex items-center gap-2">
                        <span id="modalKlien"
                            class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-fuchsia-400"></span>
                    </h2>
                    <p class="text-slate-400 text-sm font-medium mt-1">Pilar: <span id="modalPilar"
                            class="text-slate-300 font-bold"></span></p>
                </div>
                <button onclick="closeModal()"
                    class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-800 text-slate-400 hover:text-white hover:bg-slate-700 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <div class="p-5 sm:p-6 sm:px-8">
                <form id="formDetail" method="POST" class="space-y-5">
                    @csrf @method('PUT')

                    <div class="group">
                        <label class="block text-xs font-bold text-indigo-400 uppercase tracking-wider mb-2">📝 Script
                            Video / Voice Over</label>
                        <textarea id="modalScript" name="script_video" rows="4"
                            class="w-full bg-slate-800/50 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all placeholder-slate-600 resize-none"
                            placeholder="Ketik script di sini..."></textarea>
                    </div>

                    <div class="group">
                        <label class="block text-xs font-bold text-fuchsia-400 uppercase tracking-wider mb-2">#️⃣
                            Caption & Hashtag</label>
                        <textarea id="modalCaption" name="caption" rows="3"
                            class="w-full bg-slate-800/50 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all placeholder-slate-600 resize-none"
                            placeholder="Tulis caption dan hashtag di sini..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-blue-400 uppercase tracking-wider mb-2">🔗 Link
                                Tiktok/Reels</label>
                            <input type="url" id="modalLinkRef" name="link_referensi"
                                class="w-full bg-slate-800/50 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all placeholder-slate-600"
                                placeholder="https://...">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-emerald-400 uppercase tracking-wider mb-2">📁
                                Link GDrive</label>
                            <input type="url" id="modalLinkDrive" name="link_gdrive"
                                class="w-full bg-slate-800/50 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all placeholder-slate-600"
                                placeholder="https://drive.google.com/...">
                        </div>
                    </div>

                    <div class="pt-6 mt-4 border-t border-slate-800 flex justify-end gap-3">
                        <button type="button" onclick="closeModal()"
                            class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white rounded-xl font-bold transition">Batal</button>
                        <button type="submit"
                            class="px-8 py-2.5 bg-gradient-to-r from-indigo-600 to-fuchsia-600 hover:from-indigo-500 hover:to-fuchsia-500 text-white rounded-xl font-bold shadow-[0_0_20px_rgba(99,102,241,0.3)] transition transform hover:scale-105">Simpan
                            Data</button>
                    </div>
                </form>

                <div class="mt-8 relative">
                    <div class="absolute inset-0 flex items-center" aria-hidden="true">
                        <div class="w-full border-t border-red-900/30"></div>
                    </div>
                    <div class="relative flex justify-center"><span
                            class="px-3 bg-slate-900 text-xs text-red-500/50 font-bold uppercase">Danger Zone</span>
                    </div>
                </div>

                <form id="formHapus" method="POST" class="mt-6 flex justify-center"
                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini? Data hilang permanen.')">
                    @csrf @method('DELETE')
                    <button type="submit"
                        class="group flex items-center gap-2 text-red-400 hover:text-white hover:bg-red-600 border border-red-900/50 hover:border-red-600 px-5 py-2 rounded-xl text-sm font-bold transition-all">
                        <svg class="w-4 h-4 group-hover:animate-bounce" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                            </path>
                        </svg>
                        Hapus Jadwal Ini
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Session messages toast
        @if(session('success'))
            alert("{{ session('success') }}");
        @endif

        @if(session('error'))
            alert("{{ session('error') }}");
        @endif

        // EXPLORER MODAL LOGIC
        let currentExplorerClient = '';
        let currentExplorerWeek = '';

        function openClientModal(clientName) {
            currentExplorerClient = clientName;
            document.getElementById('viewModalClientName').innerText = clientName;
            backToWeeks(); // reset to step 1

            const modal = document.getElementById('explorerModal');
            const content = document.getElementById('explorerModalContent');
            modal.classList.remove('invisible');
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function closeClientModal() {
            const modal = document.getElementById('explorerModal');
            const content = document.getElementById('explorerModalContent');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('invisible');
                modal.style.display = 'none';
            }, 300);
        }

        function backToWeeks() {
            document.getElementById('step-choose-week').classList.remove('hidden');
            document.getElementById('step-tasks').classList.add('hidden');
        }

        function selectWeek(weekName) {
            currentExplorerWeek = weekName;
            document.getElementById('lblWeekName').innerText = weekName;

            const container = document.getElementById('task-container');
            const emptyState = document.getElementById('task-empty-state');
            container.innerHTML = '';

            // Format slug id (same as Blade Str::slug)
            const slugClient = currentExplorerClient.toLowerCase().replace(/ /g, '-');
            const slugWeek = weekName.toLowerCase().replace(/ /g, '-');
            const sourceId = `data-${slugClient}-${slugWeek}`;
            const sourceDiv = document.getElementById(sourceId);

            if (sourceDiv && sourceDiv.innerHTML.trim() !== '') {
                container.innerHTML = sourceDiv.innerHTML;
                emptyState.classList.add('hidden');
            } else {
                emptyState.classList.remove('hidden');
            }

            document.getElementById('step-choose-week').classList.add('hidden');
            document.getElementById('step-tasks').classList.remove('hidden');
        }

        function openCreateForCurrent() {
            closeClientModal();
            setTimeout(() => {
                showCreateModal(currentExplorerClient, currentExplorerWeek);
            }, 300);
        }

        function copyLaporanFull() {
            let laporan = "*LAPORAN QC CREATIVE* :\n\n";
            document.querySelectorAll('.klien-data-block').forEach(clientBlock => {
                let klien = clientBlock.getAttribute('data-klien');
                let weeks = clientBlock.querySelectorAll('.minggu-data-block');
                if (weeks.length === 0) return;

                laporan += `*${klien}* :\n`;

                weeks.forEach(week => {
                    let minggu = week.getAttribute('data-minggu');
                    laporan += `  _${minggu}_\n`;

                    let cards = week.querySelectorAll('.group');
                    cards.forEach(card => {
                        let hariEl = card.querySelector('.font-bold.text-slate-300');
                        let pilarEl = card.querySelector('p.truncate');
                        if (!hariEl || !pilarEl) return;

                        let hari = hariEl.innerText.trim();
                        let pilar = pilarEl.innerText.replace('#', '').trim();
                        let val = card.querySelector('select').value;

                        let emoji = "⏳";
                        if (val == 'upload') emoji = "🚀";
                        else if (val == 'acc') emoji = "⭐";
                        else if (val == 'edit') emoji = "✂️";
                        else if (val == 'take') emoji = "🎥";

                        laporan += `    - ${hari} : ${pilar} ${emoji}\n`;
                    });
                    laporan += `\n`;
                });
            });

            navigator.clipboard.writeText(laporan.trim()).then(() => {
                alert("Laporan berhasil disalin! Silakan paste di WA.");
            }).catch(() => {
                alert("Gagal menyalin, silakan coba lagi.");
            });
        }

        // ORIGINAL FUNCTIONS
        function showModal() {
            const modal = document.getElementById('detailModal');
            const content = document.getElementById('modalContent');
            modal.classList.remove('invisible');
            modal.style.display = 'flex';
            setTimeout(() => {
                modal.classList.remove('opacity-0');
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }, 10);
        }

        function hideModal() {
            const modal = document.getElementById('detailModal');
            const content = document.getElementById('modalContent');
            modal.classList.add('opacity-0');
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
            setTimeout(() => {
                modal.classList.add('invisible');
                modal.style.display = 'none';
            }, 300);
        }

        function openModal(element) {
            let id = element.getAttribute('data-id');

            document.getElementById('modalKlien').innerText = element.getAttribute('data-klien');
            document.getElementById('modalPilar').innerText = element.getAttribute('data-pilar');
            document.getElementById('modalScript').value = element.getAttribute('data-script') || '';
            document.getElementById('modalCaption').value = element.getAttribute('data-caption') || '';
            document.getElementById('modalLinkRef').value = element.getAttribute('data-linkref') || '';
            document.getElementById('modalLinkDrive').value = element.getAttribute('data-linkdrive') || '';

            document.getElementById('formDetail').action = `/update-detail/${id}`;
            document.getElementById('formHapus').action = `/hapus-jadwal/${id}`;

            showModal();
        }

        function closeModal() {
            hideModal();
        }
    </script>
</body>

</html>