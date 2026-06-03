<?php
include 'header.php';
?>

<section class="hero-section">
    <div class="swiper heroSwiper">
        <div class="swiper-wrapper">
            <div class="swiper-slide hero-slide">
                <img src="https://images.unsplash.com/photo-1600861195091-690c92f1d2cc?w=1600&auto=format&fit=crop&q=80" alt="Gaming Rig">
                <div class="hero-overlay"></div>
                <div class="hero-content text-center">
                    <span class="badge bg-purple px-3 py-2 mb-3 text-uppercase tracking-wider">New Arrivals</span>
                    <h1 class="display-3 fw-extrabold text-white mb-3">FORGE YOUR ULTIMATE BATTLESTATION</h1>
                    <p class="lead text-muted mb-4 fs-4 max-w-2xl mx-auto">Discover next-generation graphics cards, high-performance CPUs, and elite cooling systems tailored for hardcore gamers.</p>
                    <a href="#marketplace" class="btn hero-btn btn-lg px-5 py-3 text-uppercase fw-bold">Explore Marketplace <i class="bi bi-arrow-right ms-2"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<main id="marketplace" class="py-5 bg-darker border-top border-secondary border-opacity-10">
    <div class="container-fluid px-md-5">
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-4 mb-5 border-bottom border-secondary border-opacity-10 pb-4">
            <div>
                <h2 class="fw-bold text-white mb-1 tracking-tight">Available Inventory</h2>
                <p class="text-muted small mb-0">Browse and configure high-performance components backed by our system gateway matching filters.</p>
            </div>
            <div class="search-wrapper">
                <i class="bi bi-search search-icon text-muted"></i>
                <input type="text" id="searchInput" class="form-control search-input bg-transparent text-white border-secondary" placeholder="Search components, categories, specs...">
            </div>
        </div>

        <div id="market-grid" class="market-grid">
            <div class="text-center py-5 my-5 w-100 grid-loader">
                <div class="spinner-border text-purple" role="status">
                    <span class="visually-hidden">Loading components...</span>
                </div>
                <p class="text-muted mt-3 small tracking-wide">Connecting to inventory gateway matrix...</p>
            </div>
        </div>

    </div>
</main>

<div id="cartOverlay" class="cart-overlay"></div>
<aside id="cartSidebar" class="cart-sidebar">
    <div class="cart-header border-bottom border-secondary border-opacity-10">
        <div class="d-flex align-items-center gap-2">
            <i class="bi bi-cpu-fill text-purple fs-4"></i>
            <h4 class="fw-bold text-white mb-0 tracking-tight">Your Custom Build</h4>
        </div>
        <button id=\"closeCart\" class="close-cart-btn btn text-muted p-1 hover-white">
            <i class="bi bi-x-lg fs-5"></i>
        </button>
    </div>

    <div id="cartSidebarItems" class="cart-body flex-grow-1">
        </div>

    <div class="cart-footer border-top border-secondary border-opacity-10 bg-darker p-4">
        <button id="clearCartBtn" class="btn btn-outline-danger w-100 text-uppercase fw-bold py-2 small tracking-wide mb-2">
            <i class="bi bi-trash3 me-2"></i> Clear Entire Configuration
        </button>
    </div>
</aside>

<?php
// Include footer components layout wrapper 
include 'footer.php';
?>