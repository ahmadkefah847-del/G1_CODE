<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo e(__('dashboard.page_title')); ?></title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <style>
        .animate-in{animation:fadeUp .35s ease both}
        @keyframes fadeUp{from{opacity:0;transform:translateY(10px)}to{opacity:1;transform:translateY(0)}}
        .badge{display:inline-block;padding:.25rem .5rem;border-radius:.5rem;font-size:.75rem}
        .site-header{position:sticky;top:0;background:#fff;border-bottom:1px solid #e6e6e6;z-index:50}
        .nav{max-width:1100px;margin:0 auto;padding:10px 20px;display:flex;align-items:center;justify-content:space-between}
        .brand{font-weight:900;color:#228B22;font-size:18px}
        .nav-links{display:flex;gap:10px;flex-wrap:wrap}
        .nav-link{padding:8px 12px;border-radius:10px;background:#f3f6f4;color:#1e2a1e;font-weight:700;border:1px solid transparent;transition:all .18s ease;text-decoration:none}
        .nav-link:hover{background:#e9f3ea}
        .lang-switch{display:flex;gap:6px;align-items:center}
        .lang{padding:6px 10px;border-radius:10px;background:#f3f6f4;color:#1e2a1e;font-weight:700;border:1px solid transparent;text-decoration:none;transition:all .18s ease}
        .lang.active{background:#e2f5e4;border-color:#cbe8cd;color:#0f4c0f;box-shadow:inset 0 -3px 0 #228B22}
        .menu-toggle{display:none;padding:8px 12px;border-radius:10px;background:#f3f6f4;border:1px solid #e6e6e6;cursor:pointer}
        @media (max-width:640px){
            .nav-links{display:none}
            .nav-links.open{display:flex}
            .menu-toggle{display:block}
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">
    <header class="site-header">
        <div class="nav">
            <div class="brand">SAQQIA</div>
            <button class="menu-toggle" id="menuToggle">☰</button>
            <div class="nav-links" id="navLinks">
                <a class="nav-link <?php echo e(request()->is('/') ? 'active' : ''); ?>" href="<?php echo e(url('/')); ?>"><?php echo e(__('home.nav.home')); ?></a>
                <a class="nav-link <?php echo e(request()->is('awareness-content') ? 'active' : ''); ?>" href="<?php echo e(url('/awareness-content')); ?>"><?php echo e(__('home.nav.awareness')); ?></a>
                <a class="nav-link <?php echo e(request()->is('login') ? 'active' : ''); ?>" href="<?php echo e(url('/login')); ?>"><?php echo e(__('home.nav.login')); ?></a>
                <a class="nav-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>" href="<?php echo e(url('/dashboard')); ?>"><?php echo e(__('home.nav.dashboard')); ?></a>
                <a class="nav-link <?php echo e(request()->is('admin/manage-content') ? 'active' : ''); ?>" href="<?php echo e(url('/admin/manage-content')); ?>"><?php echo e(__('home.nav.admin')); ?></a>
                <div class="lang-switch">
                    <a class="lang <?php echo e(app()->getLocale() === 'en' ? 'active' : ''); ?>" href="<?php echo e(url()->current()); ?>?lang=en">EN</a>
                    <a class="lang <?php echo e(app()->getLocale() === 'ar' ? 'active' : ''); ?>" href="<?php echo e(url()->current()); ?>?lang=ar">AR</a>
                </div>
            </div>
        </div>
    </header>
    <div class="max-w-7xl mx-auto px-5 py-8">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-primary-green"><?php echo e(__('dashboard.greeting')); ?> <span id="userName">أحمد علي</span> 👋</h1>
                <div class="mt-1 text-sm text-gray-600"><?php echo e(__('dashboard.today')); ?>: <span id="dateNow"></span></div>
            </div>
            <div class="flex items-center gap-3">
                <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-100 transition"><span>⚙️</span><span><?php echo e(__('dashboard.actions.settings')); ?></span></a>
                <a href="#" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-red-500 text-white hover:bg-red-600 transition"><span>⎋</span><span><?php echo e(__('dashboard.actions.logout')); ?></span></a>
            </div>
        </div>

        <div class="mt-8 grid grid-cols-1 md:grid-cols-12 gap-6">
            <aside class="md:col-span-3">
                <div class="bg-white border border-gray-200 rounded-xl p-4 animate-in">
                    <div class="text-lg font-semibold text-primary-green"><?php echo e(__('dashboard.aside.title')); ?></div>
                    <nav class="mt-3 space-y-2">
                        <a href="#" class="block rounded-lg px-3 py-2 bg-primary-green/10 text-primary-green"><?php echo e(__('dashboard.aside.dashboard')); ?></a>
                        <a href="<?php echo e(url('/awareness-content')); ?>" class="block rounded-lg px-3 py-2 hover:bg-gray-100 transition"><?php echo e(__('dashboard.aside.awareness')); ?></a>
                        <a href="#" class="block rounded-lg px-3 py-2 hover:bg-gray-100 transition"><?php echo e(__('dashboard.aside.my_consults')); ?></a>
                        <a href="#" class="block rounded-lg px-3 py-2 hover:bg-gray-100 transition"><?php echo e(__('dashboard.aside.saved')); ?></a>
                        <a href="#" class="block rounded-lg px-3 py-2 hover:bg-gray-100 transition"><?php echo e(__('dashboard.aside.settings')); ?></a>
                    </nav>
                </div>
            </aside>

            <main class="md:col-span-9">
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                    <div class="bg-white border border-gray-200 rounded-xl p-4 hover:shadow-md transition animate-in">
                        <div class="flex items-center justify-between">
                            <div class="text-2xl">📖</div>
                            <div class="badge bg-primary-blue/10 text-primary-blue"><?php echo e(__('dashboard.stats_cards.content')); ?></div>
                        </div>
                        <div class="mt-3 text-sm text-gray-500"><?php echo e(__('dashboard.stats_cards.viewed')); ?></div>
                        <div id="statViewed" class="mt-1 text-2xl font-extrabold text-gray-900">15</div>
                        <div class="mt-1 text-xs text-gray-500"><?php echo e(__('dashboard.stats_cards.last_update')); ?></div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-4 hover:shadow-md transition animate-in">
                        <div class="flex items-center justify-between">
                            <div class="text-2xl">❤️</div>
                            <div class="badge bg-pink-100 text-pink-600"><?php echo e(__('dashboard.stats_cards.favorite')); ?></div>
                        </div>
                        <div class="mt-3 text-sm text-gray-500"><?php echo e(__('dashboard.stats_cards.saved')); ?></div>
                        <div id="statSaved" class="mt-1 text-2xl font-extrabold text-gray-900">8</div>
                        <div class="mt-1 text-xs text-gray-500"><?php echo e(__('dashboard.stats_cards.last_update')); ?></div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-4 hover:shadow-md transition animate-in">
                        <div class="flex items-center justify-between">
                            <div class="text-2xl">📋</div>
                            <div class="badge bg-green-100 text-green-700"><?php echo e(__('dashboard.stats_cards.consultations')); ?></div>
                        </div>
                        <div class="mt-3 text-sm text-gray-500"><?php echo e(__('dashboard.stats_cards.active')); ?></div>
                        <div id="statActiveConsult" class="mt-1 text-2xl font-extrabold text-gray-900">2</div>
                        <div class="mt-1 text-xs text-gray-500"><?php echo e(__('dashboard.stats_cards.last_update')); ?></div>
                    </div>
                    <div class="bg-white border border-gray-200 rounded-xl p-4 hover:shadow-md transition animate-in">
                        <div class="flex items-center justify-between">
                            <div class="text-2xl">🏆</div>
                            <div class="badge bg-yellow-100 text-yellow-700"><?php echo e(__('dashboard.stats_cards.achievements')); ?></div>
                        </div>
                        <div class="mt-3 text-sm text-gray-500"><?php echo e(__('dashboard.stats_cards.achievements')); ?></div>
                        <div id="statAchievements" class="mt-1 text-2xl font-extrabold text-gray-900">5</div>
                        <div class="mt-1 text-xs text-gray-500"><?php echo e(__('dashboard.stats_cards.achievements_label')); ?></div>
                    </div>
                </div>

                <div class="mt-6 bg-white border border-gray-200 rounded-xl p-4 animate-in">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800"><?php echo e(__('dashboard.chart.title')); ?></h2>
                    </div>
                    <div class="mt-3">
                        <canvas id="activityChart" height="120"></canvas>
                    </div>
                </div>

                <div class="mt-6 bg-white border border-gray-200 rounded-xl p-4 animate-in">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800"><?php echo e(__('dashboard.active_consults.title')); ?></h2>
                    </div>
                    <div class="mt-3 overflow-x-auto">
                        <table class="min-w-full text-sm">
                            <thead>
                                <tr class="text-gray-600">
                                    <th class="px-3 py-2 text-right"><?php echo e(__('dashboard.active_consults.table.name')); ?></th>
                                    <th class="px-3 py-2 text-right"><?php echo e(__('dashboard.active_consults.table.date')); ?></th>
                                    <th class="px-3 py-2 text-right"><?php echo e(__('dashboard.active_consults.table.status')); ?></th>
                                    <th class="px-3 py-2 text-right"><?php echo e(__('dashboard.active_consults.table.action')); ?></th>
                                </tr>
                            </thead>
                            <tbody id="consultationsTable">
                                <tr class="border-t">
                                    <td class="px-3 py-2"><?php echo e(app()->getLocale() === 'en' ? 'Feasibility study for a tomato farm' : 'دراسة جدوى لمزرعة الطماطم'); ?></td>
                                    <td class="px-3 py-2">2024-01-15</td>
                                    <td class="px-3 py-2"><span class="badge bg-yellow-100 text-yellow-700"><?php echo e(__('dashboard.active_consults.status_pending')); ?></span></td>
                                    <td class="px-3 py-2"><a href="#" class="text-primary-blue hover:underline"><?php echo e(__('dashboard.active_consults.view')); ?></a></td>
                                </tr>
                                <tr class="border-t">
                                    <td class="px-3 py-2"><?php echo e(app()->getLocale() === 'en' ? 'Drip irrigation system consultation' : 'استشارة نظام الري بالتنقيط'); ?></td>
                                    <td class="px-3 py-2">2024-01-10</td>
                                    <td class="px-3 py-2"><span class="badge bg-blue-100 text-blue-700"><?php echo e(__('dashboard.active_consults.status_in_progress')); ?></span></td>
                                    <td class="px-3 py-2"><a href="#" class="text-primary-blue hover:underline"><?php echo e(__('dashboard.active_consults.view')); ?></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6 bg-white border border-gray-200 rounded-xl p-4 animate-in">
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800"><?php echo e(__('dashboard.saved_section.title')); ?></h2>
                        <a href="#" class="text-primary-orange hover:underline"><?php echo e(__('dashboard.saved_section.view_all')); ?></a>
                    </div>
                        <div class="mt-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <div class="text-sm text-gray-900 font-semibold"><?php echo e(app()->getLocale() === 'en' ? '10 Tips to Save Water' : '10 نصائح لتوفير المياه'); ?></div>
                            <div class="mt-1 text-xs text-gray-500">2024-01-12</div>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <div class="text-sm text-gray-900 font-semibold"><?php echo e(app()->getLocale() === 'en' ? 'Smart Irrigation System Explained' : 'شرح نظام الري الذكي'); ?></div>
                            <div class="mt-1 text-xs text-gray-500">2024-01-11</div>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition">
                            <div class="text-sm text-gray-900 font-semibold"><?php echo e(app()->getLocale() === 'en' ? 'Irrigation Systems Maintenance Guide' : 'دليل صيانة أنظمة الري'); ?></div>
                            <div class="mt-1 text-xs text-gray-500">2024-01-10</div>
                            </div>
                        </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.getElementById('menuToggle')?.addEventListener('click', function(){
            document.getElementById('navLinks')?.classList.toggle('open');
        });
        const LOCALE = "<?php echo e(app()->getLocale()); ?>";
        const USER_PROFILE = {name:'أحمد علي',email:'ahmed@saqqia.jo',phone:'+962791234567',joined_date:'2024-01-01'};
        const STATS = {viewed_content:15,saved_content:8,active_consultations:2,achievements:5};
        const CONSULTATIONS = [
            {id:1,title:'دراسة جدوى لمزرعة الطماطم',date:'2024-01-15',status:'pending'},
            {id:2,title:'استشارة نظام الري بالتنقيط',date:'2024-01-10',status:'in_progress'}
        ];
        const SAVED_CONTENT = [
            {id:1,title:'10 نصائح لتوفير المياه',saved_date:'2024-01-12'},
            {id:2,title:'شرح نظام الري الذكي',saved_date:'2024-01-11'},
            {id:3,title:'دليل صيانة أنظمة الري',saved_date:'2024-01-10'}
        ];
        document.getElementById('userName').textContent = USER_PROFILE.name;
        document.getElementById('dateNow').textContent = new Date().toLocaleString(LOCALE==='ar'?'ar-JO':'en-US', {dateStyle:'full', timeStyle:'short'});
        document.getElementById('statViewed').textContent = STATS.viewed_content;
        document.getElementById('statSaved').textContent = STATS.saved_content;
        document.getElementById('statActiveConsult').textContent = STATS.active_consultations;
        document.getElementById('statAchievements').textContent = STATS.achievements;
        const ctx = document.getElementById('activityChart').getContext('2d');
        const DAYS = LOCALE==='ar' ? ['أحد','اثنين','ثلاثاء','أربعاء','خميس','جمعة','سبت'] : ['Sun','Mon','Tue','Wed','Thu','Fri','Sat'];
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: DAYS,
                datasets: [{
                    data: [2,3,4,3,2,1,0],
                    backgroundColor: '#0066CC',
                    borderRadius: 6,
                }]
            },
            options: {
                plugins: {legend: {display: false}},
                scales: {
                    x: {grid: {display:false}},
                    y: {grid: {color:'#eee'}, ticks: {stepSize:1, precision:0}}
                }
            }
        });
    </script>
    <footer class="bg-gray-100 mt-8">
        <div class="max-w-6xl mx-auto px-5 py-6 flex items-center justify-between gap-3 flex-wrap">
            <div class="font-extrabold text-primary-green">SAQQIA</div>
            <div class="flex gap-3">
                <a href="<?php echo e(url('/')); ?>" class="text-gray-700"><?php echo e(__('home.nav.home')); ?></a>
                <a href="<?php echo e(url('/awareness-content')); ?>" class="text-gray-700"><?php echo e(__('home.nav.awareness')); ?></a>
                <a href="<?php echo e(url('/login')); ?>" class="text-gray-700"><?php echo e(__('home.nav.login')); ?></a>
                <a href="<?php echo e(url('/dashboard')); ?>" class="text-gray-700"><?php echo e(__('home.nav.dashboard')); ?></a>
                <a href="<?php echo e(url('/admin/manage-content')); ?>" class="text-gray-700"><?php echo e(__('home.nav.admin')); ?></a>
            </div>
            <div class="text-xs text-gray-500">© <?php echo e(date('Y')); ?> Saqqia</div>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\Users\a3m20\CascadeProjects\saqqia\resources\views/dashboard/user-dashboard.blade.php ENDPATH**/ ?>