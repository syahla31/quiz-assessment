<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register - Quiz Assessment</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100 px-4">

    <div class="flex min-h-screen items-center justify-center px-4 py-10">

        <div class="w-full max-w-md rounded-2xl bg-white p-8 shadow-lg">

            {{-- Header --}}
            <div class="mb-8 text-center">
                <h1 class="text-4xl font-bold text-blue-600">
                    Daftar
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Buat akun baru untuk mengikuti Quiz Assessment
                </p>
            </div>


            {{-- Error --}}
            @if ($errors->any())
                <div class="mb-6 rounded-lg bg-red-50 p-4 text-sm text-red-600">
                    <ul class="list-disc space-y-1 pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            {{-- Form --}}
            <form method="POST" action="{{ route('register.store') }}" class="space-y-5">

                @csrf

                {{-- Nama --}}
                <div>
                    <label
                        for="name"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Nama
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        autocomplete="name"
                        required
                        autofocus
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    >
                </div>


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
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        autocomplete="email"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    >
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
                        type="password"
                        name="password"
                        autocomplete="new-password"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    >
                </div>


                {{-- Konfirmasi Password --}}
                <div>
                    <label
                        for="password_confirmation"
                        class="mb-2 block text-sm font-medium text-gray-700"
                    >
                        Konfirmasi Password
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        autocomplete="new-password"
                        required
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 text-gray-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                    >
                </div>


                {{-- Button --}}
                <button
                    type="submit"
                    class="w-full rounded-lg bg-blue-600 px-4 py-3 font-semibold text-white transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300"
                >
                    Daftar
                </button>

            </form>


            {{-- Login --}}
            <div class="mt-6 text-center text-sm text-gray-600">
                Sudah punya akun?

                <a
                    href="{{ route('login') }}"
                    class="font-semibold text-blue-600 hover:underline"
                >
                    Login
                </a>
            </div>

        </div>

    </div>

</body>
</html>