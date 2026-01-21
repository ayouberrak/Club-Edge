@extends('dashboards.student.layout')

@section('student_content')
<div class="space-y-8 animate-fadeIn">
    <h2 class="text-3xl font-bold text-white">Club Insights</h2>
    <div class="grid grid-cols-1 gap-6">
        @foreach($past_articles as $article)
        <div class="glass p-8 rounded-3xl border border-slate-800 hover:border-emerald-500/40 transition-all cursor-pointer">
            <div class="flex items-center space-x-2 text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-4">
                <span>{{ $article['club_name'] }}</span>
                <span>•</span>
                <span>{{ $article['created_at'] }}</span>
            </div>
            <h3 class="text-2xl font-bold text-white mb-4 leading-tight">{{ $article['event_title'] }}</h3>
            <p class="text-slate-400 text-sm mb-6 line-clamp-2">Discover how we are integrating advanced neural networks into our latest robotics project. Our team has spent weeks refining the algorithms for better balance...</p>
            <div class="flex items-center text-emerald-400 text-xs font-bold uppercase tracking-widest">
                Read Story 
                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
