@extends('layouts.admin.app')

@section('title', 'Dashboard')
@section('breadcrumb', 'Dashboard')

@section('content')

{{-- Page Header --}}
<div class="page-header">
    <div class="page-header-left">
        <h1 class="page-title">Dashboard</h1>
        <p class="page-subtitle">Selamat datang, {{ auth()->user()->name }}. Berikut ringkasan tiket hari ini.</p>
    </div>
    <div class="page-header-actions">
        <a href="{{ route('admin.reports.export') }}" class="btn btn-secondary">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 10v6m0 0l-3-3m3 3l3-3M3 17V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>
            </svg>
            Ekspor
        </a>
    </div>
</div>

{{-- Stat Cards --}}
<div class="stat-grid">
    <div class="stat-card">
        <div class="stat-card-top">
            <span class="stat-card-label">Total Tiket</span>
            <div class="stat-card-icon blue">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-value">{{ $stats['total'] }}</div>
        <div class="stat-card-change">Semua tiket masuk</div>
    </div>

    <div class="stat-card">
        <div class="stat-card-top">
            <span class="stat-card-label">Open</span>
            <div class="stat-card-icon red">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-value">{{ $stats['open'] }}</div>
        <div class="stat-card-change">Menunggu penanganan</div>
    </div>

    <div class="stat-card">
        <div class="stat-card-top">
            <span class="stat-card-label">In Progress</span>
            <div class="stat-card-icon yellow">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-value">{{ $stats['in_progress'] }}</div>
        <div class="stat-card-change">Sedang diproses</div>
    </div>

    <div class="stat-card">
        <div class="stat-card-top">
            <span class="stat-card-label">Closed</span>
            <div class="stat-card-icon green">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <div class="stat-card-value">{{ $stats['closed'] }}</div>
        <div class="stat-card-change">Berhasil diselesaikan</div>
    </div>
</div>

{{-- Charts Row --}}
<div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:24px;">

    {{-- Bar chart: tiket per bulan --}}
    <div class="card">
        <div class="card-header">
            <div>
                <p class="card-title">Tiket Masuk per Bulan</p>
                <p class="card-subtitle">Januari – Desember {{ now()->year }}</p>
            </div>
        </div>
        <div class="card-body">
            <canvas id="chartMonthly" height="200"></canvas>
        </div>
    </div>

    {{-- Bar chart: top 10 kategori --}}
    <div class="card">
        <div class="card-header">
            <div>
                <p class="card-title">Top 10 Kategori</p>
                <p class="card-subtitle">Kategori dengan tiket terbanyak</p>
            </div>
        </div>
        <div class="card-body">
            <canvas id="chartCategory" height="200"></canvas>
        </div>
    </div>

</div>

{{-- Recent Tickets --}}
<div class="card">
    <div class="card-header">
        <div>
            <p class="card-title">Tiket Terbaru</p>
            <p class="card-subtitle">10 tiket yang baru masuk</p>
        </div>
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-secondary btn-sm">Lihat Semua</a>
    </div>
    <div class="table-wrap">
        <table class="table">
            <thead>
                <tr>
                    <th>Kode Tiket</th>
                    <th>Judul</th>
                    <th>Kategori</th>
                    <th>Prioritas</th>
                    <th>Status</th>
                    <th>Masuk</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentTickets as $ticket)
                <tr>
                    <td><span class="mono" style="font-size:12px;color:var(--accent)">{{ $ticket->ticket_code }}</span></td>
                    <td style="max-width:220px">
                        <span class="text-truncate" style="display:block">{{ $ticket->title }}</span>
                        <span style="font-size:11.5px;color:var(--ink-3)">{{ $ticket->client_name }}</span>
                    </td>
                    <td><span style="font-size:12.5px">{{ $ticket->category->category_name ?? '—'  }}</span></td>
                    <td>
                        @if($ticket->priority === 'high')
                            <span class="badge badge-high">Tinggi</span>
                        @elseif($ticket->priority === 'medium')
                            <span class="badge badge-medium">Sedang</span>
                        @elseif($ticket->priority === 'low')
                            <span class="badge badge-low">Rendah</span>
                        @else
                            <span style="font-size:12px;color:var(--ink-3)">—</span>
                        @endif
                    </td>
                    <td>
                        @if($ticket->status === 'open')
                            <span class="badge badge-open">Open</span>
                        @elseif($ticket->status === 'in_progress')
                            <span class="badge badge-progress">In Progress</span>
                        @else
                            <span class="badge badge-closed">Closed</span>
                        @endif
                    </td>
                    <td style="font-size:12px;color:var(--ink-3);white-space:nowrap">
                        {{ $ticket->created_at->diffForHumans() }}
                    </td>
                    <td>
                        <a href="{{ route('admin.tickets.show', $ticket) }}" class="btn btn-secondary btn-sm">
                            Detail
                        </a>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center;padding:40px;color:var(--ink-3)">
                        Belum ada tiket masuk.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('styles')
<style>
    @media (max-width: 768px) {
        [style*="grid-template-columns:1fr 1fr"] {
            grid-template-columns: 1fr !important;
        }
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // ── Tiket per bulan ──
    var monthlyCtx = document.getElementById('chartMonthly').getContext('2d');
    new Chart(monthlyCtx, {
        type: 'bar',
        data: {
            labels: ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'],
            datasets: [
                {
                    label: 'Tiket Masuk',
                    data: @json($chartMonthly['incoming']),
                    backgroundColor: 'rgba(91,94,244,.75)',
                    borderRadius: 6, borderSkipped: false
                },
                {
                    label: 'Tiket Closed',
                    data: @json($chartMonthly['closed']),
                    backgroundColor: 'rgba(34,197,94,.65)',
                    borderRadius: 6, borderSkipped: false
                }
            ]
        },
        options: {
            responsive: true, maintainAspectRatio: true,
            plugins: { legend: { position: 'top', labels: { font: { family: 'Sora', size: 12 } } } },
            scales: {
                x: { grid: { display: false }, ticks: { font: { family: 'Sora', size: 11 } } },
                y: { beginAtZero: true, ticks: { font: { family: 'Sora', size: 11 }, stepSize: 1 } }
            }
        }
    });

    // ── Top 10 kategori ──
    var catCtx = document.getElementById('chartCategory').getContext('2d');
    new Chart(catCtx, {
        type: 'bar',
        data: {
            labels: @json($chartCategory['labels']),
            datasets: [{
                label: 'Jumlah Tiket',
                data: @json($chartCategory['values']),
                backgroundColor: [
                    'rgba(91,94,244,.8)','rgba(59,130,246,.8)','rgba(34,197,94,.8)',
                    'rgba(245,158,11,.8)','rgba(239,68,68,.8)','rgba(168,85,247,.8)',
                    'rgba(20,184,166,.8)','rgba(249,115,22,.8)','rgba(236,72,153,.8)',
                    'rgba(99,102,241,.8)'
                ],
                borderRadius: 5, borderSkipped: false
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true, maintainAspectRatio: true,
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, ticks: { font: { family: 'Sora', size: 11 }, stepSize: 1 } },
                y: { grid: { display: false }, ticks: { font: { family: 'Sora', size: 11 } } }
            }
        }
    });
</script>
@endpush
