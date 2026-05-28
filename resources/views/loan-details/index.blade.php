<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('loan-detail.create') }}">Tambah Detail</x-primary-button>
            </div>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Peminjam</th>
                        <th>Buku</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num = 1; @endphp
                @foreach($loanDetails as $detail)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $detail->loan->user->first_name ?? '-' }}</td>
                        <td>{{ $detail->book->title ?? '-' }}</td>
                        <td>
                            @if($detail->is_return)
                                <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">Dikembalikan</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-xs">Belum Kembali</span>
                            @endif
                        </td>
                        <td>
                            <x-primary-button tag="a" href="{{ route('loan-detail.edit', $detail->id) }}">Edit</x-primary-button>
                            <form action="{{ route('loan-detail.destroy', $detail->id) }}" method="POST" class="inline-block"
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