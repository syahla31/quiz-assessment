<?php

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

new class extends Component
{
    public string $email = '';

    public string $password = '';

    public bool $remember = false;

    public function login(): void
    {
        $credentials = $this->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (! Auth::attempt($credentials, $this->remember)) {
            $this->addError('email', 'Email atau password yang kamu masukkan salah.');

            return;
        }

        session()->regenerate();

        $this->redirect('/', navigate: true);
    }
};
?>

@vite(['resources/css/app.css', 'resources/js/app.js'])

<div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <div class="w-full max-w-md rounded-2xl bg-white p-8 shadow-lg">

        <div class="mb-8 text-center">
            <h1 class="text-4xl font-bold text-blue-600">
                Login
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Silakan masuk ke akun kamu
            </p>
        </div>

        <form method="POST" action="{{ route('login.store') }}" class="space-y-5">

            @csrf

            {{-- Email --}}
            <div>
                <label
                    for="email"
                    class="mb-2 block text-sm font-medium text-gray-700"
                >
                    Email
                </label>

                <input
                    id="email"
                    name="email"
                    type="email"
                    value="{{ old('email') }}"
                    autocomplete="email"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                >

                @error('email')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Password --}}
            <div>
                <label
                    for="password"
                    class="mb-2 block text-sm font-medium text-gray-700"
                >
                    Password
                </label>

                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="current-password"
                    required
                    class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200"
                >

                @error('password')
                    <p class="mt-1 text-sm text-red-600">
                        {{ $message }}
                    </p>
                @enderror
            </div>

            {{-- Remember --}}
            <div class="flex items-center">
                <input
                    id="remember"
                    name="remember"
                    type="checkbox"
                    value="1"
                    class="h-4 w-4 rounded border-gray-300"
                >

                <label
                    for="remember"
                    class="ml-2 text-sm text-gray-600"
                >
                    Ingat saya
                </label>
            </div>

            {{-- General error --}}
            @if ($errors->any())
                <div class="rounded-lg bg-red-50 p-3 text-sm text-red-600">
                    {{ $errors->first() }}
                </div>
            @endif

            <button
                type="submit"
                class="w-full rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white hover:bg-blue-700"
            >
                Login
            </button>

        </form>

        <div class="mt-6 text-center text-sm text-gray-600">
            Belum punya akun?

            <a
                href="{{ route('register') }}"
                class="font-semibold text-blue-600 hover:underline"
            >
                Daftar
            </a>
        </div>

    </div>
</div>