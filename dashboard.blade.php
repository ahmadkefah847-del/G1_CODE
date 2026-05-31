@extends('layouts.admin')
@section('pageTitle', __('admin.dashboard.title'))
@php
    $sidebarActive = 'dashboard';
    $langParam = ['lang' => app()->getLocale()];
@endphp

@section('content')
<div class="flex items-center justify-between mb-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900">{{ __('admin.dashboard.welcome', ['name' => auth()->user()->name]) }} 👋</h1>
        <p class="text-gray-500 text-sm mt-1">{{ __('admin.dashboard.overview_date', ['date' => now()->translatedFormat('l d F Y')]) }}</p>
    </div>
</div>

<!-- KPI -->
<div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-5 mb-8">
    <div class="card p-5">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-blue-50 rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg></div>
            <span class="text-xs font-bold px-2 py-1 rounded-full {{ $kpi['user_growth'] >= 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">{{ $kpi['user_growth'] >= 0 ? '+' : '' }}{{ $kpi['user_growth'] }}%</span>
        </div>
        <div class="text-3xl font-bold text-gray-900">{{ $kpi['total_users'] }}</div>
        <div class="text-sm text-gray-500 mt-1">{{ __('admin.dashboard.total_users') }}</div>
    </div>
    <div class="card p-5">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-green-50 rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg></div>
            <span class="text-xs font-bold px-2 py-1 rounded-full bg-green-50 text-green-600">{{ __('admin.dashboard.active') }}</span>
        </div>
        <div class="text-3xl font-bold text-gray-900">{{ $kpi['active_users'] }}</div>
        <div class="text-sm text-gray-500 mt-1">{{ __('admin.dashboard.active_users') }}</div>
    </div>
    <div class="card p-5">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-purple-50 rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg></div>
            <span class="text-xs font-bold px-2 py-1 rounded-full {{ $kpi['consultation_growth'] >= 0 ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">{{ $kpi['consultation_growth'] >= 0 ? '+' : '' }}{{ $kpi['consultation_growth'] }}%</span>
        </div>
        <div class="text-3xl font-bold text-gray-900">{{ $kpi['total_consultations'] }}</div>
        <div class="text-sm text-gray-500 mt-1">{{ __('admin.dashboard.total_consultations') }}</div>
    </div>
    <div class="card p-5">
        <div class="flex items-center justify-between mb-3">
            <div class="w-11 h-11 bg-orange-50 rounded-xl flex items-center justify-center"><svg class="w-5 h-5 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
            <span class="text-xs font-bold px-2 py-1 rounded-full bg-green-50 text-green-600">{{ $kpi['published_content'] }}/{{ $kpi['total_content'] }}</span>
        </div>
        <div class="text-3xl font-bold text-gray-900">{{ $kpi['published_content'] }}</div>
        <div class="text-sm text-gray-500 mt-1">{{ __('admin.dashboard.published_content') }}</div>
    </div>
</div>

<!-- Charts -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
    <div class="card p-6">
        <h3 class="text-base font-bold text-gray-800 mb-4">{{ __('admin.dashboard.users_growth') }}</h3>
        <div style="height:250px"><canvas id="usersChart"></canvas></div>
    </div>
    <div class="card p-6">
        <h3 class="text-base font-bold text-gray-800 mb-4">{{ __('admin.dashboard.consultations_activity') }}</h3>
        <div style="height:250px"><canvas id="consultationsChart"></canvas></div>
    </div>
</div>

<div class="card p-6 mb-8">
    <h3 class="text-base font-bold text-gray-800 mb-4">{{ __('admin.dashboard.water_consumption_liters') }}</h3>
    <div style="height:220px"><canvas id="waterChart"></canvas></div>
</div>

<!-- Recent Activity -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Users -->
    <div class="card p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-gray-800">{{ __('admin.dashboard.recent_users') }}</h3>
            <a href="{{ route('admin.users', $langParam) }}" class="text-xs text-brand-600 hover:underline">{{ __('admin.dashboard.view_all') }}</a>
        </div>
        <div class="space-y-3">
            @forelse($recent_users as $user)
            <div class="flex items-center gap-3 p-2.5 rounded-xl hover:bg-gray-50 transition">
                <div class="w-9 h-9 bg-gradient-to-br from-brand-400 to-brand-600 rounded-full flex items-center justify-center text-white font-bold text-xs">{{ mb_substr($user->name,0,1) }}</div>
                <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-800 truncate">{{ $user->name }}</p>
                    <p class="text-xs text-gray-400 truncate">{{ $user->email }}</p>
                </div>
                <span class="badge {{ $user->role === 'admin' ? 'badge-blue' : 'badge-green' }}">{{ __('admin.roles.' . $user->role) }}</span>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-4">{{ __('admin.dashboard.no_users') }}</p>
            @endforelse
        </div>
    </div>
    <!-- Consultations -->
    <div class="card p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-gray-800">{{ __('admin.dashboard.recent_consultations') }}</h3>
            <a href="{{ route('admin.consultations', $langParam) }}" class="text-xs text-brand-600 hover:underline">{{ __('admin.dashboard.view_all') }}</a>
        </div>
        <div class="space-y-3">
            @forelse($recent_consultations as $c)
            <div class="p-2.5 rounded-xl hover:bg-gray-50 transition">
                <p class="text-sm font-medium text-gray-800 truncate">{{ $c->title }}</p>
                <div class="flex items-center justify-between mt-1.5">
                    <span class="text-xs text-gray-400">{{ $c->created_at->diffForHumans() }}</span>
                    <span class="badge {{ $c->status==='pending'?'badge-yellow':($c->status==='in_progress'?'badge-blue':($c->status==='completed'?'badge-green':'badge-red')) }}">{{ __('admin.statuses.' . $c->status) }}</span>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-4">{{ __('admin.dashboard.no_consultations') }}</p>
            @endforelse
        </div>
    </div>
    <!-- Content -->
    <div class="card p-5">
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-bold text-gray-800">{{ __('admin.dashboard.recent_content') }}</h3>
            <a href="{{ route('admin.manage-content', $langParam) }}" class="text-xs text-brand-600 hover:underline">{{ __('admin.dashboard.view_all') }}</a>
        </div>
        <div class="space-y-3">
            @forelse($recent_content as $content)
            <div class="p-2.5 rounded-xl hover:bg-gray-50 transition">
                <p class="text-sm font-medium text-gray-800 truncate">{{ $content->title }}</p>
                <div class="flex items-center justify-between mt-1.5">
                    <span class="text-xs text-gray-400">{{ __('admin.locales.' . $content->locale) }}</span>
                    <span class="badge {{ $content->published ? 'badge-green' : 'badge-yellow' }}">{{ $content->published ? __('admin.published') : __('admin.draft') }}</span>
                </div>
            </div>
            @empty
            <p class="text-sm text-gray-400 text-center py-4">{{ __('admin.dashboard.no_content') }}</p>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
const chartFont = {family:'Tajawal'};
Chart.defaults.font.family = 'Tajawal';

new Chart(document.getElementById('usersChart'),{
    type:'line',
    data:{labels:@js($users_chart->pluck('date')),datasets:[{data:@js($users_chart->pluck('count')),borderColor:'#10b981',backgroundColor:'rgba(16,185,129,.1)',fill:true,tension:.4,borderWidth:2,pointRadius:4,pointBackgroundColor:'#10b981'}]},
    options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true,grid:{color:'#f1f5f9'}},x:{grid:{display:false}}}}
});

new Chart(document.getElementById('consultationsChart'),{
    type:'bar',
    data:{labels:@js($consultations_chart->pluck('date')),datasets:[{data:@js($consultations_chart->pluck('count')),backgroundColor:'#818cf8',borderRadius:8,borderSkipped:false}]},
    options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true,grid:{color:'#f1f5f9'}},x:{grid:{display:false}}}}
});

new Chart(document.getElementById('waterChart'),{
    type:'line',
    data:{labels:@js($water_usage_chart->pluck('month')),datasets:[{data:@js($water_usage_chart->pluck('usage')),borderColor:'#06b6d4',backgroundColor:'rgba(6,182,212,.1)',fill:true,tension:.4,borderWidth:2,pointRadius:4,pointBackgroundColor:'#06b6d4'}]},
    options:{responsive:true,maintainAspectRatio:false,plugins:{legend:{display:false}},scales:{y:{beginAtZero:true,grid:{color:'#f1f5f9'}},x:{grid:{display:false}}}}
});
</script>
@endsection
