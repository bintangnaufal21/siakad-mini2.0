<x-layoutAdmin>
    <section class="content-header">
        <h1>Edit Mata Kuliah</h1>
    </section>

    <section class="content">
        <div class="card">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('updateMataKuliah', $mataKuliah->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>Kode Mata Kuliah</label>
                                <input type="text" name="kode_mk"
                                    class="form-control @error('kode_mk') is-invalid @enderror"
                                    value="{{ old('kode_mk', $mataKuliah->kode_mk) }}" placeholder="Masukkan Kode Mata Kuliah">
                                @error('kode_mk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>Nama Mata Kuliah</label>
                                <input type="text" name="nama_mk"
                                    class="form-control @error('nama_mk') is-invalid @enderror"
                                    value="{{ old('nama_mk', $mataKuliah->nama_mk) }}" placeholder="Masukkan nama Mata Kuliah">
                                @error('nama_mk')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>SKS</label>
                                <input type="number" name="sks"
                                    class="form-control @error('sks') is-invalid @enderror"
                                    value="{{ old('sks', $mataKuliah->sks) }}" placeholder="Masukkan sks">
                                @error('sks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>Dosen Pengampu</label>
                                <select name="dosen_id" id="dosen_id" class="form-select">
                                    <option value="">-- Pilih Dosen --</option>
                                    @foreach ($dosen as $dosen)
                                        <option value="{{ $dosen->id }}"
                                            {{ old('user_id', $mataKuliah->user_id) == $dosen->id ? 'selected' : '' }}>
                                            {{ $dosen->name }}
                                        </option>\
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('mataKuliah') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
</x-layoutAdmin>
