<x-layoutAdmin>
    <section class="content-header">
        <h1>Data Jadwal Kuliah</h1>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-header">
                <a href="jadwal-kuliah/create" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Tambah Jadwal
                </a>
            </div>

            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Waktu</th>
                            <th>Mata Kuliah</th>
                            <th>Ruang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($dataJadwalKuliah as $jadwal)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jadwal->hari }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }} -
                                    {{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}
                                </td>
                                <td>
                                    {{ $jadwal->mataKuliah->nama_mk ?? 'N/A' }}
                                </td>
                                <td>{{ $jadwal->ruang ?? '-' }}</td>
                                <td>
                                    <a href="{{ route('editJadwalKuliah', $jadwal->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('deleteJadwalKuliah', $jadwal->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
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
                                <td class="text-center" colspan="7">Data Jadwal Belum Ada</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-layoutAdmin>
