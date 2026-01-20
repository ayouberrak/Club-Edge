<?php $__env->startSection('content'); ?>
<div class="flex justify-center items-center py-20">
    <div class="glass p-10 rounded-3xl border border-slate-700 w-full max-w-md">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold mb-2">Welcome Back</h2>
            <p class="text-slate-400">Sign in to manage your clubs and events</p>
        </div>
        <?php if(isset($error)): ?>
            <div class="bg-red-500/20 border border-red-500 text-red-200 p-4 rounded-xl mb-6 text-sm">
                <?php echo e($error); ?>

            </div>
        <?php endif; ?>

        <?php if(isset($success)): ?>
            <div class="bg-green-500/20 border border-green-500 text-green-200 p-4 rounded-xl mb-6 text-sm">
                <?php echo e($success); ?>

            </div>
        <?php endif; ?>
        <form action="<?php echo e($base_url); ?>/login" method="POST" class="space-y-6">
            <input type="hidden" name="csrf_token" value="<?php echo e($_SESSION['csrf_token']); ?>">
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Institutional Email</label>
                <input type="email" name="email" required class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" placeholder="you@university.edu">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                <input type="password" name="password" required class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" placeholder="••••••••">
            </div>
            <div class="flex items-center justify-between text-sm">
                <label class="flex items-center space-x-2">
                    <input type="checkbox" class="rounded border-slate-700 bg-slate-900 text-blue-500">
                    <span class="text-slate-400">Remember me</span>
                </label>
                <a href="#" class="text-blue-400 hover:text-blue-300">Forgot password?</a>
            </div>
            <button type="submit" class="w-full btn-gradient py-4 rounded-xl font-bold text-lg">Sign In</button>
        </form>
        
        <div class="mt-8 text-center text-slate-400">
            Don't have an account? <a href="<?php echo e($base_url); ?>/register" class="text-blue-400 font-semibold">Join the Club</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/Club-Edge/App/Views/auth/login.blade.php ENDPATH**/ ?>