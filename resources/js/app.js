import './bootstrap';
import NProgress from 'nprogress';
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

window.NProgress = NProgress;

// ── NProgress Page Loading ──
function startLoading() {
    NProgress.start();
}

function stopLoading() {
    NProgress.done();
}

startLoading();

if (document.readyState === 'complete') {
    stopLoading();
} else {
    window.addEventListener('load', stopLoading);
}

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
