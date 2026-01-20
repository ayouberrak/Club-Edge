@extends('layouts.main')

@section('content')
<div class="py-10 flex flex-col md:flex-row gap-8" x-data="{ 
    showEventModal: false, 
    showArticleModal: false, 
    articleEventTitle: '',
    openArticleFor(title) {
        this.articleEventTitle = title;
        this.showArticleModal = true;
    }
}">
    <!-- Sidebar -->
    <aside class="w-full md:w-64 space-y-4">
        <div class="glass p-6 rounded-2xl border border-slate-800">
            <div class="flex flex-col items-center mb-6">
                <div class="relative">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 mb-4 flex items-center justify-center text-3xl font-bold">
                        AE
                    </div>
                </div>
                <h3 class="text-xl font-bold">Anas Errak</h3>
                <p class="text-indigo-400 text-sm font-semibold">Club President</p>
                <p class="text-slate-500 text-xs">Robotics Club</p>
            </div>
            <nav class="space-y-2">
                <a href="{{ $base_url }}/dashboard/president" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all {{ strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/president/events') === false && strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/president/articles') === false ? 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20' : 'text-slate-400 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Members</span>
                </a>
                <a href="{{ $base_url }}/dashboard/president/events" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all {{ strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/president/events') !== false ? 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20' : 'text-slate-400 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Club Events</span>
                </a>
                <a href="{{ $base_url }}/dashboard/president/articles" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all {{ strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/president/articles') !== false ? 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20' : 'text-slate-400 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6"></path></svg>
                    <span>Manage Articles</span>
                </a>
            </nav>
            <div class="mt-8 space-y-3">
                <button @click="showEventModal = true" class="w-full btn-gradient py-3 rounded-xl font-bold flex items-center justify-center space-x-2 text-sm shadow-lg shadow-indigo-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>New Event</span>
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-4xl font-bold font-outfit tracking-tighter uppercase">Club <span class="text-indigo-500">Nexus</span></h1>
                <p class="text-slate-400 text-sm">Managing the **{{ $club['name'] }}** universe.</p>
            </div>
            @if(isset($club['members_count']) && isset($club['max_members']))
            <div class="flex items-center space-x-3 glass p-2 rounded-2xl border border-white/5">
                <div class="px-4 py-2 bg-indigo-500/20 text-indigo-400 rounded-xl text-xs font-black">
                    {{ $club['members_count'] }} / {{ $club['max_members'] }} CAPACITY
                </div>
            </div>
            @endif
        </div>

        @yield('president_content')
    </div>

    <!-- Modals (Common for all president pages) -->
    
    <!-- New Event Modal -->
    <div x-show="showEventModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak x-transition>
        <div class="glass w-full max-w-xl p-10 rounded-[2.5rem] border border-white/10" @click.away="showEventModal = false">
            <h2 class="text-3xl font-black mb-10 uppercase tracking-tighter">Schedule <span class="text-indigo-500">Event</span></h2>
            <form class="space-y-6">
                <input type="text" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none" placeholder="Event Name">
                <input type="date" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none">
                <textarea class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none h-32" placeholder="Description"></textarea>
                <button type="button" @click="showEventModal = false; $dispatch('toast', { message: 'Event successfully created!', type: 'success' })" class="w-full btn-gradient py-5 rounded-2xl font-black text-lg shadow-2xl shadow-indigo-600/20">PUBLISH EVENT</button>
            </form>
        </div>
    </div>

    <!-- Article Modal -->
    <div x-show="showArticleModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak x-transition>
        <div class="glass w-full max-w-2xl p-10 rounded-[2.5rem] border border-white/10" @click.away="showArticleModal = false">
            <h2 class="text-2xl font-black mb-4 uppercase tracking-tighter">Post-Event <span class="text-indigo-500">Article</span></h2>
            <p class="text-slate-500 text-sm mb-10">Sharing insights for: <span x-text="articleEventTitle" class="text-white font-bold italic"></span></p>
            <form class="space-y-6">
                <input type="text" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none" placeholder="Article Catchy Title">
                <textarea class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none h-48" placeholder="Tell the world what happened..."></textarea>
                <div class="flex gap-4">
                    <button type="button" @click="showArticleModal = false" class="flex-1 py-4 text-slate-500 font-bold uppercase tracking-widest text-xs">Discard</button>
                    <button type="button" @click="showArticleModal = false; $dispatch('toast', { message: 'Article published for everyone!', type: 'success' })" class="flex-[3] bg-indigo-600 py-4 rounded-2xl font-black text-white uppercase tracking-widest shadow-xl shadow-indigo-600/20">POST STORY</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    [x-cloak] { display: none !important; }
    .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endsection
