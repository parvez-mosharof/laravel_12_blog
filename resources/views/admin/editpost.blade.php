<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pageTitle ?? 'Edit Post' }}
            </h2>
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 transition font-semibold">Dashboard</a>
                <a href="{{ route('admin.allpost') }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition font-semibold">All Posts</a>
                <a href="{{ route('admin.posts.create') }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition font-semibold">Create Post</a>
                <a href="{{ route('home') }}" class="bg-gray-700 text-white px-3 py-1 rounded hover:bg-gray-800 transition font-semibold">Home</a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                @if ($errors->any())
                    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>- {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('posts.update', $post->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="post_title" class="block font-semibold mb-1">Post Title:</label>
                        <input type="text" name="post_title" id="post_title" class="w-full border rounded p-2" value="{{ old('post_title', $post->post_title) }}" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-semibold mb-1">Description:</label>
                        <textarea name="description" id="description" rows="6" class="w-full border rounded p-2" required>{{ old('description', $post->description) }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition font-semibold">Update</button>
                        <a href="{{ route('admin.allpost') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition font-semibold">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
