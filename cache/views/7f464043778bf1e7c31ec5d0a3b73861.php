

<?php $__env->startSection('content'); ?>
<div class="py-10 flex flex-col md:flex-row gap-8" x-data="{ activeTab: 'overview', showReviewModal: false, selectedEvent: null }">
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
                <button @click="activeTab = 'overview'" :class="activeTab === 'overview' ? 'bg-green-500/10 text-green-400' : 'text-slate-400 hover:text-white'" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                    <span>Overview</span>
                </button>
                <button @click="activeTab = 'events'" :class="activeTab === 'events' ? 'bg-green-500/10 text-green-400' : 'text-slate-400 hover:text-white'" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>My Events</span>
                </button>
                <button @click="activeTab = 'articles'" :class="activeTab === 'articles' ? 'bg-green-500/10 text-green-400' : 'text-slate-400 hover:text-white'" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6"></path></svg>
                    <span>Articles</span>
                </button>
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
        <!-- Tab: Overview -->
        <div x-show="activeTab === 'overview'" class="space-y-8 animate-fadeIn">
            <header>
                <h1 class="text-4xl font-bold text-white">Student Dashboard</h1>
                <p class="text-slate-400">Welcome back, check your current club status and event RSVPs.</p>
            </header>

            <!-- Stats -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="glass p-6 rounded-2xl border border-slate-800 border-l-4 border-l-green-500 shadow-xl shadow-green-500/5">
                    <div class="text-[10px] font-black uppercase text-slate-500 tracking-widest mb-2">Current Club</div>
                    <div class="text-2xl font-bold text-white"><?php echo e($my_club['name']); ?></div>
                </div>
                <div class="glass p-6 rounded-2xl border border-slate-800 border-l-4 border-l-blue-500">
                    <div class="text-[10px] font-black uppercase text-slate-500 tracking-widest mb-2">Upcoming Events</div>
                    <div class="text-3xl font-bold text-white">2</div>
                </div>
                <div class="glass p-6 rounded-2xl border border-slate-800 border-l-4 border-l-emerald-500">
                    <div class="text-[10px] font-black uppercase text-slate-500 tracking-widest mb-2">Reviews Left</div>
                    <div class="text-3xl font-bold text-white">1</div>
                </div>
            </div>

            <!-- My Club -->
            <div class="glass p-8 rounded-3xl border border-slate-800 relative overflow-hidden">
                <div class="flex flex-col md:flex-row items-center gap-8 relative z-10">
                    <img src="<?php echo e($my_club['image']); ?>" class="w-32 h-32 rounded-2xl object-cover shadow-2xl">
                    <div class="flex-grow text-center md:text-left">
                        <h2 class="text-3xl font-bold text-white mb-2"><?php echo e($my_club['name']); ?></h2>
                        <p class="text-slate-400 text-sm mb-6 max-w-md">You joined this club on <span class="text-green-400 font-bold"><?php echo e(date('M d, Y', strtotime($my_club['joined_at']))); ?></span>. You are an active member contributing to its growth.</p>
                        <div class="flex flex-wrap justify-center md:justify-start gap-3">
                            <span class="px-4 py-2 bg-slate-800 border border-slate-700 rounded-xl text-xs font-bold text-slate-300">Member #402</span>
                            <span class="px-4 py-2 bg-slate-800 border border-slate-700 rounded-xl text-xs font-bold text-slate-300"><?php echo e($my_club['members_count']); ?> Members</span>
                        </div>
                    </div>
                </div>
                <div class="absolute top-0 right-0 p-8">
                    <button @click="$dispatch('toast', { message: 'Request to leave club sent!', type: 'success' })" class="text-red-900 font-bold text-xs uppercase hover:text-red-500 transition-colors">Leave Club</button>
                </div>
            </div>
        </div>

        <!-- Tab: My Events -->
        <div x-show="activeTab === 'events'" class="space-y-8 animate-fadeIn">
            <h2 class="text-3xl font-bold">Event Registrations</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php $__currentLoopData = $registered_events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="glass p-6 rounded-3xl border border-slate-800 relative group">
                    <div class="flex justify-between items-start mb-6">
                        <div class="w-12 h-12 bg-slate-800 rounded-xl flex flex-col items-center justify-center border border-slate-700">
                            <span class="text-[10px] font-black uppercase text-blue-500">FEB</span>
                            <span class="text-lg font-bold text-white"><?php echo e(date('d', strtotime($event['date']))); ?></span>
                        </div>
                        <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase <?php echo e($event['status'] === 'upcoming' ? 'bg-blue-600/10 text-blue-400 border border-blue-500/20' : 'bg-slate-800 text-slate-500'); ?>">
                            <?php echo e($event['status']); ?>

                        </span>
                    </div>
                    <h3 class="text-xl font-bold mb-2 group-hover:text-green-400 transition-colors"><?php echo e($event['title']); ?></h3>
                    <p class="text-slate-500 text-sm mb-6 flex items-center">
                        <svg class="w-4 h-4 mr-1 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path></svg>
                        <?php echo e($event['location']); ?>

                    </p>
                    
                    <?php if($event['status'] === 'completed' && !$event['reviewed']): ?>
                    <button @click="selectedEvent = '<?php echo e($event['title']); ?>'; showReviewModal = true" class="w-full py-4 bg-green-600 rounded-2xl font-black text-xs uppercase tracking-widest text-white shadow-lg shadow-green-600/20 hover:scale-[1.02] transition-all">
                        Rate & Review
                    </button>
                    <?php elseif($event['status'] === 'upcoming'): ?>
                    <button @click="$dispatch('toast', { message: 'RSVP Cancelled!', type: 'error' })" class="w-full py-4 bg-slate-800 rounded-2xl font-black text-xs uppercase tracking-widest text-slate-400 border border-slate-700 hover:bg-slate-700 transition-all">
                        Cancel RSVP
                    </button>
                    <?php endif; ?>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Tab: Articles -->
        <div x-show="activeTab === 'articles'" class="space-y-8 animate-fadeIn">
            <h2 class="text-3xl font-bold text-white">Club Insights</h2>
            <div class="grid grid-cols-1 gap-6">
                <?php $__currentLoopData = $past_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="glass p-8 rounded-3xl border border-slate-800 hover:border-emerald-500/40 transition-all cursor-pointer">
                    <div class="flex items-center space-x-2 text-[10px] font-black text-emerald-500 uppercase tracking-widest mb-4">
                        <span><?php echo e($article['club']); ?></span>
                        <span>•</span>
                        <span><?php echo e($article['date']); ?></span>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4 leading-tight"><?php echo e($article['title']); ?></h3>
                    <p class="text-slate-400 text-sm mb-6 line-clamp-2">Discover how we are integrating advanced neural networks into our latest robotics project. Our team has spent weeks refining the algorithms for better balance...</p>
                    <div class="flex items-center text-emerald-400 text-xs font-bold uppercase tracking-widest">
                        Read Story 
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </main>

    <!-- Review Modal -->
    <div x-show="showReviewModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Club Edge\app\Views/dashboards/student.blade.php ENDPATH**/ ?>