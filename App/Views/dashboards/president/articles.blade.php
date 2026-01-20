@extends('dashboards.president.layout')

@section('president_content')
<div class="animate-fadeIn space-y-6">
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
@endsection
