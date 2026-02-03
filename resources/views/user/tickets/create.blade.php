@extends('layouts.app')

@section('title', 'Buat Tiket Baru')

@section('content')
<!-- Google reCAPTCHA v2 -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

<div class="relative overflow-hidden">
    <!-- Header Section with Gradient -->
    <div class="relative bg-gradient-to-br from-primary-50 via-white to-primary-50 gradient-animate">
        <!-- Background Decorations -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute -top-40 -right-40 w-80 h-80 bg-primary-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
            <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>
        </div>

        <div class="container mx-auto px-4 py-16 relative">
            <div class="max-w-4xl mx-auto text-center">
                <div class="inline-block mb-4" data-aos="fade-down" data-aos-delay="100">
                    <span class="bg-primary-100 text-primary-700 px-4 py-2 rounded-full text-sm font-semibold">
                        📝 Submit Ticket
                    </span>
                </div>
                <h1 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-4 leading-tight" data-aos="fade-up" data-aos-delay="200">
                    Buat <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-600 to-primary-800">Tiket Baru</span>
                </h1>
                <p class="text-xl text-gray-600 leading-relaxed" data-aos="fade-up" data-aos-delay="300">
                    Laporkan masalah teknis Anda dan tim support kami akan segera membantu menyelesaikannya
                </p>
            </div>
        </div>
    </div>

    <!-- Form Section -->
    <div class="container mx-auto px-4 py-12">
        <div class="max-w-4xl mx-auto">
            <!-- Progress Steps -->
            <div class="mb-12" data-aos="fade-up">
                <div class="flex items-center justify-center space-x-4">
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-primary-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg">
                            1
                        </div>
                        <span class="ml-3 font-semibold text-primary-600">Isi Formulir</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">
                            2
                        </div>
                        <span class="ml-3 font-semibold text-gray-500">Verifikasi</span>
                    </div>
                    <div class="w-16 h-1 bg-gray-300"></div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 bg-gray-300 text-gray-600 rounded-full flex items-center justify-center font-bold">
                            3
                        </div>
                        <span class="ml-3 font-semibold text-gray-500">Selesai</span>
                    </div>
                </div>
            </div>

            <!-- Alert untuk errors -->
            @if ($errors->any())
            <div class="mb-8 bg-red-50 border-l-4 border-red-500 p-6 rounded-xl shadow-sm" data-aos="fade-up">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-red-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div>
                        <h3 class="text-red-800 font-bold mb-2">Terdapat beberapa kesalahan:</h3>
                        <ul class="list-disc list-inside text-red-700 space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif

            <!-- Main Form Card -->
            <div class="bg-white rounded-3xl shadow-2xl border border-gray-100 overflow-hidden" data-aos="fade-up" data-aos-delay="200">
                <form action="{{ route('user.tickets.store') }}" method="POST" enctype="multipart/form-data" id="ticketForm">
                    @csrf

                    <div class="p-8 md:p-12">
                        <!-- Nama Client (client_name) -->
                        <div class="mb-8" data-aos="fade-up" data-aos-delay="300">
                            <label for="client_name" class="block text-gray-900 font-bold mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Nama Client
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text"
                                   name="client_name"
                                   id="client_name"
                                   value="{{ old('client_name') }}"
                                   class="w-full px-5 py-4 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all duration-300 text-gray-900 placeholder-gray-400 @error('client_name') border-red-500 @enderror"
                                   placeholder="Masukkan nama lengkap Anda"
                                   required>
                            @error('client_name')
                                <p class="mt-2 text-red-600 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email Client (client_email) -->
                        <div class="mb-8" data-aos="fade-up" data-aos-delay="350">
                            <label for="client_email" class="block text-gray-900 font-bold mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                Alamat Email Aktif
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="email"
                                   name="client_email"
                                   id="client_email"
                                   value="{{ old('client_email') }}"
                                   class="w-full px-5 py-4 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all duration-300 text-gray-900 placeholder-gray-400 @error('client_email') border-red-500 @enderror"
                                   placeholder="contoh@email.com"
                                   required>
                            <p class="mt-2 text-sm text-gray-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Notifikasi akan dikirim ke email ini
                            </p>
                            @error('client_email')
                                <p class="mt-2 text-red-600 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Judul Laporan (title) -->
                        <div class="mb-8" data-aos="fade-up" data-aos-delay="400">
                            <label for="title" class="block text-gray-900 font-bold mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                </svg>
                                Judul Laporan
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   id="title"
                                   value="{{ old('title') }}"
                                   class="w-full px-5 py-4 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all duration-300 text-gray-900 placeholder-gray-400 @error('title') border-red-500 @enderror"
                                   placeholder="Judul singkat masalah yang dialami"
                                   required>
                            @error('title')
                                <p class="mt-2 text-red-600 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Kategori (category_id) -->
                        <div class="mb-8" data-aos="fade-up" data-aos-delay="450">
                            <label for="category_id" class="block text-gray-900 font-bold mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                Kategori
                                <span class="text-gray-500 ml-1">(Opsional)</span>
                            </label>
                            <select name="category_id"
                                    id="category_id"
                                    class="w-full px-5 py-4 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all duration-300 text-gray-900 @error('category_id') border-red-500 @enderror">
                                <option value="">Pilih kategori masalah (opsional)</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-2 text-red-600 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Deskripsi (description) -->
                        <div class="mb-8" data-aos="fade-up" data-aos-delay="500">
                            <label for="description" class="block text-gray-900 font-bold mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"></path>
                                </svg>
                                Deskripsi Masalah
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <textarea name="description"
                                      id="description"
                                      rows="6"
                                      class="w-full px-5 py-4 border-2 border-gray-300 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all duration-300 text-gray-900 placeholder-gray-400 resize-none @error('description') border-red-500 @enderror"
                                      placeholder="Jelaskan masalah yang Anda alami secara detail..."
                                      required>{{ old('description') }}</textarea>
                            <p class="mt-2 text-sm text-gray-500 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Jelaskan sejelas mungkin untuk memudahkan tim kami membantu
                            </p>
                            @error('description')
                                <p class="mt-2 text-red-600 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Lampiran (attachment) -->
                        <div class="mb-8" data-aos="fade-up" data-aos-delay="550">
                            <label for="attachment" class="block text-gray-900 font-bold mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"></path>
                                </svg>
                                Lampiran (Opsional)
                            </label>
                            <div class="relative">
                                <input type="file"
                                       name="attachment"
                                       id="attachment"
                                       class="w-full px-5 py-4 border-2 border-dashed border-gray-300 rounded-xl focus:border-primary-500 focus:ring-4 focus:ring-primary-100 transition-all duration-300 text-gray-900 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary-50 file:text-primary-700 hover:file:bg-primary-100 @error('attachment') border-red-500 @enderror"
                                       accept="image/*,.pdf,.doc,.docx">
                            </div>
                            <p class="mt-2 text-sm text-gray-500 flex items-start">
                                <svg class="w-4 h-4 mr-1 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Format: JPG, PNG, PDF, DOC, DOCX. Maksimal 5MB</span>
                            </p>
                            @error('attachment')
                                <p class="mt-2 text-red-600 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- CAPTCHA -->
                        <div class="mb-8" data-aos="fade-up" data-aos-delay="600">
                            <label class="block text-gray-900 font-bold mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                                Verifikasi Keamanan
                                <span class="text-red-500 ml-1">*</span>
                            </label>
                            <div class="bg-gray-50 border-2 border-gray-300 rounded-xl p-6 flex justify-center">
                                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.site_key') }}"></div>
                            </div>
                            @error('g-recaptcha-response')
                                <p class="mt-2 text-red-600 text-sm flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4" data-aos="fade-up" data-aos-delay="700">
                            <button type="submit"
                                    class="flex-1 group relative inline-flex items-center justify-center bg-gradient-to-r from-primary-600 to-primary-700 hover:from-primary-700 hover:to-primary-800 text-white font-bold py-4 px-8 rounded-xl transition-all duration-300 shadow-lg hover:shadow-2xl hover:scale-105">
                                <span class="relative z-10 flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                    Submit Tiket
                                </span>
                            </button>
                            <a href="{{ route('user.home') }}"
                               class="flex-1 inline-flex items-center justify-center bg-white hover:bg-gray-50 text-gray-700 font-bold py-4 px-8 rounded-xl border-2 border-gray-300 transition-all duration-300 hover:border-gray-400">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                </svg>
                                Batal
                            </a>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-primary-50 border-l-4 border-primary-500 p-6 rounded-xl" data-aos="fade-up" data-aos-delay="800">
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

                <div class="bg-purple-50 border-l-4 border-purple-500 p-6 rounded-xl" data-aos="fade-up" data-aos-delay="900">
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

                <div class="bg-green-50 border-l-4 border-green-500 p-6 rounded-xl" data-aos="fade-up" data-aos-delay="1000">
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
    @keyframes shake {
        0%, 100% { transform: translateX(0); }
        10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
        20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    .animate-shake { animation: shake 0.5s; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Script loaded');

    // Initialize AOS
    if (typeof AOS !== 'undefined') {
        AOS.init({ duration: 1000, easing: 'ease-in-out-cubic', once: true, offset: 120 });
    }

    // Form validation
    const form = document.getElementById('ticketForm');
    if (form) {
        form.addEventListener('submit', function(e) {
            if (typeof grecaptcha === 'undefined') {
                e.preventDefault();
                alert('reCAPTCHA belum dimuat. Silakan refresh halaman.');
                return false;
            }
            if (!grecaptcha.getResponse()) {
                e.preventDefault();
                alert('Mohon selesaikan verifikasi reCAPTCHA terlebih dahulu!');
                return false;
            }
        });
    }

    // File validation
    const fileInput = document.getElementById('attachment');
    if (fileInput) {
        console.log('✅ File input found');
        fileInput.addEventListener('change', function(e) {
            console.log('📁 File selected');
            const file = e.target.files[0];
            removeFileNotification();

            if (!file) return;

            const maxSize = 5;
            const allowedTypes = {'image/jpeg':'JPG','image/jpg':'JPG','image/png':'PNG','application/pdf':'PDF','application/msword':'DOC','application/vnd.openxmlformats-officedocument.wordprocessingml.document':'DOCX'};
            const allowedExt = ['jpg','jpeg','png','pdf','doc','docx'];
            const fileName = file.name;
            const fileSize = file.size / 1024 / 1024;
            const fileExt = fileName.split('.').pop().toLowerCase();

            if (!allowedTypes[file.type] && !allowedExt.includes(fileExt)) {
                showFileError('Format file tidak didukung!', 'Gunakan: JPG, PNG, PDF, DOC, DOCX');
                fileInput.value = '';
                return;
            }

            if (fileSize > maxSize) {
                showFileError('Ukuran file terlalu besar!', `Ukuran: ${fileSize.toFixed(2)} MB | Max: ${maxSize} MB`);
                fileInput.value = '';
                return;
            }

            const sizeText = fileSize < 1 ? `${(fileSize * 1024).toFixed(0)} KB` : `${fileSize.toFixed(2)} MB`;
            showFileSuccess(fileName, sizeText);
        });
    }

    function showFileError(title, msg) {
        insertFileNotification(`
            <div class="mt-3 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg animate-shake">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-red-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                    </svg>
                    <div><p class="font-bold text-red-800">${title}</p><p class="text-sm text-red-700 mt-1">${msg}</p></div>
                </div>
            </div>
        `);
        setTimeout(removeFileNotification, 5000);
    }

    function showFileSuccess(name, size) {
        insertFileNotification(`
            <div class="mt-3 p-4 bg-green-50 border-l-4 border-green-500 rounded-lg">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-green-500 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <div class="flex-1"><p class="font-bold text-green-800">✅ File berhasil dipilih!</p><p class="text-sm text-green-700 mt-1">📄 ${name}<br>📊 ${size}</p></div>
                </div>
            </div>
        `);
    }

    function insertFileNotification(html) {
        const parent = fileInput.parentElement.parentElement;
        const div = document.createElement('div');
        div.id = 'fileNotification';
        div.innerHTML = html;
        parent.appendChild(div);
    }

    function removeFileNotification() {
        const notif = document.getElementById('fileNotification');
        if (notif) notif.remove();
    }
});
</script>
@endsection
