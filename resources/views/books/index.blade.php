<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Buku') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('book.create') }}">Tambah Data Buku</x-primary-button>
                <x-primary-button tag="a" href="{{ route('book.print') }}" target="blank">Print Data Buku</x-primary-button>
                <x-primary-button tag="a" href="{{ route('book.export') }}" target="blank">Export Data Buku</x-primary-button>
                <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal','import-book')">
                    {{ __('Import Data Excel') }}
                </x-primary-button>
            </div>

            <x-modal name="import-book" focusable maxWidth="xl">
                <form method="POST" action="{{ route('book.import') }}" class="p-6" enctype="multipart/form-data">
                    @csrf
                    <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                        {{ __('Import Data Buku') }}
                    </h2>
                    <div class="mt-4 max-w-xl">
                        <x-input-label for="file" value="File Excel (.xlsx, .xls)" />
                        <input type="file" id="file" name="file" accept=".xlsx,.xls"
                            class="mt-1 block w-full text-sm text-gray-700 border border-gray-300 rounded-lg cursor-pointer" required />
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            {{ __('Batal') }}
                        </x-secondary-button>
                        <x-primary-button type="submit">
                            {{ __('Upload') }}
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>Judul</th>
                        <th>Penulis</th>
                        <th>Tahun</th>
                        <th>Penerbit</th>
                        <th>Kota</th>
                        <th>Cover</th>
                        <th>Rak</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num = 1; @endphp
                @foreach($books as $book)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->year }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->city }}</td>
                        <td>
                            @if($book->cover)
                                <img src="{{ asset('storage/' . $book->cover) }}" width="80px" alt="Cover" class="rounded" />
                            @else
                                <span class="text-gray-400 text-sm">No image</span>
                            @endif
                        </td>
                        <td>{{ $book->bookshelf->code ?? '-' }}-{{ $book->bookshelf->name ?? '-' }}</td>
                        <td>
                            <x-primary-button tag="a" href="{{ route('book.edit', $book->id) }}">Edit</x-primary-button>
                            <form action="{{ route('book.destroy', $book->id) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Apakah yakin ingin menghapus buku ini?');">
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