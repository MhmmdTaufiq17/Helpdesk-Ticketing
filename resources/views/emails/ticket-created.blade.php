<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Tiket Support</title>
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

        .ticket-date {
            color: #95a5a6;
            font-size: 14px;
            margin-top: 5px;
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

        .action-section {
            text-align: center;
            margin: 30px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .action-title {
            color: #2c3e50;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
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
            border: none;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .track-button:hover {
            background-color: #2980b9;
        }

        .instructions {
            margin: 25px 0;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ecf0f1;
            border-radius: 4px;
        }

        .instructions-title {
            color: #2c3e50;
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .instructions-list {
            color: #34495e;
            font-size: 14px;
            line-height: 1.8;
            padding-left: 20px;
        }

        .instructions-list li {
            margin-bottom: 8px;
        }

        .security-note {
            background-color: #fff8e1;
            border-left: 3px solid #f1c40f;
            padding: 15px;
            margin: 20px 0;
            font-size: 13px;
            color: #7d6608;
            border-radius: 0 4px 4px 0;
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

        /* Responsive */
        @media only screen and (max-width: 600px) {
            .email-body {
                padding: 20px;
            }

            .ticket-number {
                font-size: 24px;
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
            <h1 class="email-title">Konfirmasi Pembuatan Tiket</h1>
            <div class="email-subtitle">Tiket support Anda telah berhasil direkam</div>
        </div>

        <!-- Body -->
        <div class="email-body">
            <!-- Greeting -->
            <div class="greeting">
                Kepada {{ $ticket->client_name }},<br><br>
                Terima kasih telah menghubungi tim support kami. Tiket Anda telah berhasil dibuat dan akan segera diproses.
            </div>

            <!-- Ticket Information -->
            <div class="ticket-section">
                <div class="ticket-label">Nomor Referensi Tiket</div>
                <div class="ticket-number">{{ $ticket->ticket_code }}</div>
                <div class="ticket-date">Dibuat: {{ $ticket->created_at->format('d F Y, H:i') }}</div>
            </div>

            <!-- Status Information -->
            <div class="status-info">
                <div class="status-title">
                    <span>📋 Status Tiket</span>
                </div>
                <div class="status-text">
                    Tiket Anda saat ini dalam status <strong>"{{ ucfirst($ticket->status) }}"</strong> dan sedang dalam antrian untuk ditinjau oleh tim technical support kami. Anda akan menerima update via email ketika ada perkembangan.
                </div>
            </div>

            <!-- Action Section -->
            <div class="action-section">
                <div class="action-title">Lacak Perkembangan Tiket</div>
                <a href="{{ url('/tickets/track') }}" class="track-button">Lacak Status Tiket</a>
            </div>

            <!-- Instructions -->
            <div class="instructions">
                <div class="instructions-title">
                    <span>ℹ️ Informasi Penting</span>
                </div>
                <ul class="instructions-list">
                    <li>Simpan nomor tiket di atas untuk referensi</li>
                    <li>Gunakan nomor tiket untuk melacak status</li>
                    <li>Update akan dikirimkan ke email ini</li>
                    <li>Perkiraan waktu respon: 1-2 hari kerja</li>
                </ul>
            </div>

            <!-- Security Note -->
            <div class="security-note">
                <strong>Catatan Keamanan:</strong> Untuk melindungi privasi Anda, jangan membagikan nomor tiket ini kepada pihak lain.
            </div>

            <!-- Closing -->
            <div class="greeting" style="margin-top: 25px;">
                Terima kasih atas kesabaran Anda.<br>
                <strong>Tim Support {{ config('app.name', 'Support System') }}</strong>
            </div>
        </div>

        <!-- Footer -->
        <div class="email-footer">
            <div class="footer-contact">
                <div class="contact-label">Untuk pertanyaan lebih lanjut:</div>
                <div class="contact-info">support@yourdomain.com</div>
            </div>
            <div class="copyright">
                © {{ date('Y') }} {{ config('app.name', 'Support System') }}. Email ini dikirim secara otomatis.
            </div>
        </div>
    </div>
</body>
</html>
