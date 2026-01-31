@extends('layouts.app')

@section('title', 'Tiket Berhasil Dibuat')

@section('content')
<div class="relative overflow-hidden min-h-screen flex items-center">
    <!-- Background Decorations -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-green-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-4 py-20 relative z-10">
        <div class="max-w-3xl mx-auto">
            <!-- Success Animation -->
            <div class="text-center mb-8" data-aos="zoom-in">
                <div class="inline-block relative">
                    <div class="w-32 h-32 bg-gradient-to-br from-green-400 to-green-600 rounded-full flex items-center justify-center shadow-2xl animate-bounce-slow">
                        <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <!-- Confetti effect circles -->
                    <div class="absolute -top-4 -right-4 w-4 h-4 bg-yellow-400 rounded-full animate-ping"></div>
                    <div class="absolute -bottom-4 -left-4 w-4 h-4 bg-pink-400 rounded-full animate-ping" style="animation-delay: 0.2s;"></div>
                    <div class="absolute top-0 left-0 w-4 h-4 bg-blue-400 rounded-full animate-ping" style="animation-delay: 0.4s;"></div>
                </div>
            </div>

            <!-- Success Card -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-6 text-center">
                    <h1 class="text-3xl md:text-4xl font-extrabold mb-2">🎉 Tiket Berhasil Dibuat!</h1>
                    <p class="text-green-100 text-lg">Laporan Anda telah kami terima</p>
                </div>

                <div class="p-8 md:p-12">
                    <!-- Ticket Number Display -->
                    <div class="bg-gradient-to-br from-primary-50 to-primary-100 border-2 border-primary-200 rounded-2xl p-8 mb-8 text-center" data-aos="fade-up" data-aos-delay="300">
                        <p class="text-gray-600 text-sm font-semibold mb-2">NOMOR TIKET ANDA</p>
                        <div class="bg-white rounded-xl p-4 mb-4 inline-block">
                            <p class="text-4xl md:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-800 tracking-wider">
                                {{ $ticket->ticket_number }}
                            </p>
                        </div>
                        <p class="text-sm text-gray-600 flex items-center justify-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Simpan nomor ini untuk melacak status tiket Anda
                        </p>
                    </div>

                    <!-- Ticket Details -->
                    <div class="space-y-6 mb-8" data-aos="fade-up" data-aos-delay="400">
                        <div class="border-b border-gray-200 pb-6">
                            <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                                <svg class="w-6 h-6 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Detail Tiket
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Nama</p>
                                    <p class="font-semibold text-gray-900">{{ $ticket->full_name }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Email</p>
                                    <p class="font-semibold text-gray-900">{{ $ticket->email }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Kategori</p>
                                    <span class="inline-block bg-primary-100 text-primary-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        {{ $ticket->category->name }}
                                    </span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500 mb-1">Status</p>
                                    <span class="inline-block bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm font-semibold">
                                        Menunggu Respons
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-2">Judul Laporan</p>
                            <p class="font-semibold text-gray-900 text-lg">{{ $ticket->title }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500 mb-2">Deskripsi</p>
                            <div class="bg-gray-50 rounded-xl p-4 border border-gray-200">
                                <p class="text-gray-700 leading-relaxed">{{ $ticket->description }}</p>
                            </div>
                        </div>

                        @if($ticket->attachment)
                        <div>
                            <p class="text-sm text-gray-500 mb-2">Lampiran</p>
                            <div class="flex items-center bg-blue-50 border border-blue-200 rounded-xl p-4">
                                <svg class="w-8 h-8 text-blue-600 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                                <div class="flex-1">
                                    <p class="font-semibold text-blue-900">File terlampir</p>
                                    <p class="text-sm text-blue-700">{{ basename($ticket->attachment) }}</p>
                                </div>
                                <a href="{{ Storage::url($ticket->attachment) }}"
                                   target="_blank"
                                   class="text-blue-600 hover:text-blue-800 font-semibold">
                                    Lihat
                                </a>
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Next Steps -->
                    <div class="bg-blue-50 border-l-4 border-blue-500 p-6 rounded-xl mb-8" data-aos="fade-up" data-aos-delay="500">
                        <h4 class="font-bold text-blue-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Langkah Selanjutnya
                        </h4>
                        <ul class="space-y-2 text-blue-800">
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Email konfirmasi telah dikirim ke <strong>{{ $ticket->email }}</strong></span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Tim support kami akan merespons dalam <strong>maksimal 24 jam</strong></span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Anda akan menerima notifikasi email untuk setiap update status</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 mr-2 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                <span>Gunakan nomor tiket untuk melacak progress penanganan</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4" data-aos="fade-up" data-aos-delay="600">
                        <a href="{{ route('user.tickets.track') }}"
                           class="flex-1 group inline-flex items-center justify-center bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-2xl hover:scale-105">
                            <svg class="w-5 h-5 mr-2 group-hover:animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Lacak Tiket Saya
                        </a>
                        <a href="{{ route('home') }}"
                           class="flex-1 inline-flex items-center justify-center bg-white hover:bg-gray-50 text-gray-700 font-bold py-4 px-8 rounded-xl border-2 border-gray-300 transition-all duration-300 hover:border-gray-400">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                            </svg>
                            Kembali ke Beranda
                        </a>
                    </div>

                    <!-- Copy Ticket Number Button -->
                    <div class="mt-6 text-center" data-aos="fade-up" data-aos-delay="700">
                        <button onclick="copyTicketNumber()"
                                id="copyButton"
                                class="inline-flex items-center text-primary-600 hover:text-primary-800 font-semibold transition-colors">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                            </svg>
                            <span id="copyText">Salin Nomor Tiket</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Additional Info Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center" data-aos="fade-up" data-aos-delay="800">
                    <div class="w-16 h-16 bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Respons Cepat</h4>
                    <p class="text-sm text-gray-600">Maksimal 24 jam kerja</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center" data-aos="fade-up" data-aos-delay="900">
                    <div class="w-16 h-16 bg-gradient-to-br from-green-100 to-green-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Tim Profesional</h4>
                    <p class="text-sm text-gray-600">Ditangani oleh ahli berpengalaman</p>
                </div>

                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 text-center" data-aos="fade-up" data-aos-delay="1000">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-100 to-purple-200 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">Update Real-time</h4>
                    <p class="text-sm text-gray-600">Notifikasi via email otomatis</p>
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

    @keyframes bounce-slow {
        0%, 100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-10px);
        }
    }

    .animate-bounce-slow {
        animation: bounce-slow 2s infinite;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize AOS
        if (typeof AOS !== 'undefined') {
            AOS.init({
                duration: 1000,
                easing: 'ease-in-out-cubic',
                once: true,
                offset: 120,
            });
        }
    });

    // Copy ticket number function
    function copyTicketNumber() {
        const ticketNumber = "{{ $ticket->ticket_number }}";
        const copyButton = document.getElementById('copyButton');
        const copyText = document.getElementById('copyText');

        // Copy to clipboard
        navigator.clipboard.writeText(ticketNumber).then(function() {
            // Change button appearance
            copyText.textContent = '✓ Tersalin!';
            copyButton.classList.add('text-green-600');
            copyButton.classList.remove('text-primary-600');

            // Reset after 2 seconds
            setTimeout(function() {
                copyText.textContent = 'Salin Nomor Tiket';
                copyButton.classList.remove('text-green-600');
                copyButton.classList.add('text-primary-600');
            }, 2000);
        }).catch(function(err) {
            console.error('Failed to copy: ', err);
            alert('Gagal menyalin. Silakan salin manual: ' + ticketNumber);
        });
    }
</script>
@endsection
