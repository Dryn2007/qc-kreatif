<!DOCTYPE html>
<html lang="id" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal QC</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
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

<body class="bg-slate-950 text-slate-300 antialiased font-sans min-h-screen bg-[radial-gradient(ellipse_at_top_right,_var(--tw-gradient-stops))] from-slate-900 via-[#0f172a] to-black py-10 px-4 sm:px-6">

    <div class="max-w-3xl mx-auto w-full relative">
        <!-- Glow background effects -->
        <div class="absolute -top-10 -left-10 w-72 h-72 bg-indigo-600/20 rounded-full blur-3xl pointer-events-none"></div>
        <div class="absolute -bottom-10 -right-10 w-72 h-72 bg-fuchsia-600/20 rounded-full blur-3xl pointer-events-none"></div>

        <div class="glass-card relative z-10 rounded-3xl shadow-2xl border border-slate-800 overflow-hidden">
            
            <div class="bg-slate-900/80 border-b border-slate-800 p-6 md:p-8 flex flex-col md:flex-row items-center justify-between gap-4">
                <div class="text-center md:text-left">
                    <h2 class="text-3xl font-extrabold text-white">✨ Jadwal <span class="bg-gradient-to-r from-indigo-400 to-fuchsia-400 gradient-text">Baru</span></h2>
                    <p class="text-slate-400 text-sm font-medium mt-1">Tambahkan task ke board creative QC.</p>
                </div>
                <a href="{{ route('home') }}" class="flex items-center gap-2 bg-slate-800 hover:bg-slate-700 text-white px-5 py-2.5 rounded-xl text-sm font-bold transition-all border border-slate-700 shadow-lg">
                    ← Kembali
                </a>
            </div>

            <div class="p-6 md:p-8">
                @if(session('success'))
                    <div class="bg-emerald-900/30 border border-emerald-500/30 text-emerald-400 px-5 py-4 rounded-xl mb-8 flex items-center gap-3 font-semibold">
                        <span class="text-xl">✅</span> {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Klien -->
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">🏷️ Nama Klien</label>
                            <input type="text" name="klien" required
                                class="w-full bg-slate-800/60 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all font-bold placeholder-slate-600 shadow-inner" 
                                placeholder="Contoh: Brand X">
                        </div>

                        <!-- Pilar Konten -->
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">📌 Pilar Konten</label>
                            <input type="text" name="pilar_konten" required
                                class="w-full bg-slate-800/60 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all font-bold placeholder-slate-600 shadow-inner" 
                                placeholder="Contoh: Edukasi Product">
                        </div>

                        <!-- Hari Target -->
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">📅 Hari Target</label>
                            <div class="relative">
                                <select name="hari" required 
                                    class="w-full bg-slate-800/60 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all font-bold appearance-none shadow-inner cursor-pointer">
                                    <option value="Senin">Senin</option>
                                    <option value="Selasa">Selasa</option>
                                    <option value="Rabu">Rabu</option>
                                    <option value="Kamis">Kamis</option>
                                    <option value="Jumat">Jumat</option>
                                    <option value="Sabtu">Sabtu</option>
                                    <option value="Minggu">Minggu ☕</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Minggu Ke -->
                        <div>
                            <label class="block text-xs font-bold text-slate-400 uppercase tracking-wider mb-2">📆 Minggu Ke-</label>
                            <div class="relative">
                                <select name="minggu" required 
                                    class="w-full bg-slate-800/60 text-slate-200 border border-slate-700 rounded-xl px-4 py-3 focus:ring-2 focus:ring-fuchsia-500 focus:border-fuchsia-500 transition-all font-bold appearance-none shadow-inner cursor-pointer">
                                    <option value="Minggu 1">Minggu 1</option>
                                    <option value="Minggu 2">Minggu 2</option>
                                    <option value="Minggu 3">Minggu 3</option>
                                    <option value="Minggu 4">Minggu 4</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-8 border-t border-slate-800/80">
                        <button type="submit" 
                            class="w-full sm:w-auto px-10 py-3.5 bg-gradient-to-r from-indigo-600 to-fuchsia-600 hover:from-indigo-500 hover:to-fuchsia-500 text-white rounded-xl font-bold shadow-[0_0_20px_rgba(99,102,241,0.3)] transition transform hover:-translate-y-1 mx-auto block">
                            🚀 Simpan Target / Jadwal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>