<!DOCTYPE html>
<html lang="gu">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>404 — પેજ મળ્યું નથી | Sunshine Solar Energy</title>

    <style>
        :root {
            --primary: #f59e0b;
            --primary-dark: #d97706;
            --dark: #0f172a;
            --text: #334155;
            --muted: #64748b;
            --light: #f8fafc;
            --white: #ffffff;
            --border: #e2e8f0;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family:
                "Noto Sans Gujarati",
                "Nirmala UI",
                Arial,
                sans-serif;
            background:
                radial-gradient(circle at 50% 0%,
                    rgba(251, 191, 36, 0.16),
                    transparent 35%),
                linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
            color: var(--dark);
            overflow: hidden;
        }

        .error-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px 20px;
            position: relative;
        }

        /* Background decorative circles */
        .shape {
            position: absolute;
            border-radius: 50%;
            pointer-events: none;
            filter: blur(1px);
        }

        .shape-one {
            width: 260px;
            height: 260px;
            top: -120px;
            right: -80px;
            background: rgba(251, 191, 36, 0.12);
        }

        .shape-two {
            width: 180px;
            height: 180px;
            bottom: -70px;
            left: -50px;
            background: rgba(245, 158, 11, 0.08);
        }

        .content {
            width: 100%;
            max-width: 850px;
            text-align: center;
            position: relative;
            z-index: 2;
        }

        /* Sun icon */
        .sun-wrapper {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .sun {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            background: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            box-shadow:
                0 0 0 12px rgba(245, 158, 11, 0.08),
                0 0 45px rgba(245, 158, 11, 0.35);
            animation: floatSun 3s ease-in-out infinite;
        }

        .ray {
            position: absolute;
            width: 8px;
            height: 22px;
            border-radius: 10px;
            background: rgba(245, 158, 11, 0.65);
        }

        .ray-1 {
            top: 0;
        }

        .ray-2 {
            bottom: 0;
        }

        .ray-3 {
            left: 0;
            transform: rotate(90deg);
        }

        .ray-4 {
            right: 0;
            transform: rotate(90deg);
        }

        @keyframes floatSun {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-8px);
            }
        }

        /* 404 */
        .error-code {
            font-family: Arial, sans-serif;
            font-size: clamp(100px, 18vw, 190px);
            font-weight: 900;
            line-height: 0.85;
            letter-spacing: -10px;
            color: var(--primary);
            text-shadow:
                8px 8px 0 rgba(245, 158, 11, 0.08);
        }

        .title {
            margin-top: 35px;
            font-size: clamp(25px, 4vw, 38px);
            font-weight: 800;
            color: var(--dark);
        }

        .subtitle {
            margin-top: 12px;
            font-size: clamp(18px, 3vw, 24px);
            font-weight: 700;
            color: var(--primary-dark);
        }

        .description {
            max-width: 650px;
            margin: 18px auto 0;
            font-size: 17px;
            line-height: 1.9;
            color: var(--muted);
        }

        /* Buttons */
        .actions {
            margin-top: 32px;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 14px;
            flex-wrap: wrap;
        }

        .btn {
            min-width: 165px;
            padding: 14px 24px;
            border-radius: 10px;
            text-decoration: none;
            font-size: 15px;
            font-weight: 700;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            color: var(--white);
            background: var(--primary);
            box-shadow: 0 8px 22px rgba(245, 158, 11, 0.22);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            transform: translateY(-3px);
            box-shadow: 0 12px 28px rgba(245, 158, 11, 0.3);
        }

        .btn-secondary {
            color: var(--text);
            background: var(--white);
            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            color: var(--primary-dark);
            border-color: rgba(245, 158, 11, 0.5);
            transform: translateY(-3px);
        }

        /* Brand */
        .brand {
            margin-top: 45px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 700;
            color: var(--text);
        }

        .brand-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: var(--primary);
            box-shadow: 0 0 10px rgba(245, 158, 11, 0.5);
        }

        /* Mobile */
        @media (max-width: 600px) {
            .error-page {
                padding: 25px 18px;
            }

            .sun-wrapper {
                transform: scale(0.85);
                margin-bottom: 10px;
            }

            .error-code {
                font-size: 110px;
                letter-spacing: -6px;
            }

            .title {
                margin-top: 25px;
                font-size: 25px;
            }

            .subtitle {
                font-size: 18px;
            }

            .description {
                font-size: 15px;
                line-height: 1.8;
            }

            .actions {
                flex-direction: column;
                width: 100%;
            }

            .btn {
                width: 100%;
                max-width: 300px;
            }

            .brand {
                margin-top: 30px;
            }
        }
    </style>
</head>

<body>

    <main class="error-page">

        <div class="shape shape-one"></div>
        <div class="shape shape-two"></div>

        <section class="content">

            <!-- Solar Icon -->
            <div class="sun-wrapper">
                <span class="ray ray-1"></span>
                <span class="ray ray-2"></span>
                <span class="ray ray-3"></span>
                <span class="ray ray-4"></span>

                <div class="sun">
                    ☀
                </div>
            </div>

            <!-- Error -->
            <div class="error-code">
                404
            </div>

            <h1 class="title">
                પેજ મળ્યું નથી
            </h1>

            <h2 class="subtitle">
                અરે! લાગે છે કે તમે ખોટા રસ્તે આવી ગયા છો. ☀️
            </h2>

            <p class="description">
                તમે જે પેજ શોધી રહ્યા છો તે અત્યારે ઉપલબ્ધ નથી.
                લિંક ખોટી હોઈ શકે છે અથવા પેજને બીજી જગ્યાએ
                ખસેડવામાં આવ્યું હોઈ શકે છે.
            </p>

            <!-- Actions -->
            <div class="actions">

                <a href="/" class="btn btn-primary">
                    ← હોમ પેજ પર જાઓ
                </a>

                <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', configSetting('contact_phone')) }}"
                    class="btn btn-secondary" target="_blank" rel="noopener noreferrer">
                    WhatsApp પર સંપર્ક કરો
                </a>

            </div>

            <!-- Brand -->
            <div class="brand">
                <span class="brand-dot"></span>
                Sunshine Solar Energy
            </div>

        </section>

    </main>

</body>

</html>