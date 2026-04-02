<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Laporan QC - Seluruh Jadwal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #1f2937;
            background: #f9fafb;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        .header {
            text-align: center;
            margin-bottom: 2rem;
            padding-bottom: 1.5rem;
            border-bottom: 3px solid #0066cc;
        }

        .header h1 {
            font-size: 1.75rem;
            color: #0066cc;
            margin-bottom: 0.5rem;
        }

        .header .subtitle {
            font-size: 0.9rem;
            color: #6b7280;
        }

        .info-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 1rem;
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: #666;
        }

        .day-section {
            margin-top: 2rem;
            page-break-inside: avoid;
        }

        .day-title {
            font-size: 1.3rem;
            font-weight: bold;
            color: #fff;
            background: #0066cc;
            padding: 0.75rem 1rem;
            margin-bottom: 1rem;
            border-radius: 6px;
        }

        .minggu-title {
            font-size: 1.1rem;
            font-weight: bold;
            color: #0066cc;
            background: #e0f2fe;
            padding: 0.5rem 1rem;
            margin-bottom: 0.75rem;
            border-left: 4px solid #0066cc;
            border-radius: 4px;
        }

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
            margin-bottom: 1.5rem;
        }

        .card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            page-break-inside: avoid;
        }

        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
            border-bottom: 2px solid #f3f4f6;
            padding-bottom: 0.75rem;
        }

        .card-header .klien {
            font-size: 1.1rem;
            font-weight: bold;
            color: #0066cc;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: bold;
        }

        .status-kosong {
            background: #f3f4f6;
            color: #374151;
        }

        .status-take {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-edit {
            background: #fef3c7;
            color: #92400e;
        }

        .status-acc {
            background: #dbeafe;
            color: #1e40af;
        }

        .status-upload {
            background: #dcfce7;
            color: #166534;
        }

        .card-field {
            margin-bottom: 1rem;
        }

        .card-field-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: #6b7280;
            text-transform: uppercase;
            margin-bottom: 0.25rem;
        }

        .card-field-value {
            font-size: 0.95rem;
            color: #1f2937;
            word-wrap: break-word;
        }

        @media print {
            body {
                background: #fff;
            }

            .container {
                max-width: 100%;
                padding: 0;
            }

            .card {
                border: 1px solid #ccc;
                box-shadow: none;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Laporan Quality Control Creative</h1>
            <p class="subtitle">Semua Target & Jadwal - Dicetak pada {{ date('d M Y H:i') }}</p>
        </div>

        @if($contents->isEmpty())
            <div style="text-align:center; margin-top:3rem; color:#666;">
                <p>Tidak ada data target atau jadwal yang ditemukan.</p>
            </div>
        @else
            @foreach($contents as $klien => $items_klien)
                <div class="day-section">
                    <!-- Day title used for Client Name here -->
                    <div class="day-title">KLIEN: {{ $klien }} ({{ count($items_klien) }} Task)</div>

                    @php
                        $grouped_minggu = $items_klien->groupBy('minggu');
                    @endphp

                    @foreach($grouped_minggu as $minggu_name => $items_minggu)
                        <div class="minggu-title">{{ $minggu_name }}</div>

                        <div class="cards-grid">
                            @foreach($items_minggu as $item)
                                <div class="card">
                                    <div class="card-header">
                                        <div class="klien">{{ $item->hari }}</div>
                                        <div class="status-badge status-{{ $item->status }}">
                                            {{ strtoupper($item->status) }}
                                        </div>
                                    </div>

                                    <div class="card-field">
                                        <div class="card-field-label">Pilar Konten</div>
                                        <div class="card-field-value">{{ $item->pilar_konten }}</div>
                                    </div>

                                    @if($item->script_video)
                                        <div class="card-field">
                                            <div class="card-field-label">Script Video / VO</div>
                                            <div class="card-field-value">{!! nl2br(e($item->script_video)) !!}</div>
                                        </div>
                                    @endif

                                    @if($item->caption)
                                        <div class="card-field">
                                            <div class="card-field-label">Caption</div>
                                            <div class="card-field-value">{!! nl2br(e($item->caption)) !!}</div>
                                        </div>
                                    @endif

                                    @if($item->link_referensi || $item->link_gdrive)
                                        <hr style="border:0; border-top:1px dashed #e5e7eb; margin: 1rem 0;">
                                    @endif

                                    @if($item->link_referensi)
                                        <div class="card-field">
                                            <div class="card-field-label">Link Referensi</div>
                                            <div class="card-field-value">
                                                <a href="{{ $item->link_referensi }}" style="color:#0066cc;">{{ $item->link_referensi }}</a>
                                            </div>
                                        </div>
                                    @endif

                                    @if($item->link_gdrive)
                                        <div class="card-field">
                                            <div class="card-field-label">Link GDrive</div>
                                            <div class="card-field-value">
                                                <a href="{{ $item->link_gdrive }}" style="color:#0066cc;">{{ $item->link_gdrive }}</a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endforeach
        @endif
    </div>

    <script>
        // Auto print dialog after short delay if rendered as HTML
        setTimeout(() => {
            window.print();
        }, 1000);
    </script>
</body>

</html>