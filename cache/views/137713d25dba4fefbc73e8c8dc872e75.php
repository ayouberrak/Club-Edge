<!DOCTYPE html>
<html lang="en" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($title ?? 'Club Edge - The Ultimate Experience'); ?></title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Outfit', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        slate: {
                            900: '#0f172a',
                            950: '#020617',
                        }
                    },
                    animation: {
                        'pulse-slow': 'pulse 6s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                        'float': 'float 8s ease-in-out infinite',
                        'glow': 'glow 4s ease-in-out infinite',
                        'reveal': 'reveal 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0) rotate(0)' },
                            '50%': { transform: 'translateY(-30px) rotate(2deg)' },
                        },
                        glow: {
                            '0%, 100%': { opacity: '0.2', transform: 'scale(1)' },
                            '50%': { opacity: '0.4', transform: 'scale(1.15)' },
                        },
                        reveal: {
                            '0%': { opacity: '0', transform: 'translateY(20px)' },
                            '100%': { opacity: '1', transform: 'translateY(0)' },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        :root {
            --glass-bg: rgba(15, 23, 42, 0.3);
            --glass-border: rgba(255, 255, 255, 0.05);
            --accent-primary: #6366f1;
            --accent-secondary: #a855f7;
        }
        
        body {
            background-color: #020617;
            color: white;
            overflow-x: hidden;
            font-family: 'Outfit', sans-serif;
            background-image: 
                radial-gradient(circle at 50% -20%, rgba(99, 102, 241, 0.08) 0, transparent 50%),
                radial-gradient(circle at 10% 20%, rgba(168, 85, 247, 0.03) 0, transparent 40%);
        }

        /* Noise Texture */
        body::after {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0.03;
            z-index: 9999;
            pointer-events: none;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.8' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }

        .glass {
            background: var(--glass-bg);
            backdrop-filter: blur(24px);
            -webkit-backdrop-filter: blur(24px);
            border: 1px solid var(--glass-border);
        }

        .btn-gradient {
            background: linear-gradient(135deg, var(--accent-primary) 0%, var(--accent-secondary) 100%);
            transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: 0.5s;
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        .btn-gradient:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 30px 60px -15px rgba(99, 102, 241, 0.4);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #020617;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(to bottom, #1e293b, #6366f1);
            border-radius: 20px;
            border: 2px solid #020617;
        }

        .nadia-card {
            background: rgba(30, 41, 59, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.02);
            transition: all 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .nadia-card:hover {
            border-color: rgba(99, 102, 241, 0.2);
            transform: translateY(-12px) scale(1.01);
            background: rgba(30, 41, 59, 0.25);
            box-shadow: 0 40px 80px -20px rgba(0, 0, 0, 0.6);
        }

        .text-glow {
            text-shadow: 0 0 30px rgba(99, 102, 241, 0.4);
        }

        input:focus, textarea:focus {
            box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
        }

        [x-cloak] { display: none !important; }

        .reveal-view {
            animation: reveal 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }
    </style>
</head>
<body class="antialiased" x-data="{ 
    toasts: [],
    addToast(message, type = 'success') {
        const id = Date.now();
        this.toasts.push({ id, message, type });
        setTimeout(() => {
            this.toasts = this.toasts.filter(t => t.id !== id);
        }, 4000);
    }
}" @toast.window="addToast($event.detail.message, $event.detail.type)">

    <!-- Deep Background Layer -->
    <div class="fixed inset-0 z-[-2] bg-[#020617]"></div>
    
    <!-- Animated Orbs -->
    <div class="fixed inset-0 z-[-1] pointer-events-none opacity-40">
        <div class="absolute top-[-10%] left-[-5%] w-[50%] h-[50%] bg-indigo-500/10 rounded-full blur-[140px] animate-pulse-slow"></div>
        <div class="absolute bottom-[10%] right-[-5%] w-[40%] h-[40%] bg-purple-600/10 rounded-full blur-[120px] animate-pulse-slow" style="animation-delay: 2s;"></div>
        <div class="absolute top-[30%] right-[10%] w-[30%] h-[30%] bg-emerald-500/5 rounded-full blur-[100px] animate-pulse-slow" style="animation-delay: 4s;"></div>
    </div>

    <!-- Toast UI -->
    <div class="fixed top-6 right-6 z-[9999] flex flex-col gap-3 pointer-events-none">
        <template x-for="toast in toasts" :key="toast.id">
            <div x-transition:enter="transition ease-out duration-500"
                 x-transition:enter-start="opacity-0 translate-x-12 scale-90"
                 x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                 x-transition:leave="transition ease-in duration-300"
                 x-transition:leave-start="opacity-100 translate-x-0 outline-none"
                 x-transition:leave-end="opacity-0 translate-x-12 outline-none"
                 class="glass px-7 py-5 rounded-[2rem] border-white/5 pointer-events-auto shadow-2xl flex items-center space-x-5 border-l-[6px] backdrop-blur-3xl group"
                 :class="toast.type === 'success' ? 'border-l-indigo-500' : 'border-l-red-500'">
                <div class="flex-grow">
                    <p class="text-[11px] font-black uppercase tracking-[0.2em] text-white/90" x-text="toast.message"></p>
                </div>
                <button @click="toasts = toasts.filter(t => t.id !== toast.id)" class="text-white/20 hover:text-white transition-all transform group-hover:scale-110">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>
        </template>
    </div>

    <!-- Premium Navbar -->
    <header class="sticky top-0 z-50 py-8 px-6 transition-all duration-500" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="container mx-auto">
            <div :class="scrolled ? 'py-4 px-8 rounded-[3rem] shadow-2xl bg-slate-950/80 border-white/5' : 'py-6 px-10 rounded-[3.5rem] bg-transparent border-transparent'" class="glass flex items-center justify-between transition-all duration-500 backdrop-blur-xl">
                <a href="<?php echo e($base_url); ?>/" class="flex items-center space-x-4 group">
                    <img src="<?php echo e($base_url); ?>/assets/img/logo.png" alt="Edge Logo" class="w-14 h-14 rounded-[1.3rem] shadow-[0_10px_30px_rgba(79,70,229,0.4)] transform group-hover:rotate-[12deg] transition-all duration-700 object-cover">
                    <div class="flex flex-col">
                        <span class="text-2xl font-black tracking-tighter text-white">EDGE</span>
                        <span class="text-[9px] text-indigo-400 font-black tracking-[0.5em] uppercase opacity-70">Club Systems</span>
                    </div>
                </a>
                
                <nav class="hidden lg:flex items-center space-x-14 text-[11px] font-black uppercase tracking-[0.4em] text-slate-500">
                    <a href="<?php echo e($base_url); ?>/" class="hover:text-white transition-all relative group py-2">
                        <span>Directory</span>
                        <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-indigo-500 group-hover:w-full transition-all duration-500"></span>
                    </a>
                    <a href="<?php echo e($base_url); ?>/#clubs" class="hover:text-white transition-all relative group py-2">
                        <span>Universe</span>
                        <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-indigo-500 group-hover:w-full transition-all duration-500"></span>
                    </a>
                    <a href="<?php echo e($base_url); ?>/#clubs" class="hover:text-white transition-all relative group py-2">
                        <span>Updates</span>
                        <span class="absolute bottom-0 left-0 w-0 h-[2px] bg-indigo-500 group-hover:w-full transition-all duration-500"></span>
                    </a>
                </nav>

                <div class="flex items-center space-x-8">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <div class="flex items-center space-x-6">
                            <?php
                                $dashboardUrl = $base_url . '/dashboard';
                                if($_SESSION['user_role'] === 'president') {
                                    $dashboardUrl = $base_url . '/dashboard/president';
                                } elseif ($_SESSION['user_role'] === 'admin') {
                                    $dashboardUrl = $base_url . '/dashboard/admin';
                                }
                            ?>
                            <a href="<?php echo e($dashboardUrl); ?>" class="flex items-center space-x-3 group bg-indigo-500/5 hover:bg-indigo-500/10 px-4 py-2 rounded-2xl border border-indigo-500/10 transition-all">
                                <div class="w-8 h-8 rounded-lg bg-indigo-500 flex items-center justify-center shadow-lg shadow-indigo-500/20 group-hover:scale-110 transition-transform">
                                    <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                                <div class="flex flex-col">
                                    <span class="text-[10px] font-black text-white uppercase tracking-wider"><?php echo e($_SESSION['user_nom'] ?? 'Account'); ?></span>
                                    <span class="text-[8px] text-indigo-400 font-bold uppercase tracking-widest">Dashboard</span>
                                </div>
                            </a>

                            <a href="<?php echo e($base_url); ?>/logout" class="text-slate-500 hover:text-red-400 transition-colors p-2" title="Sign Out">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4-4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="<?php echo e($base_url); ?>/login" class="text-[11px] font-bold text-slate-400 hover:text-white uppercase tracking-[0.3em] transition-all">Portal</a>
                        <a href="<?php echo e($base_url); ?>/register" class="btn-gradient px-10 py-5 rounded-[1.8rem] text-[11px] font-black text-white uppercase tracking-[0.3em] shadow-xl shadow-indigo-600/20">Join Orbit</a>
                    <?php endif; ?>
                </div>

                <!-- <div class="flex items-center space-x-8">
                    <a href="<?php echo e($base_url); ?>/login" class="text-[11px] font-bold text-slate-400 hover:text-white uppercase tracking-[0.3em] transition-all">Portal</a>
                    <a href="<?php echo e($base_url); ?>/register" class="btn-gradient px-10 py-5 rounded-[1.8rem] text-[11px] font-black text-white uppercase tracking-[0.3em] shadow-xl shadow-indigo-600/20">Join Orbit</a>
                </div> -->
            </div>
        </div>
    </header>

    <main class="container mx-auto px-6 mb-32 reveal-view">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <!-- Ultimate Footer -->
    <footer class="border-t border-white/5 py-32 bg-slate-950">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-20 items-center justify-items-center mb-24">
                <div class="text-center md:text-left space-y-6">
                    <div class="text-4xl font-black tracking-tighter italic">EDGE.SYS</div>
                    <p class="text-slate-500 text-sm max-w-xs leading-relaxed font-medium">
                        The next evolution of university club ecosystems. Built for impact, designed for the future.
                    </p>
                </div>
                <div class="flex flex-col items-center space-y-4">
                    <div class="w-16 h-16 rounded-full glass flex items-center justify-center animate-bounce">
                        <svg class="w-8 h-8 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                    </div>
                </div>
                <div class="flex gap-10 text-[10px] font-black uppercase tracking-[0.4em] text-slate-500">
                    <a href="#" class="hover:text-indigo-400 transition-colors">Terminals</a>
                    <a href="#" class="hover:text-indigo-400 transition-colors">Satellite</a>
                    <a href="#" class="hover:text-indigo-400 transition-colors">Support</a>
                </div>
            </div>
            
            <div class="h-px w-full bg-gradient-to-r from-transparent via-slate-800 to-transparent mb-12"></div>
            
            <div class="flex flex-col md:flex-row justify-between items-center gap-6 text-slate-700 text-[10px] font-black uppercase tracking-[0.6em]">
                <div>STATUS: OPERATIONAL</div>
                <div>&copy; 2026 CLUB EDGE ECOSYSTEM</div>
                <div>v1.0.4-STABLE</div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</body>
</html>
<?php /**PATH C:\xampp\htdocs\Club Edge\App\Views/layouts/main.blade.php ENDPATH**/ ?>