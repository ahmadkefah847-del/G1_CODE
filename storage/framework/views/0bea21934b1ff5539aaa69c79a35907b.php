<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(__('home.meta.title')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <style>
        :root{
            --primary-green:#228B22;
            --dark-green:#006400;
            --primary-blue:#0066CC;
            --light-blue:#E3F2FD;
            --primary-orange:#FF9800;
            --light-bg:#F5F5F5;
            --text-dark:#333333;
            --text-light:#666666;
            /* compatibility mapping */
            --green:var(--primary-green);
            --blue:var(--primary-blue);
            --orange:var(--primary-orange);
            --bg:var(--light-bg);
            --text:var(--text-dark);
            --muted:var(--text-light);
        }
        *{box-sizing:border-box}
        body{
            margin:0;
            font-family: -apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,Ubuntu,"Helvetica Neue",Arial,"Noto Sans",sans-serif;
            color:var(--text);
            background:var(--bg);
        }
        .container{max-width:1100px;margin:0 auto;padding:0 20px}
        .hero{
            position:relative;
            min-height:58vh;
            display:flex;
            align-items:center;
            background-image:url("<?php echo e(asset('images/home-hero.jpeg')); ?>");
            background-size:cover;
            background-position:center;
            overflow:hidden;
        }
        .hero-video{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;z-index:0;filter:brightness(.75)}
        .hero::before{
            content:"";
            position:absolute;inset:0;
            background:linear-gradient(135deg, rgba(34,139,34,.6), rgba(0,100,0,.6));
            animation:float 12s ease-in-out infinite alternate;
        }
        @keyframes float{0%,100%{transform:translateY(0)}50%{transform:translateY(-20px)}}
        .hero-content{
            position:relative;
            z-index:2;
            padding:48px 0;
            text-align:center;
            color:#fff;
            width:100%;
        }
        .hero-title{
            font-weight:800;
            font-size: clamp(28px, 4.5vw, 48px);
            line-height:1.15;
            margin:0 0 10px;
            opacity:0;transform:translateY(16px) scale(.98);
            animation:fadeSlideUp .9s cubic-bezier(.2,.9,.25,1) forwards, bounce 1.2s ease;
        }
        .hero-sub{
            font-size: clamp(14px, 2.2vw, 18px);
            color:#f1f7f1;
            margin:0 0 24px;
            opacity:0;transform:translateY(14px);
            animation:fadeSlideUp .9s .12s ease-out forwards;
        }
        @keyframes fadeSlideUp{
            0%{opacity:0;transform:translateY(16px) scale(.98)}
            60%{opacity:1;transform:translateY(-2px) scale(1.01)}
            100%{opacity:1;transform:translateY(0) scale(1)}
        }
        @keyframes bounce{0%,100%{transform:translateY(0)}50%{transform:translateY(-10px)}}
        .hero-actions{
            display:flex;gap:12px;justify-content:center;flex-wrap:wrap
        }
        .btn{
            border:none;
            border-radius:10px;
            padding:12px 18px;
            font-weight:700;
            font-size:15px;
            cursor:pointer;
            color:#fff;
            transform:translateY(10px);
            opacity:0;
            animation:slideIn .6s ease forwards;
            transition:transform .2s ease, box-shadow .2s ease;
            box-shadow:0 6px 16px rgba(0,0,0,.18);
        }
        @keyframes slideIn{from{opacity:0;transform:translateX(-30px)}to{opacity:1;transform:translateX(0)}}
        .btn:hover{transform:translateY(-2px);box-shadow:0 10px 24px rgba(0,0,0,.26)}
        .btn-green{background:var(--green);animation-delay:.18s}
        .btn-blue{background:var(--blue);animation-delay:.32s}
        .btn-orange{background:var(--orange);animation-delay:.46s}

        .tabs{
            background:#fff;
            margin-top:-20px;
            border-radius:16px 16px 0 0;
        }
        .site-header{position:sticky;top:0;background:rgba(255,255,255,.7);backdrop-filter:saturate(180%) blur(12px);border-bottom:1px solid rgba(230,230,230,.7);z-index:50}
        .nav{max-width:1100px;margin:0 auto;padding:10px 20px;display:flex;align-items:center;justify-content:space-between}
        .brand{font-weight:900;color:var(--green);font-size:18px}
        .nav-links{display:flex;gap:10px;flex-wrap:wrap}
        .nav-link{padding:8px 12px;border-radius:12px;background:#f7faf7;color:#1e2a1e;font-weight:700;border:1px solid transparent;transition:all .18s ease;text-decoration:none}
        .nav-link:hover{background:#e9f3ea}
        .nav-link.active{background:#e2f5e4;border-color:#cbe8cd;color:#0f4c0f;box-shadow:inset 0 -3px 0 var(--green)}
        .lang-switch{display:flex;gap:6px;align-items:center}
        .lang{padding:6px 10px;border-radius:10px;background:#f3f6f4;color:#1e2a1e;font-weight:700;border:1px solid transparent;text-decoration:none;transition:all .18s ease}
        .lang.active{background:#e2f5e4;border-color:#cbe8cd;color:#0f4c0f;box-shadow:inset 0 -3px 0 var(--green)}
        .menu-toggle{display:none;padding:8px 12px;border-radius:10px;background:#f3f6f4;border:1px solid #e6e6e6;cursor:pointer}
        @media (max-width:640px){
            .nav-links{display:none}
            .nav-links.open{display:flex}
            .menu-toggle{display:block}
        }
        .tabs-header{position:relative;display:flex;gap:8px;padding:14px 20px 22px;border-bottom:1px solid #e6e6e6;flex-wrap:wrap}
        .tab-btn{
            padding:10px 14px 12px;
            border-radius:10px;
            background:#f3f6f4;
            color:#1e2a1e;
            font-weight:700;
            cursor:pointer;
            border:1px solid transparent;
            transition:all .18s ease;
        }
        .tab-btn:hover{background:#e9f3ea}
        .tab-btn.active{
            background:#e2f5e4;
            border-color:#cbe8cd;
            color:#0f4c0f;
            box-shadow:inset 0 -4px 0 var(--green);
        }
        .tab-indicator{position:absolute;height:3px;background:var(--green);border-radius:3px;bottom:0;left:20px;width:60px;transition:all .25s ease}
        .tab-panels{padding:18px 0}
        .panel{display:none;opacity:0}
        .panel.active{display:block;opacity:1}
        .panel.fade-in{animation:fadeIn .35s ease forwards}
        .panel.fade-out{animation:fadeOut .25s ease forwards}
        @keyframes fadeOut{0%{opacity:1}100%{opacity:0}}
        @keyframes fadeIn{0%{opacity:0}100%{opacity:1}}

        .panel-head{
            display:flex;justify-content:space-between;align-items:center;
            padding:0 20px;margin-bottom:8px
        }
        .panel-title{
            font-size:22px;font-weight:800;margin:0;color:#172117
        }
        .panel-desc{
            color:var(--muted);font-size:14px;margin:6px 20px 16px
        }
        .grid{
            display:grid;
            grid-template-columns:repeat(3,minmax(0,1fr));
            gap:16px;
            padding:0 20px 24px;
        }
        @media (max-width:920px){.grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
        @media (max-width:640px){.grid{grid-template-columns:1fr}}
        .card{
            background:#fff;border:1px solid #e7ece8;border-radius:14px;
            box-shadow:0 6px 18px rgba(27, 59, 29, .06);
            overflow:hidden;
            transform:scale(.98);
            opacity:0;
            animation:zoomIn .6s ease forwards;
        }
        .card:nth-child(1){animation-delay:.08s}
        .card:nth-child(2){animation-delay:.18s}
        .card:nth-child(3){animation-delay:.28s}
        @keyframes zoomIn{
            0%{opacity:0;transform:scale(.95)}
            70%{opacity:1;transform:scale(1.02)}
            100%{opacity:1;transform:scale(1)}
        }
        .card:hover{transform:translateY(-6px) scale(1.02);box-shadow:0 14px 30px rgba(0,0,0,.14)}
        .thumb{height:150px;background-size:cover;background-position:center}
        .card-body{padding:14px}
        .card-title{font-size:16px;font-weight:800;margin:0 0 6px}
        .card-text{color:#4b4b4b;font-size:13px;margin:0 0 10px}
        .card-meta{display:flex;justify-content:space-between;align-items:center}
        .price{font-weight:800;color:#0f4c0f}
        .details-btn{
            padding:8px 12px;border-radius:10px;border:1px solid #cfe7d1;
            background:#e9f5ea;color:#0f4c0f;font-weight:700;cursor:pointer;
            transition:all .18s ease
        }
        .details-btn:hover{background:#dbf1dd}
        .icon{
            width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;
            border-radius:50%;background:#f3faf3;margin-right:8px;
            transition:transform .25s ease
        }
        .card:hover .icon{transform:rotate(12deg)}
        [dir="rtl"] .icon{margin-right:0;margin-left:8px}

        .svc-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;padding:0 20px 24px}
        @media (max-width:920px){.svc-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
        @media (max-width:640px){.svc-grid{grid-template-columns:1fr}}
        .svc-card{
            background:#fff;border:1px solid #e7ece8;border-radius:14px;box-shadow:0 6px 18px rgba(27,59,29,.06);
            padding:16px;opacity:0;transform:translateX(-12px);
            animation:slideIn .6s ease forwards;
        }
        .svc-card:nth-child(1){animation-delay:.06s}
        .svc-card:nth-child(2){animation-delay:.16s}
        .svc-card:nth-child(3){animation-delay:.26s}
        .svc-head{display:flex;align-items:center;gap:10px;margin-bottom:8px}
        .svc-icon{
            width:40px;height:40px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;
            font-size:20px;color:#fff;box-shadow:0 6px 16px rgba(0,0,0,.12);
            animation:float 2.8s ease-in-out infinite;
        }
        .svc-icon.green{background:var(--green)}
        .svc-icon.blue{background:var(--blue)}
        .svc-icon.orange{background:var(--orange)}
        .svc-title{
            font-size:18px;font-weight:800;margin:0;position:relative
        }
        .svc-title::after{
            content:"";position:absolute;left:0;right:0;height:2px;background:#cfe7d1;bottom:-6px;
            transform-origin:left;transform:scaleX(0);transition:transform .25s ease;
        }
        [dir="rtl"] .svc-title::after{transform-origin:right}
        .svc-card:hover .svc-title::after{transform:scaleX(1)}
        .svc-desc{color:#4b4b4b;font-size:13px;margin:10px 0 8px}
        .bullets{list-style:none;padding:0;margin:8px 0 12px}
        .bullets li{
            display:flex;align-items:center;gap:8px;color:#1c2a1e;font-size:13px;
            opacity:0;transform:translateY(8px);
            animation:fadeSlideUp .45s ease forwards;
        }
        .bullets li:nth-child(1){animation-delay:.08s}
        .bullets li:nth-child(2){animation-delay:.18s}
        .bullets li:nth-child(3){animation-delay:.28s}
        .svc-meta{display:flex;justify-content:space-between;align-items:center}
        .svc-price{font-weight:800;color:#0f4c0f}
        .svc-cta{
            padding:8px 12px;border-radius:10px;border:1px solid #cfe7d1;background:#e9f5ea;color:#0f4c0f;
            font-weight:700;cursor:pointer;transition:all .18s ease
        }
        .svc-cta:hover{background:#dbf1dd}

        .cnsl-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:16px;padding:0 20px 24px}
        @media (max-width:920px){.cnsl-grid{grid-template-columns:repeat(2,minmax(0,1fr))}}
        @media (max-width:640px){.cnsl-grid{grid-template-columns:1fr}}
        .cnsl-card{
            background:#fff;border:1px solid #e7ece8;border-radius:14px;box-shadow:0 6px 18px rgba(27,59,29,.06);
            padding:16px;opacity:0;transform:scale(.98);
            animation:fadeIn .7s ease forwards;
            transition:transform .2s ease, box-shadow .2s ease;
        }
        .cnsl-card:hover{transform:scale(1.02);box-shadow:0 16px 30px rgba(0,0,0,.18)}
        .cnsl-card:nth-child(1){animation-delay:.08s}
        .cnsl-card:nth-child(2){animation-delay:.18s}
        .cnsl-card:nth-child(3){animation-delay:.28s}
        .cnsl-head{display:flex;align-items:center;gap:10px;margin-bottom:8px}
        .cnsl-icon{
            width:42px;height:42px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;
            font-size:20px;color:#fff;box-shadow:0 6px 16px rgba(0,0,0,.12);
            animation:rotate 6s linear infinite;
        }
        .cnsl-icon.green{background:var(--green)}
        .cnsl-icon.blue{background:var(--blue)}
        .cnsl-icon.orange{background:var(--orange)}
        @keyframes rotate{from{transform:rotate(0)}to{transform:rotate(360deg)}}
        .cnsl-title{font-size:18px;font-weight:800;margin:0}
        .cnsl-desc{color:#4b4b4b;font-size:13px;margin:10px 0 8px}
        .includes{list-style:none;padding:0;margin:8px 0 12px}
        .includes li{
            display:flex;align-items:center;gap:8px;color:#1c2a1e;font-size:13px;
            opacity:0;transform:translateY(8px);
            animation:fadeSlideUp .45s ease forwards;
        }
        .includes li:nth-child(1){animation-delay:.08s}
        .includes li:nth-child(2){animation-delay:.16s}
        .includes li:nth-child(3){animation-delay:.24s}
        .includes li:nth-child(4){animation-delay:.32s}
        .cnsl-meta{display:flex;justify-content:space-between;align-items:center;margin-top:8px}
        .cnsl-left{display:flex;gap:10px;align-items:center;color:#203020;font-weight:700;font-size:13px}
        .cnsl-price{font-weight:800;color:#0f4c0f;animation:pulse 1.8s ease-in-out infinite}
        @keyframes pulse{0%,100%{opacity:1}50%{opacity:.7}}
        .cnsl-cta{
            padding:8px 12px;border-radius:10px;border:1px solid #cfe7d1;background:#e9f5ea;color:#0f4c0f;
            font-weight:700;cursor:pointer;transition:all .18s ease
        }
        .cnsl-cta:hover{background:#dbf1dd}

        .stats{background:linear-gradient(135deg, rgba(34,139,34,.15), rgba(0,100,0,.15));padding:28px 0;margin-top:6px}
        .stats .container{display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:14px;align-items:center}
        @media (max-width:920px){.stats .container{grid-template-columns:repeat(2,minmax(0,1fr))}}
        @media (max-width:640px){.stats .container{grid-template-columns:1fr}}
        .stat{
            background:#fff;border:1px solid #e7ece8;border-radius:14px;box-shadow:0 6px 18px rgba(27,59,29,.06);
            padding:16px;display:flex;align-items:center;gap:12px
        }
        .stat-icon{width:40px;height:40px;border-radius:10px;background:#e9f5ea;display:inline-flex;align-items:center;justify-content:center;font-size:20px;color:#0f4c0f;animation:bounce 2.8s ease-in-out infinite}
        .stat-text{font-weight:800;color:#153015}
        .stat-number{font-weight:800;color:#0f4c0f;animation:countUp .6s ease}
        @keyframes countUp{from{opacity:0}to{opacity:1}}
        .stat-sub{color:#4b4b4b;font-size:13px}

        .cta{
            position:relative;margin:24px 0 32px;min-height:220px;display:flex;align-items:center;justify-content:center;
            background-image:url("<?php echo e(asset('images/home-hero.jpeg')); ?>");
            background-size:cover;background-position:center;border-radius:16px;overflow:hidden;
        }
        .cta::before{content:"";position:absolute;inset:0;background:linear-gradient(135deg, rgba(34,139,34,.5), rgba(0,100,0,.5))}
        .cta-content{position:relative;z-index:2;text-align:center;color:#fff;padding:24px}
        .cta-title{font-weight:900;font-size:clamp(22px,4vw,36px);margin:0 0 12px;animation:bounce 1.2s ease, fadeSlideUp .9s cubic-bezier(.2,.9,.25,1) forwards}
        .cta-btn{background:#ff4d3a;color:#fff;border:none;border-radius:12px;padding:12px 20px;font-weight:800;cursor:pointer;box-shadow:0 8px 22px rgba(0,0,0,.22);animation:bounce 1.2s ease, breathe 3.2s ease-in-out infinite}
        @keyframes breathe{0%,100%{transform:scale(1)}50%{transform:scale(1.04)}}
        .cta-btn:active{transform:scale(.98)}

        .env-layer{position:fixed;inset:0;pointer-events:none;z-index:1}
        .leaf,.bubble,.bird{position:absolute}
        .leaf{font-size:18px;color:#2e8b57;top:-10px;animation:fall 8s linear infinite}
        @keyframes fall{
            0%{top:-10px;opacity:1;transform:translateX(0) rotate(0deg)}
            100%{top:100vh;opacity:0;transform:translateX(100px) rotate(720deg)}
        }
        .bubble{width:10px;height:10px;border-radius:50%;background:rgba(180,220,255,.6);animation:rise 7s ease-in infinite}
        @keyframes rise{0%{transform:translateY(10vh) scale(.7)}100%{transform:translateY(-120vh) scale(1)}}
        .bird{font-size:16px;animation:fly 12s linear infinite}
        @keyframes fly{0%{transform:translateX(-10vw)}100%{transform:translateX(110vw)}}

        .ripple-anim{animation:ripple .7s linear}
        @keyframes ripple{
            0%{box-shadow:0 0 0 0 rgba(34,139,34,.7)}
            70%{box-shadow:0 0 0 10px rgba(34,139,34,0)}
            100%{box-shadow:0 0 0 0 rgba(34,139,34,0)}
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="nav">
            <div class="brand" style="display:flex;align-items:center;gap:10px">
                <img src="<?php echo e(asset('images/logo.jpeg')); ?>" alt="SOQIA Innovative Environmental Solutions" style="height:20px;width:auto;border-radius:4px">
                <div style="font-weight:900;color:#228B22">SOQIA</div>
                <div style="font-size:12px;color:#1e2a1e">Innovative Environmental Solutions</div>
            </div>
            <button class="menu-toggle" id="menuToggle">☰</button>
            <div class="nav-links" id="navLinks">
                <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>" href="<?php echo e(url('/')); ?>"><?php echo e(__('home.nav.home')); ?></a>
                <a class="nav-link <?php echo e(request()->is('awareness-content') ? 'active' : ''); ?>" href="<?php echo e(url('/awareness-content')); ?>"><?php echo e(__('home.nav.awareness')); ?></a>
                <a class="nav-link <?php echo e(request()->is('login') ? 'active' : ''); ?>" href="<?php echo e(url('/login')); ?>"><?php echo e(__('home.nav.login')); ?></a>
                <?php if(auth()->guard()->check()): ?>
                <a class="nav-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>" href="<?php echo e(url('/dashboard')); ?>"><?php echo e(__('home.nav.dashboard')); ?></a>
                <?php endif; ?>
                <div class="lang-switch">
                    <a class="lang <?php echo e(app()->getLocale() === 'en' ? 'active' : ''); ?>" href="<?php echo e(url()->current()); ?>?lang=en">EN</a>
                    <a class="lang <?php echo e(app()->getLocale() === 'ar' ? 'active' : ''); ?>" href="<?php echo e(url()->current()); ?>?lang=ar">AR</a>
                </div>
            </div>
        </div>
    </header>
    <section class="hero">
        <video class="hero-video" src="<?php echo e(asset('images/hero.mp4')); ?>" autoplay muted loop playsinline></video>
        <div class="hero-content container">
            <h1 class="hero-title">🌾 <?php echo e(__('home.hero.title')); ?></h1>
            <p class="hero-sub"><?php echo e(__('home.hero.subtitle')); ?></p>
            <div class="hero-actions">
                <button class="btn btn-green"><?php echo e(__('home.hero.buttons.explore')); ?></button>
                <button class="btn btn-blue"><?php echo e(__('home.hero.buttons.services')); ?></button>
                <button class="btn btn-orange"><?php echo e(__('home.hero.buttons.consult')); ?></button>
            </div>
        </div>
    </section>

    <?php if(isset($contents) && $contents->count()): ?>
    <section class="container" style="margin-top:24px">
        <h2 style="font-size:22px;font-weight:800;color:#153015;margin-bottom:10px"><?php echo e(app()->getLocale() === 'ar' ? 'مختارات توعوية' : 'Awareness Highlights'); ?></h2>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:14px">
            <?php $__currentLoopData = $contents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div style="background:#fff;border:1px solid #e6e6e6;border-radius:12px;overflow:hidden">
                    <img src="<?php echo e($item->image_path ? asset($item->image_path) : asset('images/farm1.jpg')); ?>" alt="" style="height:140px;width:100%;object-fit:cover">
                    <div style="padding:12px">
                        <div style="font-weight:700;color:#203020"><?php echo e($item->title); ?></div>
                        <?php if($item->body): ?>
                            <div style="margin-top:6px;color:#555;font-size:13px"><?php echo e(\Illuminate\Support\Str::limit(strip_tags($item->body), 120)); ?></div>
                        <?php endif; ?>
                        <div style="margin-top:8px;display:flex;justify-content:space-between;align-items:center;font-size:12px;color:#777">
                            <span><?php echo e(\Carbon\Carbon::parse($item->created_at)->format('Y-m-d')); ?></span>
                            <span style="color:#FF9800"><?php echo e(app()->getLocale() === 'ar' ? 'اقرأ المزيد' : 'Read more'); ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </section>
    <?php endif; ?>

    <section class="tabs">
        <div class="container">
            <div class="tabs-header" id="tabsHeader">
                <button class="tab-btn active" data-tab="products"><?php echo e(__('home.tabs.labels.products')); ?></button>
                <button class="tab-btn" data-tab="services"><?php echo e(__('home.tabs.labels.services')); ?></button>
                <button class="tab-btn" data-tab="consult"><?php echo e(__('home.tabs.labels.consult')); ?></button>
                <div class="tab-indicator" id="tabIndicator"></div>
            </div>
            <div class="tab-panels">
                <div class="panel active" id="panel-products">
                    <div class="panel-head">
                        <h2 class="panel-title">📦 <?php echo e(__('home.tabs.products.title')); ?></h2>
                    </div>
                    <p class="panel-desc"><?php echo e(__('home.tabs.products.description')); ?></p>
                    <div class="grid">
                        <div class="card">
                            <div class="thumb" style="background-image:url('<?php echo e(asset('images/product-1.jpg')); ?>')"></div>
                            <div class="card-body">
                                <div style="display:flex;align-items:center;margin-bottom:6px">
                                    <div class="icon">💧</div>
                                    <h3 class="card-title"><?php echo e(__('home.tabs.products.items.1.title')); ?></h3>
                                </div>
                                <p class="card-text"><?php echo e(__('home.tabs.products.items.1.description')); ?></p>
                                <div class="card-meta">
                                    <span class="price"><?php echo e(__('home.tabs.products.items.1.price')); ?></span>
                                    <button class="details-btn"><?php echo e(__('home.tabs.products.items.details')); ?></button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="thumb" style="background-image:url('<?php echo e(asset('images/product-2.jpg')); ?>')"></div>
                            <div class="card-body">
                                <div style="display:flex;align-items:center;margin-bottom:6px">
                                    <div class="icon">🔧</div>
                                    <h3 class="card-title"><?php echo e(__('home.tabs.products.items.2.title')); ?></h3>
                                </div>
                                <p class="card-text"><?php echo e(__('home.tabs.products.items.2.description')); ?></p>
                                <div class="card-meta">
                                    <span class="price"><?php echo e(__('home.tabs.products.items.2.price')); ?></span>
                                    <button class="details-btn"><?php echo e(__('home.tabs.products.items.details')); ?></button>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="thumb" style="background-image:url('<?php echo e(asset('images/product-3.jpg')); ?>')"></div>
                            <div class="card-body">
                                <div style="display:flex;align-items:center;margin-bottom:6px">
                                    <div class="icon">📡</div>
                                    <h3 class="card-title"><?php echo e(__('home.tabs.products.items.3.title')); ?></h3>
                                </div>
                                <p class="card-text"><?php echo e(__('home.tabs.products.items.3.description')); ?></p>
                                <div class="card-meta">
                                    <span class="price"><?php echo e(__('home.tabs.products.items.3.price')); ?></span>
                                    <button class="details-btn"><?php echo e(__('home.tabs.products.items.details')); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel" id="panel-services">
                    <div class="panel-head">
                        <h2 class="panel-title">🔧 <?php echo e(__('home.tabs.services.title')); ?></h2>
                    </div>
                    <p class="panel-desc"><?php echo e(__('home.tabs.services.description')); ?></p>
                    <div class="svc-grid">
                        <div class="svc-card">
                            <div class="svc-head">
                                <div class="svc-icon green">🏗️</div>
                                <h3 class="svc-title"><?php echo e(__('home.tabs.services.items.1.title')); ?></h3>
                            </div>
                            <p class="svc-desc"><?php echo e(__('home.tabs.services.items.1.description')); ?></p>
                            <ul class="bullets">
                                <li>✅ <?php echo e(__('home.tabs.services.items.1.points.1')); ?></li>
                                <li>✅ <?php echo e(__('home.tabs.services.items.1.points.2')); ?></li>
                                <li>✅ <?php echo e(__('home.tabs.services.items.1.points.3')); ?></li>
                            </ul>
                            <div class="svc-meta">
                                <span class="svc-price"><?php echo e(__('home.tabs.services.items.1.price')); ?></span>
                                <button class="svc-cta"><?php echo e(__('home.tabs.services.items.cta')); ?></button>
                            </div>
                        </div>
                        <div class="svc-card">
                            <div class="svc-head">
                                <div class="svc-icon blue">🔗</div>
                                <h3 class="svc-title"><?php echo e(__('home.tabs.services.items.2.title')); ?></h3>
                            </div>
                            <p class="svc-desc"><?php echo e(__('home.tabs.services.items.2.description')); ?></p>
                            <ul class="bullets">
                                <li>✅ <?php echo e(__('home.tabs.services.items.2.points.1')); ?></li>
                                <li>✅ <?php echo e(__('home.tabs.services.items.2.points.2')); ?></li>
                                <li>✅ <?php echo e(__('home.tabs.services.items.2.points.3')); ?></li>
                            </ul>
                            <div class="svc-meta">
                                <span class="svc-price"><?php echo e(__('home.tabs.services.items.2.price')); ?></span>
                                <button class="svc-cta"><?php echo e(__('home.tabs.services.items.cta')); ?></button>
                            </div>
                        </div>
                        <div class="svc-card">
                            <div class="svc-head">
                                <div class="svc-icon orange">🛠️</div>
                                <h3 class="svc-title"><?php echo e(__('home.tabs.services.items.3.title')); ?></h3>
                            </div>
                            <p class="svc-desc"><?php echo e(__('home.tabs.services.items.3.description')); ?></p>
                            <ul class="bullets">
                                <li>✅ <?php echo e(__('home.tabs.services.items.3.points.1')); ?></li>
                                <li>✅ <?php echo e(__('home.tabs.services.items.3.points.2')); ?></li>
                                <li>✅ <?php echo e(__('home.tabs.services.items.3.points.3')); ?></li>
                            </ul>
                            <div class="svc-meta">
                                <span class="svc-price"><?php echo e(__('home.tabs.services.items.3.price')); ?></span>
                                <button class="svc-cta"><?php echo e(__('home.tabs.services.items.cta')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel" id="panel-consult">
                    <div class="panel-head">
                        <h2 class="panel-title">📋 <?php echo e(__('home.tabs.consult.title')); ?></h2>
                    </div>
                    <p class="panel-desc"><?php echo e(__('home.tabs.consult.description')); ?></p>
                    <div class="cnsl-grid">
                        <div class="cnsl-card">
                            <div class="cnsl-head">
                                <div class="cnsl-icon green">📈</div>
                                <h3 class="cnsl-title"><?php echo e(__('home.tabs.consult.items.1.title')); ?></h3>
                            </div>
                            <p class="cnsl-desc"><?php echo e(__('home.tabs.consult.items.1.description')); ?></p>
                            <ul class="includes">
                                <li>💧 <?php echo e(__('home.tabs.consult.items.1.includes.1')); ?></li>
                                <li>🌾 <?php echo e(__('home.tabs.consult.items.1.includes.2')); ?></li>
                                <li>💰 <?php echo e(__('home.tabs.consult.items.1.includes.3')); ?></li>
                                <li>⏱️ <?php echo e(__('home.tabs.consult.items.1.includes.4')); ?></li>
                            </ul>
                            <div class="cnsl-meta">
                                <div class="cnsl-left">
                                    <span><?php echo e(__('home.tabs.consult.items.1.duration')); ?></span>
                                    <span class="cnsl-price"><?php echo e(__('home.tabs.consult.items.1.price')); ?></span>
                                </div>
                                <button class="cnsl-cta"><?php echo e(__('home.tabs.consult.items.cta')); ?></button>
                            </div>
                        </div>
                        <div class="cnsl-card">
                            <div class="cnsl-head">
                                <div class="cnsl-icon blue">🔧</div>
                                <h3 class="cnsl-title"><?php echo e(__('home.tabs.consult.items.2.title')); ?></h3>
                            </div>
                            <p class="cnsl-desc"><?php echo e(__('home.tabs.consult.items.2.description')); ?></p>
                            <ul class="includes">
                                <li>🔍 <?php echo e(__('home.tabs.consult.items.2.includes.1')); ?></li>
                                <li>📊 <?php echo e(__('home.tabs.consult.items.2.includes.2')); ?></li>
                                <li>💡 <?php echo e(__('home.tabs.consult.items.2.includes.3')); ?></li>
                                <li>📋 <?php echo e(__('home.tabs.consult.items.2.includes.4')); ?></li>
                            </ul>
                            <div class="cnsl-meta">
                                <div class="cnsl-left">
                                    <span><?php echo e(__('home.tabs.consult.items.2.duration')); ?></span>
                                    <span class="cnsl-price"><?php echo e(__('home.tabs.consult.items.2.price')); ?></span>
                                </div>
                                <button class="cnsl-cta"><?php echo e(__('home.tabs.consult.items.cta')); ?></button>
                            </div>
                        </div>
                        <div class="cnsl-card">
                            <div class="cnsl-head">
                                <div class="cnsl-icon orange">🌱</div>
                                <h3 class="cnsl-title"><?php echo e(__('home.tabs.consult.items.3.title')); ?></h3>
                            </div>
                            <p class="cnsl-desc"><?php echo e(__('home.tabs.consult.items.3.description')); ?></p>
                            <ul class="includes">
                                <li>♻️ <?php echo e(__('home.tabs.consult.items.3.includes.1')); ?></li>
                                <li>💧 <?php echo e(__('home.tabs.consult.items.3.includes.2')); ?></li>
                                <li>🌍 <?php echo e(__('home.tabs.consult.items.3.includes.3')); ?></li>
                                <li>📊 <?php echo e(__('home.tabs.consult.items.3.includes.4')); ?></li>
                            </ul>
                            <div class="cnsl-meta">
                                <div class="cnsl-left">
                                    <span><?php echo e(__('home.tabs.consult.items.3.duration')); ?></span>
                                    <span class="cnsl-price"><?php echo e(__('home.tabs.consult.items.3.price')); ?></span>
                                </div>
                                <button class="cnsl-cta"><?php echo e(__('home.tabs.consult.items.cta')); ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="stats">
        <div class="container">
            <div class="stat">
                <div class="stat-icon">🏆</div>
                <div>
                    <div class="stat-number" data-target="50" data-suffix="+">0</div>
                    <div class="stat-sub"><?php echo e(__('home.stats.items.1')); ?></div>
                </div>
            </div>
            <div class="stat">
                <div class="stat-icon">👥</div>
                <div>
                    <div class="stat-number" data-target="200" data-suffix="+">0</div>
                    <div class="stat-sub"><?php echo e(__('home.stats.items.2')); ?></div>
                </div>
            </div>
            <div class="stat">
                <div class="stat-icon">💧</div>
                <div>
                    <div class="stat-number" data-target="1000000" data-suffix="">0</div>
                    <div class="stat-sub"><?php echo e(__('home.stats.items.3')); ?></div>
                </div>
            </div>
            <div class="stat">
                <div class="stat-icon">⏳</div>
                <div>
                    <div class="stat-number" data-target="10" data-suffix="+">0</div>
                    <div class="stat-sub"><?php echo e(__('home.stats.items.4')); ?></div>
                </div>
            </div>
        </div>
    </section>

    <section class="about" style="padding:40px 0">
        <div class="container" style="display:grid;grid-template-columns:1fr 1fr;gap:20px">
            <div style="background:#fff;border:1px solid #e6e6e6;border-radius:14px;padding:20px">
                <div style="font-size:20px;font-weight:800;color:#153015"><?php echo e(__('home.sections.about.title')); ?></div>
                <p style="margin-top:8px;color:#555"><?php echo e(__('home.sections.about.desc')); ?></p>
            </div>
            <div style="background:#fff;border:1px solid #e6e6e6;border-radius:14px;padding:20px">
                <div style="font-size:20px;font-weight:800;color:#153015"><?php echo e(__('home.sections.story.title')); ?></div>
                <p style="margin-top:8px;color:#555"><?php echo e(__('home.sections.story.desc')); ?></p>
            </div>
        </div>
    </section>
    <section class="reviews" style="padding:20px 0">
        <div class="container">
            <div style="font-size:20px;font-weight:800;color:#153015;margin-bottom:12px"><?php echo e(__('home.sections.reviews.title')); ?></div>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:16px">
                <div style="background:#fff;border:1px solid #e6e6e6;border-radius:14px;padding:16px">
                    <div style="font-weight:700;color:#1e2a1e"><?php echo e(__('home.sections.reviews.items.1.name')); ?></div>
                    <div style="margin-top:6px;color:#555"><?php echo e(__('home.sections.reviews.items.1.text')); ?></div>
                </div>
                <div style="background:#fff;border:1px solid #e6e6e6;border-radius:14px;padding:16px">
                    <div style="font-weight:700;color:#1e2a1e"><?php echo e(__('home.sections.reviews.items.2.name')); ?></div>
                    <div style="margin-top:6px;color:#555"><?php echo e(__('home.sections.reviews.items.2.text')); ?></div>
                </div>
                <div style="background:#fff;border:1px solid #e6e6e6;border-radius:14px;padding:16px">
                    <div style="font-weight:700;color:#1e2a1e"><?php echo e(__('home.sections.reviews.items.3.name')); ?></div>
                    <div style="margin-top:6px;color:#555"><?php echo e(__('home.sections.reviews.items.3.text')); ?></div>
                </div>
            </div>
        </div>
    </section>
    <section class="achievements" style="padding:20px 0">
        <div class="container">
            <div style="font-size:20px;font-weight:800;color:#153015;margin-bottom:12px"><?php echo e(__('home.sections.achievements.title')); ?></div>
            <div style="display:flex;gap:12px;flex-wrap:wrap">
                <div style="flex:1;min-width:200px;background:#fff;border:1px solid #e6e6e6;border-radius:14px;padding:16px;text-align:center;color:#1e2a1e"><?php echo e(__('home.sections.achievements.items.1')); ?></div>
                <div style="flex:1;min-width:200px;background:#fff;border:1px solid #e6e6e6;border-radius:14px;padding:16px;text-align:center;color:#1e2a1e"><?php echo e(__('home.sections.achievements.items.2')); ?></div>
                <div style="flex:1;min-width:200px;background:#fff;border:1px solid #e6e6e6;border-radius:14px;padding:16px;text-align:center;color:#1e2a1e"><?php echo e(__('home.sections.achievements.items.3')); ?></div>
            </div>
        </div>
    </section>
    <section class="cta">
        <div class="cta-content">
            <h3 class="cta-title"><?php echo e(__('home.cta.title')); ?></h3>
            <a href="<?php echo e(url('/login')); ?>" class="cta-btn" id="ctaBtn"><?php echo e(__('home.cta.button')); ?></a>
        </div>
    </section>

    <div class="env-layer" id="envLayer"></div>

    <footer style="background:linear-gradient(135deg, rgba(34,139,34,.08), rgba(0,100,0,.08));padding:32px 0;margin-top:24px;border-top:1px solid #e6e6e6">
        <div class="container" style="display:grid;grid-template-columns:1.5fr 1fr 1fr;gap:16px">
            <div>
                <div style="display:flex;align-items:center;gap:8px">
                    <img src="<?php echo e(asset('images/logo.jpeg')); ?>" alt="SOQIA Innovative Environmental Solutions" style="height:16px;width:auto;border-radius:4px">
                    <div style="font-weight:800;color:#153015">SOQIA</div>
                </div>
                <div style="margin-top:6px;color:#555">Innovative Environmental Solutions</div>
            </div>
            <div>
                <div style="font-weight:700;color:#203020"><?php echo e(__('home.tabs.labels.products')); ?></div>
                <div style="display:flex;gap:10px;flex-wrap:wrap;margin-top:8px">
                    <a href="<?php echo e(url('/')); ?>" style="color:#203020;text-decoration:none"><?php echo e(__('home.nav.home')); ?></a>
                    <a href="<?php echo e(url('/awareness-content')); ?>" style="color:#203020;text-decoration:none"><?php echo e(__('home.nav.awareness')); ?></a>
                    <a href="<?php echo e(url('/login')); ?>" style="color:#203020;text-decoration:none"><?php echo e(__('home.nav.login')); ?></a>
                    <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(url('/dashboard')); ?>" style="color:#203020;text-decoration:none"><?php echo e(__('home.nav.dashboard')); ?></a>
                    <?php endif; ?>
                </div>
            </div>
            <div>
                <div style="font-weight:700;color:#203020">Contact</div>
                <div style="margin-top:8px;color:#555">info@saqqia.jo</div>
            </div>
        </div>
        <div class="container" style="margin-top:14px;color:#4b4b4b;font-size:13px;display:flex;justify-content:space-between;align-items:center;gap:12px;flex-wrap:wrap">
            <div>© <?php echo e(date('Y')); ?> Saqqia</div>
            <div style="display:flex;gap:10px">
                <a href="<?php echo e(url('/awareness-content')); ?>" style="color:#203020;text-decoration:none"><?php echo e(__('home.nav.awareness')); ?></a>
                <a href="<?php echo e(url('/login')); ?>" style="color:#203020;text-decoration:none"><?php echo e(__('home.nav.login')); ?></a>
            </div>
        </div>
    </footer>

    <script>
        document.getElementById('menuToggle')?.addEventListener('click', function(){
            document.getElementById('navLinks')?.classList.toggle('open');
        });
        const HOME_DATA_AR = {
            hero: {
                title: "🌾 أهلاً بك في سقيا",
                subtitle: "إدارة المياه بذكاء لمستقبل أخضر مستدام في الأردن",
                buttons: [
                    { text: "📦 استكشف المنتجات", color: "green" },
                    { text: "🔧 خدماتنا", color: "blue" },
                    { text: "📋 احصل على استشارة", color: "orange" }
                ]
            },
            products: [
                { id: 1, title: "نظام الري بالتنقيط", description: "توفير 60% من المياه مع كفاءة عالية", price: "2,500", icon: "💧" },
                { id: 2, title: "المتحكم الذكي", description: "تحكم ذكي في أوقات الري عبر التطبيق", price: "1,800", icon: "📱" },
                { id: 3, title: "أجهزة استشعار التربة", description: "قياس رطوبة التربة بدقة عالية", price: "350", icon: "🌱" }
            ],
            services: [
                { id: 1, title: "التركيب والتثبيت", description: "تركيب احترافي لأنظمة الري بضمان كامل", icon: "🏗️", price: "يبدأ من 500 د.ا", features: ["فريق متخصص", "ضمان 2 سنة", "تركيب سريع"] },
                { id: 2, title: "الشبك والربط", description: "ربط احترافي لجميع أجزاء النظام", icon: "🔗", price: "يبدأ من 300 د.ا", features: ["ربط متكامل", "فحص كامل", "توثيق دقيق"] },
                { id: 3, title: "الصيانة الدورية", description: "صيانة مستمرة لضمان عمل النظام بكفاءة", icon: "🛠️", price: "باقات شهرية", features: ["صيانة ربع سنوية", "استبدال قطع", "دعم فني 24/7"] }
            ],
            consultations: [
                { id: 1, title: "دراسة جدوى شاملة", description: "دراسة كاملة لمشروعك الزراعي", icon: "📈", duration: "7-10 أيام", price: "500 د.ا", includes: ["تحليل احتياجات المياه", "دراسة المحاصيل المناسبة", "حساب العائد المالي", "خطة التنفيذ"] },
                { id: 2, title: "استشارة تقنية", description: "تقييم نظامك الحالي وتحسينه", icon: "🔧", duration: "3-5 أيام", price: "300 د.ا", includes: ["فحص النظام الحالي", "تحليل الكفاءة", "اقتراحات التحسين", "تقرير مفصل"] },
                { id: 3, title: "استشارة بيئية", description: "حماية البيئة والموارد المائية", icon: "🌱", duration: "5-7 أيام", price: "400 د.ا", includes: ["تقييم التأثير البيئي", "خطة توفير المياه", "حلول مستدامة", "مؤشرات الاستدامة"] }
            ],
            statistics: [
                { label: "مشروع منجز", value: "50+", icon: "🏆" },
                { label: "عميل راضٍ", value: "200+", icon: "👥" },
                { label: "لتر مياه موفرة", value: "1,000,000", icon: "💧" },
                { label: "سنة خبرة", value: "10+", icon: "⏳" }
            ]
        };
        const HOME_DATA_EN = {
            hero: {
                title: "🌾 Welcome to Saqqia",
                subtitle: "Smart water management for a sustainable green future in Jordan",
                buttons: [
                    { text: "📦 Explore Products", color: "green" },
                    { text: "🔧 Our Services", color: "blue" },
                    { text: "📋 Get a Consultation", color: "orange" }
                ]
            },
            products: [
                { id: 1, title: "Drip Irrigation System", description: "Save 60% of water with high efficiency", price: "2,500", icon: "💧" },
                { id: 2, title: "Smart Controller", description: "Smart control of irrigation schedules via app", price: "1,800", icon: "📱" },
                { id: 3, title: "Soil Moisture Sensors", description: "Accurate measurement of soil moisture", price: "350", icon: "🌱" }
            ],
            services: [
                { id: 1, title: "Installation & Setup", description: "Professional installation of irrigation systems with full warranty", icon: "🏗️", price: "Starts from 500 JOD", features: ["Specialized team", "2-year warranty", "Fast installation"] },
                { id: 2, title: "Wiring & Integration", description: "Professional integration of all system components", icon: "🔗", price: "Starts from 300 JOD", features: ["Full integration", "Comprehensive inspection", "Accurate documentation"] },
                { id: 3, title: "Periodic Maintenance", description: "Continuous maintenance to ensure efficient system operation", icon: "🛠️", price: "Monthly plans", features: ["Quarterly maintenance", "Replace faulty parts", "24/7 technical support"] }
            ],
            consultations: [
                { id: 1, title: "Comprehensive Feasibility Study", description: "A complete study for your agricultural project", icon: "📈", duration: "7–10 days", price: "500 JOD", includes: ["Water needs analysis", "Crop suitability study", "Financial return calculation", "Implementation plan"] },
                { id: 2, title: "Technical Consultation", description: "Assess and improve your current system", icon: "🔧", duration: "3–5 days", price: "300 JOD", includes: ["Current system inspection", "Efficiency analysis", "Improvement suggestions", "Detailed report"] },
                { id: 3, title: "Environmental Consultation", description: "Protect the environment and water resources", icon: "🌱", duration: "5–7 days", price: "400 JOD", includes: ["Environmental impact assessment", "Water-saving plan", "Sustainable solutions", "Sustainability indicators"] }
            ],
            statistics: [
                { label: "Projects Completed", value: "50+", icon: "🏆" },
                { label: "Satisfied Clients", value: "200+", icon: "👥" },
                { label: "Liters of Water Saved", value: "1,000,000", icon: "💧" },
                { label: "Years Experience", value: "10+", icon: "⏳" }
            ]
        };

        const btns = Array.from(document.querySelectorAll('.tab-btn'));
        const panels = {
            products: document.getElementById('panel-products'),
            services: document.getElementById('panel-services'),
            consult: document.getElementById('panel-consult'),
        };
        const indicator = document.getElementById('tabIndicator');
        function moveIndicator(el){
            const header = document.getElementById('tabsHeader');
            const r = el.getBoundingClientRect();
            const hr = header.getBoundingClientRect();
            indicator.style.left = (r.left - hr.left) + 'px';
            indicator.style.width = r.width + 'px';
        }
        function switchTab(newKey){
            const currentBtn = document.querySelector('.tab-btn.active');
            const newBtn = btns.find(b=>b.dataset.tab===newKey);
            if(!newBtn) return;
            if(currentBtn===newBtn) return;
            btns.forEach(b=>b.classList.remove('active'));
            newBtn.classList.add('active');
            moveIndicator(newBtn);
            const activePanel = document.querySelector('.panel.active');
            const nextPanel = panels[newKey];
            if(activePanel){
                activePanel.classList.remove('fade-in');
                activePanel.classList.add('fade-out');
                setTimeout(()=>{
                    activePanel.classList.remove('active','fade-out');
                    nextPanel.classList.add('active','fade-in');
                },250);
            }else{
                nextPanel.classList.add('active','fade-in');
            }
        }
        btns.forEach(btn=>{
            btn.addEventListener('click',()=>{
                switchTab(btn.dataset.tab);
            });
        });
        window.addEventListener('load',()=>{
            const activeBtn = document.querySelector('.tab-btn.active');
            if(activeBtn) moveIndicator(activeBtn);
        });
        window.addEventListener('resize',()=>{
            const activeBtn = document.querySelector('.tab-btn.active');
            if(activeBtn) moveIndicator(activeBtn);
        });

        const statsObserver = new IntersectionObserver((entries)=>{
            entries.forEach(entry=>{
                if(entry.isIntersecting){
                    document.querySelectorAll('.stat-number').forEach(el=>{
                        const target = parseInt(el.dataset.target,10);
                        const suffix = el.dataset.suffix || '';
                        const dur = 1800;
                        const start = performance.now();
                        function tick(now){
                            const p = Math.min((now-start)/dur,1);
                            const val = Math.floor(target * p);
                            el.textContent = val.toLocaleString() + suffix;
                            if(p<1) requestAnimationFrame(tick);
                        }
                        requestAnimationFrame(tick);
                    });
                    statsObserver.disconnect();
                }
            });
        },{threshold:.25});
        statsObserver.observe(document.querySelector('.stats'));

        function addRipple(e){
            const el = e.currentTarget;
            el.classList.add('ripple-anim');
            setTimeout(()=>el.classList.remove('ripple-anim'),700);
        }
        document.querySelectorAll('.btn,.details-btn,.svc-cta,.cnsl-cta,.cta-btn').forEach(el=>{
            el.style.position='relative';
            el.style.overflow='hidden';
            el.addEventListener('click',addRipple);
        });

        function envSpawn(){
            const layer = document.getElementById('envLayer');
            for(let i=0;i<6;i++){
                const leaf = document.createElement('div');
                leaf.className='leaf';
                leaf.textContent='🍃';
                leaf.style.left=Math.random()*100+'vw';
                leaf.style.animationDuration=(6+Math.random()*6)+'s';
                layer.appendChild(leaf);
            }
            for(let i=0;i<6;i++){
                const b = document.createElement('div');
                b.className='bubble';
                b.style.left=Math.random()*100+'vw';
                b.style.bottom='0';
                b.style.animationDuration=(5+Math.random()*5)+'s';
                layer.appendChild(b);
            }
            for(let i=0;i<2;i++){
                const bird = document.createElement('div');
                bird.className='bird';
                bird.textContent='🕊️';
                bird.style.top=(10+Math.random()*30)+'vh';
                bird.style.left='-10vw';
                bird.style.animationDuration=(10+Math.random()*6)+'s';
                layer.appendChild(bird);
            }
        }
        window.addEventListener('load',envSpawn);

        function applyDummyData(){
            const isRtl = document.documentElement.getAttribute('dir') === 'rtl';
            const DATA = isRtl ? HOME_DATA_AR : HOME_DATA_EN;
            const ht = document.querySelector('.hero-title');
            const hs = document.querySelector('.hero-sub');
            const hBtns = Array.from(document.querySelectorAll('.hero-actions .btn'));
            if(ht) ht.textContent = DATA.hero.title;
            if(hs) hs.textContent = DATA.hero.subtitle;
            hBtns.forEach((b,i)=>{
                const item = DATA.hero.buttons[i];
                if(!item) return;
                b.textContent = item.text;
                if(item.color==='green') b.style.background = getComputedStyle(document.documentElement).getPropertyValue('--green');
                if(item.color==='blue') b.style.background = getComputedStyle(document.documentElement).getPropertyValue('--blue');
                if(item.color==='orange') b.style.background = getComputedStyle(document.documentElement).getPropertyValue('--orange');
            });
            const productCards = Array.from(document.querySelectorAll('#panel-products .card'));
            productCards.forEach((card,i)=>{
                const d = DATA.products[i];
                if(!d) return;
                const iconEl = card.querySelector('.icon');
                const titleEl = card.querySelector('.card-title');
                const descEl = card.querySelector('.card-text');
                const priceEl = card.querySelector('.price');
                if(iconEl) iconEl.textContent = d.icon;
                if(titleEl) titleEl.textContent = d.title;
                if(descEl) descEl.textContent = d.description;
                if(priceEl) priceEl.textContent = isRtl ? (d.price + ' د.ا') : (d.price + ' JOD');
            });
            const svcCards = Array.from(document.querySelectorAll('#panel-services .svc-card'));
            svcCards.forEach((card,i)=>{
                const d = DATA.services[i];
                if(!d) return;
                const iconEl = card.querySelector('.svc-icon');
                const titleEl = card.querySelector('.svc-title');
                const descEl = card.querySelector('.svc-desc');
                const bullets = Array.from(card.querySelectorAll('.bullets li'));
                const priceEl = card.querySelector('.svc-price');
                if(iconEl) iconEl.textContent = d.icon;
                if(titleEl) titleEl.textContent = d.title;
                if(descEl) descEl.textContent = d.description;
                bullets.forEach((li,idx)=>{ if(d.features && d.features[idx]) li.textContent = '✅ ' + d.features[idx]; });
                if(priceEl) priceEl.textContent = d.price;
            });
            const cnslCards = Array.from(document.querySelectorAll('#panel-consult .cnsl-card'));
            cnslCards.forEach((card,i)=>{
                const d = DATA.consultations[i];
                if(!d) return;
                const iconEl = card.querySelector('.cnsl-icon');
                const titleEl = card.querySelector('.cnsl-title');
                const descEl = card.querySelector('.cnsl-desc');
                const includes = Array.from(card.querySelectorAll('.includes li'));
                const meta = card.querySelector('.cnsl-left');
                const priceEl = card.querySelector('.cnsl-price');
                if(iconEl) iconEl.textContent = d.icon;
                if(titleEl) titleEl.textContent = d.title;
                if(descEl) descEl.textContent = d.description;
                includes.forEach((li,idx)=>{
                    if(d.includes && d.includes[idx]) li.textContent = li.textContent.replace(/^[^ ]+/, '').trim().replace(/^/, '') || d.includes[idx];
                    li.textContent = (li.textContent.match(/^[^ ]+/)?.[0] || '') + ' ' + (d.includes[idx] || '');
                });
                if(meta){
                    const durationSpan = meta.querySelector('span:first-child');
                    if(durationSpan) durationSpan.textContent = d.duration;
                }
                if(priceEl) priceEl.textContent = d.price;
            });
            const statBoxes = Array.from(document.querySelectorAll('.stats .stat'));
            statBoxes.forEach((box,i)=>{
                const d = DATA.statistics[i];
                if(!d) return;
                const iconEl = box.querySelector('.stat-icon');
                const numEl = box.querySelector('.stat-number');
                const labelEl = box.querySelector('.stat-sub');
                if(iconEl) iconEl.textContent = d.icon;
                if(labelEl) labelEl.textContent = d.label;
                if(numEl){
                    numEl.textContent = d.value;
                    const match = d.value.match(/^([\d,]+)(\+?)$/);
                    if(match){
                        const target = parseInt(match[1].replace(/,/g,''),10);
                        numEl.dataset.target = target;
                        numEl.dataset.suffix = match[2] || '';
                    }
                }
            });
        }
        window.addEventListener('load',applyDummyData);
    </script>
</body>
</html>
<?php /**PATH C:\Users\a3m20\OneDrive\Desktop\saqqia\resources\views/pages/home.blade.php ENDPATH**/ ?>