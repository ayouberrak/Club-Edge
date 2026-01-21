<?php $__env->startSection('content'); ?>
<div x-data="{ activeCategory: 'all', 
             filterClubs(category) {
                this.activeCategory = category;
             } 
           }">
    <!-- Hero Section -->
    <div class="relative min-h-[85vh] flex items-center justify-center overflow-hidden">
        <!-- Animated background patterns -->
        <div class="absolute inset-0 pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-indigo-600/20 rounded-full blur-[120px] animate-pulse"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-purple-600/20 rounded-full blur-[120px] animate-pulse" style="animation-delay: 2s;"></div>
        </div>

        <div class="container mx-auto px-6 relative z-10">
            <div class="max-w-5xl mx-auto text-center space-y-12">
                <div class="inline-flex items-center space-x-3 px-6 py-2 glass rounded-full border-white/10 animate-fade-in-up">
                    <span class="flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-2 w-2 rounded-full bg-indigo-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-indigo-500"></span>
                    </span>
                    <span class="text-xs font-black uppercase tracking-[0.3em] text-indigo-400">Revolutionizing Campus Life</span>
                </div>

                <h1 class="text-7xl md:text-9xl font-black text-white leading-none tracking-tighter animate-fade-in-up" style="animation-delay: 0.2s;">
                    WHERE PASSION <br>
                    <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 via-purple-500 to-emerald-500 font-black">MEETS THE EDGE.</span>
                </h1>

                <p class="text-xl md:text-2xl text-slate-400 max-w-3xl mx-auto leading-relaxed font-medium animate-fade-in-up" style="animation-delay: 0.4s;">
                    Discovery. Leadership. Innovation. Join the elite network of student clubs and redefine your university experience today.
                </p>

                <div class="flex flex-wrap justify-center gap-6 pt-8 animate-fade-in-up" style="animation-delay: 0.6s;">
                    <a href="#clubs" class="btn-gradient px-14 py-6 rounded-[2.5rem] font-black text-xl shadow-[0_20px_50px_rgba(99,102,241,0.3)] hover:scale-105 active:scale-95 transition-all">
                        Explore Clubs
                    </a>
                    <a href="<?php echo e($base_url); ?>/register" class="glass px-14 py-6 rounded-[2.5rem] font-black text-xl border-white/10 hover:bg-white/5 hover:border-white/20 transition-all flex items-center space-x-3">
                        <span>Create Club</span>
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Clubs Section -->
    <section id="clubs" class="py-24 space-y-16">
        <div class="flex flex-col md:flex-row justify-between items-end gap-8">
            <div class="space-y-4">
                <h2 class="text-5xl md:text-7xl font-black text-white tracking-tighter lowercase">featured <span class="text-indigo-500 font-extrabold uppercase">clubs</span></h2>
                <div class="h-2 w-48 bg-gradient-to-r from-indigo-600 to-purple-600 rounded-full"></div>
            </div>
            
            <!-- CATEGORY FILTERS (FUNCTIONAL) -->
            <div class="flex flex-wrap gap-3 glass p-2 rounded-[2rem] border-white/5">
                <button @click="filterClubs('all')" :class="activeCategory === 'all' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-500 hover:text-white'" class="px-8 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all">
                    All
                </button>
                <button @click="filterClubs('tech')" :class="activeCategory === 'tech' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-500 hover:text-white'" class="px-8 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all">
                    Tech
                </button>
                <button @click="filterClubs('art')" :class="activeCategory === 'art' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-500 hover:text-white'" class="px-8 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all">
                    Art
                </button>
                <button @click="filterClubs('sports')" :class="activeCategory === 'sports' ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-600/20' : 'text-slate-500 hover:text-white'" class="px-8 py-3 rounded-2xl text-xs font-black uppercase tracking-widest transition-all">
                    Sports
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <?php $__currentLoopData = $clubs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $club): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div 
                 class="group relative bg-[#0f172a]/40 rounded-[3.5rem] p-6 border border-white/5 hover:border-indigo-500/30 transition-all duration-500 overflow-hidden shadow-2xl">
                
                <!-- Image Container -->
                <div class="relative h-72 w-full rounded-[2.8rem] overflow-hidden mb-8">
                    <img src="<?php echo e($club['image_url']); ?>" class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#020617] via-transparent to-transparent"></div>
                    
                    <!-- Status Badge -->   
                    <div class="absolute top-6 left-6">
                        <div class="px-4 py-2 glass rounded-2xl border-white/10 flex items-center space-x-2">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-[10px] font-black text-white uppercase tracking-widest">Recruiting</span>
                        </div>
                    </div>

                    <!-- Established Badge -->
                    <div class="absolute top-6 right-6">
                        <div class="px-4 py-2 glass rounded-2xl border-white/10">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Est. <?php echo e($club['created_at']); ?></span>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="space-y-6 px-4 pb-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <h3 class="text-3xl font-black text-white leading-none tracking-tight mb-2 group-hover:text-indigo-400 transition-colors"><?php echo e($club['nom']); ?></h3>
                            <div class="flex items-center text-slate-500 text-xs font-bold uppercase tracking-widest space-x-2">
                                <svg class="w-4 h-4 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path></svg>
                                <span><?php echo e($club['president']); ?></span>
                            </div>
                        </div>
                        <div class="flex items-center gap-1.5 bg-indigo-500/10 px-3 py-1.5 rounded-xl border border-indigo-500/20">
                            <svg class="w-4 h-4 text-yellow-500" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                            <span class="text-xs font-black text-white"><?php echo e($club['rating']); ?></span>
                        </div>
                    </div>

                    <p class="text-slate-400 text-sm font-medium leading-relaxed line-clamp-2">
                        <?php echo e($club['description']); ?>

                    </p>

                    <!-- Footer Stats -->
                    <div class="pt-8 flex items-center justify-between border-t border-white/5">
                        <div class="flex items-center space-x-3">
                            <div class="flex -space-x-3">
                                <div class="w-10 h-10 rounded-full border-2 border-[#020617] bg-indigo-600 flex items-center justify-center font-black text-[10px] text-white">MK</div>
                                <div class="w-10 h-10 rounded-full border-2 border-[#020617] bg-emerald-600 flex items-center justify-center font-black text-[10px] text-white">SA</div>
                                <div class="w-10 h-10 rounded-full border-2 border-[#020617] bg-purple-600 flex items-center justify-center font-black text-[10px] text-white">AE</div>
                            </div>
                            <span class="text-[10px] font-black text-slate-500 uppercase tracking-widest"><?php echo e($club['max_membres']); ?> Joined</span>
                        </div>
                        
                        <a href="<?php echo e($base_url); ?>/club/<?php echo e($club['id_club']); ?>" class="flex items-center space-x-3 bg-white/5 px-6 py-3 rounded-2xl text-[10px] font-black text-white uppercase tracking-widest hover:bg-white/10 transition-colors border border-white/5">
                            <span>Details</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                        </a>
                    </div>
                </div>
                
                <!-- Hover Glow -->
                <div class="absolute -inset-px bg-gradient-to-r from-indigo-500/10 to-purple-500/10 rounded-[3.5rem] opacity-0 group-hover:opacity-100 transition-opacity blur-2xl pointer-events-none"></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <!-- CTA Section -->
        <div class="py-24">
            <div class="glass p-12 md:p-24 rounded-[4rem] text-center space-y-10 relative overflow-hidden border-white/5">
                <div class="absolute top-0 right-0 w-96 h-96 bg-indigo-500/10 rounded-full blur-[100px] -mr-48 -mt-48"></div>
                <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-500/10 rounded-full blur-[100px] -ml-48 -mb-48"></div>
                
                <div class="relative z-10 space-y-6">
                    <h2 class="text-5xl md:text-8xl font-black text-white tracking-tighter leading-none lowercase">
                        READY TO <br>
                        <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-emerald-500 uppercase font-black">EXPERIENCE MORE?</span>
                    </h2>
                    <p class="text-xl text-slate-400 max-w-2xl mx-auto font-medium">
                        The road to excellence starts here. Join thousands of students and build something extraordinary.
                    </p>
                    <div class="flex justify-center pt-8">
                        <a href="<?php echo e($base_url); ?>/register" class="btn-gradient px-16 py-6 rounded-[2.5rem] font-black text-xl shadow-2xl">
                            Create Your Account
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<style>
    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    .animate-fade-in-up {
        opacity: 0;
        animation: fade-in-up 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/Club-Edge/App/Views/home.blade.php ENDPATH**/ ?>