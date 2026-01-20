<?php $__env->startSection('content'); ?>
<div class="flex justify-center items-center py-20">
    <div class="glass p-10 rounded-3xl border border-slate-700 w-full max-w-lg">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-bold mb-2">Create Account</h2>
            <p class="text-slate-400">Join the student community and start exploring</p>
        </div>
        
        <form action="<?php echo e($base_url); ?>/register" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <input type="hidden" name="csrf_token" value="<?php echo e($_SESSION['csrf_token']); ?>">
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-300 mb-2">Full Name</label>
                <input type="text" name="name" required class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" placeholder="John Doe">
            </div>
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-slate-300 mb-2">Institutional Email</label>
                <input type="email" name="email" required class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" placeholder="you@university.edu">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Password</label>
                <input type="password" name="password" required class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" placeholder="••••••••">
            </div>
            <div>
                <label class="block text-sm font-medium text-slate-300 mb-2">Confirm Password</label>
                <input type="password" name="confirm_password" required class="w-full bg-slate-900/50 border border-slate-700 rounded-xl px-4 py-3 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white" placeholder="••••••••">
            </div>
            <div class="md:col-span-2 flex items-start space-x-2 text-sm text-slate-400">
                <input type="checkbox" required class="mt-1 rounded border-slate-700 bg-slate-900 text-blue-500">
                <span>I agree to the <a href="#" class="text-blue-400">Terms of Service</a> and <a href="#" class="text-blue-400">Privacy Policy</a>.</span>
            </div>
            <button type="submit" class="md:col-span-2 w-full btn-gradient py-4 rounded-xl font-bold text-lg">Create Account</button>
        </form>
        
        <div class="mt-8 text-center text-slate-400">
            Already have an account? <a href="<?php echo e($base_url); ?>/login" class="text-blue-400 font-semibold">Sign In</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/Club-Edge/App/Views/auth/register.blade.php ENDPATH**/ ?>