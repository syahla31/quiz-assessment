<div class="py-6">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Kuis & Asesmen</h1>
            <p class="text-sm text-gray-500">Tambah, ubah, atau hapus asesmen serta kelola butir soalnya.</p>
        </div>
        <button wire:click="openModal" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-xl shadow-sm transition">
            + Tambah Kuis
        </button>
    </div>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-xl text-sm font-medium">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-gray-700 uppercase font-semibold text-xs border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4">Judul Asesmen</th>
                    <th class="px-6 py-4">Jumlah Soal</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($quizzes as $quiz)
                    <tr class="hover:bg-gray-50/50 transition">
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">{{ $quiz->title }}</div>
                            <div class="text-xs text-gray-500 mt-0.5 line-clamp-1">{{ $quiz->description ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="px-2.5 py-1 text-xs font-semibold rounded-full bg-indigo-50 text-indigo-700">
                                {{ $quiz->questions_count }} Soal
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right space-x-2">
                            <a href="{{ route('admin.quizzes.questions', $quiz->id) }}" class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-700 hover:bg-blue-100 rounded-lg text-xs font-medium transition">
                                Kelola Soal
                            </a>
                            <button wire:click="edit({{ $quiz->id }})" class="inline-flex items-center px-3 py-1.5 bg-amber-50 text-amber-700 hover:bg-amber-100 rounded-lg text-xs font-medium transition">
                                Edit
                            </button>
                            <button wire:click="delete({{ $quiz->id }})" onclick="return confirm('Hapus kuis ini beserta semua soalnya?') || event.stopImmediatePropagation()" class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-700 hover:bg-red-100 rounded-lg text-xs font-medium transition">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-400">
                            Belum ada kuis yang dibuat. Klik tombol "+ Tambah Kuis" di atas.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $quizzes->links() }}
    </div>

    <!-- Modal Form -->
    @if($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/40 backdrop-blur-sm p-4">
            <div class="bg-white rounded-2xl max-w-lg w-full p-6 shadow-xl">
                <h3 class="text-lg font-bold text-gray-900 mb-4">
                    {{ $isEditMode ? 'Edit Kuis' : 'Tambah Kuis Baru' }}
                </h3>

                <form wire:submit.prevent="store" class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Kuis / Asesmen</label>
                        <input type="text" wire:model="title" class="w-full border border-gray-300 rounded-xl px-3.5 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Contoh: DASS-21 Stress Test">
                        @error('title') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea wire:model="description" rows="3" class="w-full border border-gray-300 rounded-xl px-3.5 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:outline-none" placeholder="Deskripsi singkat mengenai tes..."></textarea>
                        @error('description') <span class="text-red-600 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="flex justify-end gap-3 pt-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-100 text-gray-700 font-medium rounded-xl text-sm hover:bg-gray-200 transition">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-medium rounded-xl text-sm hover:bg-indigo-700 transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>