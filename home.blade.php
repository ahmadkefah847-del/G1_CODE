<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('home.meta.title') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config={theme:{extend:{fontFamily:{sans:['Tajawal','sans-serif']},colors:{
        brand:{50:'#ecfdf5',100:'#d1fae5',200:'#a7f3d0',300:'#6ee7b7',400:'#34d399',500:'#10b981',600:'#059669',700:'#047857',800:'#065f46',900:'#064e3b'},
        ocean:{50:'#eff6ff',100:'#dbeafe',200:'#bfdbfe',400:'#60a5fa',500:'#3b82f6',600:'#2563eb'},
    }}}}
    </script>
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Tajawal',sans-serif;color:#1e293b;background:#fff;overflow-x:hidden}
        html{scroll-behavior:smooth}
        ::-webkit-scrollbar{width:6px}::-webkit-scrollbar-track{background:#f1f5f9}::-webkit-scrollbar-thumb{background:#10b981;border-radius:3px}
        .hero-video{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0}
        .fade-up{opacity:0;transform:translateY(40px);transition:all .8s cubic-bezier(.16,1,.3,1)}
        .fade-up.visible{opacity:1;transform:translateY(0)}
        .fade-left{opacity:0;transform:translateX(-40px);transition:all .8s cubic-bezier(.16,1,.3,1)}
        .fade-left.visible{opacity:1;transform:translateX(0)}
        .fade-right{opacity:0;transform:translateX(40px);transition:all .8s cubic-bezier(.16,1,.3,1)}
        .fade-right.visible{opacity:1;transform:translateX(0)}
        .scale-in{opacity:0;transform:scale(.9);transition:all .7s cubic-bezier(.16,1,.3,1)}
        .scale-in.visible{opacity:1;transform:scale(1)}
        @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-12px)}}
        @keyframes pulse-glow{0%,100%{box-shadow:0 0 0 0 rgba(16,185,129,.4)}50%{box-shadow:0 0 0 20px rgba(16,185,129,0)}}
        @keyframes scroll-hint{0%,100%{opacity:1;transform:translateY(0)}50%{opacity:.5;transform:translateY(8px)}}
        .float-anim{animation:float 3s ease-in-out infinite}
        .pulse-glow{animation:pulse-glow 2s infinite}
        .gradient-text{background:linear-gradient(135deg,#10b981,#3b82f6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        .card-hover{transition:all .4s cubic-bezier(.16,1,.3,1)}
        .card-hover:hover{transform:translateY(-8px);box-shadow:0 25px 60px rgba(0,0,0,.12)}
        .glass{background:rgba(255,255,255,.8);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px)}
        .nav-glass{background:rgba(255,255,255,.92);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px)}
        .nav-scrolled{background:rgba(255,255,255,.97);box-shadow:0 4px 30px rgba(0,0,0,.08)}
        .btn-primary{background:linear-gradient(135deg,#10b981,#059669);color:#fff;padding:14px 32px;border-radius:14px;font-weight:700;font-size:16px;border:none;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;gap:10px;text-decoration:none}
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 12px 30px rgba(16,185,129,.35)}
        .btn-secondary{background:#fff;color:#065f46;padding:14px 32px;border-radius:14px;font-weight:700;font-size:16px;border:2px solid #d1fae5;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;gap:10px;text-decoration:none}
        .btn-secondary:hover{background:#ecfdf5;border-color:#10b981;transform:translateY(-2px)}
        .section-badge{display:inline-flex;align-items:center;gap:8px;background:#ecfdf5;color:#059669;padding:8px 20px;border-radius:50px;font-size:13px;font-weight:700;letter-spacing:.5px}
        .feature-icon{width:64px;height:64px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:28px;transition:all .3s}
        .product-card{position:relative;overflow:hidden;border-radius:24px;background:#fff;border:1px solid #e2e8f0;transition:all .4s cubic-bezier(.16,1,.3,1)}
        .product-card:hover{transform:translateY(-8px);box-shadow:0 25px 60px rgba(0,0,0,.1);border-color:#d1fae5}
        .product-card:hover .product-img{transform:scale(1.05)}
        .product-img{transition:transform .6s cubic-bezier(.16,1,.3,1)}
        .service-card{border-radius:24px;padding:36px;background:#fff;border:1px solid #e2e8f0;transition:all .4s cubic-bezier(.16,1,.3,1);position:relative;overflow:hidden}
        .service-card::before{content:'';position:absolute;top:0;right:0;width:100px;height:100px;background:linear-gradient(135deg,rgba(16,185,129,.1),transparent);border-radius:0 0 0 100px;transition:all .4s}
        .service-card:hover{transform:translateY(-6px);box-shadow:0 20px 50px rgba(0,0,0,.08);border-color:#d1fae5}
        .service-card:hover::before{width:150px;height:150px}
        .consult-card{border-radius:24px;background:#fff;border:1px solid #e2e8f0;overflow:hidden;transition:all .4s cubic-bezier(.16,1,.3,1)}
        .consult-card:hover{transform:translateY(-6px);box-shadow:0 20px 50px rgba(0,0,0,.08)}
        .consult-card.featured{border:2px solid #10b981;position:relative}
        .consult-card.featured::after{content:'{{ __('home.landing.featured') }}';position:absolute;top:16px;left:-32px;background:linear-gradient(135deg,#10b981,#059669);color:#fff;padding:4px 40px;font-size:12px;font-weight:700;transform:rotate(-45deg)}
        [dir="ltr"] .consult-card.featured::after{left:auto;right:-32px;transform:rotate(45deg)}
    </style>
</head>
<body>
@php
    $langParam = ['lang' => app()->getLocale()];
    $homeUrl = route('home', $langParam);
@endphp

<!-- ============ NAVBAR ============ -->
<nav id="mainNav" class="fixed top-0 inset-x-0 z-50 nav-glass transition-all duration-300">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <a href="{{ $homeUrl }}" class="flex items-center">
                <img src="{{ asset('images/logo.jpeg') }}" alt="SOQIA" class="h-10 sm:h-12 w-auto object-contain">
            </a>
            <div class="hidden lg:flex items-center gap-1">
                <a href="{{ $homeUrl }}" class="px-4 py-2 rounded-xl text-sm font-bold text-brand-700 bg-brand-50">{{ __('home.nav.home') }}</a>
                <a href="#products" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-brand-700 hover:bg-brand-50 transition">{{ __('home.nav.products') }}</a>
                <a href="#services" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-brand-700 hover:bg-brand-50 transition">{{ __('home.nav.services') }}</a>
                <a href="#consultations" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-brand-700 hover:bg-brand-50 transition">{{ __('home.nav.consultations') }}</a>
                <a href="{{ route('awareness.index', $langParam) }}" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-brand-700 hover:bg-brand-50 transition">{{ __('home.nav.awareness') }}</a>
                <a href="{{ route('glossary', $langParam) }}" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-brand-700 hover:bg-brand-50 transition">{{ __('home.nav.glossary') }}</a>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ request()->fullUrlWithQuery(['lang' => app()->getLocale() === 'ar' ? 'en' : 'ar']) }}" class="w-9 h-9 rounded-xl bg-gray-100 flex items-center justify-center text-xs font-bold text-gray-600 hover:bg-brand-50 hover:text-brand-700 transition">
                    {{ app()->getLocale() === 'ar' ? 'EN' : 'AR' }}
                </a>
                @auth
                    <a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard', $langParam) : route('dashboard', $langParam) }}" class="btn-primary !py-2.5 !px-5 !text-sm">{{ __('home.nav.dashboard') }}</a>
                @else
                    <a href="{{ route('login', $langParam) }}" class="hidden sm:inline-flex btn-primary !py-2.5 !px-5 !text-sm">{{ __('home.nav.login') }}</a>
                @endauth
                <button id="mobileMenuBtn" class="lg:hidden w-10 h-10 rounded-xl bg-gray-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                </button>
            </div>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden lg:hidden border-t border-gray-100 bg-white">
        <div class="px-5 py-4 space-y-1">
            <a href="{{ $homeUrl }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-brand-700 bg-brand-50">{{ __('home.nav.home') }}</a>
            <a href="#products" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">{{ __('home.nav.products') }}</a>
            <a href="#services" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">{{ __('home.nav.services') }}</a>
            <a href="#consultations" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">{{ __('home.nav.consultations') }}</a>
            <a href="{{ route('awareness.index', $langParam) }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">{{ __('home.nav.awareness') }}</a>
            <a href="{{ route('glossary', $langParam) }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">{{ __('home.nav.glossary') }}</a>
            @guest
            <a href="{{ route('login', $langParam) }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-white bg-brand-600 text-center mt-2">{{ __('home.nav.login') }}</a>
            @endguest
        </div>
    </div>
</nav>

<!-- ============ HERO ============ -->
<section class="relative min-h-screen flex items-center overflow-hidden">
    <video class="hero-video" autoplay muted loop playsinline poster="{{ asset('images/home-hero.jpeg') }}">
        <source src="{{ asset('videos/hero.mp4') }}" type="video/mp4">
    </video>
    <div class="absolute inset-0 bg-gradient-to-b from-black/60 via-black/40 to-black/70 z-[1]"></div>
    <div class="absolute inset-0 bg-gradient-to-r from-brand-900/30 to-transparent z-[1]"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-5 lg:px-8 w-full pt-20">
        <div class="max-w-3xl">
            <div class="fade-up inline-flex items-center gap-2 bg-white/10 backdrop-blur-md rounded-full px-5 py-2.5 mb-6 border border-white/20">
                <span class="w-2 h-2 bg-brand-400 rounded-full animate-pulse"></span>
                <span class="text-white/90 text-sm font-medium">{{ __('home.hero.badge') }}</span>
            </div>
            <h1 class="fade-up text-4xl sm:text-5xl lg:text-7xl font-black text-white leading-tight" style="transition-delay:.1s">
                {{ __('home.hero.title_line_1') }}
                <br>
                <span class="text-brand-400">{{ __('home.hero.title_line_2') }}</span>
            </h1>
            <p class="fade-up text-lg sm:text-xl text-white/80 mt-6 max-w-xl leading-relaxed" style="transition-delay:.2s">
                {{ __('home.hero.subtitle') }}
            </p>
            <div class="fade-up flex flex-wrap gap-4 mt-10" style="transition-delay:.3s">
                <a href="#products" class="btn-primary text-base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                    {{ __('home.hero.buttons.explore') }}
                </a>
                <a href="#consultations" class="btn-secondary !bg-white/10 !text-white !border-white/20 hover:!bg-white/20 text-base">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                    {{ __('home.hero.buttons.consult') }}
                </a>
            </div>
        </div>

        <!-- Weather Widget -->
        <div class="fade-up mt-8 hidden md:flex mb-20  w-fit max-w-full items-center gap-4 bg-white/10 backdrop-blur-lg rounded-2xl px-6 py-4 border border-white/20" style="transition-delay:.5s">
            <div class="text-4xl">
                @if($weather['condition'] === 'clear') ☀️
                @elseif($weather['condition'] === 'cloudy') ⛅
                @elseif($weather['condition'] === 'rain') 🌧️
                @else 🌤️ @endif
            </div>
            <div class="min-w-0">
                <div class="text-white font-bold text-lg">{{ $weather['temperature'] }}°C</div>
                <div class="text-white/60 text-sm">{{ $weather['location'] }} • {{ __('home.weather.humidity') }} {{ $weather['humidity'] }}%</div>
            </div>
            <div class="w-px h-10 bg-white/20 mx-2"></div>
            <div class="min-w-0">
                <div class="text-brand-300 font-bold text-sm">{{ $recommendation['icon'] }} {{ app()->getLocale() === 'ar' ? $recommendation['message_ar'] : $recommendation['message_en'] }}</div>
                <div class="text-white/50 text-xs mt-0.5">{{ __('home.weather.recommendation_today') }}</div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 right-1/2 translate-x-1/2 z-10" style="animation:scroll-hint 2s infinite">
        <svg class="w-6 h-6 text-white/60" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
    </div>
</section>

<!-- ============ TRUST BAR ============ -->
<section class="relative -mt-16 z-20 max-w-6xl mx-auto px-5 lg:px-8">
    <div class="bg-white rounded-3xl shadow-xl shadow-gray-200/50 border border-gray-100 p-8 lg:p-10">
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-10">
            <div class="fade-up text-center">
                <div class="text-3xl lg:text-4xl font-black text-brand-600 stat-num" data-target="50" data-suffix="+">0</div>
                <div class="text-sm text-gray-500 mt-1 font-medium">{{ __('home.stats.labels.projects') }}</div>
            </div>
            <div class="fade-up text-center" style="transition-delay:.1s">
                <div class="text-3xl lg:text-4xl font-black text-ocean-600 stat-num" data-target="200" data-suffix="+">0</div>
                <div class="text-sm text-gray-500 mt-1 font-medium">{{ __('home.stats.labels.clients') }}</div>
            </div>
            <div class="fade-up text-center" style="transition-delay:.2s">
                <div class="text-3xl lg:text-4xl font-black text-brand-600 stat-num" data-target="1000000" data-suffix="">0</div>
                <div class="text-sm text-gray-500 mt-1 font-medium">{{ __('home.stats.labels.water') }}</div>
            </div>
            <div class="fade-up text-center" style="transition-delay:.3s">
                <div class="text-3xl lg:text-4xl font-black text-ocean-600 stat-num" data-target="10" data-suffix="+">0</div>
                <div class="text-sm text-gray-500 mt-1 font-medium">{{ __('home.stats.labels.experience') }}</div>
            </div>
        </div>
    </div>
</section>
<!-- News Ticker -->
@php
    $dayOfYear = date('z') + 1;
    $dailyTip = \App\Models\DailyTip::where('day_number', $dayOfYear)->where('active', true)->first();
@endphp
@if($dailyTip)
<div class="max-w-5xl mx-auto px-5 lg:px-8 my-6">
    <div style="background:#059669;color:#fff;padding:14px 0;overflow:hidden;white-space:nowrap;border-radius:16px;">
        <div id="ticker-text" style="display:inline-block;font-size:16px;font-weight:600;">
            &nbsp;&nbsp;&nbsp; 🌿 {{ app()->getLocale() === 'ar' ? $dailyTip->tip_ar : ($dailyTip->tip_en ?: $dailyTip->tip_ar) }} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </div>
    </div>
</div>
<script>
    const el = document.getElementById('ticker-text');
    const isRtl = document.documentElement.dir === 'rtl';
    let pos = isRtl ? -el.offsetWidth : window.innerWidth;
    function tick() {
        pos += isRtl ? 0.8 : -0.8;
        if (isRtl && pos > window.innerWidth) pos = -el.offsetWidth;
        if (!isRtl && pos < -el.offsetWidth) pos = window.innerWidth;
        el.style.transform = 'translateX(' + pos + 'px)';
        requestAnimationFrame(tick);
    }
    tick();
</script>
@endif
<!-- ============ WHY SOQIA ============ -->
<section class="py-24 lg:py-32">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="fade-up section-badge mb-4">{{ __('home.why.badge') }}</div>
            <h2 class="fade-up text-3xl lg:text-5xl font-black text-gray-900" style="transition-delay:.1s">{{ __('home.why.title_prefix') }} <span class="gradient-text">{{ __('home.why.title_highlight') }}</span></h2>
            <p class="fade-up text-gray-500 mt-4 text-lg leading-relaxed" style="transition-delay:.2s">{{ __('home.why.description') }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="fade-up group p-8 rounded-3xl bg-white border border-gray-100 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-100/50 transition-all duration-500">
                <div class="feature-icon bg-brand-50 group-hover:bg-brand-500 group-hover:text-white text-brand-600 mb-5">💧</div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('home.why.items.1.title') }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ __('home.why.items.1.description') }}</p>
            </div>
            <div class="fade-up group p-8 rounded-3xl bg-white border border-gray-100 hover:border-ocean-200 hover:shadow-xl hover:shadow-ocean-100/50 transition-all duration-500" style="transition-delay:.1s">
                <div class="feature-icon bg-ocean-50 group-hover:bg-ocean-500 group-hover:text-white text-ocean-600 mb-5">📱</div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('home.why.items.2.title') }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ __('home.why.items.2.description') }}</p>
            </div>
            <div class="fade-up group p-8 rounded-3xl bg-white border border-gray-100 hover:border-brand-200 hover:shadow-xl hover:shadow-brand-100/50 transition-all duration-500" style="transition-delay:.2s">
                <div class="feature-icon bg-amber-50 group-hover:bg-amber-500 group-hover:text-white text-amber-600 mb-5">🌱</div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('home.why.items.3.title') }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ __('home.why.items.3.description') }}</p>
            </div>
            <div class="fade-up group p-8 rounded-3xl bg-white border border-gray-100 hover:border-ocean-200 hover:shadow-xl hover:shadow-ocean-100/50 transition-all duration-500" style="transition-delay:.3s">
                <div class="feature-icon bg-purple-50 group-hover:bg-purple-500 group-hover:text-white text-purple-600 mb-5">🔬</div>
                <h3 class="text-lg font-bold text-gray-900 mb-2">{{ __('home.why.items.4.title') }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ __('home.why.items.4.description') }}</p>
            </div>
        </div>
    </div>
</section>

<!-- ============ PRODUCTS ============ -->
<section id="products" class="py-24 lg:py-32 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-16">
            <div>
                <div class="fade-up section-badge mb-4">{{ __('home.landing_products.badge') }}</div>
                <h2 class="fade-up text-3xl lg:text-5xl font-black text-gray-900" style="transition-delay:.1s">{{ __('home.landing.products_title_prefix') }} <span class="gradient-text">{{ __('home.landing.products_title_highlight') }}</span></h2>
                <p class="fade-up text-gray-500 mt-3 max-w-lg" style="transition-delay:.2s">{{ __('home.landing_products.description') }}</p>
            </div>
            <a href="#consultations" class="fade-up btn-secondary mt-6 lg:mt-0 !py-3" style="transition-delay:.3s">
                {{ __('home.landing.quote') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="fade-up product-card">
                <div class="relative overflow-hidden h-56 bg-gradient-to-br from-brand-100 to-brand-50">
                    <img src="{{ asset('images/drip.jpg') }}" alt="{{ __('home.tabs.products.items.1.title') }}" class="product-img w-full h-full object-cover">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md rounded-xl px-4 py-1.5 text-sm font-bold text-brand-700 shadow-lg">{{ __('home.landing.product_badges.1') }}</div>
                </div>
                <div class="p-7">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-8 h-8 bg-brand-50 rounded-lg flex items-center justify-center text-lg">💧</span>
                        <h3 class="text-xl font-bold text-gray-900">{{ __('home.tabs.products.items.1.title') }}</h3>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ __('home.landing_products.items.1.description') }}</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-2xl font-black text-brand-600">2,500</span>
                            <span class="text-sm text-gray-400 mr-1">{{ __('home.landing.currency') }}</span>
                        </div>
                        <a href="#consultations" class="px-5 py-2.5 rounded-xl bg-brand-50 text-brand-700 font-bold text-sm hover:bg-brand-100 transition">{{ __('home.landing.order_now') }}</a>
                    </div>
                </div>
            </div>
            <div class="fade-up product-card" style="transition-delay:.1s">
                <div class="relative overflow-hidden h-56 bg-gradient-to-br from-ocean-100 to-ocean-50">
                    <img src="{{ asset('images/farm1.jpg') }}" alt="{{ __('home.tabs.products.items.2.title') }}" class="product-img w-full h-full object-cover">
                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur-md rounded-xl px-4 py-1.5 text-sm font-bold text-ocean-600 shadow-lg">{{ __('home.landing.product_badges.2') }}</div>
                </div>
                <div class="p-7">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-8 h-8 bg-ocean-50 rounded-lg flex items-center justify-center text-lg">📱</span>
                        <h3 class="text-xl font-bold text-gray-900">{{ __('home.tabs.products.items.2.title') }}</h3>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ __('home.landing_products.items.2.description') }}</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-2xl font-black text-ocean-600">1,800</span>
                            <span class="text-sm text-gray-400 mr-1">{{ __('home.landing.currency') }}</span>
                        </div>
                        <a href="#consultations" class="px-5 py-2.5 rounded-xl bg-ocean-50 text-ocean-600 font-bold text-sm hover:bg-ocean-100 transition">{{ __('home.landing.order_now') }}</a>
                    </div>
                </div>
            </div>
            <div class="fade-up product-card" style="transition-delay:.2s">
                <div class="relative overflow-hidden h-56 bg-gradient-to-br from-amber-100 to-amber-50">
                    <img src="{{ asset('images/stats.png') }}" alt="{{ __('home.tabs.products.items.3.title') }}" class="product-img w-full h-full object-cover">
                </div>
                <div class="p-7">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="w-8 h-8 bg-amber-50 rounded-lg flex items-center justify-center text-lg">🌱</span>
                        <h3 class="text-xl font-bold text-gray-900">{{ __('home.tabs.products.items.3.title') }}</h3>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ __('home.landing_products.items.3.description') }}</p>
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-2xl font-black text-amber-600">350</span>
                            <span class="text-sm text-gray-400 mr-1">{{ __('home.landing.currency') }}</span>
                        </div>
                        <a href="#consultations" class="px-5 py-2.5 rounded-xl bg-amber-50 text-amber-700 font-bold text-sm hover:bg-amber-100 transition">{{ __('home.landing.order_now') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ SERVICES ============ -->
<section id="services" class="py-24 lg:py-32">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="fade-up section-badge mb-4">{{ __('home.landing_services.badge') }}</div>
            <h2 class="fade-up text-3xl lg:text-5xl font-black text-gray-900" style="transition-delay:.1s">{{ __('home.landing.services_title_prefix') }} <span class="gradient-text">{{ __('home.landing.services_title_highlight') }}</span></h2>
            <p class="fade-up text-gray-500 mt-4 text-lg" style="transition-delay:.2s">{{ __('home.landing_services.description') }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="fade-up service-card">
                <div class="w-16 h-16 bg-gradient-to-br from-brand-500 to-brand-700 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-brand-500/25">🏗️</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('home.tabs.services.items.1.title') }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ __('home.landing_services.items.1.description') }}</p>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-center gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-brand-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>{{ __('home.tabs.services.items.1.points.1') }}</li>
                    <li class="flex items-center gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-brand-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>{{ __('home.tabs.services.items.1.points.2') }}</li>
                    <li class="flex items-center gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-brand-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>{{ __('home.tabs.services.items.1.points.3') }}</li>
                </ul>
                <div class="flex items-center justify-between pt-5 border-t border-gray-100">
                    <span class="text-sm text-gray-400">{{ __('home.landing.starts_from') }}</span>
                    <span class="text-xl font-black text-brand-600">{{ __('home.tabs.services.items.1.price') }}</span>
                </div>
            </div>
            <div class="fade-up service-card" style="transition-delay:.1s">
                <div class="w-16 h-16 bg-gradient-to-br from-ocean-500 to-ocean-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-ocean-500/25">🔗</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('home.tabs.services.items.2.title') }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ __('home.landing_services.items.2.description') }}</p>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-center gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-ocean-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>{{ __('home.tabs.services.items.2.points.1') }}</li>
                    <li class="flex items-center gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-ocean-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>{{ __('home.tabs.services.items.2.points.2') }}</li>
                    <li class="flex items-center gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-ocean-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>{{ __('home.tabs.services.items.2.points.3') }}</li>
                </ul>
                <div class="flex items-center justify-between pt-5 border-t border-gray-100">
                    <span class="text-sm text-gray-400">{{ __('home.landing.starts_from') }}</span>
                    <span class="text-xl font-black text-ocean-600">{{ __('home.tabs.services.items.2.price') }}</span>
                </div>
            </div>
            <div class="fade-up service-card" style="transition-delay:.2s">
                <div class="w-16 h-16 bg-gradient-to-br from-amber-400 to-amber-600 rounded-2xl flex items-center justify-center text-3xl mb-6 shadow-lg shadow-amber-500/25">🛠️</div>
                <h3 class="text-xl font-bold text-gray-900 mb-3">{{ __('home.tabs.services.items.3.title') }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed mb-5">{{ __('home.landing_services.items.3.description') }}</p>
                <ul class="space-y-3 mb-6">
                    <li class="flex items-center gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>{{ __('home.tabs.services.items.3.points.1') }}</li>
                    <li class="flex items-center gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>{{ __('home.tabs.services.items.3.points.2') }}</li>
                    <li class="flex items-center gap-3 text-sm text-gray-600"><svg class="w-5 h-5 text-amber-500 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>{{ __('home.tabs.services.items.3.points.3') }}</li>
                </ul>
                <div class="flex items-center justify-between pt-5 border-t border-gray-100">
                    <span class="text-sm text-gray-400">{{ __('home.landing.monthly_plans') }}</span>
                    <span class="text-xl font-black text-amber-600">{{ __('home.landing.flexible') }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ AWARENESS CONTENT ============ -->
@if(isset($contents) && $contents->count())
<section class="py-24 lg:py-32 bg-gradient-to-b from-white to-gray-50">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between mb-16">
            <div>
                <div class="fade-up section-badge mb-4">{{ __('home.awareness_section.badge') }}</div>
                <h2 class="fade-up text-3xl lg:text-5xl font-black text-gray-900" style="transition-delay:.1s">{{ __('home.landing.awareness_title_prefix') }} <span class="gradient-text">{{ __('home.landing.awareness_title_highlight') }}</span></h2>
            </div>
            <a href="{{ route('awareness.index', $langParam) }}" class="fade-up btn-secondary mt-6 lg:mt-0 !py-3" style="transition-delay:.2s">
                {{ __('home.landing.view_all') }}
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($contents as $idx => $item)
            <div class="fade-up product-card" style="transition-delay:{{ $idx * 0.1 }}s">
                <div class="relative overflow-hidden h-48">
                    <img src="{{ $item->image_path ? asset($item->image_path) : asset('images/farm1.jpg') }}" alt="{{ $item->title }}" class="product-img w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                    <div class="absolute bottom-3 right-3 bg-brand-500/90 backdrop-blur-sm text-white text-xs font-bold px-3 py-1.5 rounded-lg">
                        {{ __('home.awareness_section.types.' . $item->type) }}
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">{{ $item->title }}</h3>
                    @if($item->body)
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-2">{{ \Illuminate\Support\Str::limit(strip_tags($item->body), 100) }}</p>
                    @endif
                    <div class="flex items-center justify-between mt-4 pt-4 border-t border-gray-50">
                        <span class="text-xs text-gray-400">{{ $item->created_at->format('Y-m-d') }}</span>
                        <span class="text-brand-600 text-sm font-bold">{{ __('home.landing.read_more') }} ←</span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ============ CONSULTATIONS ============ -->
<section id="consultations" class="py-24 lg:py-32 bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="fade-up section-badge mb-4">{{ __('home.consultations.badge') }}</div>
            <h2 class="fade-up text-3xl lg:text-5xl font-black text-gray-900" style="transition-delay:.1s">{{ __('home.landing.consult_title_prefix') }} <span class="gradient-text">{{ __('home.landing.consult_title_highlight') }}</span></h2>
            <p class="fade-up text-gray-500 mt-4 text-lg" style="transition-delay:.2s">{{ __('home.consultations.description') }}</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="fade-up consult-card">
                <div class="p-8">
                    <div class="w-14 h-14 bg-brand-50 rounded-2xl flex items-center justify-center text-2xl mb-5">📈</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('home.tabs.consult.items.1.title') }}</h3>
                    <p class="text-gray-500 text-sm mb-6">{{ __('home.tabs.consult.items.1.description') }}</p>
                    <ul class="space-y-2.5 mb-8">
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-brand-500">✓</span> {{ __('home.tabs.consult.items.1.includes.1') }}</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-brand-500">✓</span> {{ __('home.tabs.consult.items.1.includes.2') }}</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-brand-500">✓</span> {{ __('home.tabs.consult.items.1.includes.3') }}</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-brand-500">✓</span> {{ __('home.tabs.consult.items.1.includes.4') }}</li>
                    </ul>
                </div>
                <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <div class="text-xs text-gray-400">{{ __('home.landing.duration') }}: {{ __('home.tabs.consult.items.1.duration') }}</div>
                        <div class="text-2xl font-black text-brand-600">{{ __('home.tabs.consult.items.1.price') }}</div>
                    </div>
                    <a href="{{ route('register', $langParam) }}" class="px-5 py-2.5 rounded-xl bg-brand-600 text-white font-bold text-sm hover:bg-brand-700 transition shadow-lg shadow-brand-600/25">{{ __('home.landing.book_now') }}</a>
                </div>
            </div>
            <div class="fade-up consult-card featured" style="transition-delay:.1s">
                <div class="p-8">
                    <div class="w-14 h-14 bg-ocean-50 rounded-2xl flex items-center justify-center text-2xl mb-5">🔧</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('home.tabs.consult.items.2.title') }}</h3>
                    <p class="text-gray-500 text-sm mb-6">{{ __('home.tabs.consult.items.2.description') }}</p>
                    <ul class="space-y-2.5 mb-8">
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-ocean-500">✓</span> {{ __('home.tabs.consult.items.2.includes.1') }}</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-ocean-500">✓</span> {{ __('home.tabs.consult.items.2.includes.2') }}</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-ocean-500">✓</span> {{ __('home.tabs.consult.items.2.includes.3') }}</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-ocean-500">✓</span> {{ __('home.tabs.consult.items.2.includes.4') }}</li>
                    </ul>
                </div>
                <div class="px-8 py-5 bg-brand-50 border-t border-brand-100 flex items-center justify-between">
                    <div>
                        <div class="text-xs text-gray-400">{{ __('home.landing.duration') }}: {{ __('home.tabs.consult.items.2.duration') }}</div>
                        <div class="text-2xl font-black text-brand-600">{{ __('home.tabs.consult.items.2.price') }}</div>
                    </div>
                    <a href="{{ route('register', $langParam) }}" class="px-5 py-2.5 rounded-xl bg-brand-600 text-white font-bold text-sm hover:bg-brand-700 transition shadow-lg shadow-brand-600/25">{{ __('home.landing.book_now') }}</a>
                </div>
            </div>
            <div class="fade-up consult-card" style="transition-delay:.2s">
                <div class="p-8">
                    <div class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-2xl mb-5">🌱</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ __('home.tabs.consult.items.3.title') }}</h3>
                    <p class="text-gray-500 text-sm mb-6">{{ __('home.tabs.consult.items.3.description') }}</p>
                    <ul class="space-y-2.5 mb-8">
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-green-500">✓</span> {{ __('home.tabs.consult.items.3.includes.1') }}</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-green-500">✓</span> {{ __('home.tabs.consult.items.3.includes.2') }}</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-green-500">✓</span> {{ __('home.tabs.consult.items.3.includes.3') }}</li>
                        <li class="flex items-center gap-2 text-sm text-gray-600"><span class="text-green-500">✓</span> {{ __('home.tabs.consult.items.3.includes.4') }}</li>
                    </ul>
                </div>
                <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex items-center justify-between">
                    <div>
                        <div class="text-xs text-gray-400">{{ __('home.landing.duration') }}: {{ __('home.tabs.consult.items.3.duration') }}</div>
                        <div class="text-2xl font-black text-brand-600">{{ __('home.tabs.consult.items.3.price') }}</div>
                    </div>
                    <a href="{{ route('register', $langParam) }}" class="px-5 py-2.5 rounded-xl bg-brand-600 text-white font-bold text-sm hover:bg-brand-700 transition shadow-lg shadow-brand-600/25">{{ __('home.landing.book_now') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ TESTIMONIALS ============ -->
<section class="py-24 lg:py-32">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-16">
            <div class="fade-up section-badge mb-4">{{ __('home.testimonials.badge') }}</div>
            <h2 class="fade-up text-3xl lg:text-5xl font-black text-gray-900" style="transition-delay:.1s">{{ __('home.landing.reviews_title_prefix') }} <span class="gradient-text">{{ __('home.landing.reviews_title_highlight') }}</span></h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="fade-up p-8 rounded-3xl bg-white border border-gray-100 hover:shadow-xl transition-all duration-500">
                <div class="flex items-center gap-1 mb-4">
                    <span class="text-amber-400 text-lg">★★★★★</span>
                </div>
                <p class="text-gray-600 leading-relaxed mb-6">"{{ __('home.testimonials.items.1.text') }}"</p>
                <div class="flex items-center gap-3 pt-5 border-t border-gray-50">
                    <div class="w-11 h-11 bg-gradient-to-br from-brand-400 to-brand-600 rounded-full flex items-center justify-center text-white font-bold">{{ __('home.testimonials.items.1.initial') }}</div>
                    <div>
                        <div class="font-bold text-gray-900 text-sm">{{ __('home.testimonials.items.1.name') }}</div>
                        <div class="text-xs text-gray-400">{{ __('home.testimonials.items.1.role') }}</div>
                    </div>
                </div>
            </div>
            <div class="fade-up p-8 rounded-3xl bg-white border border-gray-100 hover:shadow-xl transition-all duration-500" style="transition-delay:.1s">
                <div class="flex items-center gap-1 mb-4">
                    <span class="text-amber-400 text-lg">★★★★★</span>
                </div>
                <p class="text-gray-600 leading-relaxed mb-6">"{{ __('home.testimonials.items.2.text') }}"</p>
                <div class="flex items-center gap-3 pt-5 border-t border-gray-50">
                    <div class="w-11 h-11 bg-gradient-to-br from-ocean-400 to-ocean-600 rounded-full flex items-center justify-center text-white font-bold">{{ __('home.testimonials.items.2.initial') }}</div>
                    <div>
                        <div class="font-bold text-gray-900 text-sm">{{ __('home.testimonials.items.2.name') }}</div>
                        <div class="text-xs text-gray-400">{{ __('home.testimonials.items.2.role') }}</div>
                    </div>
                </div>
            </div>
            <div class="fade-up p-8 rounded-3xl bg-white border border-gray-100 hover:shadow-xl transition-all duration-500" style="transition-delay:.2s">
                <div class="flex items-center gap-1 mb-4">
                    <span class="text-amber-400 text-lg">★★★★★</span>
                </div>
                <p class="text-gray-600 leading-relaxed mb-6">"{{ __('home.testimonials.items.3.text') }}"</p>
                <div class="flex items-center gap-3 pt-5 border-t border-gray-50">
                    <div class="w-11 h-11 bg-gradient-to-br from-amber-400 to-amber-600 rounded-full flex items-center justify-center text-white font-bold">{{ __('home.testimonials.items.3.initial') }}</div>
                    <div>
                        <div class="font-bold text-gray-900 text-sm">{{ __('home.testimonials.items.3.name') }}</div>
                        <div class="text-xs text-gray-400">{{ __('home.testimonials.items.3.role') }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ============ CTA BANNER ============ -->
<section class="py-24 lg:py-32 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-brand-800 via-brand-900 to-slate-900"></div>
    <div class="absolute inset-0 opacity-10" style="background-image:url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;0.4&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    <div class="relative z-10 max-w-4xl mx-auto px-5 lg:px-8 text-center">
        <div class="fade-up">
            <div class="inline-flex items-center gap-2 bg-white/10 backdrop-blur-md rounded-full px-5 py-2 mb-6 border border-white/20">
                <span class="text-brand-300 text-sm font-medium">{{ __('home.final_cta.badge') }}</span>
            </div>
            <h2 class="text-3xl lg:text-5xl font-black text-white leading-tight">{{ __('home.final_cta.title_line_1') }}<br>{{ __('home.final_cta.title_line_2') }}</h2>
            <p class="text-white/70 mt-6 text-lg max-w-2xl mx-auto">{{ __('home.final_cta.description') }}</p>
            <div class="flex flex-wrap items-center justify-center gap-4 mt-10">
                <a href="{{ route('register', $langParam) }}" class="btn-primary pulse-glow !text-lg !px-10 !py-4">
                    {{ __('home.final_cta.primary') }}
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                </a>
                <a href="#products" class="btn-secondary !bg-white/10 !text-white !border-white/20 hover:!bg-white/20 !text-lg !px-10 !py-4">{{ __('home.final_cta.secondary') }}</a>
            </div>
        </div>
    </div>
</section>

<!-- ============ FOOTER ============ -->
<footer class="bg-slate-900 text-white pt-20 pb-8">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 pb-16 border-b border-white/10">
            <div>
                <div class="flex items-center mb-5">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="SOQIA" class="h-14 w-auto object-contain rounded bg-white p-1">
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">{{ __('home.footer.description') }}</p>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-5">{{ __('home.footer.quick_links') }}</h4>
                <ul class="space-y-3">
                    <li><a href="{{ $homeUrl }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.home') }}</a></li>
                    <li><a href="#products" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.products') }}</a></li>
                    <li><a href="#services" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.services') }}</a></li>
                    <li><a href="#consultations" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.consultations') }}</a></li>
                    <li><a href="{{ route('awareness.index', $langParam) }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.awareness') }}</a></li>
                    <li><a href="{{ route('glossary', $langParam) }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.glossary') }}</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-5">{{ __('home.footer.account') }}</h4>
                <ul class="space-y-3">
                    <li><a href="{{ route('login', $langParam) }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.login') }}</a></li>
                    <li><a href="{{ route('register', $langParam) }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.footer.register') }}</a></li>
                    @auth
                    <li><a href="{{ auth()->user()->role === 'admin' ? route('admin.dashboard', $langParam) : route('dashboard', $langParam) }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.dashboard') }}</a></li>
                    @endauth
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg mb-5">{{ __('home.footer.contact') }}</h4>
                <ul class="space-y-3">
                    <li class="flex items-center gap-3 text-gray-400 text-sm">
                        <svg class="w-4 h-4 text-brand-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        infosoqia@gmail.com
                    </li>
                    <li class="flex items-center gap-3 text-gray-400 text-sm">
                        <svg class="w-4 h-4 text-brand-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ __('home.footer.location') }}
                    </li>
                    <li class="flex items-center gap-3 text-gray-400 text-sm">
                        <svg class="w-4 h-4 text-brand-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        <a href="tel:+96278XXXXXXX" dir="ltr" class="hover:text-brand-400 transition">+962 786668371</a>
                        <li class="flex items-center gap-3 text-gray-400 text-sm">
    <svg class="w-4 h-4 text-blue-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
    </svg>
    <a href="https://www.facebook.com/share/1E2EY6QL5b/?mibextid=wwXIfr" target="_blank" class="hover:text-blue-400 transition">
         Facebook Page
    </a>
</li>
                        <li class="flex items-center gap-3 text-gray-400 text-sm">
    <svg class="w-4 h-4 text-red-500 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
        <path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
    </svg>
    <a href="https://www.youtube.com/@SOQIA-IES" target="_blank" class="hover:text-red-400 transition">
         YouTube Channel
    </a>
</li>
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-between pt-8 gap-4">
            <p class="text-gray-500 text-sm">© {{ date('Y') }} SOQIA. {{ __('home.footer.rights') }}</p>
            <div class="flex items-center gap-4">
                <a href="#" class="w-9 h-9 bg-white/5 hover:bg-brand-600 rounded-lg flex items-center justify-center transition">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                </a>
                <a href="#" class="w-9 h-9 bg-white/5 hover:bg-brand-600 rounded-lg flex items-center justify-center transition">
                    <svg class="w-4 h-4 text-gray-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12.017 0C5.396 0 .029 5.367.029 11.987c0 5.079 3.158 9.417 7.618 11.162-.105-.949-.199-2.403.042-3.441.219-.937 1.407-5.965 1.407-5.965s-.359-.719-.359-1.782c0-1.668.967-2.914 2.171-2.914 1.023 0 1.518.769 1.518 1.69 0 1.029-.655 2.568-.994 3.995-.283 1.194.599 2.169 1.777 2.169 2.133 0 3.772-2.249 3.772-5.495 0-2.873-2.064-4.882-5.012-4.882-3.414 0-5.418 2.561-5.418 5.207 0 1.031.397 2.138.893 2.738a.36.36 0 01.083.345l-.333 1.36c-.053.22-.174.267-.402.161-1.499-.698-2.436-2.889-2.436-4.649 0-3.785 2.75-7.262 7.929-7.262 4.163 0 7.398 2.967 7.398 6.931 0 4.136-2.607 7.464-6.227 7.464-1.216 0-2.359-.631-2.75-1.378l-.748 2.853c-.271 1.043-1.002 2.35-1.492 3.146C9.57 23.812 10.763 24 12.017 24c6.624 0 11.99-5.367 11.99-11.988C24.007 5.367 18.641.001 12.017.001z"/></svg>
                </a>
            </div>
        </div>
    </div>
</footer>

<!-- ============ SCRIPTS ============ -->
<script>
// Mobile menu
document.getElementById('mobileMenuBtn')?.addEventListener('click',()=>{
    document.getElementById('mobileMenu')?.classList.toggle('hidden');
});

// Navbar scroll effect
const nav=document.getElementById('mainNav');
window.addEventListener('scroll',()=>{
    nav.classList.toggle('nav-scrolled',window.scrollY>50);
});

// Intersection Observer for animations
const observer=new IntersectionObserver((entries)=>{
    entries.forEach(e=>{
        if(e.isIntersecting){
            e.target.classList.add('visible');
            observer.unobserve(e.target);
        }
    });
},{threshold:0.1,rootMargin:'0px 0px -50px 0px'});
document.querySelectorAll('.fade-up,.fade-left,.fade-right,.scale-in').forEach(el=>observer.observe(el));

// Stats counter animation
const statsObserver=new IntersectionObserver((entries)=>{
    entries.forEach(entry=>{
        if(entry.isIntersecting){
            document.querySelectorAll('.stat-num').forEach(el=>{
                const target=parseInt(el.dataset.target,10);
                const suffix=el.dataset.suffix||'';
                const duration=2000;
                const start=performance.now();
                function tick(now){
                    const p=Math.min((now-start)/duration,1);
                    const eased=1-Math.pow(1-p,3);
                    const val=Math.floor(target*eased);
                    el.textContent=val.toLocaleString()+suffix;
                    if(p<1)requestAnimationFrame(tick);
                }
                requestAnimationFrame(tick);
            });
            statsObserver.disconnect();
        }
    });
},{threshold:.3});
const statSection=document.querySelector('.stat-num');
if(statSection)statsObserver.observe(statSection.closest('section'));

// Close mobile menu on link click
document.querySelectorAll('#mobileMenu a').forEach(a=>{
    a.addEventListener('click',()=>document.getElementById('mobileMenu')?.classList.add('hidden'));
});
</script>
<a href="https://wa.me/962786668371" target="_blank"
   class="fixed bottom-6 z-50 w-24 h-24 bg-green-500 hover:bg-green-600 rounded-full flex items-center justify-center shadow-lg hover:shadow-xl transition-all duration-300 {{ app()->getLocale() === 'ar' ? 'left-6' : 'right-6' }}">
    <svg class="w-14 h-14 text-white" fill="currentColor" viewBox="0 0 24 24">
        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
    </svg>
</a>
<!-- Floating Particles -->
<div id="particles" style="position:fixed;inset:0;pointer-events:none;z-index:0;overflow:hidden;"></div>
<script>
const container = document.getElementById('particles');
const count = 20;
for (let i = 0; i < count; i++) {
    const el = document.createElement('div');
    const size = Math.random() * 20 + 10;
    const x = Math.random() * 100;
    const duration = Math.random() * 15 + 10;
    const delay = Math.random() * 2;
    const isLeaf = i % 4 === 0;
    el.style.cssText = `
        position:absolute;
        width:${size}px;
        height:${size}px;
        left:${x}%;
        bottom:-50px;
        ${isLeaf ? '' : 'background:rgba(16,185,129,0.15);border-radius:50%;'}
        animation:floatUp ${duration}s ${delay}s infinite ease-in-out;
        font-size:${size}px;
        line-height:1;
    `;
    el.innerHTML = isLeaf ? '🌿' : '';
    container.appendChild(el);
}
</script>
<style>
@keyframes floatUp {
    0%   { transform: translateY(0) rotate(0deg); opacity:0; }
    10%  { opacity:1; }
    90%  { opacity:0.5; }
    100% { transform: translateY(-100vh) rotate(360deg); opacity:0; }
}
</style>
</body>
</html>
