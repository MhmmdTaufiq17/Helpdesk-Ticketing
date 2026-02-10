@extends('layouts.app')

@section('title', 'Status Tiket #' . $ticket->ticket_code)

@section('content')
<div class="relative overflow-hidden">
    <!-- Header Section dengan Gradient (Sesuai dengan Create) -->
    <div class="relative bg-gradient-to-br from-primary-50 via-white to-primary-50 gradient-animate">
        <!-- Background Decorations -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        </div>

        <div class="container mx-auto px-4 py-16 relative">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-block mb-4">
                    <span class="bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-semibold">
                        ✓ Tiket Ditemukan
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                    Status <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-800">Tiket Anda</span>
                </h1>

                <p class="text-xl text-gray-600 leading-relaxed">
                    Lacak perkembangan tiket support Anda secara real-time
                </p>
            </div>
        </div>
    </div>

    <!-- Result Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Kode Tiket Card -->
            <div class="bg-white rounded-3xl shadow-xl border border-gray-200 p-6 mb-8" data-aos="fade-up">
                <div class="flex flex-col md:flex-row md:items-center justify-between">
                    <div>
                        <h3 class="text-sm font-semibold text-gray-500 mb-2">KODE TIKET</h3>
                        <div class="flex items-center space-x-3">
                            <span class="text-2xl md:text-3xl font-bold font-mono bg-gray-100 px-4 py-2 rounded-lg">
                                {{ $ticket->ticket_code }}
                            </span>
                            <!-- Status Badge - LANGSUNG DARI DATABASE -->
                            @php
                                // Warna berdasarkan status
                                $badgeColors = [
                                    'open' => 'bg-blue-100 text-blue-700 border border-blue-200',
                                    'in_progress' => 'bg-yellow-100 text-yellow-700 border border-yellow-200',
                                    'closed' => 'bg-gray-100 text-gray-700 border border-gray-200',
                                ];

                                $badgeClass = $badgeColors[strtolower($ticket->status)] ?? 'bg-gray-100 text-gray-700 border border-gray-200';
                            @endphp

                            <span class="{{ $badgeClass }} px-4 py-2 rounded-lg font-bold inline-block">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                        </div>
                    </div>

                    <div class="mt-4 md:mt-0">
                        <p class="text-sm text-gray-500">Terakhir Diperbarui</p>
                        <p class="font-semibold">{{ $ticket->updated_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Main Card -->
            <div class="bg-white rounded-3xl shadow-2xl overflow-hidden border border-gray-100 mb-8" data-aos="zoom-in">
                <!-- Summary Section -->
                <div class="p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        Informasi Tiket
                    </h2>

                    <div class="space-y-6">
                        <!-- Title -->
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                            <p class="text-sm text-gray-500 mb-2">Judul</p>
                            <p class="text-lg font-semibold text-gray-900">{{ $ticket->title }}</p>
                        </div>

                        <!-- Informasi Detail -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Kategori -->
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <p class="text-sm text-gray-500 mb-2">Kategori</p>
                                @if($ticket->category)
                                    <span class="inline-block bg-primary-100 text-primary-700 px-3 py-1 rounded-lg text-sm font-semibold">
                                        {{ $ticket->category->name }} <!-- Ambil dari relationship -->
                                    </span>
                                @else
                                    <span class="inline-block bg-gray-100 text-gray-700 px-3 py-1 rounded-lg text-sm font-semibold">
                                        Tidak ada kategori
                                    </span>
                                @endif
                            </div>

                            <!-- Prioritas -->
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <p class="text-sm text-gray-500 mb-2">Prioritas</p>
                                @php
                                    $priorityConfig = [
                                        'low' => ['bg' => 'bg-green-100', 'text' => 'text-green-700', 'label' => 'Low'],
                                        'medium' => ['bg' => 'bg-yellow-100', 'text' => 'text-yellow-700', 'label' => 'Medium'],
                                        'high' => ['bg' => 'bg-red-100', 'text' => 'text-red-700', 'label' => 'High'],
                                    ];
                                    $priority = $priorityConfig[$ticket->priority] ?? $priorityConfig['medium'];
                                @endphp
                                <span class="{{ $priority['bg'] }} {{ $priority['text'] }} px-3 py-1 rounded-lg text-sm font-bold inline-block">
                                    {{ $priority['label'] }}
                                </span>
                            </div>

                            <!-- Tanggal Dibuat -->
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <p class="text-sm text-gray-500 mb-2">Tanggal Dibuat</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $ticket->created_at->format('d M Y, H:i') }}
                                </p>
                            </div>

                            <!-- Terakhir Diupdate -->
                            <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                                <p class="text-sm text-gray-500 mb-2">Terakhir Diupdate</p>
                                <p class="text-lg font-semibold text-gray-900">
                                    {{ $ticket->updated_at->format('d M Y, H:i') }}
                                </p>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                            <p class="text-sm text-gray-500 mb-2">Deskripsi Masalah</p>
                            <p class="text-gray-900 whitespace-pre-line">{{ $ticket->description }}</p>
                        </div>

                        <!-- Timeline Status -->
                        <div class="bg-primary-50 p-6 rounded-2xl border border-primary-200">
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Riwayat Status
                            </h3>

                            <div class="space-y-4">
                                <!-- Status Awal -->
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <p class="font-bold text-gray-900">Tiket Dibuat</p>
                                            <span class="text-sm text-gray-500">{{ $ticket->created_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mt-1">
                                            Tiket berhasil dibuat dan masuk dalam sistem
                                        </p>
                                    </div>
                                </div>

                                <!-- Status Saat Ini -->
                                <div class="flex items-start space-x-3">
                                    <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mt-1">
                                        @php
                                            // Ikon berdasarkan status
                                            $statusIcons = [
                                                'open' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                                                'in_progress' => 'M13 10V3L4 14h7v7l9-11h-7z',
                                                'closed' => 'M6 18L18 6M6 6l12 12',
                                            ];
                                            $icon = $statusIcons[strtolower($ticket->status)] ?? 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z';
                                        @endphp
                                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <p class="font-bold text-gray-900">Status Saat Ini</p>
                                            <span class="text-sm text-gray-500">{{ $ticket->updated_at->format('d M Y, H:i') }}</span>
                                        </div>
                                        <p class="text-gray-600 text-sm mt-1">
                                            Status: <span class="font-semibold">{{ ucfirst(str_replace('_', ' ', $ticket->status)) }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="p-8 bg-gray-50 border-t border-gray-200">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('user.tickets.track') }}"
                           class="flex items-center justify-center bg-white border-2 border-primary-600 text-primary-600 font-bold py-3 px-6 rounded-xl hover:bg-primary-50 transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Lacak Tiket Lain
                        </a>

                        <a href="{{ route('user.home') }}"
                           class="flex items-center justify-center bg-gray-800 text-white font-bold py-3 px-6 rounded-xl hover:bg-gray-900 transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Beranda
                        </a>

                        <a href="{{ route('user.tickets.create') }}"
                           class="flex items-center justify-center bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-3 px-6 rounded-xl transition-all duration-300 shadow-md hover:shadow-lg">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Tiket Baru
                        </a>
                    </div>
                </div>
            </div>

            <!-- Info Boxes (Sesuai dengan Create) -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6" data-aos="fade-up">
                <div class="bg-primary-50 border-l-4 border-primary-500 p-6 rounded-xl">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-primary-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <h4 class="font-bold text-primary-900 mb-1">Respons Cepat</h4>
                            <p class="text-sm text-primary-700">Tim kami akan merespons dalam 24 jam</p>
                        </div>
                    </div>
                </div>

                <div class="bg-purple-50 border-l-4 border-purple-500 p-6 rounded-xl">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-purple-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        <div>
                            <h4 class="font-bold text-purple-900 mb-1">Notifikasi Email</h4>
                            <p class="text-sm text-purple-700">Dapatkan update via email Anda</p>
                        </div>
                    </div>
                </div>

                <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-xl">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-green-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                        <div>
                            <h4 class="font-bold text-green-900 mb-1">Data Aman</h4>
                            <p class="text-sm text-green-700">Informasi Anda dilindungi SSL</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Info Tambahan -->
            <div class="mt-8 bg-gradient-to-br from-primary-50 to-blue-50 rounded-3xl p-6 border border-primary-100" data-aos="fade-up">
                <div class="flex items-start space-x-4">
                    <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center flex-shrink-0 shadow-md">
                        <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192l-3.536 3.536M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-5 0a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg mb-2">Butuh Bantuan?</h3>
                        <p class="text-gray-600 mb-3">
                            Tim support kami siap membantu Anda. Hubungi kami jika ada pertanyaan.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="mailto:support@helpdesk.com"
                               class="inline-flex items-center px-4 py-2 bg-primary-600 text-white rounded-lg hover:bg-primary-700 transition-all duration-300 text-sm font-semibold">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Email Support
                            </a>
                            <a href="tel:+622112345678"
                               class="inline-flex items-center px-4 py-2 bg-white border border-primary-600 text-primary-600 rounded-lg hover:bg-primary-50 transition-all duration-300 text-sm font-semibold">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Telepon Support
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, -50px) scale(1.1); }
        50% { transform: translate(-20px, 20px) scale(0.9); }
        75% { transform: translate(50px, 50px) scale(1.05); }
    }
    .animate-blob { animation: blob 10s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .gradient-animate {
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
    }

    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
</style>
@endsection
