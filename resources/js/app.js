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
    trickle: false,
    minimum: 0.1,
    easing: 'ease',
    speed: 400,
    parent: 'body',
});

// ── NProgress Custom CSS ──
const nprogressStyle = document.createElement('style');
nprogressStyle.textContent = `
    #nprogress {
        position: fixed !important;
        inset: 0 !important;
        width: 100% !important;
        height: 100% !important;
        background: rgba(255, 255, 255, 0.95) !important;
        z-index: 99999 !important;
        pointer-events: none !important;
    }

    #nprogress .bar,
    #nprogress .peg {
        display: none !important;
    }

    #nprogress .spinner {
        position: fixed !important;
        top: 50% !important;
        left: 50% !important;
        transform: translate(-50%, -50%) !important;
        margin: 0 !important;
        right: auto !important;
        bottom: auto !important;
        z-index: 100000 !important;
    }

    #nprogress .spinner-icon {
        width: 50px !important;
        height: 50px !important;
        border: 4px solid #e0e0e0 !important;
        border-top-color: #5b5ef4 !important;
        border-left-color: #5b5ef4 !important;
        border-radius: 50% !important;
        animation: nprogress-spinner 0.8s linear infinite !important;
        box-sizing: border-box !important;
    }

    @keyframes nprogress-spinner {
        0%   { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    .btn-submit.loading {
        opacity: 0.7;
        cursor: not-allowed;
        pointer-events: none;
    }

    .btn-submit.loading svg {
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        from { transform: rotate(0deg); }
        to   { transform: rotate(360deg); }
    }
`;
document.head.appendChild(nprogressStyle);

// ── NProgress Page Loading ──
// Gunakan readyState untuk handle semua kondisi,
// termasuk jika script dijalankan setelah DOMContentLoaded
function startLoading() {
    NProgress.start();
}

function stopLoading() {
    NProgress.done();
}

// Start: selalu panggil saat script ini dieksekusi
startLoading();

// Stop: tunggu semua resource (gambar, font, dll) selesai
if (document.readyState === 'complete') {
    // Halaman sudah complete saat script dijalankan (jarang, tapi bisa)
    stopLoading();
} else {
    window.addEventListener('load', stopLoading);
}

// Fallback: paksa selesai setelah 8 detik agar tidak stuck selamanya
setTimeout(stopLoading, 8000);

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
