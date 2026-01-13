<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>" dir="<?php echo e(app()->getLocale() === 'ar' ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>تسجيل الدخول</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>
    <style>
        .input-icon{position:absolute;top:50%;transform:translateY(-50%);right:.75rem;font-size:1rem;opacity:.8}
        .toggle-pass{position:absolute;top:50%;transform:translateY(-50%);left:.75rem;font-size:.95rem;cursor:pointer}
        .btn-loading{position:relative}
        .btn-loading .spinner{position:absolute;inset-inline-start:.75rem;top:50%;transform:translateY(-50%);width:18px;height:18px;border:2px solid rgba(255,255,255,.6);border-top-color:#fff;border-radius:50%;animation:spin .8s linear infinite}
        @keyframes spin{to{transform:translateY(-50%) rotate(360deg)}}
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
        @keyframes spin{to{transform:translateY(-50%) rotate(360deg)}}
        @media (max-width:640px){
            .nav-links{display:none}
            .nav-links.open{display:flex}
            .menu-toggle{display:block}
        }
    </style>
</head>
<body class="min-h-screen bg-gray-50 text-gray-800">
    <header class="site-header">
        <div class="nav">
            <div class="brand flex items-center gap-2">
                <img src="<?php echo e(asset('images/logo.jpeg')); ?>" alt="SOQIA Innovative Environmental Solutions" class="h-5 w-auto rounded" style="height: 20px;">
                <div class="font-extrabold text-primary-green">SOQIA</div>
                <div class="text-xs text-gray-700">Innovative Environmental Solutions</div>
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
    <div class="grid grid-cols-1 md:grid-cols-2 min-h-screen">
        <div class="flex flex-col justify-center px-8 py-10 md:px-12">
            <div class="mb-8">
                <div class="text-3xl font-extrabold text-primary-green"><?php echo e(__('login.brand')); ?></div>
                <div class="mt-1 text-sm text-gray-600"><?php echo e(__('login.subtitle')); ?></div>
            </div>

            <div id="alert-success" class="<?php echo e(session('status') === 'logged_in' ? '' : 'hidden'); ?> mb-4 rounded-md border border-green-200 bg-green-50 px-4 py-3 text-green-800"><?php echo e(__('login.messages.login_success')); ?></div>
            <div id="alert-error" class="<?php echo e($errors->any() || session('error') ? '' : 'hidden'); ?> mb-4 rounded-md border border-red-200 bg-red-50 px-4 py-3 text-red-800"><?php echo e(session('error') ?? __('login.messages.login_error')); ?></div>

            <form id="loginForm" class="space-y-4" method="post" action="<?php echo e(route('login.submit')); ?>">
                <?php echo csrf_field(); ?>
                <div class="relative">
                    <span class="input-icon">✉️</span>
                    <input id="email" name="email" value="<?php echo e(old('email')); ?>" type="email" placeholder="<?php echo e(__('login.form.email')); ?>" class="w-full rounded-lg border border-gray-300 bg-white pr-9 py-3 focus:border-primary-green focus:ring-2 focus:ring-primary-green/20 transition" autocomplete="username" required>
                    <div id="emailError" class="mt-1 text-xs text-red-600 hidden"><?php echo e(__('login.errors.email_invalid')); ?></div>
                </div>
                <div class="relative">
                    <span class="input-icon">🔒</span>
                    <span id="togglePassword" class="toggle-pass text-gray-600 select-none">👁️</span>
                    <input id="password" name="password" type="password" placeholder="<?php echo e(__('login.form.password')); ?>" class="w-full rounded-lg border border-gray-300 bg-white pr-9 pl-9 py-3 focus:border-primary-green focus:ring-2 focus:ring-primary-green/20 transition" autocomplete="current-password" minlength="6" required>
                    <div id="passwordError" class="mt-1 text-xs text-red-600 hidden"><?php echo e(__('login.errors.password_short')); ?></div>
                </div>
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input id="remember" name="remember" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-primary-green focus:ring-primary-green">
                        <span><?php echo e(__('login.form.remember')); ?></span>
                    </label>
                    <a href="#" class="text-sm text-primary-blue hover:underline"><?php echo e(__('login.form.forgot')); ?></a>
                </div>
                <button id="submitBtn" type="submit" class="btn-loading w-full rounded-lg bg-primary-green text-white py-3 font-semibold hover:bg-dark-green transition disabled:opacity-70 disabled:cursor-not-allowed">
                    <span class="spinner hidden"></span>
                    <?php echo e(__('login.form.submit')); ?>

                </button>
                <div class="flex items-center justify-between text-sm">
                    <a href="#" class="text-primary-blue hover:underline"><?php echo e(__('login.form.new_account')); ?></a>
                    <a href="<?php echo e(url('/')); ?>" class="text-primary-orange hover:underline"><?php echo e(__('login.form.back_home')); ?></a>
                </div>
            </form>
        </div>

        <div class="hidden md:block relative login-media">
            <div class="absolute inset-0 bg-gradient-to-tr from-primary-green/40 to-primary-blue/40"></div>
            <img src="<?php echo e(asset('images/farm1.jpg')); ?>" alt="login background" class="object-cover">
        </div>
    </div>

    <script>
        document.getElementById('menuToggle')?.addEventListener('click', function(){
            document.getElementById('navLinks')?.classList.toggle('open');
        });
        const email = document.getElementById('email');
        const password = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const emailError = document.getElementById('emailError');
        const passwordError = document.getElementById('passwordError');

        const T = {
            success: "<?php echo e(__('login.messages.login_success')); ?>",
            error: "<?php echo e(__('login.messages.login_error')); ?>",
            fix: "<?php echo e(__('login.errors.fix_fields')); ?>"
        };

        function isValidEmail(v){
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
        }
        function validateFields(){
            let ok = true;
            emailError.classList.add('hidden');
            passwordError.classList.add('hidden');
            if(!email.value || !isValidEmail(email.value)){
                emailError.classList.remove('hidden');
                ok = false;
            }
            if(!password.value || password.value.length < 6){
                passwordError.classList.remove('hidden');
                ok = false;
            }
            return ok;
        }
        togglePassword.addEventListener('click', () => {
            password.type = password.type === 'password' ? 'text' : 'password';
            togglePassword.textContent = password.type === 'password' ? '👁️' : '🙈';
        });
        email.addEventListener('input', () => { if(emailError) emailError.classList.add('hidden'); });
        password.addEventListener('input', () => { if(passwordError) passwordError.classList.add('hidden'); });
    </script>
    <footer class="bg-gray-100">
        <div class="max-w-6xl mx-auto px-5 py-6 flex items-center justify-between gap-3 flex-wrap">
            <div class="flex items-center gap-2">
                <img src="<?php echo e(asset('images/logo.jpeg')); ?>" alt="SOQIA Innovative Environmental Solutions" class="h-4 w-auto rounded" style="height: 16px;">
                <div class="font-extrabold text-primary-green">SOQIA</div>
            </div>
            <div class="flex gap-3">
                <a href="<?php echo e(url('/')); ?>" class="text-gray-700"><?php echo e(__('home.nav.home')); ?></a>
                <a href="<?php echo e(url('/awareness-content')); ?>" class="text-gray-700"><?php echo e(__('home.nav.awareness')); ?></a>
                <a href="<?php echo e(url('/login')); ?>" class="text-gray-700"><?php echo e(__('home.nav.login')); ?></a>
                <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(url('/dashboard')); ?>" class="text-gray-700"><?php echo e(__('home.nav.dashboard')); ?></a>
                <?php endif; ?>
            </div>
            <div class="text-xs text-gray-500">© <?php echo e(date('Y')); ?> Saqqia</div>
        </div>
    </footer>
</body>
</html>
<?php /**PATH C:\Users\a3m20\OneDrive\Desktop\saqqia\resources\views/auth/login.blade.php ENDPATH**/ ?>