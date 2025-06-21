<?php
// Sample news data
$newsItems = [
    [
        'id' => 1,
        'title' => 'Program Vaksinasi Gratis Bulan Ini',
        'excerpt' => 'Klinik Sehat menyelenggarakan program vaksinasi gratis untuk anak-anak dan lansia selama bulan ini.',
        'date' => '2023-06-15',
        'category' => 'Program',
        'image' => 'https://images.unsplash.com/photo-1576091160550-2173dba999ef?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'
    ],
    [
        'id' => 2,
        'title' => 'Tips Menjaga Kesehatan di Musim Hujan',
        'excerpt' => 'Dokter kami memberikan tips praktis untuk menjaga kesehatan selama musim hujan dan menghindari penyakit umum.',
        'date' => '2023-06-10',
        'category' => 'Tips',
        'image' => 'https://images.unsplash.com/photo-1505751172876-fa1923c5c528?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'
    ],
    [
        'id' => 3,
        'title' => 'Penambahan Fasilitas Laboratorium',
        'excerpt' => 'Klinik Sehat kini memiliki fasilitas laboratorium lengkap untuk pemeriksaan darah dan diagnostik lainnya.',
        'date' => '2023-06-05',
        'category' => 'Pengumuman',
        'image' => 'https://images.unsplash.com/photo-1579684385127-1ef15d508118?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80'
    ]
];
?>

<section class="py-12 md:py-16 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900 mb-4">
                Berita & Informasi Kesehatan
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                Update terbaru seputar kesehatan dan kegiatan di Klinik Sehat
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($newsItems as $news): ?>
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-300">
                    <div class="h-48 overflow-hidden">
                        <img src="<?= htmlspecialchars($news['image']) ?>" alt="<?= htmlspecialchars($news['title']) ?>" 
                             class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                    </div>
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-xs font-semibold px-2 py-1 bg-blue-100 text-blue-800 rounded-full">
                                <?= htmlspecialchars($news['category']) ?>
                            </span>
                            <span class="text-sm text-gray-500">
                                <?= date('d M Y', strtotime($news['date'])) ?>
                            </span>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2 hover:text-blue-600 transition-colors">
                            <?= htmlspecialchars($news['title']) ?>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            <?= htmlspecialchars($news['excerpt']) ?>
                        </p>
                        <a href="#" class="inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                            Baca selengkapnya
                            <i data-lucide="arrow-right" class="h-4 w-4 ml-1"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="text-center mt-10">
            <a href="#" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-sm text-white bg-gradient-to-r from-blue-600 to-green-600 hover:from-blue-700 hover:to-green-700 transition-all duration-200">
                Lihat Semua Berita
                <i data-lucide="chevron-right" class="h-5 w-5 ml-2"></i>
            </a>
        </div>
    </div>
</section>
