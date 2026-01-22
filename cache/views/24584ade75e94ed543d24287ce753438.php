<?php $__env->startSection('content'); ?>
<div class="py-10 flex flex-col md:flex-row gap-8" x-data="{ 
    showEventModal: false, 
    showArticleModal: false, 
    showEditArticleModal: false,
    showReadModal: false,
    activeTab: 'members', 
    articles: <?php echo e(json_encode(array_values($articles ?? []))); ?>,
    articleEventTitle: '',
    articleEventId: '',
    editArticleId: '',
    editArticleContent: '',
    editArticleEventId: '',
    editArticleImage: '',
    newArticleImageUrl: null,
    editArticleImageUrl: null,
    readArticleContent: '',
    readArticleTitle: '',
    readArticleDate: '',
    readArticleImage: '',
    
    openArticleFor(id, title) {
        this.articleEventId = id;
        this.articleEventTitle = title;
        this.newArticleImageUrl = null;
        this.showArticleModal = true;
    },
    openEditArticle(id) {
        const article = this.articles.find(a => a.id == id);
        if(!article) return;
        this.editArticleId = article.id;
        this.editArticleContent = article.content;
        this.editArticleEventId = article.id_event;
        this.editArticleImage = article.image;
        this.editArticleImageUrl = null;
        this.showEditArticleModal = true;
    },
    openReadArticle(id) {
        const article = this.articles.find(a => a.id == id);
        if(!article) return;
        this.readArticleTitle = article.title || 'Stories';
        this.readArticleContent = article.content;
        this.readArticleImage = article.image;
        this.readArticleDate = article.date || '';
        this.showReadModal = true;
    },
    init() {
        const urlParams = new URLSearchParams(window.location.search);
        const success = urlParams.get('success');
        if (success === 'event_created') {
            setTimeout(() => { this.$dispatch('toast', { message: 'Event successfully published!', type: 'success' }); }, 500);
        } else if (success === 'article_created') {
             setTimeout(() => { this.$dispatch('toast', { message: 'Article published for everyone!', type: 'success' }); }, 500);
        } else if (success === 'article_deleted') {
             setTimeout(() => { this.$dispatch('toast', { message: 'Article deleted successfully.', type: 'success' }); }, 500);
        } else if (success === 'article_updated') {
             setTimeout(() => { this.$dispatch('toast', { message: 'Article updated successfully.', type: 'success' }); }, 500);
        }
        
        if(success) {
            window.history.replaceState({}, document.title, window.location.pathname);
        }
    }
}">
    <!-- Sidebar -->
    <aside class="w-full md:w-64 space-y-4">
        <div class="glass p-6 rounded-2xl border border-slate-800">
            <div class="flex flex-col items-center mb-6">
                <div class="relative">
                    <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-purple-600 mb-4 flex items-center justify-center text-3xl font-bold">
                        <?php echo e(substr($_SESSION['user_nom'] ?? 'PR', 0, 2)); ?>

                    </div>
                </div>
                <h3 class="text-xl font-bold"><?php echo e($_SESSION['user_nom'] ?? 'President'); ?></h3>
                <p class="text-indigo-400 text-sm font-semibold">Club President</p>
                <p class="text-slate-500 text-xs"><?php echo e($club['nom']); ?></p>
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
                <p class="text-slate-400 text-sm">Managing the **<?php echo e($club['nom']); ?>** universe.</p>
            </div>
            <div class="flex items-center space-x-3 glass p-2 rounded-2xl border border-white/5">
                <div class="px-4 py-2 bg-indigo-500/20 text-indigo-400 rounded-xl text-xs font-black">
                    <?php echo e($club['members_count']); ?> / <?php echo e($club['max_membres']); ?> CAPACITY
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
                    <?php if($event['date'] >= date('Y-m-d')): ?>
                        <!-- Upcoming -->
                        <div class="glass p-6 rounded-3xl border border-white/5 flex flex-col md:flex-row items-center gap-6 group hover:border-indigo-500/20 transition-all">
                            <?php if(!empty($event['image'])): ?>
                                <img src="<?php echo e(\Core\Helpers::url('/upload/imageevent/' . $event['image'])); ?>" class="w-32 h-24 rounded-2xl object-cover">
                            <?php else: ?>
                                <img src="https://images.unsplash.com/photo-1540575861501-7ad06763821d" class="w-32 h-24 rounded-2xl object-cover">
                            <?php endif; ?>
                            <div class="flex-grow">
                                <div class="text-[10px] font-black text-indigo-400 uppercase tracking-widest mb-1">Upcoming • <?php echo e($event['date']); ?></div>
                                <h3 class="text-xl font-bold uppercase"><?php echo e($event['title']); ?></h3>
                                <p class="text-slate-500 text-sm"><?php echo e($event['participants']); ?> students registered</p>
                            </div>
                        </div>
                    <?php else: ?>
                        <!-- Past -->
                        <div class="glass p-6 rounded-3xl border border-white/5 flex flex-col md:flex-row items-center gap-6 bg-slate-900/20 grayscale hover:grayscale-0 transition-all">
                            <div class="w-32 h-24 rounded-2xl bg-slate-800 flex items-center justify-center overflow-hidden">
                                <?php if(!empty($event['image'])): ?>
                                    <img src="<?php echo e(\Core\Helpers::url('/upload/imageevent/' . $event['image'])); ?>" class="w-full h-full object-cover">
                                <?php else: ?>
                                    <svg class="w-8 h-8 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                <?php endif; ?>
                            </div>
                            <div class="flex-grow">
                                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest mb-1">Completed • <?php echo e($event['date']); ?></div>
                                <h3 class="text-xl font-bold uppercase"><?php echo e($event['title']); ?></h3>
                                <p class="text-slate-400 text-sm">Event finished. Share the results with an article.</p>
                            </div>
                            <button @click="openArticleFor(<?php echo e($event['id']); ?>, <?php echo e(json_encode($event['title'])); ?>)" class="px-8 py-3 bg-indigo-600 rounded-2xl text-xs font-black uppercase tracking-widest text-white hover:bg-indigo-500 shadow-xl shadow-indigo-600/20 transition-all">
                                Write Article
                            </button>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(empty($events)): ?>
                    <div class="text-center text-slate-500 py-10">No events found.</div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Articles Tab -->
        <div x-show="activeTab === 'articles'" class="animate-fadeIn space-y-6">
            <h2 class="text-2xl font-bold">Published Stories</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="group relative overflow-hidden rounded-[2rem] bg-slate-900 border border-white/10 hover:border-indigo-500/50 transition-all duration-300 hover:shadow-2xl hover:shadow-indigo-500/10">
                    <!-- Image Background -->
                    <div class="h-48 w-full overflow-hidden relative">
                         <?php if(!empty($article['image'])): ?>
                            <img src="<?php echo e(\Core\Helpers::url('/upload/Image_article/' . $article['image'])); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <?php else: ?>
                            <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <?php endif; ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/20 to-transparent opacity-80"></div>
                        
                        <div class="absolute bottom-4 left-6 right-6">
                            <h3 class="text-lg font-black text-white leading-tight mb-1 drop-shadow-lg"><?php echo e($article['title']); ?></h3>
                            <div class="flex items-center gap-2 text-[10px] font-bold uppercase tracking-widest text-indigo-400">
                                <span><?php echo e($article['date']); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="p-6 flex items-center justify-between bg-slate-900/50 backdrop-blur-sm">

                        
                        <!-- Read More with Robust Data Binding -->
                        <!-- Read More Actions -->
                        <button 
                            @click="openReadArticle(<?php echo e($article['id']); ?>)" 
                            class="text-xs text-slate-400 font-bold uppercase tracking-wider hover:text-white transition-colors cursor-pointer">
                            Read More
                        </button>
                        
                        <div class="flex gap-3">
                            <!-- Robust Edit Button using data attribute -->
                            <!-- Edit Button -->
                            <button 
                                @click="openEditArticle(<?php echo e($article['id']); ?>)" 
                                class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-indigo-400 hover:bg-indigo-600 hover:text-white transition-all shadow-lg cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>
                            </button>
                            
                            <a href="<?php echo e(\Core\Helpers::url('/dashboard/president/articles/delete/' . $article['id'])); ?>" 
                               onclick="return confirm('Are you sure you want to delete this story?');"
                               class="w-8 h-8 rounded-full bg-slate-800 flex items-center justify-center text-red-500 hover:bg-red-600 hover:text-white transition-all shadow-lg">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M3 6h18"></path><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-2 text-center text-slate-500 py-10">
                    No stories published yet.
                </div>
                <?php endif; ?>
            </div>
        </div>

    <!-- Modals -->
    
    <!-- Read Article Modal -->
    <div x-show="showReadModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak>
        <div class="glass w-full max-w-3xl max-h-[90vh] overflow-y-auto p-0 rounded-[2.5rem] border border-white/10" @click.away="showReadModal = false">
            <div class="h-64 w-full relative">
                <template x-if="readArticleImage">
                     <img :src="'<?php echo e(\Core\Helpers::url('/upload/Image_article/')); ?>' + readArticleImage" class="w-full h-full object-cover">
                </template>
                 <template x-if="!readArticleImage">
                     <img src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b" class="w-full h-full object-cover">
                </template>
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 to-transparent"></div>
                <button @click="showReadModal = false" class="absolute top-6 right-6 w-10 h-10 rounded-full bg-black/50 text-white flex items-center justify-center hover:bg-white hover:text-black transition-colors">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
            
            <div class="p-10 -mt-10 relative">
                <div class="flex items-center gap-4 text-xs font-bold uppercase tracking-widest text-indigo-400 mb-4">
                     <span x-text="readArticleDate"></span>
                     <span class="w-1 h-1 rounded-full bg-slate-500"></span>
                     <span>Story</span>
                </div>
                
                <h2 class="text-3xl md:text-4xl font-black mb-8 leading-tight" x-text="readArticleTitle"></h2>
                
                <div class="prose prose-invert prose-lg max-w-none text-slate-300 font-light leading-relaxed whitespace-pre-wrap" x-text="readArticleContent"></div>
                
                <div class="mt-12 pt-8 border-t border-white/10 flex justify-between items-center text-xs font-mono text-slate-500">
                    <span>CLUB EDGE • STORIES</span>
                    <button @click="showReadModal = false" class="text-white hover:text-indigo-400 transition-colors uppercase font-bold tracking-widest">Close Reading</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modals -->
    
    <!-- New Event Modal -->
    <div x-show="showEventModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak>
        <div class="glass w-full max-w-xl p-10 rounded-[2.5rem] border border-white/10" @click.away="showEventModal = false">
            <h2 class="text-3xl font-black mb-10 uppercase tracking-tighter">Schedule <span class="text-indigo-500">Event</span></h2>
            <form action="<?php echo e(\Core\Helpers::url('/events/store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                <!-- CSRF Token (Assuming framework needs it, but manual CSRF check in AuthController implies custom. EventController doesn't check it? Let's check EventController again. It doesn't check CSRF. Ok.) -->
                <input type="hidden" name="id_club" value="<?php echo e($club['id_club'] ?? ''); ?>">
                
                <input type="text" name="titre" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none" placeholder="Event Name">
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <input type="date" name="date_event" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none placeholder-slate-500">
                    <input type="text" name="lieu" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none" placeholder="Location">
                </div>

                <div class="relative group">
                    <label class="block text-xs font-bold text-slate-500 uppercase tracking-widest mb-2">Event Image</label>
                    <input type="file" name="image_event" class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-3 text-sm text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-600 file:text-white hover:file:bg-indigo-500">
                </div>

                <textarea name="description" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none h-32" placeholder="Description"></textarea>
                
                <button type="submit" class="w-full btn-gradient py-5 rounded-2xl font-black text-lg shadow-2xl shadow-indigo-600/20 hover:scale-[1.02] transition-transform">PUBLISH EVENT</button>
            </form>
        </div>
    </div>

    <!-- Article Modal -->
    <div x-show="showArticleModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak>
        <div class="glass w-full max-w-2xl p-10 rounded-[2.5rem] border border-white/10" @click.away="showArticleModal = false">
            <h2 class="text-2xl font-black mb-4 uppercase tracking-tighter">Post-Event <span class="text-indigo-500">Article</span></h2>
            <p class="text-slate-500 text-sm mb-10">Sharing insights for: <span x-text="articleEventTitle" class="text-white font-bold italic"></span></p>
            
            <form action="<?php echo e(\Core\Helpers::url('/dashboard/president/articles')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                 <input type="hidden" name="id_event" :value="articleEventId">

                
                <!-- Image Upload -->
                <div class="relative group">
                    <input type="file" name="image_article" id="articleImage" class="hidden" accept="image/*" 
                        @change="const file = $event.target.files[0]; if (file) { newArticleImageUrl = URL.createObjectURL(file) }">
                    
                    <label for="articleImage" class="cursor-pointer flex flex-col items-center justify-center w-full h-32 bg-slate-900/30 border-2 border-dashed border-white/10 rounded-2xl hover:border-indigo-500/50 transition-colors overflow-hidden">
                        <template x-if="!newArticleImageUrl">
                            <div class="flex flex-col items-center text-slate-500">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                <span class="text-xs font-bold uppercase tracking-widest">Add a Cover Photo</span>
                            </div>
                        </template>
                        <template x-if="newArticleImageUrl">
                            <img :src="newArticleImageUrl" class="w-full h-full object-cover">
                        </template>
                    </label>
                </div>

                <textarea name="contenu" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none h-48" placeholder="Tell the world what happened..."></textarea>
                
                <div class="flex gap-4">
                    <button type="button" @click="showArticleModal = false; newArticleImageUrl = null" class="flex-1 py-4 text-slate-500 font-bold uppercase tracking-widest text-xs">Discard</button>
                    <button type="submit" class="flex-[3] bg-indigo-600 py-4 rounded-2xl font-black text-white uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-500 transition-colors">POST STORY</button>
                </div>
            </form>
        </div>
        <!-- Edit Article Modal -->
    <div x-show="showEditArticleModal" class="fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-950/90 backdrop-blur-md" x-cloak>
        <div class="glass w-full max-w-2xl p-10 rounded-[2.5rem] border border-white/10" @click.away="showEditArticleModal = false">
            <h2 class="text-2xl font-black mb-10 uppercase tracking-tighter">Edit <span class="text-indigo-500">Story</span></h2>
            
            <form action="<?php echo e(\Core\Helpers::url('/dashboard/president/articles/edit')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                 <input type="hidden" name="id_article" :value="editArticleId">
                 <input type="hidden" name="id_event" :value="editArticleEventId">

                <!-- Image Upload (Update) -->
                <div class="relative group">
                    <input type="file" name="image_article" id="editArticleImage" class="hidden" accept="image/*" 
                        @change="const file = $event.target.files[0]; if (file) { editArticleImageUrl = URL.createObjectURL(file) }">
                    
                    <label for="editArticleImage" class="cursor-pointer flex flex-col items-center justify-center w-full h-32 bg-slate-900/30 border-2 border-dashed border-white/10 rounded-2xl hover:border-indigo-500/50 transition-colors overflow-hidden">
                        <!-- Show new image preview if selected -->
                        <template x-if="editArticleImageUrl">
                            <img :src="editArticleImageUrl" class="w-full h-full object-cover">
                        </template>
                        
                        <!-- Show existing image if no new image selected -->
                        <template x-if="!editArticleImageUrl && editArticleImage">
                             <img :src="'<?php echo e(\Core\Helpers::url('/upload/Image_article/')); ?>' + editArticleImage" class="w-full h-full object-cover opacity-50">
                        </template>
 
                         <!-- Show placeholder if neither -->
                        <template x-if="!editArticleImageUrl && !editArticleImage">
                            <div class="flex flex-col items-center text-slate-500">
                                <span class="text-xs font-bold uppercase tracking-widest">Change Cover Photo</span>
                            </div>
                        </template>
                        
                        <!-- Always show label overlay on hover/empty -->
                         <div class="absolute inset-0 flex items-center justify-center bg-black/50 opacity-0 hover:opacity-100 transition-opacity">
                            <span class="text-xs font-bold uppercase tracking-widest text-white">Change Photo</span>
                        </div>
                    </label>
                </div>

                <textarea name="contenu" x-model="editArticleContent" required class="w-full bg-slate-900/50 border border-white/10 rounded-2xl px-5 py-4 text-white focus:border-indigo-500 focus:outline-none h-48" placeholder="Update your story..."></textarea>
                
                <div class="flex gap-4">
                    <button type="button" @click="showEditArticleModal = false; editArticleImageUrl = null" class="flex-1 py-4 text-slate-500 font-bold uppercase tracking-widest text-xs">Cancel</button>
                    <button type="submit" class="flex-[3] bg-indigo-600 py-4 rounded-2xl font-black text-white uppercase tracking-widest shadow-xl shadow-indigo-600/20 hover:bg-indigo-500 transition-colors">UPDATE STORY</button>
                </div>
            </form>
        </div>
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

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/Club-Edge/App/Views/dashboards/president.blade.php ENDPATH**/ ?>