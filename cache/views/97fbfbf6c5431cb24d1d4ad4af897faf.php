

<?php $__env->startSection('content'); ?>
<div class="py-10 flex flex-col md:flex-row gap-8" x-data="{ 
    showEventModal: false, 
    showArticleModal: false, 
    activeTab: 'members', 
    articleEventTitle: '',
    openArticleFor(title) {
        this.articleEventTitle = title;
        this.showArticleModal = true;
    }
}">
    <!-- Sidebar -->
    <aside class="w-full md:w-64 space-y-4">
        <div class="glass p-6 rounded-2xl border border-slate-800">
            <div class="flex flex-col items-center mb-6">
                <div class="relative">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 mb-4 flex items-center justify-center text-3xl font-bold">
                        AE
                    </div>
                </div>
                <h3 class="text-xl font-bold">Anas Errak</h3>
                <p class="text-indigo-400 text-sm font-semibold">Club President</p>
                <p class="text-slate-500 text-xs">Robotics Club</p>
            </div>
            <nav class="space-y-2">
                <button @click="activeTab = 'members'" :class="activeTab === 'members' ? 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20' : 'text-slate-400 hover:text-white'" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    <span>Members</span>
                </button>
                <button @click="activeTab = 'events'" :class="activeTab === 'events' ? 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20' : 'text-slate-400 hover:text-white'" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    <span>Club Events</span>
                </button>
                <button @click="activeTab = 'articles'" :class="activeTab === 'articles' ? 'bg-indigo-500/10 text-indigo-400 border border-indigo-500/20' : 'text-slate-400 hover:text-white'" class="w-full flex items-center space-x-3 p-3 rounded-xl font-semibold transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 2v6h6"></path></svg>
                    <span>Manage Articles</span>
                </button>
            </nav>
            <div class="mt-8 space-y-3">
                <button @click="showEventModal = true" class="w-full btn-gradient py-3 rounded-xl font-bold flex items-center justify-center space-x-2 text-sm shadow-lg shadow-indigo-500/20">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    <span>New Event</span>
                </button>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <div class="flex-grow space-y-8">
        <!-- Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h1 class="text-4xl font-bold font-outfit tracking-tighter uppercase">Club <span class="text-indigo-500">Nexus</span></h1>
                <p class="text-slate-400 text-sm">Managing the **<?php echo e($club['name']); ?>** universe.</p>
            </div>
            <div class="flex items-center space-x-3 glass p-2 rounded-2xl border border-white/5">
                <div class="px-4 py-2 bg-indigo-500/20 text-indigo-400 rounded-xl text-xs font-black">
                    <?php echo e($club['members_count']); ?> / <?php echo e($club['max_members']); ?> CAPACITY
                </div>
            </div>
        </div>

        <!-- Members Tab -->
        <div x-show="activeTab === 'members'" class="glass p-8 rounded-3xl border border-white/5 animate-fadeIn">
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
                        <?php $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="group hover:bg-white/5 transition-all">
                            <td class="py-5">
                                <div class="flex items-center space-x-3">
                                    <div class="w-10 h-10 rounded-xl bg-slate-800 flex items-center justify-center font-bold text-slate-400 border border-white/5">
                                        <?php echo e(substr($member['name'], 0, 1)); ?>

                                    </div>
                                    <div>
                                        <div class="font-bold text-white group-hover:text-indigo-400 transition-colors"><?php echo e($member['name']); ?></div>
                                        <div class="text-xs text-slate-500 italic"><?php echo e($member['email']); ?></div>
                                    </div>
                                </div>
                            </td>
                            <td class="py-5">
                                <span class="px-3 py-1 text-[10px] font-black uppercase rounded-lg <?php echo e($member['role'] === 'President' ? 'bg-indigo-600 text-white' : 'bg-slate-700 text-slate-300'); ?>">
                                    <?php echo e($member['role']); ?>

                                </span>
                            </td>
                            <td class="py-5 text-right">
                                <?php if($member['role'] !== 'President'): ?>
                                <button class="text-slate-500 hover:text-red-400 transition-colors">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                </button>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Events Tab -->
        <div x-show="activeTab === 'events'" class="space-y-6 animate-fadeIn">
            <h2 class="text-2xl font-bold">Planned & History</h2>
            <div class="grid grid-cols-1 gap-4">
                <!-- Upcoming -->
                <?php $__currentLoopData = $events; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $event): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="glass p-6 rounded-3xl border border-white/5 flex flex-col md:flex-row items-center gap-6 group hover:border-indigo-500/20 transition-all">
                    <img src="<?php echo e($event['image']); ?>" class="w-32 h-24 rounded-2xl object-cover">
                    <div class="flex-grow">
                        <div class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1">Upcoming • <?php echo e($event['date']); ?></div>
                        <h3 class="text-xl font-bold uppercase"><?php echo e($event['title']); ?></h3>
                        <p class="text-slate-500 text-sm"><?php echo e($event['participants']); ?> students registered</p>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <!-- Past (Article Trigger) -->
                <div class="relative py-4">
                    <div class="absolute inset-0 flex items-center"><div class="w-full border-t border-slate-800"></div></div>
                    <div class="relative flex justify-center"><span class="bg-slate-950 px-4 text-xs font-black text-slate-600 uppercase">Past Events (Needs Report)</span></div>
                </div>

                <div class="glass p-6 rounded-3xl border border-white/5 flex flex-col md:flex-row items-center gap-6 bg-slate-900/20 grayscale hover:grayscale-0 transition-all">
                    <div class="w-32 h-24 rounded-2xl bg-slate-800 flex items-center justify-center">
                        <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div class="flex-grow">
                        <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Completed • Jan 10, 2026</div>
                        <h3 class="text-xl font-bold uppercase">Tech Summit V1</h3>
                        <p class="text-slate-400 text-sm">Event finished. Share the results with an article.</p>
                    </div>
                    <button @click="openArticleFor('Tech Summit V1')" class="px-8 py-3 bg-indigo-600 rounded-2xl text-xs font-black uppercase tracking-widest text-white hover:bg-indigo-500 shadow-xl shadow-indigo-600/20 transition-all">
                        Write Article
                    </button>
                </div>
            </div>
        </div>

        <!-- Articles Tab -->
        <div x-show="activeTab === 'articles'" class="animate-fadeIn space-y-6">
            <h2 class="text-2xl font-bold">Published Stories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Mock Article -->
                <div class="glass p-6 rounded-3xl border border-white/5 space-y-4">
                    <div class="h-32 bg-slate-800 rounded-2xl overflow-hidden relative">
                        <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b" class="w-full h-full object-cover opacity-50">
                        <div class="absolute inset-0 flex items-center justify-center font-black text-xs uppercase tracking-widest text-white">Robotics Unleashed</div>
                    </div>
                    <h3 class="font-bold">The success of our first Hackathon</h3>
                    <p class="text-slate-500 text-xs">Published 2 days ago</p>
                    <div class="flex gap-2">
                        <button class="text-xs text-indigo-400 font-bold uppercase hover:underline">Edit</button>
                        <button class="text-xs text-red-900 font-bold uppercase hover:underline">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    
    <!-- New Event Modal -->
    <div x-show="showEventModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak>
        <div class="glass w-full max-w-xl p-10 rounded-[2.5rem] border border-white/10" @click.away="showEventModal = false">
            <h2 class="text-3xl font-black mb-10 uppercase tracking-tighter">Schedule <span class="text-indigo-500">Event</span></h2>
            <form class="space-y-6">
                <input type="text" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none" placeholder="Event Name">
                <input type="date" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none">
                <textarea class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none h-32" placeholder="Description"></textarea>
                <button type="button" @click="showEventModal = false; $dispatch('toast', { message: 'Event successfully created!', type: 'success' })" class="w-full btn-gradient py-5 rounded-2xl font-black text-lg shadow-2xl shadow-indigo-600/20">PUBLISH EVENT</button>
            </form>
        </div>
    </div>

    <!-- Article Modal -->
    <div x-show="showArticleModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak>
        <div class="glass w-full max-w-2xl p-10 rounded-[2.5rem] border border-white/10" @click.away="showArticleModal = false">
            <h2 class="text-2xl font-black mb-4 uppercase tracking-tighter">Post-Event <span class="text-indigo-500">Article</span></h2>
            <p class="text-slate-500 text-sm mb-10">Sharing insights for: <span x-text="articleEventTitle" class="text-white font-bold italic"></span></p>
            <form class="space-y-6">
                <input type="text" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none" placeholder="Article Catchy Title">
                <textarea class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none h-48" placeholder="Tell the world what happened..."></textarea>
                <div class="flex gap-4">
                    <button type="button" @click="showArticleModal = false" class="flex-1 py-4 text-slate-500 font-bold uppercase tracking-widest text-xs">Discard</button>
                    <button type="button" @click="showArticleModal = false; activeTab = 'articles'; $dispatch('toast', { message: 'Article published for everyone!', type: 'success' })" class="flex-[3] bg-indigo-600 py-4 rounded-2xl font-black text-white uppercase tracking-widest shadow-xl shadow-indigo-600/20">POST STORY</button>
                </div>
            </form>
        </div>
    </div>

</div>

<style>
    [x-cloak] { display: none !important; }
    .animate-fadeIn { animation: fadeIn 0.4s ease-out forwards; }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\Club Edge\app\Views/dashboards/president.blade.php ENDPATH**/ ?>