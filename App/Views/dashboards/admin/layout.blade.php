@extends('layouts.main')

@section('content')
    <div class="py-10 flex flex-col lg:flex-row gap-8" x-data="{ 
        showClubModal: false, 
        showStudentModal: false
    }">
        <!-- Admin Sidebar -->
        <aside class="w-full lg:w-72 space-y-6">
            <div class="glass p-6 rounded-3xl border border-blue-500/20">
                <div class="flex items-center space-x-3 mb-10">
                    <div
                        class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-xl shadow-lg shadow-blue-500/30">
                        A
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-white leading-tight">Admin Central</h2>
                        <p class="text-blue-400 text-xs font-bold uppercase tracking-widest">Platform Manager</p>
                    </div>
                </div>

                <nav class="space-y-1">
                    <a href="{{ $base_url }}/dashboard/admin"
                        class="w-full flex items-center space-x-3 p-4 rounded-2xl transition-all font-bold {{ strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/admin/students') === false && strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/admin/logs') === false && strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/admin/club/') === false ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        <span>Manage Clubs</span>
                    </a>
                    <a href="{{ $base_url }}/dashboard/admin/students"
                        class="w-full flex items-center space-x-3 p-4 rounded-2xl transition-all font-bold {{ strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/admin/students') !== false ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z">
                            </path>
                        </svg>
                        <span>Manage Students</span>
                    </a>
                    <a href="{{ $base_url }}/dashboard/admin/logs"
                        class="w-full flex items-center space-x-3 p-4 rounded-2xl transition-all font-bold {{ strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/admin/logs') !== false ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/20' : 'text-slate-400 hover:text-white' }}">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                            </path>
                        </svg>
                        <span>System Logs</span>
                    </a>
                </nav>

                <div class="mt-10 pt-6 border-t border-slate-800">
                    <button @click="showClubModal = true"
                        class="w-full bg-white text-slate-900 py-4 rounded-2xl font-black text-xs uppercase tracking-tighter hover:bg-blue-50 transition-colors">
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
                <div
                    class="glass p-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-indigo-500/5 to-transparent">
                    <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Users</div>
                    <div class="text-3xl font-bold">{{ $stats['total_students'] }}</div>
                </div>
                <div
                    class="glass p-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-yellow-500/5 to-transparent">
                    <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Reviews</div>
                    <div class="text-3xl font-bold text-yellow-500">{{ $stats['pending_reviews'] }}</div>
                </div>
                <div
                    class="glass p-6 rounded-3xl border border-slate-800 bg-gradient-to-br from-green-500/5 to-transparent">
                    <div class="text-slate-500 text-[10px] font-black uppercase tracking-widest mb-2">Active Events</div>
                    <div class="text-3xl font-bold text-green-500">{{ $stats['active_events'] }}</div>
                </div>
            </div>

            @yield('admin_content')
        </main>

        <!-- Modal Club Creation (Common for all admin pages) -->
        <div x-show="showClubModal"
            class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak
            x-transition>
            <div class="glass w-full max-w-lg p-10 rounded-[2.5rem] border border-blue-500/30 shadow-[0_0_50px_rgba(37,99,235,0.1)]"
                @click.away="showClubModal = false">
                <h2 class="text-3xl font-black text-white mb-2 leading-none uppercase tracking-tighter">Initialize Club</h2>
                <p class="text-slate-500 text-sm mb-10">Assign a new department to the establishment.</p>

                <form class="space-y-4" method="post" action="creat/club" enctype="multipart/form-data" >
                    <div>
                        <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Club
                            Designation</label>
                        <input type="text" name="nom"
                            class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white font-bold focus:border-blue-500 focus:outline-none transition-all text-sm"
                            placeholder="e.g. AI Research Center" required maxlength="100">
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Mission
                            Statement</label>
                        <textarea name="description"
                            class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white text-sm h-24 focus:border-blue-500 focus:outline-none transition-all placeholder:italic resize-none"
                            placeholder="Define the club's main objective..."></textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Max
                                Members</label>
                            <input type="number" name="max_membres" value="8"
                                class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white font-bold focus:border-blue-500 focus:outline-none transition-all text-sm"
                                required min="1">
                        </div>

                        <div>
                            <label
                                class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">President</label>
                            <select name="id_president"
                                class="w-full bg-slate-900/50 border-2 border-slate-800 rounded-2xl px-4 py-3 text-white font-bold focus:border-blue-500 focus:outline-none transition-all appearance-none cursor-pointer text-sm"
                                >
                                <option value="" class="bg-slate-900">Select...</option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-blue-500 uppercase tracking-[0.3em] mb-2">Club
                            Image</label>
                        <input type="file" name="image_url" accept="image/*" class="hidden" id="clubImageInput">
                        <label for="clubImageInput"
                            class="flex items-center justify-center w-full bg-slate-900/50 border-2 border-slate-800 border-dashed rounded-2xl px-4 py-5 text-slate-500 font-bold cursor-pointer hover:border-blue-500 transition-all group">
                            <div class="text-center">
                                <svg class="w-8 h-8 mx-auto mb-2 text-slate-600 group-hover:text-blue-500 transition-colors"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <span class="text-xs uppercase tracking-wider">Upload Image</span>
                            </div>
                        </label>
                    </div>

                    <div class="flex gap-3 pt-2">
                        <button type="button" @click="showClubModal = false"
                            class="flex-1 py-3 text-slate-400 font-bold uppercase tracking-widest text-xs hover:text-white transition-colors">
                            Cancel
                        </button>
                        <button type="submit"
                            class="flex-[2] bg-blue-600 py-3 rounded-2xl font-black text-white uppercase tracking-widest text-sm shadow-lg shadow-blue-600/30 hover:scale-[1.02] active:scale-[0.98] transition-all">
                            Confirm Activation
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        [x-cloak] {
            display: none !important;
        }

        .animate-fadeIn {
            animation: fadeIn 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: scale(0.98) translateY(10px);
            }

            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }
    </style>
@endsection