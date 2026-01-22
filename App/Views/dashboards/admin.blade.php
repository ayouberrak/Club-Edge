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
                    {{ $stats['total_clubs'] ?? 0 }}
                    <span class="ml-2 text-[10px] text-green-400">+1 new</span>
                </div>
            </div>
            <div class="glass p-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-indigo-500/5 to-transparent">
                <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Users</div>
                <div class="text-3xl font-bold">{{ $stats['total_students'] ?? 0 }}</div>
            </div>
            <div class="glass p-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-yellow-500/5 to-transparent">
                <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Reviews</div>
                <div class="text-3xl font-bold text-yellow-500">{{ $stats['pending_reviews'] ?? 0 }}</div>
            </div>
            <div class="glass p-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-green-500/5 to-transparent">
                <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Active Events</div>
                <div class="text-3xl font-bold text-green-500">{{ $stats['active_events'] ?? 0 }}</div>
            </div>
        </div>

        <!-- Section: Manage Clubs -->
        <div x-show="activeSection === 'clubs'" class="space-y-6 animate-fadeIn">
            <div class="flex justify-between items-end">
                <h2 class="text-3xl font-bold">Platform Clubs <span class="text-slate-500 text-lg">({{ count($clubs ?? []) }})</span></h2>
                <div class="text-xs text-slate-500 italic">Target: 4-6 clubs per establishment</div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach($clubs ?? [] as $club)
                <div class="glass p-6 rounded-3xl border border-slate-800 relative overflow-hidden group hover:border-blue-500/40 transition-all cursor-pointer" onclick="window.location.href='{{ $base_url }}/dashboard/admin/club/{{ $club['id_club'] }}'">
                    <div class="flex justify-between items-start mb-6 relative z-10">
                        <div class="flex items-start gap-4">
                            <div class="relative shrink-0">
                                <div class="w-16 h-16 rounded-2xl overflow-hidden border-2 border-slate-700 shadow-lg group-hover:border-blue-500/50 transition-colors">
                                    <img src="{{ $base_url }}/public/assets/img/{{ $club['image_url'] }}" alt="{{ $club['nom'] }}" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                </div>
                                <div class="absolute -bottom-1 -right-1 w-4 h-4 rounded-full border-2 border-slate-900 {{ ($club['club_members'] >= $club['max_membres'] && $club['max_membres'] > 0) ? 'bg-red-500' : 'bg-green-500' }}"></div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold leading-tight group-hover:text-blue-400 transition-colors">{{ $club['nom'] }}</h3>
                                <p class="text-xs text-slate-500 mt-1 uppercase tracking-tighter">President: <span class="{{ $club['id_president'] ? 'text-slate-300' : 'text-yellow-500' }} font-bold">{{ $club['president'] ?? 'Not Assigned' }}</span></p>
                            </div>
                        </div>
                        <div class="flex gap-2" @click.stop>
                            <button type="button" class="formunlleModifier w-9 h-9 flex items-center justify-center rounded-xl bg-slate-800 border border-slate-700 hover:bg-blue-600 hover:text-white transition-all" data-clubid="{{ $club['id_club'] }}"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg></button>
                            <a href="{{ $base_url }}/dashboard/admin/club/delete/{{ $club['id_club'] }}" class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-800 border border-slate-700 hover:bg-red-600 hover:text-white transition-all"><svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg></a>
                        </div>
                    </div>
                    
                    <div class="space-y-4 relative z-10">
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-bold uppercase tracking-widest text-slate-500">
                                <span>Members Capacity</span>
                                <span class="{{ ($club['club_members'] >= $club['max_membres'] && $club['max_membres'] > 0) ? 'text-red-400' : 'text-blue-400' }}">{{ $club['club_members'] }} / {{ $club['max_membres'] }}</span>
                            </div>
                            <div class="w-full bg-slate-800 h-2 rounded-full overflow-hidden flex">
                                <div class="h-full {{ ($club['club_members'] >= $club['max_membres'] && $club['max_membres'] > 0) ? 'bg-red-500' : 'bg-blue-500' }}" style="width: {{ ($club['max_membres'] > 0) ? ($club['club_members'] / $club['max_membres'] * 100) : 0 }}%"></div>
                            </div>
                        </div>
                        <div class="flex justify-between items-center mt-4 border-t border-slate-800 pt-3">
                            <span class="text-[10px] text-slate-500">Created: {{ $club['created_at'] ?? '2024' }}</span>
                            <span class="text-[10px] font-black text-blue-500 uppercase tracking-widest group-hover:translate-x-1 transition-transform">View Profile →</span>
                        </div>
                    </div>
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
                        @foreach($students ?? [] as $student)
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
                                    <a href="{{ $base_url }}/dashboard/admin/student/delete/{{ $student['id'] }}" onclick="return confirm('Are you sure you want to ban/delete this student?');" class="text-red-900 font-bold text-xs uppercase hover:text-red-500 transition-colors">Ban</a>
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
            </div>
        </div>
    </main>

    <!-- Modal Club Creation -->
    <div x-show="showClubModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak x-transition>
        <div class="glass w-full max-w-lg p-10 rounded-[2.5rem] border border-blue-500/30 shadow-[0_0_50px_rgba(37,99,235,0.1)]" @click.away="showClubModal = false">
            <h2 class="text-3xl font-black text-white mb-2 leading-none uppercase tracking-tighter">Initialize Club</h2>
            <p class="text-slate-500 text-sm mb-10">Assign a new department to the establishment.</p>

            <form class="space-y-4" method="post" action="{{ $base_url }}/dashboard/admin/club/create" enctype="multipart/form-data">
                <div>
                    <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Club Designation</label>
                    <input type="text" name="nom" class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white font-bold focus:border-blue-500 focus:outline-none transition-all text-sm" placeholder="e.g. AI Research Center" required maxlength="100">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Mission Statement</label>
                    <textarea name="description" class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white text-sm h-24 focus:border-blue-500 focus:outline-none transition-all placeholder:italic resize-none" placeholder="Define the club's main objective..."></textarea>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Max Members</label>
                        <input type="number" name="max_membres" value="8" class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white font-bold focus:border-blue-500 focus:outline-none transition-all text-sm" required min="6" max="8">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">President</label>
                        <select name="id_president" class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white font-bold focus:border-blue-500 focus:outline-none transition-all appearance-none cursor-pointer text-sm">
                            <option value="" class="bg-slate-900">Select...</option>
                            @foreach($potentialPresidents ?? [] as $user)
                            <option value="{{ $user['id_user'] }}" class="bg-slate-900">{{ $user['nom'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Club Image</label>
                    <input type="file" name="image_url" accept="image/*" class="hidden" id="clubImageInput">
                    <label for="clubImageInput" class="flex items-center justify-center w-full bg-slate-900/50 border-2 border-slate-800 border-dashed rounded-2xl px-4 py-5 text-slate-500 font-bold cursor-pointer hover:border-blue-500 transition-all group">
                        <div class="text-center">
                            <svg class="w-8 h-8 mx-auto mb-2 text-slate-600 group-hover:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            <span class="text-xs uppercase tracking-wider">Upload Image</span>
                        </div>
                    </label>
                </div>

                <div class="flex gap-3 pt-2">
                    <button type="button" @click="showClubModal = false" class="flex-1 py-3 text-slate-400 font-bold uppercase tracking-widest text-xs hover:text-white transition-colors">Cancel</button>
                    <button type="submit" class="flex-[2] bg-blue-600 py-3 rounded-2xl font-black text-white uppercase tracking-widest text-sm shadow-lg shadow-blue-600/30 hover:scale-[1.02] active:scale-[0.98] transition-all">Confirm Activation</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Modify Club -->
<div id="modifyClubModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md">
    <div class="glass w-full max-w-lg p-10 rounded-[2.5rem] border border-blue-500/30 shadow-[0_0_50px_rgba(37,99,235,0.1)]">
        <h2 class="text-3xl font-black text-white mb-2 leading-none uppercase tracking-tighter">Modify Club</h2>
        <p class="text-slate-500 text-sm mb-10">Update club information.</p>

        <form id="modifyClubForm" class="space-y-4" enctype="multipart/form-data" method="post" action="{{ $base_url }}/dashboard/admin/club/update">
            <input type="hidden" name="id" id="club_id">
            <div>
                <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Club Designation</label>
                <input type="text" name="nom" id="club_nom" class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white font-bold focus:border-blue-500 focus:outline-none transition-all text-sm" required maxlength="100">
            </div>

            <div>
                <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Mission Statement</label>
                <textarea name="description" id="club_description" class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white text-sm h-24 focus:border-blue-500 focus:outline-none transition-all resize-none"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Max Members</label>
                    <input type="number" name="max_membres" id="club_max" class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white font-bold focus:border-blue-500 focus:outline-none transition-all text-sm" min="6" max="8">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">President</label>
                    <select name="id_president" id="club_president" class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white font-bold focus:border-blue-500 focus:outline-none transition-all appearance-none cursor-pointer text-sm">
                        <option value="">Select...</option>
                        @foreach($potentialPresidents ?? [] as $user)
                        <option value="{{ $user['id_user'] }}" class="bg-slate-900">{{ $user['nom'] }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Club Image</label>
                <input type="file" name="image_url" accept="image/*" class="hidden" id="clubImageInputmodifier">
                <label for="clubImageInputmodifier" class="flex items-center justify-center w-full bg-slate-900/50 border-2 border-slate-800 border-dashed rounded-2xl px-4 py-5 text-slate-500 font-bold cursor-pointer hover:border-blue-500 transition-all">Upload New Image</label>
            </div>

            <div class="flex gap-3 pt-2">
                <button type="button" id="closeModalBtn" class="flex-1 py-3 text-slate-400 font-bold uppercase tracking-widest text-xs hover:text-white transition-colors">Cancel</button>
                <button type="submit" class="flex-[2] bg-blue-600 py-3 rounded-2xl font-black text-white uppercase tracking-widest text-sm shadow-lg shadow-blue-600/30 hover:scale-[1.02] transition-all">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        let modificationBtns = document.querySelectorAll('.formunlleModifier');
        const modal = document.getElementById('modifyClubModal');

        modificationBtns.forEach(ele => {
            ele.addEventListener('click', (e) => {
                const clubid = e.currentTarget.dataset.clubid;
                // alert('Fetching data for club: ' + clubid); // Debug
                fetch(`{{ $base_url }}/dashboard/admin/club/edit/${clubid}`)
                    .then(rep => {
                        if (!rep.ok) throw new Error('Network response was not ok');
                        return rep.json();
                    })
                    .then(data => {
                        openModifyModal(data);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Error loading club data. Please check logs.');
                    });
            });
        });

        function openModifyModal(clubData) {
            modal.classList.remove('hidden');
            modal.style.display = 'flex';
            document.getElementById('club_id').value = clubData.id_club || '';
            document.getElementById('club_nom').value = clubData.nom || '';
            document.getElementById('club_description').value = clubData.description || '';
            document.getElementById('club_max').value = clubData.max_membres || '';
            document.getElementById('club_president').value = clubData.id_president || '';
        }

        document.getElementById('closeModalBtn').addEventListener('click', () => {
            modal.style.display = 'none';
            modal.classList.add('hidden');
        });
    });
</script>

<style>
    [x-cloak] { display: none !important; }
    .animate-fadeIn { animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1); }
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.98) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
</style>

@endsection