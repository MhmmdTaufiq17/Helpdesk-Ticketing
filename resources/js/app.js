import './bootstrap';
import NProgress from 'nprogress';
import 'nprogress/nprogress.css';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import AOS from 'aos';
import Swal from 'sweetalert2';

window.Swal = Swal;

// ── Alpine.js ──
window.Alpine = Alpine;
Alpine.plugin(focus);
Alpine.start();

// ── AOS ──
document.addEventListener('DOMContentLoaded', function () {
    AOS.init({
        duration: 800,
        easing: 'ease-in-out',
        once: true,
        offset: 100,
    });
});

// ── Global Toast ──
window.Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3500,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.onmouseenter = Swal.stopTimer;
        toast.onmouseleave = Swal.resumeTimer;
    },
});

// ── NProgress Config ──
NProgress.configure({
    showSpinner: true,
    trickle: true, // Ubah ke true agar loading terasa "jalan"
    minimum: 0.1,
    easing: 'ease',
    speed: 400,
});

window.NProgress = NProgress;

// ── Logika Loading Otomatis (User & Admin Identik) ──

// 1. Start loading saat pindah halaman (klik link)
document.addEventListener('click', (e) => {
    const link = e.target.closest('a');
    if (
        link &&
        link.href &&
        !link.target &&
        link.origin === window.location.origin &&
        !link.href.includes('#') &&
        !e.ctrlKey && !e.metaKey && !e.shiftKey
    ) {
        NProgress.start();
    }
});

// 2. Start loading saat kirim form (Submit)
// Ini yang bikin tombol "Kirim Balasan" atau "Simpan Status" otomatis ada loading
document.addEventListener('submit', (e) => {
    if (!e.defaultPrevented) {
        NProgress.start();
    }
});

// 3. Start loading saat awal load page
document.addEventListener('DOMContentLoaded', () => {
    NProgress.start();
});

// 4. Stop loading saat semua selesai dimuat
window.addEventListener('load', () => {
    NProgress.done();
});

// Fallback jika proses terlalu lama
setTimeout(() => NProgress.done(), 8000);

// ── Axios Interceptors (untuk AJAX) ──
if (window.axios) {
    window.axios.interceptors.request.use((config) => {
        NProgress.start();
        return config;
    });

    window.axios.interceptors.response.use(
        (response) => {
            NProgress.done();
            return response;
        },
        (error) => {
            NProgress.done();
            return Promise.reject(error);
        }
    );
}
