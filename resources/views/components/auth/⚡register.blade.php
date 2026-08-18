<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>

<body>

    <h1>Register</h1>

    <p>Silakan buat akun baru</p>

    @if ($errors->any())
        <div>
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('register.store') }}">
        @csrf

        <div>
            <label>Nama</label>
            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
            >
        </div>

        <div>
            <label>Email</label>
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
            >
        </div>

        <div>
            <label>Password</label>
            <input
                type="password"
                name="password"
                required
            >
        </div>

        <div>
            <label>Konfirmasi Password</label>
            <input
                type="password"
                name="password_confirmation"
                required
            >
        </div>

        <button type="submit">
            Daftar
        </button>
    </form>

    <p>
        Sudah punya akun?
        <a href="{{ route('login') }}">Login</a>
    </p>

</body>
</html>