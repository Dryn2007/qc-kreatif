<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal LokaVira</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 text-gray-800 antialiased font-sans p-6">

    <div class="max-w-xl mx-auto mt-10">
        <div class="bg-white p-8 rounded-xl shadow-sm border border-gray-200">
            <h2 class="text-2xl font-bold text-blue-900 mb-6">Tambah Jadwal Baru</h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 p-4 rounded-lg mb-6 text-sm">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('jadwal.store') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Nama Klien / Brand</label>
                    <select name="klien" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                        <option value="" disabled selected>-- Pilih Klien --</option>
                        <option value="BIG">BIG</option>
                        <option value="HH">HH</option>
                        <option value="HFC">HFC</option>
                        <option value="Lokavira">Lokavira</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Untuk Minggu Ke-</label>
                    <select name="minggu" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                        <option value="Minggu 1">Minggu 1</option>
                        <option value="Minggu 2">Minggu 2</option>
                        <option value="Minggu 3">Minggu 3</option>
                        <option value="Minggu 4">Minggu 4</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Jadwal Hari</label>
                    <select name="hari" required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none bg-white">
                        <option value="Senin">Senin</option>
                        <option value="Selasa">Selasa</option>
                        <option value="Rabu">Rabu</option>
                        <option value="Kamis">Kamis</option>
                        <option value="Jumat">Jumat</option>
                        <option value="Sabtu">Sabtu</option>
                        <option value="Minggu">Minggu</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Pilar Konten / Topik</label>
                    <input type="text" name="pilar_konten" placeholder="Contoh: Story Telling, Q&A..." required
                        class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>

                <div class="flex gap-4 pt-4">
                    <a href="/"
                        class="w-1/3 text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="w-2/3 bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition">
                        Simpan Jadwal
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>

</html>
