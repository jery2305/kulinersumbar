<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Pendaftaran</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card shadow rounded-4">
                    <div class="card-header bg-primary text-white text-center rounded-top-4">
                        <h4>Formulir Pendaftaran</h4>
                    </div>
                    <div class="card-body">

                        <!-- Flash message -->
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <!-- Form -->
                        <form action="{{ url('/register') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror"
                                    value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="role" class="form-label">Daftar Sebagai</label>
                                <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required>
                                    <option value="user" {{ old('role')=='user'? 'selected':'' }}>User</option>
                                    <option value="admin" {{ old('role')=='admin'? 'selected':'' }}>Admin</option>
                                </select>
                                @error('role')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="mb-3">
                                <label for="password" class="form-label">Kata Sandi</label>
                                <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Daftar</button>
                        </form>

                        <div class="text-center mt-3">
                            <small>Sudah punya akun? <a href="{{ route('login') }}">Login di sini</a></small>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
