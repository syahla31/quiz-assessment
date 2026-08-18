<div class="py-6">
    <div class="mb-6">
        <a href="{{ route('admin.quizzes.index') }}" class="text-sm font-medium text-indigo-600 hover:underline flex items-center gap-1 mb-2">
            &larr; Kembali ke Daftar Kuis
        </a>
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $quiz->title }}</h1>
                <p class="text-sm text-gray-500">Kelola daftar pertanyaan dan bobot pilihan jawaban.</p>
            </div>
            <button wire:click="openModal" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-sm transition">
                + Tambah Pertanyaan
            </button>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
            {{ session('message') }}
        </div>
    @endif

    <div class="space-y-4">
        @forelse($quiz->questions as $index => $q)
            <div class="bg-white rounded-2xl border border-gray-200 p-5 shadow-sm">
                <div class="flex justify-between items-start">
                    <div class="flex gap-3">
                        <span class="font-bold text-gray-400">#{{ $index + 1 }}</span>
                        <div>
                            <h3 class="font-semibold text-gray-900 text-base">{{ $q->question_text }}</h3>
                            <div class="mt-3 grid grid-cols-2 md:grid-cols-4 gap-2">
                                @foreach($q->options as $opt)
                                    <div class="bg-gray-50 border border-gray-100 rounded-lg px-3 py-1.5 text-xs">
                                        <span class="text-gray-700 font-medium">{{ $opt->option_text }}</span>
                                        <span class="text-indigo-600 font-semibold ml-1">(Skor: {{ $opt->score }})</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 ml-4">
                        <button wire:click="editQuestion({{ $q->id }})" class="text-amber-600 hover:text-amber-700 text-xs font-semibold px-2 py-1 bg-amber-50 rounded-lg">Edit</button>
                        <button wire:click="deleteQuestion({{ $q->id }})" onclick="return confirm('Hapus pertanyaan ini?') || event.stopImmediatePropagation()" class="text-red-600 hover:text-red-700 text-xs font-semibold px-2 py-1 bg-red-50 rounded-lg">Hapus</button>
                    </div>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-2xl border border-dashed border-gray-300 p-8 text-center text-gray-400">
                Belum ada pertanyaan pada kuis ini. Klik "+ Tambah Pertanyaan".
            </div>
        @endforelse
    </div>

    <!-- Modal Form Pertanyaan & Opsi -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4 overflow-y-auto">
            <div class="bg-white rounded-2xl max-w-xl w-full p-6 shadow-xl my-8">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    {{ $questionId ? 'Edit Pertanyaan' : 'Tambah Pertanyaan Baru' }}
                </h3>

                <form wire:submit.prevent="saveQuestion" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teks Pertanyaan</label>
                        <textarea wire:model="questionText" rows="2" class="w-full border border-gray-300 rounded-xl px-3.5 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Tuliskan pernyataan atau soal asesmen..."></textarea>
                        @error('questionText') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <label class="text-sm font-semibold text-gray-700">Pilihan Opsi Jawaban & Bobot Skor</label>
                            <button type="button" wire:click="addOptionRow" class="text-xs text-indigo-600 font-semibold hover:underline">+ Tambah Baris Opsi</button>
                        </div>

                        <div class="space-y-2">
                            @foreach($options as $index => $opt)
                                <div class="flex items-center gap-2">
                                    <input type="text" wire:model="options.{{ $index }}.option_text" class="flex-grow border border-gray-300 rounded-lg px-3 py-1.5 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Teks opsi (misal: Tidak Pernah, Sering)">
                                    <input type="number" wire:model="options.{{ $index }}.score" class="w-20 border border-gray-300 rounded-lg px-3 py-1.5 text-xs focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Skor">
                                    @if(count($options) > 2)
                                        <button type="button" wire:click="removeOptionRow({{ $index }})" class="text-red-500 hover:text-red-700 text-sm px-1 font-bold">&times;</button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                        <button type="button" wire:click="resetModal" class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-xl text-sm hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-xl text-sm hover:bg-indigo-700 transition">
                            Simpan Pertanyaan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>