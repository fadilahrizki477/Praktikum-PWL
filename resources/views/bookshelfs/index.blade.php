<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Rak Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('bookshelf.create') }}">Tambah Rak Buku</x-primary-button>
            </div>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num = 1; @endphp
                @foreach($bookshelfs as $shelf)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $shelf->code }}</td>
                        <td>{{ $shelf->name }}</td>
                        <td>
                            <x-primary-button tag="a" href="{{ route('bookshelf.edit', $shelf->id) }}">Edit</x-primary-button>
                            <form action="{{ route('bookshelf.destroy', $shelf->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Apakah yakin ingin menghapus rak ini?');">
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