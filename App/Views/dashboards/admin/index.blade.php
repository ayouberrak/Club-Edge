@extends('dashboards.admin.layout')

@section('admin_content')
<div class="space-y-6 animate-fadeIn">
    <div class="flex justify-between items-end">
        <h2 class="text-3xl font-bold">Platform Clubs <span class="text-slate-500 text-lg">({{ count($clubs) }})</span></h2>
        <div class="text-xs text-slate-500 italic">Target: 4-6 clubs per establishment</div>
    </div>
    
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($clubs as $club)
        <div class="glass p-6 rounded-3xl border border-slate-800 relative overflow-hidden group hover:border-blue-500/40 transition-all cursor-pointer" onclick="window.location.href='{{ $base_url }}/dashboard/admin/club/{{  }}'">
            <div class="flex justify-between items-start mb-8 relative z-10">
                <div>
                    <h3 class="text-xl font-bold leading-tight group-hover:text-blue-400 transition-colors">{{ $club['name'] }}</h3>
                    <p class="text-xs text-slate-500 mt-1 uppercase tracking-tighter">President: <span class="text-slate-300 font-bold">{{ $club['president'] }}</span></p>
                </div>
                <div class="flex gap-2" onclick="event.stopPropagation()">
                    <button class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-800 border border-slate-700 hover:bg-blue-600 hover:text-white transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></button>
                    <button class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-800 border border-slate-700 hover:bg-red-600 hover:text-white transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></button>
                </div>
            </div>
            
            <div class="space-y-4 relative z-10">
                <div class="space-y-2">
                    <div class="flex justify-between text-xs font-bold uppercase tracking-widest text-slate-500">
                        <span>Members Capacity</span>
                        <span class="{{ $club['members'] >= $club['capacity'] ? 'text-red-400' : 'text-blue-400' }}">{{ $club['members'] }} / {{ $club['capacity'] }}</span>
                    </div>
                    <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden flex">
                        <div class="h-full {{ $club['members'] >= $club['capacity'] ? 'bg-red-500' : 'bg-blue-500' }}"></div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest group-hover:translate-x-1 transition-transform">View Full Profile →</span>
                </div>
            </div>
            
            <!-- Decorative BG -->
            <div class="absolute top-0 right-0 -mr-10 -mt-10 w-32 h-32 bg-blue-500/5 rounded-full blur-3xl pointer-events-none group-hover:bg-blue-500/10 transition-colors"></div>
        </div>
        @endforeach
    </div>
</div>
@endsection
