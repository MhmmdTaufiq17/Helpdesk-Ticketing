<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Status Tiket Support</title>
    <style>
        /* Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333333;
            background-color: #f8f9fa;
            padding: 20px;
            margin: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 4px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        }

        .email-header {
            background-color: #2c3e50;
            color: white;
            padding: 25px 30px;
            border-bottom: 4px solid #3498db;
        }

        .company-name {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 5px;
            color: #ecf0f1;
        }

        .email-title {
            font-size: 22px;
            font-weight: 600;
            margin: 10px 0 5px 0;
            color: white;
        }

        .email-subtitle {
            color: #bdc3c7;
            font-size: 14px;
            font-weight: 400;
        }

        .email-body {
            padding: 30px;
        }

        .greeting {
            font-size: 16px;
            color: #2c3e50;
            margin-bottom: 20px;
            line-height: 1.8;
        }

        .ticket-section {
            background-color: #f8f9fa;
            border-left: 4px solid #3498db;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 4px 4px 0;
        }

        .ticket-label {
            color: #7f8c8d;
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .ticket-number {
            font-size: 28px;
            font-weight: 700;
            color: #2c3e50;
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
            margin: 10px 0;
        }

        .status-change {
            background-color: #f8f9fa;
            padding: 25px;
            margin: 25px 0;
            border-radius: 8px;
            text-align: center;
        }

        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            margin: 10px 0;
        }

        .status-old {
            background-color: #e74c3c;
            color: white;
        }

        .status-new {
            background-color: #27ae60;
            color: white;
        }

        .status-arrow {
            font-size: 24px;
            margin: 0 15px;
            color: #95a5a6;
        }

        .status-info {
            background-color: #f0f8ff;
            border: 1px solid #e1f0ff;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
        }

        .status-title {
            color: #2980b9;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .status-text {
            color: #34495e;
            font-size: 15px;
            line-height: 1.7;
        }

        .note-section {
            background-color: #fff8e1;
            border-left: 3px solid #f39c12;
            padding: 15px;
            margin: 20px 0;
            font-size: 14px;
            color: #7d6608;
            border-radius: 0 4px 4px 0;
        }

        .action-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .track-button {
            display: inline-block;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 4px;
            font-weight: 500;
            font-size: 15px;
            transition: background-color 0.2s;
        }

        .track-button:hover {
            background-color: #2980b9;
        }

        .timeline {
            margin: 25px 0;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ecf0f1;
            border-radius: 4px;
        }

        .timeline-title {
            color: #2c3e50;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .timeline-item {
            padding: 10px 0;
            border-left: 2px solid #3498db;
            padding-left: 20px;
            margin-left: 10px;
            position: relative;
        }

        .timeline-item::before {
            content: "●";
            position: absolute;
            left: -8px;
            top: 10px;
            color: #3498db;
            font-size: 12px;
        }

        .timeline-date {
            font-size: 12px;
            color: #95a5a6;
            margin-bottom: 5px;
        }

        .timeline-text {
            font-size: 14px;
            color: #34495e;
        }

        .email-footer {
            background-color: #2c3e50;
            color: #ecf0f1;
            padding: 25px 30px;
            text-align: center;
            border-top: 1px solid #34495e;
        }

        .footer-contact {
            margin-bottom: 15px;
        }

        .contact-label {
            color: #bdc3c7;
            font-size: 13px;
            margin-bottom: 5px;
        }

        .contact-info {
            color: white;
            font-size: 14px;
            font-weight: 500;
        }

        .copyright {
            color: #95a5a6;
            font-size: 12px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #34495e;
        }

        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 20px;
            }

            .ticket-number {
                font-size: 24px;
            }

            .status-badge {
                display: block;
                margin: 10px auto;
            }

            .status-arrow {
                display: block;
                margin: 10px 0;
                transform: rotate(90deg);
            }

            .track-button {
                padding: 10px 25px;
                font-size: 14px;
                width: 100%;
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="company-name">{{ config('app.name', 'Support System') }}</div>
            <h1 class="email-title">Update Status Tiket</h1>
            <div class="email-subtitle">Status tiket support Anda telah diperbarui</div>
        </div>

        <!-- Body -->
        <div class="email-body">
            <!-- Greeting -->
            <div class="greeting">
                Kepada {{ $ticket->client_name }},<br><br>
                Ada perkembangan terbaru mengenai tiket support Anda.
            </div>

            <!-- Ticket Information -->
            <div class="ticket-section">
                <div class="ticket-label">Nomor Referensi Tiket</div>
                <div class="ticket-number">{{ $ticket->ticket_code }}</div>
                <div class="ticket-date">Judul: {{ $ticket->title }}</div>
            </div>

            <!-- Status Change -->
            <div class="status-change">
                <div style="margin-bottom: 10px; color: #7f8c8d; font-size: 14px;">Perubahan Status</div>
                <div>
                    <span class="status-badge status-old">{{ ucfirst($oldStatus) }}</span>
                    <span class="status-arrow">→</span>
                    <span class="status-badge status-new">{{ ucfirst($newStatus) }}</span>
                </div>
            </div>

            <!-- Status Information -->
            <div class="status-info">
                <div class="status-title">
                    <span>📋 Informasi Status Baru</span>
                </div>
                <div class="status-text">
                    @php
                        $statusMessages = [
                            'open' => 'Tiket Anda telah diterima dan sedang menunggu untuk diproses oleh tim support. Kami akan segera menindaklanjuti laporan Anda.',
                            'in_progress' => 'Tiket Anda sedang dalam penanganan oleh tim technical support. Tim kami sedang menganalisis dan mengerjakan solusi untuk permasalahan Anda.',
                            'closed' => 'Tiket Anda telah diselesaikan. Jika Anda masih mengalami kendala atau memiliki pertanyaan lebih lanjut, silakan buka tiket baru atau balas email ini.'
                        ];
                    @endphp
                    {{ $statusMessages[$newStatus] ?? 'Status tiket Anda telah diperbarui.' }}
                </div>
            </div>

            <!-- Note if any -->
            @if(!empty($note))
            <div class="note-section">
                <strong>📝 Catatan dari Tim Support:</strong><br>
                {{ $note }}
            </div>
            @endif

            <!-- Timeline -->
            @if(isset($timeline) && count($timeline) > 0)
            <div class="timeline">
                <div class="timeline-title">
                    <span>📅 Riwayat Status Tiket</span>
                </div>
                @foreach($timeline as $item)
                <div class="timeline-item">
                    <div class="timeline-date">{{ $item['date'] }}</div>
                    <div class="timeline-text">
                        <strong>{{ ucfirst($item['status']) }}</strong>
                        @if(!empty($item['note']))
                            <br>{{ $item['note'] }}
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif

            <!-- Action Section -->
            <div class="action-section">
                <div class="action-title">Lacak Perkembangan Tiket</div>
                <a href="{{ url('/tickets/track/' . $ticket->ticket_code) }}" class="track-button">Lihat Detail Tiket</a>
            </div>

            <!-- Next Steps -->
            @if($newStatus === 'in_progress')
            <div class="instructions" style="margin: 25px 0; padding: 20px; background-color: #fff; border: 1px solid #ecf0f1; border-radius: 4px;">
                <div class="instructions-title" style="color: #2c3e50; font-size: 16px; font-weight: 600; margin-bottom: 15px;">
                    <span>⏭️ Langkah Selanjutnya</span>
                </div>
                <ul class="instructions-list" style="color: #34495e; font-size: 14px; line-height: 1.8; padding-left: 20px;">
                    <li>Tim support sedang menganalisis masalah Anda</li>
                    <li>Anda akan menerima update berikutnya melalui email</li>
                    <li>Jika diperlukan informasi tambahan, tim support akan menghubungi Anda</li>
                </ul>
            </div>
            @elseif($newStatus === 'closed')
            <div class="instructions" style="margin: 25px 0; padding: 20px; background-color: #fff; border: 1px solid #ecf0f1; border-radius: 4px;">
                <div class="instructions-title" style="color: #2c3e50; font-size: 16px; font-weight: 600; margin-bottom: 15px;">
                    <span>✅ Apakah Masalah Anda Terselesaikan?</span>
                </div>
                <ul class="instructions-list" style="color: #34495e; font-size: 14px; line-height: 1.8; padding-left: 20px;">
                    <li>Jika masalah masih berlanjut, Anda dapat membuka tiket baru</li>
                    <li>Referensikan tiket ini untuk mempercepat proses</li>
                    <li>Terima kasih telah menggunakan layanan support kami</li>
                </ul>
            </div>
            @endif

            <!-- Closing -->
            <div class="greeting" style="margin-top: 25px;">
                Terima kasih atas kepercayaan Anda.<br>
                <strong>Tim Support {{ config('app.name', 'Support System') }}</strong>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-contact">
                <div class="contact-label">Butuh bantuan lebih lanjut?</div>
                <div class="contact-info">support@yourdomain.com</div>
            </div>
            <div class="copyright">
                © {{ date('Y') }} {{ config('app.name', 'Support System') }}. Email ini dikirim secara otomatis.
            </div>
        </div>
    </div>
</body>
</html>
