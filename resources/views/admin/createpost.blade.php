<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-wrap justify-between items-center gap-2">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $pageTitle ?? 'Create Post' }}
            </h2>
            <div class="flex gap-2 flex-wrap">
                <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 transition font-semibold">Dashboard</a>
                <a href="{{ route('admin.allpost') }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 transition font-semibold">All Posts</a>
                <a href="{{ route('admin.posts.create') }}" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 transition font-semibold">Create Post</a>
                <a href="{{ route('home') }}" class="bg-gray-500 text-white px-3 py-1 rounded hover:bg-gray-600 transition font-semibold">
                   Home
                </a>
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

                <form action="{{ route('admin.posts.store') }}" method="POST"
                enctype="multipart/form-data" 

                >
                    @csrf
                    <div class="mb-4">
                        <label for="post_title" class="block font-semibold mb-1">Post Title:</label>
                        <input type="text" name="post_title" id="post_title" class="w-full border rounded p-2" required>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="block font-semibold mb-1">Description:</label>
                        <textarea name="description" id="description" rows="6" class="w-full border rounded p-2" required></textarea>
                    </div>



                                     <!-- Image Upload -->
                   <div class="mb-4">
                       <label for="image" class="block text-sm font-medium text-gray-700">Upload Image</label>
                       <input type="file" name="image" id="image"
                       class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2"
                       accept="image/*">


                       <!-- Preview -->
                       <img id="imagePreview" class="mt-2 w-40 h-40 object-cover rounded hidden" alt="Image Preview">
                   </div>










                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition font-semibold">Create</button>
                        <a href="{{ route('admin.allpost') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600 transition font-semibold">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    const imageInput = document.getElementById('image');
    const imagePreview = document.getElementById('imagePreview');

    imageInput.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();

            reader.addEventListener('load', function() {
                imagePreview.setAttribute('src', this.result);
                imagePreview.classList.remove('hidden');
            });

            reader.readAsDataURL(file);
        } else {
            imagePreview.setAttribute('src', '');
            imagePreview.classList.add('hidden');
        }
    });
</script>

</x-app-layout>
