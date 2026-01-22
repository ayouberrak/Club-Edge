@extends('dashboards.student.layout')

@section('student_content')
<div class="space-y-8 animate-fadeIn">
    <h2 class="text-3xl font-bold">Event Registrations</h2>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($registered_events as $event)
        <div class="glass p-6 rounded-3xl border border-slate-800 relative group">
            <div class="flex justify-between items-start mb-6">
                <div class="w-12 h-12 bg-slate-800 rounded-xl flex flex-col items-center justify-center border border-slate-700">
                    {{-- Use ?? to provide a fallback and avoid the null deprecated warning --}}
                    <span class="text-[10px] font-black uppercase text-blue-500">
                        {{ date('M', strtotime($event['date'] ?? 'now')) }}
                    </span>
                    <span class="text-lg font-bold text-white">
                        {{ date('d', strtotime($event['date'] ?? 'now')) }}
                    </span>
                </div>
                
                @php $status = $event['status'] ?? 'upcoming'; @endphp
                <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $status === 'upcoming' ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'bg-slate-800 text-slate-500' }}">
                    {{ $status }}
                </span>
            </div>

            <h3 class="text-xl font-bold mb-2 group-hover:text-green-400 transition-colors">
                {{ $event['title'] ?? 'Unnamed Event' }}
            </h3>
            
            <p class="text-slate-500 text-sm mb-6 flex items-center">
                <svg class="w-4 h-4 mr-1 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                {{ $event['location'] ?? 'Location TBD' }}
            </p>

            {{-- Action Buttons --}}
            @if($status === 'completed')
                <button class="w-full py-4 bg-green-600 rounded-2xl font-black text-xs uppercase tracking-widest text-white shadow-lg shadow-green-600/20 hover:scale-[1.02] transition-all">
                    Rate & Review
                </button>
            @else
                <form action="{{ $base_url }}/events/cancel" method="POST">
                    <input type="hidden" name="id_event" value="{{ $event['id'] }}">
                    <button type="submit" class="w-full py-4 bg-slate-800 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-400 border border-slate-700 hover:bg-slate-700 transition-all">
                        Cancel RSVP
                    </button>
                </form>
            @endif
        </div>
        @endforeach
    </div>
</div>
@endsection
