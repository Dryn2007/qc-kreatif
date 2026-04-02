<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Preview Hasil OCR - QC Creative</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-2xl shadow">
        <h1 class="text-2xl font-bold mb-4">Preview Hasil OCR - {{ $minggu }}</h1>

        <p class="text-sm text-gray-500 mb-4">Centang entri yang ingin disimpan ke database, lalu klik "Simpan
            Terpilih".</p>

        <form action="{{ route('upload.save') }}" method="POST">
            @csrf

            <div class="space-y-3">
                @foreach($parsed as $idx => $p)
                    <div class="border rounded p-3 flex items-start gap-3">
                        <div>
                            <input type="checkbox" name="selected[]" value="{{ $idx }}" id="s_{{ $idx }}" checked>
                        </div>
                        <div class="flex-1">
                            <div class="text-sm text-gray-600">Hari: <strong>{{ $p['hari'] }}</strong> — Minggu:
                                <strong>{{ $p['minggu'] }}</strong></div>
                            <div class="mt-1 font-bold text-lg">{{ $p['klien'] }}</div>
                            <div class="text-sm text-gray-700 mt-1">Pilar: {{ $p['pilar_konten'] }}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 flex gap-2">
                <a href="{{ route('upload.form') }}" class="px-4 py-2 bg-gray-200 rounded">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded">Simpan Terpilih</button>
            </div>
        </form>
    </div>
</body>

</html>