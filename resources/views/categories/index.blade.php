<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Kategori') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('category.create') }}">Tambah Kategori</x-primary-button>
            </div>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num = 1; @endphp
                @foreach($categories as $cat)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $cat->category }}</td>
                        <td>
                            <x-primary-button tag="a" href="{{ route('category.edit', $cat->id) }}">Edit</x-primary-button>
                            <form action="{{ route('category.destroy', $cat->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Apakah yakin ingin menghapus kategori ini?');">
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