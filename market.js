document.addEventListener("DOMContentLoaded", () => {

    // LOCAL STORAGE CART DATA RETRIEVAL
    let pcCart =
        JSON.parse(
            localStorage.getItem("forge_cart")
        ) || [];

    let allProducts = [];

    refreshCartBadge();
    renderCartSidebar();

    // FETCH PRODUCTS FROM BACKEND CONNECT MATRIX
    fetch("get_products.php")
        .then(res => {
            if (!res.ok) {
                throw new Error("Database connection dropped.");
            }
            return res.json();
        })
        .then(products => {
            if (products.error) {
                throw new Error(products.error);
            }
            allProducts = products;
            renderInventory(products);
        })
        .catch(err => {
            console.error(err);
            const grid = document.getElementById("market-grid");
            if (grid) {
                grid.innerHTML = `
                <div class="error-box text-center py-5">
                    <i class="bi bi-exclamation-triangle fs-1 text-danger"></i>
                    <h3 class="text-white mt-2">System Error</h3>
                    <p class="text-muted">${err.message}</p>
                </div>
                `;
            }
        });

    // RENDER PRODUCTS GRID ENVIRONMENT
    function renderInventory(products) {
        const grid = document.getElementById("market-grid");
        if (!grid) return;
        grid.innerHTML = "";

        products.forEach(item => {
            const card = document.createElement("div");
            card.className = "component-card";

            card.addEventListener("mouseenter", () => {
                card.style.backgroundColor = `rgb(6, 182, 212)`;
                card.style.borderColor = `rgb(31, 135, 153)`;
                card.style.transform = `translateY(-4px)`;
                card.style.boxShadow = `0 0 20px rgba(6, 182, 212, .5)`;
            });

            card.addEventListener("mouseleave", () => {
                card.style.backgroundColor = `linear-gradient(to right, rgba(10, 15, 25, .95), rgba(5, 7, 13, .95))`;
                card.style.borderColor = `1px solid rgba(255, 255, 255, .06)`;
            });

            // MANAGE COMPONENT INVENTORY AND OUT OF STOCK TRIGGERS
            const currentQty = parseInt(item.quantity);
            const isOutOfStock = currentQty <= 0;
            const stockLabel = isOutOfStock ? "● Out of Stock" : `● In Stock (${currentQty})`;
            const stockColor = isOutOfStock ? "#ef4444" : "#22c55e";

            card.innerHTML = `
            <div class="product-image">
                <img src="${item.image}" alt="${item.name}">
            </div>
            <div class="product-content">
                <span class="product-category">${item.category}</span>
                <h3 class="product-title">${item.name}</h3>
                <p class="product-desc">${item.description || "Premium gaming hardware."}</p>
                <div>
                    <span class="price">€${parseFloat(item.price).toFixed(2)}</span>
                    <span class="stock" style="color: ${stockColor}; font-weight: 600;">
                        ${stockLabel}
                    </span>
                </div>
            </div>
            <button 
                class="add-cart-btn" 
                data-id="${item.id}"
                ${isOutOfStock ? "disabled style='background: #3f3f46; border-color: #27272a; cursor: not-allowed;'" : ""}
            >
                <i class="bi ${isOutOfStock ? "bi-x-circle" : "bi-cart-plus"}"></i>
                ${isOutOfStock ? "Out of Stock" : "Add to Cart"}
            </button>
            `;

            grid.appendChild(card);
        });

        activateButtons();
    }

    // BUTTON CLICK INTERACTION MATRIX (ADD ACTION GATEWAY)
    function activateButtons() {
        document.querySelectorAll(".add-cart-btn").forEach(btn => {
            btn.addEventListener("click", e => {
                const id = parseInt(e.currentTarget.dataset.id);

                // Run connection to decrease quantity on MySQL table first
                fetch(`add_to_cart.php?id=${id}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            addToCart(id);

                            btn.innerHTML = `<i class="bi bi-check2"></i> Added`;
                            btn.style.background = "#22c55e";

                            // Live synchronization of local variable arrays without page resets
                            const targetProduct = allProducts.find(p => p.id == id);
                            if (targetProduct) {
                                targetProduct.quantity = data.new_quantity;
                            }
                            renderInventory(allProducts);
                        } else {
                            alert(data.message || "Failed to reserve inventory.");
                        }
                    })
                    .catch(err => console.error("Gateway transmission mismatch error:", err));
            });
        });
    }

    // INTEGRATE DATA OBJECT INTO CART
    function addToCart(id) {
        const product = allProducts.find(p => p.id == id);
        if (!product) return;

        const existing = pcCart.find(item => item.id == id);
        if (existing) {
            existing.quantity++;
        } else {
            pcCart.push({
                id: product.id,
                name: product.name,
                price: parseFloat(product.price),
                image: product.image,
                quantity: 1
            });
        }
        updateCart();
    }
// UPDATE CART STORAGE STATE
    function updateCart() {
        localStorage.setItem(
            "forge_cart",
            JSON.stringify(pcCart)
        );

        refreshCartBadge();
        renderCartSidebar();
    }

    // REFRESH SELECTION BADGE COUNTER
    function refreshCartBadge() {
        const badge = document.getElementById("cart-count");
        if (!badge) return;

        const total = pcCart.reduce((sum, item) => {
            return sum + item.quantity;
        }, 0);

        badge.innerText = total;
    }

    // RENDER CART FLYOUT DRAWER (UPDATED TARGET INTERFACE MATCH)
    function renderCartSidebar() {
        // Pointing directly to our corrected ID container inside index.php
        const container = document.getElementById("cartSidebarItems");
        if (!container) return;
        container.innerHTML = "";

        if (pcCart.length === 0) {
            container.innerHTML = `
            <div class="empty-cart text-center py-5">
                <i class="bi bi-cart-x fs-1 text-muted d-block mb-2"></i>
                <p class="text-muted small">Your configuration is empty.</p>
            </div>
            `;
            return;
        }

        let totalPrice = 0;

        pcCart.forEach(item => {
            totalPrice += item.price * item.quantity;

            const div = document.createElement("div");
            div.className = "cart-item";

            div.innerHTML = `
            <img src="${item.image}" alt="${item.name}">
            <div class="cart-item-info">
                <h6>${item.name}</h6>
                <p>
                    €${item.price.toFixed(2)}
                    × ${item.quantity}
                </p>
            </div>
            <button 
                class="remove-btn" 
                data-id="${item.id}"
                data-qty="${item.quantity}"
            >
                <i class="bi bi-trash"></i>
            </button>
            `;

            container.appendChild(div);
        });

        // GENERATE TOTAL CALCULATION VIEW BLOCK
        const totalDiv = document.createElement("div");
        totalDiv.className = "cart-total mt-3 pt-3 border-top border-secondary border-opacity-10";

        totalDiv.innerHTML = `
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="text-muted mb-0 small text-uppercase">Est. Total:</h5>
            <h4 class="text-purple mb-0 fw-bold">€${totalPrice.toFixed(2)}</h4>
        </div>
        <button class="checkout-btn btn btn-purple w-100 text-uppercase fw-bold py-2 small tracking-wide">
            Proceed To Checkout
        </button>
        `;

        container.appendChild(totalDiv);
        activateRemoveButtons();
    }

    // TRASH ICON DETECTORS
    function activateRemoveButtons() {
        document.querySelectorAll(".remove-btn").forEach(btn => {
            btn.addEventListener("click", e => {
                const id = parseInt(e.currentTarget.dataset.id);
                const qty = parseInt(e.currentTarget.dataset.qty);
                removeFromCart(id, qty);
            });
        });
    }

    // DISPATCH SINGLE PROD SELECTION RESTORATION
    function removeFromCart(id, qty) {
        // Send removal command to add inventory quantity back into MySQL
        fetch(`remove_from_cart.php?id=${id}&qty=${qty}`)
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    pcCart = pcCart.filter(item => item.id != id);
                    updateCart();

                    // Sync interface array state cache instantly
                    const targetProduct = allProducts.find(p => p.id == id);
                    if (targetProduct) {
                        targetProduct.quantity = data.new_quantity;
                    }
                    renderInventory(allProducts);
                } else {
                    alert(data.message || "Could not remove item selection.");
                }
            })
            .catch(err => console.error("Gateway removal failure match error:", err));
    }

    // DYNAMIC PARALLEL CART FLUSH & RESTORE ENGINE
    const clearBtn = document.getElementById("clearCartBtn");
    if (clearBtn) {
        clearBtn.addEventListener("click", () => {
            if (pcCart.length === 0) return;

            // Cache items to process asynchronous restorations
            const itemsToRestore = [...pcCart];

            // Wipe frontend trackers immediately to keep interface snappiness high
            pcCart = [];
            updateCart();

            // Fire parallel network operations safely to reset database counts
            const restorationPromises = itemsToRestore.map(item => {
                return fetch(`remove_from_cart.php?id=${item.id}&qty=${item.quantity}`)
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const targetProduct = allProducts.find(p => p.id == item.id);
                            if (targetProduct) {
                                targetProduct.quantity = data.new_quantity;
                            }
                        }
                    })
                    .catch(err => console.error(`Error restoring stock on component ${item.id}:`, err));
            });

            // Re-render viewport layout safely when all processing operations complete
            Promise.all(restorationPromises).then(() => {
                renderInventory(allProducts);
            });
        });
    }

    // FILTERS - INVENTORY SEARCH LOGIC
    const searchInput = document.getElementById("searchInput");
    if (searchInput) {
        searchInput.addEventListener("input", e => {
            const value = e.target.value.toLowerCase();
            const filtered = allProducts.filter(product => {
                return (
                    product.name.toLowerCase().includes(value) ||
                    product.category.toLowerCase().includes(value)
                );
            });
            renderInventory(filtered);
        });
    }

    // FILTERS - UPPER BAR CATEGORY SELECTORS
    document.querySelectorAll(".category-item").forEach(category => {
        category.addEventListener("click", () => {
            const categoryName = category.querySelector("span").innerText.trim().toLowerCase();
            const filtered = allProducts.filter(product => {
                return product.category.toLowerCase().includes(categoryName);
            });
            renderInventory(filtered);
        });
    });
});