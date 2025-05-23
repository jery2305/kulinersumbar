<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark shadow-sm" style="background: linear-gradient(to right, #ef4444, #facc15);">
  <div class="container">
    <a class="navbar-brand fw-bold fs-4 d-flex align-items-center" href="#">
      <i class="bi bi-speedometer2 me-2 fs-3"></i>Admin KulinerSumbar
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar" aria-controls="adminNavbar" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-end" id="adminNavbar">
      <ul class="navbar-nav align-items-center">
        <li class="nav-item me-3 d-none d-lg-flex align-items-center">
          <span class="navbar-text text-white">
            Selamat Datang, <strong>Admin!</strong>
          </span>
        </li>
        <li class="nav-item">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-outline-light btn-sm rounded-pill">
              <i class="bi bi-box-arrow-right me-1"></i> Logout
            </button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>

<main class="container py-4">
    @yield('content')
</main>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

    <!-- Footer -->
     <footer class="bg-dark text-white text-center py-3 mt-5">
        <div class="container">
            <small>© {{ date('Y') }} KulinerSumbar Admin Panel — v1.0</small>
        </div>
    </footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
