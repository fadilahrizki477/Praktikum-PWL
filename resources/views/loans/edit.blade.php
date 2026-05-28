<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Edit Peminjaman</h2></x-slot>
    <div class="py-8"><div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <form method="POST" action="{{ route('loan.update', $loan->id) }}">
                @csrf @method('PUT')
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Peminjam</label>
                    <select name="user_npm" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                        @foreach ($users as $user)
                            <option value="{{ $user->npm }}" {{ old('user_npm', $loan->user_npm) == $user->npm ? 'selected' : '' }}>
                                {{ $user->first_name }} {{ $user->last_name }} ({{ $user->npm }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Pinjam</label>
                    <input type="date" name="loan_at" value="{{ old('loan_at', $loan->loan_at) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Tanggal Kembali</label>
                    <input type="date" name="return_at" value="{{ old('return_at', $loan->return_at) }}" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">Update</button>
                    <a href="{{ route('loan') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">Batal</a>
                </div>
            </form>
        </div>
    </div></div>
</x-app-layout>