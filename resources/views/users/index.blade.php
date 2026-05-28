<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Users') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <x-primary-button tag="a" href="{{ route('user.create') }}">Tambah Data User</x-primary-button>
            </div>

            <x-table>
                <x-slot name="header">
                    <tr>
                        <th>#</th>
                        <th>NPM</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </x-slot>

                @php $num = 1; @endphp
                @foreach($users as $user)
                    <tr>
                        <td>{{ $num++ }}</td>
                        <td>{{ $user->npm }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <x-primary-button tag="a" href="{{ route('user.edit', $user->npm) }}">Edit</x-primary-button>
                            <form action="{{ route('user.destroy', $user->npm) }}" method="POST" class="inline-block"
                                onsubmit="return confirm('Apakah yakin ingin menghapus user ini?');">
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