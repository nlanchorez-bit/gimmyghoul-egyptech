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
        --bg-card: #ffffff;
    }

    /* --- Hero Section --- */
    .support-hero {
        position: relative;
        background: linear-gradient(135deg, #610e0e 0%, #4c0404 50%, #2a0202 100%);
        padding: 100px 20px 140px;
        /* Extra padding bottom for overlapping cards */
        text-align: center;
        color: white;
        overflow: hidden;
    }

    .support-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: repeating-linear-gradient(45deg, rgba(243, 218, 172, 0.05) 0px, rgba(243, 218, 172, 0.05) 1px, transparent 1px, transparent 20px);
        pointer-events: none;
    }

    .hero-content {
        position: relative;
        z-index: 10;
        max-width: 700px;
        margin: 0 auto;
    }

    .hero-badge {
        display: inline-block;
        padding: 6px 16px;
        background: rgba(243, 218, 172, 0.2);
        border: 1px solid var(--accent);
        border-radius: 50px;
        color: var(--accent);
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 13px;
        letter-spacing: 1px;
        margin-bottom: 20px;
    }

    .hero-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 800;
        font-size: 48px;
        margin-bottom: 16px;
        line-height: 1.2;
    }

    .hero-subtitle {
        font-family: 'Scheherazade New', serif;
        font-size: 20px;
        color: rgba(255, 255, 255, 0.85);
        margin-bottom: 40px;
    }

    /* Search Box */
    .search-wrapper {
        position: relative;
        max-width: 500px;
        margin: 0 auto;
    }

    .search-input {
        width: 100%;
        padding: 18px 24px 18px 54px;
        border-radius: 50px;
        border: none;
        font-family: 'Scheherazade New', serif;
        font-size: 18px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        transition: transform 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        transform: scale(1.02);
    }

    .search-icon {
        position: absolute;
        left: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--brand);
    }

    /* --- Support Topics Grid (Overlaps Hero) --- */
    .topics-container {
        max-width: 1100px;
        margin: -80px auto 80px;
        padding: 0 20px;
        position: relative;
        z-index: 20;
    }

    .topics-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 24px;
    }

    .topic-card {
        background: var(--bg-card);
        padding: 32px;
        border-radius: 20px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.06);
        text-align: center;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        border-bottom: 4px solid transparent;
        cursor: pointer;
    }

    .topic-card:hover {
        transform: translateY(-10px);
        border-bottom-color: var(--brand);
        box-shadow: 0 20px 40px rgba(112, 37, 36, 0.1);
    }

    .topic-icon {
        width: 64px;
        height: 64px;
        background: var(--accent-light);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        color: var(--brand);
        font-size: 24px;
    }

    .topic-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: var(--text-main);
        margin-bottom: 8px;
    }

    .topic-desc {
        font-family: 'Scheherazade New', serif;
        font-size: 16px;
        color: var(--text-muted);
        line-height: 1.5;
    }

    /* --- FAQ Section --- */
    .faq-section {
        max-width: 800px;
        margin: 0 auto 100px;
        padding: 0 20px;
    }

    .section-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .section-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 800;
        font-size: 36px;
        color: var(--brand);
        margin-bottom: 10px;
    }

    .faq-item {
        background: white;
        border: 1px solid rgba(0, 0, 0, 0.05);
        border-radius: 12px;
        margin-bottom: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .faq-item:hover {
        border-color: var(--accent);
    }

    .faq-question {
        padding: 20px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: var(--text-main);
        background: white;
        border: none;
        width: 100%;
        text-align: left;
    }

    .faq-answer {
        padding: 0 24px;
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease, padding 0.3s ease;
        font-family: 'Scheherazade New', serif;
        font-size: 17px;
        color: var(--text-muted);
        line-height: 1.6;
        background: #fcfcfc;
    }

    .faq-item.active .faq-answer {
        max-height: 200px;
        /* Approximate height */
        padding: 0 24px 24px;
    }

    .faq-toggle {
        transition: transform 0.3s ease;
        color: var(--brand);
    }

    .faq-item.active .faq-toggle {
        transform: rotate(180deg);
    }

    /* --- Contact Form Section --- */
    .contact-section {
        background: #fff;
        max-width: 1000px;
        margin: 0 auto 100px;
        padding: 60px;
        border-radius: 24px;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(112, 37, 36, 0.1);
        position: relative;
        overflow: hidden;
    }

    .contact-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 6px;
        background: linear-gradient(90deg, var(--brand) 0%, var(--accent) 100%);
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .form-group {
        margin-bottom: 24px;
    }

    .form-label {
        display: block;
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        margin-bottom: 8px;
        color: var(--text-main);
        font-size: 15px;
    }

    .form-input,
    .form-textarea {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #eee;
        border-radius: 12px;
        font-family: 'Scheherazade New', serif;
        font-size: 16px;
        transition: border-color 0.3s ease;
        outline: none;
        background: #fcfcfc;
    }

    .form-input:focus,
    .form-textarea:focus {
        border-color: var(--brand);
        background: white;
    }

    .form-textarea {
        min-height: 150px;
        resize: vertical;
    }

    .submit-btn {
        background: linear-gradient(135deg, #8b2f2e 0%, #702524 100%);
        color: white;
        border: none;
        padding: 16px 36px;
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 16px;
        border-radius: 50px;
        cursor: pointer;
        transition: transform 0.2s ease, box-shadow 0.2s ease;
        display: inline-block;
    }

    .submit-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(112, 37, 36, 0.2);
    }

    .contact-info {
        padding-left: 40px;
        border-left: 1px solid #eee;
    }

    .info-item {
        margin-bottom: 30px;
    }

    .info-title {
        font-family: 'Tajawal', sans-serif;
        font-weight: 700;
        font-size: 18px;
        color: var(--brand);
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .info-text {
        font-family: 'Scheherazade New', serif;
        font-size: 16px;
        color: var(--text-muted);
        line-height: 1.6;
    }

    @media (max-width: 900px) {
        .form-grid {
            grid-template-columns: 1fr;
            gap: 0;
        }

        .contact-info {
            padding-left: 0;
            border-left: none;
            margin-top: 40px;
            padding-top: 40px;
            border-top: 1px solid #eee;
        }

        .hero-title {
            font-size: 36px;
        }

        .contact-section {
            padding: 30px;
            margin: 0 20px 80px;
        }
    }
</style>

<main>
    <!-- Hero -->
    <section class="support-hero">
        <div class="hero-content">
            <span class="hero-badge">24/7 SUPPORT</span>
            <h1 class="hero-title">How can we help you?</h1>
            <p class="hero-subtitle">Search our knowledge base or browse common topics below.</p>

            <div class="search-wrapper">
                <svg class="search-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="11" cy="11" r="8" />
                    <path d="m21 21-4.3-4.3" />
                </svg>
                <input type="text" class="search-input" placeholder="Type your question...">
            </div>
        </div>
    </section>

    <!-- Topic Cards -->
    <div class="topics-container">
        <div class="topics-grid">
            <div class="topic-card">
                <div class="topic-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 2 3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4Z" />
                        <path d="M3 6h18" />
                        <path d="M16 10a4 4 0 0 1-8 0" />
                    </svg>
                </div>
                <h3 class="topic-title">Orders & Shipping</h3>
                <p class="topic-desc">Track packages, edit orders, and shipping info.</p>
            </div>

            <div class="topic-card">
                <div class="topic-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z" />
                    </svg>
                </div>
                <h3 class="topic-title">Returns & Refunds</h3>
                <p class="topic-desc">Return policy and refund status tracking.</p>
            </div>

            <div class="topic-card">
                <div class="topic-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                </div>
                <h3 class="topic-title">Account Settings</h3>
                <p class="topic-desc">Manage password, email, and preferences.</p>
            </div>

            <div class="topic-card">
                <div class="topic-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="14" x="2" y="3" rx="2" />
                        <line x1="8" x2="16" y1="21" y2="21" />
                        <line x1="12" x2="12" y1="17" y2="21" />
                    </svg>
                </div>
                <h3 class="topic-title">Technical Support</h3>
                <p class="topic-desc">Console troubleshooting and warranty claims.</p>
            </div>
        </div>
    </div>

    <!-- FAQ Accordion -->
    <section class="faq-section">
        <div class="section-header">
            <h2 class="section-title">Frequently Asked Questions</h2>
            <p style="font-family:'Scheherazade New'; font-size:18px; color:#666;">Quick answers to common questions.</p>
        </div>

        <div class="faq-item">
            <button class="faq-question">
                What payment methods do you accept?
                <svg class="faq-toggle" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </button>
            <div class="faq-answer">
                We accept all major credit/debit cards (Visa, Mastercard), PayPal, and local payment methods such as Fawry for our Egyptian customers.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">
                How long does shipping take?
                <svg class="faq-toggle" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </button>
            <div class="faq-answer">
                Domestic shipping within Egypt typically takes 2-4 business days. International orders may take 7-14 business days depending on customs processing.
            </div>
        </div>

        <div class="faq-item">
            <button class="faq-question">
                Do you offer a warranty on retro consoles?
                <svg class="faq-toggle" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m6 9 6 6 6-6" />
                </svg>
            </button>
            <div class="faq-answer">
                Yes! All our refurbished retro consoles undergo rigorous testing and come with a 6-month Gimmighoul Guarantee against hardware defects.
            </div>
        </div>
    </section>

    <!-- Contact Form -->
    <section class="contact-section">
        <div class="form-grid">
            <div class="contact-form">
                <h2 class="section-title" style="font-size:30px; text-align:left;">Send us a Message</h2>
                <p style="font-family:'Scheherazade New'; font-size:16px; color:#666; margin-bottom:30px;">We usually reply within 24 hours.</p>

                <form action="#" method="POST">
                    <div class="form-group">
                        <label class="form-label">Full Name</label>
                        <input type="text" class="form-input" placeholder="John Doe">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Email Address</label>
                        <input type="email" class="form-input" placeholder="john@example.com">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea class="form-textarea" placeholder="Describe your issue..."></textarea>
                    </div>
                    <button type="button" class="submit-btn">Send Message</button>
                </form>
            </div>

            <div class="contact-info">
                <div class="info-item">
                    <div class="info-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect width="20" height="16" x="2" y="4" rx="2" />
                            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7" />
                        </svg>
                        Email Us
                    </div>
                    <p class="info-text">support@gimmighoul.com</p>
                </div>

                <div class="info-item">
                    <div class="info-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" />
                        </svg>
                        Call Us
                    </div>
                    <p class="info-text">+20 123 456 7890<br><small style="color:#999;">Mon-Fri, 9am - 6pm EET</small></p>
                </div>

                <div class="info-item">
                    <div class="info-title">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z" />
                            <circle cx="12" cy="10" r="3" />
                        </svg>
                        Visit Us
                    </div>
                    <p class="info-text">123 Pyramids Road<br>Giza, Egypt</p>
                </div>
            </div>
        </div>
    </section>

</main>

<!-- Footer -->
<?= $this->include('components/footer') ?>

<!-- FAQ Interaction Script -->
<script>
    document.querySelectorAll('.faq-question').forEach(button => {
        button.addEventListener('click', () => {
            const faqItem = button.parentElement;
            faqItem.classList.toggle('active');
        });
    });
</script>