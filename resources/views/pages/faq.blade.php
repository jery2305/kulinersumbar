<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>FAQ - Kuliner Sumbar</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Tailwind CSS dan Flowbite -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>

    <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans leading-relaxed tracking-wide flex flex-col min-h-screen">

    <main class="flex-grow py-16 bg-white text-gray-800">
        <div class="max-w-4xl mx-auto px-6">
            <h1 class="text-4xl font-bold text-center mb-10 text-red-600">Pertanyaan yang Sering Diajukan (FAQ)</h1>

            <div id="accordion-flush" data-accordion="collapse" data-active-classes="bg-white text-red-600" class="space-y-3">
                <!-- FAQ 1 -->
                        <div class="border-b border-gray-200">
                            <h2 id="faq-1">
                                <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-700" data-accordion-target="#faq-1-body" aria-expanded="true" aria-controls="faq-1-body">
                                    <span>Bagaimana cara mendaftar akun di website ini?</span>
                                    <svg data-accordion-icon class="w-4 h-4 rotate-180 shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                            </button>
                    </h2>
                    <div id="faq-1-body" class="hidden" aria-labelledby="faq-1">
                        <div class="py-4 text-gray-600">
                            Klik tombol "Daftar" di beranda atau login. Isi nama, email, dan password, lalu klik "Kirim".
                        </div>
                    </div>
                </div>

                <!-- FAQ 2 -->
                <div class="border-b border-gray-200">
                    <h2 id="faq-2">
                        <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-700" data-accordion-target="#faq-2-body" aria-expanded="false" aria-controls="faq-2-body">
                            <span>Bagaimana cara memesan makanan?</span>
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </h2>
                    <div id="faq-2-body" class="hidden" aria-labelledby="faq-2">
                        <div class="py-4 text-gray-600">
                            Buka halaman <a href="{{ route('menu') }}" class="text-red-600 underline">Menu</a>, pilih makanan, klik "Pesan", lalu lanjut ke checkout.
                        </div>
                    </div>
                </div>

                <!-- FAQ 3 -->
                <div class="border-b border-gray-200">
                    <h2 id="faq-3">
                        <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-700" data-accordion-target="#faq-3-body" aria-expanded="false" aria-controls="faq-3-body">
                            <span>Apa saja metode pembayaran yang tersedia?</span>
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </h2>
                    <div id="faq-3-body" class="hidden" aria-labelledby="faq-3">
                        <div class="py-4 text-gray-600">
                            Transfer bank, e-wallet, dan Cash on Delivery (COD) tersedia untuk area tertentu.
                        </div>
                    </div>
                </div>

                <!-- FAQ 4 -->
                <div class="border-b border-gray-200">
                    <h2 id="faq-4">
                        <button type="button" class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-700" data-accordion-target="#faq-4-body" aria-expanded="false" aria-controls="faq-4-body">
                            <span>Apakah bisa diakses melalui perangkat mobile?</span>
                            <svg data-accordion-icon class="w-4 h-4 shrink-0 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </h2>
                    <div id="faq-4-body" class="hidden" aria-labelledby="faq-4">
                        <div class="py-4 text-gray-600">
                            Ya, situs ini sepenuhnya responsif dan nyaman digunakan di smartphone dan tablet.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tombol Kembali -->
            <div class="mt-12 text-center">
                <x-back-home />
            </div>
        </div>
    </main>

    <!-- Footer -->
    <x-footer />

</body>
</html>
