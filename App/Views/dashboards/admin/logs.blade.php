@extends('dashboards.admin.layout')

@section('admin_content')
<div class="glass p-8 rounded-3xl border border-slate-800 animate-fadeIn">
    <h2 class="text-2xl font-bold mb-6">Security & Activity Logs</h2>
    <div class="space-y-3 font-mono text-xs text-slate-400">
        <div class="p-3 bg-slate-900/80 rounded-xl border border-slate-800 flex items-center">
            <span class="text-blue-500 mr-4">[INFO]</span>
            <span class="text-slate-500 mr-4">{{ date('H:i:s') }}</span>
            <span>Admin connected from 192.168.1.1</span>
        </div>
        <div class="p-3 bg-slate-900/80 rounded-xl border border-slate-800 flex items-center">
            <span class="text-green-500 mr-4">[SUCCESS]</span>
            <span class="text-slate-500 mr-4">{{ date('H:i:s', strtotime('-5 mins')) }}</span>
            <span>New club "Gaming Hub" successfully created.</span>
        </div>
        <div class="p-3 bg-slate-900/80 rounded-xl border border-slate-800 flex items-center">
            <span class="text-yellow-500 mr-4">[WARNING]</span>
            <span class="text-slate-500 mr-4">{{ date('H:i:s', strtotime('-12 mins')) }}</span>
            <span>Suspicious login attempt for user #102.</span>
        </div>
        <div class="p-3 bg-slate-900/80 rounded-xl border border-slate-800 flex items-center">
            <span class="text-blue-500 mr-4">[INFO]</span>
            <span class="text-slate-500 mr-4">{{ date('H:i:s', strtotime('-25 mins')) }}</span>
            <span>Database backup completed successfully.</span>
        </div>
    </div>
</div>
@endsection
