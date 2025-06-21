<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Klinik Sehat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Font Awesome untuk ikon WhatsApp -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="bg-white text-gray-800">

  <!-- Header/Navbar -->
  <header class="bg-white shadow-md sticky top-0 z-50">
  <div class="container mx-auto flex justify-between items-center p-4">
    
    <!-- Kiri: Logo -->
    <h1 class="text-xl font-bold text-green-600">Klinik Sehat</h1>
    
    <!-- Kanan: Navigasi + WA + Login -->
    <div class="flex items-center space-x-4">
      
      <!-- Navigasi -->
      <nav class="flex space-x-4 items-center">
        <a href="#beranda" class="hover:text-green-600">Beranda</a>
        <a href="#layanan" class="hover:text-green-600">Layanan</a>
        <a href="#artikel" class="hover:text-green-600">Artikel</a>
        <a href="#kontak" class="hover:text-green-600">Kontak</a>
      </nav>

      <!-- WhatsApp Icon -->
      <a href="https://wa.me/6281234567890" target="_blank"
         class="bg-green-500 hover:bg-green-600 text-white text-xl rounded-full w-10 h-10 flex items-center justify-center shadow">
        <i class="fab fa-whatsapp"></i>
      </a>

      <!-- Login Button -->
      <a href="/login.html" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm shadow">
        Login
      </a>

    </div>
  </div>
</header>


  <!-- Hero Section -->
  <section id="beranda" class="bg-green-50 py-20 text-center">
    <div class="container mx-auto">
      <h2 class="text-4xl font-bold text-green-700 mb-4">Kesehatan Anda, Prioritas Kami</h2>
      <p class="text-lg text-gray-600">Layanan kesehatan modern dan terpercaya untuk Anda dan keluarga.</p>
    </div>
  </section>

  <!-- Layanan Section -->
  <section id="layanan" class="py-16 bg-white text-center">
    <div class="container mx-auto">
      <h3 class="text-3xl font-semibold mb-6 text-green-700">Layanan Kami</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="p-6 shadow rounded-lg border">
          <h4 class="text-xl font-semibold mb-2">Konsultasi Umum</h4>
          <p class="text-sm text-gray-600">Layanan dokter umum untuk berbagai keluhan kesehatan.</p>
        </div>
        <div class="p-6 shadow rounded-lg border">
          <h4 class="text-xl font-semibold mb-2">Pemeriksaan Lab</h4>
          <p class="text-sm text-gray-600">Cek darah, urin, dan pemeriksaan laboratorium lainnya.</p>
        </div>
        <div class="p-6 shadow rounded-lg border">
          <h4 class="text-xl font-semibold mb-2">Vaksinasi</h4>
          <p class="text-sm text-gray-600">Layanan vaksinasi lengkap untuk semua usia.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Artikel Kesehatan -->
  <section id="artikel" class="py-16 bg-green-50">
    <div class="container mx-auto text-center">
      <h3 class="text-3xl font-semibold mb-8 text-green-700">Artikel Kesehatan</h3>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 shadow rounded-lg text-left">
          <h4 class="text-xl font-semibold text-green-700 mb-2">Manfaat Cek Kesehatan Rutin</h4>
          <p class="text-sm text-gray-600">Cek kesehatan berkala membantu mendeteksi penyakit sejak dini. <a href="#" class="text-green-600 hover:underline">Baca Selengkapnya</a></p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-left">
          <h4 class="text-xl font-semibold text-green-700 mb-2">Tips Pola Hidup Sehat</h4>
          <p class="text-sm text-gray-600">Mulai dari makan seimbang hingga olahraga teratur. <a href="#" class="text-green-600 hover:underline">Baca Selengkapnya</a></p>
        </div>
        <div class="bg-white p-4 shadow rounded-lg text-left">
          <h4 class="text-xl font-semibold text-green-700 mb-2">Vaksinasi Anak, Kenapa Penting?</h4>
          <p class="text-sm text-gray-600">Perlindungan terhadap penyakit menular sejak dini. <a href="#" class="text-green-600 hover:underline">Baca Selengkapnya</a></p>
        </div>
      </div>
    </div>
  </section>

  <!-- Kontak -->
  <section id="kontak" class="py-16 bg-white text-center">
    <div class="container mx-auto">
      <h3 class="text-3xl font-semibold text-green-700 mb-4">Kontak Kami</h3>
      <p class="text-gray-600">Alamat: Jl. Sehat No. 123, Jakarta<br>Email: info@kliniksehat.id<br>Telepon: 021-12345678</p>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-100 py-8 text-center">
    <p class="text-sm text-gray-600">© 2025 Klinik Sehat. Semua Hak Dilindungi.</p>
  </footer>

</body>
</html>
