<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Upload Jadwal - QC Creative</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 p-6">
    <div class="max-w-3xl mx-auto bg-white p-6 rounded-2xl shadow">
        <h1 class="text-2xl font-bold mb-4">Upload Jadwal dari Screenshot</h1>

        @if(session('error'))
            <div class="bg-red-50 border border-red-100 text-red-700 p-3 rounded mb-4">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div class="bg-green-50 border border-green-100 text-green-700 p-3 rounded mb-4">{{ session('success') }}</div>
        @endif

        <form action="{{ route('upload.process') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium">Pilih foto / screenshot</label>
                <input type="file" name="image" accept="image/*" required class="mt-2" />
            </div>

            <div>
                <label class="block text-sm font-medium">Minggu (opsional)</label>
                <input type="text" name="minggu" value="Minggu 1" class="mt-2 w-full border rounded px-3 py-2" />
            </div>

            <div class="flex gap-2">
                <a href="/" class="inline-block px-4 py-2 bg-gray-200 rounded">Kembali</a>
                <button type="submit" class="inline-block px-4 py-2 bg-blue-600 text-white rounded">Upload dan
                    Proses</button>
            </div>
        </form>

        <p class="text-sm text-gray-500 mt-4">Catatan: OCR via <a href="https://ocr.space/"
                class="underline">OCR.space</a>. Untuk hasil lebih baik, tambahkan <code>OCR_SPACE_API_KEY</code> di
            environment (Vercel Project → Settings → Environment Variables).</p>
    </div>
</body>

</html>