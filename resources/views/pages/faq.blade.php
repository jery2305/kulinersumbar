<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title> FAQ - Kuliner Sumbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

    <!-- Jika kamu pakai Vite atau asset Laravel -->
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-relaxed tracking-wide flex flex-col min-h-screen">

 <!-- FAQ Content -->
    <main class="flex-grow py-16 bg-white text-gray-800">
        <div class="max-w-4xl mx-auto px-4">
            <h1 class="text-4xl font-bold text-center mb-10">Pertanyaan yang Sering Diajukan (FAQ)</h1>

            <div class="space-y-6">
                <!-- FAQ 1 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Bagaimana cara mendaftar akun di website ini?</h2>
                    <p>Untuk mendaftar akun, klik tombol "Daftar" yang terdapat di halaman beranda atau halaman login. Isikan data diri Anda, seperti nama, email, dan password, kemudian klik "Kirim" untuk membuat akun baru.</p>
                </div>
                
                <!-- FAQ 2 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Bagaimana cara memesan makanan?</h2>
                    <p>Silakan kunjungi halaman <a href="{{ route('menu') }}" class="text-red-600 underline">Menu</a>, pilih makanan yang Anda suka, lalu klik "Pesan" dan lanjutkan ke proses checkout.</p>
                </div>

                <!-- FAQ 3 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Apa saja metode pembayaran yang tersedia?</h2>
                    <p>Kami menerima pembayaran melalui transfer bank, e-wallet, dan Cash on Delivery (COD) untuk area tertentu.</p>
                </div>

                <!-- FAQ 4 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow">
                    <h2 class="text-xl font-semibold mb-2">Apakah saya bisa mengakses website ini melalui perangkat mobile?</h2>
                    <p>Ya, website ini sepenuhnya responsif dan dapat diakses dengan baik di perangkat mobile, seperti smartphone dan tablet. Anda bisa menikmati pengalaman pengguna yang optimal baik di desktop maupun perangkat mobile.</p>
                </div>
            </div>
        
            <!-- Tombol Kembali ke Home -->
            <x-back-home />

        </div>
    </main>

    <!-- Footer -->
    <x-footer />

</body>
</html>