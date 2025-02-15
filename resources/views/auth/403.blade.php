@extends('layouts.main')

@section('this-page-style')
    <style>
        :root {
            --primary-color: #ff6b6b;
            --secondary-color: #4ecdc4;
            --accent-color: #ffe66d;
            --dark-color: #2c3e50;
            --light-color: #ffffff;
        }

        .unauthorized-container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--dark-color);
            position: relative;
            overflow: hidden;
            font-family: 'Poppins', sans-serif;
        }

        /* Dynamic Background Animation */
        .background-animation {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: 
                linear-gradient(45deg, 
                    rgba(255, 107, 107, 0.1),
                    rgba(78, 205, 196, 0.1),
                    rgba(255, 230, 109, 0.1));
            filter: blur(80px);
            animation: backgroundMove 20s ease infinite;
        }

        .error-card {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
            padding: 3rem;
            text-align: center;
            max-width: 550px;
            width: 90%;
            position: relative;
            z-index: 10;
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
        }

        /* Glowing border effect */
        .error-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent,
                rgba(255, 107, 107, 0.3),
                rgba(78, 205, 196, 0.3),
                transparent
            );
            transform: rotate(45deg);
            animation: borderGlow 6s linear infinite;
        }

        .error-number {
            font-size: 160px;
            font-weight: 900;
            color: var(--light-color);
            margin: 0;
            line-height: 1;
            text-shadow: 
                2px 2px 0 var(--primary-color),
                4px 4px 0 var(--secondary-color);
            position: relative;
            animation: numberPulse 3s ease-in-out infinite;
        }

        .error-title {
            color: var(--light-color);
            font-weight: 700;
            font-size: 2.5rem;
            margin: 1rem 0;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: titleGlow 3s ease-in-out infinite;
        }

        .error-message {
            color: rgba(255, 255, 255, 0.8);
            margin: 1.5rem 0;
            line-height: 1.6;
            font-size: 1.1rem;
        }

        .btn-back {
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: var(--light-color);
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 2px;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            text-decoration: none;
            position: relative;
            overflow: hidden;
        }

        .btn-back::before {
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

        .btn-back:hover::before {
            left: 100%;
        }

        .btn-back:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.3);
            color: var(--light-color);
            text-decoration: none;
        }

        .icon-wrapper {
            margin-right: 10px;
            position: relative;
        }

        /* Floating elements */
        .floating-element {
            position: absolute;
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        .element-1 {
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, var(--primary-color) 0%, transparent 70%);
            top: 20%;
            left: 10%;
            animation-duration: 20s;
        }

        .element-2 {
            width: 150px;
            height: 150px;
            background: radial-gradient(circle, var(--secondary-color) 0%, transparent 70%);
            bottom: 20%;
            right: 10%;
            animation-duration: 25s;
        }

        .element-3 {
            width: 80px;
            height: 80px;
            background: radial-gradient(circle, var(--accent-color) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            animation-duration: 15s;
        }

        @keyframes backgroundMove {
            0%, 100% {
                transform: scale(1) rotate(0deg);
            }
            50% {
                transform: scale(1.2) rotate(180deg);
            }
        }

        @keyframes borderGlow {
            0% {
                transform: rotate(45deg) translateX(-100%);
            }
            100% {
                transform: rotate(45deg) translateX(100%);
            }
        }

        @keyframes numberPulse {
            0%, 100% {
                transform: scale(1);
                text-shadow: 
                    2px 2px 0 var(--primary-color),
                    4px 4px 0 var(--secondary-color);
            }
            50% {
                transform: scale(1.05);
                text-shadow: 
                    3px 3px 0 var(--primary-color),
                    6px 6px 0 var(--secondary-color);
            }
        }

        @keyframes titleGlow {
            0%, 100% {
                filter: brightness(1);
            }
            50% {
                filter: brightness(1.3);
            }
        }

        @keyframes float {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }
            50% {
                transform: translate(100px, 100px) rotate(180deg);
            }
            100% {
                transform: translate(0, 0) rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .error-card {
                padding: 2rem;
            }

            .error-number {
                font-size: 120px;
            }

            .error-title {
                font-size: 2rem;
            }

            .error-message {
                font-size: 1rem;
            }

            .btn-back {
                padding: 0.8rem 1.6rem;
                font-size: 0.9rem;
            }
        }
    </style>
@endsection

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
        <div class="unauthorized-container">
            <div class="background-animation"></div>
            <div class="floating-element element-1"></div>
            <div class="floating-element element-2"></div>
            <div class="floating-element element-3"></div>
            
            <div class="error-card">
                <div class="error-number">403</div>
                <h2 class="error-title">Akses Ditolak</h2>
                <p class="error-message">
                    Anda tidak memiliki izin untuk mengakses halaman ini. 
                    Hubungi administrator jika Anda merasa ini adalah kesalahan.
                </p>
                <a href="{{ url('/') }}" class="btn-back">
                    <span class="icon-wrapper">
                        <i class="bi bi-arrow-left"></i>
                    </span>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </main>
@endsection

@section('this-page-scripts')
@endsection