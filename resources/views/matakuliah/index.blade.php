<x-layoutAdmin>
    <section class="content-header">
        <h1>Data Mata Kuliah</h1>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="/mata-kuliah/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Mata Kuliah
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
                            <th>Kode MK</th>
                            <th>Nama MK</th>
                            <th>SKS</th>
                            <th>Dosen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataMataKuliah as $data)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $data->kode_mk }}</td>
                                <td>{{ $data->nama_mk }}</td>
                                <td>{{ $data->sks }}</td>
                                <td>{{ $data->dosen->name ?? 'belum ada dosen' }}</td>
                                <td>
                                   <a href="{{ route('editMataKuliah', $data->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i></a>
                                   <form action="{{ route('deleteMataKuliah', $data->id) }}" method="POST" style="display:inline-block"
                                        onsubmit="return confirm('Hapus mata kuliah ini?')">
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
