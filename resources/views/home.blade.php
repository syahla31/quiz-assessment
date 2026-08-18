<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard - Quiz Assessment</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-gray-100">

    {{-- Navbar --}}
    <nav class="border-b border-gray-200 bg-white">
        <div class="mx-auto flex max-w-7xl items-center justify-between px-6 py-4">

            {{-- Logo --}}
            <div>
                <h1 class="text-xl font-bold text-blue-600">
                    Quiz Assessment
                </h1>

                <p class="text-xs text-gray-500">
                    Assessment Platform
                </p>
            </div>

            {{-- User & Logout --}}
            <div class="flex items-center gap-4">

                <div class="hidden text-right sm:block">
                    <p class="text-sm font-semibold text-gray-700">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-gray-500">
                        {{ auth()->user()->email }}
                    </p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-50"
                    >
                        Logout
                    </button>
                </form>

            </div>

        </div>
    </nav>


    {{-- Main Content --}}
    <main class="mx-auto max-w-7xl px-6 py-10">

        {{-- Welcome --}}
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900">
                Selamat datang, {{ auth()->user()->name }}! 👋
            </h2>

            <p class="mt-2 text-gray-500">
                Siap untuk menguji kemampuanmu hari ini?
            </p>
        </div>


        {{-- Quiz Card --}}
        <div class="mb-8 overflow-hidden rounded-2xl bg-blue-600 shadow-lg">

            <div class="p-8">

                <div class="max-w-2xl">

                    <span class="inline-block rounded-full bg-blue-500 px-3 py-1 text-xs font-semibold text-white">
                        Quiz Assessment
                    </span>

                    <h3 class="mt-4 text-2xl font-bold text-white">
                        Uji kemampuan dan pengetahuanmu
                    </h3>

                    <p class="mt-3 leading-relaxed text-blue-100">
                        Ikuti quiz untuk mengukur kemampuanmu dan lihat hasil
                        assessment setelah menyelesaikannya.
                    </p>

                    <button
                        type="button"
                        class="mt-6 rounded-lg bg-white px-6 py-3 font-semibold text-blue-600 transition hover:bg-blue-50"
                    >
                        Mulai Quiz
                    </button>

                </div>

            </div>

        </div>


        {{-- Information Cards --}}
        <div class="grid gap-6 md:grid-cols-3">

            {{-- Card 1 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

                <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-2xl">
                    📝
                </div>

                <h3 class="text-lg font-semibold text-gray-900">
                    Quiz
                </h3>

                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    Kerjakan berbagai soal assessment untuk menguji kemampuanmu.
                </p>

            </div>


            {{-- Card 2 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

                <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-green-50 text-2xl">
                    📊
                </div>

                <h3 class="text-lg font-semibold text-gray-900">
                    Hasil Assessment
                </h3>

                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    Lihat hasil dan nilai quiz yang sudah kamu kerjakan.
                </p>

            </div>


            {{-- Card 3 --}}
            <div class="rounded-2xl bg-white p-6 shadow-sm ring-1 ring-gray-100">

                <div class="mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-purple-50 text-2xl">
                    👤
                </div>

                <h3 class="text-lg font-semibold text-gray-900">
                    Profil
                </h3>

                <p class="mt-2 text-sm leading-relaxed text-gray-500">
                    Kelola informasi akun dan profilmu.
                </p>

            </div>

        </div>

    </main>

</body>
</html>