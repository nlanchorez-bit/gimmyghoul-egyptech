<!doctype html>
<html lang="en">

<?= $this->include('components/head') ?>
<?= $this->include('components/header') ?>


<body>
    <style>
        /* Moodboard-specific styles only */
        .mb-hero {
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #610e0e 0%, #4c0404 50%, #8b2f2e 100%);
            padding: 80px 0;
        }

        .mb-hero-overlay {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            opacity: 0.1;
            background-image: repeating-linear-gradient(0deg, transparent, transparent 2px, rgba(243, 218, 172, 0.3) 2px, rgba(243, 218, 172, 0.3) 4px);
        }

        .mb-hero-content {
            position: relative;
            z-index: 10;
            margin: 0 auto;
            padding: 0 24px;
            max-width: 1200px;
            text-align: center;
        }

        .mb-pill {
            display: inline-block;
            margin-bottom: 16px;
            padding: 8px 32px;
            border-radius: 999px;
            background: rgba(243, 218, 172, 0.2);
            border: 2px solid #f3daac;
        }

        .mb-pill-text {
            color: #f3daac;
            font-family: 'Tajawal', sans-serif;
            font-weight: 700;
            font-size: 14px;
            letter-spacing: 2px;
        }

        .mb-hero-title {
            margin-bottom: 16px;
            font-family: 'Tajawal', sans-serif;
            font-weight: 700;
            color: #f5e6c8;
            font-size: 48px;
            text-shadow: 3px 3px 6px rgba(0, 0, 0, 0.5);
        }

        .mb-hero-desc {
            font-family: 'Scheherazade New', serif;
            color: #f3daac;
            font-size: 18px;
            max-width: 700px;
            margin: 0 auto;
        }

        .mb-hero-border {
            position: absolute;
            right: 0;
            bottom: 0;
            left: 0;
            height: 8px;
            background: repeating-linear-gradient(90deg, #f3daac 0px, #f3daac 20px, #c9a669 20px, #c9a669 40px);
        }

        .mb-main {
            margin: 0 auto;
            padding: 64px 24px;
            max-width: 1400px;
        }

        .mb-section {
            margin-bottom: 80px;
        }

        .mb-section-header {
            margin-bottom: 48px;
            text-align: center;
        }

        .mb-section-title-wrap {
            display: inline-block;
            margin-bottom: 16px;
            padding: 12px 24px;
            border-radius: 12px;
            background: linear-gradient(135deg, #f3daac 0%, #e0c896 100%);
            border: 3px solid #702524;
        }

        .mb-section-title {
            margin: 0;
            font-family: 'Tajawal', sans-serif;
            font-weight: 700;
            color: #702524;
            font-size: 32px;
        }

        .mb-section-desc {
            color: #5a5a5a;
            font-family: 'Scheherazade New', serif;
            font-size: 16px;
        }

        /* Color Palette Grid */
        .mb-color-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 32px;
        }

        .mb-color-card {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-radius: 16px;
            overflow: hidden;
            background: white;
        }

        .mb-color-card-body {
            padding: 24px;
        }

        .mb-color-card-title {
            margin-bottom: 16px;
            text-align: center;
            font-family: 'Tajawal', sans-serif;
            font-weight: 700;
            font-size: 20px;
        }

        .mb-color-swatches {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .mb-swatch {
            position: relative;
        }

        .mb-swatch-color {
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            height: 96px;
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .mb-swatch-color:hover {
            transform: scale(1.05);
        }

        .mb-swatch-label {
            margin-top: 8px;
            text-align: center;
            font-family: 'Scheherazade New', serif;
            font-size: 13px;
            color: #42221a;
            font-weight: 600;
        }

        .mb-color-card-footer {
            padding: 16px 24px;
            text-align: center;
        }

        .mb-color-card-footer p {
            font-family: 'Scheherazade New', serif;
            font-size: 14px;
            margin: 0;
        }

        /* Typography Section */
        .mb-typo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 32px;
        }

        .mb-typo-card {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-radius: 16px;
            overflow: hidden;
        }

        .mb-typo-body {
            padding: 40px;
            text-align: center;
        }

        .mb-typo-label {
            margin-bottom: 24px;
            font-size: 14px;
            letter-spacing: 2px;
        }

        .mb-typo-name {
            margin-bottom: 32px;
            font-size: 56px;
            line-height: 1.2;
        }

        .mb-typo-samples {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .mb-typo-footer {
            padding: 12px 24px;
            text-align: center;
            border-top: 2px solid;
        }

        .mb-typo-footer p {
            font-size: 13px;
            margin: 0;
        }

        /* Buttons Section */
        .mb-button-showcase {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            padding: 40px;
            border-radius: 16px;
            background: white;
            border: 4px solid #702524;
        }

        .mb-button-mode {
            margin-bottom: 48px;
        }

        .mb-button-mode:last-child {
            margin-bottom: 0;
        }

        .mb-mode-header {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }

        .mb-mode-line {
            flex: 1;
            height: 1px;
        }

        .mb-mode-title {
            margin: 0 16px;
            font-family: 'Tajawal', sans-serif;
            font-weight: 700;
            color: #702524;
            font-size: 20px;
        }

        .mb-button-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 16px;
            padding: 40px;
            border-radius: 16px;
        }

        .mb-button-note {
            margin-top: 32px;
            padding: 16px;
            border-radius: 8px;
            text-align: center;
            background: rgba(243, 218, 172, 0.2);
            border: 2px dashed #702524;
        }

        .mb-button-note p {
            font-family: 'Scheherazade New', serif;
            color: #42221a;
            font-size: 14px;
            margin: 0;
        }

        .mb-button-note strong {
            font-family: 'Tajawal', sans-serif;
        }

        /* Cards Section */
        .mb-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        /* Logos Section */
        .mb-logos-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
            gap: 32px;
        }

        .mb-logo-card {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            border-radius: 16px;
            overflow: hidden;
            background: linear-gradient(135deg, #f5e6c8 0%, #f3daac 100%);
            border: 4px solid #702524;
        }

        .mb-logo-body {
            padding: 48px;
            text-align: center;
        }

        .mb-logo-display {
            display: inline-flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            margin-bottom: 24px;
            background: linear-gradient(135deg, #8b2f2e 0%, #702524 100%);
            border: 6px solid #f3daac;
        }

        .mb-logo-circle {
            width: 200px;
            height: 200px;
            border-radius: 50%;
        }

        .mb-logo-square {
            width: 200px;
            height: 200px;
            border-radius: 24px;
        }

        .mb-logo-text-wrap {
            text-align: center;
        }

        .mb-logo-text-main {
            font-family: 'Tajawal', sans-serif;
            font-weight: 700;
            color: #f5e6c8;
            font-size: 28px;
            line-height: 1.2;
        }

        .mb-logo-text-sub {
            font-family: 'Scheherazade New', serif;
            color: #f3daac;
            font-size: 11px;
            margin-top: 4px;
            letter-spacing: 1px;
        }

        .mb-logo-name {
            font-family: 'Tajawal', sans-serif;
            font-weight: 700;
            color: #702524;
            font-size: 20px;
            margin: 0;
        }

        .mb-logo-desc {
            font-family: 'Scheherazade New', serif;
            color: #42221a;
            font-size: 14px;
            margin-top: 8px;
        }

        @media (max-width: 768px) {
            .mb-hero-title {
                font-size: 32px;
            }

            .mb-hero-desc {
                font-size: 16px;
            }

            .mb-section-title {
                font-size: 24px;
            }

            .mb-color-grid,
            .mb-typo-grid,
            .mb-logos-grid {
                grid-template-columns: 1fr;
            }

            .mb-button-container {
                flex-direction: column;
            }
        }
    </style>

    <!-- Hero Header -->
    <div class="mb-hero">
        <div class="mb-hero-overlay"></div>
        <div class="mb-hero-content">
            <div class="mb-pill">
                <span class="mb-pill-text">VISUAL IDENTITY</span>
            </div>
            <h1 class="mb-hero-title">
                Gimmighoul Mood Board
            </h1>
            <p class="mb-hero-desc">
                Design system for Egypt's Digital Heritage & Gaming Portal — where ancient aesthetics meet modern gaming culture
            </p>
        </div>
        <div class="mb-hero-border"></div>
    </div>

    <main class="mb-main">

        <!-- COLOR SYSTEM -->
        <section class="mb-section">
            <div class="mb-section-header">
                <div class="mb-section-title-wrap">
                    <h2 class="mb-section-title">
                        𓆏 Color Palette 𓆏
                    </h2>
                </div>
                <p class="mb-section-desc">
                    Ancient Egyptian inspired colors — From the depths of royal tombs to the golden sands of heritage
                </p>
            </div>

            <div class="mb-color-grid">
                <!-- Burgundy Red -->
                <div class="mb-color-card" style="border: 4px solid #702524;">
                    <div class="mb-color-card-body" style="background: linear-gradient(135deg, #f5e6c8 0%, #f3daac 100%);">
                        <h3 class="mb-color-card-title" style="color: #702524;">
                            Burgundy Red
                        </h3>
                        <div class="mb-color-swatches">
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #4c0404;"></div>
                                <div class="mb-swatch-label">#4C0404</div>
                            </div>
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #702524;"></div>
                                <div class="mb-swatch-label">#702524</div>
                            </div>
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #8b2f2e;"></div>
                                <div class="mb-swatch-label">#8B2F2E</div>
                            </div>
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #c6242c;"></div>
                                <div class="mb-swatch-label">#C6242C</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-color-card-footer" style="background: #702524;">
                        <p style="color: #f3daac;">
                            Primary • Royal Tombs
                        </p>
                    </div>
                </div>

                <!-- Golden Beige -->
                <div class="mb-color-card" style="border: 4px solid #c9a669;">
                    <div class="mb-color-card-body" style="background: linear-gradient(135deg, #fff 0%, #f5e6c8 100%);">
                        <h3 class="mb-color-card-title" style="color: #c9a669;">
                            Golden Beige
                        </h3>
                        <div class="mb-color-swatches">
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #c9a669;"></div>
                                <div class="mb-swatch-label">#C9A669</div>
                            </div>
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #e0c896;"></div>
                                <div class="mb-swatch-label">#E0C896</div>
                            </div>
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #f3daac;"></div>
                                <div class="mb-swatch-label">#F3DAAC</div>
                            </div>
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #f5e6c8;"></div>
                                <div class="mb-swatch-label">#F5E6C8</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-color-card-footer" style="background: #c9a669;">
                        <p style="color: #161616;">
                            Accent • Desert Sands
                        </p>
                    </div>
                </div>

                <!-- Neutral Tones -->
                <div class="mb-color-card" style="border: 4px solid #42221a;">
                    <div class="mb-color-card-body" style="background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);">
                        <h3 class="mb-color-card-title" style="color: #161616;">
                            Neutral Tones
                        </h3>
                        <div class="mb-color-swatches">
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #161616;"></div>
                                <div class="mb-swatch-label">#161616</div>
                            </div>
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #42221a;"></div>
                                <div class="mb-swatch-label">#42221A</div>
                            </div>
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #c9c9c9;"></div>
                                <div class="mb-swatch-label">#C9C9C9</div>
                            </div>
                            <div class="mb-swatch">
                                <div class="mb-swatch-color" style="background: #f5f5f5;"></div>
                                <div class="mb-swatch-label">#F5F5F5</div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-color-card-footer" style="background: #42221a;">
                        <p style="color: #f3daac;">
                            Secondary • Ancient Stones
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- TYPOGRAPHY -->
        <section class="mb-section">
            <div class="mb-section-header">
                <div class="mb-section-title-wrap">
                    <h2 class="mb-section-title">
                        𓀀 Typography 𓀀
                    </h2>
                </div>
                <p class="mb-section-desc">
                    Fonts that bridge ancient heritage with modern readability
                </p>
            </div>

            <div class="mb-typo-grid">
                <!-- Tajawal -->
                <div class="mb-typo-card" style="background: linear-gradient(135deg, #610e0e 0%, #4c0404 100%); border: 4px solid #8b2f2e;">
                    <div class="mb-typo-body">
                        <div class="mb-typo-label" style="font-family: 'Scheherazade New', serif; color: #f3daac;">
                            HEADING FONT
                        </div>
                        <h3 class="mb-typo-name" style="font-family: 'Tajawal', sans-serif; font-weight: 700; color: #f5e6c8;">
                            Tajawal
                        </h3>
                        <div class="mb-typo-samples">
                            <p style="font-family: 'Tajawal', sans-serif; font-weight: 700; color: #f3daac; font-size: 32px; margin: 0;">
                                Bold Headlines
                            </p>
                            <p style="font-family: 'Tajawal', sans-serif; font-weight: 600; color: #e0c896; font-size: 24px; margin: 0;">
                                Semibold Subheadings
                            </p>
                            <p style="font-family: 'Tajawal', sans-serif; font-weight: 500; color: #c9a669; font-size: 18px; margin: 0;">
                                Medium Navigation Text
                            </p>
                        </div>
                    </div>
                    <div class="mb-typo-footer" style="background: rgba(243, 218, 172, 0.2); border-color: #702524;">
                        <p style="font-family: 'Scheherazade New', serif; color: #f3daac;">
                            Strong, authoritative, modern
                        </p>
                    </div>
                </div>

                <!-- Scheherazade New -->
                <div class="mb-typo-card" style="background: linear-gradient(135deg, #f5e6c8 0%, #f3daac 100%); border: 4px solid #c9a669;">
                    <div class="mb-typo-body">
                        <div class="mb-typo-label" style="font-family: 'Tajawal', sans-serif; color: #702524; font-weight: 700;">
                            BODY FONT
                        </div>
                        <h3 class="mb-typo-name" style="font-family: 'Scheherazade New', serif; font-weight: 700; color: #702524;">
                            Scheherazade New
                        </h3>
                        <div class="mb-typo-samples">
                            <p style="font-family: 'Scheherazade New', serif; font-weight: 700; color: #42221a; font-size: 24px; margin: 0;">
                                Bold emphasis text
                            </p>
                            <p style="font-family: 'Scheherazade New', serif; font-weight: 400; color: #42221a; font-size: 18px; line-height: 1.8; margin: 0;">
                                Regular body text that flows elegantly across paragraphs, bringing a touch of ancient storytelling tradition to modern content.
                            </p>
                        </div>
                    </div>
                    <div class="mb-typo-footer" style="background: rgba(112, 37, 36, 0.15); border-color: #702524;">
                        <p style="font-family: 'Scheherazade New', serif; color: #702524;">
                            Elegant, readable, heritage-inspired
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- BUTTONS -->
        <section class="mb-section">
            <div class="mb-section-header">
                <div class="mb-section-title-wrap">
                    <h2 class="mb-section-title">
                        𓊽 Button Styles 𓊽
                    </h2>
                </div>
                <p class="mb-section-desc">
                    Interactive elements with Egyptian-inspired elegance
                </p>
            </div>

            <div class="mb-button-showcase">
                <!-- Light Mode -->
                <div class="mb-button-mode">
                    <div class="mb-mode-header">
                        <div class="mb-mode-line" style="background: linear-gradient(90deg, #702524 0%, transparent 100%);"></div>
                        <h3 class="mb-mode-title">Light Mode</h3>
                        <div class="mb-mode-line" style="background: linear-gradient(90deg, transparent 0%, #702524 100%);"></div>
                    </div>
                    <div class="mb-button-container" style="background: linear-gradient(135deg, #f5f5f5 0%, #e8dcc5 100%);">
                        <?= $this->include('components/buttons/button_primary', ['label' => 'Primary', 'href' => '#']) ?>
                        <?= $this->include('components/buttons/button_secondary', ['label' => 'Secondary', 'href' => '#']) ?>
                        <?= $this->include('components/buttons/button_border', ['label' => 'Border', 'href' => '#']) ?>
                        <?= $this->include('components/buttons/button_primary', ['label' => 'Disabled', 'href' => '#', 'disable' => true]) ?>
                    </div>
                </div>

                <!-- Dark Mode -->
                <div class="mb-button-mode">
                    <div class="mb-mode-header">
                        <div class="mb-mode-line" style="background: linear-gradient(90deg, #f3daac 0%, transparent 100%);"></div>
                        <h3 class="mb-mode-title">Dark Mode</h3>
                        <div class="mb-mode-line" style="background: linear-gradient(90deg, transparent 0%, #f3daac 100%);"></div>
                    </div>
                    <div class="mb-button-container" style="background: linear-gradient(135deg, #161616 0%, #42221a 100%);">
                        <?= $this->include('components/buttons/button_primary', ['label' => 'Primary', 'href' => '#', 'dark' => true]) ?>
                        <?= $this->include('components/buttons/button_secondary', ['label' => 'Secondary', 'href' => '#', 'dark' => true]) ?>
                        <?= $this->include('components/buttons/button_border', ['label' => 'Border', 'href' => '#', 'dark' => true]) ?>
                        <?= $this->include('components/buttons/button_primary', ['label' => 'Disabled', 'href' => '#', 'disable' => true]) ?>
                    </div>
                </div>

                <div class="mb-button-note">
                    <p>
                        <strong>Usage Guide:</strong> Primary for main CTAs • Secondary for supportive actions • Border for subtle actions • Disabled for unavailable states
                    </p>
                </div>
            </div>
        </section>

        <!-- CARD SAMPLES -->
        <section class="mb-section">
            <div class="mb-section-header">
                <div class="mb-section-title-wrap">
                    <h2 class="mb-section-title">
                        𓋹 Card Components 𓋹
                    </h2>
                </div>
                <p class="mb-section-desc">
                    Versatile content containers for stats, products, and testimonials
                </p>
            </div>

            <div class="mb-cards-grid">
                <?= $this->include('components/cards/card', ['title' => '2,847', 'excerpt' => 'Digital Artifacts Archived', 'image' => null]) ?>
                <?= $this->include('components/cards/card', ['title' => 'PlayStation 5 Console', 'excerpt' => 'Experience an all-new generation of incredible PlayStation games with Egyptian heritage themes and exclusive content.', 'image' => null]) ?>
                <?= $this->include('components/cards/card', ['title' => '"A beautifully curated digital experience"', 'excerpt' => '— Heritage Enthusiast & Gaming Community', 'image' => null]) ?>
            </div>
        </section>

        <!-- LOGOS -->
        <section class="mb-section">
            <div class="mb-section-header">
                <div class="mb-section-title-wrap">
                    <h2 class="mb-section-title">
                        𓁹 Brand Logos 𓁹
                    </h2>
                </div>
                <p class="mb-section-desc">
                    Logo variations for different applications and contexts
                </p>
            </div>

            <div class="mb-logos-grid">
                <!-- Circle Logo -->
                <div class="mb-logo-card">
                    <div class="mb-logo-body">
                        <div class="mb-logo-circle mb-logo-display">
                            <div class="mb-logo-text-wrap">
                                <div class="mb-logo-text-main">
                                    GIMMI<br>GHOUL
                                </div>
                                <div class="mb-logo-text-sub">
                                    EGYPT HERITAGE
                                </div>
                            </div>
                        </div>
                        <h3 class="mb-logo-name">
                            Main Logo — Circle
                        </h3>
                        <p class="mb-logo-desc">
                            For app icons, social media, stamps
                        </p>
                    </div>
                </div>

                <!-- Square Logo -->
                <div class="mb-logo-card">
                    <div class="mb-logo-body">
                        <div class="mb-logo-display mb-logo-square">
                            <div class="mb-logo-text-wrap">
                                <div class="mb-logo-text-main">
                                    GIMMI<br>GHOUL
                                </div>
                                <div class="mb-logo-text-sub">
                                    EGYPT HERITAGE
                                </div>
                            </div>
                        </div>
                        <h3 class="mb-logo-name">
                            Main Logo — Square
                        </h3>
                        <p class="mb-logo-desc">
                            For headers, badges, promotional materials
                        </p>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <?= $this->include('components/footer') ?>

</body>

</html>