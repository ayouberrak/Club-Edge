@extends('dashboards.admin.layout')

@section('admin_content')
<div class="space-y-8 animate-fadeIn">
    <!-- Club Header -->
    <div class="glass p-8 rounded-[2.5rem] border border-blue-500/20 relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row justify-between gap-8">
    <div class="space-y-4">
        <div class="flex items-center gap-3">
            <span class="px-3 py-1 bg-blue-500/10 text-blue-400 text-[10px] font-black uppercase tracking-widest rounded-full border border-blue-500/20">
                {{ $club['status'] ?? 'Active Entity' }}
            </span>
            <span class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">ID: #{{ $club['id'] }}</span>
        </div>
        
        <h1 class="text-5xl font-black text-white tracking-tighter uppercase">{{ $club['name'] }}</h1>
        <p class="text-slate-400 max-w-xl leading-relaxed">{{ $club['description'] }}</p>
        
        <div class="flex flex-wrap gap-4 pt-4">
            <div class="glass bg-white/5 p-4 rounded-2xl border border-white/5 min-w-[140px]">
                <div class="text-slate-500 text-[10px] font-bold uppercase mb-1">President</div>
                <div class="text-white font-bold">{{ $club['president'] }}</div>
            </div>

            <div class="glass bg-white/5 p-4 rounded-2xl border border-white/5 min-w-[180px]">
                <div class="flex justify-between items-center mb-1">
                    <div class="text-slate-500 text-[10px] font-bold uppercase">Members</div>
                    <div class="text-white text-[10px] font-bold">{{ $club['members'] }} / {{ $club['capacity'] }}</div>
                </div>
                <div class="w-full h-1.5 bg-slate-800 rounded-full mt-2 overflow-hidden">
                    @php 
                        $percentage = ($club['capacity'] > 0) ? ($club['members'] / $club['capacity']) * 100 : 0; 
                    @endphp
                    <div class="h-full bg-blue-500 rounded-full" style="width: {{ $percentage }}%"></div>
                </div>
            </div>
        </div>
    </div>
</div>
        
        <!-- Decorative background elements -->
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-blue-600/10 rounded-full blur-[100px] pointer-events-none"></div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Events Section -->
        <div class="glass p-8 rounded-3xl border border-slate-800">
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Events
            </h3>
            <div class="space-y-4">
                @foreach($events as $event)
                <div class="flex items-center justify-between p-4 bg-slate-900/50 rounded-2xl border border-slate-800 hover:border-blue-500/20 transition-all">
                    <div>
                        <div class="text-white font-bold">{{ $event['title'] }}</div>
                        <div class="text-[10px] text-slate-500 uppercase font-black">{{ $event['date'] }}</div>
                    </div>
                </div>
                @endforeach
                @if(empty($events ))
            <div class="text-center py-8 text-slate-500 text-sm italic">
                aucun evenement creer.
            </div>
        @endif
            </div>
        </div>

        <div class="glass p-8 rounded-3xl border border-slate-800">
    <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
        <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6"></path>
        </svg>
        articles
    </h3>
    
    <div class="space-y-4">
        @foreach($articles as $article)
        <div class="p-4 bg-slate-900/50 rounded-2xl border border-slate-800 group hover:border-indigo-500/20 transition-all cursor-pointer">
            <div class="flex gap-4">
                <div class="flex-shrink-0 w-20 h-20 rounded-xl overflow-hidden bg-slate-800 border border-white/5">
                    @if(!empty($article['image']))
                        <img src="{{ $base_url }}/upload/articles/{{ $article['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-slate-600 text-xs">No Img</div>
                    @endif
                </div>

                <div class="flex-grow">
                    <div class="flex justify-between items-start mb-1">
                        <div class="text-white font-bold group-hover:text-indigo-400 transition-colors uppercase text-sm">
                            {{ $article['title'] }}
                        </div>
                        <svg class="w-4 h-4 text-slate-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>

                    <p class="text-slate-400 text-xs line-clamp-2 mb-2 leading-relaxed">
                        {{ substr(strip_tags($article['content']), 0, 80) }}...
                    </p>

                    <div class="text-[9px] text-slate-500 font-black uppercase tracking-widest">
                        By <span class="text-indigo-300">{{ $article['author'] }}</span> • {{ date('M d, Y', strtotime($article['date'])) }}
                    </div>
                </div>
            </div>
        </div>
        @endforeach

        @if(empty($articles))
            <div class="text-center py-8 text-slate-500 text-sm italic">
                No stories published yet.
            </div>
        @endif
    </div>
</div>
    </div>
</div>
@endsection
