<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pageTitle ?? 'Dashboard' }}
            </h2>
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('dashboard') }}" 
                   class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 transition font-semibold">
                   Dashboard
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
                <h3 class="text-lg font-semibold mb-4">Welcome, {{ auth()->user()->name }}!</h3>
                <p>You're logged in as a user. Here are the latest posts:</p>

                <div class="mt-6 space-y-4">
                    @forelse($posts as $post)
                        <div class="p-4 border rounded hover:shadow-md transition">
                            <h4 class="font-semibold text-lg">{{ $post->post_title }}</h4>
            
                            <p class="text-gray-700 break-words overflow-hidden">
                                {{ Str::limit($post->description, 100) }}
                            </p>
            
                            <p class="text-sm text-gray-500">
                                Published: {{ $post->created_at->format('d M, Y') }}
                            </p>

                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}"
                                    class="mt-4 rounded shadow-sm"
                                    style="max-width: 100%; height: auto;">
                            @endif

                            <a href="{{ route('fullpost', $post->id) }}"
                               class="text-blue-500 hover:underline mt-2 inline-block">
                                Read More
                            </a>
                        </div>
                    @empty
                        <p>No posts available.</p>
                    @endforelse
                </div>


                <div class="mt-4">
                    {{ $posts->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
