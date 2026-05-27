<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechForge | Premium PC Marketplace</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Swiper -->
    <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- TOP MINI BAR -->
<div class="topbar">
    <div class="container d-flex justify-content-between">
        <div>
            <small>Premium Gaming Hardware Store</small>
        </div>

        <div class="d-flex gap-3">
            <a href="#">Login</a>
            <a href="#">Register</a>
            <a href="#">Support</a>
        </div>
    </div>
</div>

<!-- MAIN NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark main-navbar sticky-top">
    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand d-flex align-items-center" href="#">
            <i class="bi bi-cpu-fill logo-icon"></i>
            <span class="logo-text">TechForge</span>
        </a>

        <!-- MOBILE -->
        <button class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navMenu">

            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navMenu">

            <!-- SEARCH -->
            <form class="search-box mx-auto">
                <input type="text"
                id="searchInput"
                placeholder="Search components...">

                <button type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>

            <!-- NAV ITEMS -->
            <ul class="navbar-nav ms-auto align-items-center gap-3">

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Shop
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#">
                        News
                    </a>
                </li>

                <!-- CART -->
                <li class="nav-item">
                    <button id="cartBtn"
                    class="cart-button">

                        <i class="bi bi-cart3"></i>

                        <span id="cart-count">0</span>
                    </button>
                </li>

            </ul>
        </div>
    </div>
</nav>

<!-- CATEGORY BAR -->
<section class="category-bar">
    <div class="container">

        <div class="categories">

            <div class="category-item">
                <i class="bi bi-gpu-card"></i>
                <span>GPU</span>
            </div>

            <div class="category-item">
                <i class="bi bi-cpu"></i>
                <span>CPU</span>
            </div>

            <div class="category-item">
                <i class="bi bi-memory"></i>
                <span>RAM</span>
            </div>

            <div class="category-item">
                <i class="bi bi-device-ssd"></i>
                <span>SSD</span>
            </div>

            <div class="category-item">
                <i class="bi bi-pc-display"></i>
                <span>Monitor</span>
            </div>

            <div class="category-item">
                <i class="bi bi-controller"></i>
                <span>Gaming</span>
            </div>

        </div>
    </div>
</section>