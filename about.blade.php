<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ isset($term) && $term?->term ? $term->term.' | '.__('glossary.meta.title') : __('glossary.meta.title') }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@300;400;500;700;800;900&display=swap" rel="stylesheet">
    <style>
        :root{
            --ink:#073342;
            --muted:#72808c;
            --brand:#18ad91;
            --brand-dark:#0c7f6e;
            --soft:#edf4f2;
            --line:#e7edf0;
            --panel:#ffffff;
            --shadow:0 24px 60px rgba(15,35,45,.12);
        }
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Tajawal',system-ui,sans-serif;color:var(--ink);background:#e9eef1;min-height:100vh}
        a{text-decoration:none;color:inherit}
        button{font:inherit}
        .page{min-height:100vh;padding:24px 28px 42px;background:linear-gradient(135deg,#f7f9fa 0%,#e9eef1 52%,#eef6f3 100%)}
        .shell{max-width:1180px;margin:0 auto}
        .app-bar{display:grid;grid-template-columns:auto 1fr auto;align-items:center;gap:22px;background:rgba(255,255,255,.88);border:1px solid rgba(255,255,255,.85);border-radius:34px;padding:16px 22px;box-shadow:var(--shadow);backdrop-filter:blur(18px)}
        .brand{display:flex;align-items:center;gap:12px;min-width:280px;direction:ltr;text-align:left}
        .brand-mark{width:54px;height:54px;border-radius:50%;display:grid;place-items:center;background:linear-gradient(135deg,#1cb89a,#087a69);color:#fff;box-shadow:0 12px 25px rgba(24,173,145,.25)}
        .brand-copy strong{display:block;color:var(--brand-dark);font-size:28px;line-height:1;font-weight:900;letter-spacing:0}
        .brand-copy span{display:block;margin-top:5px;color:#203b46;font-size:13px;font-weight:700}
        .tabs{display:flex;justify-content:center;gap:4px}
        .tab{min-width:112px;text-align:center;padding:14px 20px;border-radius:24px;background:#f1f3f6;color:#263a45;font-weight:800;box-shadow:inset 0 1px 0 rgba(255,255,255,.9)}
        .tab.active{background:linear-gradient(135deg,#24b99c,#0f9f86);color:#fff;box-shadow:0 12px 24px rgba(24,173,145,.28)}
        .top-actions{display:flex;align-items:center;gap:12px;direction:ltr}
        .icon-btn{width:52px;height:52px;border:0;border-radius:50%;display:grid;place-items:center;background:#fff;color:var(--ink);box-shadow:0 14px 28px rgba(20,35,45,.12);cursor:pointer;transition:.2s transform,.2s box-shadow}
        .icon-btn:hover{transform:translateY(-2px);box-shadow:0 18px 34px rgba(20,35,45,.16)}
        .icon-btn.primary{background:linear-gradient(135deg,#12a989,#087a69);color:#fff}
        .icon-btn svg{width:25px;height:25px;stroke:currentColor;stroke-width:2.2;fill:none;stroke-linecap:round;stroke-linejoin:round}
        .icon-btn .filled{fill:currentColor;stroke:none}
        .detail-head{display:grid;grid-template-columns:1fr auto 1fr;align-items:center;gap:18px;margin:28px 0 16px}
        .back-link{justify-self:start;width:52px;height:52px;border-radius:50%;display:grid;place-items:center;color:var(--ink)}
        .back-link:hover{background:rgba(255,255,255,.7)}
        .back-link svg{width:28px;height:28px;stroke:currentColor;stroke-width:2.3;fill:none;stroke-linecap:round;stroke-linejoin:round}
        .detail-title{font-size:30px;font-weight:900;text-align:center}
        .quick-actions{justify-self:end;display:flex;gap:14px}
        .hero-card{background:rgba(255,255,255,.96);border:1px solid rgba(255,255,255,.9);border-radius:32px;padding:32px 46px 36px;box-shadow:0 24px 65px rgba(15,35,45,.11);display:grid;grid-template-columns:minmax(0,1.15fr) minmax(320px,.85fr);gap:38px;align-items:center}
        .term-copy{direction:ltr;text-align:left}
        .category{display:inline-flex;align-items:center;gap:10px;background:#e4f8f2;color:#0d8b77;border-radius:999px;padding:12px 24px;font-size:18px;font-weight:900;margin-bottom:20px;direction:ltr}
        .category svg{width:26px;height:26px;stroke:currentColor;fill:none;stroke-width:2.2}
        h1{font-size:60px;line-height:1.02;font-weight:900;letter-spacing:0;margin-bottom:24px;color:#073342}
        .chips{display:flex;flex-wrap:wrap;gap:12px;margin-bottom:14px}
        .chip{display:inline-flex;align-items:center;gap:8px;border-radius:999px;padding:12px 20px;background:#f4f6f8;color:#53616b;font-size:16px;font-weight:800;box-shadow:0 10px 22px rgba(20,35,45,.08)}
        .chip.active{background:linear-gradient(135deg,#35c7a4,#18ad91);color:#fff}
        .chip img{width:22px;height:16px;border-radius:3px;object-fit:cover}
        .underline{width:190px;height:8px;border-radius:999px;background:#eef2f2;margin:8px 0 18px}
        .term-title-placeholder{width:min(520px,100%);height:62px;border-radius:18px;background:linear-gradient(90deg,#edf4f2,#f8fbfa);margin-bottom:24px}
        .section-title{display:flex;align-items:center;gap:12px;font-size:24px;font-weight:900;margin:20px 0 14px;direction:ltr}
        .section-title svg{width:30px;height:30px;stroke:#0f9f86;fill:none;stroke-width:2.2}
        .content-text{font-size:21px;line-height:1.85;color:#102f3b;font-weight:700;white-space:pre-line}
        [dir="rtl"] .content-text{direction:rtl;text-align:right}
        .blank-lines{display:grid;gap:11px}
        .blank-line{display:block;height:16px;border-radius:999px;background:linear-gradient(90deg,#e9f1ef,#f6faf9)}
        .blank-line.short{width:62%}
        .blank-line.mid{width:82%}
        .note-box{margin-top:18px;background:#e9f9f5;border-radius:18px;padding:18px 22px}
        .note-title{display:flex;align-items:center;gap:8px;font-size:19px;font-weight:900;margin-bottom:13px;direction:ltr}
        .note-title span{font-size:22px}
        .visual-side{display:grid;gap:22px}
        .media-placeholder{height:100%;min-height:170px;border-radius:22px;background:linear-gradient(135deg,#edf7f4,#fbfefe);border:1px dashed #cae3dc;display:grid;place-items:center;color:#9fb5b0}
        .media-placeholder svg{width:54px;height:54px;stroke:currentColor;fill:none;stroke-width:1.7}
        .custom-visual-image{width:100%;height:365px;border-radius:28px;object-fit:cover;box-shadow:0 20px 35px rgba(20,35,45,.1)}
        .eco-scene{position:relative;min-height:365px;border-radius:28px;background:linear-gradient(180deg,#f7fffd 0%,#eef8f5 100%);display:grid;place-items:center;overflow:hidden}
        .scene-ring{position:absolute;width:340px;height:340px;border-radius:50%;border:3px dashed rgba(12,127,110,.24)}
        .earth{position:relative;width:225px;height:225px;border-radius:50%;background:radial-gradient(circle at 35% 28%,#94e7fb 0 18%,#4fc4dc 19% 50%,#3299c8 74%,#217cac 100%);box-shadow:0 22px 36px rgba(9,71,88,.18);overflow:hidden}
        .land{position:absolute;background:#5bc96f;border-radius:55% 45% 60% 40%}
        .land.one{width:90px;height:70px;left:28px;top:45px;transform:rotate(-18deg)}
        .land.two{width:118px;height:84px;right:10px;bottom:48px;transform:rotate(18deg)}
        .land.three{width:56px;height:42px;left:76px;bottom:28px}
        .foot{position:absolute;width:36px;height:64px;border-radius:50% 50% 46% 46%;background:#0f8c63;opacity:.86}
        .foot::before,.foot::after{content:'';position:absolute;background:#0f8c63;border-radius:50%}
        .foot::before{width:11px;height:11px;top:-9px;left:4px;box-shadow:13px -4px 0 #0f8c63,25px 0 0 #0f8c63}
        .foot::after{width:10px;height:10px;top:-5px;right:-7px}
        .foot.left{left:72px;top:92px;transform:rotate(18deg)}
        .foot.right{right:58px;top:98px;transform:rotate(-20deg) scale(.92)}
        .solar{position:absolute;width:88px;height:58px;left:54px;top:36px;background:repeating-linear-gradient(90deg,#2468a8 0 18px,#2f80c7 18px 21px);border:4px solid #e7f8fb;transform:rotate(13deg);box-shadow:0 12px 22px rgba(9,71,88,.15)}
        .solar::after{content:'';position:absolute;width:6px;height:70px;background:#85a8a2;left:42px;top:53px;transform:rotate(-13deg);transform-origin:top}
        .turbine{position:absolute;right:62px;top:42px;width:110px;height:154px}
        .turbine .mast{position:absolute;left:52px;top:44px;width:7px;height:110px;background:#9eb5b5;border-radius:999px}
        .turbine .hub{position:absolute;left:42px;top:35px;width:26px;height:26px;border-radius:50%;background:#e8f4f2;box-shadow:0 0 0 4px #9eb5b5}
        .blade{position:absolute;left:53px;top:48px;width:8px;height:62px;background:#9eb5b5;border-radius:999px;transform-origin:50% 0}
        .blade.one{transform:rotate(0deg)}
        .blade.two{transform:rotate(120deg)}
        .blade.three{transform:rotate(240deg)}
        .factory{position:absolute;right:52px;bottom:62px;width:82px;height:70px;background:#dfe9e7;border-radius:10px 10px 8px 8px}
        .factory::before{content:'';position:absolute;left:13px;top:-45px;width:20px;height:52px;background:#c9d9d6;border-radius:8px 8px 0 0;box-shadow:36px 16px 0 -2px #c9d9d6}
        .leaf{position:absolute;width:75px;height:28px;background:#4ac06f;border-radius:100% 0 100% 0;left:118px;bottom:56px;transform:rotate(-20deg)}
        .scene-dots{position:absolute;inset:38px;border-radius:28px;background-image:radial-gradient(circle,#0c7f6e 0 3px,transparent 4px);background-size:92px 82px;opacity:.45}
        .activity-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:16px}
        .activity-card{background:#fff;border:1px solid #edf2f4;border-radius:20px;min-height:124px;display:grid;place-items:center;text-align:center;padding:16px;box-shadow:0 16px 30px rgba(20,35,45,.1)}
        .activity-card .emoji{font-size:38px;margin-bottom:10px}
        .activity-card img{width:54px;height:54px;object-fit:cover;border-radius:16px;margin-bottom:10px}
        .activity-card strong{font-size:14px;font-weight:900;color:#113946}
        .activity-card p{font-size:12px;line-height:1.6;color:#64748b;margin-top:8px}
        .lower-grid{display:grid;grid-template-columns:1.15fr .85fr;gap:14px;margin-top:16px}
        .info-card{background:rgba(255,255,255,.96);border:1px solid rgba(255,255,255,.92);border-radius:26px;padding:28px 32px;box-shadow:0 20px 50px rgba(15,35,45,.09)}
        .example-layout{display:grid;grid-template-columns:1fr 210px;gap:22px;align-items:center}
        .car-badge{height:150px;border-radius:20px;background:linear-gradient(135deg,#f8fbfb,#eaf5f2);display:grid;place-items:center;position:relative;overflow:hidden}
        .car{font-size:74px}
        .cloud{position:absolute;right:26px;top:22px;background:#dfe8ec;color:#385463;border-radius:50%;width:92px;height:66px;display:grid;place-items:center;font-size:24px;font-weight:900}
        .cloud::before,.cloud::after{content:'';position:absolute;background:#dfe8ec;border-radius:50%}
        .cloud::before{width:48px;height:48px;left:8px;top:-20px}
        .cloud::after{width:56px;height:56px;right:7px;top:-24px}
        .cloud span{position:relative;z-index:1}
        .keyword-grid{display:flex;flex-wrap:wrap;gap:12px}
        .keyword{display:inline-flex;align-items:center;gap:8px;background:#eff5f4;border-radius:999px;padding:12px 18px;color:#183b48;font-size:16px;font-weight:900}
        .keyword.placeholder{min-width:135px;height:45px;background:linear-gradient(90deg,#eef5f3,#f8fbfa)}
        .related-title{display:flex;align-items:center;gap:10px;margin:22px 0 12px;font-size:26px;font-weight:900;direction:ltr}
        .related-title svg{width:32px;height:32px;stroke:#f5bf14;fill:none;stroke-width:2.2}
        .related-grid{display:grid;grid-template-columns:1fr 1fr;gap:18px}
        .related-card{background:#fff;border:1px solid #eef3f4;border-radius:24px;padding:16px;display:grid;grid-template-columns:1fr 220px;gap:18px;align-items:center;box-shadow:0 18px 42px rgba(15,35,45,.09)}
        .related-media{height:150px;border-radius:16px;background-size:cover;background-position:center}
        .type-pill{display:inline-flex;width:max-content;align-items:center;gap:6px;background:#dff7ef;color:#0b8b76;border-radius:999px;padding:8px 15px;font-weight:900;font-size:14px;margin-bottom:18px}
        .card-blanks{display:grid;gap:10px}
        .wash-map-section{margin-top:28px;background:rgba(255,255,255,.96);border:1px solid rgba(255,255,255,.9);border-radius:32px;padding:28px;box-shadow:0 24px 65px rgba(15,35,45,.1)}
        .wash-map-head{display:flex;align-items:flex-end;justify-content:space-between;gap:20px;margin-bottom:20px}
        .map-eyebrow{display:inline-flex;align-items:center;gap:8px;background:#e4f8f2;color:#0d8b77;border-radius:999px;padding:9px 18px;font-size:14px;font-weight:900;margin-bottom:10px}
        .map-eyebrow svg{width:20px;height:20px;stroke:currentColor;fill:none;stroke-width:2.1}
        .wash-map-head h3{font-size:30px;line-height:1.2;font-weight:900;color:#073342;max-width:760px}
        .wash-map-head p{font-size:16px;line-height:1.7;color:#64748b;font-weight:700;margin-top:8px;max-width:760px}
        .map-open-link{display:inline-flex;align-items:center;gap:9px;background:linear-gradient(135deg,#24b99c,#0f9f86);color:#fff;border-radius:16px;padding:12px 18px;font-weight:900;white-space:nowrap;box-shadow:0 14px 28px rgba(24,173,145,.22)}
        .map-open-link svg{width:20px;height:20px;stroke:currentColor;fill:none;stroke-width:2.2}
        .map-source{font-size:13px;color:#73838c;font-weight:800;margin-top:14px}
        .wash-map-frame-card{position:relative;height:660px;border-radius:26px;overflow:hidden;border:1px solid #dbe6e7;background:#fff}
        .wash-map-preview-link{display:block;width:100%;height:100%;background:linear-gradient(180deg,#f7fbfb,#fff)}
        .wash-map-preview{display:block;width:100%;height:100%;object-fit:contain;object-position:center;background:#fff}
        .wash-map-preview-link::after{content:'';position:absolute;inset:0;border-radius:26px;box-shadow:inset 0 0 0 1px rgba(7,51,66,.05);pointer-events:none}
        .map-pointer{position:absolute;top:42%;left:50%;display:flex;align-items:center;gap:10px;padding:9px 14px;border-radius:999px;background:rgba(255,255,255,.94);color:#0c7f6e;font-weight:900;font-size:13px;box-shadow:0 16px 32px rgba(7,51,66,.2);pointer-events:none;animation:mapPointerMove 9s ease-in-out infinite}
        .map-pointer::before{content:'';width:16px;height:16px;border-radius:50%;background:#18ad91;box-shadow:0 0 0 8px rgba(24,173,145,.18);animation:mapPulse 1.8s ease-in-out infinite}
        [dir="rtl"] .map-pointer{direction:rtl}
        @keyframes mapPointerMove{
            0%,100%{transform:translate(-50%,-50%)}
            25%{transform:translate(-18%,-86%)}
            50%{transform:translate(34%,-35%)}
            75%{transform:translate(-76%,18%)}
        }
        @keyframes mapPulse{
            0%,100%{box-shadow:0 0 0 7px rgba(24,173,145,.18)}
            50%{box-shadow:0 0 0 15px rgba(24,173,145,0)}
        }
        @media (max-width:1040px){
            .app-bar{grid-template-columns:1fr;justify-items:center}
            .brand{justify-content:center;min-width:auto}
            .tabs{order:3;flex-wrap:wrap}
            .hero-card,.lower-grid,.related-grid{grid-template-columns:1fr}
            .visual-side{max-width:620px;margin:0 auto;width:100%}
            .wash-map-head{align-items:flex-start;flex-direction:column}
        }
        @media (max-width:720px){
            .page{padding:14px}
            .app-bar{border-radius:24px;padding:14px}
            .brand-copy strong{font-size:22px}
            .tabs{width:100%;display:grid;grid-template-columns:1fr 1fr}
            .tab{min-width:0;padding:12px 10px}
            .detail-head{grid-template-columns:auto 1fr auto;margin-top:18px}
            .detail-title{font-size:22px}
            .quick-actions .icon-btn:nth-child(1){display:none}
            .hero-card{padding:24px 18px;border-radius:24px}
            h1{font-size:42px}
            .chips{gap:8px}
            .chip{font-size:14px;padding:10px 13px}
            .eco-scene{min-height:300px}
            .activity-grid{grid-template-columns:1fr}
            .example-layout,.related-card{grid-template-columns:1fr}
            .related-media{order:-1}
            .wash-map-section{padding:18px;border-radius:24px}
            .wash-map-head h3{font-size:24px}
            .wash-map-frame-card{height:520px}
            .map-pointer{top:36%;left:46%}
        }
        @media (max-width:460px){
            .top-actions{gap:8px}
            .icon-btn{width:44px;height:44px}
            .brand-mark{width:46px;height:46px}
            .brand-copy span{font-size:12px}
            .detail-head{gap:8px}
            .hero-card{padding:20px 14px}
            h1{font-size:36px}
            .section-title{font-size:21px}
        }
    </style>
</head>
<body>
@php
    $langParam = ['lang' => app()->getLocale()];
    $homeUrl = route('home', $langParam);
    $profileUrl = auth()->check()
        ? (auth()->user()->role === 'admin' ? route('admin.dashboard', $langParam) : route('dashboard', $langParam))
        : route('login', $langParam);
    $washMapUrl = 'https://depar.unescwa.org/ar/topic/khrytt-mnzwmt-almyah-walsrf-alshy-walnzaft-fy-almmlkt-alardnyt-alhashmyt';
    $activityCards = $term?->activity_cards ?: array_fill(0, 3, []);
    $keywords = $term?->keywords ?: [];
    $relatedCards = $term?->related_cards ?: array_fill(0, 2, []);
@endphp
<main class="page">
    <div class="shell">
        <header class="app-bar" aria-label="{{ __('home.nav.glossary') }}">
            <a href="{{ $homeUrl }}" class="brand">
                <span class="brand-mark" aria-hidden="true">
                    <svg width="34" height="34" viewBox="0 0 34 34" fill="none">
                        <path d="M17 30C9 22 7 14 10 6c8 1 14 5 17 12-4 9-10 12-10 12Z" stroke="currentColor" stroke-width="2.2"/>
                        <path d="M17 30V14M17 20c-3-4-7-6-11-6M17 21c4-4 8-6 12-6" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"/>
                    </svg>
                </span>
                <span class="brand-copy">
                    <strong>{{ __('glossary.brand.name') }}</strong>
                    <span>{{ __('glossary.brand.subtitle') }}</span>
                </span>
            </a>

            <nav class="tabs" aria-label="{{ __('home.nav.glossary') }}">
                <a class="tab active" href="{{ route('glossary', $langParam) }}">{{ __('glossary.tabs.term') }}</a>
                <a class="tab" href="#favorites">{{ __('glossary.tabs.favorites') }}</a>
                <a class="tab" href="#today">{{ __('glossary.tabs.today') }}</a>
                <a class="tab" href="#search">{{ __('glossary.tabs.search') }}</a>
            </nav>

            <div class="top-actions">
                <a class="icon-btn" href="#search" title="{{ __('glossary.actions.search') }}" aria-label="{{ __('glossary.actions.search') }}">
                    <svg viewBox="0 0 24 24"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
                </a>
                <a class="icon-btn" href="{{ request()->fullUrlWithQuery(['lang' => app()->getLocale() === 'ar' ? 'en' : 'ar']) }}" title="{{ __('glossary.actions.language') }}" aria-label="{{ __('glossary.actions.language') }}">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3c2.4 2.5 3.6 5.5 3.6 9s-1.2 6.5-3.6 9M12 3c-2.4 2.5-3.6 5.5-3.6 9s1.2 6.5 3.6 9"/></svg>
                </a>
                <a class="icon-btn primary" href="{{ $profileUrl }}" title="{{ __('glossary.actions.profile') }}" aria-label="{{ __('glossary.actions.profile') }}">
                    <svg viewBox="0 0 24 24"><circle class="filled" cx="12" cy="8" r="4"/><path class="filled" d="M4.5 21a7.5 7.5 0 0 1 15 0z"/></svg>
                </a>
            </div>
        </header>

        <div class="detail-head">
            <a class="back-link" href="{{ $homeUrl }}" title="{{ __('glossary.actions.back') }}" aria-label="{{ __('glossary.actions.back') }}">
                <svg viewBox="0 0 24 24"><path d="M19 12H5"/><path d="m12 19-7-7 7-7"/></svg>
            </a>
            <h2 class="detail-title">{{ __('glossary.page.title') }}</h2>
            <div class="quick-actions">
                <button class="icon-btn" type="button" title="{{ __('glossary.actions.share') }}" aria-label="{{ __('glossary.actions.share') }}">
                    <svg viewBox="0 0 24 24"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><path d="m8.6 10.8 6.8-4.6M8.6 13.2l6.8 4.6"/></svg>
                </button>
                <button class="icon-btn" type="button" title="{{ __('glossary.actions.save') }}" aria-label="{{ __('glossary.actions.save') }}">
                    <svg viewBox="0 0 24 24"><path d="M6 4h12v17l-6-4-6 4z"/></svg>
                </button>
                <button class="icon-btn" type="button" title="{{ __('glossary.actions.favorite') }}" aria-label="{{ __('glossary.actions.favorite') }}">
                    <svg viewBox="0 0 24 24"><path class="filled" d="M12 21s-7.5-4.6-9.4-9.1C1.1 8.3 3.4 5 7 5c2 0 3.5 1 5 2.8C13.5 6 15 5 17 5c3.6 0 5.9 3.3 4.4 6.9C19.5 16.4 12 21 12 21z"/></svg>
                </button>
            </div>
        </div>

        <section class="hero-card">
            <div class="term-copy">
                <div class="category">
                    <svg viewBox="0 0 24 24"><path d="M20 4C10 4 5 9 5 19c8 0 14-6 15-15Z"/><path d="M5 19c3-6 7-9 13-12"/></svg>
                    {{ $term?->category ?: __('glossary.page.category') }}
                </div>
                @if($term?->term)
                    <h1>{{ $term->term }}</h1>
                @else
                    <div class="term-title-placeholder" aria-hidden="true"></div>
                @endif
                <div class="underline" aria-hidden="true"></div>

                <h3 class="section-title">
                    <svg viewBox="0 0 24 24"><path d="M4 5h12a3 3 0 0 1 3 3v11H7a3 3 0 0 1-3-3V5Z"/><path d="M8 9h7M8 13h5"/></svg>
                    {{ __('glossary.sections.simple_definition') }}
                </h3>
                @if($term?->simple_definition)
                    <p class="content-text">{{ $term->simple_definition }}</p>
                @else
                    <div class="blank-lines" aria-label="{{ __('glossary.sections.simple_definition') }}">
                        <span class="blank-line"></span>
                        <span class="blank-line mid"></span>
                        <span class="blank-line"></span>
                        <span class="blank-line short"></span>
                    </div>
                @endif

                <div class="note-box">
                    <div class="note-title"><span aria-hidden="true">💡</span>{{ __('glossary.sections.simply') }}</div>
                    @if($term?->simple_note)
                        <p class="content-text">{{ $term->simple_note }}</p>
                    @else
                        <div class="blank-lines">
                            <span class="blank-line"></span>
                            <span class="blank-line mid"></span>
                        </div>
                    @endif
                </div>
            </div>

            <div class="visual-side">
                @if($term?->hero_image_path)
                    <img src="{{ asset($term->hero_image_path) }}" alt="{{ $term->term }}" class="custom-visual-image">
                @elseif($term)
                    <div class="eco-scene" aria-hidden="true">
                        <div class="scene-dots"></div>
                        <div class="scene-ring"></div>
                        <div class="solar"></div>
                        <div class="turbine">
                            <span class="mast"></span>
                            <span class="hub"></span>
                            <span class="blade one"></span>
                            <span class="blade two"></span>
                            <span class="blade three"></span>
                        </div>
                        <div class="factory"></div>
                        <div class="leaf"></div>
                        <div class="earth">
                            <span class="land one"></span>
                            <span class="land two"></span>
                            <span class="land three"></span>
                            <span class="foot left"></span>
                            <span class="foot right"></span>
                        </div>
                    </div>
                @else
                    <div class="media-placeholder" aria-hidden="true">
                        <svg viewBox="0 0 24 24"><path d="M4 5h16v14H4z"/><path d="m4 15 5-5 4 4 2-2 5 5"/><circle cx="16" cy="9" r="1.5"/></svg>
                    </div>
                @endif
                <div class="activity-grid">
                    @for($i = 0; $i < 3; $i++)
                        @php($card = $activityCards[$i] ?? [])
                        <div class="activity-card">
                            @if(data_get($card, 'image_path'))
                                <img src="{{ asset(data_get($card, 'image_path')) }}" alt="">
                            @elseif(data_get($card, 'icon'))
                                <span class="emoji" aria-hidden="true">{{ data_get($card, 'icon') }}</span>
                            @else
                                <span class="blank-line short" aria-hidden="true"></span>
                            @endif
                            @if(data_get($card, 'title'))
                                <strong>{{ data_get($card, 'title') }}</strong>
                            @else
                                <span class="blank-line mid" aria-hidden="true"></span>
                            @endif
                            @if(data_get($card, 'body'))
                                <p>{{ data_get($card, 'body') }}</p>
                            @endif
                        </div>
                    @endfor
                </div>
            </div>
        </section>

        <section class="lower-grid">
            <article class="info-card">
                <h3 class="section-title">
                    <svg viewBox="0 0 24 24"><path d="M3 11 12 4l9 7"/><path d="M5 10v10h14V10"/><path d="M9 20v-6h6v6"/></svg>
                    {{ __('glossary.sections.practical_example') }}
                </h3>
                <div class="example-layout">
                    @if($term?->example_body)
                        <p class="content-text">{{ $term->example_body }}</p>
                    @else
                        <div class="blank-lines">
                            <span class="blank-line"></span>
                            <span class="blank-line mid"></span>
                            <span class="blank-line"></span>
                            <span class="blank-line short"></span>
                        </div>
                    @endif
                    @if($term?->example_image_path)
                        <div class="related-media" style="background-image:url('{{ asset($term->example_image_path) }}')" aria-hidden="true"></div>
                    @elseif($term?->example_icon)
                        <div class="car-badge" aria-hidden="true">
                            <div class="cloud"><span>CO₂</span></div>
                            <div class="car">{{ $term->example_icon }}</div>
                        </div>
                    @else
                        <div class="media-placeholder" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M4 5h16v14H4z"/><path d="m4 15 5-5 4 4 2-2 5 5"/><circle cx="16" cy="9" r="1.5"/></svg>
                        </div>
                    @endif
                </div>
            </article>

            <article class="info-card">
                <h3 class="section-title">
                    <svg viewBox="0 0 24 24"><path d="M4 7h4v4H4zM16 4h4v4h-4zM14 16h4v4h-4zM6 17h4v4H6z"/><path d="M8 9c4 0 7-1 10-3M8 19c4 0 7-1 10-3M18 8c-2 3-4 5-8 11"/></svg>
                    {{ __('glossary.sections.classification') }}
                </h3>
                <div class="keyword-grid">
                    @forelse($keywords as $keyword)
                        <span class="keyword">{{ $keyword }}</span>
                    @empty
                        @for($i = 0; $i < 5; $i++)
                            <span class="keyword placeholder" aria-hidden="true"></span>
                        @endfor
                    @endforelse
                </div>
            </article>
        </section>

        <h3 class="related-title">
            <svg viewBox="0 0 24 24"><path d="m12 3 2.8 5.8 6.4.9-4.6 4.5 1.1 6.3L12 17.5l-5.7 3 1.1-6.3-4.6-4.5 6.4-.9L12 3Z"/></svg>
            {{ __('glossary.sections.related') }}
        </h3>

        <section class="related-grid">
            @for($i = 0; $i < 2; $i++)
                @php($related = $relatedCards[$i] ?? [])
                <article class="related-card">
                    <div>
                        @if(data_get($related, 'type'))
                            <span class="type-pill">{{ data_get($related, 'type') }}</span>
                        @else
                            <span class="type-pill"><span class="blank-line short" style="width:80px;height:12px"></span></span>
                        @endif
                        @if(data_get($related, 'title'))
                            @if(data_get($related, 'url'))
                                <a href="{{ data_get($related, 'url') }}" class="content-text" style="font-size:22px">{{ data_get($related, 'title') }}</a>
                            @else
                                <p class="content-text" style="font-size:22px">{{ data_get($related, 'title') }}</p>
                            @endif
                        @else
                            <div class="card-blanks">
                                <span class="blank-line"></span>
                                <span class="blank-line mid"></span>
                                <span class="blank-line short"></span>
                            </div>
                        @endif
                    </div>
                    @if(data_get($related, 'image_path'))
                        <div class="related-media" style="background-image:url('{{ asset(data_get($related, 'image_path')) }}')" aria-hidden="true"></div>
                    @else
                        <div class="media-placeholder" aria-hidden="true">
                            <svg viewBox="0 0 24 24"><path d="M4 5h16v14H4z"/><path d="m4 15 5-5 4 4 2-2 5 5"/><circle cx="16" cy="9" r="1.5"/></svg>
                        </div>
                    @endif
                </article>
            @endfor
        </section>

        <section class="wash-map-section" aria-labelledby="washMapTitle">
            <div class="wash-map-head">
                <div>
                    <div class="map-eyebrow">
                        <svg viewBox="0 0 24 24"><path d="M12 21s7-5.4 7-11a7 7 0 1 0-14 0c0 5.6 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
                        {{ __('glossary.wash_map.eyebrow') }}
                    </div>
                    <h3 id="washMapTitle">{{ __('glossary.wash_map.title') }}</h3>
                    <p>{{ __('glossary.wash_map.description') }}</p>
                </div>
                <a class="map-open-link" href="{{ $washMapUrl }}" target="_blank" rel="noopener">
                    {{ __('glossary.wash_map.open') }}
                    <svg viewBox="0 0 24 24"><path d="M7 17 17 7"/><path d="M9 7h8v8"/></svg>
                </a>
            </div>
            <div class="wash-map-frame-card">
                <a class="wash-map-preview-link" href="{{ $washMapUrl }}" target="_blank" rel="noopener" aria-label="{{ __('glossary.wash_map.open') }}">
                    <img class="wash-map-preview" src="{{ asset('images/wash-map-preview.png') }}" alt="{{ __('glossary.wash_map.title') }}">
                </a>
                
            </div>
            <div class="map-source">{{ __('glossary.wash_map.source') }}</div>
        </section>
    </div>
</main>
</body>
</html>
