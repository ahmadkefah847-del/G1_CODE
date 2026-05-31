<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ __('awareness.meta.title') }}</title>
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
        .fade-up{opacity:0;transform:translateY(40px);transition:all .8s cubic-bezier(.16,1,.3,1)}
        .fade-up.visible{opacity:1;transform:translateY(0)}
        .gradient-text{background:linear-gradient(135deg,#10b981,#3b82f6);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text}
        .nav-glass{background:rgba(255,255,255,.92);backdrop-filter:blur(20px);-webkit-backdrop-filter:blur(20px)}
        .nav-scrolled{background:rgba(255,255,255,.97);box-shadow:0 4px 30px rgba(0,0,0,.08)}
        .btn-primary{background:linear-gradient(135deg,#10b981,#059669);color:#fff;padding:14px 32px;border-radius:14px;font-weight:700;font-size:16px;border:none;cursor:pointer;transition:all .3s;display:inline-flex;align-items:center;gap:10px;text-decoration:none}
        .btn-primary:hover{transform:translateY(-2px);box-shadow:0 12px 30px rgba(16,185,129,.35)}
        .section-badge{display:inline-flex;align-items:center;gap:8px;background:#ecfdf5;color:#059669;padding:8px 20px;border-radius:50px;font-size:13px;font-weight:700}
        .content-card{border-radius:24px;overflow:hidden;background:#fff;border:1px solid #e2e8f0;transition:all .4s cubic-bezier(.16,1,.3,1)}
        .content-card:hover{transform:translateY(-8px);box-shadow:0 25px 60px rgba(0,0,0,.1);border-color:#d1fae5}
        .content-card:hover .card-img{transform:scale(1.05)}
        .card-img{transition:transform .6s cubic-bezier(.16,1,.3,1)}
        .filter-btn{padding:10px 24px;border-radius:50px;font-weight:700;font-size:14px;border:2px solid #e2e8f0;background:#fff;color:#64748b;cursor:pointer;transition:all .3s}
        .filter-btn:hover{border-color:#d1fae5;color:#059669}
        .filter-btn.active{background:linear-gradient(135deg,#10b981,#059669);color:#fff;border-color:transparent;box-shadow:0 4px 15px rgba(16,185,129,.3)}
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
                <a href="{{ $homeUrl }}" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-brand-700 hover:bg-brand-50 transition">{{ __('home.nav.home') }}</a>
                <a href="{{ $homeUrl }}#products" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-brand-700 hover:bg-brand-50 transition">{{ __('home.nav.products') }}</a>
                <a href="{{ $homeUrl }}#services" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-brand-700 hover:bg-brand-50 transition">{{ __('home.nav.services') }}</a>
                <a href="{{ $homeUrl }}#consultations" class="px-4 py-2 rounded-xl text-sm font-medium text-gray-600 hover:text-brand-700 hover:bg-brand-50 transition">{{ __('home.nav.consultations') }}</a>
                <a href="{{ route('awareness.index', $langParam) }}" class="px-4 py-2 rounded-xl text-sm font-bold text-brand-700 bg-brand-50">{{ __('home.nav.awareness') }}</a>
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
    <div id="mobileMenu" class="hidden lg:hidden border-t border-gray-100 bg-white">
        <div class="px-5 py-4 space-y-1">
            <a href="{{ $homeUrl }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">{{ __('home.nav.home') }}</a>
            <a href="{{ route('awareness.index', $langParam) }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-brand-700 bg-brand-50">{{ __('home.nav.awareness') }}</a>
            <a href="{{ route('glossary', $langParam) }}" class="block px-4 py-3 rounded-xl text-sm font-medium text-gray-600 hover:bg-gray-50">{{ __('home.nav.glossary') }}</a>
            @guest
            <a href="{{ route('login', $langParam) }}" class="block px-4 py-3 rounded-xl text-sm font-bold text-white bg-brand-600 text-center mt-2">{{ __('home.nav.login') }}</a>
            @endguest
        </div>
    </div>
</nav>

<!-- ============ HERO BANNER ============ -->
<section class="relative pt-32 pb-20 lg:pt-40 lg:pb-28 overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-brand-50 via-white to-ocean-50"></div>
    <div class="absolute top-20 right-10 w-72 h-72 bg-brand-200/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-10 left-10 w-96 h-96 bg-ocean-200/20 rounded-full blur-3xl"></div>
    <div class="relative z-10 max-w-7xl mx-auto px-5 lg:px-8">
        <div class="max-w-3xl mx-auto text-center">
            <div class="fade-up section-badge mb-6 mx-auto w-fit">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
                {{ __('awareness.hero.badge') }}
            </div>
            <h1 class="fade-up text-4xl lg:text-6xl font-black text-gray-900 leading-tight" style="transition-delay:.1s">
                {{ __('awareness.hero.title_prefix') }}
                <span class="gradient-text">{{ __('awareness.hero.title_highlight') }}</span>
            </h1>
            <p class="fade-up text-lg text-gray-500 mt-6 max-w-xl mx-auto leading-relaxed" style="transition-delay:.2s">
                {{ __('awareness.hero.description') }}
            </p>
        </div>
    </div>
</section>

<!-- ============ FILTERS ============ -->
<section class="pb-6 -mt-6 relative z-20">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="flex flex-wrap items-center justify-center gap-3" id="filterBtns">
            <button class="filter-btn active" data-filter="all">{{ __('awareness.filters.all') }}</button>
            <button class="filter-btn" data-filter="tips">{{ __('awareness.filters.tips') }}</button>
            <button class="filter-btn" data-filter="video">{{ __('awareness.filters.video') }}</button>
            <button class="filter-btn" data-filter="infographic">{{ __('awareness.filters.infographic') }}</button>
        </div>
    </div>
</section>

<!-- ============ CONTENT GRID ============ -->
<section class="py-16 lg:py-20">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        @if($contents->count())
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8" id="contentGrid">
            @foreach($contents as $idx => $item)
            <article class="fade-up content-card" data-type="{{ $item->type }}" style="transition-delay:{{ ($idx % 3) * 0.1 }}s">
                <div class="relative overflow-hidden h-56">
                    <img src="{{ $item->image_path ? asset($item->image_path) : asset('images/farm1.jpg') }}" alt="{{ $item->title }}" class="card-img w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute top-4 right-4">
                        <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-xl text-xs font-bold shadow-lg
                            {{ $item->type === 'tips' ? 'bg-brand-500 text-white' : ($item->type === 'video' ? 'bg-red-500 text-white' : 'bg-ocean-500 text-white') }}">
                            @if($item->type === 'tips')
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"/></svg>
                                {{ __('awareness.types.tips') }}
                            @elseif($item->type === 'video')
                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd"/></svg>
                                {{ __('awareness.types.video') }}
                            @else
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                {{ __('awareness.types.infographic') }}
                            @endif
                        </span>
                    </div>
                    <div class="absolute bottom-4 right-4 left-4">
                        <span class="text-white/80 text-xs">{{ $item->created_at->translatedFormat('d F Y') }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-900 mb-3 leading-snug line-clamp-2">{{ $item->title }}</h3>
                    @if($item->body)
                    <p class="text-gray-500 text-sm leading-relaxed line-clamp-3 mb-5">{{ \Illuminate\Support\Str::limit(strip_tags($item->body), 150) }}</p>
                    @endif
                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 bg-gradient-to-br from-brand-400 to-brand-600 rounded-full flex items-center justify-center text-white text-xs font-bold">{{ __('awareness.content.author_initial') }}</div>
                            <span class="text-xs text-gray-400 font-medium">{{ __('awareness.content.author') }}</span>
                        </div>
                        <a href="#" class="inline-flex items-center gap-1.5 text-brand-600 font-bold text-sm hover:text-brand-700 transition">
                            {{ __('awareness.content.read_more') }}
                            <svg class="w-4 h-4 rtl:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>
        @else
        <div class="text-center py-20">
            <div class="w-24 h-24 bg-gray-100 rounded-3xl flex items-center justify-center text-5xl mx-auto mb-6">📚</div>
            <h3 class="text-2xl font-bold text-gray-900 mb-3">{{ __('awareness.empty.title') }}</h3>
            <p class="text-gray-500 max-w-md mx-auto">{{ __('awareness.empty.description') }}</p>
            <a href="{{ $homeUrl }}" class="btn-primary mt-8 mx-auto w-fit">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                {{ __('awareness.empty.back_home') }}
            </a>
        </div>
        @endif
    </div>
</section>

<!-- ============ CTA ============ -->
<section class="py-20 relative overflow-hidden">
    <div class="absolute inset-0 bg-gradient-to-br from-brand-800 via-brand-900 to-slate-900"></div>
    <div class="absolute inset-0 opacity-10" style="background-image:url('data:image/svg+xml,%3Csvg width=&quot;60&quot; height=&quot;60&quot; viewBox=&quot;0 0 60 60&quot; xmlns=&quot;http://www.w3.org/2000/svg&quot;%3E%3Cg fill=&quot;none&quot; fill-rule=&quot;evenodd&quot;%3E%3Cg fill=&quot;%23ffffff&quot; fill-opacity=&quot;0.4&quot;%3E%3Cpath d=&quot;M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z&quot;/%3E%3C/g%3E%3C/g%3E%3C/svg%3E')"></div>
    <div class="relative z-10 max-w-3xl mx-auto px-5 text-center">
        <h2 class="text-3xl lg:text-4xl font-black text-white leading-tight">{{ __('awareness.cta.title_line_1') }}<br>{{ __('awareness.cta.title_line_2') }}</h2>
        <p class="text-white/70 mt-4 text-lg">{{ __('awareness.cta.description') }}</p>
        <div class="flex flex-wrap items-center justify-center gap-4 mt-8">
            <a href="{{ route('register', $langParam) }}" class="btn-primary !text-lg !px-8 !py-3.5">
                {{ __('awareness.cta.register') }}
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
            </a>
            <a href="{{ $homeUrl }}#consultations" class="btn-primary !bg-white/10 !border !border-white/20 hover:!bg-white/20 !text-lg !px-8 !py-3.5">{{ __('awareness.cta.browse_consultations') }}</a>
        </div>
    </div>
</section>

<!-- ============ FOOTER ============ -->
<footer class="bg-slate-900 text-white pt-16 pb-8">
    <div class="max-w-7xl mx-auto px-5 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 pb-12 border-b border-white/10">
            <div>
                <div class="flex items-center mb-4">
                    <img src="{{ asset('images/logo.jpeg') }}" alt="SOQIA" class="h-14 w-auto object-contain rounded bg-white p-1">
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">{{ __('home.footer.description') }}</p>
            </div>
            <div>
                <h4 class="font-bold mb-4">{{ __('home.footer.quick_links') }}</h4>
                <ul class="space-y-2">
                    <li><a href="{{ $homeUrl }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.home') }}</a></li>
                    <li><a href="{{ route('awareness.index', $langParam) }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.awareness') }}</a></li>
                    <li><a href="{{ route('glossary', $langParam) }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.glossary') }}</a></li>
                    <li><a href="{{ $homeUrl }}#products" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.products') }}</a></li>
                    <li><a href="{{ $homeUrl }}#services" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.services') }}</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">{{ __('home.footer.account') }}</h4>
                <ul class="space-y-2">
                    <li><a href="{{ route('login', $langParam) }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.nav.login') }}</a></li>
                    <li><a href="{{ route('register', $langParam) }}" class="text-gray-400 hover:text-brand-400 transition text-sm">{{ __('home.footer.register') }}</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4">{{ __('home.footer.contact') }}</h4>
                <ul class="space-y-2">
                    <li class="flex items-center gap-2 text-gray-400 text-sm">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        info@soqia.jo
                    </li>
                    <li class="flex items-center gap-2 text-gray-400 text-sm">
                        <svg class="w-4 h-4 text-brand-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        {{ __('home.footer.location') }}
                    </li>
                </ul>
            </div>
        </div>
        <div class="flex flex-col md:flex-row items-center justify-between pt-6 gap-4">
            <p class="text-gray-500 text-sm">© {{ date('Y') }} SOQIA. {{ __('home.footer.rights') }}</p>
        </div>
    </div>
</footer>

<script>
// Mobile menu
document.getElementById('mobileMenuBtn')?.addEventListener('click',()=>{
    document.getElementById('mobileMenu')?.classList.toggle('hidden');
});

// Navbar scroll
const nav=document.getElementById('mainNav');
window.addEventListener('scroll',()=>{nav.classList.toggle('nav-scrolled',window.scrollY>50)});

// Animations
const observer=new IntersectionObserver((entries)=>{
    entries.forEach(e=>{if(e.isIntersecting){e.target.classList.add('visible');observer.unobserve(e.target)}});
},{threshold:0.1,rootMargin:'0px 0px -50px 0px'});
document.querySelectorAll('.fade-up').forEach(el=>observer.observe(el));

// Filter
const filterBtns=document.querySelectorAll('.filter-btn');
const cards=document.querySelectorAll('#contentGrid .content-card');
filterBtns.forEach(btn=>{
    btn.addEventListener('click',()=>{
        filterBtns.forEach(b=>b.classList.remove('active'));
        btn.classList.add('active');
        const filter=btn.dataset.filter;
        cards.forEach(card=>{
            if(filter==='all'||card.dataset.type===filter){
                card.style.display='';
                card.style.opacity='0';
                card.style.transform='translateY(20px)';
                setTimeout(()=>{card.style.opacity='1';card.style.transform='translateY(0)'},50);
            }else{
                card.style.display='none';
            }
        });
    });
});
</script>
</body>
</html>
