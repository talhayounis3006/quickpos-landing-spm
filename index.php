<?php
session_start();
$errors = $_SESSION['form_errors'] ?? [];
$old    = $_SESSION['form_data']   ?? [];
unset($_SESSION['form_errors'], $_SESSION['form_data']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickPOS – Modern Point of Sale System</title>
    <style>
        /* ── RESET ── */
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: #1a1a2e; }

        /* ── HEADER ── */
        header {
            background: #1a1a2e;
            padding: 1rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
        }
        .logo { color: #fff; font-size: 1.6rem; font-weight: 700; text-decoration: none; }
        .logo span { color: #4cc9f0; }
        nav { display: flex; align-items: center; gap: 0.5rem; }
        nav a {
            color: #ccc;
            text-decoration: none;
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-size: 0.95rem;
            transition: color 0.2s;
        }
        nav a:hover { color: #4cc9f0; }
        .btn-signup {
            background: #4cc9f0 !important;
            color: #1a1a2e !important;
            padding: 0.5rem 1.4rem !important;
            border-radius: 25px !important;
            font-weight: 700 !important;
            margin-left: 0.5rem;
        }
        .btn-signup:hover { background: #38b2d8 !important; }

        /* ── HERO ── */
        .hero {
            background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%);
            color: white;
            text-align: center;
            padding: 7rem 2rem 6rem;
        }
        .hero-badge {
            display: inline-block;
            background: rgba(76,201,240,0.15);
            color: #4cc9f0;
            border: 1px solid rgba(76,201,240,0.3);
            padding: 0.4rem 1.2rem;
            border-radius: 20px;
            font-size: 0.85rem;
            margin-bottom: 1.5rem;
            letter-spacing: 0.05em;
        }
        .hero h1 {
            font-size: 3.2rem;
            line-height: 1.2;
            margin-bottom: 1.2rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }
        .hero h1 span { color: #4cc9f0; }
        .hero p {
            font-size: 1.2rem;
            color: #a8b2d8;
            max-width: 580px;
            margin: 0 auto 2.5rem;
            line-height: 1.7;
        }
        .btn-cta {
            background: #4cc9f0;
            color: #1a1a2e;
            padding: 1rem 2.8rem;
            border-radius: 30px;
            font-size: 1.1rem;
            font-weight: 700;
            text-decoration: none;
            display: inline-block;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-cta:hover { background: #38b2d8; transform: translateY(-2px); }

        /* ── FEATURES ── */
        .features {
            padding: 5.5rem 2rem;
            background: #f8f9fa;
            text-align: center;
        }
        .section-label {
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.15em;
            color: #4cc9f0;
            text-transform: uppercase;
            margin-bottom: 0.75rem;
        }
        .features h2, .pricing h2, .contact h2 {
            font-size: 2.1rem;
            margin-bottom: 0.6rem;
            color: #1a1a2e;
        }
        .section-sub {
            color: #666;
            font-size: 1.05rem;
            margin-bottom: 3rem;
        }
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
            gap: 1.5rem;
            max-width: 960px;
            margin: 0 auto;
        }
        .feature-card {
            background: white;
            border-radius: 14px;
            padding: 2rem 1.5rem;
            box-shadow: 0 2px 16px rgba(0,0,0,0.06);
            transition: transform 0.2s, box-shadow 0.2s;
            text-align: left;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0,0,0,0.1);
        }
        .feature-icon {
            width: 52px;
            height: 52px;
            background: rgba(76,201,240,0.12);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.6rem;
            margin-bottom: 1.2rem;
        }
        .feature-card h3 { font-size: 1.1rem; margin-bottom: 0.5rem; color: #1a1a2e; }
        .feature-card p  { color: #666; font-size: 0.92rem; line-height: 1.6; }

        /* ── PRICING ── */
        .pricing { padding: 5.5rem 2rem; text-align: center; background: white; }
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 1.5rem;
            max-width: 960px;
            margin: 0 auto;
        }
        .price-card {
            border: 1.5px solid #e8e8e8;
            border-radius: 16px;
            padding: 2.2rem 2rem;
            position: relative;
            transition: border-color 0.2s, transform 0.2s;
            text-align: left;
        }
        .price-card:hover { border-color: #4cc9f0; transform: translateY(-3px); }
        .price-card.popular {
            border-color: #4cc9f0;
            border-width: 2px;
            box-shadow: 0 4px 24px rgba(76,201,240,0.15);
        }
        .popular-badge {
            position: absolute;
            top: -14px;
            left: 50%;
            transform: translateX(-50%);
            background: #4cc9f0;
            color: #1a1a2e;
            padding: 4px 20px;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 700;
            white-space: nowrap;
        }
        .price-plan { font-size: 0.85rem; font-weight: 700; color: #888; letter-spacing: 0.08em; text-transform: uppercase; margin-bottom: 0.5rem; }
        .price-amount { font-size: 2.8rem; font-weight: 700; color: #1a1a2e; line-height: 1; }
        .price-amount span { font-size: 1rem; color: #999; font-weight: 400; }
        .price-desc { color: #666; font-size: 0.9rem; margin: 0.5rem 0 1.5rem; }
        .price-divider { border: none; border-top: 1px solid #f0f0f0; margin: 1.2rem 0; }
        .price-features { list-style: none; margin-bottom: 2rem; }
        .price-features li {
            padding: 0.45rem 0;
            color: #444;
            font-size: 0.92rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }
        .price-features li::before { content: "✓"; color: #4cc9f0; font-weight: 700; font-size: 1rem; flex-shrink: 0; }
        .btn-plan {
            display: block;
            text-align: center;
            background: #1a1a2e;
            color: white;
            padding: 0.85rem;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.95rem;
            transition: background 0.2s;
        }
        .btn-plan:hover { background: #0f3460; }
        .price-card.popular .btn-plan { background: #4cc9f0; color: #1a1a2e; }
        .price-card.popular .btn-plan:hover { background: #38b2d8; }

        /* ── CONTACT ── */
        .contact { padding: 5.5rem 2rem; background: #f8f9fa; text-align: center; }
        .contact-form {
            max-width: 560px;
            margin: 0 auto;
            text-align: left;
            background: white;
            padding: 2.5rem;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.06);
        }
        .form-group { margin-bottom: 1.3rem; }
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.45rem;
            font-size: 0.92rem;
            color: #1a1a2e;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 1.5px solid #ddd;
            border-radius: 8px;
            font-size: 0.97rem;
            font-family: inherit;
            transition: border-color 0.2s;
            color: #1a1a2e;
            background: #fafafa;
        }
        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #4cc9f0;
            background: white;
        }
        .form-group input.error,
        .form-group textarea.error { border-color: #e63946; background: #fff5f5; }
        .error-msg { color: #e63946; font-size: 0.83rem; margin-top: 0.3rem; display: block; }
        .btn-submit {
            background: #4cc9f0;
            color: #1a1a2e;
            border: none;
            padding: 1rem 2rem;
            border-radius: 10px;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            width: 100%;
            transition: background 0.2s, transform 0.1s;
        }
        .btn-submit:hover { background: #38b2d8; transform: translateY(-1px); }

        /* ── FOOTER ── */
        footer {
            background: #1a1a2e;
            color: #a8b2d8;
            text-align: center;
            padding: 3rem 2rem;
        }
        .footer-logo { color: #fff; font-size: 1.4rem; font-weight: 700; margin-bottom: 1rem; }
        .footer-logo span { color: #4cc9f0; }
        .social-links { margin: 1rem 0; }
        .social-links a {
            color: #a8b2d8;
            text-decoration: none;
            margin: 0 0.8rem;
            font-size: 0.95rem;
            transition: color 0.2s;
        }
        .social-links a:hover { color: #4cc9f0; }
        .footer-copy { font-size: 0.85rem; color: #666; margin-top: 1rem; }

        /* ── RESPONSIVE ── */
        @media (max-width: 640px) {
            header { padding: 1rem 1.5rem; }
            nav a:not(.btn-signup) { display: none; }
            .hero h1 { font-size: 2.1rem; }
            .contact-form { padding: 1.5rem; }
        }
    </style>
</head>
<body>

<!-- ================================================================
     HEADER
     ================================================================ -->
<header>
    <a href="#" class="logo">Quick<span>POS</span></a>
    <nav>
        <a href="#features">Features</a>
        <a href="#pricing">Pricing</a>
        <a href="#contact">Contact</a>
        <a href="#" class="btn-signup">Sign Up Free</a>
    </nav>
</header>

<!-- ================================================================
     HERO SECTION
     ================================================================ -->
<section class="hero">
    <div class="hero-badge">🚀 Trusted by 10,000+ businesses</div>
    <h1>The Smartest <span>Point of Sale</span><br>System for Your Business</h1>
    <p>QuickPOS helps you manage sales, inventory, and customers — all from one beautiful, easy-to-use dashboard.</p>
    <a href="#pricing" class="btn-cta">Get Started Free →</a>
</section>

<!-- ================================================================
     FEATURES SECTION
     ================================================================ -->
<section class="features" id="features">
    <div class="section-label">Why QuickPOS</div>
    <h2>Everything you need to run your business</h2>
    <p class="section-sub">Powerful features packed into a simple, modern interface.</p>

    <div class="features-grid">
        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Lightning Fast Checkout</h3>
            <p>Process payments in under 3 seconds. Keep your queue moving and customers happy.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📊</div>
            <h3>Real-Time Analytics</h3>
            <p>Track sales, revenue, and trends with live dashboards you can access from anywhere.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📦</div>
            <h3>Inventory Management</h3>
            <p>Auto-alerts when stock runs low. Never miss a sale due to empty shelves again.</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🔒</div>
            <h3>Secure Payments</h3>
            <p>PCI-compliant payment processing. Your customers' data is always protected.</p>
        </div>
    </div>
</section>

</body>
</html>
