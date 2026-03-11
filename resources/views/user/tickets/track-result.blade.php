@extends('layouts.app')

@section('title', 'Status Tiket #' . $ticket->ticket_code)

@section('content')
<style>
    :root {
        --ink:        #0f0f12;
        --ink-2:      #3a3a4a;
        --ink-3:      #8a8a9a;
        --surface:    #ffffff;
        --surface-2:  #f5f5f7;
        --surface-3:  #ebebef;
        --accent:     #5b5ef4;
        --accent-2:   #7b7ef7;
        --accent-soft:#eeeeff;
        --green:      #22c55e;
        --green-soft: #f0fdf4;
        --yellow:     #f59e0b;
        --yellow-soft:#fffbeb;
        --red:        #ef4444;
        --red-soft:   #fff5f5;
        --radius:     16px;
        --radius-sm:  10px;
        --shadow:     0 2px 1px rgba(0,0,0,.02), 0 8px 32px rgba(0,0,0,.06);
    }

    /* PAGE */
    .page {
        max-width: 1100px;
        margin: 0 auto;
        padding: 36px 24px 80px;
    }

    /* BREADCRUMB */
    .breadcrumb {
        display: flex; align-items: center; gap: 6px;
        font-size: 12.5px; color: var(--ink-3);
        margin-bottom: 28px;
        animation: up .35s ease both;
    }
    .breadcrumb a { color: var(--accent); text-decoration: none; font-weight: 500; }
    .breadcrumb a:hover { text-decoration: underline; }
    .breadcrumb svg { width: 13px; height: 13px; }
    .breadcrumb .cur { color: var(--ink); font-weight: 600; font-family: 'DM Mono', monospace; }

    /* HERO */
    .hero {
        background: var(--surface);
        border-radius: 20px;
        border: 1px solid var(--surface-3);
        padding: 0;
        margin-bottom: 24px;
        box-shadow: var(--shadow);
        overflow: hidden;
        animation: up .38s .04s ease both;
    }
    .hero-top {
        padding: 28px 32px;
        display: flex; align-items: center; justify-content: space-between;
        gap: 20px; flex-wrap: wrap;
        border-bottom: 1px solid var(--surface-3);
    }
    .hero-left { display: flex; align-items: center; gap: 18px; }

    .status-ring {
        width: 56px; height: 56px; flex-shrink: 0;
        border-radius: 16px;
        display: flex; align-items: center; justify-content: center;
        position: relative;
    }
    .status-ring svg { width: 26px; height: 26px; }
    .status-ring.open        { background: #eff6ff; color: #2563eb; box-shadow: 0 0 0 6px rgba(37,99,235,.08); }
    .status-ring.in_progress { background: var(--yellow-soft); color: var(--yellow); box-shadow: 0 0 0 6px rgba(245,158,11,.08); }
    .status-ring.closed      { background: var(--surface-2); color: var(--ink-3); }

    .hero-code {
        font-family: 'DM Mono', monospace;
        font-size: 24px; font-weight: 700;
        color: var(--ink); letter-spacing: -.5px;
        margin: 0 0 5px;
    }
    .hero-title { font-size: 14px; color: var(--ink-3); margin: 0; max-width: 420px; }

    .hero-right { display: flex; flex-direction: column; align-items: flex-end; gap: 10px; }

    /* Badge */
    .badge {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 7px 16px; border-radius: 30px;
        font-size: 13px; font-weight: 700;
    }
    .badge-dot { width: 7px; height: 7px; border-radius: 50%; }
    .badge.open        { background: #dbeafe; color: #1d4ed8; }
    .badge.open .badge-dot { background: #1d4ed8; animation: blink 1.4s infinite; }
    .badge.in_progress { background: var(--yellow-soft); color: #92400e; }
    .badge.in_progress .badge-dot { background: var(--yellow); animation: blink 1.4s infinite; }
    .badge.closed      { background: var(--surface-2); color: var(--ink-2); }
    .badge.closed .badge-dot { background: var(--ink-3); }

    @keyframes blink { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.4;transform:scale(1.4)} }

    .hero-ts { font-size: 12px; color: var(--ink-3); }

    /* HERO BOTTOM — stat strip */
    .hero-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        divide-x: 1px solid var(--surface-3);
    }
    .hero-stat {
        padding: 16px 24px;
        border-right: 1px solid var(--surface-3);
    }
    .hero-stat:last-child { border-right: none; }
    .hero-stat-label { font-size: 11px; color: var(--ink-3); text-transform: uppercase; letter-spacing: .5px; margin-bottom: 4px; }
    .hero-stat-val   { font-size: 14px; font-weight: 600; color: var(--ink); }
    .hero-stat-val.mono { font-family: 'DM Mono', monospace; font-size: 13px; }
    @media (max-width: 640px) {
        .hero-stats { grid-template-columns: 1fr 1fr; }
        .hero-stat:nth-child(2) { border-right: none; }
        .hero-stat:nth-child(3) { border-top: 1px solid var(--surface-3); }
    }

    /* LAYOUT */
    .layout {
        display: grid;
        grid-template-columns: 1fr 300px;
        gap: 24px;
        align-items: start;
    }
    @media (max-width: 720px) {
        .layout { grid-template-columns: 1fr; }
    }

    .col-main { display: flex; flex-direction: column; gap: 20px; }
    .col-side  { display: flex; flex-direction: column; gap: 16px; }

    /* CARD */
    .card {
        background: var(--surface);
        border-radius: var(--radius);
        border: 1px solid var(--surface-3);
        box-shadow: var(--shadow);
        overflow: hidden;
    }
    .card-head {
        padding: 16px 22px;
        border-bottom: 1px solid var(--surface-3);
        display: flex; align-items: center; gap: 10px;
    }
    .card-head-ico {
        width: 30px; height: 30px;
        background: var(--accent-soft);
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
    }
    .card-head-ico svg { width: 14px; height: 14px; color: var(--accent); }
    .card-head-title { font-size: 13.5px; font-weight: 700; color: var(--ink); }
    .card-body { padding: 20px 22px; }

    /* FIELD */
    .field { margin-bottom: 20px; }
    .field:last-child { margin-bottom: 0; }
    .field-lbl {
        font-size: 11px; font-weight: 600;
        letter-spacing: .5px; text-transform: uppercase;
        color: var(--ink-3); margin-bottom: 7px;
    }
    .field-val { font-size: 14px; color: var(--ink); font-weight: 500; line-height: 1.6; }
    .field-val.desc {
        background: var(--surface-2);
        border-radius: var(--radius-sm);
        padding: 14px 16px;
        font-weight: 400; font-size: 13.5px;
        color: var(--ink-2); white-space: pre-line;
    }

    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media (max-width: 480px) { .field-row { grid-template-columns: 1fr; } }

    /* Pill tags */
    .pill {
        display: inline-flex; align-items: center;
        padding: 4px 13px; border-radius: 20px;
        font-size: 12.5px; font-weight: 600;
    }
    .pill.cat    { background: var(--accent-soft); color: var(--accent); }
    .pill.none   { background: var(--surface-2); color: var(--ink-3); }
    .pill.low    { background: var(--green-soft); color: #166534; }
    .pill.medium { background: var(--yellow-soft); color: #92400e; }
    .pill.high   { background: var(--red-soft); color: var(--red); }

    /* TIMELINE */
    .timeline { display: flex; flex-direction: column; }
    .tl-item  { display: flex; gap: 14px; position: relative; }
    .tl-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 15px; top: 33px; bottom: 0;
        width: 1.5px;
        background: var(--surface-3);
    }
    .tl-dot {
        width: 32px; height: 32px; flex-shrink: 0;
        border-radius: 50%; z-index: 1; position: relative;
        display: flex; align-items: center; justify-content: center;
    }
    .tl-dot svg { width: 14px; height: 14px; }
    .tl-dot.ok     { background: var(--green-soft); color: var(--green); }
    .tl-dot.active { background: var(--accent-soft); color: var(--accent); }
    .tl-dot.done   { background: var(--surface-2); color: var(--ink-3); }
    .tl-body { flex: 1; padding-bottom: 22px; padding-top: 5px; }
    .tl-title { font-size: 13px; font-weight: 600; color: var(--ink); }
    .tl-desc  { font-size: 12px; color: var(--ink-3); margin-top: 2px; line-height: 1.5; }
    .tl-time  { font-family: 'DM Mono', monospace; font-size: 11px; color: var(--ink-3); margin-top: 5px; }

    /* SIDEBAR META LIST */
    .meta-list { display: flex; flex-direction: column; }
    .meta-row {
        display: flex; align-items: center; justify-content: space-between;
        padding: 11px 0; gap: 12px;
        border-bottom: 1px solid var(--surface-3);
    }
    .meta-row:first-child { padding-top: 0; }
    .meta-row:last-child  { border-bottom: none; padding-bottom: 0; }
    .meta-k { font-size: 12px; color: var(--ink-3); flex-shrink: 0; }
    .meta-v { font-size: 12.5px; font-weight: 600; color: var(--ink); text-align: right; word-break: break-all; }

    /* ACTION BUTTONS */
    .actions { display: flex; flex-direction: column; gap: 10px; }
    .btn {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        padding: 11px 16px; border-radius: var(--radius-sm);
        font-size: 13px; font-weight: 600; font-family: 'Sora', sans-serif;
        text-decoration: none; border: none; cursor: pointer;
        transition: all .15s; width: 100%;
    }
    .btn svg { width: 15px; height: 15px; flex-shrink: 0; }
    .btn.accent {
        background: var(--accent); color: #fff;
        box-shadow: 0 4px 14px rgba(91,94,244,.3);
    }
    .btn.accent:hover { background: #4a4de3; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(91,94,244,.4); }
    .btn.outline {
        background: var(--surface); color: var(--ink-2);
        border: 1.5px solid var(--surface-3);
    }
    .btn.outline:hover { background: var(--surface-2); border-color: var(--ink-3); color: var(--ink); }

    /* HELP CARD */
    .help-card {
        border-radius: var(--radius);
        background: var(--accent-soft);
        border: 1px solid rgba(91,94,244,.15);
        padding: 20px;
    }
    .help-title { font-size: 13px; font-weight: 700; color: var(--accent); margin-bottom: 6px; }
    .help-text  { font-size: 12px; color: var(--ink-2); line-height: 1.6; margin-bottom: 14px; }
    .help-links { display: flex; flex-direction: column; gap: 8px; }
    .help-link {
        display: inline-flex; align-items: center; gap: 7px;
        font-size: 12px; font-weight: 600; color: var(--accent);
        text-decoration: none; padding: 8px 12px;
        background: var(--surface); border-radius: 8px;
        border: 1px solid rgba(91,94,244,.15);
        transition: background .15s;
    }
    .help-link:hover { background: #e5e5ff; }
    .help-link svg { width: 13px; height: 13px; }

    /* INFO STRIP */
    .info-strip {
        display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px;
        margin-top: 24px;
    }
    @media (max-width: 640px) { .info-strip { grid-template-columns: 1fr; } }
    .info-tile {
        background: var(--surface);
        border-radius: var(--radius);
        border: 1px solid var(--surface-3);
        padding: 18px 18px;
        display: flex; align-items: flex-start; gap: 12px;
        box-shadow: var(--shadow);
    }
    .info-tile-ico {
        width: 34px; height: 34px; flex-shrink: 0;
        border-radius: 9px;
        display: flex; align-items: center; justify-content: center;
    }
    .info-tile-ico svg { width: 16px; height: 16px; }
    .info-tile-ico.blue   { background: #dbeafe; color: #2563eb; }
    .info-tile-ico.purple { background: #ede9fe; color: #7c3aed; }
    .info-tile-ico.green  { background: var(--green-soft); color: #16a34a; }
    .info-tile-title { font-size: 13px; font-weight: 700; color: var(--ink); margin-bottom: 3px; }
    .info-tile-text  { font-size: 12px; color: var(--ink-3); line-height: 1.5; }

    /* ANIMATIONS */
    @keyframes up {
        from { opacity:0; transform:translateY(18px); }
        to   { opacity:1; transform:translateY(0); }
    }
    .hero    { animation: up .38s .04s ease both; }
    .layout  { animation: up .38s .1s ease both; }
    .info-strip { animation: up .38s .18s ease both; }
</style>

@php
    $sk   = strtolower($ticket->status);
    $slbl = ['open'=>'Open','in_progress'=>'In Progress','closed'=>'Closed'][$sk] ?? ucfirst($sk);
    $sico = [
        'open'        => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
        'in_progress' => 'M13 10V3L4 14h7v7l9-11h-7z',
        'closed'      => 'M6 18L18 6M6 6l12 12',
    ][$sk] ?? 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z';
    $pmap = [
        'low'    => ['cls'=>'low',    'lbl'=>'Low'],
        'medium' => ['cls'=>'medium', 'lbl'=>'Medium'],
        'high'   => ['cls'=>'high',   'lbl'=>'High'],
    ];
    $pri = $pmap[$ticket->priority] ?? $pmap['medium'];
@endphp

<div class="page">

    {{-- Breadcrumb --}}
    <div class="breadcrumb">
        <a href="{{ route('user.home') }}">Beranda</a>
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span>Lacak Tiket</span>
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
        <span class="cur">{{ $ticket->ticket_code }}</span>
    </div>

    {{-- Hero card --}}
    <div class="hero">
        <div class="hero-top">
            <div class="hero-left">
                <div class="status-ring {{ $sk }}">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sico }}"/>
                    </svg>
                </div>
                <div>
                    <p class="hero-code">{{ $ticket->ticket_code }}</p>
                    <p class="hero-title">{{ $ticket->title }}</p>
                </div>
            </div>
            <div class="hero-right">
                <span class="badge {{ $sk }}">
                    <span class="badge-dot"></span>{{ $slbl }}
                </span>
                <span class="hero-ts">Diperbarui {{ $ticket->updated_at->format('d M Y, H:i') }}</span>
            </div>
        </div>
        <div class="hero-stats">
            <div class="hero-stat">
                <div class="hero-stat-label">Pelapor</div>
                <div class="hero-stat-val">{{ $ticket->client_name }}</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-label">Prioritas</div>
                <div class="hero-stat-val">{{ $pri['lbl'] }}</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-label">Dibuat</div>
                <div class="hero-stat-val mono">{{ $ticket->created_at->format('d M Y') }}</div>
            </div>
            <div class="hero-stat">
                <div class="hero-stat-label">Kategori</div>
                <div class="hero-stat-val">{{ $ticket->category ? $ticket->category->category_name : '—' }}</div>
            </div>
        </div>
    </div>

    {{-- Main layout --}}
    <div class="layout">

        {{-- Left: detail + timeline --}}
        <div class="col-main">

            <div class="card">
                <div class="card-head">
                    <div class="card-head-ico">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                    </div>
                    <span class="card-head-title">Detail Tiket</span>
                </div>
                <div class="card-body">
                    <div class="field">
                        <div class="field-lbl">Judul Laporan</div>
                        <div class="field-val">{{ $ticket->title }}</div>
                    </div>
                    <div class="field-row field">
                        <div>
                            <div class="field-lbl">Kategori</div>
                            @if($ticket->category)
                                <span class="pill cat">{{ $ticket->category->category_name }}</span>
                            @else
                                <span class="pill none">Tidak ada</span>
                            @endif
                        </div>
                        <div>
                            <div class="field-lbl">Prioritas</div>
                            <span class="pill {{ $pri['cls'] }}">{{ $pri['lbl'] }}</span>
                        </div>
                    </div>
                    <div class="field">
                        <div class="field-lbl">Deskripsi Masalah</div>
                        <div class="field-val desc">{{ $ticket->description }}</div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-head">
                    <div class="card-head-ico">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="card-head-title">Riwayat Status</span>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="tl-item">
                            <div class="tl-dot ok">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <div class="tl-body">
                                <div class="tl-title">Tiket Dibuat</div>
                                <div class="tl-desc">Tiket masuk ke sistem dan menunggu penanganan tim support</div>
                                <div class="tl-time">{{ $ticket->created_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        <div class="tl-item">
                            <div class="tl-dot {{ $sk === 'closed' ? 'done' : 'active' }}">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $sico }}"/>
                                </svg>
                            </div>
                            <div class="tl-body">
                                <div class="tl-title">Status: {{ $slbl }}</div>
                                <div class="tl-desc">
                                    @if($sk === 'open') Menunggu ditangani oleh tim support
                                    @elseif($sk === 'in_progress') Tim sedang menganalisis dan mengerjakan solusi
                                    @else Tiket telah diselesaikan dan ditutup
                                    @endif
                                </div>
                                <div class="tl-time">{{ $ticket->updated_at->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Right: sidebar --}}
        <div class="col-side">

            <div class="card">
                <div class="card-head">
                    <div class="card-head-ico">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <span class="card-head-title">Pelapor</span>
                </div>
                <div class="card-body">
                    <div class="meta-list">
                        <div class="meta-row">
                            <span class="meta-k">Nama</span>
                            <span class="meta-v">{{ $ticket->client_name }}</span>
                        </div>
                        <div class="meta-row">
                            <span class="meta-k">Email</span>
                            <span class="meta-v" style="font-size:11.5px;">{{ $ticket->client_email }}</span>
                        </div>
                        <div class="meta-row">
                            <span class="meta-k">Tanggal</span>
                            <span class="meta-v" style="font-family:'DM Mono',monospace;font-size:11.5px;">{{ $ticket->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-head">
                    <div class="card-head-ico">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                        </svg>
                    </div>
                    <span class="card-head-title">Aksi</span>
                </div>
                <div class="card-body">
                    <div class="actions">
                        <a href="{{ route('user.home') }}" class="btn accent">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                            </svg>
                            Buat Tiket Baru
                        </a>
                        <a href="{{ route('user.home') }}" class="btn outline">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>

            <div class="help-card">
                <div class="help-title">💬 Butuh Bantuan?</div>
                <div class="help-text">Tim kami siap membantu. Hubungi kami jika ada pertanyaan lebih lanjut seputar tiket Anda.</div>
                <div class="help-links">
                    <a href="mailto:support@helpdesk.com" class="help-link">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        support@helpdesk.com
                    </a>
                    <a href="tel:+622112345678" class="help-link">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/>
                        </svg>
                        (021) 1234-5678
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- Info strip --}}
    <div class="info-strip">
        <div class="info-tile">
            <div class="info-tile-ico blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div>
                <div class="info-tile-title">Respons Cepat</div>
                <div class="info-tile-text">Tim kami merespons dalam waktu kurang dari 24 jam</div>
            </div>
        </div>
        <div class="info-tile">
            <div class="info-tile-ico purple">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
            </div>
            <div>
                <div class="info-tile-title">Notifikasi Email</div>
                <div class="info-tile-text">Update status tiket dikirim langsung ke email Anda</div>
            </div>
        </div>
        <div class="info-tile">
            <div class="info-tile-ico green">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <div>
                <div class="info-tile-title">Data Aman</div>
                <div class="info-tile-text">Semua informasi Anda dilindungi enkripsi SSL</div>
            </div>
        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function(){
    @if(session('success'))
        if(window.Toast) Toast.fire({ icon:'success', title:'{{ addslashes(session('success')) }}' });
    @endif
});
</script>
@endsection
