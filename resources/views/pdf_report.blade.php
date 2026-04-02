<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Laporan QC - {{ $minggu }}</title>
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

        .cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1rem;
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

        .links {
            font-size: 0.85rem;
            color: #0066cc;
        }

        .links a {
            color: #0066cc;
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .empty-message {
            text-align: center;
            padding: 2rem;
            color: #9ca3af;
        }

        @media print {
            body {
                background: #fff;
            }

            .container {
                padding: 0;
            }

            .card {
                page-break-inside: avoid;
            }

            a {
                color: #0066cc;
            }
        }

        @media (max-width: 768px) {
            .header h1 {
                font-size: 1.25rem;
            }

            .day-title {
                font-size: 1.1rem;
                padding: 0.5rem 0.75rem;
            }

            .cards-grid {
                grid-template-columns: 1fr;
            }

            .card {
                padding: 1rem;
            }

            .card-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-row {
                flex-direction: column;
                gap: 0.25rem;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>📊 Laporan QC Creative</h1>
            <p class="subtitle">{{ $minggu }}</p>
            <div class="info-row">
                <span>📅 {{ date('d F Y') }}</span>
                <span>⏰ {{ date('H:i') }} WIB</span>
            </div>
        </div>

        @forelse($contents as $hari => $items)
            <div class="day-section">
                <div class="day-title">{{ $hari }}</div>
                <div class="cards-grid">
                    @foreach($items as $i => $it)
                        <div class="card">
                            <div class="card-header">
                                <div class="klien">{{ $it->klien }}</div>
                                <div class="status-badge status-{{ $it->status }}">
                                    {{ strtoupper(str_replace('_', ' ', $it->status)) }}</div>
                            </div>

                            <div class="card-field">
                                <div class="card-field-label">📌 Pilar Konten</div>
                                <div class="card-field-value">{{ $it->pilar_konten }}</div>
                            </div>

                            @if($it->script_video)
                                <div class="card-field">
                                    <div class="card-field-label">📝 Script Video</div>
                                    <div class="card-field-value">{{ Str::limit($it->script_video, 150) }}</div>
                                </div>
                            @endif

                            @if($it->caption)
                                <div class="card-field">
                                    <div class="card-field-label">#️⃣ Caption</div>
                                    <div class="card-field-value">{{ Str::limit($it->caption, 150) }}</div>
                                </div>
                            @endif

                            @if($it->link_referensi || $it->link_gdrive)
                                <div class="card-field">
                                    <div class="card-field-label">🔗 Links</div>
                                    <div class="links">
                                        @if($it->link_referensi)
                                            <div>📌 Ref: <a href="{{ $it->link_referensi }}"
                                                    target="_blank">{{ Str::limit($it->link_referensi, 50) }}</a></div>
                                        @endif
                                        @if($it->link_gdrive)
                                            <div>📁 Drive: <a href="{{ $it->link_gdrive }}"
                                                    target="_blank">{{ Str::limit($it->link_gdrive, 50) }}</a></div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
        @empty
            <div class="empty-message">
                <p style="font-size: 2rem; margin-bottom: 1rem;">🗓️</p>
                <p>Tidak ada data untuk {{ $minggu }}</p>
            </div>
        @endforelse
    </div>
</body>

</html>