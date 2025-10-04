<x-layoutAdmin>
    <section class="content-header">
        <h1>Data Mahasiswa</h1>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="/data-mahasiswa/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Mahasiswa
                </a>
            </div>

            <div class="card-body">
                {{-- ALERT SUCCESS --}}
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>NPM/NIP</th>
                            <th>Email</th>
                            <th>No Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataMahasiswa as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->npm }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->no_telepon }}</td>
                                <td>
                                   <a href="{{ route('editMahasiswa', $data->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i></a>
                                   <form action="{{ route('deleteMahasiswa', $data->id) }}" method="POST" style="display:inline-block"
                                        onsubmit="return confirm('Hapus mahasiswa ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="6">Data belum ada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-layoutAdmin>
