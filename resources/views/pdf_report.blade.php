<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Laporan QC - {{ $minggu }}</title>
    <style>
        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: #222;
        }

        .container {
            width: 100%;
            padding: 10px;
        }

        .header {
            text-align: center;
            margin-bottom: 12px;
        }

        .hari {
            margin-top: 10px;
            margin-bottom: 6px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 6px;
        }

        th {
            background: #f3f4f6;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Laporan QC - {{ $minggu }}</h2>
            <div>Tanggal: {{ date('d-m-Y H:i') }}</div>
        </div>

        @foreach($contents as $hari => $items)
            <div class="hari">{{ $hari }}</div>
            <table>
                <thead>
                    <tr>
                        <th style="width:5%">No</th>
                        <th style="width:20%">Klien</th>
                        <th style="width:25%">Pilar Konten</th>
                        <th style="width:20%">Caption / Script</th>
                        <th style="width:10%">Status</th>
                        <th style="width:20%">Links</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $i => $it)
                        <tr>
                            <td>{{ $i + 1 }}</td>
                            <td>{{ $it->klien }}</td>
                            <td>{{ $it->pilar_konten }}</td>
                            <td>{{ Str::limit($it->script_video . "\n" . $it->caption, 200) }}</td>
                            <td>{{ $it->status }}</td>
                            <td>
                                @if($it->link_referensi)
                                <div>Ref: {{ $it->link_referensi }}</div> @endif
                                @if($it->link_gdrive)
                                <div>Drive: {{ $it->link_gdrive }}</div> @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>
</body>

</html>