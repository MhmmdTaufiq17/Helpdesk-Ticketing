@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="relative overflow-hidden">
    <!-- Hero Section -->
    <div class="relative bg-gradient-to-br from-primary-50 via-white to-primary-50 gradient-animate">
        <!-- Background Decorations -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-pink-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
        </div>

        <div class="container mx-auto px-4 py-20 md:py-32 relative">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right" data-aos-duration="1000">
                    <div class="inline-block mb-4" data-aos="fade-down" data-aos-delay="200">
                        <span class="bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-semibold">
                            🎯 Solusi Helpdesk Terpercaya
                        </span>
                    </div>
                    <h1 class="text-5xl md:text-6xl font-extrabold text-gray-900 mb-6 leading-tight" data-aos="fade-right" data-aos-delay="400">
                        Butuh Bantuan Teknis?
                        <span class="block text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-800">
                            Kami Siap Membantu
                        </span>
                    </h1>
                    <p class="text-xl text-gray-600 mb-8 leading-relaxed" data-aos="fade-right" data-aos-delay="600">
                        Sistem helpdesk ticketing modern yang membantu menyelesaikan masalah teknis Anda dengan
                        <span class="font-semibold text-primary-600">cepat</span> dan
                        <span class="font-semibold text-primary-600">efisien</span>.
                        Laporkan masalah dan dapatkan solusi terbaik dari tim ahli kami.
                    </p>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 mb-8" data-aos="fade-up" data-aos-delay="800">
                        <div class="text-center" data-aos="zoom-in" data-aos-delay="900">
                            <div class="text-3xl font-bold text-primary-600 mb-1">24/7</div>
                            <div class="text-sm text-gray-600">Support</div>
                        </div>
                        <div class="text-center" data-aos="zoom-in" data-aos-delay="1000">
                            <div class="text-3xl font-bold text-primary-600 mb-1 counter-animation" data-target="98">0%</div>
                            <div class="text-sm text-gray-600">Kepuasan</div>
                        </div>
                        <div class="text-center" data-aos="zoom-in" data-aos-delay="1100">
                            <div class="text-3xl font-bold text-primary-600 mb-1">&lt;2h</div>
                            <div class="text-sm text-gray-600">Respons</div>
                        </div>
                    </div>

                    <div class="flex flex-col sm:flex-row gap-4" data-aos="fade-up" data-aos-delay="1200">
                        <a href="{{ route('user.tickets.create') }}"
                           class="group relative inline-flex items-center justify-center bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-2xl hover:scale-105"
                           data-aos="fade-right" data-aos-delay="1300">
                            <span class="relative z-10 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                Buat Tiket Baru
                            </span>
                        </a>
                        <a href="{{ route('user.tickets.track') }}"
                           class="group inline-flex items-center justify-center bg-white hover:bg-gray-50 text-primary-600 font-bold py-4 px-8 rounded-xl border-2 border-primary-600 transition-all duration-300 hover:shadow-xl hover:scale-105"
                           data-aos="fade-left" data-aos-delay="1400">
                            <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Lacak Tiket
                        </a>
                    </div>
                </div>

                <div data-aos="fade-left" data-aos-duration="1000" class="relative">
                    <!-- Floating Ticket Card -->
                    <div class="relative z-10" data-aos="zoom-in" data-aos-delay="400">
                        <div class="bg-white p-8 rounded-3xl shadow-2xl transform hover:rotate-2 transition-all duration-500 border border-gray-100">
                            <div class="absolute -top-4 -left-4 bg-gradient-to-r from-primary-500 to-primary-600 text-white px-6 py-3 rounded-xl font-bold shadow-lg" data-aos="fade-down" data-aos-delay="600">
                                <div class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                                    </svg>
                                    <span>Tiket #TKT12345</span>
                                </div>
                            </div>

                            <div class="mt-6 space-y-5">
                                <div class="flex items-start space-x-4" data-aos="fade-up" data-aos-delay="700">
                                    <div class="w-14 h-14 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center shadow-lg flex-shrink-0">
                                        <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-2">
                                            <p class="font-bold text-gray-900">Status Tiket</p>
                                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Aktif</span>
                                        </div>
                                        <p class="text-green-600 font-semibold mb-1">Dalam Proses</p>
                                        <p class="text-sm text-gray-500 flex items-center">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                            </svg>
                                            Diupdate 2 jam yang lalu
                                        </p>
                                    </div>
                                </div>

                                <div class="border-t-2 border-dashed border-gray-200 pt-5" data-aos="fade-up" data-aos-delay="800">
                                    <div class="bg-primary-50 p-4 rounded-xl border-l-4 border-primary-500">
                                        <p class="text-sm text-gray-700 leading-relaxed">
                                            <span class="font-semibold text-primary-700">Update terbaru:</span><br>
                                            "Masalah login berhasil diidentifikasi dan sedang diperbaiki oleh tim teknis kami. Estimasi selesai dalam 2-3 jam."
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-center justify-between text-sm pt-2" data-aos="fade-up" data-aos-delay="900">
                                    <div class="flex items-center text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                        </svg>
                                        <span class="font-medium">Ahmad S.</span>
                                    </div>
                                    <div class="flex items-center text-primary-600">
                                        <span class="font-semibold">Prioritas: Tinggi</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Elements -->
                    <div class="absolute top-10 -right-6 bg-white p-4 rounded-xl shadow-xl border border-gray-100 animate-bounce" style="animation-duration: 3s;" data-aos="fade-left" data-aos-delay="1000">
                        <div class="flex items-center space-x-3">
                            <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-sm font-semibold text-gray-700">Online Support</span>
                        </div>
                    </div>

                    <div class="absolute -bottom-6 left-10 bg-white p-4 rounded-xl shadow-xl border border-gray-100 animate-bounce" style="animation-duration: 4s; animation-delay: 1s;" data-aos="fade-right" data-aos-delay="1200">
                        <div class="flex items-center space-x-2">
                            <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                            <span class="text-sm font-semibold text-gray-700">4.9 Rating</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="container mx-auto px-4 py-20" data-aos="fade-up">
        <div class="text-center mb-16">
            <div class="inline-block mb-4" data-aos="fade-down" data-aos-delay="100">
                <span class="bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-semibold">
                    ✨ Fitur Unggulan
                </span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4" data-aos="fade-up" data-aos-delay="200">
                Mengapa Memilih <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-800">Sistem Kami?</span>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                Teknologi terkini dikombinasikan dengan tim support profesional untuk pengalaman helpdesk terbaik
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div data-aos="fade-up" data-aos-delay="100" class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-primary-200 hover:-translate-y-2">
                <div class="relative mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-primary-500 rounded-full animate-ping opacity-75"></div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-primary-600 transition-colors">
                    Cepat & Responsif
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Tiket Anda akan ditangani dalam waktu <span class="font-semibold text-primary-600">maksimal 24 jam</span> oleh tim support berpengalaman dengan tingkat resolusi 98%.
                </p>
                <div class="flex items-center text-primary-600 font-semibold group-hover:translate-x-2 transition-transform">
                    <span>Selengkapnya</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>

            <!-- Feature 2 -->
            <div data-aos="fade-up" data-aos-delay="200" class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-primary-200 hover:-translate-y-2">
                <div class="relative mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-purple-500 rounded-full animate-ping opacity-75"></div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-purple-600 transition-colors">
                    Notifikasi Real-time
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Dapatkan <span class="font-semibold text-purple-600">notifikasi instant</span> via email dan push notification setiap ada perubahan status tiket Anda.
                </p>
                <div class="flex items-center text-purple-600 font-semibold group-hover:translate-x-2 transition-transform">
                    <span>Selengkapnya</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>

            <!-- Feature 3 -->
            <div data-aos="fade-up" data-aos-delay="300" class="group bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 border border-gray-100 hover:border-primary-200 hover:-translate-y-2">
                <div class="relative mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full animate-ping opacity-75"></div>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-green-600 transition-colors">
                    Keamanan Terjamin
                </h3>
                <p class="text-gray-600 leading-relaxed mb-4">
                    Data Anda dilindungi dengan <span class="font-semibold text-green-600">enkripsi SSL 256-bit</span> dan compliance standar internasional untuk privasi maksimal.
                </p>
                <div class="flex items-center text-green-600 font-semibold group-hover:translate-x-2 transition-transform">
                    <span>Selengkapnya</span>
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="bg-gradient-to-br from-gray-50 to-primary-50 py-20" data-aos="fade-up">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <div class="inline-block mb-4" data-aos="fade-down" data-aos-delay="100">
                    <span class="bg-white text-primary-700 px-4 py-2 rounded-full text-sm font-semibold shadow-sm">
                        🚀 Proses Mudah
                    </span>
                </div>
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4" data-aos="fade-up" data-aos-delay="200">Cara Kerja Sistem</h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                    Hanya dalam 3 langkah mudah, masalah teknis Anda akan terselesaikan dengan cepat dan profesional
                </p>
            </div>

            <div class="max-w-5xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 relative">
                    <!-- Connection Line -->
                    <div class="hidden md:block absolute top-1/4 left-0 right-0 h-1 bg-gradient-to-r from-primary-200 via-primary-300 to-primary-200" data-aos="fade-left" data-aos-delay="400"></div>

                    <!-- Step 1 -->
                    <div data-aos="zoom-in" data-aos-delay="100" class="relative text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-24 h-24 bg-gradient-to-br from-primary-600 to-primary-700 text-white rounded-3xl flex items-center justify-center text-3xl font-bold shadow-2xl group-hover:scale-110 transition-transform duration-300">
                                <span>1</span>
                            </div>
                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Buat Tiket</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Isi formulir sederhana dengan detail masalah yang Anda alami beserta lampiran jika diperlukan
                        </p>
                    </div>

                    <!-- Step 2 -->
                    <div data-aos="zoom-in" data-aos-delay="200" class="relative text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-24 h-24 bg-gradient-to-br from-purple-600 to-purple-700 text-white rounded-3xl flex items-center justify-center text-3xl font-bold shadow-2xl group-hover:scale-110 transition-transform duration-300">
                                <span>2</span>
                            </div>
                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce" style="animation-delay: 0.2s;">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Proses Analisis</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Tim ahli kami menganalisis masalah dan memberikan solusi terbaik dengan prioritas sesuai urgency
                        </p>
                    </div>

                    <!-- Step 3 -->
                    <div data-aos="zoom-in" data-aos-delay="300" class="relative text-center group">
                        <div class="relative inline-block mb-6">
                            <div class="w-24 h-24 bg-gradient-to-br from-green-600 to-green-700 text-white rounded-3xl flex items-center justify-center text-3xl font-bold shadow-2xl group-hover:scale-110 transition-transform duration-300">
                                <span>3</span>
                            </div>
                            <div class="absolute -top-3 -right-3 w-8 h-8 bg-yellow-400 rounded-full flex items-center justify-center animate-bounce" style="animation-delay: 0.4s;">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-3">Solusi & Penutupan</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Dapatkan solusi komprehensif dan tiket akan ditutup setelah konfirmasi kepuasan Anda
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials Section -->
    <div class="container mx-auto px-4 py-20" data-aos="fade-up">
        <div class="text-center mb-16">
            <div class="inline-block mb-4" data-aos="fade-down" data-aos-delay="100">
                <span class="bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-semibold">
                    💬 Testimonial
                </span>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4" data-aos="fade-up" data-aos-delay="200">Apa Kata Pengguna Kami?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                Ribuan pengguna telah mempercayai sistem kami untuk menyelesaikan masalah teknis mereka
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div data-aos="fade-up" data-aos-delay="100" class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="flex space-x-1">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                </div>
                <p class="text-gray-700 mb-6 italic leading-relaxed">
                    "Sistem yang sangat membantu! Masalah saya diselesaikan dalam 4 jam. Tim support sangat responsif dan profesional."
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-primary-400 to-primary-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                        BS
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">Budi Santoso</p>
                        <p class="text-sm text-gray-500">IT Manager, PT. ABC</p>
                    </div>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-delay="200" class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="flex space-x-1">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                </div>
                <p class="text-gray-700 mb-6 italic leading-relaxed">
                    "Notifikasi real-time sangat membantu! Saya selalu tahu status tiket saya. Recommended untuk semua perusahaan."
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-purple-400 to-purple-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                        SA
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">Siti Aminah</p>
                        <p class="text-sm text-gray-500">HR Director, PT. XYZ</p>
                    </div>
                </div>
            </div>

            <div data-aos="fade-up" data-aos-delay="300" class="bg-white p-8 rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 border border-gray-100">
                <div class="flex items-center mb-4">
                    <div class="flex space-x-1">
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-5 h-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                </div>
                <p class="text-gray-700 mb-6 italic leading-relaxed">
                    "Interface yang user-friendly dan proses yang mudah. Sangat puas dengan layanan yang diberikan. 5 bintang!"
                </p>
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center text-white font-bold text-lg mr-4">
                        DP
                    </div>
                    <div>
                        <p class="font-bold text-gray-900">Dedi Prasetyo</p>
                        <p class="text-sm text-gray-500">CEO, Startup Tech</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="relative bg-gradient-to-r from-primary-600 via-primary-700 to-primary-800 text-white py-20 overflow-hidden gradient-animate" data-aos="fade-up">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-10">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
        </div>

        <div class="container mx-auto px-4 text-center relative z-10">
            <div class="max-w-4xl mx-auto">
                <div class="inline-block mb-6" data-aos="fade-down" data-aos-delay="100">
                    <span class="bg-white/20 backdrop-blur-sm text-white px-4 py-2 rounded-full text-sm font-semibold">
                        ⚡ Mulai Sekarang
                    </span>
                </div>
                <h2 class="text-4xl md:text-5xl font-extrabold mb-6" data-aos="zoom-in" data-aos-delay="200">
                    Siap Melaporkan Masalah Anda?
                </h2>
                <p class="text-xl md:text-2xl mb-10 text-primary-100 leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                    Jangan biarkan masalah teknis menghambat produktivitas Anda.<br class="hidden md:block">
                    Buat tiket sekarang dan dapatkan bantuan profesional segera!
                </p>

                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8" data-aos="fade-up" data-aos-delay="400">
                    <a href="{{ route('user.tickets.create') }}"
                       class="group inline-flex items-center justify-center bg-white text-primary-600 hover:bg-primary-50 font-bold py-4 px-10 rounded-xl text-lg transition-all duration-300 shadow-2xl hover:shadow-3xl hover:scale-105"
                       data-aos="fade-right" data-aos-delay="500">
                        <svg class="w-6 h-6 mr-3 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Tiket Sekarang
                    </a>
                    <a href="{{ route('user.tickets.track') }}"
                       class="inline-flex items-center justify-center bg-transparent hover:bg-white/10 text-white font-bold py-4 px-10 rounded-xl border-2 border-white text-lg transition-all duration-300"
                       data-aos="fade-left" data-aos-delay="600">
                        Atau Lacak Tiket Anda
                        <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                        </svg>
                    </a>
                </div>

                <div class="flex items-center justify-center space-x-8 text-primary-100" data-aos="fade-up" data-aos-delay="700">
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Gratis Konsultasi</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Respons Cepat</span>
                    </div>
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Support 24/7</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes blob {
        0%, 100% {
            transform: translate(0, 0) scale(1);
        }
        25% {
            transform: translate(20px, -50px) scale(1.1);
        }
        50% {
            transform: translate(-20px, 20px) scale(0.9);
        }
        75% {
            transform: translate(50px, 50px) scale(1.05);
        }
    }

    .animate-blob {
        animation: blob 10s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }

    .animation-delay-4000 {
        animation-delay: 4s;
    }

    /* Custom AOS Animations */
    [data-aos="fade-down-custom"] {
        transform: translateY(-50px);
        opacity: 0;
        transition-property: transform, opacity;
    }

    [data-aos="fade-down-custom"].aos-animate {
        transform: translateY(0);
        opacity: 1;
    }

    [data-aos="scale-up"] {
        transform: scale(0.8);
        opacity: 0;
        transition-property: transform, opacity;
    }

    [data-aos="scale-up"].aos-animate {
        transform: scale(1);
        opacity: 1;
    }

    [data-aos="slide-left"] {
        transform: translateX(100px);
        opacity: 0;
        transition-property: transform, opacity;
    }

    [data-aos="slide-left"].aos-animate {
        transform: translateX(0);
        opacity: 1;
    }

    /* Smooth scroll for anchor links */
    html {
        scroll-behavior: smooth;
    }

    /* Enhanced AOS transitions */
    [data-aos] {
        pointer-events: none;
    }

    [data-aos].aos-animate {
        pointer-events: auto;
    }

    /* Parallax effect */
    .parallax-slow {
        transform: translateY(calc(var(--scroll) * 0.5px));
    }
</style>

<script>
    // Enhanced AOS initialization with custom settings
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 1000,
                easing: 'ease-in-out-cubic',
                once: true,
                offset: 120,
                delay: 0,
                mirror: false,
                anchorPlacement: 'top-bottom',
                disable: function() {
                    return window.innerWidth < 768;
                }
            });

            // Refresh AOS on window resize
            let resizeTimer;
            window.addEventListener('resize', function() {
                clearTimeout(resizeTimer);
                resizeTimer = setTimeout(function() {
                    AOS.refresh();
                }, 250);
            });

            // Counter Animation untuk 98% Kepuasan
            const counterElement = document.querySelector('.counter-animation');
            if (counterElement) {
                const targetValue = parseInt(counterElement.getAttribute('data-target'));
                let currentValue = 0;
                let hasAnimated = false;

                const observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting && !hasAnimated) {
                            hasAnimated = true;
                            const duration = 2000; // 2 detik
                            const increment = targetValue / (duration / 16); // 60fps

                            const animateCounter = () => {
                                currentValue += increment;
                                if (currentValue < targetValue) {
                                    counterElement.textContent = Math.floor(currentValue) + '%';
                                    requestAnimationFrame(animateCounter);
                                } else {
                                    counterElement.textContent = targetValue + '%';
                                }
                            };

                            animateCounter();
                        }
                    });
                }, { threshold: 0.5 });

                observer.observe(counterElement);
            }

            // Add counter animation for stats
            const stats = document.querySelectorAll('[data-aos="zoom-in"]');
            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const element = entry.target;
                        if (element.querySelector('.text-3xl')) {
                            element.classList.add('animate-pulse-once');
                        }
                    }
                });
            }, { threshold: 0.5 });

            stats.forEach(stat => statsObserver.observe(stat));
        }

        // Parallax effect for background blobs
        let ticking = false;
        window.addEventListener('scroll', function() {
            if (!ticking) {
                window.requestAnimationFrame(function() {
                    const scrolled = window.pageYOffset;
                    document.documentElement.style.setProperty('--scroll', scrolled);
                    ticking = false;
                });
                ticking = true;
            }
        });

        // Add stagger effect to feature cards
        const featureCards = document.querySelectorAll('.grid > [data-aos="fade-up"]');
        featureCards.forEach((card, index) => {
            card.setAttribute('data-aos-delay', (index + 1) * 100);
        });

        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });

    // Add pulse animation class
    const style = document.createElement('style');
    style.textContent = `
        @keyframes pulse-once {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }
        .animate-pulse-once {
            animation: pulse-once 0.6s ease-in-out;
        }
    `;
    document.head.appendChild(style);
</script>
@endsection
