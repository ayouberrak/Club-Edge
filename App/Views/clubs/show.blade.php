@extends('layouts.main')

@section('content')
<div class="space-y-12 py-10" x-data="{ rsvpDone: false }">
    <div class="glass p-8 md:p-16 rounded-[3rem] border border-slate-700 overflow-hidden relative group">
        <div class="absolute top-0 right-0 w-1/2 h-full opacity-30 pointer-events-none group-hover:scale-110 transition-transform duration-700">
            <img src="{{ $base_url }}/assets/img/{{$club['image_url'] }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-l from-transparent to-slate-900"></div>
        </div>
        
        <div class="relative z-10 max-w-3xl">
            <div class="flex flex-wrap items-center gap-4 mb-8">
                <span class="px-5 py-2 bg-blue-500/10 text-blue-400 border border-blue-500/20 rounded-2xl text-xs font-black uppercase tracking-widest">Active Institution</span>
                <div class="flex items-center space-x-1 text-yellow-500">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    <span class="font-black text-sm">{{ $club['rating'] }}</span>
                    <span class="text-slate-500 text-xs font-medium">({{ $club['reviews_count'] }} Reviews)</span>
                </div>
            </div>
            
            <h1 class="text-6xl md:text-7xl font-black text-white mb-6 leading-none tracking-tighter">{{ $club['nom'] }}</h1>
            <p class="text-xl text-slate-400 mb-10 leading-relaxed font-medium">
                {{ $club['description'] }}
            </p>
            
            <div class="flex flex-wrap gap-10 mb-12">
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center text-blue-400 font-black text-xl shadow-xl shadow-blue-500/5">
                        {{ substr($club['president'] ?? 'None', 0, 1) }}
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-500 uppercase tracking-[0.2em] font-black">President</div>
                        <div class="text-lg font-bold text-white">{{ $club['president'] ?? 'To be assigned' }}</div>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="w-14 h-14 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center text-indigo-400 shadow-xl shadow-indigo-500/5">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <div class="text-[10px] text-slate-500 uppercase tracking-[0.2em] font-black">Community</div>
                        <div class="text-lg font-bold text-white">{{ $club['members_count'] }} / {{ $club['max_membres'] }} Members</div>
                    </div>
                </div>
            </div>

            @if(!isset($_SESSION['user_id']))
                <a href="{{$base_url}}/login" class="btn-gradient px-12 py-5 rounded-3xl font-black text-lg inline-block">
                    Login to Join
                </a>
            @elseif($user_membership)
                @if($user_membership['id_club'] == $club['id_club'])
                    <div class="flex items-center space-x-3 px-8 py-4 bg-green-500/10 border border-green-500/30 rounded-2xl text-green-400">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span class="font-black uppercase tracking-widest text-sm">You are a member</span>
                    </div>
                @else
                    <div class="px-8 py-4 bg-slate-800 border border-slate-700 rounded-2xl text-slate-400 italic text-sm">
                        You are already committed to another institution.
                    </div>
                @endif
            @else
                <form action="{{ $base_url }}/club/join" method="POST">
                    <input type="hidden" name="club_id" value="{{ $club['id_club'] }}">
                    <button type="submit" class="btn-gradient px-12 py-5 rounded-3xl font-black text-lg shadow-2xl shadow-blue-500/20 active:scale-95 transition-transform">
                        Apply for Membership
                    </button>
                </form>
            @endif
        </div>
    </div>

    <!-- Content Split -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
        <!-- Events Section -->
        <div class="lg:col-span-2 space-y-10">
            <div class="flex items-center space-x-4">
                <h2 class="text-4xl font-bold text-white">Events Schedule</h2>
                <div class="h-[2px] flex-grow bg-slate-800"></div>
            </div>

            {{-- Alerts --}}
            @if(isset($_GET['success']) && $_GET['success'] === 'registered')
                <div class="p-4 bg-green-500/10 border border-green-500/20 rounded-2xl text-green-400 text-sm flex items-center animate-fadeIn">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>Successfully registered for the event!</span>
                </div>
            @endif

            @if(isset($_GET['error']))
                <div class="p-4 bg-red-500/10 border border-red-500/20 rounded-2xl text-red-400 text-sm flex items-center animate-fadeIn">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>
                        @switch($_GET['error'])
                            @case('csrf_error') Session expired. Please refresh. @break
                            @case('already_registered') You already joined this event. @break
                            @default Error: {{ htmlspecialchars($_GET['error']) }}
                        @endswitch
                    </span>
                </div>
            @endif
            
            <div class="space-y-6">
                @foreach($events as $event)
                <div class="glass p-8 rounded-[2rem] border border-slate-800 flex flex-col md:flex-row justify-between items-center group hover:bg-slate-800/40 hover:border-blue-500/30 transition-all duration-300">
                    <div class="flex items-center space-x-8 mb-6 md:mb-0">
                        <div class="w-20 h-20 bg-slate-900 rounded-3xl flex flex-col items-center justify-center border border-slate-700 group-hover:border-blue-500/50 transition-colors">
                            <span class="text-xs font-black text-blue-500 uppercase tracking-widest">{{ date('M', strtotime($event['date'])) }}</span>
                            <span class="text-3xl font-black text-white leading-tight">{{ date('d', strtotime($event['date'])) }}</span>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-white group-hover:text-blue-400 transition-colors mb-2">{{ $event['title'] }}</h3>
                            <div class="flex items-center text-slate-500 text-sm font-medium">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                                {{ $event['location'] }}
                            </div>
                        </div>
                    </div>
                    @php 
                        $eventDate = strtotime($event['date']);
                        $isPast = $eventDate < time();
                    @endphp

                    @if($isPast)
                        <button disabled class="px-10 py-4 bg-slate-800/50 rounded-2xl font-black text-sm uppercase tracking-widest text-slate-500 border border-slate-700 cursor-not-allowed">
                            Completed
                        </button>
                    @elseif($event['is_registered'] ?? false)
                        <form action="{{ $base_url }}/event/cancel" method="POST">
                            <input type="hidden" name="csrf_token" value="{{ $_SESSION['csrf_token'] ?? '' }}">
                            <input type="hidden" name="event_id" value="{{ $event['id_event'] ?? $event['id'] }}">
                            <input type="hidden" name="redirect_to" value="/club/{{ $club['id_club'] }}">
                            <button type="submit" class="px-10 py-4 bg-red-500/10 hover:bg-red-600 text-red-500 hover:text-white rounded-2xl font-black text-sm uppercase tracking-widest transition-all border border-red-500/20">
                                Cancel RSVP
                            </button>
                        </form>
                    @else
                        <form action="{{ $base_url }}/event/register" method="POST">
                            <input type="hidden" name="csrf_token" value="{{ $_SESSION['csrf_token'] ?? '' }}">
                            <input type="hidden" name="event_id" value="{{ $event['id_event'] ?? $event['id'] }}">
                            <input type="hidden" name="redirect_to" value="/club/{{ $club['id_club'] }}">
                            <button type="submit" class="px-10 py-4 bg-slate-800 hover:bg-blue-600 hover:text-white rounded-2xl font-black text-sm uppercase tracking-widest transition-all">
                                Join Event
                            </button>
                        </form>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        
        <!-- Articles Side -->
        <div class="space-y-10">
            <h2 class="text-4xl font-bold text-white">Recent Articles</h2>
            <div class="space-y-6">
                @foreach($articles as $article)
                <div class="glass overflow-hidden rounded-[2.5rem] border border-slate-800 group hover:border-indigo-500/40 transition-all">
                    <div class="h-48 overflow-hidden">
                        <img src="{{ $base_url }}/upload/Image_article/{{ $article['image'] }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                    </div>
                    <div class="p-8">
                        <h3 class="text-xl font-bold text-white mb-4 leading-tight group-hover:text-indigo-400 transition-colors">{{ $article['title'] }}</h3>
                        <p class="text-slate-400 text-sm mb-6 line-clamp-2">{{ $article['summary'] }}</p>
                        <a href="#" class="inline-flex items-center text-indigo-400 font-black text-xs uppercase tracking-widest hover:translate-x-2 transition-transform">
                            Read Article <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path></svg>
                        </a>
                    </div>
                </div>
                @endforeach
                
                <div class="p-8 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-[2.5rem] text-white shadow-xl shadow-indigo-500/20">
                    <h4 class="text-2xl font-black mb-2">Want to lead?</h4>
                    <p class="text-indigo-100 text-sm mb-6">Become a club member and you could be the next president!</p>
                    <button class="bg-white text-indigo-600 px-6 py-3 rounded-2xl font-black text-xs uppercase tracking-widest">Learn More</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection
