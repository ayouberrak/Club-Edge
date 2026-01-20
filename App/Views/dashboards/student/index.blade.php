@extends('dashboards.student.layout')

@section('student_content')
<div class="space-y-8 animate-fadeIn">
    <header>
        <h1 class="text-4xl font-bold text-white">Student Dashboard</h1>
        <p class="text-slate-400">Welcome back, check your current club status and event RSVPs.</p>
    </header>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="glass p-6 rounded-2xl border border-slate-800 border-l-4 border-l-green-500 shadow-xl shadow-green-500/5">
            <div class="text-[10px] font-black uppercase text-slate-500 tracking-widest mb-2">Current Club</div>
            <div class="text-2xl font-bold text-white">{{ $my_club['name'] }}</div>
        </div>
        <div class="glass p-6 rounded-2xl border border-slate-800 border-l-4 border-l-blue-500">
            <div class="text-[10px] font-black uppercase text-slate-500 tracking-widest mb-2">Upcoming Events</div>
            <div class="text-3xl font-bold text-white">2</div>
        </div>
        <div class="glass p-6 rounded-2xl border border-slate-800 border-l-4 border-l-emerald-500">
            <div class="text-[10px] font-black uppercase text-slate-500 tracking-widest mb-2">Reviews Left</div>
            <div class="text-3xl font-bold text-white">1</div>
        </div>
    </div>

    <!-- My Club -->
    <div class="glass p-8 rounded-3xl border border-slate-800 relative overflow-hidden">
        <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
            <img src="{{ $my_club['image'] }}" class="w-32 h-32 rounded-2xl object-cover shadow-2xl">
            <div class="flex-grow text-center md:text-left">
                <h2 class="text-3xl font-bold text-white mb-2">{{ $my_club['name'] }}</h2>
                <p class="text-slate-400 text-sm mb-6 max-w-md">You joined this club on <span class="text-green-400 font-bold">{{ date('M d, Y', strtotime($my_club['joined_at'])) }}</span>. You are an active member contributing to its growth.</p>
                <div class="flex flex-wrap justify-center md:justify-start gap-3">
                    <span class="px-4 py-2 bg-slate-800 border border-slate-700 rounded-xl text-xs font-bold text-slate-300">Member #402</span>
                    <span class="px-4 py-2 bg-slate-800 border border-slate-700 rounded-xl text-xs font-bold text-slate-300">{{ $my_club['members_count'] }} Members</span>
                </div>
            </div>
        </div>
        <div class="absolute top-0 right-0 p-8">
            <button @click="$dispatch('toast', { message: 'Request to leave club sent!', type: 'success' })" class="text-red-900 font-bold text-xs uppercase hover:text-red-500 transition-colors">Leave Club</button>
        </div>
    </div>
</div>
@endsection
