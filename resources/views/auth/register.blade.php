<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account | OrderFlow</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, sans-serif;
            background: #f4f7fb;
            color: #172033;
        }

        .auth-layout {
            min-height: 100vh;
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .auth-visual {
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 48px;
            color: white;
            background:
                radial-gradient(circle at 15% 20%, #60a5fa 0, transparent 30%),
                radial-gradient(circle at 85% 80%, #14b8a6 0, transparent 35%),
                linear-gradient(135deg, #10234f, #1d4ed8 55%, #0f766e);
        }

        .auth-visual::before,
        .auth-visual::after {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border: 1px solid rgb(255 255 255 / 18%);
            border-radius: 50%;
            pointer-events: none;
        }

        .auth-visual::before {
            top: 20%;
            right: -120px;
        }

        .auth-visual::after {
            bottom: -150px;
            left: -80px;
            width: 420px;
            height: 420px;
        }

        .brand {
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 12px;
            font-size: 21px;
            font-weight: 800;
            letter-spacing: -.5px;
        }

        .brand-icon {
            display: grid;
            place-items: center;
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: rgb(255 255 255 / 16%);
            border: 1px solid rgb(255 255 255 / 25%);
        }

        .visual-content {
            position: relative;
            z-index: 1;
            max-width: 520px;
            margin: 50px 0;
        }

        .visual-content .eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 13px;
            border: 1px solid rgb(255 255 255 / 25%);
            border-radius: 999px;
            background: rgb(255 255 255 / 10%);
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .visual-content h1 {
            margin: 24px 0 18px;
            font-size: clamp(34px, 4vw, 56px);
            line-height: 1.12;
            letter-spacing: -2px;
        }

        .visual-content p {
            max-width: 430px;
            color: #dbeafe;
            font-size: 16px;
            line-height: 1.8;
        }

        .feature-list {
            display: grid;
            gap: 17px;
            margin-top: 34px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #eff6ff;
            font-size: 14px;
        }

        .feature-icon {
            display: grid;
            place-items: center;
            width: 34px;
            height: 34px;
            flex-shrink: 0;
            border-radius: 11px;
            background: rgb(255 255 255 / 13%);
        }

        .visual-footer {
            position: relative;
            z-index: 1;
            color: #bfdbfe;
            font-size: 12px;
        }

        .form-side {
            display: grid;
            place-items: center;
            padding: 44px 24px;
        }

        .form-card {
            width: 100%;
            max-width: 460px;
            padding: 38px;
            border: 1px solid #e7ebf3;
            border-radius: 26px;
            background: rgb(255 255 255 / 92%);
            box-shadow: 0 24px 70px rgb(15 23 42 / 8%);
            animation: enter .55s ease both;
        }

        @keyframes enter {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .mobile-brand {
            display: none;
        }

        .form-heading {
            margin-bottom: 28px;
        }

        .form-heading h2 {
            margin: 0 0 10px;
            font-size: 30px;
            font-weight: 800;
            letter-spacing: -1px;
        }

        .form-heading p {
            margin: 0;
            color: #778198;
            font-size: 14px;
            line-height: 1.7;
        }

        .form-group {
            margin-bottom: 19px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #344054;
            font-size: 13px;
            font-weight: 700;
        }

        .input-wrap {
            position: relative;
        }

        .input-icon {
            position: absolute;
            top: 50%;
            left: 15px;
            transform: translateY(-50%);
            color: #8993a7;
            pointer-events: none;
        }

        .form-input {
            width: 100%;
            height: 50px;
            padding: 0 46px;
            border: 1px solid #dfe4ed;
            border-radius: 13px;
            outline: none;
            background: #fbfcfe;
            color: #172033;
            font: inherit;
            font-size: 14px;
            transition: border-color .2s, box-shadow .2s, background .2s;
        }

        .form-input::placeholder {
            color: #a1aabc;
        }

        .form-input:hover {
            border-color: #aab7ce;
        }

        .form-input:focus {
            border-color: #3b82f6;
            background: white;
            box-shadow: 0 0 0 4px rgb(59 130 246 / 12%);
        }

        .password-toggle {
            position: absolute;
            top: 50%;
            right: 12px;
            display: grid;
            place-items: center;
            width: 30px;
            height: 30px;
            transform: translateY(-50%);
            border: 0;
            border-radius: 8px;
            background: transparent;
            color: #7c879b;
            cursor: pointer;
        }

        .password-toggle:hover {
            background: #edf2fa;
            color: #1d4ed8;
        }

        .field-error {
            margin-top: 7px;
            color: #dc2626;
            font-size: 12px;
        }

        .submit-button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            width: 100%;
            min-height: 51px;
            margin-top: 26px;
            border: 0;
            border-radius: 13px;
            background: linear-gradient(110deg, #2563eb, #1d4ed8 60%, #0f766e);
            box-shadow: 0 8px 20px rgb(37 99 235 / 23%);
            color: white;
            font: inherit;
            font-size: 14px;
            font-weight: 800;
            cursor: pointer;
            transition: transform .2s, box-shadow .2s;
        }

        .submit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 26px rgb(37 99 235 / 30%);
        }

        .submit-button:active {
            transform: translateY(0);
        }

        .form-bottom {
            margin-top: 25px;
            text-align: center;
            color: #778198;
            font-size: 13px;
        }

        .form-bottom a {
            color: #2563eb;
            font-weight: 800;
            text-decoration: none;
        }

        .form-bottom a:hover {
            text-decoration: underline;
        }

        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-top: 24px;
            color: #8a94a7;
            font-size: 11px;
        }

        @media (max-width: 900px) {
            .auth-layout {
                grid-template-columns: 1fr;
            }

            .auth-visual {
                display: none;
            }

            .form-side {
                padding: 30px 20px;
            }

            .form-card {
                max-width: 480px;
            }

            .mobile-brand {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                margin-bottom: 25px;
                color: #1d4ed8;
                font-size: 21px;
                font-weight: 800;
            }

            .mobile-brand .brand-icon {
                background: #eaf1ff;
                border-color: #dbe7ff;
                color: #1d4ed8;
            }
        }

        @media (max-width: 480px) {
            .form-side {
                padding: 22px 14px;
            }

            .form-card {
                padding: 27px 21px;
                border-radius: 20px;
            }

            .form-heading h2 {
                font-size: 27px;
            }
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>
    <div class="auth-layout">

        <aside class="auth-visual">
            <div class="brand">
                <span class="brand-icon"><i data-lucide="package-check"></i></span>
                <span>OrderFlow</span>
            </div>

            <div class="visual-content">
                <span class="eyebrow">
                    <i data-lucide="sparkles" width="15"></i>
                    Smart order management
                </span>

                <h1>Everything in order.<br>Every day.</h1>

                <p>
                    Manage your items and orders from one simple workspace.
                    Create your account and get started today.
                </p>

                <div class="feature-list">
                    <div class="feature">
                        <span class="feature-icon"><i data-lucide="package"></i></span>
                        <span>Keep your items organized</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon"><i data-lucide="clipboard-list"></i></span>
                        <span>Track orders in one place</span>
                    </div>
                    <div class="feature">
                        <span class="feature-icon"><i data-lucide="shield-check"></i></span>
                        <span>Your account, your workspace</span>
                    </div>
                </div>
            </div>

            <div class="visual-footer">
                © {{ date('Y') }} OrderFlow. Built for better workflows.
            </div>
        </aside>

        <main class="form-side">
            <div style="width: 100%; max-width: 460px;">
                <div class="mobile-brand">
                    <span class="brand-icon"><i data-lucide="package-check"></i></span>
                    <span>OrderFlow</span>
                </div>

                <section class="form-card">
                    <div class="form-heading">
                        <h2>Create your account</h2>
                        <p>Enter your details below to get started with OrderFlow.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group">
                            <label class="form-label" for="name">Full name</label>
                            <div class="input-wrap">
                                <span class="input-icon"><i data-lucide="user-round" width="18"></i></span>
                                <input class="form-input" id="name" name="name" type="text"
                                    placeholder="Enter your full name" value="{{ old('name') }}" autocomplete="name"
                                    required autofocus>
                            </div>
                            @error('name')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="email">Email address</label>
                            <div class="input-wrap">
                                <span class="input-icon"><i data-lucide="mail" width="18"></i></span>
                                <input class="form-input" id="email" name="email" type="email"
                                    placeholder="you@example.com" value="{{ old('email') }}" autocomplete="email"
                                    required>
                            </div>
                            @error('email')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-wrap">
                                <span class="input-icon"><i data-lucide="lock-keyhole" width="18"></i></span>
                                <input class="form-input" id="password" name="password" type="password"
                                    placeholder="At least 8 characters" autocomplete="new-password" required>
                                <button class="password-toggle" type="button" data-toggle="password"
                                    aria-label="Show password">
                                    <i data-lucide="eye" width="18"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="password_confirmation">Confirm password</label>
                            <div class="input-wrap">
                                <span class="input-icon"><i data-lucide="shield-check" width="18"></i></span>
                                <input class="form-input" id="password_confirmation" name="password_confirmation"
                                    type="password" placeholder="Enter your password again" autocomplete="new-password"
                                    required>
                                <button class="password-toggle" type="button" data-toggle="password_confirmation"
                                    aria-label="Show password">
                                    <i data-lucide="eye" width="18"></i>
                                </button>
                            </div>
                            @error('password_confirmation')
                                <p class="field-error">{{ $message }}</p>
                            @enderror
                        </div>

                        <button class="submit-button" type="submit">
                            <span>Create account</span>
                            <i data-lucide="arrow-right" width="18"></i>
                        </button>
                    </form>

                    <div class="form-bottom">
                        Already have an account?
                        <a href="{{ route('login') }}">Sign in</a>
                    </div>

                    <div class="security-note">
                        <i data-lucide="lock-keyhole" width="14"></i>
                        Your information is securely handled.
                    </div>
                </section>
            </div>
        </main>
    </div>

    <script>
        if (window.lucide) {
            window.lucide.createIcons();
        }

        document.querySelectorAll('[data-toggle]').forEach((button) => {
            button.addEventListener('click', () => {
                const input = document.getElementById(button.dataset.toggle);
                const showing = input.type === 'password';

                input.type = showing ? 'text' : 'password';
                button.setAttribute(
                    'aria-label',
                    showing ? 'Hide password' : 'Show password'
                );

                button.innerHTML = showing ?
                    '<i data-lucide="eye-off" width="18"></i>' :
                    '<i data-lucide="eye" width="18"></i>';

                if (window.lucide) {
                    window.lucide.createIcons();
                }
            });
        });
    </script>
</body>

</html>
