@extends('dashboards.president.layout')

@section('president_content')
<div class="animate-fadeIn space-y-8">
    <div class="border-l-4 border-indigo-600 pl-4">
        <h2 class="text-2xl font-black uppercase tracking-tighter">Published <span class="text-indigo-500">Stories</span></h2>
        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest">Manage your event highlights</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-5xl">
        @if(empty($articles))
            <div class="col-span-full glass p-16 rounded-[2.5rem] border border-white/5 text-center space-y-4">
                <div class="w-20 h-20 bg-slate-900 rounded-[2rem] flex items-center justify-center mx-auto border border-white/5 shadow-2xl">
                    <svg class="w-10 h-10 text-slate-700" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path></svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-white uppercase tracking-tighter">No stories published</h3>
                    <p class="text-slate-500 text-sm font-medium uppercase tracking-widest mt-1">Share your club's success with the world!</p>
                </div>
                <div class="pt-4">
                    <a href="{{ $base_url }}/dashboard/president/events" class="inline-flex items-center gap-2 bg-indigo-600/10 text-indigo-400 px-6 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest border border-indigo-500/20 hover:bg-indigo-600 hover:text-white transition-all">
                        Go to Events
                    </a>
                </div>
            </div>
        @else
            @foreach($articles as $article)
            <div class="group relative glass p-4 rounded-[2rem] border border-white/5 hover:bg-white/[0.02] transition-all duration-300">
                
                <div class="relative h-48 w-full rounded-[1.5rem] overflow-hidden mb-4">
                    @if($article->getImageArticle())
                        <img src="@url('upload/Image_article/' . $article->getImageArticle())" 
                             class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                    @else
                        <div class="w-full h-full bg-slate-900 flex items-center justify-center">
                            <svg class="w-12 h-12 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    @endif
                    
                    <div class="absolute top-3 left-3">
                        <span class="bg-indigo-600 text-white text-[9px] font-black px-3 py-1 rounded-full uppercase tracking-tighter shadow-xl">
                            {{ $club['name'] }}
                        </span>
                    </div>
                </div>

                <div class="px-2 space-y-3">
                    <div class="flex items-center gap-2">
                        <div class="h-[1px] w-8 bg-indigo-500/50"></div>
                        <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">
                            Published {{ $article->getCreatedAt() ?? 'Recently' }}
                        </span>
                    </div>

                    <p class="text-slate-300 text-sm leading-relaxed line-clamp-3 italic">
                        "{{ $article->getContenu() }}"
                    </p>

                    <div class="pt-4 flex items-center justify-between border-t border-white/5">
                        <div class="flex gap-4">
                            <button class="text-[10px] font-black uppercase tracking-[0.15em] text-indigo-400 hover:text-white transition-colors flex items-center gap-1">
                                <span>Edit</span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </button>
                            <button class="text-[10px] font-black uppercase tracking-[0.15em] text-rose-800 hover:text-rose-500 transition-colors flex items-center gap-1">
                                <span>Delete</span>
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </div>
                        
                        <div class="p-2 rounded-full bg-white/5 text-slate-500 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-300">
                            <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
        
        
        </div>
</div>
@endsection