<div class="max-w-3xl mx-auto py-10 px-4">
    <div class="bg-white p-6 rounded-lg shadow-md text-center">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Hasil Asesmen</h2>
        <p class="text-gray-500 mb-4">{{ $submission->quiz->title }}</p>

        <div class="bg-blue-50 p-6 rounded-lg my-6">
            <span class="text-sm font-semibold text-blue-600 uppercase tracking-wide">Skor Akhir</span>
            <div class="text-5xl font-extrabold text-blue-700 my-2">{{ $submission->score }}</div>
            <p class="text-lg font-medium text-gray-700">Kategori: <span class="font-bold text-blue-800">{{ $category }}</span></p>
        </div>

        <a href="/" class="inline-block bg-gray-600 text-white px-5 py-2 rounded hover:bg-gray-700">
            Kembali ke Beranda
        </a>
    </div>
</div>