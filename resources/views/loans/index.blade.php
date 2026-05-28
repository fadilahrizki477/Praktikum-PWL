<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Peminjaman') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('loan.create') }}">Tambah Peminjaman</x-primary-button>
            </div>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Peminjam</th>
                        <th>NPM</th>
                        <th>Tgl Pinjam</th>
                        <th>Tgl Kembali</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num = 1; @endphp
                @foreach($loans as $loan)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $loan->user->first_name ?? '-' }} {{ $loan->user->last_name ?? '' }}</td>
                        <td>{{ $loan->user_npm }}</td>
                        <td>{{ $loan->loan_at }}</td>
                        <td>{{ $loan->return_at }}</td>
                        <td>
                            <x-primary-button tag="a" href="{{ route('loan.edit', $loan->id) }}">Edit</x-primary-button>
                            <form action="{{ route('loan.destroy', $loan->id) }}" method="POST" class="inline-block"
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