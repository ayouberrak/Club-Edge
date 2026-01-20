@extends('layouts.main')

@section('content')
<div class="py-10 flex flex-col md:flex-row gap-8" x-data="{ showReviewModal: false, selectedEvent: null }">
    <!-- Sidebar -->
    <aside class="w-full md:w-64 space-y-4">
        <div class="glass p-6 rounded-2xl border border-slate-800">
            <div class="flex flex-col items-center mb-8">
                <div class="w-20 h-20 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 mb-4 flex items-center justify-center text-3xl font-bold shadow-lg shadow-green-500/20">
                    JD
                </div>
                <h3 class="text-xl font-bold">John Doe</h3>
                <p class="text-slate-500 text-sm">Student Participant</p>
                <div class="mt-2 px-3 py-1 bg-green-500/10 text-green-400 rounded-full text-[10px] font-bold uppercase tracking-widest border border-green-500/20">Verified</div>
            </div>
            
            <nav class="space-y-1">
                <a href="{{ $base_url }}/dashboard" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all {{ strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/events') === false && strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/articles') === false ? 'bg-green-500/10 text-green-400' : 'text-slate-400 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Overview</span>
                </a>
                <a href="{{ $base_url }}/dashboard/events" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all {{ strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/events') !== false ? 'bg-green-500/10 text-green-400' : 'text-slate-400 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>My Events</span>
                </a>
                <a href="{{ $base_url }}/dashboard/articles" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all {{ strpos($_SERVER['REQUEST_URI'] ?? '', '/dashboard/articles') !== false ? 'bg-green-500/10 text-green-400' : 'text-slate-400 hover:text-white' }}">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6"></path></svg>
                    <span>Articles</span>
                </a>
            </nav>
        </div>
        
        <!-- Quick Insight -->
        <div class="glass p-6 rounded-2xl border border-slate-800 text-sm">
            <h4 class="font-bold mb-2">Member Limit</h4>
            <div class="flex items-center space-x-2 text-slate-500 text-xs mb-3">
                <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                <span>You can only join **one** club at a time.</span>
            </div>
            <button class="w-full py-2 bg-slate-800 rounded-lg text-[10px] font-bold uppercase tracking-widest text-slate-400 border border-slate-700">Change Club</button>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow space-y-8">
        @yield('student_content')
    </main>

    <!-- Review Modal (Common for all student pages) -->
    <div x-show="showReviewModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak x-transition>
        <div class="glass w-full max-w-lg p-10 rounded-[2.5rem] border border-green-500/30 shadow-2xl shadow-green-500/10" @click.away="showReviewModal = false">
            <h2 class="text-3xl font-black text-white mb-2 leading-none uppercase tracking-tighter">Share Experience</h2>
            <p class="text-slate-500 text-sm mb-10">How was the <span x-text="selectedEvent" class="text-green-400 font-bold"></span>?</p>
            
            <form class="space-y-8">
                <div>
                    <label class="block text-[10px] font-black text-green-500 uppercase tracking-[0.3em] mb-4 text-center">Your Rating</label>
                    <div class="flex justify-center space-x-3">
                        <template x-for="i in 5">
                            <button type="button" class="w-12 h-12 rounded-2xl bg-slate-800 border border-slate-700 flex items-center justify-center text-slate-500 hover:text-yellow-400 hover:border-yellow-400 transition-all">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            </button>
                        </template>
                    </div>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-green-500 uppercase tracking-[0.3em] mb-3">Written Review</label>
                    <textarea class="w-full bg-slate-900 border border-slate-800 rounded-2xl px-5 py-4 text-white text-sm h-32 focus:border-green-500 focus:outline-none transition-all placeholder:italic" placeholder="Tell us what you liked (or didn't like)..."></textarea>
                </div>
                <div class="flex gap-4">
                    <button type="button" @click="showReviewModal = false" class="flex-1 py-4 text-slate-400 font-bold uppercase tracking-widest text-xs hover:text-white transition-colors">Maybe later</button>
                    <button type="button" @click="showReviewModal = false; $dispatch('toast', { message: 'Thanks for your feedback!', type: 'success' })" class="flex-[2] bg-green-600 py-4 rounded-2xl font-black text-white uppercase tracking-widest shadow-lg shadow-green-600/30 hover:scale-[1.02] transition-all">Submit Review</button>
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
