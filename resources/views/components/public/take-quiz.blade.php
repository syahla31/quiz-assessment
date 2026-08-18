<div class="max-w-4xl mx-auto py-8 px-4">
    <h1 class="text-2xl font-bold mb-2">{{ $quiz->title }}</h1>
    <p class="text-gray-600 mb-6">{{ $quiz->description }}</p>

    <form wire:submit.prevent="submit">
        @foreach($quiz->questions as $index => $question)
            <div class="mb-6 p-4 border rounded-lg bg-white shadow-sm">
                <h3 class="font-semibold text-lg mb-3">
                    {{ $index + 1 }}. {{ $question->question_text }}
                </h3>

                <div class="space-y-2">
                    @foreach($question->options as $option)
                        <label class="flex items-center space-x-3 p-2 border rounded hover:bg-gray-50 cursor-pointer">
                            <input type="radio" 
                                   wire:model="answers.{{ $question->id }}" 
                                   value="{{ $option->id }}" 
                                   class="form-radio text-blue-600">
                            <span>{{ $option->option_text }}</span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach

        @error('answers')
            <div class="text-red-500 mb-4 font-semibold">{{ $message }}</div>
        @enderror

        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700">
            Kirim Jawaban
        </button>
    </form>
</div>