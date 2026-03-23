<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Helpdesk</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <style>
        *,*::before,*::after{box-sizing:border-box}
        :root{
            --ink:#0f0f12;--ink-2:#3a3a4a;--ink-3:#8a8a9a;
            --surface:#fff;--surface-2:#f5f5f7;--surface-3:#ebebef;
            --accent:#5b5ef4;--accent-2:#7b7ef7;--accent-soft:#eeeeff;
            --green:#22c55e;--red:#ef4444;--yellow:#f59e0b;
            --radius:14px;--radius-sm:9px;
            --shadow-lg:0 12px 40px rgba(0,0,0,.12),0 4px 12px rgba(0,0,0,.06);
        }
        html{scroll-behavior:smooth}
        body{font-family:'Sora',sans-serif;background:var(--surface-2);color:var(--ink);margin:0;min-height:100vh;-webkit-font-smoothing:antialiased}

        /* NProgress Custom Styling - Spinner Biru di Tengah */
        #nprogress .bar {
            display: none !important;
        }

        #nprogress .spinner {
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) !important;
            position: fixed !important;
            z-index: 9999 !important;
        }

        #nprogress .spinner-icon {
            width: 48px !important;
            height: 48px !important;
            border-width: 4px !important;
            border-top-color: var(--accent) !important;
            border-left-color: var(--accent) !important;
            animation: nprogress-spinner 0.6s linear infinite !important;
        }

        /* Background semi-transparan saat loading */
        #nprogress {
            background: rgba(255, 255, 255, 0.92) !important;
            backdrop-filter: blur(4px);
            position: fixed !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            z-index: 9998 !important;
        }

        /* Animasi spinner */
        @keyframes nprogress-spinner {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* NAV */
        .nav{position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(255,255,255,.88);backdrop-filter:blur(20px) saturate(160%);-webkit-backdrop-filter:blur(20px) saturate(160%);border-bottom:1px solid var(--surface-3);height:64px}
        .nav-inner{max-width:1200px;margin:0 auto;padding:0 24px;height:100%;display:flex;align-items:center;gap:16px}
        .nav-logo{display:flex;align-items:center;gap:10px;text-decoration:none;flex-shrink:0}
        .nav-logo-icon{width:36px;height:36px;background:var(--accent);border-radius:10px;display:flex;align-items:center;justify-content:center;box-shadow:0 2px 8px rgba(91,94,244,.35)}
        .nav-logo-icon svg{width:18px;height:18px;color:#fff}
        .nav-logo-text{font-size:15px;font-weight:700;color:var(--ink);letter-spacing:-.3px}
        .nav-links{display:flex;align-items:center;gap:2px;margin-left:8px}
        .nav-link{display:flex;align-items:center;gap:6px;padding:7px 13px;border-radius:var(--radius-sm);font-size:13.5px;font-weight:500;color:var(--ink-2);text-decoration:none;transition:background .15s,color .15s;white-space:nowrap}
        .nav-link:hover{background:var(--surface-2);color:var(--ink)}
        .nav-link.active{background:var(--accent-soft);color:var(--accent)}
        .nav-link svg{width:15px;height:15px}

        /* SEARCH */
        .nav-search{flex:1;max-width:360px;margin-left:auto;position:relative}
        .nav-search-form{display:flex;align-items:center;background:var(--surface-2);border:1.5px solid var(--surface-3);border-radius:10px;padding:0 4px 0 12px;transition:border-color .2s,box-shadow .2s;gap:4px}
        .nav-search-form:focus-within{border-color:var(--accent);box-shadow:0 0 0 3px rgba(91,94,244,.12);background:var(--surface)}
        .nav-search-icon{width:15px;height:15px;color:var(--ink-3);flex-shrink:0}
        .nav-search-input{flex:1;border:none;background:transparent;font-family:'Sora',sans-serif;font-size:13px;color:var(--ink);padding:9px 6px;outline:none;min-width:0}
        .nav-search-input::placeholder{color:var(--ink-3)}
        .nav-search-btn{background:var(--accent);color:#fff;border:none;border-radius:7px;padding:6px 12px;font-size:12px;font-weight:600;font-family:'Sora',sans-serif;cursor:pointer;transition:background .15s,transform .1s;white-space:nowrap;flex-shrink:0}
        .nav-search-btn:hover{background:#4a4de3;transform:scale(1.02)}
        .nav-search-btn:disabled{background:#a5a7f9;cursor:not-allowed;transform:none}

        /* ERROR TOAST */
        .nav-search-error{
            display:none;position:absolute;top:calc(100% + 8px);left:0;right:0;
            background:#fff1f1;border:1px solid rgba(239,68,68,.25);
            border-radius:10px;padding:10px 14px;
            font-size:12.5px;color:var(--red);
            box-shadow:0 4px 16px rgba(0,0,0,.08);
            z-index:200;display:none;align-items:center;gap:8px;
        }
        .nav-search-error.show{display:flex}
        .nav-search-error svg{width:14px;height:14px;flex-shrink:0}

        /* MOBILE */
        .nav-mobile-btn{display:none;background:none;border:none;cursor:pointer;padding:8px;border-radius:8px;color:var(--ink-2);margin-left:auto}
        .nav-mobile-btn:hover{background:var(--surface-2)}
        @media(max-width:768px){.nav-links{display:none}.nav-search{display:none}.nav-mobile-btn{display:flex;align-items:center}}
        .nav-mobile-menu{display:none;position:fixed;top:64px;left:0;right:0;background:var(--surface);border-bottom:1px solid var(--surface-3);padding:12px 20px 20px;z-index:99;box-shadow:var(--shadow-lg)}
        .nav-mobile-menu.open{display:block}
        .nav-mobile-search-wrap{position:relative;margin-bottom:12px}
        .nav-mobile-search{display:flex;align-items:center;background:var(--surface-2);border:1.5px solid var(--surface-3);border-radius:10px;padding:0 4px 0 12px;gap:6px;transition:border-color .2s}
        .nav-mobile-search:focus-within{border-color:var(--accent)}
        .nav-mobile-search input{flex:1;border:none;background:transparent;font-family:'Sora',sans-serif;font-size:14px;color:var(--ink);padding:11px 6px;outline:none}
        .nav-mobile-search button{background:var(--accent);color:#fff;border:none;border-radius:7px;padding:7px 14px;font-size:13px;font-weight:600;cursor:pointer;font-family:'Sora',sans-serif}
        .nav-mobile-search button:disabled{background:#a5a7f9;cursor:not-allowed}
        .nav-mobile-error{display:none;margin-top:6px;background:#fff1f1;border:1px solid rgba(239,68,68,.25);border-radius:9px;padding:9px 12px;font-size:12.5px;color:var(--red);align-items:center;gap:8px}
        .nav-mobile-error.show{display:flex}
        .nav-mobile-error svg{width:14px;height:14px;flex-shrink:0}
        .nav-mobile-links{display:flex;flex-direction:column;gap:4px}
        .nav-mobile-link{display:flex;align-items:center;gap:10px;padding:11px 12px;border-radius:10px;font-size:14px;font-weight:500;color:var(--ink-2);text-decoration:none;transition:background .15s}
        .nav-mobile-link:hover,.nav-mobile-link.active{background:var(--accent-soft);color:var(--accent)}

        /* SPINNER inside button */
        @keyframes spin{to{transform:rotate(360deg)}}
        .btn-spinner{display:inline-block;width:12px;height:12px;border:2px solid rgba(255,255,255,.4);border-top-color:#fff;border-radius:50%;animation:spin .5s linear infinite;vertical-align:middle;margin-right:4px}

        /* LAYOUT */
        main{padding-top:64px}
        .footer{background:var(--ink);color:rgba(255,255,255,.55);padding:40px 24px;margin-top:80px;font-size:13px}
        .footer-inner{max-width:1200px;margin:0 auto;display:flex;align-items:center;justify-content:space-between;gap:16px;flex-wrap:wrap}
        .footer-brand{display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.8);font-weight:600;font-size:14px;text-decoration:none}
        .footer-brand-dot{width:8px;height:8px;background:var(--accent-2);border-radius:50%}
        .footer-links{display:flex;gap:20px}
        .footer-links a{color:rgba(255,255,255,.45);text-decoration:none;transition:color .15s}
        .footer-links a:hover{color:rgba(255,255,255,.8)}
        .container{max-width:1200px;margin:0 auto;padding:0 24px}
        .mono{font-family:'DM Mono',monospace}
    </style>
</head>
<body>

<nav class="nav">
    <div class="nav-inner">
        <a href="{{ route('user.home') }}" class="nav-logo">
            <div class="nav-logo-icon">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                </svg>
            </div>
            <span class="nav-logo-text">Helpdesk</span>
        </a>

        <div class="nav-links">
            <a href="{{ route('user.home') }}" class="nav-link {{ request()->routeIs('user.home') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Buat Tiket
            </a>
        </div>

        <!-- Desktop Search -->
        <div class="nav-search" id="desktopSearchWrap">
            <div class="nav-search-form">
                <svg class="nav-search-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" id="desktopSearchInput" class="nav-search-input"
                       placeholder="Cari kode tiket… mis. TKT-001"
                       autocomplete="off" spellcheck="false">
                <button type="button" id="desktopSearchBtn" class="nav-search-btn">Cari</button>
            </div>
            <div class="nav-search-error" id="desktopSearchError">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span id="desktopErrorMsg"></span>
            </div>
        </div>

        <button class="nav-mobile-btn" id="mobileMenuBtn" aria-label="Menu">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
    </div>
</nav>

<!-- Mobile Menu -->
<div class="nav-mobile-menu" id="mobileMenu">
    <div class="nav-mobile-search-wrap">
        <div class="nav-mobile-search">
            <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="color:var(--ink-3);flex-shrink:0">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
            <input type="text" id="mobileSearchInput" placeholder="Cari kode tiket…" autocomplete="off">
            <button type="button" id="mobileSearchBtn">Cari</button>
        </div>
        <div class="nav-mobile-error" id="mobileSearchError">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <span id="mobileErrorMsg"></span>
        </div>
    </div>
    <div class="nav-mobile-links">
        <a href="{{ route('user.home') }}" class="nav-mobile-link {{ request()->routeIs('user.home') ? 'active' : '' }}">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Buat Tiket
        </a>
    </div>
</div>

<main>@yield('content')</main>

<footer class="footer">
    <div class="footer-inner">
        <a href="{{ route('user.home') }}" class="footer-brand">
            <div class="footer-brand-dot"></div>
            Helpdesk &copy; {{ date('Y') }}
        </a>
        <div class="footer-links">
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Syarat &amp; Ketentuan</a>
            <a href="#">FAQ</a>
        </div>
        <span>support@helpdesk.com &middot; (021) 1234-5678</span>
    </div>
</footer>

<script>
    // ========== Fungsi Search (tanpa NProgress) ==========
    var CSRF = '{{ csrf_token() }}';
    var TRACK_URL = '{{ route("user.tickets.track.do") }}';

    function setLoading(btn, loading){
        if(loading){
            btn.disabled = true;
            btn.innerHTML = '<span class="btn-spinner"></span>Mencari…';
        } else {
            btn.disabled = false;
            btn.innerHTML = 'Cari';
        }
    }

    function showError(msgEl, errEl, msg){
        msgEl.textContent = msg;
        errEl.classList.add('show');
        setTimeout(function(){ errEl.classList.remove('show'); }, 4000);
    }

    async function doSearch(code, btn, msgEl, errEl){
        var trimmed = code.trim().toUpperCase();
        if(!trimmed){
            showError(msgEl, errEl, 'Masukkan kode tiket terlebih dahulu.');
            return;
        }

        setLoading(btn, true);
        errEl.classList.remove('show');

        try {
            var res = await fetch(TRACK_URL, {
                method: 'POST',
                headers:{
                    'Content-Type':'application/json',
                    'Accept':'application/json',
                    'X-CSRF-TOKEN': CSRF
                },
                body: JSON.stringify({ticket_code: trimmed})
            });

            var data = await res.json();

            if(res.ok && data.redirect){
                window.location.href = data.redirect;
            } else {
                setLoading(btn, false);
                var msg = (data.errors && data.errors.ticket_code)
                    ? data.errors.ticket_code[0]
                    : (data.message ?? 'Tiket tidak ditemukan.');
                showError(msgEl, errEl, msg);
            }
        } catch(e){
            setLoading(btn, false);
            showError(msgEl, errEl, 'Gagal terhubung ke server. Coba lagi.');
        }
    }

    // Desktop
    var dInput = document.getElementById('desktopSearchInput');
    var dBtn   = document.getElementById('desktopSearchBtn');
    var dErr   = document.getElementById('desktopSearchError');
    var dMsg   = document.getElementById('desktopErrorMsg');

    if(dInput){
        dBtn.addEventListener('click', function(){ doSearch(dInput.value, dBtn, dMsg, dErr); });
        dInput.addEventListener('keydown', function(e){
            if(e.key === 'Enter'){ doSearch(dInput.value, dBtn, dMsg, dErr); }
            if(e.key === 'Escape'){ dErr.classList.remove('show'); }
        });
        dInput.addEventListener('input', function(){ dErr.classList.remove('show'); });
        document.addEventListener('click', function(e){
            if(!document.getElementById('desktopSearchWrap').contains(e.target)){
                dErr.classList.remove('show');
            }
        });
    }

    // Mobile
    var mInput = document.getElementById('mobileSearchInput');
    var mBtn   = document.getElementById('mobileSearchBtn');
    var mErr   = document.getElementById('mobileSearchError');
    var mMsg   = document.getElementById('mobileErrorMsg');

    if(mInput){
        mBtn.addEventListener('click', function(){ doSearch(mInput.value, mBtn, mMsg, mErr); });
        mInput.addEventListener('keydown', function(e){
            if(e.key === 'Enter'){ doSearch(mInput.value, mBtn, mMsg, mErr); }
        });
        mInput.addEventListener('input', function(){ mErr.classList.remove('show'); });
    }

    // Mobile menu toggle
    var menuBtn  = document.getElementById('mobileMenuBtn');
    var mobileMenu = document.getElementById('mobileMenu');
    if(menuBtn){
        menuBtn.addEventListener('click', function(){ mobileMenu.classList.toggle('open'); });
        document.addEventListener('click', function(e){
            if(!menuBtn.contains(e.target) && !mobileMenu.contains(e.target)){
                mobileMenu.classList.remove('open');
            }
        });
    }
</script>

</body>
</html>
