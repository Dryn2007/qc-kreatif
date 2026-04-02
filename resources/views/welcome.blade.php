<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QC Creative Board - LokaVira</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased font-sans p-6">

    <div class="max-w-[1500px] mx-auto">

        <div class="bg-white p-6 md:p-8 rounded-3xl shadow-sm border border-gray-100 mb-8">
            <div class="flex flex-col md:flex-row items-center gap-8">

                <div class="flex-shrink-0 relative">
                    <img src="{{ asset('images/team.jpg') }}" alt="Creative Team LokaVira"
                        class="w-40 h-40 md:w-48 md:h-48 rounded-full object-cover border-8 border-white ring-4 ring-blue-100 shadow-2xl mx-auto">

                    <div
                        class="absolute bottom-2 right-2 bg-green-500 text-white p-3 rounded-full shadow-lg border-4 border-white">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                </div>

                <div class="flex-grow flex flex-col gap-6 w-full">

                    <div
                        class="flex flex-col sm:flex-row justify-between items-center gap-4 border-b border-gray-100 pb-5">
                        <div class="text-center sm:text-left">
                            <h1 class="text-4xl font-extrabold text-blue-950 tracking-tight">Board QC Creative</h1>
                            <p class="text-gray-500 mt-1">Real-time Quality Control Board • Creative Team</p>
                        </div>

                        <div class="flex gap-2 flex-shrink-0">
                            <button onclick="copyLaporan()"
                                class="bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-xl font-bold shadow flex items-center gap-2 transition text-sm">
                                📋 Copy Laporan WA
                            </button>
                            <a href="{{ route('jadwal.create') }}"
                                class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold shadow transition text-sm">
                                + Tambah Jadwal
                            </a>
                            <a href="{{ route('export.excel', ['minggu' => $minggu_aktif]) }}"
                                class="bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-xl font-bold shadow transition text-sm">
                                📥 Export Excel
                            </a>
                            <a href="{{ route('export.pdf', ['minggu' => $minggu_aktif]) }}"
                                class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-xl font-bold shadow transition text-sm">
                                📄 Export PDF
                            </a>
                        </div>
                    </div>

                    <div
                        class="bg-blue-50/50 p-4 rounded-xl border border-blue-100 text-sm text-blue-900 flex items-center gap-3">
                        <span class="text-2xl">💡</span>
                        <p>Pantau progres konten {{ $minggu_aktif }} hari ini. Pastikan semua pilar (BIG, HH, HFC,LV)
                            berstatus ✅ UPLOAD sebelum akhir hayat!</p>
                    </div>

                    <div class="flex gap-2.5 overflow-x-auto pb-1">
                        @foreach(['Minggu 1', 'Minggu 2', 'Minggu 3', 'Minggu 4'] as $m)
                            <a href="/?minggu={{ $m }}"
                                class="px-6 py-2.5 font-bold text-sm rounded-xl transition whitespace-nowrap {{ $minggu_aktif == $m ? 'bg-blue-600 text-white shadow' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                                {{ $m }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="flex overflow-x-auto gap-6 pb-6">
            @forelse($contents as $hari => $items)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 min-w-[320px] flex-shrink-0">
                    <h2
                        class="text-xl font-bold text-gray-800 border-b-2 border-blue-100 pb-3 mb-5 uppercase tracking-wide">
                        {{ $hari }}
                    </h2>

                    <div class="space-y-4">
                        @foreach($items as $item)
                            @php
                                $color = 'bg-gray-200 text-gray-700';
                                if ($item->status == 'upload')
                                    $color = 'bg-green-100 text-green-800';
                                elseif ($item->status == 'acc')
                                    $color = 'bg-blue-100 text-blue-800';
                                elseif ($item->status == 'edit')
                                    $color = 'bg-yellow-100 text-yellow-800';
                                elseif ($item->status == 'take')
                                    $color = 'bg-purple-100 text-purple-800';
                            @endphp


                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 hover:shadow-lg transition cursor-pointer"
                                onclick="openModal(this)" data-id="{{ $item->id }}" data-klien="{{ $item->klien }}"
                                data-pilar="{{ $item->pilar_konten }}" data-script="{{ $item->script_video }}"
                                data-caption="{{ $item->caption }}" data-linkref="{{ $item->link_referensi }}"
                                data-linkdrive="{{ $item->link_gdrive }}">

                                <div class="flex justify-between items-center mb-3">
                                    <span class="font-bold text-blue-900 text-lg tracking-tight">{{ $item->klien }}</span>

                                    <form action="{{ route('update.status', $item->id) }}" method="POST"
                                        onclick="event.stopPropagation()">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="this.form.submit()"
                                            class="text-[11px] px-3 py-1.5 rounded-lg font-bold cursor-pointer outline-none shadow-inner {{ $color }}">
                                            <option value="kosong" {{ $item->status == 'kosong' ? 'selected' : '' }}>⏳ KOSONG
                                            </option>
                                            <option value="take" {{ $item->status == 'take' ? 'selected' : '' }}>✔️ TAKE</option>
                                            <option value="edit" {{ $item->status == 'edit' ? 'selected' : '' }}>☑️ EDIT</option>
                                            <option value="acc" {{ $item->status == 'acc' ? 'selected' : '' }}>⁉️ ACC</option>
                                            <option value="upload" {{ $item->status == 'upload' ? 'selected' : '' }}>✅ UPLOAD
                                            </option>
                                        </select>
                                    </form>
                                </div>
                                <div class="flex flex-col gap-2">
                                    <p
                                        class="text-sm text-gray-600 font-medium bg-white p-2.5 rounded-lg border border-gray-100">
                                        {{ $item->pilar_konten }}
                                    </p>
                                    <div class="text-right">
                                        <span class="text-xs text-blue-500 font-bold bg-blue-50 px-2 py-1 rounded-md">✏️ Buka
                                            Detail</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div
                    class="w-full text-center py-24 bg-white rounded-2xl border-2 border-dashed border-gray-200 shadow-inner">
                    <span class="text-6xl mb-4 block">🗓️</span>
                    <p class="text-gray-400 font-medium">Belum ada jadwal untuk {{ $minggu_aktif }}.</p>
                    <p class="text-gray-400 text-sm">Klik + Tambah Jadwal untuk memulai.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-12 border-t border-gray-100 pt-6 text-center">
            <form action="{{ route('jadwal.delete_all') }}" method="POST"
                onsubmit="return confirm('Yakin hapus SEMUA data? Data tidak bisa kembali.')">
                @csrf
                @method('DELETE')
                <button type="submit"
                    class="text-red-400 hover:text-red-600 text-xs font-medium underline tracking-wide">
                    Hapus Semua Data & Reset Board
                </button>
            </form>
        </div>
    </div>

    <script>
        function copyLaporan() {
            let laporan = "*LAPORAN QC {{ strtoupper($minggu_aktif) }}* :\n\n";
            document.querySelectorAll('.flex-shrink-0').forEach(col => {
                let hari = col.querySelector('h2');
                if (!hari) return; // Skip if no cards
                hari = hari.innerText;
                laporan += `*${hari}* :\n`;

                col.querySelectorAll('.bg-gray-50').forEach(card => {
                    let klien = card.querySelector('.font-bold').innerText;
                    let pilar = card.querySelector('p').innerText;
                    let val = card.querySelector('select').value;

                    let emoji = "⏳";
                    if (val == 'upload') emoji = "✅";
                    else if (val == 'acc') emoji = "⁉️";
                    else if (val == 'edit') emoji = "☑️";
                    else if (val == 'take') emoji = "✔️";

                    laporan += `${klien} : ${pilar} ${emoji}\n`;
                });
                laporan += `\n`;
            });

            navigator.clipboard.writeText(laporan.trim()).then(() => {
                alert("Laporan {{ $minggu_aktif }} disalin ke clipboard!");
            });
        }
    </script>\

    <div id="detailModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-3xl max-h-[90vh] overflow-y-auto relative">

            <button onclick="closeModal()"
                class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-2xl font-bold">&times;</button>

            <div class="p-8">
                <h2 class="text-2xl font-bold text-blue-900 mb-1">Detail Konten: <span id="modalKlien"></span></h2>
                <p class="text-gray-500 mb-6 font-medium border-b pb-4">Pilar: <span id="modalPilar"></span></p>

                <form id="formDetail" method="POST" class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">📝 Script Video</label>
                        <textarea id="modalScript" name="script_video" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            placeholder="Ketik script / voice over di sini..."></textarea>
                    </div>

                    <div>
                        <div class="flex justify-between items-end mb-1">
                            <label class="block text-sm font-bold text-gray-700">#️⃣ Caption & Hashtag</label>
                        </div>
                        <textarea id="modalCaption" name="caption" rows="3"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                            placeholder="Tulis caption dan hashtag di sini..."></textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">🔗 Link Referensi
                                (TikTok/Reels)</label>
                            <input type="text" id="modalLinkRef" name="link_referensi"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                                placeholder="https://tiktok.com/...">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 mb-1">📁 Link Template / GDrive</label>
                            <input type="text" id="modalLinkDrive" name="link_gdrive"
                                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500"
                                placeholder="https://drive.google.com/...">
                        </div>
                    </div>

                    <div class="pt-6 flex justify-end gap-3">
                        <button type="button" onclick="closeModal()"
                            class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-5 py-2.5 rounded-xl font-bold transition">Batal</button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2.5 rounded-xl font-bold transition shadow-md">Simpan
                            Detail</button>
                    </div>
                </form>

                <form id="formHapus" method="POST" class="mt-8 pt-4 border-t border-red-100"
                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini? Data tidak bisa kembali.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="text-red-500 hover:text-red-700 hover:bg-red-50 text-sm font-bold px-4 py-2 rounded-lg transition flex items-center gap-2">
                        🗑️ Hapus Jadwal Ini Saja
                    </button>
                </form>

            </div>
        </div>
    </div>

    <script>
        // Copy laporan lama biarkan saja... (kode copyLaporan)

        // Fungsi Buka Modal Detail
        function openModal(element) {
            let id = element.getAttribute('data-id');

            // Isi Teks Judul
            document.getElementById('modalKlien').innerText = element.getAttribute('data-klien');
            document.getElementById('modalPilar').innerText = element.getAttribute('data-pilar');

            // Isi Form Input (Kalau ada isinya, kalau gak kosongin)
            document.getElementById('modalScript').value = element.getAttribute('data-script') || '';
            document.getElementById('modalCaption').value = element.getAttribute('data-caption') || '';
            document.getElementById('modalLinkRef').value = element.getAttribute('data-linkref') || '';
            document.getElementById('modalLinkDrive').value = element.getAttribute('data-linkdrive') || '';

            // Atur URL Action untuk Form Simpan & Form Hapus
            document.getElementById('formDetail').action = `/update-detail/${id}`;
            document.getElementById('formHapus').action = `/hapus-jadwal/${id}`;

            // Tampilkan Modal
            document.getElementById('detailModal').classList.remove('hidden');
        }

        // Fungsi Tutup Modal
        function closeModal() {
            document.getElementById('detailModal').classList.add('hidden');
        }
    </script>
</body>

</html>