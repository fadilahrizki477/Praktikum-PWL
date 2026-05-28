<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Tambah Detail Peminjaman</h2></x-slot>
    <div class="py-8"><div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <form method="POST" action="{{ route('loan-detail.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Peminjaman</label>
                    <select name="loan_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                        <option value="">Pilih Peminjaman</option>
                        @foreach ($loans as $loan)
                            <option value="{{ $loan->id }}" {{ old('loan_id') == $loan->id ? 'selected' : '' }}>
                                #{{ $loan->id }} - {{ $loan->user->first_name ?? '-' }} ({{ $loan->loan_at }})
                            </option>
                        @endforeach
                    </select>
                    @error('loan_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Buku</label>
                    <select name="book_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                        <option value="">Pilih Buku</option>
                        @foreach ($books as $book)
                            <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>{{ $book->title }}</option>
                        @endforeach
                    </select>
                    @error('book_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-6 flex items-center gap-2">
                    <input type="checkbox" name="is_return" id="is_return" value="1" {{ old('is_return') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                    <label for="is_return" class="text-sm text-gray-700 dark:text-gray-300">Sudah Dikembalikan</label>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">Simpan</button>
                    <a href="{{ route('loan-detail') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">Batal</a>
                </div>
            </form>
        </div>
    </div></div>
</x-app-layout>