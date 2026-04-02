<div id="createModal"
    class="fixed inset-0 bg-slate-950/80 backdrop-blur-sm z-50 invisible opacity-0 transition-all duration-300 flex items-center justify-center p-4">
    <div class="bg-slate-900 rounded-3xl shadow-[0_0_50px_rgba(0,0,0,0.5)] border border-slate-700 w-full max-w-2xl max-h-[90vh] overflow-y-auto relative transform scale-95 transition-transform duration-300"
        id="createModalContent">

        <div
            class="sticky top-0 bg-slate-900/90 backdrop-blur-md border-b border-slate-800 p-5 sm:p-6 flex justify-between items-center z-10">
            <div>
                <h2 class="text-2xl font-extrabold text-white">âœ✨ Jadwal <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-fuchsia-400">Baru</span>
                </h2>
                <p class="text-slate-400 text-sm font-medium mt-1">Tambahkan task ke board creative QC.</p>
            </div>
            <button onclick="hideCreateModal()" type="button"
                class="w-10 h-10 flex items-center justify-center rounded-full bg-slate-800 text-slate-400 hover:text-white hover:bg-slate-700 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>
        </div>

        <div class="p-5 sm:p-6 sm:px-8">
            <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-6" id="formCreateJadwal">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Klien Input (Dropdown) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">🏢 Nama
                            Klien</label>
                        <select name="klien" id="createKlien" required
                            class="w-full bg-slate-800/60 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all font-bold appearance-none cursor-pointer">
                            <option value="" disabled selected>-- Pilih Klien --</option>
                            <option value="BIG">BIG</option>
                            <option value="HH">HH</option>
                            <option value="HFC">HFC</option>
                            <option value="Lokavira">Lokavira</option>
                        </select>
                    </div>

                    <!-- Minggu Input (Dropdown) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">📅 Minggu
                            Ke-</label>
                        <select name="minggu" id="createMinggu" required
                            class="w-full bg-slate-800/60 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all font-bold appearance-none cursor-pointer">
                            <option value="" disabled selected>-- Pilih Minggu --</option>
                            <option value="Minggu 1">Minggu 1</option>
                            <option value="Minggu 2">Minggu 2</option>
                            <option value="Minggu 3">Minggu 3</option>
                            <option value="Minggu 4">Minggu 4</option>
                            <option value="Minggu 5">Minggu 5</option>
                        </select>
                    </div>

                    <!-- Pilar Konten (Datalist / Text) -->
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">📌 Pilar
                            Konten</label>
                        <input type="text" name="pilar_konten" list="pilarOptions" required
                            class="w-full bg-slate-800/60 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all font-bold"
                            placeholder="Tulis atau Pilih Pilar...">
                        <datalist id="pilarOptions">
                            <option value="Story Telling">
                            <option value="Q&A">
                            <option value="Edukasi">
                            <option value="Hiburan">
                            <option value="Promosi">
                        </datalist>
                    </div>

                    <!-- Tanggal (Date) -->
                    <div>
                        <label class="block text-xs font-bold text-emerald-400 uppercase tracking-wider mb-2">🗓️
                            Tanggal</label>
                        <input type="date" name="tanggal" required
                            class="w-full bg-slate-800/60 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all font-bold">
                    </div>

                    <!-- Hari Target -->
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">📆 Hari
                            Target</label>
                        <select name="hari" required
                            class="w-full bg-slate-800/60 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all font-bold appearance-none cursor-pointer">
                            <option value="" disabled selected>-- Pilih Hari --</option>
                            <option value="Senin">Senin</option>
                            <option value="Selasa">Selasa</option>
                            <option value="Rabu">Rabu</option>
                            <option value="Kamis">Kamis</option>
                            <option value="Jumat">Jumat</option>
                            <option value="Sabtu">Sabtu</option>
                            <option value="Minggu">Minggu</option>
                        </select>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-800/80 flex justify-end gap-3 mt-4">
                    <button type="button" onclick="hideCreateModal()"
                        class="px-6 py-2.5 bg-slate-800 hover:bg-slate-700 text-white rounded-xl font-bold transition">Batal</button>
                    <button type="submit"
                        class="px-8 py-2.5 bg-gradient-to-r from-indigo-600 to-fuchsia-600 hover:from-indigo-500 hover:to-fuchsia-500 text-white rounded-xl font-bold shadow-[0_0_20px_rgba(99,102,241,0.3)] transition transform hover:scale-105">🚀
                        Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function showCreateModal(klien = '', minggu = '') {
        const modal = document.getElementById('createModal');
        const content = document.getElementById('createModalContent');

        // Auto-select Klien and Minggu if provided
        if (klien) {
            document.getElementById('createKlien').value = klien;
        }
        if (minggu) {
            document.getElementById('createMinggu').value = minggu;
        }

        modal.classList.remove('invisible');
        modal.style.display = 'flex';
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            content.classList.remove('scale-95');
            content.classList.add('scale-100');
        }, 10);
    }

    function hideCreateModal() {
        const modal = document.getElementById('createModal');
        const content = document.getElementById('createModalContent');
        modal.classList.add('opacity-0');
        content.classList.remove('scale-100');
        content.classList.add('scale-95');
        setTimeout(() => {
            modal.classList.add('invisible');
            modal.style.display = 'none';
        }, 300);
    }
</script>