<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>إدارة المحتوى التوعوي</title>
    @vite('resources/css/app.css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        .animate-in{animation:fadeUp .25s ease both}
        @keyframes fadeUp{from{opacity:0;transform:translateY(6px)}to{opacity:1;transform:translateY(0)}}
        .overlay{position:fixed;inset:0;background:rgba(0,0,0,.35);display:none;align-items:center;justify-content:center;z-index:50}
        .modal{background:#fff;border-radius:12px;max-width:680px;width:95%;box-shadow:0 10px 30px rgba(0,0,0,.15)}
        .toast{position:fixed;top:1rem;inset-inline-end:1rem;z-index:60;display:none}
        .dropzone{border:2px dashed #cbd5e1;border-radius:10px;padding:16px;text-align:center}
        .dropzone.drag{border-color:#228B22;background:#effaf0}
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
            <div class="brand flex items-center gap-2">
                <img src="{{ asset('images/logo.jpeg') }}" alt="SOQIA Innovative Environmental Solutions" class="h-7 w-auto rounded">
                <div class="font-extrabold text-primary-green">SOQIA</div>
                <div class="text-xs text-gray-700">Innovative Environmental Solutions</div>
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
    <div class="max-w-7xl mx-auto px-5 py-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h1 class="text-2xl sm:text-3xl font-bold text-primary-green">إدارة المحتوى التوعوي</h1>
                <p class="mt-1 text-gray-600">أضف، عدّل، احذف المحتوى بسهولة</p>
            </div>
            <div class="flex gap-2">
                <input id="searchInput" type="text" placeholder="بحث في العناوين..." class="w-64 rounded-lg border border-gray-300 px-3 py-2 focus:border-primary-green focus:ring-2 focus:ring-primary-green/20 transition">
                <button id="openCreate" class="rounded-lg bg-primary-green text-white px-4 py-2 font-semibold hover:bg-dark-green transition">✚ إضافة محتوى جديد</button>
            </div>
        </div>

        <div class="mt-6 bg-white border border-gray-200 rounded-xl p-4 animate-in">
            <div class="overflow-x-auto">
                <table class="min-w-full text-sm">
                    <thead>
                        <tr class="text-gray-700">
                            <th class="px-3 py-2 text-right">#</th>
                            <th class="px-3 py-2 text-right cursor-pointer" data-sort="title">العنوان</th>
                            <th class="px-3 py-2 text-right">النوع</th>
                            <th class="px-3 py-2 text-right cursor-pointer" data-sort="date">تاريخ الإنشاء</th>
                            <th class="px-3 py-2 text-right">الحالة</th>
                            <th class="px-3 py-2 text-right">الإجراءات</th>
                        </tr>
                    </thead>
                    <tbody id="contentBody">
                    </tbody>
                </table>
            </div>
            <div class="mt-4 flex items-center justify-between">
                <div id="rangeText" class="text-xs text-gray-600"></div>
                <div class="flex items-center gap-2">
                    <button id="prevPage" class="rounded-md border px-3 py-1 text-gray-700 hover:bg-gray-100 transition">السابق</button>
                    <div id="pageInfo" class="text-sm"></div>
                    <button id="nextPage" class="rounded-md border px-3 py-1 text-gray-700 hover:bg-gray-100 transition">التالي</button>
                </div>
            </div>
        </div>
    </div>

    <div id="toast" class="toast">
        <div id="toastBox" class="rounded-md bg-green-600 text-white px-4 py-2 shadow-md"></div>
    </div>

    <div id="overlayForm" class="overlay">
        <div class="modal w-full max-w-2xl">
            <div class="p-5 border-b">
                <div id="formTitle" class="text-lg font-semibold text-gray-800">إضافة محتوى جديد</div>
            </div>
            <form id="contentForm" class="p-5 space-y-3">
                @csrf
                <div>
                    <input id="fTitle" type="text" placeholder="العنوان" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-primary-green focus:ring-2 focus:ring-primary-green/20 transition">
                    <div id="eTitle" class="mt-1 text-xs text-red-600 hidden">يرجى إدخال العنوان</div>
                </div>
                <div>
                    <select id="fType" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-primary-green focus:ring-2 focus:ring-primary-green/20 transition">
                        <option value="">اختر النوع</option>
                        <option value="tips">نصائح</option>
                        <option value="video">فيديو</option>
                        <option value="infographic">إنفوجرافيك</option>
                    </select>
                    <div id="eType" class="mt-1 text-xs text-red-600 hidden">يرجى اختيار النوع</div>
                </div>
                <div>
                    <textarea id="fDesc" rows="3" placeholder="الوصف" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-primary-green focus:ring-2 focus:ring-primary-green/20 transition"></textarea>
                    <div id="eDesc" class="mt-1 text-xs text-red-600 hidden">يرجى إدخال الوصف</div>
                </div>
                <div>
                    <div id="dropzone" class="dropzone">اسحب وأفلت الصورة هنا أو اختر ملفاً</div>
                    <input id="fImage" type="file" accept="image/*" class="mt-2">
                    <div id="imageName" class="mt-1 text-xs text-gray-600"></div>
                </div>
                <div id="videoRow" class="hidden">
                    <input id="fVideo" type="url" placeholder="رابط الفيديو" class="w-full rounded-lg border border-gray-300 px-3 py-2 focus:border-primary-green focus:ring-2 focus:ring-primary-green/20 transition">
                    <div id="eVideo" class="mt-1 text-xs text-red-600 hidden">يرجى إدخال رابط فيديو صالح</div>
                </div>
                <div class="flex items-center gap-4">
                    <label class="flex items-center gap-2">
                        <input type="radio" name="status" value="draft" class="h-4 w-4 text-primary-green" checked>
                        <span>مسودة</span>
                    </label>
                    <label class="flex items-center gap-2">
                        <input type="radio" name="status" value="published" class="h-4 w-4 text-primary-green">
                        <span>منشور</span>
                    </label>
                </div>
                <div class="flex items-center justify-end gap-2">
                    <button type="button" id="cancelForm" class="rounded-lg border px-4 py-2 hover:bg-gray-100 transition">إلغاء</button>
                    <button type="submit" id="saveForm" class="rounded-lg bg-primary-green text-white px-4 py-2 font-semibold hover:bg-dark-green transition">حفظ</button>
                </div>
            </form>
        </div>
    </div>

    <div id="overlayDelete" class="overlay">
        <div class="modal w-full max-w-md">
            <div class="p-5">
                <div class="text-lg font-semibold text-gray-800">هل أنت متأكد من حذف هذا المحتوى؟</div>
                <div class="mt-2 text-sm text-gray-600">لا يمكن التراجع بعد الحذف.</div>
                <div class="mt-4 flex items-center justify-end gap-2">
                    <button id="cancelDelete" class="rounded-lg border px-4 py-2 hover:bg-gray-100 transition">إلغاء</button>
                    <button id="confirmDelete" class="rounded-lg bg-red-600 text-white px-4 py-2 font-semibold hover:bg-red-700 transition">حذف نهائياً</button>
                </div>
            </div>
        </div>
    </div>

    <div id="overlayPreview" class="overlay">
        <div class="modal w-full max-w-md">
            <div class="p-5">
                <div id="previewTitle" class="text-lg font-semibold text-gray-800"></div>
                <div id="previewMeta" class="mt-1 text-sm text-gray-600"></div>
                <div id="previewDesc" class="mt-3 text-sm text-gray-700"></div>
                <div class="mt-4 flex items-center justify-end">
                    <button id="closePreview" class="rounded-lg border px-4 py-2 hover:bg-gray-100 transition">إغلاق</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const DATA = [
            {id:1,title:'أفضل أوقات الري في الصيف',type:'tips',date:'2024-01-15',status:'published',author:'أحمد حسن'},
            {id:2,title:'شرح نظام الري بالتنقيط',type:'video',date:'2024-01-14',status:'published',author:'فاطمة علي'},
            {id:3,title:'إحصائيات توفير المياه',type:'infographic',date:'2024-01-13',status:'draft',author:'محمود خالد'},
            {id:4,title:'طرق الكشف عن تسرب المياه',type:'tips',date:'2024-01-12',status:'published',author:'سارة محمد'}
        ];
        let items = [];
        let sortKey = 'date';
        let sortDir = 'desc';
        let page = 1;
        const pageSize = 10;
        let currentId = null;
        let formMode = 'add';
        let uploadedImage = null;

        const bodyEl = document.getElementById('contentBody');
        const pageInfo = document.getElementById('pageInfo');
        const rangeText = document.getElementById('rangeText');
        const prevPage = document.getElementById('prevPage');
        const nextPage = document.getElementById('nextPage');
        const searchInput = document.getElementById('searchInput');
        const toast = document.getElementById('toast');
        const toastBox = document.getElementById('toastBox');

        const overlayForm = document.getElementById('overlayForm');
        const formTitle = document.getElementById('formTitle');
        const contentForm = document.getElementById('contentForm');
        const fTitle = document.getElementById('fTitle');
        const fType = document.getElementById('fType');
        const fDesc = document.getElementById('fDesc');
        const fImage = document.getElementById('fImage');
        const imageName = document.getElementById('imageName');
        const eTitle = document.getElementById('eTitle');
        const eType = document.getElementById('eType');
        const eDesc = document.getElementById('eDesc');
        const videoRow = document.getElementById('videoRow');
        const fVideo = document.getElementById('fVideo');
        const eVideo = document.getElementById('eVideo');
        const cancelForm = document.getElementById('cancelForm');
        const saveForm = document.getElementById('saveForm');
        const dropzone = document.getElementById('dropzone');
        const openCreate = document.getElementById('openCreate');

        const overlayDelete = document.getElementById('overlayDelete');
        const cancelDelete = document.getElementById('cancelDelete');
        const confirmDelete = document.getElementById('confirmDelete');

        const overlayPreview = document.getElementById('overlayPreview');
        const previewTitle = document.getElementById('previewTitle');
        const previewMeta = document.getElementById('previewMeta');
        const previewDesc = document.getElementById('previewDesc');
        const closePreview = document.getElementById('closePreview');

        function showToast(msg, ok=true){
            toastBox.textContent = msg;
            toastBox.className = ok ? 'rounded-md bg-green-600 text-white px-4 py-2 shadow-md' : 'rounded-md bg-red-600 text-white px-4 py-2 shadow-md';
            toast.style.display = 'block';
            setTimeout(()=>{toast.style.display='none'},2000);
        }
        function typeLabel(t){return t==='tips'?'نصائح':t==='video'?'فيديو':'إنفوجرافيك'}
        function statusBadge(s){
            if(s==='published') return '<span class="badge bg-green-100 text-green-700">منشور</span>';
            return '<span class="badge bg-gray-100 text-gray-700">مسودة</span>';
        }
        function compare(a,b){
            let va = a[sortKey], vb = b[sortKey];
            if(sortKey==='date'){va = new Date(a.date); vb = new Date(b.date);}
            if(va<vb) return sortDir==='asc'?-1:1;
            if(va>vb) return sortDir==='asc'?1:-1;
            return 0;
        }
        function filtered(){
            const q = (searchInput.value||'').trim();
            if(!q) return items.slice().sort(compare);
            return items.filter(i => i.title.includes(q)).sort(compare);
        }
        async function loadData(){
            const res = await fetch('{{ route('admin.content.index') }}', { headers: { 'Accept': 'application/json' }});
            const json = await res.json();
            items = json.data || [];
            page = 1;
            render();
        }
        function render(){
            const list = filtered();
            const total = list.length;
            const pages = Math.max(1, Math.ceil(total / pageSize));
            if(page>pages) page = pages;
            const start = (page-1)*pageSize;
            const slice = list.slice(start, start+pageSize);
            bodyEl.innerHTML = slice.map((i, idx) => `
                <tr class="odd:bg-white even:bg-gray-50 hover:bg-gray-100">
                    <td class="px-3 py-2">${start+idx+1}</td>
                    <td class="px-3 py-2">${i.title}</td>
                    <td class="px-3 py-2">${typeLabel(i.type)}</td>
                    <td class="px-3 py-2">${i.date}</td>
                    <td class="px-3 py-2">${statusBadge(i.status)}</td>
                    <td class="px-3 py-2">
                        <button data-id="${i.id}" class="mx-1 text-blue-600 hover:underline" data-action="edit">✏️ تعديل</button>
                        <button data-id="${i.id}" class="mx-1 text-red-600 hover:underline" data-action="delete">🗑️ حذف</button>
                        <button data-id="${i.id}" class="mx-1 text-gray-700 hover:underline" data-action="view">👁️ عرض</button>
                    </td>
                </tr>
            `).join('');
            rangeText.textContent = `عرض ${total?start+1:0}–${Math.min(start+slice.length,total)} من ${total}`;
            pageInfo.textContent = `صفحة ${page} / ${pages}`;
            prevPage.disabled = page<=1;
            nextPage.disabled = page>=pages;
        }
        function openForm(mode, id=null){
            formMode = mode;
            currentId = id;
            eTitle.classList.add('hidden');
            eType.classList.add('hidden');
            eDesc.classList.add('hidden');
            eVideo.classList.add('hidden');
            fTitle.value = '';
            fType.value = '';
            fDesc.value = '';
            fVideo.value = '';
            uploadedImage = null;
            imageName.textContent = '';
            if(mode==='edit' && id){
                const it = items.find(x => x.id === id);
                if(it){
                    formTitle.textContent = 'تعديل المحتوى';
                    fTitle.value = it.title;
                    fType.value = it.type;
                    fDesc.value = it.desc || '';
                    fVideo.value = it.video || '';
                    videoRow.classList.toggle('hidden', it.type!=='video');
                }
            } else {
                formTitle.textContent = 'إضافة محتوى جديد';
                videoRow.classList.add('hidden');
            }
            overlayForm.style.display = 'flex';
        }
        function closeForm(){overlayForm.style.display='none'}
        function openDelete(id){currentId=id; overlayDelete.style.display='flex'}
        function closeDelete(){overlayDelete.style.display='none'}
        function openPreview(id){
            const it = items.find(x => x.id===id);
            if(!it) return;
            previewTitle.textContent = it.title;
            previewMeta.textContent = `${typeLabel(it.type)} • ${it.date} • ${it.author} • ${it.status==='published'?'منشور':'مسودة'}`;
            previewDesc.textContent = it.desc ? it.desc : 'لا يوجد وصف';
            overlayPreview.style.display = 'flex';
        }
        function closePrev(){overlayPreview.style.display='none'}

        document.querySelectorAll('th[data-sort]').forEach(h => {
            h.addEventListener('click', () => {
                const key = h.getAttribute('data-sort');
                if(sortKey===key){sortDir = sortDir==='asc'?'desc':'asc'} else {sortKey=key; sortDir='asc'}
                render();
            });
        });
        prevPage.addEventListener('click', () => { if(page>1){page--; render()} });
        nextPage.addEventListener('click', () => { page++; render() });
        searchInput.addEventListener('input', () => { page=1; render() });

        bodyEl.addEventListener('click', (e) => {
            const btn = e.target.closest('button[data-action]');
            if(!btn) return;
            const id = Number(btn.getAttribute('data-id'));
            const act = btn.getAttribute('data-action');
            if(act==='edit') openForm('edit', id);
            else if(act==='delete') openDelete(id);
            else if(act==='view') openPreview(id);
        });

        openCreate.addEventListener('click', () => openForm('add'));
        cancelForm.addEventListener('click', closeForm);
        cancelDelete.addEventListener('click', closeDelete);
        confirmDelete.addEventListener('click', async () => {
            if(currentId!=null){
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                await fetch('{{ url('/admin/content') }}/'+currentId, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': token, 'Accept': 'application/json' }
                });
                showToast('تم حذف المحتوى بنجاح', true);
                await loadData();
            }
            closeDelete();
        });
        closePreview.addEventListener('click', closePrev);

        fType.addEventListener('change', () => {
            videoRow.classList.toggle('hidden', fType.value!=='video');
        });
        fImage.addEventListener('change', () => {
            uploadedImage = fImage.files[0] || null;
            imageName.textContent = uploadedImage ? uploadedImage.name : '';
        });
        dropzone.addEventListener('dragover', (e) => {e.preventDefault(); dropzone.classList.add('drag')});
        dropzone.addEventListener('dragleave', () => {dropzone.classList.remove('drag')});
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('drag');
            const file = e.dataTransfer.files[0];
            if(file){uploadedImage=file; imageName.textContent = file.name;}
        });

        contentForm.addEventListener('submit', async (e) => {
            e.preventDefault();
            eTitle.classList.add('hidden');
            eType.classList.add('hidden');
            eDesc.classList.add('hidden');
            eVideo.classList.add('hidden');
            let ok = true;
            if(!fTitle.value.trim()){eTitle.classList.remove('hidden'); ok=false}
            if(!fType.value){eType.classList.remove('hidden'); ok=false}
            if(!fDesc.value.trim()){eDesc.classList.remove('hidden'); ok=false}
            if(fType.value==='video'){
                const url = fVideo.value.trim();
                const valid = url && /^https?:\/\/.+/.test(url);
                if(!valid){eVideo.classList.remove('hidden'); ok=false}
            }
            if(!ok) return;
            saveForm.disabled = true;
            saveForm.textContent = 'جارٍ الحفظ...';
            const fd = new FormData();
            fd.append('title', fTitle.value);
            fd.append('type', fType.value);
            fd.append('desc', fDesc.value);
            fd.append('video', fVideo.value);
            fd.append('status', document.querySelector('input[name="status"]:checked').value);
            fd.append('locale', '{{ app()->getLocale() }}');
            if(uploadedImage) fd.append('image', uploadedImage);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            try {
                if(formMode==='add'){
                    await fetch('{{ route('admin.content.store') }}', {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': token },
                        body: fd
                    });
                    showToast('تم إضافة المحتوى بنجاح', true);
                } else if(formMode==='edit' && currentId!=null){
                    await fetch('{{ url('/admin/content') }}/'+currentId, {
                        method: 'POST',
                        headers: { 'X-CSRF-TOKEN': token },
                        body: fd
                    });
                    showToast('تم تعديل المحتوى بنجاح', true);
                }
                await loadData();
            } finally {
                saveForm.disabled = false;
                saveForm.textContent = 'حفظ';
                closeForm();
            }
        });

        loadData();
    </script>
    <script>
        document.getElementById('menuToggle')?.addEventListener('click', function(){
            document.getElementById('navLinks')?.classList.toggle('open');
        });
    </script>
    <footer class="bg-gray-100 mt-8">
        <div class="max-w-6xl mx-auto px-5 py-6 flex items-center justify-between gap-3 flex-wrap">
            <div class="flex items-center gap-2">
                <img src="{{ asset('images/logo.jpeg') }}" alt="SOQIA Innovative Environmental Solutions" class="h-4 w-auto rounded" style="height: 16px;">
                <div class="font-extrabold text-primary-green">SOQIA</div>
            </div>
            <div class="flex gap-3">
                <a href="{{ url('/') }}" class="text-gray-700">Home</a>
                <a href="{{ url('/awareness-content') }}" class="text-gray-700">Awareness</a>
                <a href="{{ url('/login') }}" class="text-gray-700">Login</a>
                @auth
                <a href="{{ url('/dashboard') }}" class="text-gray-700">Dashboard</a>
                @endauth
            </div>
            <div class="text-xs text-gray-500">© {{ date('Y') }} Saqqia</div>
        </div>
    </footer>
</body>
</html>
