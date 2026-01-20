@extends('dashboards.admin.layout')

@section('admin_content')
<div class="glass p-8 rounded-3xl border border-slate-800 animate-fadeIn overflow-hidden">
    <div class="flex justify-between items-center mb-10">
        <h2 class="text-2xl font-bold">Student Directory</h2>
        <div class="flex bg-slate-900 rounded-xl p-1 border border-slate-800">
            <input type="text" placeholder="Search student..." class="bg-transparent px-4 py-2 text-sm text-white focus:outline-none w-48">
            <button class="bg-blue-600 p-2 rounded-lg text-white"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg></button>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="text-slate-500 text-[10px] font-black uppercase tracking-[0.2em] border-b border-slate-800">
                    <th class="py-4">Student</th>
                    <th class="py-4">ID</th>
                    <th class="py-4">Assigned Club</th>
                    <th class="py-4">Manage</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/50">
                @foreach($students as $student)
                <tr class="hover:bg-slate-800/30 transition-colors group">
                    <td class="py-6">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 rounded-full bg-slate-800 border-2 border-slate-700 flex items-center justify-center">
                                <svg class="w-5 h-5 text-slate-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                            </div>
                            <div>
                                <div class="font-bold text-white group-hover:text-blue-400 transition-colors">{{ $student['name'] }}</div>
                                <div class="text-[10px] text-slate-500">{{ $student['email'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="py-6 font-mono text-xs text-slate-400">#{{ $student['id'] }}</td>
                    <td class="py-6">
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $student['club'] === 'None' ? 'bg-slate-800 text-slate-500' : 'bg-blue-600/10 text-blue-400 border border-blue-500/20' }}">
                            {{ $student['club'] }}
                        </span>
                    </td>
                    <td class="py-6">
                        <div class="flex items-center space-x-4">
                            <button @click="$dispatch('toast', { message: 'Student profile updated', type: 'success' })" class="text-blue-400 hover:underline text-xs font-bold uppercase tracking-widest">Edit</button>
                            <button @click="$dispatch('toast', { message: 'Student banned from platform', type: 'error' })" class="text-red-900 font-bold text-xs uppercase hover:text-red-500 transition-colors">Ban</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
