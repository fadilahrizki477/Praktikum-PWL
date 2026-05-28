<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Pengembalian') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('return.create') }}">Tambah Pengembalian</x-primary-button>
            </div>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Denda</th>
                        <th>Jumlah</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num = 1; @endphp
                @foreach($returns as $return)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $return->loanDetail->loan->user->first_name ?? '-' }}</td>
                        <td>{{ $return->loanDetail->book->title ?? '-' }}</td>
                        <td>
                            @if($return->charge)
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">Ada Denda</span>
                            @else
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">Tidak Ada</span>
                            @endif
                        </td>
                        <td>Rp {{ number_format($return->amount, 0, ',', '.') }}</td>
                        <td>
                            <x-primary-button tag="a" href="{{ route('return.edit', $return->id) }}">Edit</x-primary-button>
                            <form action="{{ route('return.destroy', $return->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Apakah yakin ingin menghapus data ini?');">
                                @csrf
                                @method('DELETE')
                                <x-danger-button type="submit">Hapus</x-danger-button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </x-table>
        </div>
    </div>
</x-app-layout>