@extends('layouts.app')

@section('title', 'Lacak Tiket')

@section('content')
<!-- Hero Section -->
<section class="relative bg-gradient-to-br from-primary-50 via-white to-primary-50 gradient-animate">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-20 left-10 w-72 h-72 bg-white rounded-full filter blur-3xl animate-pulse"></div>
        <div class="absolute top-40 right-10 w-72 h-72 bg-purple-300 rounded-full filter blur-3xl animate-pulse animation-delay-1000"></div>
        <div class="absolute -bottom-20 left-1/2 transform -translate-x-1/2 w-72 h-72 bg-blue-300 rounded-full filter blur-3xl animate-pulse animation-delay-2000"></div>
    </div>

    <!-- Geometric Pattern -->
    <div class="absolute inset-0 opacity-10">
        <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\"60\" height=\"60\" viewBox=\"0 0 60 60\" xmlns=\"http://www.w3.org/2000/svg\"%3E%3Cg fill=\"none\" fill-rule=\"evenodd\"%3E%3Cg fill=\"%23ffffff\" fill-opacity=\"1\"%3E%3Cpath d=\"M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\"/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    </div>

    <div class="container mx-auto px-4 py-12 md:py-20 relative z-10">
        <div class="max-w-4xl mx-auto text-left lg:text-left">
            <!-- Badge -->
            <div class="inline-flex items-center space-x-2 bg-white/20 backdrop-blur-sm text-white px-5 py-2.5 rounded-full text-sm font-semibold mb-6 animate-fade-in">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
                <span>Pelacakan Tiket Real-time</span>
            </div>

            <!-- Main Title -->
            <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight">
                Lacak Status Tiket
            </h1>

            <!-- Description -->
            <p class="text-lg text-gray-600 mb-6 max-w-2xl">
                Masukkan kode tiket Anda untuk melihat status dan riwayat penanganan. Mudah, cepat, dan sesuai tampilan halaman lainnya.
            </p>

            <!-- Quick Stats -->
            <div class="grid grid-cols-3 gap-4 max-w-2xl">
                <div class="bg-white p-4 rounded-2xl border border-gray-100 text-center">
                    <div class="text-2xl font-bold text-primary-600 mb-1">24/7</div>
                    <div class="text-sm text-gray-600">Tracking</div>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-gray-100 text-center">
                    <div class="text-2xl font-bold text-primary-600 mb-1">
                        <svg class="w-6 h-6 mx-auto text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="text-sm text-gray-600">Instant</div>
                </div>
                <div class="bg-white p-4 rounded-2xl border border-gray-100 text-center">
                    <div class="text-2xl font-bold text-primary-600 mb-1">
                        <svg class="w-6 h-6 mx-auto text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <div class="text-sm text-gray-600">Secure</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Wave Divider -->
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="animate-wave">
            <path d="M0 0L60 10C120 20 240 40 360 46.7C480 53 600 47 720 43.3C840 40 960 40 1080 46.7C1200 53 1320 67 1380 73.3L1440 80V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0V0Z" fill="#F9FAFB"/>
        </svg>
    </div>
</section>

<!-- Track Form Section -->
<section class="py-12 relative z-20">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Main Card -->
            <div class="bg-white rounded-3xl shadow-2xl p-8 md:p-12 border border-gray-100 transform hover:scale-[1.02] transition-all duration-500 animate-float">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mx-auto mb-4 animate-bounce">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-900 mb-2 animate-fade-in">Cari Tiket Anda</h2>
                    <p class="text-gray-600 animate-fade-in animation-delay-200">Masukkan kode tiket untuk melihat statusnya</p>
                </div>

                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="mb-6 bg-red-50 border-l-4 border-red-500 rounded-lg p-4 animate-shake">
                        <div class="flex items-start">
                            <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <h3 class="text-red-800 font-semibold mb-1">Terjadi Kesalahan</h3>
                                <ul class="text-red-700 text-sm space-y-1">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('user.tickets.track') }}" method="POST" class="space-y-6 animate-slide-up animation-delay-300">
                    @csrf

                    <!-- Ticket Code Input -->
                    <div>
                        <label for="ticket_code" class="block text-sm font-semibold text-gray-700 mb-2">
                            Kode Tiket
                            <span class="text-red-500">*</span>
                        </label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none transition-transform duration-300 group-focus-within:scale-110">
                                <svg class="w-5 h-5 text-gray-400 group-focus-within:text-blue-500 transition-colors duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                </svg>
                            </div>
                            <input type="text"
                                   id="ticket_code"
                                   name="ticket_code"
                                   value="{{ old('ticket_code') }}"
                                   placeholder="Contoh: TKT12345"
                                   class="w-full pl-12 pr-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:bg-white transition-all duration-300 text-lg font-mono uppercase tracking-wider hover:border-blue-300 @error('ticket_code') border-red-500 @enderror"
                                   required
                                   autofocus>
                        </div>
                        <p class="mt-2 text-sm text-gray-500 flex items-center animate-fade-in animation-delay-500">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Kode tiket Anda bisa ditemukan di email konfirmasi
                        </p>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-2xl transform hover:scale-105 active:scale-95 flex items-center justify-center group animate-pulse animation-delay-700">
                        <svg class="w-6 h-6 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        <span class="text-lg">Lacak Tiket Sekarang</span>
                    </button>
                </form>

                <!-- Additional Info -->
                <div class="mt-8 pt-8 border-t border-gray-200 animate-fade-in animation-delay-500">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-all duration-300 hover:scale-105">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center flex-shrink-0 group-hover:animate-pulse">
                                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm">Tracking Real-time</h4>
                                <p class="text-sm text-gray-600">Update status langsung terlihat</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-all duration-300 hover:scale-105">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm">Akses Cepat</h4>
                                <p class="text-sm text-gray-600">Hanya perlu kode tiket</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-all duration-300 hover:scale-105">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-900 text-sm">Riwayat Lengkap</h4>
                                <p class="text-sm text-gray-600">Semua aktivitas tercatat</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Help Section -->
            <div class="mt-8 text-center animate-fade-in animation-delay-700">
                <div class="bg-blue-50 rounded-2xl p-6 border border-blue-100 hover:shadow-lg transition-all duration-300">
                    <h3 class="font-bold text-gray-900 mb-2 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Tidak menemukan kode tiket Anda?
                    </h3>
                    <p class="text-gray-600 mb-4">
                        Kode tiket telah dikirim ke email Anda saat tiket dibuat. Cek folder inbox atau spam.
                    </p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="{{ route('user.tickets.create') }}"
                           class="inline-flex items-center justify-center px-6 py-3 bg-white border-2 border-blue-600 text-blue-600 font-semibold rounded-xl hover:bg-blue-50 hover:border-blue-700 hover:text-blue-700 transition-all duration-300 transform hover:scale-105 active:scale-95 animate-bounce animation-delay-1000">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            Buat Tiket Baru
                        </a>
                        <a href="{{ route('user.home') }}"
                           class="inline-flex items-center justify-center px-6 py-3 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 hover:text-gray-900 transition-all duration-300 transform hover:scale-105 active:scale-95">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="bg-gradient-to-br from-gray-50 to-blue-50 py-20">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12 animate-fade-in">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    Keunggulan Sistem Pelacakan Kami
                </h2>
                <p class="text-xl text-gray-600">
                    Pantau tiket Anda dengan mudah dan transparan
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 transform hover:scale-105 animate-slide-up animation-delay-100">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-100 to-blue-200 rounded-2xl flex items-center justify-center mb-6 animate-pulse">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Update Instan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dapatkan notifikasi real-time setiap ada perubahan status pada tiket Anda
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 transform hover:scale-105 animate-slide-up animation-delay-200">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl flex items-center justify-center mb-6 animate-pulse">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Riwayat Lengkap</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Lihat semua aktivitas dan komunikasi terkait tiket Anda dalam satu tempat
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-100 transform hover:scale-105 animate-slide-up animation-delay-300">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-center justify-center mb-6 animate-pulse">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Akses Aman</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Sistem keamanan berlapis untuk melindungi privasi dan data tiket Anda
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Add custom animations to your CSS -->
<style>
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes gradient {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    @keyframes wave {
        0% { transform: translateX(0); }
        50% { transform: translateX(-30px); }
        100% { transform: translateX(0); }
    }

    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }

    .animate-fade-in {
        animation: fadeIn 0.6s ease-out forwards;
    }

    .animate-slide-up {
        animation: slideUp 0.6s ease-out forwards;
    }

    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient 3s ease infinite;
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    .animate-wave {
        animation: wave 20s linear infinite;
    }

    .animate-shake {
        animation: shake 0.5s ease-in-out;
    }

    .animation-delay-100 { animation-delay: 100ms; }
    .animation-delay-200 { animation-delay: 200ms; }
    .animation-delay-300 { animation-delay: 300ms; }
    .animation-delay-500 { animation-delay: 500ms; }
    .animation-delay-700 { animation-delay: 700ms; }
    .animation-delay-900 { animation-delay: 900ms; }
    .animation-delay-1000 { animation-delay: 1000ms; }
    .animation-delay-1100 { animation-delay: 1100ms; }
</style>
@endsection
