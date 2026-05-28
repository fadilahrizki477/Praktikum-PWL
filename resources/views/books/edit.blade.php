<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Buku</h2>
    </x-slot>
    <div class="py-8">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
                <form method="POST" action="{{ route('book.update', $book->id) }}" enctype="multipart/form-data">
                    @csrf @method('PUT')
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Judul</label>
                        <input type="text" name="title" value="{{ old('title', $book->title) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Penulis</label>
                        <input type="text" name="author" value="{{ old('author', $book->author) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tahun</label>
                            <input type="number" name="year" value="{{ old('year', $book->year) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Kota</label>
                            <input type="text" name="city" value="{{ old('city', $book->city) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Penerbit</label>
                        <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Rak Buku</label>
                        <select name="bookshelf_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                            @foreach ($bookshelfs as $shelf)
                            <option value="{{ $shelf->id }}" {{ old('bookshelf_id', $book->bookshelf_id) == $shelf->id ? 'selected' : '' }}>{{ $shelf->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Cover Baru <span class="text-gray-400 text-xs">(opsional)</span></label>
                        @if ($book->cover)
                        <img src="{{ asset('storage/' . $book->cover) }}" class="h-20 mb-2 rounded">
                        @endif
                        <input type="file" name="cover" accept="image/*" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm">
                    </div>
                    <div class="flex gap-3">
                        <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">Update</button>
                        <a href="{{ route('book') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>