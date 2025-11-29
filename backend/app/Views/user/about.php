<!-- Include HEAD (Opens Body) -->
<?= $this->include('components/head') ?>

<!-- Include HEADER -->
<?= $this->include('components/header') ?>

<style>
    :root {
        --brand: #702524;
        --brand-dark: #4c0404;
        --accent: #f3daac;
        --accent-light: #fdf6e3;
        --text-main: #161616;
        --text-muted: #555;
    }

    /* --- Hero Section --- */
    .about-hero {
        position: relative;
        background: linear-gradient(135deg, #610e0e 0%, #4c0404 50%, #2a0202 100%);
        padding: 120px 20px;
        text-align: center;
        overflow: hidden;
        color: white;
    }

    .about-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle at 20% 50%, rgba(243, 218, 172, 0.1) 0%, transparent 50%),
            radial-gradient(circle at 80% 20%, rgba(112, 37, 36, 0.2) 0%, transparent 50%);
        pointer-events: none;
    }

    .about-hero-content {
        position: relative;
        z-index: 10;
        max-width: 800px;
        margin: 0 auto;
    }

    .about-label {
        display: inline-block;
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        color: var(--accent);
        text-transform: uppercase;
        letter-spacing: 2px;
        margin-bottom: 16px;
        font-size: 14px;
        border: 1px solid rgba(243, 218, 172, 0.3);
        padding: 6px 16px;
        border-radius: 50px;
        background: rgba(0, 0, 0, 0.2);
    }

    .about-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 800;
        font-size: 56px;
        line-height: 1.1;
        margin-bottom: 24px;
        background: linear-gradient(to bottom, #fff 0%, #f3daac 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .about-subtitle {
        font-family: 'Scheherazade New', serif;
        font-size: 22px;
        color: rgba(255, 255, 255, 0.9);
        line-height: 1.6;
    }

    /* --- Main Container --- */
    .about-container {
        max-width: 1100px;
        margin: 0 auto;
        padding: 80px 24px;
    }

    /* --- Mission / Vision Grid --- */
    .mv-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 40px;
        margin-bottom: 100px;
    }

    .mv-card {
        background: white;
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.05);
        border-top: 4px solid var(--brand);
        transition: transform 0.3s ease;
    }

    .mv-card:hover {
        transform: translateY(-10px);
    }

    .mv-icon {
        width: 60px;
        height: 60px;
        background: var(--accent-light);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 24px;
        color: var(--brand);
    }

    .mv-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 24px;
        color: var(--brand);
        margin-bottom: 16px;
    }

    .mv-text {
        font-family: 'Scheherazade New', serif;
        font-size: 18px;
        color: var(--text-muted);
        line-height: 1.7;
    }

    /* --- Story Section --- */
    .story-section {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 60px;
        align-items: center;
        margin-bottom: 100px;
    }

    .story-image {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    .story-image img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }

    .story-image:hover img {
        transform: scale(1.05);
    }

    .story-content h2 {
        font-family: 'Tajawal', sans-serif;
        font-weight: 800;
        font-size: 36px;
        color: var(--text-main);
        margin-bottom: 24px;
    }

    .story-content p {
        font-family: 'Scheherazade New', serif;
        font-size: 19px;
        color: var(--text-muted);
        line-height: 1.8;
        margin-bottom: 20px;
    }

    /* --- Team Section --- */
    .team-section {
        text-align: center;
    }

    .team-header {
        margin-bottom: 60px;
    }

    .team-header h2 {
        font-family: 'Tajawal', sans-serif;
        font-weight: 800;
        font-size: 36px;
        color: var(--brand);
        margin-bottom: 12px;
    }

    .team-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 40px;
    }

    .team-card {
        background: white;
        padding: 30px 20px;
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .team-card:hover {
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.08);
        border-color: var(--accent);
    }

    .team-avatar {
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
        border-radius: 50%;
        background: #f0f0f0;
        overflow: hidden;
        border: 4px solid white;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
    }

    .team-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .team-name {
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: var(--text-main);
        margin-bottom: 4px;
    }

    .team-role {
        font-family: 'Scheherazade New', serif;
        font-size: 16px;
        color: var(--brand);
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    /* --- Divider --- */
    .divider-gold {
        height: 1px;
        background: linear-gradient(90deg, transparent, var(--accent), transparent);
        margin: 80px 0;
        opacity: 0.5;
    }

    @media (max-width: 768px) {
        .about-title {
            font-size: 42px;
        }

        .story-section {
            grid-template-columns: 1fr;
        }

        .about-hero {
            padding: 80px 20px;
        }
    }
</style>

<main>
    <!-- Hero -->
    <section class="about-hero">
        <div class="about-hero-content">
            <span class="about-label">Our History</span>
            <h1 class="about-title">About RetroCrypt</h1>
            <p class="about-subtitle">Retrocrypt is Egypt's premier digital portal, dedicated to archiving and celebrating the rich history of gaming culture and modern technological advancements.</p>
        </div>
    </section>

    <div class="about-container">

        <!-- Mission / Vision -->
        <div class="mv-grid">
            <div class="mv-card">
                <div class="mv-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="m9 12 2 2 4-4" />
                    </svg>
                </div>
                <h3 class="mv-title">Our Mission</h3>
                <p class="mv-text">To create a comprehensive, accessible, and engaging knowledge bank that documents the evolution of video games and technology, ensuring future generations can appreciate the roots of modern entertainment.</p>
            </div>
            <div class="mv-card">
                <div class="mv-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12h20" />
                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10" />
                        <path d="M12 2a15.3 15.3 0 0 0-4 10 15.3 15.3 0 0 0 4 10" />
                        <path d="m4.93 4.93 14.14 14.14" />
                        <path d="m19.07 4.93-14.14 14.14" />
                    </svg>
                </div>
                <h3 class="mv-title">Our Vision</h3>
                <p class="mv-text">We envision a world where digital history is treated with the same reverence as physical artifacts. A digital museum that connects gamers, collectors, and historians across the globe.</p>
            </div>
        </div>

        <div class="divider-gold"></div>

        <!-- Story -->
        <section class="story-section">
            <div class="story-content">
                <h2>Our Story</h2>
                <p>It started with a simple passion: the love for retro consoles. In 2024, a small team of enthusiasts noticed that while games were moving forward, the history of where they came from was slowly being lost to time.</p>
                <p>We built RetroCrypt not just as a store, but as an archive. From the golden age of 8-bit classics to the cutting-edge consoles of today, we curate, restore, and document every piece of hardware that passes through our hands.</p>
                <p>Today, we stand as a bridge between the past and the future, serving a community that values the artistry of gaming.</p>
            </div>
            <div class="story-image">
                <img src="https://www.discoverwalks.com/blog/wp-content/uploads/2023/10/egypt-7078739_1280.jpg" alt="Retro Gaming Collection">
            </div>
        </section>

        <div class="divider-gold"></div>

        <!-- Team -->
        <section class="team-section">
            <div class="team-header">
                <h2>Meet The Team</h2>
                <p style="font-family: 'Scheherazade New', serif; font-size: 18px; color: #666;">The passionate minds behind RetroCrypt.</p>
            </div>

            <div class="team-grid">
                <div class="team-card">
                    <div class="team-avatar">
                        <img src="https://thumbs.dreamstime.com/b/portrait-ancient-egyptian-god-anubis-17173117.jpg" alt="Sarah">
                    </div>
                    <div class="team-name">Niko Luis Anchorez</div>
                    <div class="team-role">Project Manager & QA</div>
                </div>

                <div class="team-card">
                    <div class="team-avatar">
                        <img src="https://static.vecteezy.com/system/resources/previews/057/563/178/non_2x/beautiful-traditional-egyptian-anubis-statue-black-finish-front-view-transparent-background-high-resolution-png.png" alt="Ahmed">
                    </div>
                    <div class="team-name">Alexander Jay Eliarda</div>
                    <div class="team-role">Backend Developer</div>
                </div>

                <div class="team-card">
                    <div class="team-avatar">
                        <img src="https://art.scholastic.com/content/dam/classroom-magazines/art/pages/archives/articles/2013-2014/ART_030114_P01_TutCvr_MD.jpg" alt="Leo">
                    </div>
                    <div class="team-name">Gabriel Miro Velasco</div>
                    <div class="team-role">Backend Developer</div>
                </div>

                <div class="team-card">
                    <div class="team-avatar">
                        <img src="https://i.pinimg.com/474x/14/03/21/14032137bfe515dd86f2a25710ab3647.jpg" alt="Nour">
                    </div>
                    <div class="team-name">Chesca Bautista</div>
                    <div class="team-role">Frontend Developer</div>
                </div>
            </div>
        </section>

    </div>
</main>

<!-- Include FOOTER (Closes Body) -->
<?= $this->include('components/footer') ?>