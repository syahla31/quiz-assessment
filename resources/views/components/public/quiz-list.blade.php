<div class="py-6">
    <!-- Header Section -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Daftar Asesmen & Kuis</h1>
        <p class="text-gray-600 mt-1">Pilih asesmen psikologi atau kuis di bawah ini untuk mulai mengukur dan mengevaluasi diri.</p>
    </div>

    <!-- Quiz Grid -->
    @if($quizzes->isEmpty())
        <div class="bg-white rounded-xl border border-dashed border-gray-300 p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
            </svg>
            <h3 class="text-base font-semibold text-gray-900">Belum ada kuis tersedia</h3>
            <p class="text-sm text-gray-500 mt-1">Data kuis belum dibuat atau belum di-seeding.</p>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($quizzes as $quiz)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm hover:shadow-md transition-shadow p-6 flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-3">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-indigo-50 text-indigo-700">
                                {{ $quiz->questions_count ?? $quiz->questions->count() }} Pertanyaan
                            </span>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900 mb-2">{{ $quiz->title }}</h2>
                        <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                            {{ $quiz->description ?? 'Tidak ada deskripsi tersedia.' }}
                        </p>
                    </div>

                    <div class="pt-4 border-t border-gray-100 mt-2">
                        <a href="{{ route('quiz.take', $quiz->id) }}" 
                           class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-semibold rounded-xl shadow-sm transition-colors">
                            Mulai Asesmen
                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>