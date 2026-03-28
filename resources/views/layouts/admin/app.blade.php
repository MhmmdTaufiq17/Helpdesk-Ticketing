<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — Admin Helpdesk</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    {{-- NProgress --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css">
    {{-- Load NProgress di head + start SEGERA agar spinner muncul dari awal --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.js"></script>
    <script>
        NProgress.configure({ showSpinner: true, trickleSpeed: 200, minimum: 0.1 });
        NProgress.start();
    </script>

    <style>
        *, *::before, *::after { box-sizing: border-box; }

        :root {
            /* Colors */
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
            --green-soft: #dcfce7;
            --red:        #ef4444;
            --red-soft:   #fee2e2;
            --yellow:     #f59e0b;
            --yellow-soft:#fef3c7;
            --blue:       #3b82f6;
            --blue-soft:  #dbeafe;

            /* Layout */
            --sidebar-w:  240px;
            --topbar-h:   60px;
            --radius:     14px;
            --radius-sm:  9px;
            --radius-xs:  6px;

            /* Shadows */
            --shadow-sm:  0 1px 4px rgba(0,0,0,.07);
            --shadow:     0 4px 16px rgba(0,0,0,.09);
            --shadow-lg:  0 12px 40px rgba(0,0,0,.12), 0 4px 12px rgba(0,0,0,.06);
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Sora', sans-serif;
            background: var(--surface-2);
            color: var(--ink);
            margin: 0;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        /* ─── NProgress — Spinner tengah (sama seperti user layout) ─── */
        #nprogress .bar {
            display: none !important;
        }

        #nprogress {
            background: rgba(255, 255, 255, 0.92) !important;
            backdrop-filter: blur(4px);
            position: fixed !important;
            top: 0 !important; left: 0 !important;
            width: 100% !important; height: 100% !important;
            z-index: 9998 !important;
        }

        #nprogress .spinner {
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            position: fixed !important;
            z-index: 9999 !important;
        }

        #nprogress .spinner-icon {
            width: 48px !important;
            height: 48px !important;
            border-width: 4px !important;
            border-top-color: var(--accent) !important;
            border-left-color: var(--accent) !important;
        }

        /* ─── Content fade-in ─── */
        .main-wrapper {
            animation: contentFadeIn .4s ease both;
        }
        @keyframes contentFadeIn {
            from { opacity: 0; transform: translateY(6px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* Stat cards stagger */
        .stat-card:nth-child(1) { animation: contentFadeIn .4s .05s ease both; }
        .stat-card:nth-child(2) { animation: contentFadeIn .4s .10s ease both; }
        .stat-card:nth-child(3) { animation: contentFadeIn .4s .15s ease both; }
        .stat-card:nth-child(4) { animation: contentFadeIn .4s .20s ease both; }

        /* ─── SIDEBAR ─── */
        .sidebar {
            position: fixed;
            top: 0; left: 0; bottom: 0;
            width: var(--sidebar-w);
            background: var(--ink);
            display: flex;
            flex-direction: column;
            z-index: 200;
            transition: transform .25s cubic-bezier(.4,0,.2,1);
        }

        /* Logo */
        .sidebar-logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 20px;
            height: var(--topbar-h);
            text-decoration: none;
            border-bottom: 1px solid rgba(255,255,255,.07);
            flex-shrink: 0;
        }
        .sidebar-logo-icon {
            width: 32px; height: 32px;
            background: var(--accent);
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
            box-shadow: 0 2px 8px rgba(91,94,244,.45);
        }
        .sidebar-logo-icon svg { width: 16px; height: 16px; color: #fff; }
        .sidebar-logo-text {
            font-size: 14px; font-weight: 700;
            color: #fff; letter-spacing: -.3px;
        }
        .sidebar-logo-badge {
            font-size: 10px; font-weight: 600;
            background: rgba(91,94,244,.35);
            color: var(--accent-2);
            padding: 2px 7px; border-radius: 20px;
            margin-left: auto;
        }

        /* Nav */
        .sidebar-nav {
            flex: 1;
            overflow-y: auto;
            padding: 12px 12px 8px;
            scrollbar-width: none;
        }
        .sidebar-nav::-webkit-scrollbar { display: none; }

        .sidebar-section-label {
            font-size: 10.5px; font-weight: 600;
            color: rgba(255,255,255,.3);
            letter-spacing: .8px; text-transform: uppercase;
            padding: 16px 8px 6px;
        }
        .sidebar-section-label:first-child { padding-top: 4px; }

        .sidebar-link {
            display: flex; align-items: center; gap: 10px;
            padding: 9px 10px;
            border-radius: var(--radius-sm);
            text-decoration: none;
            font-size: 13.5px; font-weight: 500;
            color: rgba(255,255,255,.55);
            transition: background .15s, color .15s;
            position: relative;
        }
        .sidebar-link svg { width: 16px; height: 16px; flex-shrink: 0; }
        .sidebar-link:hover { background: rgba(255,255,255,.07); color: rgba(255,255,255,.9); }
        .sidebar-link.active {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 2px 10px rgba(91,94,244,.4);
        }
        .sidebar-link.active svg { opacity: 1; }

        .sidebar-badge {
            margin-left: auto;
            background: var(--red);
            color: #fff;
            font-size: 10px; font-weight: 700;
            min-width: 18px; height: 18px;
            border-radius: 9px;
            display: flex; align-items: center; justify-content: center;
            padding: 0 5px;
        }
        .sidebar-badge.yellow { background: var(--yellow); color: var(--ink); }

        /* User card at bottom */
        .sidebar-user {
            padding: 12px;
            border-top: 1px solid rgba(255,255,255,.07);
            flex-shrink: 0;
        }
        .sidebar-user-card {
            display: flex; align-items: center; gap: 10px;
            padding: 10px;
            border-radius: var(--radius-sm);
            background: rgba(255,255,255,.06);
        }
        .sidebar-avatar {
            width: 32px; height: 32px;
            background: var(--accent);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: #fff;
            flex-shrink: 0;
        }
        .sidebar-user-info { flex: 1; min-width: 0; }
        .sidebar-user-name {
            font-size: 12.5px; font-weight: 600; color: rgba(255,255,255,.9);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-user-role {
            font-size: 11px; color: rgba(255,255,255,.35);
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .sidebar-logout {
            width: 28px; height: 28px;
            border-radius: 7px;
            background: none; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: rgba(255,255,255,.35);
            transition: background .15s, color .15s;
            flex-shrink: 0;
        }
        .sidebar-logout:hover { background: rgba(239,68,68,.2); color: var(--red); }
        .sidebar-logout svg { width: 14px; height: 14px; }

        /* ─── TOPBAR ─── */
        .topbar {
            position: fixed;
            top: 0;
            left: var(--sidebar-w);
            right: 0;
            height: var(--topbar-h);
            background: rgba(255,255,255,.9);
            backdrop-filter: blur(20px) saturate(160%);
            -webkit-backdrop-filter: blur(20px) saturate(160%);
            border-bottom: 1px solid var(--surface-3);
            display: flex; align-items: center;
            padding: 0 24px;
            gap: 14px;
            z-index: 100;
        }

        .topbar-hamburger {
            display: none;
            background: none; border: none; cursor: pointer;
            padding: 6px; border-radius: 8px;
            color: var(--ink-2);
        }
        .topbar-hamburger:hover { background: var(--surface-2); }
        .topbar-hamburger svg { width: 18px; height: 18px; display: block; }

        .topbar-breadcrumb {
            display: flex; align-items: center; gap: 6px;
            font-size: 13px; color: var(--ink-3);
        }
        .topbar-breadcrumb a {
            color: var(--ink-3); text-decoration: none;
            transition: color .15s;
        }
        .topbar-breadcrumb a:hover { color: var(--accent); }
        .topbar-breadcrumb-sep { font-size: 11px; opacity: .5; }
        .topbar-breadcrumb-current { color: var(--ink); font-weight: 600; }

        .topbar-spacer { flex: 1; }

        /* Topbar search */
        .topbar-search {
            display: flex; align-items: center; gap: 6px;
            background: var(--surface-2);
            border: 1.5px solid var(--surface-3);
            border-radius: 10px;
            padding: 0 12px;
            width: 240px;
            transition: border-color .2s, box-shadow .2s;
        }
        .topbar-search:focus-within {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(91,94,244,.1);
            background: var(--surface);
        }
        .topbar-search svg { width: 14px; height: 14px; color: var(--ink-3); flex-shrink: 0; }
        .topbar-search input {
            flex: 1; border: none; background: transparent;
            font-family: 'Sora', sans-serif; font-size: 13px;
            color: var(--ink); padding: 8px 0; outline: none;
        }
        .topbar-search input::placeholder { color: var(--ink-3); }

        /* Topbar actions */
        .topbar-actions { display: flex; align-items: center; gap: 4px; }

        .topbar-btn {
            width: 34px; height: 34px;
            border-radius: 9px;
            background: none; border: none; cursor: pointer;
            display: flex; align-items: center; justify-content: center;
            color: var(--ink-2);
            transition: background .15s, color .15s;
            position: relative;
        }
        .topbar-btn:hover { background: var(--surface-2); color: var(--accent); }
        .topbar-btn svg { width: 17px; height: 17px; }
        .topbar-btn-dot {
            position: absolute; top: 6px; right: 6px;
            width: 7px; height: 7px;
            background: var(--red); border-radius: 50%;
            border: 1.5px solid var(--surface);
        }

        .topbar-divider {
            width: 1px; height: 20px;
            background: var(--surface-3);
            margin: 0 4px;
        }

        /* Admin profile chip */
        .topbar-profile {
            display: flex; align-items: center; gap: 8px;
            padding: 4px 10px 4px 6px;
            border-radius: 10px; cursor: pointer;
            transition: background .15s;
            border: none; background: none;
        }
        .topbar-profile:hover { background: var(--surface-2); }
        .topbar-profile-avatar {
            width: 28px; height: 28px;
            background: var(--accent);
            border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 11px; font-weight: 700; color: #fff;
        }
        .topbar-profile-name { font-size: 13px; font-weight: 600; color: var(--ink); }
        .topbar-profile svg { width: 13px; height: 13px; color: var(--ink-3); }

        /* ─── MAIN CONTENT ─── */
        .main-wrapper {
            margin-left: var(--sidebar-w);
            padding-top: var(--topbar-h);
            min-height: 100vh;
        }
        .main-content {
            padding: 28px 28px 48px;
            max-width: 1400px;
        }

        /* ─── PAGE HEADER ─── */
        .page-header {
            display: flex; align-items: flex-start;
            justify-content: space-between;
            gap: 16px;
            margin-bottom: 24px;
        }
        .page-header-left { flex: 1; min-width: 0; }
        .page-title {
            font-size: 22px; font-weight: 700;
            color: var(--ink); letter-spacing: -.4px;
            margin: 0 0 4px;
        }
        .page-subtitle { font-size: 13px; color: var(--ink-3); margin: 0; }
        .page-header-actions { display: flex; gap: 8px; flex-shrink: 0; }

        /* ─── CARDS ─── */
        .card {
            background: var(--surface);
            border-radius: var(--radius);
            border: 1px solid var(--surface-3);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }
        .card-header {
            display: flex; align-items: center; justify-content: space-between;
            padding: 16px 20px;
            border-bottom: 1px solid var(--surface-3);
        }
        .card-title { font-size: 14px; font-weight: 700; color: var(--ink); margin: 0; }
        .card-subtitle { font-size: 12px; color: var(--ink-3); margin: 4px 0 0; }
        .card-body { padding: 20px; }
        .card-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--surface-3);
            background: var(--surface-2);
        }

        /* ─── BUTTONS ─── */
        .btn {
            display: inline-flex; align-items: center; gap: 6px;
            padding: 8px 16px;
            border-radius: var(--radius-sm);
            font-family: 'Sora', sans-serif;
            font-size: 13px; font-weight: 600;
            cursor: pointer; border: none;
            text-decoration: none;
            transition: all .15s;
            white-space: nowrap;
        }
        .btn svg { width: 14px; height: 14px; }
        .btn-primary { background: var(--accent); color: #fff; }
        .btn-primary:hover { background: #4a4de3; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(91,94,244,.35); }
        .btn-secondary { background: var(--surface-2); color: var(--ink-2); border: 1.5px solid var(--surface-3); }
        .btn-secondary:hover { background: var(--surface-3); color: var(--ink); }
        .btn-danger { background: var(--red); color: #fff; }
        .btn-danger:hover { background: #dc2626; transform: translateY(-1px); }
        .btn-success { background: var(--green); color: #fff; }
        .btn-success:hover { background: #16a34a; }
        .btn-sm { padding: 5px 11px; font-size: 12px; }
        .btn-sm svg { width: 12px; height: 12px; }
        .btn-lg { padding: 11px 22px; font-size: 14px; }
        .btn:disabled { opacity: .55; cursor: not-allowed; transform: none !important; box-shadow: none !important; }

        /* ─── BADGE / PILL ─── */
        .badge {
            display: inline-flex; align-items: center; gap: 4px;
            padding: 3px 9px;
            border-radius: 20px;
            font-size: 11.5px; font-weight: 600;
        }
        .badge-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            flex-shrink: 0;
        }
        .badge-open    { background: var(--blue-soft);   color: var(--blue); }
        .badge-progress{ background: var(--yellow-soft); color: #b45309; }
        .badge-closed  { background: var(--green-soft);  color: #15803d; }
        .badge-high    { background: var(--red-soft);    color: var(--red); }
        .badge-medium  { background: var(--yellow-soft); color: #b45309; }
        .badge-low     { background: var(--green-soft);  color: #15803d; }

        /* ─── TABLE ─── */
        .table-wrap { overflow-x: auto; }
        .table {
            width: 100%; border-collapse: collapse;
            font-size: 13px;
        }
        .table th {
            text-align: left;
            padding: 10px 16px;
            font-size: 11px; font-weight: 600;
            color: var(--ink-3);
            text-transform: uppercase; letter-spacing: .6px;
            border-bottom: 1px solid var(--surface-3);
            white-space: nowrap;
        }
        .table td {
            padding: 13px 16px;
            border-bottom: 1px solid var(--surface-3);
            vertical-align: middle;
        }
        .table tr:last-child td { border-bottom: none; }
        .table tbody tr { transition: background .1s; }
        .table tbody tr:hover { background: var(--surface-2); }

        /* ─── FORMS ─── */
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            font-size: 12.5px; font-weight: 600; color: var(--ink-2);
            margin-bottom: 6px;
        }
        .form-label .req { color: var(--red); margin-left: 2px; }
        .form-control {
            width: 100%;
            border: 1.5px solid var(--surface-3);
            border-radius: var(--radius-sm);
            padding: 9px 12px;
            font-family: 'Sora', sans-serif;
            font-size: 13px; color: var(--ink);
            background: var(--surface);
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }
        .form-control:focus {
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(91,94,244,.1);
        }
        .form-control::placeholder { color: var(--ink-3); }
        .form-control.is-invalid { border-color: var(--red); }
        .form-control.is-invalid:focus { box-shadow: 0 0 0 3px rgba(239,68,68,.1); }
        textarea.form-control { resize: vertical; min-height: 100px; }
        select.form-control { cursor: pointer; }
        .form-hint { font-size: 11.5px; color: var(--ink-3); margin-top: 5px; }
        .form-error { font-size: 11.5px; color: var(--red); margin-top: 5px; }
        .invalid-feedback { font-size: 11.5px; color: var(--red); margin-top: 5px; display: block; }

        /* ─── ALERTS ─── */
        .alert {
            display: flex; align-items: flex-start; gap: 10px;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            font-size: 13px; font-weight: 500;
            margin-bottom: 18px;
        }
        .alert svg { width: 16px; height: 16px; flex-shrink: 0; margin-top: 1px; }
        .alert-success { background: var(--green-soft);  color: #15803d;  border: 1px solid #bbf7d0; }
        .alert-danger   { background: var(--red-soft);   color: #b91c1c;  border: 1px solid #fecaca; }
        .alert-warning  { background: var(--yellow-soft);color: #b45309;  border: 1px solid #fde68a; }
        .alert-info     { background: var(--blue-soft);  color: #1d4ed8;  border: 1px solid #bfdbfe; }

        /* ─── STAT CARDS ─── */
        .stat-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 16px;
            margin-bottom: 24px;
        }
        .stat-card {
            background: var(--surface);
            border: 1px solid var(--surface-3);
            border-radius: var(--radius);
            padding: 18px 20px;
            display: flex; flex-direction: column; gap: 12px;
            box-shadow: var(--shadow-sm);
            transition: box-shadow .2s;
        }
        .stat-card:hover { box-shadow: var(--shadow); }
        .stat-card-top { display: flex; align-items: center; justify-content: space-between; }
        .stat-card-label { font-size: 12px; font-weight: 600; color: var(--ink-3); text-transform: uppercase; letter-spacing: .5px; }
        .stat-card-icon {
            width: 36px; height: 36px;
            border-radius: 10px;
            display: flex; align-items: center; justify-content: center;
        }
        .stat-card-icon svg { width: 18px; height: 18px; }
        .stat-card-icon.blue   { background: var(--blue-soft);   color: var(--blue); }
        .stat-card-icon.green  { background: var(--green-soft);  color: var(--green); }
        .stat-card-icon.yellow { background: var(--yellow-soft); color: var(--yellow); }
        .stat-card-icon.purple { background: var(--accent-soft); color: var(--accent); }
        .stat-card-icon.red    { background: var(--red-soft);    color: var(--red); }
        .stat-card-value { font-size: 28px; font-weight: 800; color: var(--ink); letter-spacing: -1px; line-height: 1; }
        .stat-card-change { font-size: 12px; color: var(--ink-3); display: flex; align-items: center; gap: 4px; }
        .stat-card-change.up   { color: var(--green); }
        .stat-card-change.down { color: var(--red); }

        /* ─── RESPONSIVE / MOBILE ─── */
        .sidebar-overlay {
            display: none;
            position: fixed; inset: 0;
            background: rgba(0,0,0,.45);
            z-index: 190;
        }
        .sidebar-overlay.visible { display: block; }

        @media (max-width: 1024px) {
            .sidebar { transform: translateX(-100%); }
            .sidebar.open { transform: translateX(0); }
            .topbar { left: 0; }
            .topbar-hamburger { display: flex; }
            .topbar-search { width: 180px; }
            .main-wrapper { margin-left: 0; }
        }

        @media (max-width: 640px) {
            .topbar-search { display: none; }
            .main-content { padding: 18px 16px 40px; }
            .stat-grid { grid-template-columns: repeat(2, 1fr); }
            .page-header { flex-direction: column; }
            .page-header-actions { width: 100%; }
            .page-header-actions .btn { flex: 1; justify-content: center; }
        }

        /* ─── UTILS ─── */
        .mono { font-family: 'DM Mono', monospace; }
        .text-truncate { overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .d-flex { display: flex; }
        .align-center { align-items: center; }
        .gap-2 { gap: 8px; }
        .gap-3 { gap: 12px; }
        .mt-1 { margin-top: 4px; }
        .mt-2 { margin-top: 8px; }
        .mt-3 { margin-top: 12px; }
        .mt-4 { margin-top: 16px; }
        .mb-0 { margin-bottom: 0; }
        .w-full { width: 100%; }
    </style>

    @stack('styles')
</head>
<body>

{{-- ── Sidebar Overlay (mobile) ── --}}
<div class="sidebar-overlay" id="sidebarOverlay"></div>

{{-- ── SIDEBAR ── --}}
<aside class="sidebar" id="sidebar">

    {{-- Logo --}}
    <a href="{{ route('admin.dashboard') }}" class="sidebar-logo">
        <div class="sidebar-logo-icon">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
            </svg>
        </div>
        <span class="sidebar-logo-text">Helpdesk</span>
        <span class="sidebar-logo-badge">Admin</span>
    </a>

    {{-- Navigation --}}
    <nav class="sidebar-nav">

        <div class="sidebar-section-label">Main</div>

        <a href="{{ route('admin.dashboard') }}"
           class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"/>
            </svg>
            Dashboard
        </a>

        <div class="sidebar-section-label">Tiket</div>

        <a href="{{ route('admin.tickets.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.tickets.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
            </svg>
            Semua Tiket
            @php $openCount = \App\Models\Ticket::where('status','open')->count(); @endphp
            @if($openCount > 0)
                <span class="sidebar-badge">{{ $openCount > 99 ? '99+' : $openCount }}</span>
            @endif
        </a>

        <a href="{{ route('admin.tickets.index', ['status' => 'open']) }}"
           class="sidebar-link {{ request()->is('admin/tickets*') && request('status') === 'open' ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Tiket Open
        </a>

        <a href="{{ route('admin.tickets.index', ['status' => 'in_progress']) }}"
           class="sidebar-link {{ request()->is('admin/tickets*') && request('status') === 'in_progress' ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            In Progress
        </a>

        <a href="{{ route('admin.tickets.index', ['status' => 'closed']) }}"
           class="sidebar-link {{ request()->is('admin/tickets*') && request('status') === 'closed' ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            Closed
        </a>

        <div class="sidebar-section-label">Laporan</div>

        <a href="{{ route('admin.reports.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
            </svg>
            Statistik & Grafik
        </a>

        <a href="{{ route('admin.reports.export') }}"
           class="sidebar-link {{ request()->routeIs('admin.reports.export') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            Ekspor Data
        </a>

        <div class="sidebar-section-label">Pengaturan</div>

        <a href="{{ route('admin.profile.edit') }}"
           class="sidebar-link {{ request()->routeIs('admin.profile.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
            </svg>
            Profil Admin
        </a>

        <a href="{{ route('admin.settings.index') }}"
           class="sidebar-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Pengaturan
        </a>

    </nav>

    {{-- User info at bottom --}}
    <div class="sidebar-user">
        <div class="sidebar-user-card">
            <div class="sidebar-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <div class="sidebar-user-info">
                <div class="sidebar-user-name">{{ auth()->user()->name ?? 'Admin' }}</div>
                <div class="sidebar-user-role">Administrator</div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}" style="margin:0">
                @csrf
                <button type="submit" class="sidebar-logout" title="Logout">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </div>

</aside>

{{-- ── TOPBAR ── --}}
<header class="topbar">

    <button class="topbar-hamburger" id="hamburgerBtn" aria-label="Toggle sidebar">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
        </svg>
    </button>

    <nav class="topbar-breadcrumb">
        <a href="{{ route('admin.dashboard') }}">Admin</a>
        <span class="topbar-breadcrumb-sep">›</span>
        <span class="topbar-breadcrumb-current">@yield('breadcrumb', 'Dashboard')</span>
    </nav>

    <div class="topbar-spacer"></div>

    <div class="topbar-search">
        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
        </svg>
        <input type="text" placeholder="Cari tiket… mis. TKT-001"
               id="adminQuickSearch" autocomplete="off" spellcheck="false">
    </div>

    <div class="topbar-actions">
        <button class="topbar-btn" title="Notifikasi" id="notifBtn">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
            </svg>
            <span class="topbar-btn-dot" id="notifDot" style="display:none"></span>
        </button>

        <div class="topbar-divider"></div>

        <button class="topbar-profile" id="profileBtn">
            <div class="topbar-profile-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
            </div>
            <span class="topbar-profile-name">{{ auth()->user()->name ?? 'Admin' }}</span>
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
    </div>
</header>

{{-- ── MAIN CONTENT ── --}}
<div class="main-wrapper">
    <div class="main-content">

        @if(session('success'))
            <div class="alert alert-success" role="alert">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger" role="alert">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                {{ session('error') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning" role="alert">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
                {{ session('warning') }}
            </div>
        @endif

        @yield('content')

    </div>
</div>

{{-- ── Scripts ── --}}
<script>
    // Done hanya setelah SEMUA aset (css, js, gambar, font, CDN scripts) selesai dimuat
    window.addEventListener('load', function () {
        requestAnimationFrame(function () {
            NProgress.done();
        });
    });

    // Start on navigation click
    document.addEventListener('click', function (e) {
        var target = e.target.closest('a');
        if (target && target.href && !target.target &&
            !target.href.startsWith('javascript') &&
            !target.href.startsWith('#') &&
            !e.ctrlKey && !e.metaKey && !e.shiftKey) {
            NProgress.start();
        }
    });

    // Start on form submit
    document.addEventListener('submit', function () {
        NProgress.start();
    });

    // ── Sidebar toggle (mobile) ──
    var sidebar   = document.getElementById('sidebar');
    var overlay   = document.getElementById('sidebarOverlay');
    var hamburger = document.getElementById('hamburgerBtn');

    function openSidebar()  { sidebar.classList.add('open'); overlay.classList.add('visible'); document.body.style.overflow = 'hidden'; }
    function closeSidebar() { sidebar.classList.remove('open'); overlay.classList.remove('visible'); document.body.style.overflow = ''; }

    hamburger.addEventListener('click', function () {
        sidebar.classList.contains('open') ? closeSidebar() : openSidebar();
    });
    overlay.addEventListener('click', closeSidebar);

    // ── Quick search ──
    var qs = document.getElementById('adminQuickSearch');
    if (qs) {
        qs.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                var val = qs.value.trim().toUpperCase();
                if (val) {
                    NProgress.start();
                    window.location.href = '{{ route("admin.tickets.search") }}?q=' + encodeURIComponent(val);
                }
            }''
        });
    }

    // ── Notification dot ──
    @php $openTickets = \App\Models\Ticket::where('status','open')->count(); @endphp
    @if($openTickets > 0)
        document.getElementById('notifDot').style.display = 'block';
    @endif
</script>

@stack('scripts')

</body>
</html>
