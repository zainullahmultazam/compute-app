<!doctype html>
<html lang="en" data-bs-theme="auto">

<head>
    <script src="{{ asset('template/js/color-mode.js') }}"></script>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="" />
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors" />
    <meta name="generator" content="Hugo 0.122.0" />
    <title>Dashboard Template · Bootstrap v5.3</title>
    {{-- untuk styles --}}
    @include('layouts.styles')
    {{-- untuk styles khusus halaman tertentu --}}
    @yield('this-page-style')

    <style>
        :root {
            --primary-color: #4f46e5;
            --secondary-color: #818cf8;
            --overlay-color: rgba(0, 0, 0, 0.6);
            --card-bg: rgba(255, 255, 255, 0.1);
        }

        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Inter', sans-serif;
        }

        body {
            /* Contoh background image - ganti URL sesuai kebutuhan */
            background: url('https://source.unsplash.com/1920x1080/?nature') no-repeat center center fixed;
            background-size: cover;
            position: relative;
        }

        /* Overlay gradien untuk background */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                135deg,
                var(--overlay-color) 0%,
                rgba(0, 0, 0, 0.8) 100%
            );
            z-index: 0;
        }

        /* Efek particle overlay (opsional) */
        .particle-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: url('https://cdn.pixabay.com/photo/2019/01/07/09/43/sunset-3918693_1280.jpg');
            opacity: 0.5;
            z-index: 1;
        }

        .form-signin {
            max-width: 400px;
            width: 90%;
            padding: 2.5rem;
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            position: relative;
            overflow: hidden;
            z-index: 2;
            animation: cardAppear 0.6s ease-out;
        }

        .form-signin::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(255, 255, 255, 0.1),
                transparent
            );
            transform: rotate(45deg);
            animation: shimmer 3s infinite;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-container img {
            width: auto;
            height: 70px;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
            animation: logoFloat 3s ease-in-out infinite;
        }

        .form-title {
            color: #ffffff;
            text-align: center;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .form-floating {
            margin-bottom: 1rem;
        }

        .form-floating input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            height: 60px;
            padding: 1rem 0.75rem;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .form-floating input:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 0 0 2px rgba(255, 255, 255, 0.1);
        }

        .form-floating label {
            padding: 1rem 0.75rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .login-btn {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border: none;
            color: white;
            padding: 1rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .login-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.2),
                transparent
            );
            transition: 0.5s;
        }

        .login-btn:hover::before {
            left: 100%;
        }

        .login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px var(--primary-color);
        }

        .copyright {
            color: rgba(255, 255, 255, 0.6);
            text-align: center;
            font-size: 0.9rem;
            margin-top: 2rem;
        }

        .alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ffffff;
            padding: 1rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            animation: alertSlide 0.3s ease-out;
        }

        @keyframes cardAppear {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes shimmer {
            0% {
                transform: rotate(45deg) translateX(-100%);
            }
            100% {
                transform: rotate(45deg) translateX(100%);
            }
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes particleMove {
            0% {
                background-position: 0 0;
            }
            100% {
                background-position: 1000px 1000px;
            }
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-signin {
                padding: 2rem;
                width: 85%;
            }

            .form-title {
                font-size: 1.5rem;
            }

            .form-floating input {
                height: 50px;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center py-4">
    <div class="particle-overlay"></div>

    <main class="form-signin w-100 m-auto">
        @if (session('error'))
            <div class="alert">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="logo-container">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/9/9a/Laravel.svg/1969px-Laravel.svg.png"
                    alt="Logo">
            </div>
            <h1 class="form-title">Welcome Back</h1>

            <div class="form-floating">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="floatingInput"
                    placeholder="name@example.com" name="email" value="{{ old('email') }}">
                <label for="floatingInput">Email address</label>
                @error('email')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-floating">
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                    id="floatingPassword" placeholder="Password" name="password">
                <label for="floatingPassword">Password</label>
                @error('password')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button class="login-btn w-100" type="submit">Sign in</button>
            <p class="copyright">&copy; KELAS KOMPUTASI</p>
        </form>
    </main>

    {{-- untuk scripts --}}
    @include('layouts.scripts')
    {{-- untuk scripts khusus halaman tertentu --}}
    @yield('this-page-scripts')
</body>

</html>