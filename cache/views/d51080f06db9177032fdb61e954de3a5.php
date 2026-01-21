<?php $__env->startSection('content'); ?>
<div class="min-h-[80vh] flex flex-col items-center justify-center text-center p-6 relative overflow-hidden">
    <!-- Background Glow for 404 -->
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[500px] h-[500px] bg-indigo-600/20 rounded-full blur-[120px] pointer-events-none animate-pulse"></div>

    <div class="relative z-10 space-y-12 max-w-2xl">
        <div class="space-y-4">
            <div class="inline-flex items-center space-x-2 px-4 py-2 glass rounded-full border-white/5 text-[10px] font-black uppercase tracking-[0.4em] text-indigo-400 animate-bounce">
                System Deviation Detected
            </div>
            <h1 class="text-[12rem] md:text-[18rem] font-black leading-none tracking-tighter text-glow bg-clip-text text-transparent bg-gradient-to-b from-white via-white/20 to-transparent opacity-40">
                404
            </h1>
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                <div class="text-4xl md:text-6xl font-black text-white italic tracking-tighter uppercase whitespace-nowrap">
                    LOST IN THE <span class="bg-clip-text text-transparent bg-gradient-to-r from-indigo-500 to-purple-600">EDGE.</span>
                </div>
            </div>
        </div>

        <div class="space-y-8">
            <p class="text-xl md:text-2xl text-slate-400 font-medium leading-relaxed">
                The terminal you're looking for has drifted into deep space. <br class="hidden md:block">
                Establish a new connection to the home station.
            </p>
            
            <div class="flex flex-wrap justify-center gap-6">
                <a href="<?php echo e($base_url); ?>/" class="btn-gradient px-12 py-5 rounded-[2rem] font-black text-xl shadow-2xl shadow-indigo-600/20 hover:scale-105 active:scale-95 transition-all">
                    Return to Mission
                </a>
                <button onclick="window.history.back()" class="glass px-12 py-5 rounded-[2rem] font-black text-xl border-white/10 hover:bg-white/5 transition-all text-slate-300">
                    Previous Sector
                </button>
            </div>
        </div>
    </div>

    <!-- Floating Decoration -->
    <div class="absolute top-20 right-20 w-12 h-12 border-2 border-indigo-500/20 rounded-full animate-float"></div>
    <div class="absolute bottom-40 left-20 w-8 h-8 border border-purple-500/20 rounded-full animate-float" style="animation-delay: 2s;"></div>
    <div class="absolute top-40 left-1/4 w-4 h-4 bg-emerald-500/20 rounded-full animate-float" style="animation-delay: 1s;"></div>
</div>

<style>
    .text-glow {
        filter: drop-shadow(0 0 30px rgba(99, 102, 241, 0.3));
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/Club-Edge/App/Views/errors/404.blade.php ENDPATH**/ ?>