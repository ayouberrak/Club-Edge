@extends('dashboards.president.layout')

@section('president_content')
<div class="glass p-8 rounded-3xl border border-white/5 animate-fadeIn">
    <h2 class="text-2xl font-bold mb-8">Active Members</h2>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-500 border-b border-slate-800 text-[10px] font-black uppercase tracking-widest">
                    <th class="py-4">Student Name</th>
                    <th class="py-4">Status</th>
                    <th class="py-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/40">
                @foreach($members as $member)
                <tr class="group hover:bg-white/5 transition-all">
                    <td class="py-5">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center font-bold text-slate-400 border border-white/5">
                                {{ substr($member['name'], 0, 1) }}
                            </div>
                            <div>
                                <div class="font-bold text-white group-hover:text-indigo-400 transition-colors">{{ $member['name'] }}</div>
                                <div class="text-xs text-slate-500 italic">{{ $member['email'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-5">
                        <span class="px-3 py-1 text-[10px] font-black uppercase rounded-lg {{ $member['role'] === 'President' ? 'bg-indigo-600 text-white' : 'bg-slate-700 text-slate-300' }}">
                            {{ $member['role'] }}
                        </span>
                    </td>
                    <td class="py-5 text-right">
                        @if($member['role'] !== 'President')
                        <button class="text-slate-500 hover:text-red-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
