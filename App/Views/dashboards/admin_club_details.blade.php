@extends('layouts.main')

@section('content')
<div class="py-6 max-w-7xl mx-auto space-y-8">
    <!-- Breadcrumb & Actions -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
        <div>
            <nav class="flex items-center space-x-2 text-[9px] font-black uppercase tracking-widest text-slate-500 mb-2 font-outfit">
                <a href="{{ $base_url }}/dashboard/admin" class="hover:text-blue-500 transition-colors">Admin Central</a>
                <span>/</span>
                <span class="text-white">Club Configuration</span>
            </nav>
            <h1 class="text-4xl font-black text-white leading-none tracking-tighter uppercase font-outfit">{{ $club['name'] }}</h1>
        </div>
        <div class="flex gap-3">
            <a href="{{ $base_url }}/dashboard/admin/club/delete/{{ $club['id'] }}" onclick="return confirm('Secure delete this entity?')" class="px-6 py-3 bg-red-600/10 text-red-500 border border-red-500/20 rounded-xl text-[9px] font-black uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all">Deactivate</a>
            <button class="btn-gradient px-6 py-3 rounded-xl text-[9px] font-black text-white uppercase tracking-widest shadow-xl shadow-blue-600/20">Sync</button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <div class="lg:col-span-1 space-y-8">
            <div class="glass p-6 rounded-[2rem] border-white/5 space-y-6">
                <div class="flex flex-col items-center">
                    <div class="w-24 h-24 rounded-2xl overflow-hidden border-2 border-slate-700 shadow-2xl mb-4">
                        <img src="{{ $base_url }}/assets/img/{{ $club['image'] ?? 'logo.png' }}" class="w-full h-full object-cover">
                    </div>
                    <span class="px-4 py-1.5 bg-blue-500/10 border border-blue-500/20 rounded-full text-[10px] font-black text-blue-400 uppercase tracking-widest">Global Identification</span>
                </div>

                <div class="space-y-3 pt-2">
                    <div class="p-3 bg-white/5 rounded-xl border border-white/5">
                        <div class="text-[8px] font-black text-slate-500 uppercase tracking-widest mb-0.5">President</div>
                        <div class="text-xs font-bold text-white">{{ $club['president'] }}</div>
                    </div>
                    <div class="p-3 bg-white/5 rounded-xl border border-white/5">
                        <div class="text-[8px] font-black text-slate-500 uppercase tracking-widest mb-0.5">Members Density</div>
                        <div class="text-xs font-bold text-white">{{ $club['members'] }} / {{ $club['capacity'] }} ({{ round(($club['members']/$club['capacity'])*100) }}%)</div>
                    </div>
                </div>
            </div>

            <div class="glass p-6 rounded-[2rem] border-white/5 space-y-3">
                <h3 class="text-[10px] font-black uppercase tracking-[0.2em] text-blue-500">Mission Description</h3>
                <p class="text-slate-400 text-xs leading-relaxed font-medium italic">
                    "{{ $club['description'] }}"
                </p>
            </div>
        </div>

        <div class="lg:col-span-3 space-y-12">
            <section class="space-y-6">
                <div class="flex items-center justify-between">
                    <h2 class="text-2xl font-black uppercase tracking-tighter text-white">Event Stream</h2>
                    <span class="px-3 py-1 bg-slate-800 rounded-lg text-[9px] font-bold text-slate-500 uppercase tracking-widest">{{ count($events) }} Active</span>
                </div>

                <div class="space-y-4">
                    @foreach($events as $event)
                    <div class="glass p-7 rounded-3xl border border-white/5 group hover:border-blue-500/30 transition-all flex items-center justify-between">
                        <div class="flex items-center gap-6">
                            <div class="w-14 h-14 bg-slate-900 rounded-2xl flex flex-col items-center justify-center border border-white/5">
                                <span class="text-[9px] font-black text-blue-500 uppercase">{{ date('M', strtotime($event['date'])) }}</span>
                                <span class="text-xl font-black text-white">{{ date('d', strtotime($event['date'])) }}</span>
                            </div>
                            <div>
                                <h4 class="text-lg font-bold text-white group-hover:text-blue-400 transition-colors uppercase tracking-tight">{{ $event['title'] }}</h4>
                                <p class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">{{ $event['location'] }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                             <div class="text-[9px] font-black text-slate-500 uppercase mb-1">Participants</div>
                             <div class="text-lg font-bold text-white">{{ $event['participants'] ?? 0 }} <span class="text-blue-500">verified</span></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <section class="space-y-6">
                <h2 class="text-2xl font-black uppercase tracking-tighter text-white">Article Logs</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($articles as $article)
                    <div class="glass overflow-hidden rounded-[2.5rem] border border-white/5 group hover:border-purple-500/30 transition-all">
                        <div class="h-40 relative">
                            <img src="{{ $base_url }}/upload/Image_article/{{ $article['image'] }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/90 to-transparent"></div>
                            <div class="absolute bottom-6 left-6">
                                <div class="text-[9px] font-black text-purple-400 uppercase tracking-widest mb-1">{{ date('d M, Y', strtotime($article['date'])) }}</div>
                                <h4 class="text-xl font-black text-white leading-tight uppercase">{{ $article['title'] }}</h4>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
