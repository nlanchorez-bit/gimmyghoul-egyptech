<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Dynamic Title using CI4 esc() for security -->
    <title><?= esc($page_title ?? 'Gimmighoul') ?></title>

    <!-- Google Fonts: Scheherazade New (body), Tajawal (headlines) -->
    <link href="https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@400;700&family=Tajawal:wght@400;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Scheherazade New', Arial, sans-serif;
            background-color: #f5f5f5;
            color: #161616;
            line-height: 1.6;
            direction: ltr;
        }

        .header {
            position: relative;
            background-color: #f3daac;
            height: 70px;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0 50px;
        }

        .logo {
            position: absolute;
            left: 50px;
            width: 50px;
            height: 50px;
            background: #702524;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 8px;
            color: white;
            padding: 3px;
            font-family: 'Scheherazade New', Arial, sans-serif;
        }

        .nav-menu {
            display: flex;
            gap: 35px;
            align-items: center;
        }

        .nav-item {
            background: none;
            border: none;
            font-size: 18px;
            font-weight: 500;
            cursor: pointer;
            color: #161616;
            transition: color 0.3s ease;
            position: relative;
            font-family: 'Scheherazade New', Arial, sans-serif;
        }

        .nav-item:hover {
            color: #702524;
        }

        .signup-btn {
            position: absolute;
            right: 50px;
            min-width: 140px;
            height: 56px;
            background: #fff;
            border: 2px solid #702524;
            border-radius: 12px;
            color: #161616;
            font-size: 21px;
            font-weight: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 2px 8px rgba(112, 37, 36, 0.12);
            cursor: pointer;
            font-family: 'Scheherazade New', Arial, sans-serif;
        }

        .hero-section {
            position: relative;
            width: 100%;
            height: 600px;
            background-image: url('https://ecommerce.datablitz.com.ph/cdn/shop/files/Resident-Evil-Requiem-ecom-SLIDING_80b649fd-6588-42ae-adfa-6568f8add44d_1800x.jpg?v=1763699798');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #c9c9c9 0%, #e0e0e0 100%);
            z-index: -1;
        }

        .hero-logo {
            width: 120px;
            height: 120px;
            background: white;
            border-radius: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-size: 12px;
            color: #666;
            text-align: center;
            padding: 10px;
            font-family: 'Scheherazade New', Arial, sans-serif;
        }

        .hero-title {
            font-size: 36px;
            color: white;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-bottom: 10px;
            font-family: 'Scheherazade New', Arial, sans-serif;
        }

        .hero-subtitle {
            font-size: 18px;
            color: white;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
            font-family: 'Scheherazade New', Arial, sans-serif;
        }

        .quick-access {
            width: 100%;
            background: #f3daac;
            padding: 0 50px;
            height: 70px;
            display: flex;
            align-items: center;
            box-sizing: border-box;
            margin-top: 0;
        }

        /* PS5 Section */
        .ps5-section {
            direction: ltr;
            background: #fff;
            max-width: 100%;
            margin: 0;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: center;
            min-height: 100vh;
        }

        .ps5-image {
            position: relative;
            order: 1;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .ps5-image-container {
            background: linear-gradient(135deg, #8b2f2e 0%, #610e0e 50%, #4c0404 100%);
            border-radius: 0 200px 200px 0;
            padding: 50px;
            position: relative;
            overflow: hidden;
        }

        .ps5-image-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .ps5-image-container:hover::before {
            opacity: 1;
        }

        .ps5-image img {
            width: 100%;
            display: block;
            position: relative;
            z-index: 1;
        }

        .ps5-content {
            order: 2;
            padding: 60px 80px 60px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .ps5-content h2,
        .ps5-content h3 {
            font-family: 'Tajawal', sans-serif;
            font-weight: 700;
            line-height: 1.3;
            letter-spacing: -0.3px;
        }

        .ps5-content h2 {
            font-size: 48px;
            margin-bottom: 18px;
            color: #702524;
        }

        .ps5-content h3 {
            font-size: 34px;
            margin-bottom: 20px;
            color: #161616;
        }

        .ps5-content p {
            font-family: 'Scheherazade New', Arial, sans-serif;
            font-size: 17px;
            line-height: 1.7;
            margin-bottom: 30px;
            color: #5a5a5a;
            max-width: 500px;
        }

        .cta-button {
            background: linear-gradient(135deg, #8b2f2e 0%, #702524 100%);
            color: #ffffff;
            border: none;
            padding: 13px 38px;
            font-size: 17px;
            font-weight: 700;
            border-radius: 50px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: 'Scheherazade New', Arial, sans-serif;
            align-self: flex-start;
        }

        .cta-button:active {
            transform: translateY(0);
        }

        /* Content Section (About Us) */
        .content-section {
            background: white;
            border: 1px solid #7025244c;
            border-radius: 24px;
            padding: 40px 30px;
            margin: 40px auto 60px auto;
            max-width: 1200px;
            text-align: center;
        }

        .content-section h2 {
            font-size: 36px;
            margin-bottom: 20px;
            font-family: 'Tajawal', sans-serif;
            font-weight: 700;
        }

        .content-section p {
            font-size: 18px;
            line-height: 1.8;
            text-align: center;
            margin-bottom: 30px;
            font-family: 'Scheherazade New', Arial, sans-serif;
        }

        .content-types {
            display: flex;
            justify-content: space-around;
            gap: 20px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .content-type {
            text-align: center;
        }

        .content-type p {
            font-family: 'Scheherazade New', Arial, sans-serif;
        }

        .content-icon {
            width: 0;
            height: 0;
            margin: 0 auto 10px;
            border-left: 40px solid transparent;
            border-right: 40px solid transparent;
            border-bottom: 70px solid #f3daac;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .content-icon-text {
            position: absolute;
            top: 38px;
            left: 50%;
            transform: translateX(-50%);
            font-size: 20px;
        }

        /* Red section with scrollable cards */
        .tech-section {
            background: linear-gradient(180deg, #610e0e 0%, #4c0404 100%);
            padding: 80px 0;
            overflow-x: auto;
            overflow-y: hidden;
            position: relative;
        }

        .tech-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle at 30% 50%, rgba(139, 47, 46, 0.3) 0%, transparent 50%),
                radial-gradient(circle at 70% 50%, rgba(97, 14, 14, 0.3) 0%, transparent 50%);
            pointer-events: none;
        }

        .scroll-card-scroll {
            display: flex;
            gap: 40px;
            padding: 0 60px 20px 60px;
            min-width: min-content;
            position: relative;
            z-index: 1;
            justify-content: center;
        }

        .scroll-card {
            flex: 0 0 380px;
            background: linear-gradient(145deg, #f5e6c8 0%, #f3daac 100%);
            border-radius: 24px;
            box-shadow: 0px 12px 48px rgba(0, 0, 0, 0.35);
            min-height: 480px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: space-between;
            padding: 45px 25px 35px 25px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
            border: 3px solid rgba(112, 37, 36, 0.15);
        }

        .scroll-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.3) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
        }

        .scroll-card:hover::before {
            opacity: 1;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }
        }

        .scroll-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0px 20px 60px rgba(0, 0, 0, 0.45),
                0 0 40px rgba(198, 36, 44, 0.3),
                inset 0 0 60px rgba(255, 255, 255, 0.1);
            border-color: rgba(198, 36, 44, 0.4);
        }

        .scroll-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background:
                repeating-linear-gradient(0deg,
                    transparent,
                    transparent 2px,
                    rgba(112, 37, 36, 0.03) 2px,
                    rgba(112, 37, 36, 0.03) 4px);
            pointer-events: none;
            opacity: 0.4;
        }

        .scroll-card-image-wrapper {
            position: relative;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            filter: drop-shadow(0 8px 16px rgba(0, 0, 0, 0.2));
            transition: all 0.4s ease;
        }

        .scroll-card:hover .scroll-card-image-wrapper {
            filter: drop-shadow(0 12px 24px rgba(198, 36, 44, 0.4));
            transform: scale(1.05);
        }

        .scroll-card img {
            width: 85%;
            max-width: 280px;
            border-radius: 12px;
            object-fit: contain;
            position: relative;
            z-index: 2;
        }

        .scroll-content {
            font-family: 'Tajawal', sans-serif;
            font-size: 1.5rem;
            color: #2a1810;
            text-align: center;
            font-weight: 700;
            margin-top: 15px;
            line-height: 1.4;
            letter-spacing: 0.3px;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(255, 255, 255, 0.5);
        }

        .scroll-highlight {
            color: #c6242c;
            display: inline-block;
            position: relative;
            padding: 0 4px;
        }

        .scroll-highlight::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, transparent, #c6242c, transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .scroll-card:hover .scroll-highlight::after {
            opacity: 1;
            animation: glow-line 1.5s ease-in-out infinite;
        }

        @keyframes glow-line {

            0%,
            100% {
                box-shadow: 0 0 5px rgba(198, 36, 44, 0.5);
            }

            50% {
                box-shadow: 0 0 20px rgba(198, 36, 44, 0.8);
            }
        }

        .scroll-card-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, #c6242c 0%, #8b2f2e 100%);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            font-family: 'Tajawal', sans-serif;
            box-shadow: 0 4px 12px rgba(198, 36, 44, 0.4);
            z-index: 3;
            opacity: 0;
            transform: translateY(-10px);
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .scroll-card:hover .scroll-card-badge {
            opacity: 1;
            transform: translateY(0);
        }

        @media (max-width: 900px) {
            .ps5-section {
                grid-template-columns: 1fr;
                min-height: auto;
            }

            .ps5-image {
                height: auto;
            }

            .ps5-content {
                padding: 40px 20px;
            }

            .scroll-card {
                flex: 0 0 300px;
                min-height: 400px;
                padding: 30px 15px;
            }

            .scroll-content {
                font-size: 1.2rem;
            }
        }

        /* Footer */
        .footer {
            background: #f3daac;
            padding: 44px 0 20px 0;
            width: 100%;
            display: block;
        }

        .footer-content-ar {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 50px;
        }

        .footer-row-ar {
            display: flex;
            justify-content: flex-start;
            gap: 100px;
            width: 100%;
            margin-bottom: 30px;
            max-width: 1200px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 50px;
        }

        .footer-column-ar {
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex: 0 1 auto;
        }

        .footer-title-ar {
            color: #42221a;
            font-size: 19px;
            font-weight: 700;
            margin-bottom: 12px;
            font-family: 'Scheherazade New', Arial, sans-serif;
            letter-spacing: .6px;
            text-align: left;
        }

        .footer-list-ar {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .footer-link-ar {
            font-size: 15.5px;
            font-weight: 500;
            color: #681e1e;
            text-decoration: none;
            font-family: 'Scheherazade New', Arial, sans-serif;
            transition: color 0.3s ease;
            padding: 2px 0;
            text-align: left;
            cursor: pointer;
        }

        .footer-link-ar:hover {
            color: #702524;
            text-decoration: underline;
        }

        .footer-divider-ar {
            width: 100%;
            height: 1px;
            background-color: #702524;
            margin: 22px 0 10px 0;
        }

        .footer-description-ar {
            font-size: 14px;
            color: #42221a;
            font-family: 'Scheherazade New', Arial, sans-serif;
            margin-bottom: 12px;
            text-align: left;
            line-height: 1.6;
        }
    </style>
</head>

<body>