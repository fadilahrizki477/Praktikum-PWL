<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Tambah Pengembalian</h2></x-slot>
    <div class="py-8"><div class="max-w-xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 shadow-sm rounded-lg p-6">
            <form method="POST" action="{{ route('return.store') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Detail Peminjaman</label>
                    <select name="loan_detail_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                        <option value="">Pilih Detail</option>
                        @foreach ($loanDetails as $detail)
                            <option value="{{ $detail->id }}" {{ old('loan_detail_id') == $detail->id ? 'selected' : '' }}>
                                #{{ $detail->id }} - {{ $detail->book->title ?? '-' }} ({{ $detail->loan->user->first_name ?? '-' }})
                            </option>
                        @endforeach
                    </select>
                    @error('loan_detail_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="mb-4 flex items-center gap-2">
                    <input type="checkbox" name="charge" id="charge" value="1" {{ old('charge') ? 'checked' : '' }} class="rounded border-gray-300 text-blue-600">
                    <label for="charge" class="text-sm text-gray-700 dark:text-gray-300">Ada Denda</label>
                </div>
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jumlah Denda (Rp)</label>
                    <input type="number" name="amount" value="{{ old('amount', 0) }}" min="0" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm" required>
                    @error('amount') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="flex gap-3">
                    <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition">Simpan</button>
                    <a href="{{ route('return') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">Batal</a>
                </div>
            </form>
        </div>
    </div></div>
</x-app-layout>