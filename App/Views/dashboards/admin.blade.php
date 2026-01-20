@extends('layouts.main')

@section('content')
<div class="py-10 flex flex-col lg:flex-row gap-8" x-data="{ 
    activeSection: 'clubs', 
    showClubModal: false, 
    showStudentModal: false
}">
    <!-- Admin Sidebar -->
    <aside class="w-full lg:w-72 space-y-6">
        <div class="glass p-6 rounded-3xl border border-blue-500/20">
            <div class="flex items-center space-x-3 mb-10">
                <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-500/30">
                    A
                </div>
                <div>
                    <h2 class="text-xl font-bold text-white leading-tight">Admin Central</h2>
                    <p class="text-blue-400 text-xs font-bold uppercase tracking-widest">Platform Manager</p>
                </div>
            </div>
            
            <nav class="space-y-1">
                <button @click="activeSection = 'clubs'" :class="activeSection === 'clubs' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:text-white'" class="w-full flex items-center space-x-3 p-4 rounded-2xl transition-all font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    <span>Manage Clubs</span>
                </button>
                <button @click="activeSection = 'students'" :class="activeSection === 'students' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:text-white'" class="w-full flex items-center space-x-3 p-4 rounded-2xl transition-all font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Manage Students</span>
                </button>
                <button @click="activeSection = 'logs'" :class="activeSection === 'logs' ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:text-white'" class="w-full flex items-center space-x-3 p-4 rounded-2xl transition-all font-bold">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    <span>System Logs</span>
                </button>
            </nav>
            
            <div class="mt-10 pt-6 border-t border-slate-800">
                <button @click="showClubModal = true" class="w-full bg-white text-slate-900 py-4 rounded-2xl font-black text-xs uppercase tracking-tighter hover:bg-blue-50 transition-colors">
                    + Create New Club
                </button>
            </div>
        </div>
        
        <!-- Server Status -->
        <div class="glass p-5 rounded-2xl border border-slate-800 flex justify-between items-center text-xs">
            <div class="flex items-center text-slate-400 font-bold uppercase tracking-widest">
                <span class="w-2 h-2 bg-green-500 rounded-full mr-2 animate-pulse"></span>
                System Healthy
            </div>
            <div class="text-slate-500 font-mono">v1.2.0-stable</div>
        </div>
    </aside>

    <!-- Main View -->
    <main class="flex-grow space-y-8">
        <!-- Stats Overview -->
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="glass p-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-blue-500/5 to-transparent">
                <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Clubs</div>
                <div class="text-3xl font-bold flex items-center">
                    {{ $stats['total_clubs'] }}
                    <span class="ml-2 text-[10px] text-green-400">+1 new</span>
                </div>
            </div>
            <div class="glass p-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-indigo-500/5 to-transparent">
                <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Users</div>
                <div class="text-3xl font-bold">{{ $stats['total_students'] }}</div>
            </div>
            <div class="glass p-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-yellow-500/5 to-transparent">
                <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Reviews</div>
                <div class="text-3xl font-bold text-yellow-500">{{ $stats['pending_reviews'] }}</div>
            </div>
            <div class="glass p-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-green-500/5 to-transparent">
                <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Active Events</div>
                <div class="text-3xl font-bold text-green-500">{{ $stats['active_events'] }}</div>
            </div>
        </div>

        <!-- Section: Manage Clubs -->
        <div x-show="activeSection === 'clubs'" class="space-y-6 animate-fadeIn">
            <div class="flex justify-between items-end">
                <h2 class="text-3xl font-bold">Platform Clubs <span class="text-slate-500 text-lg">({{ count($clubs) }})</span></h2>
                <div class="text-xs text-slate-500 italic">Target: 4-6 clubs per establishment</div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($clubs as $club)
                <div class="glass p-6 rounded-3xl border border-slate-800 relative overflow-hidden group hover:border-blue-500/40 transition-all cursor-pointer" onclick="window.location.href='{{ $base_url }}/dashboard/admin/club/{{ $club['id'] }}'">
                    <div class="flex justify-between items-start mb-8 relative z-10">
                        <div>
                            <h3 class="text-xl font-bold leading-tight group-hover:text-blue-400 transition-colors">{{ $club['name'] }}</h3>
                            <p class="text-xs text-slate-500 mt-1 uppercase tracking-tighter">President: <span class="text-slate-300 font-bold">{{ $club['president'] }}</span></p>
                        </div>
                        <div class="flex gap-2" @click.stop>
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
                                <div class="h-full {{ $club['status'] === 'full' ? 'bg-red-500' : 'bg-blue-500' }}" style="width: {{ ($club['members'] / $club['capacity']) * 100 }}%"></div>
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

        <!-- Section: Manage Students -->
        <div x-show="activeSection === 'students'" class="glass p-8 rounded-3xl border border-slate-800 animate-fadeIn overflow-hidden">
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

        <!-- Section: Logs -->
        <div x-show="activeSection === 'logs'" class="glass p-8 rounded-3xl border border-slate-800 animate-fadeIn">
            <h2 class="text-2xl font-bold mb-6">Security & Activity Logs</h2>
            <div class="space-y-3 font-mono text-xs text-slate-400">
                <div class="p-3 bg-slate-900/80 rounded-xl border border-slate-800 flex items-center">
                    <span class="text-blue-500 mr-4">[INFO]</span>
                    <span class="text-slate-500 mr-4">{{ date('H:i:s') }}</span>
                    <span>Admin connected from 192.168.1.1</span>
                </div>
                <div class="p-3 bg-slate-900/80 rounded-xl border border-slate-800 flex items-center">
                    <span class="text-green-500 mr-4">[SUCCESS]</span>
                    <span class="text-slate-500 mr-4">{{ date('H:i:s', strtotime('-5 mins')) }}</span>
                    <span>New club "Gaming Hub" successfully created.</span>
                </div>
                <div class="p-3 bg-slate-900/80 rounded-xl border border-slate-800 flex items-center">
                    <span class="text-yellow-500 mr-4">[WARNING]</span>
                    <span class="text-slate-500 mr-4">{{ date('H:i:s', strtotime('-12 mins')) }}</span>
                    <span>Suspicious login attempt for user #102.</span>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal Club Creation -->
    <div x-show="showClubModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak x-transition>
        <div class="glass w-full max-w-lg p-10 rounded-[2.5rem] border border-blue-500/30 shadow-[0_0_50px_rgba(37,99,235,0.1)]" @click.away="showClubModal = false">
            <h2 class="text-3xl font-black text-white mb-2 leading-none uppercase tracking-tighter">Initialize Club</h2>
            <p class="text-slate-500 text-sm mb-10">Assign a new department to the establishment.</p>
            
            <form class="space-y-6">
                <div>
                    <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-3">Club Designation</label>
                    <input type="text" class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-5 py-4 text-white font-bold focus:border-blue-500 focus:outline-none transition-all" placeholder="e.g. AI Research Center">
                </div>
                <div>
                    <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-3">Mission Statement</label>
                    <textarea class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-5 py-4 text-white text-sm h-32 focus:border-blue-500 focus:outline-none transition-all placeholder:italic" placeholder="Define the club's main objective..."></textarea>
                </div>
                <div class="flex gap-4">
                    <button type="button" @click="showClubModal = false" class="flex-1 py-4 text-slate-400 font-bold uppercase tracking-widest text-xs hover:text-white transition-colors">Cancel</button>
                    <button type="button" @click="showClubModal = false; $dispatch('toast', { message: 'Club initialized successfully', type: 'success' })" class="flex-[2] bg-blue-600 py-4 rounded-2xl font-black text-white uppercase tracking-widest shadow-lg shadow-blue-600/30 hover:scale-[1.02] active:scale-[0.98] transition-all">Confirm Activation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<style>
    [x-cloak] { display: none !important; }
    .animate-fadeIn { animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.98) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
</style>
@endsection
