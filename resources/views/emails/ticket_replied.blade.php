<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Balasan Baru untuk Tiket Support</title>
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

        .reply-section {
            background-color: #f8f9fa;
            border: 1px solid #e1f0ff;
            padding: 25px;
            margin: 25px 0;
            border-radius: 8px;
        }

        .reply-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e1e8ed;
        }

        .admin-avatar {
            width: 40px;
            height: 40px;
            background-color: #3498db;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 18px;
        }

        .admin-info {
            flex: 1;
        }

        .admin-name {
            font-weight: 600;
            color: #2c3e50;
            font-size: 16px;
        }

        .reply-date {
            font-size: 12px;
            color: #95a5a6;
            margin-top: 3px;
        }

        .reply-message {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            border: 1px solid #ecf0f1;
            margin-top: 15px;
        }

        .reply-message p {
            color: #34495e;
            font-size: 15px;
            line-height: 1.7;
            white-space: pre-line;
        }

        .status-info {
            background-color: #f0f8ff;
            border: 1px solid #e1f0ff;
            padding: 20px;
            margin: 25px 0;
            border-radius: 4px;
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

        .reply-instructions {
            margin: 25px 0;
            padding: 20px;
            background-color: #fff8e1;
            border-left: 3px solid #f1c40f;
            border-radius: 0 4px 4px 0;
        }

        .reply-instructions p {
            font-size: 14px;
            color: #7d6608;
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

            .track-button {
                padding: 10px 25px;
                font-size: 14px;
                width: 100%;
                display: block;
            }

            .reply-header {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="email-header">
            <div class="company-name">{{ config('app.name', 'Support System') }}</div>
            <h1 class="email-title">Balasan dari Tim Support</h1>
            <div class="email-subtitle">Anda mendapatkan balasan baru untuk tiket Anda</div>
        </div>

        <!-- Body -->
        <div class="email-body">
            <!-- Greeting -->
            <div class="greeting">
                Kepada {{ $ticket->client_name }},<br><br>
                Tim support kami telah memberikan balasan untuk tiket Anda. Silakan lihat balasan di bawah ini.
            </div>

            <!-- Ticket Information -->
            <div class="ticket-section">
                <div class="ticket-label">Nomor Referensi Tiket</div>
                <div class="ticket-number">{{ $ticket->ticket_code }}</div>
                <div class="ticket-date">Judul: {{ $ticket->title }}</div>
            </div>

            <!-- Reply Section -->
            <div class="reply-section">
                <div class="reply-header">
                    <div class="admin-avatar">
                        {{ strtoupper(substr($adminName, 0, 1)) }}
                    </div>
                    <div class="admin-info">
                        <div class="admin-name">{{ $adminName }}</div>
                        <div class="reply-date">{{ $reply->created_at->format('d F Y, H:i') }}</div>
                    </div>
                </div>
                <div class="reply-message">
                    <p>{{ $reply->message }}</p>
                </div>
            </div>

            <!-- Status Information -->
            <div class="status-info">
                <div class="status-text">
                    @if($ticket->status === 'in_progress')
                        <strong>📌 Status Tiket: In Progress</strong><br>
                        Tiket Anda sedang dalam penanganan. Tim support akan terus memberikan update.
                    @elseif($ticket->status === 'closed')
                        <strong>✅ Status Tiket: Closed</strong><br>
                        Tiket telah ditutup. Jika masih ada kendala, silakan buka tiket baru.
                    @else
                        <strong>📋 Status Tiket: {{ ucfirst($ticket->status) }}</strong><br>
                        Tim support akan segera merespons balasan Anda.
                    @endif
                </div>
            </div>

            <!-- Action Section -->
            <div class="action-section">
                <div class="action-title">Lihat Detail Tiket</div>
                <a href="{{ url('/tickets/track/' . $ticket->ticket_code) }}" class="track-button">Lihat Percakapan Lengkap</a>
            </div>

            <!-- Reply Instructions -->
            <div class="reply-instructions">
                <p>
                    <strong>💡 Tips:</strong><br>
                    • Anda dapat membalas email ini untuk menambahkan komentar<br>
                    • Gunakan nomor tiket untuk referensi jika menghubungi kembali<br>
                    • Cek status tiket kapan saja melalui link di atas
                </p>
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
