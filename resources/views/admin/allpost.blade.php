<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pageTitle ?? 'All Posts' }}
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
                {{-- Success Message --}}
                @if(session('success'))
                    <div class="mb-4">
                        <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded shadow-sm">
                            {{ session('success') }}
                        </div>
                    </div>
                @endif

                @if($posts->isEmpty())
                    <p>No posts found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="min-w-full border border-gray-200">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-4 py-2 border text-center">#</th>
                                    <th class="px-4 py-2 border">Post Title</th>
                                    <th class="px-4 py-2 border">Image</th> {{-- NEW COLUMN --}}
                                    <th class="px-4 py-2 border">Description</th>
                                    <th class="px-4 py-2 border text-center">Created At</th>
                                    <th class="px-4 py-2 border text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($posts as $post)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border text-center">{{ $loop->iteration }}</td>
                                        <td class="px-4 py-2 border font-semibold">{{ $post->post_title }}</td>
                                        
                                        {{-- IMAGE CELL --}}
                                        <td class="px-4 py-2 border text-center">
                                            @if($post->image)
                                                <img src="{{ asset('storage/' . $post->image) }}" 
                                                     alt="{{ $post->post_title }}" 
                                                     class="w-20 h-auto rounded">
                                            @else
                                                <span class="text-gray-400">No Image</span>
                                            @endif
                                        </td>

                                        <td class="px-4 py-2 border">{{ Str::limit($post->description, 50) }}</td>
                                        <td class="px-4 py-2 border text-center">{{ $post->created_at->format('d M, Y') }}</td>
                                        <td class="px-4 py-2 border">
                                            <div class="flex gap-2 justify-center">
                                                <a href="{{ route('posts.edit', $post->id) }}" 
                                                   class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition font-semibold">
                                                   Edit
                                                </a>
                                                <form action="{{ route('posts.destroy', $post->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            onclick="return confirm('Are you sure you want to delete this post?')" 
                                                            class="bg-red-600 text-white font-semibold px-3 py-1 rounded shadow hover:bg-red-700 transition">
                                                        Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
