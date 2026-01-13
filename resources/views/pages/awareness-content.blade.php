<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>المحتوى التوعوي</title>
    @vite('resources/css/app.css')
    <style>
        :root{--green:#228B22;--blue:#0066CC;--orange:#FF9800}
        .filter-btn.active{color:var(--green);border-bottom:3px solid var(--green)}
        .animate-in{animation:fadeIn .25s ease}
        @keyframes fadeIn{from{opacity:0;transform:scale(.98)}to{opacity:1;transform:scale(1)}}
        .site-header{position:sticky;top:0;background:#fff;border-bottom:1px solid #e6e6e6;z-index:50}
        .nav{max-width:1100px;margin:0 auto;padding:10px 20px;display:flex;align-items:center;justify-content:space-between}
        .brand{font-weight:900;color:var(--green);font-size:18px}
        .nav-links{display:flex;gap:10px;flex-wrap:wrap}
        .nav-link{padding:8px 12px;border-radius:10px;background:#f3f6f4;color:#1e2a1e;font-weight:700;border:1px solid transparent;transition:all .18s ease;text-decoration:none}
        .nav-link:hover{background:#e9f3ea}
        .lang-switch{display:flex;gap:6px;align-items:center}
        .lang{padding:6px 10px;border-radius:10px;background:#f3f6f4;color:#1e2a1e;font-weight:700;border:1px solid transparent;text-decoration:none;transition:all .18s ease}
        .lang.active{background:#e2f5e4;border-color:#cbe8cd;color:#0f4c0f;box-shadow:inset 0 -3px 0 var(--green)}
        .menu-toggle{display:none;padding:8px 12px;border-radius:10px;background:#f3f6f4;border:1px solid #e6e6e6;cursor:pointer}
        @media (max-width:640px){
            .nav-links{display:none}
            .nav-links.open{display:flex}
            .menu-toggle{display:block}
        }
    </style>
</head>
<body class="bg-gray-50 text-text-dark">
    <header class="site-header">
        <div class="nav">
            <div class="brand" style="display:flex;align-items:center;gap:10px">
                <img src="{{ asset('images/logo.jpeg') }}" alt="SOQIA Innovative Environmental Solutions" style="height:28px;width:auto;border-radius:4px">
                <div style="font-weight:900;color:#228B22">SOQIA</div>
                <div style="font-size:12px;color:#1e2a1e">Innovative Environmental Solutions</div>
            </div>
            <button class="menu-toggle" id="menuToggle">☰</button>
            <div class="nav-links" id="navLinks">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">{{ __('home.nav.home') }}</a>
                <a class="nav-link {{ request()->is('awareness-content') ? 'active' : '' }}" href="{{ url('/awareness-content') }}">{{ __('home.nav.awareness') }}</a>
                <a class="nav-link {{ request()->is('login') ? 'active' : '' }}" href="{{ url('/login') }}">{{ __('home.nav.login') }}</a>
                @auth
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="{{ url('/dashboard') }}">{{ __('home.nav.dashboard') }}</a>
                @endauth
                <div class="lang-switch">
                    <a class="lang {{ app()->getLocale() === 'en' ? 'active' : '' }}" href="{{ url()->current() }}?lang=en">EN</a>
                    <a class="lang {{ app()->getLocale() === 'ar' ? 'active' : '' }}" href="{{ url()->current() }}?lang=ar">AR</a>
                </div>
            </div>
        </div>
    </header>
    <div class="max-w-6xl mx-auto px-5 py-10">
        <div>
            <h1 class="text-3xl sm:text-4xl font-bold text-primary-green">{{ __('awareness.page.title') }}</h1>
            <p class="mt-2 text-gray-700">{{ __('awareness.page.subtitle') }}</p>
        </div>

        <div class="mt-6 border-b border-gray-200 flex gap-2">
            <button class="filter-btn px-4 py-2 bg-white text-gray-700 rounded-md transition hover:text-primary-green" data-filter="all">{{ __('awareness.filters.all') }}</button>
            <button class="filter-btn px-4 py-2 bg-white text-gray-700 rounded-md transition hover:text-primary-green" data-filter="tips">{{ __('awareness.filters.tips') }}</button>
            <button class="filter-btn px-4 py-2 bg-white text-gray-700 rounded-md transition hover:text-primary-green" data-filter="video">{{ __('awareness.filters.video') }}</button>
            <button class="filter-btn px-4 py-2 bg-white text-gray-700 rounded-md transition hover:text-primary-green" data-filter="infographic">{{ __('awareness.filters.infographic') }}</button>
        </div>

        <div id="content-grid" class="mt-8 grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-6">
            @if(isset($contents) && $contents->count())
                @foreach($contents as $item)
                    <div class="content-card group relative bg-white rounded-xl shadow-sm hover:shadow-lg transition hover:scale-[1.02] overflow-hidden" data-type="{{ $item->type }}">
                        <img src="{{ $item->image_path ? asset($item->image_path) : asset('images/farm1.jpg') }}" alt="" class="h-40 w-full object-cover">
                        <div class="p-4">
                            <h3 class="text-lg font-semibold">{{ $item->title }}</h3>
                            @if($item->body)
                                <p class="mt-2 text-sm text-gray-600">{{ \Illuminate\Support\Str::limit(strip_tags($item->body), 140) }}</p>
                            @endif
                            <div class="mt-3 flex items-center justify-between text-xs text-gray-500">
                                <span>{{ \Carbon\Carbon::parse($item->created_at)->format('Y-m-d') }}</span>
                                <a href="#" class="text-primary-orange font-medium">{{ app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read more' }}</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="content-card group relative bg-white rounded-xl shadow-sm hover:shadow-lg transition hover:scale-[1.02] overflow-hidden" data-type="tips">
                    <img src="{{ asset('images/farm1.jpg') }}" alt="farm" class="h-40 w-full object-cover">
                    <span class="absolute top-3 left-3 bg-primary-green/90 text-white text-xs px-2 py-1 rounded-md">{{ __('awareness.cards.1.badge') }}</span>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ __('awareness.cards.1.title') }}</h3>
                        <p class="mt-2 text-sm text-gray-600">{{ __('awareness.cards.1.desc') }}</p>
                        <div class="mt-3 flex items-center justify-between text-xs text-gray-500">
                            <span>{{ __('awareness.cards.1.date') }}</span>
                            <a href="#" class="text-primary-orange font-medium">{{ __('awareness.cards.1.cta') }}</a>
                        </div>
                    </div>
                </div>
                <div class="content-card group relative bg-white rounded-xl shadow-sm hover:shadow-lg transition hover:scale-[1.02] overflow-hidden" data-type="video">
                    <img src="{{ asset('images/drip.jpg') }}" alt="drip" class="h-40 w-full object-cover">
                    <span class="absolute top-3 left-3 bg-primary-blue/90 text-white text-xs px-2 py-1 rounded-md">{{ __('awareness.cards.2.badge') }}</span>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ __('awareness.cards.2.title') }}</h3>
                        <p class="mt-2 text-sm text-gray-600">{{ __('awareness.cards.2.desc') }}</p>
                        <div class="mt-3 flex items-center justify-between text-xs text-gray-500">
                            <span>{{ __('awareness.cards.2.date') }}</span>
                            <a href="#" class="text-primary-orange font-medium">{{ __('awareness.cards.2.cta') }}</a>
                        </div>
                    </div>
                </div>
                <div class="content-card group relative bg-white rounded-xl shadow-sm hover:shadow-lg transition hover:scale-[1.02] overflow-hidden" data-type="infographic">
                    <img src="{{ asset('images/stats.png') }}" alt="stats" class="h-40 w-full object-cover">
                    <span class="absolute top-3 left-3 bg-primary-green/90 text-white text-xs px-2 py-1 rounded-md">{{ __('awareness.cards.3.badge') }}</span>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ __('awareness.cards.3.title') }}</h3>
                        <p class="mt-2 text-sm text-gray-600">{{ __('awareness.cards.3.desc') }}</p>
                        <div class="mt-3 flex items-center justify-between text-xs text-gray-500">
                            <span>{{ __('awareness.cards.3.date') }}</span>
                            <a href="#" class="text-primary-orange font-medium">{{ __('awareness.cards.3.cta') }}</a>
                        </div>
                    </div>
                </div>
                <div class="content-card group relative bg-white rounded-xl shadow-sm hover:shadow-lg transition hover:scale-[1.02] overflow-hidden" data-type="tips">
                    <img src="{{ asset('images/leak.jpg') }}" alt="leak" class="h-40 w-full object-cover">
                    <span class="absolute top-3 left-3 bg-primary-blue/90 text-white text-xs px-2 py-1 rounded-md">{{ __('awareness.cards.4.badge') }}</span>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ __('awareness.cards.4.title') }}</h3>
                        <p class="mt-2 text-sm text-gray-600">{{ __('awareness.cards.4.desc') }}</p>
                        <div class="mt-3 flex items-center justify-between text-xs text-gray-500">
                            <span>{{ __('awareness.cards.4.date') }}</span>
                            <a href="#" class="text-primary-orange font-medium">{{ __('awareness.cards.4.cta') }}</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <script>
        document.getElementById('menuToggle')?.addEventListener('click', function(){
            document.getElementById('navLinks')?.classList.toggle('open');
        });
        const buttons = Array.from(document.querySelectorAll('.filter-btn'));
        const cards = Array.from(document.querySelectorAll('.content-card'));
        function applyFilter(key){
            buttons.forEach(b => b.classList.toggle('active', b.dataset.filter === key));
            cards.forEach(c => {
                const match = key === 'all' || c.dataset.type === key;
                if(match){ c.classList.remove('hidden'); c.classList.add('animate-in'); }
                else{ c.classList.add('hidden'); c.classList.remove('animate-in'); }
            });
        }
        buttons.forEach(b => b.addEventListener('click', () => applyFilter(b.dataset.filter)));
        applyFilter('all');
    </script>
    <footer class="bg-gray-100 mt-8">
        <div class="max-w-6xl mx-auto px-5 py-6 flex items-center justify-between gap-3 flex-wrap">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.jpeg') }}" alt="SOQIA Innovative Environmental Solutions" class="h-4 w-auto rounded" style="height: 16px;">
                <div class="font-extrabold text-primary-green">SOQIA</div>
            </div>
            <div class="flex gap-3">
                <a href="{{ url('/') }}" class="text-gray-700">{{ __('home.nav.home') }}</a>
                <a href="{{ url('/awareness-content') }}" class="text-gray-700">{{ __('home.nav.awareness') }}</a>
                <a href="{{ url('/login') }}" class="text-gray-700">{{ __('home.nav.login') }}</a>
                @auth
                <a href="{{ url('/dashboard') }}" class="text-gray-700">{{ __('home.nav.dashboard') }}</a>
                @endauth
            </div>
            <div class="text-xs text-gray-500">© {{ date('Y') }} Saqqia</div>
        </div>
    </footer>
</body>
</html>
