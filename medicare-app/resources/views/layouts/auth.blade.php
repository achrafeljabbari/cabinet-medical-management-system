<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'MediCare - Authentication')</title>
    @vite(['resources/css/app.css', 'resources/css/auth.css', 'resources/js/app.js'])
    <style>
        :root {
            --bg: #f5f3f2;
            --bg-glow: #ffffff;
            --panel: rgba(255, 255, 255, 0.92);
            --panel-border: rgba(198, 205, 206, 0.34);
            --text: #5c6668;
            --heading: #544f57;
            --muted: #8a9296;
            --line: rgba(138, 144, 146, 0.14);
            --input-border: #e7eaeb;
            --input-shadow: 0 10px 24px rgba(158, 166, 170, 0.14);
            --panel-shadow: 0 28px 60px rgba(145, 149, 156, 0.24);
            --blue-1: #ff7d8d;
            --blue-2: #dc3d5d;
            --green-1: #c6f46d;
            --green-2: #8ad33d;
            --pill-red: #ff746d;
            --pill-white: #fefefe;
            --bandage: #f2b48b;
            --tube: #e6546e;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
        }

        body {
            margin: 0;
            font-family: Georgia, "Times New Roman", serif;
            color: var(--text);
            background:
                radial-gradient(circle at top center, rgba(255, 255, 255, 0.98) 0%, rgba(248, 247, 245, 0.97) 42%, rgba(239, 237, 234, 1) 100%);
            overflow-x: hidden;
        }

        .scene {
            position: relative;
            min-height: 100vh;
            padding: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            isolation: isolate;
        }

        .scene::before,
        .scene::after {
            content: "";
            position: absolute;
            inset: auto;
            border-radius: 50%;
            filter: blur(10px);
            z-index: -2;
        }

        .scene::before {
            width: 420px;
            height: 420px;
            top: -120px;
            left: -120px;
            background: radial-gradient(circle, rgba(182, 238, 95, 0.24), rgba(255, 255, 255, 0));
        }

        .scene::after {
            width: 340px;
            height: 340px;
            bottom: -110px;
            right: -80px;
            background: radial-gradient(circle, rgba(235, 92, 122, 0.18), rgba(255, 255, 255, 0));
        }

        .auth-stage {
            position: relative;
            width: 100%;
            max-width: 1180px;
            min-height: inherit;
            margin: 0 auto;
            display: flex;
            justify-content: center;
            align-items: stretch;
            gap: 42px;
            flex-wrap: wrap;
        }

        .card {
            position: relative;
            width: min(100%, 430px);
            min-height: 625px;
            padding: 34px 44px 38px;
            border-radius: 28px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.96), rgba(251, 250, 248, 0.9));
            border: 1px solid var(--panel-border);
            box-shadow: var(--panel-shadow);
            backdrop-filter: blur(8px);
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at top left, rgba(255, 255, 255, 0.92), rgba(255, 255, 255, 0) 32%),
                linear-gradient(180deg, rgba(255, 255, 255, 0.42), rgba(244, 241, 237, 0.2));
            pointer-events: none;
        }

        .card::after {
            content: "";
            position: absolute;
            inset: 8px;
            border-radius: 22px;
            box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8);
            pointer-events: none;
        }

        .top-rule,
        .bottom-rule {
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(180, 196, 219, 0.32), transparent);
        }

        .top-rule {
            margin: 10px 0 22px;
        }

        .bottom-rule {
            margin-top: 22px;
        }

        .brand-icons {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 10px;
            min-height: 54px;
            color: var(--blue-2);
        }

        .brand-icons svg {
            display: block;
        }

        h1 {
            margin: 0 0 28px;
            text-align: center;
            font-size: clamp(2rem, 1.7rem + 0.8vw, 3rem);
            line-height: 1.1;
            color: var(--heading);
            font-weight: 700;
            letter-spacing: -0.03em;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .field {
            position: relative;
            display: flex;
            align-items: center;
            min-height: 52px;
            padding: 0 18px;
            border-radius: 15px;
            background: linear-gradient(180deg, rgba(255, 255, 255, 0.97), rgba(249, 247, 245, 0.97));
            border: 1px solid var(--input-border);
            box-shadow: var(--input-shadow);
        }

        .field.error {
            border-color: #ff7d8d;
            background: linear-gradient(180deg, rgba(255, 253, 252, 0.97), rgba(254, 249, 248, 0.97));
        }

        .field svg {
            flex: 0 0 auto;
            color: #7d90ad;
            margin-right: 12px;
        }

        .field input {
            flex: 1;
            min-width: 0;
            border: 0;
            outline: none;
            background: transparent;
            font-size: 1rem;
            color: var(--heading);
            font-family: "Segoe UI", Tahoma, sans-serif;
        }

        .field input::placeholder {
            color: #7d878c;
        }

        .field-meta {
            margin-left: 12px;
            font-family: "Segoe UI", Tahoma, sans-serif;
            font-size: 0.92rem;
            white-space: nowrap;
            color: #7b838d;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.22s ease;
        }

        .field-meta:hover {
            color: var(--blue-2);
        }

        .button {
            margin-top: 14px;
            min-height: 58px;
            border: 0;
            border-radius: 999px;
            color: #ffffff;
            font-size: 1.04rem;
            font-weight: 700;
            letter-spacing: -0.02em;
            font-family: Georgia, "Times New Roman", serif;
            cursor: pointer;
            box-shadow: inset 0 -2px 0 rgba(0, 0, 0, 0.08);
            transition: transform 0.22s ease, box-shadow 0.22s ease, filter 0.22s ease;
        }

        .button:hover {
            transform: translateY(-2px);
            filter: saturate(1.05);
        }

        .button:active {
            transform: translateY(0);
        }

        .button.login {
            background: linear-gradient(180deg, var(--blue-1), var(--blue-2));
            box-shadow:
                inset 0 -2px 0 rgba(0, 0, 0, 0.08),
                0 14px 28px rgba(220, 61, 93, 0.28);
        }

        .button.register {
            background: linear-gradient(180deg, var(--green-1), var(--green-2));
            box-shadow:
                inset 0 -2px 0 rgba(0, 0, 0, 0.08),
                0 14px 28px rgba(138, 211, 61, 0.24);
        }

        .divider {
            display: grid;
            grid-template-columns: 1fr auto 1fr;
            align-items: center;
            gap: 12px;
            margin: 18px 0 8px;
            color: var(--muted);
            font-size: 0.95rem;
            font-family: "Segoe UI", Tahoma, sans-serif;
        }

        .divider::before,
        .divider::after {
            content: "";
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(171, 188, 214, 0.32), transparent);
        }

        .helper {
            margin: 10px 0 0;
            text-align: center;
            font-family: "Segoe UI", Tahoma, sans-serif;
            font-size: 0.98rem;
            color: #737b81;
        }

        .helper a,
        .helper button {
            color: var(--blue-2);
            text-decoration: underline;
            text-underline-offset: 3px;
            font-weight: 600;
            background: none;
            border: 0;
            padding: 0;
            font: inherit;
            cursor: pointer;
            transition: color 0.22s ease;
        }

        .helper button:hover,
        .helper button:focus-visible {
            color: #c53454;
        }

        .error-message {
            margin-top: 4px;
            font-size: 0.85rem;
            color: #ff7d8d;
            font-family: "Segoe UI", Tahoma, sans-serif;
        }

        .corner-shape {
            position: absolute;
            width: 188px;
            height: 92px;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.5), rgba(229, 232, 224, 0.28) 62%, rgba(229, 232, 224, 0.08));
            filter: blur(1px);
            pointer-events: none;
        }

        .corner-shape.left {
            left: -22px;
            bottom: -6px;
            border-top-right-radius: 140px 90px;
            border-top-left-radius: 40px;
            transform: rotate(4deg);
        }

        .corner-shape.right {
            right: -30px;
            bottom: -8px;
            border-top-left-radius: 140px 90px;
            border-top-right-radius: 50px;
            transform: rotate(-4deg);
        }

        .floating-object {
            position: absolute;
            pointer-events: none;
            filter: drop-shadow(0 14px 18px rgba(168, 163, 156, 0.22));
        }

        .stethoscope {
            top: -8px;
            left: -70px;
            width: 190px;
            height: 190px;
            opacity: 0.92;
        }

        .ecg-ambient {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            opacity: 0.26;
            pointer-events: none;
        }

        .ecg-ambient.right {
            right: -36px;
        }

        .ecg-ambient svg {
            width: 150px;
            height: 90px;
        }

        .decor-login-left {
            left: -14px;
            bottom: 0;
            width: 128px;
            height: 92px;
        }

        .decor-login-right {
            right: 14px;
            bottom: 12px;
            width: 108px;
            height: 88px;
        }

        .decor-register-right {
            right: -16px;
            bottom: -2px;
            width: 156px;
            height: 108px;
        }

        @media (max-width: 960px) {
            .scene {
                display: block;
                padding-top: 28px;
            }

            .auth-stage {
                width: min(100%, 430px);
                min-height: auto;
                gap: 0;
            }

            .stethoscope {
                display: none;
            }

            .ecg-ambient {
                opacity: 0.18;
            }

            .card {
                width: 100%;
            }
        }

        @media (max-width: 560px) {
            .scene {
                padding-inline: 14px;
            }

            .card {
                min-height: auto;
                padding: 28px 20px 32px;
                border-radius: 24px;
            }

            h1 {
                font-size: 2.1rem;
            }

            .helper {
                font-size: 0.95rem;
            }

            .decor-login-left,
            .decor-login-right,
            .decor-register-right,
            .ecg-ambient {
                transform: scale(0.9);
                transform-origin: bottom right;
            }
        }
    </style>
</head>
<body>
    <main class="scene">
        <svg class="floating-object stethoscope" viewBox="0 0 220 220" fill="none" aria-hidden="true">
            <defs>
                <linearGradient id="stethBlue" x1="0" y1="0" x2="1" y2="1">
                    <stop offset="0%" stop-color="#4c6d8f"/>
                    <stop offset="100%" stop-color="#89a9c6"/>
                </linearGradient>
            </defs>
            <path d="M54 40c0 26-2 55 13 77 10 14 27 23 46 23s36-9 46-23c15-22 13-51 13-77" stroke="url(#stethBlue)" stroke-width="9" stroke-linecap="round"/>
            <path d="M43 37c0 13 10 23 23 23s23-10 23-23" stroke="#dfe8f3" stroke-width="9" stroke-linecap="round"/>
            <path d="M131 37c0 13 10 23 23 23s23-10 23-23" stroke="#dfe8f3" stroke-width="9" stroke-linecap="round"/>
            <circle cx="54" cy="34" r="12" fill="#314f70"/>
            <circle cx="166" cy="34" r="12" fill="#314f70"/>
            <path d="M110 141v18c0 17-12 29-29 29s-29-12-29-29" stroke="url(#stethBlue)" stroke-width="8" stroke-linecap="round"/>
            <circle cx="78" cy="192" r="26" fill="#eff5fb" stroke="#9db5cc" stroke-width="5"/>
            <circle cx="78" cy="192" r="11" fill="#ffffff" stroke="#45688a" stroke-width="4"/>
            <path d="M124 163c20 8 33 7 44 1" stroke="#d3e0ec" stroke-width="6" stroke-linecap="round"/>
        </svg>

        <div class="ecg-ambient right" aria-hidden="true">
            <svg viewBox="0 0 180 90" fill="none">
                <path d="M0 45h45l8-10 8 28 10-42 12 24h20l10-12 9 23 8-11h50" stroke="#b8e866" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <section class="auth-stage">
            <div style="width: 100%; display: flex; justify-content: center;">
                @yield('content')
            </div>
        </section>
    </main>
</body>
</html>
