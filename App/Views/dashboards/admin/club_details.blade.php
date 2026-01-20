@extends('dashboards.admin.layout')

@section('admin_content')
<div class="space-y-8 animate-fadeIn">
    <!-- Club Header -->
    <div class="glass p-8 rounded-[2.5rem] border border-blue-500/20 relative overflow-hidden">
        <div class="relative z-10 flex flex-col md:flex-row justify-between gap-8">
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <span class="px-3 py-1 bg-blue-500/10 text-blue-400 text-[10px] font-black uppercase tracking-widest rounded-full border border-blue-500/20">Active Entity</span>
                    <span class="text-slate-500 text-[10px] font-bold uppercase tracking-widest">ID: #{{ $club['id'] }}</span>
                </div>
                <h1 class="text-5xl font-black text-white tracking-tighter uppercase">{{ $club['name'] }}</h1>
                <p class="text-slate-400 max-w-xl leading-relaxed">{{ $club['description'] }}</p>
                
                <div class="flex flex-wrap gap-4 pt-4">
                    <div class="glass bg-white/5 p-4 rounded-2xl border border-white/5">
                        <div class="text-slate-500 text-[10px] font-bold uppercase mb-1">President</div>
                        <div class="text-white font-bold">{{ $club['president'] }}</div>
                    </div>
                    <div class="glass bg-white/5 p-4 rounded-2xl border border-white/5">
                        <div class="text-slate-500 text-[10px] font-bold uppercase mb-1">Members</div>
                        <div class="text-white font-bold">{{ $club['members'] }} / {{ $club['capacity'] }}</div>
                    </div>
                </div>
            </div>
            
            <div class="flex flex-col gap-3 min-w-[200px]">
                <button class="w-full bg-blue-600 text-white py-4 rounded-2xl font-black text-xs uppercase tracking-widest shadow-lg shadow-blue-600/20 hover:scale-[1.02] transition-all">Download Audit</button>
                <button class="w-full bg-slate-800 text-slate-300 py-4 rounded-2xl font-black text-xs uppercase tracking-widest border border-slate-700 hover:bg-slate-700 transition-all text-center">Transfer Ownership</button>
                <button class="w-full text-red-500 py-4 font-bold text-xs uppercase tracking-widest hover:text-red-400 transition-colors">Deactivate Club</button>
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
                Activity Timeline
            </h3>
            <div class="space-y-4">
                @foreach($events as $event)
                <div class="flex items-center justify-between p-4 bg-slate-900/50 rounded-2xl border border-slate-800 hover:border-blue-500/20 transition-all">
                    <div>
                        <div class="text-white font-bold">{{ $event['title'] }}</div>
                        <div class="text-[10px] text-slate-500 uppercase font-black">{{ $event['date'] }}</div>
                    </div>
                    <div class="text-blue-400 font-mono text-xs">{{ $event['attendance'] }} RSVPs</div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Articles Section -->
        <div class="glass p-8 rounded-3xl border border-slate-800">
            <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                <svg class="w-5 h-5 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6"></path></svg>
                Published Stories
            </h3>
            <div class="space-y-4">
                @foreach($articles as $article)
                <div class="p-4 bg-slate-900/50 rounded-2xl border border-slate-800 group hover:border-indigo-500/20 transition-all cursor-pointer">
                    <div class="flex justify-between items-start mb-1">
                        <div class="text-white font-bold group-hover:text-indigo-400 transition-colors">{{ $article['title'] }}</div>
                        <svg class="w-4 h-4 text-slate-600 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                    <div class="text-[10px] text-slate-500 font-bold uppercase">By {{ $article['author'] }} • {{ $article['date'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
