@extends('layouts.main')

@section('content')
<div class="py-10 max-w-6xl mx-auto space-y-12">
    <!-- Breadcrumb & Actions -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <nav class="flex items-center space-x-2 text-[10px] font-black uppercase tracking-widest text-slate-500 mb-4">
                <a href="{{ $base_url }}/dashboard/admin" class="hover:text-blue-500 transition-colors">Admin Dashboard</a>
                <span>/</span>
                <span class="text-white">{{ $club['name'] }}</span>
            </nav>
            <h1 class="text-6xl font-black text-white leading-none tracking-tighter uppercase">{{ $club['name'] }}</h1>
        </div>
        <div class="flex gap-4">
            <button class="px-8 py-4 bg-red-600/10 text-red-500 border border-red-500/20 rounded-2xl text-[10px] font-black uppercase tracking-widest hover:bg-red-600 hover:text-white transition-all">Deactivate Club</button>
            <button class="btn-gradient px-8 py-4 rounded-2xl text-[10px] font-black text-white uppercase tracking-widest shadow-xl shadow-blue-600/20">Export PDF Report</button>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Sidebar Info -->
        <div class="space-y-8">
            <div class="glass p-8 rounded-[2.5rem] border-white/5 space-y-6">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-blue-500">Core Meta</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center py-4 border-b border-white/5">
                        <span class="text-xs text-slate-500 font-bold uppercase">President</span>
                        <span class="text-sm font-black text-white">{{ $club['president'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-4 border-b border-white/5">
                        <span class="text-xs text-slate-500 font-bold uppercase">Status</span>
                        <span class="px-3 py-1 bg-green-500/10 border border-green-500/20 rounded-full text-[9px] font-black text-green-400 uppercase tracking-widest">{{ $club['status'] }}</span>
                    </div>
                    <div class="flex justify-between items-center py-4 border-b border-white/5">
                        <span class="text-xs text-slate-500 font-bold uppercase">Occupancy</span>
                        <span class="text-sm font-black text-white">{{ $club['members'] }} / {{ $club['capacity'] }} Members</span>
                    </div>
                </div>
            </div>

            <div class="glass p-8 rounded-[2.5rem] border-white/5 space-y-4">
                <h3 class="text-xs font-black uppercase tracking-[0.3em] text-purple-500">Mission Statement</h3>
                <p class="text-slate-400 text-sm leading-relaxed font-medium italic">
                    "{{ $club['description'] }}"
                </p>
            </div>
        </div>

        <!-- Main Content (Events & Articles) -->
        <div class="lg:col-span-2 space-y-12">
            <!-- Events Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-white/5">
                    <div class="flex items-center space-x-3 text-blue-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <h2 class="text-xl font-black uppercase tracking-widest text-white">Engagement Logs</h2>
                    </div>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Showing last 2 events</span>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    @foreach($events as $event)
                    <div class="glass p-6 rounded-3xl border border-white/5 group hover:border-blue-500/30 transition-all">
                        <div class="flex justify-between items-start mb-6">
                            <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-blue-500 border border-white/5">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                            </div>
                            <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">{{ $event['date'] }}</span>
                        </div>
                        <h4 class="text-lg font-black text-white group-hover:text-blue-400 transition-colors">{{ $event['title'] }}</h4>
                        <div class="mt-4 flex items-center space-x-2 text-[10px] font-black text-slate-500 uppercase tracking-widest">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a7 7 0 017 7v1H1v-1a7 7 0 017-7z"></path></svg>
                            <span>{{ $event['attendance'] }} Participants Verified</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

            <!-- Articles Section -->
            <section class="space-y-6">
                <div class="flex items-center justify-between pb-4 border-b border-white/5">
                    <div class="flex items-center space-x-3 text-purple-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                        <h2 class="text-xl font-black uppercase tracking-widest text-white">System Repository</h2>
                    </div>
                    <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Knowledge Stream</span>
                </div>

                <div class="space-y-4">
                    @foreach($articles as $article)
                    <div class="glass p-8 rounded-[2rem] border border-white/5 group hover:border-purple-500/30 transition-all cursor-pointer">
                        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                            <div>
                                <h4 class="text-xl font-black text-white group-hover:text-purple-400 transition-colors mb-2">{{ $article['title'] }}</h4>
                                <div class="flex items-center space-x-4 text-[9px] font-black text-slate-500 uppercase tracking-widest">
                                    <span class="text-purple-400">By {{ $article['author'] }}</span>
                                    <span>•</span>
                                    <span>Indexed {{ $article['date'] }}</span>
                                </div>
                            </div>
                            <svg class="w-6 h-6 text-slate-700 group-hover:text-purple-500 group-hover:translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>
@endsection
