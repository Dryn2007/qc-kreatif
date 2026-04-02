<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Fitur Dihapus</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: Inter, Arial, sans-serif
        }
    </style>
</head>

<body class="bg-gray-50 p-6">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-2xl shadow text-center">
        <h1 class="text-2xl font-bold mb-4">Fitur Upload dari Screenshot Dihapus</h1>
        <p class="mb-4">Fitur upload / OCR tidak jadi digunakan. Untuk sekarang, gunakan fitur export laporan.</p>
        <div class="flex justify-center gap-3">
            <a href="/" class="px-4 py-2 bg-gray-200 rounded">Kembali ke Board</a>
            <a href="{{ route('export.excel', ['minggu' => 'Minggu 1']) }}"
                class="px-4 py-2 bg-gray-800 text-white rounded">Export Excel</a>
            <a href="{{ route('export.pdf', ['minggu' => 'Minggu 1']) }}"
                class="px-4 py-2 bg-gray-600 text-white rounded">Export PDF</a>
        </div>
    </div>
</body>

</html>