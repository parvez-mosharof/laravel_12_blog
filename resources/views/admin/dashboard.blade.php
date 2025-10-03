<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pageTitle ?? 'Dashboard' }}
            </h2>
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('admin.dashboard') }}" 
                   class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 transition font-semibold">
                   Dashboard
                </a>
                <a href="{{ route('admin.allpost') }}" 
                   class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition font-semibold">
                   All Posts
                </a>
                <a href="{{ route('admin.posts.create') }}" 
                   class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition font-semibold">
                   Create Post
                </a>
                <a href="{{ route('home') }}" 
                   class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 transition font-semibold">
                   Home
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Admin Dashboard</h3>
                <p>Welcome to your admin panel. Use the buttons above to manage posts.</p>
            </div>
        </div>
    </div>
</x-app-layout>

