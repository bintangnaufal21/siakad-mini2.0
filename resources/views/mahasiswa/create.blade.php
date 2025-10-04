<x-layoutAdmin>
    <section class="content-header">
        <h1>Tambah Mahasiswa</h1>
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
                <form method="POST" action="{{ route('storeMahasiswa') }}">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>Nama</label>
                                <input type="text" name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name' ?? '') }}" placeholder="Masukkan nama">
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>NPM</label>
                                <input type="number" name="npm"
                                    class="form-control @error('npm') is-invalid @enderror"
                                    value="{{ old('npm' ?? '') }}" placeholder="Masukkan NPM">
                                @error('npm')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>Email</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email' ?? '') }}" placeholder="Masukkan email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>No Telepon</label>
                                <input type="number" name="no_telepon"
                                    class="form-control @error('no_telepon') is-invalid @enderror"
                                    value="{{ old('no_telepon' ?? '') }}" placeholder="Masukkan no telepon">
                                @error('no_telepon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>Password @if (isset($mahasiswa))
                                        <small>(Kosongkan jika tidak diubah)</small>
                                    @endif
                                </label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group mb-3">
                                <label>Konfirmasi Password</label>
                                <input type="password" name="password_confirmation" class="form-control"
                                    placeholder="Ulangi password">
                            </div>
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('dataMahasiswa') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" placeholder="Masukkan nama">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>NPM</label>
                                <input type="number" class="form-control" placeholder="Masukkan NPM">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" placeholder="Masukkan email">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>No telepon</label>
                                <input type="number" class="form-control" placeholder="Masukkan no telepon">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder="Masukkan password">
                            </div>
                        </div>
                        <div class="col-6"></div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <a href="{{ route('dataMahasiswa') }}" class="btn btn-secondary">Kembali</a>
                        </div>
                    </div> --}}
                </form>
            </div>
        </div>
    </section>
</x-layoutAdmin>


