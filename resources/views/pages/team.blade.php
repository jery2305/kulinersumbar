<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tim Pengembang - Kuliner Sumbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

    <!-- Jika kamu pakai Vite atau asset Laravel -->
    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-relaxed tracking-wide flex flex-col min-h-screen">

    <!-- Konten Utama -->
    <main class="flex-grow">
        <div class="container mx-auto px-4 py-12">
            <h1 class="text-3xl font-bold text-center mb-10 text-gray-800">Tim Pengembang Website Kuliner</h1>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Anggota 1 -->
                <div class="bg-white shadow-md rounded-2xl p-6 text-center">
                    <img src="img/raihan.jpg" alt="Raihan" class="mx-auto mb-4 rounded-full w-32 h-32 object-cover">
                    <h2 class="text-xl font-semibold text-gray-800">Mhd. Raihan Albarikh</h2>
                    <p class="text-gray-600">Ketua Proyek</p>
                    <p class="text-sm mt-2 text-gray-500">Manajemen proyek dan koordinasi seluruh tim serta penyusunan struktur sistem.</p>
                </div>

                <!-- Anggota 2 -->
                <div class="bg-white shadow-md rounded-2xl p-6 text-center">
                    <img src="img/jery.jpg" alt="Jery Chandra" class="mx-auto mb-4 rounded-full w-32 h-32 object-cover">
                    <h2 class="text-xl font-semibold text-gray-800">Jery Chandra</h2>
                    <p class="text-gray-600">Front-End Developer</p>
                    <p class="text-sm mt-2 text-gray-500">Mendesain tampilan UI menggunakan Blade & Tailwind CSS agar website menarik dan responsif.</p>
                </div>

                <!-- Anggota 3 -->
                <div class="bg-white shadow-md rounded-2xl p-6 text-center">
                    <img src="img/ghandi.jpg" alt="Ghandi Mahesa" class="mx-auto mb-4 rounded-full w-32 h-32 object-cover">
                    <h2 class="text-xl font-semibold text-gray-800">Ghandi Mahesa</h2>
                    <p class="text-gray-600">Back-End Developer</p>
                    <p class="text-sm mt-2 text-gray-500">Membangun fitur login, Registrasi, serta pengelolaan data dengan Laravel.</p>
                </div>

                <!-- Anggota 4 -->
                <div class="bg-white shadow-md rounded-2xl p-6 text-center">
                    <img src="img/angel.jpg" alt="Angelica Jolie P.S" class="mx-auto mb-4 rounded-full w-32 h-32 object-cover">
                    <h2 class="text-xl font-semibold text-gray-800">Angelica Jolie P.S</h2>
                    <p class="text-gray-600">Back-End Developer</p>
                    <p class="text-sm mt-2 text-gray-500">Bertugas pada validasi form, koneksi database, dan proses checkout.</p>
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
