<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechForge | Premium PC Marketplace</title>

    <!-- BOOTSTRAP -->
    <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet">

    <!-- BOOTSTRAP ICONS -->
    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- GOOGLE FONT -->
    <link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
    rel="stylesheet">

    <!-- CUSTOM CSS -->
    <link
    rel="stylesheet"
    href="style.css">
</head>

<body>

<!-- CART OVERLAY -->
<div id="cartOverlay" class="cart-overlay"></div>

<!-- CART SIDEBAR -->
<div id="cartSidebar" class="cart-sidebar">

    <div class="cart-header">

        <h3>Your Cart</h3>

        <button id="closeCart">
            <i class="bi bi-x-lg"></i>
        </button>

    </div>

    <div id="category-item" class="cart-items">

    </div>

</div>

<!-- TOP BAR -->
<div class="topbar">

    <div class="container-fluid topbar-content">

        <div class="top-left">

            <span>
                <i class="bi bi-truck"></i>
                Free shipping on orders over $99
            </span>

            <span>
                <i class="bi bi-headset"></i>
                24/7 Customer Support
            </span>

        </div>

        <div class="top-right">

            <a href="#">Login</a>

            <a href="#">Register</a>

            <a href="#">Support</a>

            <a href="#">Track Order</a>

        </div>

    </div>

</div>

<!-- NAVBAR -->

<header class="main-navbar">

    <div class="container-fluid nav-content">

        <!-- LOGO -->

        <div class="logo-area">

            <div class="logo-box">
                TF
            </div>

            <h2>TechForge</h2>

        </div>

        <!-- MENU -->

        <nav class="desktop-menu">

            <a href="#">GPU</a>
            <a href="#">CPU</a>
            <a href="#">RAM</a>
            <a href="#">SSD</a>
            <a href="#">Monitor</a>
            <a href="#">Gaming</a>
            <a href="#">Motherboard</a>

        </nav>

        <!-- SEARCH -->

        <div class="search-box">

            <input
            type="text"
            id="searchInput"
            placeholder="Search components...">

            <button>

                <i class="bi bi-search"></i>

            </button>

        </div>

        <!-- ACTIONS -->

        <div class="nav-actions">

            <a href="#">Shop</a>

            <a href="#">News</a>

            <button
            id="cartBtn"
            class="cart-btn">

                <i class="bi bi-cart3"></i>

                <span id="cart-count">0</span>

            </button>

        </div>

    </div>

</header>

<!-- HERO SECTION -->

<section class="hero-section">

    <div class="hero-content">

        <div class="hero-text">

            <span>
                PREMIUM PERFORMANCE
            </span>

            <h1>
                Build Your Dream Setup
            </h1>

            <p>
                Premium components for enthusiasts.
                <br>
                Power. Performance. Perfection.
            </p>

            <button class="hero-btn">

                Explore Now

                <i class="bi bi-arrow-right"></i>

            </button>

        </div>

    </div>

</section>

<!-- ========================= -->
<!-- PRODUCTS -->
<!-- ========================= -->

<section class="market-section">

    <div class="section-header">

        <div>

            <h2>
                Trending Components
            </h2>

            <p>
                Most popular hardware right now.
            </p>

        </div>

        <button
        id="clearCartBtn"
        class="clear-cart-btn">

            <i class="bi bi-trash"></i>

            Clear Cart

        </button>

    </div>

    <!-- DYNAMIC PRODUCTS -->

    <div id="market-grid"></div>

</section>

<!-- ========================= -->
<!-- FOOTER -->
<!-- ========================= -->

<footer class="main-footer">

    <div class="footer-grid">

        <!-- BRAND -->

        <div>

            <div class="footer-logo">

                <div class="logo-box">
                    TF
                </div>

                <h2>TechForge</h2>

            </div>

            <p>

                Your ultimate destination
                for premium PC components
                and gaming hardware.

                Build better.
                Game stronger.

            </p>

            <div class="socials">

                <i class="bi bi-facebook"></i>

                <i class="bi bi-instagram"></i>

                <i class="bi bi-twitter-x"></i>

                <i class="bi bi-youtube"></i>

                <i class="bi bi-discord"></i>

            </div>

        </div>

        <!-- SHOP -->

        <div>

            <h4>SHOP</h4>

            <a href="#">
                All Products
            </a>

            <a href="#">
                Graphics Cards
            </a>

            <a href="#">
                Processors
            </a>

            <a href="#">
                Motherboards
            </a>

            <a href="#">
                RAM
            </a>

            <a href="#">
                Storage
            </a>

        </div>

        <!-- CUSTOMER -->

        <div>

            <h4>CUSTOMER CARE</h4>

            <a href="#">
                Contact Us
            </a>

            <a href="#">
                Shipping Policy
            </a>

            <a href="#">
                Returns & Refunds
            </a>

            <a href="#">
                Warranty
            </a>

            <a href="#">
                FAQs
            </a>

        </div>

        <!-- COMPANY -->

        <div>

            <h4>COMPANY</h4>

            <a href="#">
                About Us
            </a>

            <a href="#">
                Careers
            </a>

            <a href="#">
                Newsroom
            </a>

            <a href="#">
                Terms of Service
            </a>

            <a href="#">
                Privacy Policy
            </a>

        </div>

        <!-- NEWSLETTER -->

        <div>

            <h4>NEWSLETTER</h4>

            <p>
                Get the latest updates,
                deals and announcements.
            </p>

            <div class="newsletter-box">

                <input
                type="email"
                placeholder="Your email address">

                <button>

                    <i class="bi bi-send-fill"></i>

                </button>

            </div>

        </div>

    </div>

    <!-- FOOTER BOTTOM -->

    <div class="footer-bottom">

        <p>
            © 2026 TechForge.
            All rights reserved.
        </p>

        <div class="payments">

            <span>VISA</span>

            <span>MasterCard</span>

            <span>PayPal</span>

            <span>Apple Pay</span>

        </div>

    </div>

</footer>

<!-- JS -->
<script src="app.js"></script>

<script src="market.js"></script>

</body>

</html>