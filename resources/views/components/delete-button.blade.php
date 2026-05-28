@props(['action'])

<form method="POST" action="{{ $action }}" class="inline" id="form-{{ md5($action) }}">
    @csrf
    @method('DELETE')
    <button type="button"
        onclick="confirmDelete('{{ md5($action) }}')"
        class="inline-flex items-center px-3 py-1.5 bg-red-600 hover:bg-red-700 text-white text-sm font-medium rounded-lg transition">
        Hapus
    </button>
</form>

@once
@push('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Yakin ingin menghapus?',
            text: 'Data yang dihapus tidak bisa dikembalikan!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6b7280',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-' + id).submit();
            }
        });
    }
</script>
@endpush
@endonce