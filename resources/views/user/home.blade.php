@extends('layouts.app')

@section('title', 'Buat Tiket Baru')

@section('content')
{{--
    [FIX #4 — Stored XSS]
    Seluruh output data dari user/DB menggunakan {{ }} yang auto-escape HTML.
    JANGAN pernah gunakan {!! !!} untuk data yang berasal dari input user.
    Perubahan dari versi sebelumnya ditandai komentar "FIXED".
--}}

<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<style>
    :root {
        --ink:         #0f0f12;
        --ink-2:       #3a3a4a;
        --ink-3:       #8a8a9a;
        --surface:     #ffffff;
        --surface-2:   #f5f5f7;
        --surface-3:   #ebebef;
        --accent:      #5b5ef4;
        --accent-soft: #eeeeff;
        --green:       #22c55e;
        --green-soft:  #f0fdf4;
        --red:         #ef4444;
        --red-soft:    #fff5f5;
        --yellow:      #f59e0b;
        --radius:      14px;
        --radius-sm:   9px;
    }

    .page-wrap {
        min-height: calc(100vh - 64px);
        display: grid;
        grid-template-columns: 1fr 420px;
        max-width: 1080px;
        margin: 0 auto;
        padding: 48px 24px 64px;
        gap: 48px;
        align-items: start;
    }
    @media (max-width: 860px) {
        .page-wrap { grid-template-columns: 1fr; }
        .page-sidebar { order: -1; }
    }

    .form-card {
        background: var(--surface);
        border-radius: 20px;
        box-shadow: 0 2px 1px rgba(0,0,0,.03), 0 8px 32px rgba(0,0,0,.06);
        overflow: hidden;
    }
    .form-header {
        padding: 32px 36px 28px;
        border-bottom: 1px solid var(--surface-3);
        display: flex; align-items: center; gap: 16px;
    }
    .form-header-icon {
        width: 46px; height: 46px;
        background: var(--accent-soft); border-radius: 13px;
        display: flex; align-items: center; justify-content: center; flex-shrink: 0;
    }
    .form-header-icon svg { width: 22px; height: 22px; color: var(--accent); }
    .form-header-title { font-size: 20px; font-weight: 700; color: var(--ink); letter-spacing: -.4px; margin: 0 0 3px; }
    .form-header-sub   { font-size: 13px; color: var(--ink-3); margin: 0; }

    .form-body { padding: 32px 36px; }

    .alert-errors {
        background: var(--red-soft);
        border: 1px solid rgba(239,68,68,.2);
        border-radius: var(--radius-sm);
        padding: 14px 16px; margin-bottom: 28px;
        display: flex; gap: 12px; align-items: flex-start;
    }
    .alert-errors svg { width: 18px; height: 18px; color: var(--red); flex-shrink: 0; margin-top: 1px; }
    .alert-errors-text { font-size: 13px; color: var(--red); }
    .alert-errors-text strong { display: block; margin-bottom: 6px; font-weight: 600; }
    .alert-errors-text ul { margin: 0; padding-left: 16px; }
    .alert-errors-text li + li { margin-top: 3px; }

    .field { margin-bottom: 22px; }
    .field-label {
        display: flex; align-items: center; gap: 7px;
        font-size: 13px; font-weight: 600; color: var(--ink-2); margin-bottom: 8px;
    }
    .field-label svg { width: 14px; height: 14px; color: var(--accent); }
    .field-label .req { color: var(--red); }
    .field-label .opt { font-weight: 400; color: var(--ink-3); font-size: 11.5px; margin-left: 2px; }

    .field-input,
    .field-select,
    .field-textarea {
        width: 100%;
        background: var(--surface-2);
        border: 1.5px solid transparent;
        border-radius: var(--radius-sm);
        padding: 11px 14px;
        font-size: 14px; font-family: 'Sora', sans-serif; color: var(--ink);
        transition: border-color .2s, background .2s, box-shadow .2s;
        outline: none; -webkit-appearance: none;
    }
    .field-input::placeholder,
    .field-textarea::placeholder { color: var(--ink-3); }
    .field-input:focus,
    .field-select:focus,
    .field-textarea:focus {
        background: var(--surface);
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(91,94,244,.1);
    }
    .field-input.error,
    .field-select.error,
    .field-textarea.error { border-color: var(--red); background: var(--red-soft); }

    .field-select {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%238a8a9a' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 14px center;
        padding-right: 38px; cursor: pointer;
    }
    .field-textarea { resize: vertical; min-height: 130px; line-height: 1.6; }

    .field-hint {
        margin-top: 6px; font-size: 12px; color: var(--ink-3);
        display: flex; align-items: center; gap: 5px;
    }
    .field-hint svg { width: 12px; height: 12px; flex-shrink: 0; }
    .field-error {
        margin-top: 6px; font-size: 12px; color: var(--red);
        display: flex; align-items: center; gap: 5px;
    }
    .field-error svg { width: 12px; height: 12px; flex-shrink: 0; }

    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
    @media (max-width: 560px) { .field-row { grid-template-columns: 1fr; } }

    .field-file-wrap {
        position: relative; background: var(--surface-2);
        border: 1.5px dashed var(--surface-3); border-radius: var(--radius-sm);
        padding: 20px; text-align: center; transition: border-color .2s, background .2s; cursor: pointer;
    }
    .field-file-wrap:hover, .field-file-wrap:focus-within {
        border-color: var(--accent); background: var(--accent-soft);
    }
    .field-file-wrap input[type="file"] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
    }
    .field-file-icon { font-size: 28px; margin-bottom: 8px; }
    .field-file-text { font-size: 13px; font-weight: 500; color: var(--ink-2); }
    .field-file-sub  { font-size: 12px; color: var(--ink-3); margin-top: 3px; }

    #fileNotification {
        margin-top: 10px; font-size: 13px; border-radius: var(--radius-sm);
        padding: 10px 14px; display: flex; align-items: center; gap: 10px;
    }
    #fileNotification.success { background: var(--green-soft); color: #166534; border: 1px solid rgba(34,197,94,.2); }
    #fileNotification.error   { background: var(--red-soft);   color: var(--red); border: 1px solid rgba(239,68,68,.2); }
    #fileNotification svg { width: 16px; height: 16px; flex-shrink: 0; }
    #fileNotification .fn-body strong { display: block; }
    #fileNotification .fn-body span   { font-size: 11.5px; opacity: .8; }

    .captcha-wrap {
        background: var(--surface-2); border-radius: var(--radius-sm);
        padding: 20px; display: flex; justify-content: center;
    }
    .form-divider { height: 1px; background: var(--surface-3); margin: 28px 0; }
    .submit-row { display: flex; gap: 12px; flex-wrap: wrap; }

    .btn-submit {
        flex: 1; min-width: 160px;
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        background: var(--accent); color: #fff; border: none;
        border-radius: var(--radius-sm); padding: 13px 24px;
        font-size: 14px; font-weight: 600; font-family: 'Sora', sans-serif; cursor: pointer;
        transition: background .2s, transform .15s, box-shadow .2s;
        box-shadow: 0 4px 14px rgba(91,94,244,.3);
    }
    .btn-submit:hover { background: #4a4de3; transform: translateY(-1px); box-shadow: 0 6px 20px rgba(91,94,244,.4); }
    .btn-submit:active { transform: translateY(0); }
    .btn-submit svg { width: 16px; height: 16px; }

    .btn-cancel {
        display: inline-flex; align-items: center; justify-content: center; gap: 8px;
        background: transparent; color: var(--ink-2);
        border: 1.5px solid var(--surface-3); border-radius: var(--radius-sm);
        padding: 13px 20px; font-size: 14px; font-weight: 500; font-family: 'Sora', sans-serif;
        text-decoration: none; cursor: pointer; transition: border-color .2s, background .2s, color .2s;
    }
    .btn-cancel:hover { background: var(--surface-2); border-color: var(--ink-3); color: var(--ink); }
    .btn-cancel svg { width: 15px; height: 15px; }

    .page-sidebar { display: flex; flex-direction: column; gap: 16px; }
    .info-card {
        background: var(--surface); border-radius: 16px; padding: 22px;
        box-shadow: 0 2px 1px rgba(0,0,0,.03), 0 4px 16px rgba(0,0,0,.05);
    }
    .info-card-title {
        font-size: 11px; font-weight: 700; color: var(--ink-3);
        letter-spacing: .6px; text-transform: uppercase; margin: 0 0 14px;
    }
    .steps { display: flex; flex-direction: column; gap: 14px; }
    .step  { display: flex; gap: 14px; align-items: flex-start; }
    .step-num {
        width: 28px; height: 28px; flex-shrink: 0;
        background: var(--accent-soft); color: var(--accent);
        border-radius: 8px; display: flex; align-items: center; justify-content: center;
        font-size: 12px; font-weight: 700;
    }
    .step-content { flex: 1; padding-top: 4px; }
    .step-title { font-size: 13px; font-weight: 600; color: var(--ink); margin: 0 0 2px; }
    .step-desc  { font-size: 12px; color: var(--ink-3); line-height: 1.5; margin: 0; }
    .tip-list { display: flex; flex-direction: column; gap: 10px; }
    .tip { display: flex; gap: 10px; align-items: flex-start; font-size: 12.5px; color: var(--ink-2); line-height: 1.5; }
    .tip-icon {
        width: 20px; height: 20px; flex-shrink: 0;
        background: var(--accent-soft); border-radius: 6px;
        display: flex; align-items: center; justify-content: center; margin-top: 1px;
    }
    .tip-icon svg { width: 11px; height: 11px; color: var(--accent); }

    @keyframes fadeSlideUp { from { opacity: 0; transform: translateY(18px); } to { opacity: 1; transform: translateY(0); } }
    @keyframes spin { to { transform: rotate(360deg); } }
    .form-card { animation: fadeSlideUp .45s ease both; }
    .page-sidebar .info-card:nth-child(1) { animation: fadeSlideUp .45s .10s ease both; }
    .page-sidebar .info-card:nth-child(2) { animation: fadeSlideUp .45s .18s ease both; }
</style>

<div class="page-wrap">

    <div class="form-card">
        <div class="form-header">
            <div class="form-header-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
            <div>
                <p class="form-header-title">Buat Tiket Baru</p>
                <p class="form-header-sub">Isi formulir di bawah untuk melaporkan masalah Anda</p>
            </div>
        </div>

        <div class="form-body">

            @if ($errors->any())
            <div class="alert-errors">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="alert-errors-text">
                    <strong>Terdapat kesalahan:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>{{-- FIXED: {{ }} bukan {!! !!} --}}
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form action="{{ route('user.tickets.store') }}" method="POST"
                  enctype="multipart/form-data" id="ticketForm">
                @csrf

                <div class="field-row">
                    <div class="field">
                        <label for="client_name" class="field-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Nama Anda <span class="req">*</span>
                        </label>
                        {{-- FIXED: old() di-escape otomatis oleh {{ }} --}}
                        <input type="text" name="client_name" id="client_name"
                               value="{{ old('client_name') }}"
                               class="field-input {{ $errors->has('client_name') ? 'error' : '' }}"
                               placeholder="Nama lengkap" maxlength="255" required>
                        @error('client_name')
                            <p class="field-error">
                                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="field">
                        <label for="client_email" class="field-label">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                            </svg>
                            Email <span class="req">*</span>
                        </label>
                        <input type="email" name="client_email" id="client_email"
                               value="{{ old('client_email') }}"
                               class="field-input {{ $errors->has('client_email') ? 'error' : '' }}"
                               placeholder="contoh@email.com" maxlength="255" required>
                        <p class="field-hint">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Notifikasi dikirim ke sini
                        </p>
                        @error('client_email')
                            <p class="field-error">
                                <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>
                </div>

                <div class="field">
                    <label for="title" class="field-label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                        </svg>
                        Judul Laporan <span class="req">*</span>
                    </label>
                    <input type="text" name="title" id="title"
                           value="{{ old('title') }}"
                           class="field-input {{ $errors->has('title') ? 'error' : '' }}"
                           placeholder="Ringkasan singkat masalah Anda" maxlength="255" required>
                    @error('title')
                        <p class="field-error">
                            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field">
                    <label for="category_id" class="field-label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                        </svg>
                        Kategori <span class="opt">(opsional)</span>
                    </label>
                    <select name="category_id" id="category_id"
                            class="field-select {{ $errors->has('category_id') ? 'error' : '' }}">
                        <option value="">Pilih kategori masalah…</option>
                        @foreach($categories as $category)
                            {{-- FIXED: {{ }} pada category_name --}}
                            <option value="{{ $category->id }}"
                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->category_name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="field-error">
                            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field">
                    <label for="description" class="field-label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h7"/>
                        </svg>
                        Deskripsi Masalah <span class="req">*</span>
                    </label>
                    {{-- FIXED: old('description') di-escape oleh {{ }} dalam textarea --}}
                    <textarea name="description" id="description"
                    class="field-textarea {{ $errors->has('description') ? 'error' : '' }}"
                    placeholder="Jelaskan masalah secara detail…"
                    maxlength="5000"
                    required>{{ old('description') }}</textarea>

                    {{-- Counter --}}
                    <p class="field-hint" id="descCounter" style="justify-content:flex-end; color:var(--ink-3)">
                        <span id="descCount">0</span> / 5.000 karakter
                    </p>
                    <p class="field-hint">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Semakin detail, semakin cepat masalah diselesaikan
                    </p>
                    @error('description')
                        <p class="field-error">
                            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field">
                    <label class="field-label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                        Lampiran <span class="opt">(opsional)</span>
                    </label>
                    <div class="field-file-wrap" id="fileDropZone">
                        <input type="file" name="attachment" id="attachment"
                               accept="image/*,.pdf,.doc,.docx">
                        <div class="field-file-icon">📎</div>
                        <div class="field-file-text">Klik atau seret file ke sini</div>
                        <div class="field-file-sub">JPG, PNG, PDF, DOC, DOCX — maks. 5 MB</div>
                    </div>
                    <div id="fileNotification" style="display:none;"></div>
                    @error('attachment')
                        <p class="field-error">
                            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="field">
                    <label class="field-label">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                        Verifikasi Keamanan <span class="req">*</span>
                    </label>
                    <div class="captcha-wrap">
                        <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                    </div>
                    @error('g-recaptcha-response')
                        <p class="field-error">
                            <svg fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                <div class="form-divider"></div>

                <div class="submit-row">
                    <button type="submit" class="btn-submit" id="submitBtn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                        </svg>
                        Kirim Tiket
                    </button>
                </div>
            </form>
        </div>
    </div>

    <aside class="page-sidebar">
        <div class="info-card">
            <p class="info-card-title">Cara Kerja</p>
            <div class="steps">
                <div class="step">
                    <div class="step-num">1</div>
                    <div class="step-content">
                        <p class="step-title">Isi &amp; Kirim Formulir</p>
                        <p class="step-desc">Lengkapi detail masalah Anda dan kirim tiket.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">2</div>
                    <div class="step-content">
                        <p class="step-title">Tim Menganalisis</p>
                        <p class="step-desc">Tim ahli kami meninjau dan mengerjakan solusi.</p>
                    </div>
                </div>
                <div class="step">
                    <div class="step-num">3</div>
                    <div class="step-content">
                        <p class="step-title">Solusi Dikirim</p>
                        <p class="step-desc">Anda mendapat notifikasi email saat selesai.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="info-card">
            <p class="info-card-title">Tips Tiket Efektif</p>
            <div class="tip-list">
                <div class="tip">
                    <div class="tip-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                    Sertakan pesan error yang muncul secara lengkap
                </div>
                <div class="tip">
                    <div class="tip-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                    Sebutkan browser/OS yang digunakan
                </div>
                <div class="tip">
                    <div class="tip-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                    Lampirkan screenshot jika ada tampilan aneh
                </div>
                <div class="tip">
                    <div class="tip-icon"><svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg></div>
                    Jelaskan langkah yang sudah Anda coba
                </div>
            </div>
        </div>
    </aside>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    @if(session('success'))
        Toast.fire({ icon: 'success', title: @json(session('success')) });
    @endif
    @if(session('error'))
        Toast.fire({ icon: 'error', title: @json(session('error')) });
    @endif
    @if(session('warning'))
        Toast.fire({ icon: 'warning', title: @json(session('warning')) });
    @endif

    const form      = document.getElementById('ticketForm');
    const submitBtn = document.getElementById('submitBtn');
    const descTA    = document.getElementById('description');
    const descCount = document.getElementById('descCount');
    const fileInput = document.getElementById('attachment');
    const notif     = document.getElementById('fileNotification');

    // ── Submit ──
    form?.addEventListener('submit', function (e) {
        if (typeof grecaptcha === 'undefined' || !grecaptcha.getResponse()) {
            e.preventDefault();
            Toast.fire({ icon: 'warning', title: 'Mohon selesaikan verifikasi reCAPTCHA!' });
            return;
        }
        if (submitBtn) {
            submitBtn.disabled = true;
            submitBtn.innerHTML = `
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     style="width:16px;height:16px;animation:spin 1s linear infinite">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg> Mengirim…`;
        }
    });

    // ── Char counter ──
    function updateCounter() {
        const len = descTA.value.length;
        descCount.textContent = len.toLocaleString('id-ID');
        descCount.style.color = len >= 5000 ? 'var(--red)' : len >= 4500 ? 'var(--yellow)' : '';
    }
    descTA?.addEventListener('input', updateCounter);
    updateCounter();

    // ── File notif ──
    function showNotif(type, title, sub) {
        const icon = type === 'success'
            ? `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>`
            : `<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>`;
        notif.className     = type;
        notif.style.display = 'flex';
        notif.innerHTML     = `${icon}<div class="fn-body"></div>`;
        const body   = notif.querySelector('.fn-body');
        const strong = document.createElement('strong');
        const span   = document.createElement('span');
        strong.textContent = title;
        span.textContent   = sub;
        body.appendChild(strong);
        body.appendChild(span);
        if (type === 'error') setTimeout(() => notif.style.display = 'none', 5000);
    }

    fileInput?.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) { notif.style.display = 'none'; return; }

        const allowed = ['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx'];
        const ext     = file.name.split('.').pop().toLowerCase();
        const sizeMB  = file.size / 1024 / 1024;

        if (!allowed.includes(ext)) {
            Toast.fire({ icon: 'error', title: 'Format file tidak didukung!' });
            showNotif('error', 'Format tidak didukung', 'Gunakan: JPG, PNG, PDF, DOC, DOCX');
            this.value = '';
            return;
        }
        if (sizeMB > 5) {
            Toast.fire({ icon: 'error', title: `File terlalu besar (${sizeMB.toFixed(2)} MB)` });
            showNotif('error', 'File terlalu besar', `${sizeMB.toFixed(2)} MB — maksimal 5 MB`);
            this.value = '';
            return;
        }

        const sizeStr = sizeMB < 1 ? `${(sizeMB * 1024).toFixed(0)} KB` : `${sizeMB.toFixed(2)} MB`;
        showNotif('success', '✓ ' + file.name, sizeStr);
        Toast.fire({ icon: 'success', title: 'File berhasil dipilih' });
    });
});
</script>

@endsection
