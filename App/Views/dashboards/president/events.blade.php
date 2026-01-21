@extends('dashboards.president.layout')

@section('president_content')
<div class="space-y-6 animate-fadeIn">
    <h2 class="text-2xl font-bold">Planned & History</h2>
    
    <div class="grid grid-cols-1 gap-4">
        @foreach($upcomingEvents as $event)
        <div class="glass p-6 rounded-3xl border border-white/5 flex flex-col md:flex-row items-center gap-6 group hover:border-indigo-500/20 transition-all">
            <img src="{{ $base_url }}{{ $event['image'] }}" class="w-32 h-24 rounded-2xl object-cover">
            <div class="flex-grow">
                <div class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1">Upcoming • {{ $event['date'] }}</div>
                <h3 class="text-xl font-bold uppercase">{{ $event['title'] }}</h3>
                <p class="text-slate-500 text-sm">{{ $event['participants'] ?? 0 }} students registered</p>
            </div>
        </div>
        @endforeach
        
        <div class="relative py-4">
            <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-800"></div></div>
            <div class="relative flex justify-center">
                <span class="bg-slate-950 px-4 text-xs font-black text-slate-600 uppercase">Past Events (Needs Report)</span>
            </div>
        </div>

        @foreach($pastEvents as $event)
        <div class="glass p-6 rounded-3xl border border-white/5 flex flex-col md:flex-row items-center gap-6 bg-slate-900/20 grayscale hover:grayscale-0 transition-all">
            <div class="w-32 h-24 rounded-2xl overflow-hidden bg-slate-800 flex items-center justify-center">
                @if(!empty($event['image']))
                    <img src="{{ $base_url }}{{ $event['image'] }}" class="w-full h-full object-cover opacity-50">
                @else
                    <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                @endif
            </div>
            <div class="flex-grow">
                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Completed • {{ $event['date'] }}</div>
                <h3 class="text-xl font-bold uppercase">{{ $event['title'] }}</h3>
                <p class="text-slate-400 text-sm">Event finished. Share the results with an article.</p>
            </div>

            <button @click="openArticleFor('{{ $event['title'] }}')" class="px-8 py-3 bg-indigo-600 rounded-2xl text-xs font-black uppercase tracking-widest text-white hover:bg-indigo-500 shadow-xl shadow-indigo-600/20 transition-all">
                Write Article
            </button>
            @else
            <div class="px-6 py-3 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl text-emerald-400 text-[10px] font-black uppercase tracking-widest">
                Article Published
            </div>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
