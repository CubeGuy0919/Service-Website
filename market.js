document.addEventListener("DOMContentLoaded", () => {

    // LOCAL STORAGE CART

    let pcCart =
        JSON.parse(
            localStorage.getItem("forge_cart")
        ) || [];

    let allProducts = [];

    refreshCartBadge();

    renderCartSidebar();

    // FETCH PRODUCTS

    fetch("get_products.php")

        .then(res => {

            if (!res.ok) {

                throw new Error(
                    "Database connection failed."
                );
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

            const grid =
                document.getElementById("market-grid");

            if (grid) {

                grid.innerHTML = `

        <div class="error-box">

            <i class="bi bi-exclamation-triangle"></i>

            <h3>System Error</h3>

            <p>${err.message}</p>

        </div>

        `;
            }
        });

    // RENDER PRODUCTS

    function renderInventory(products) {

        const grid =
            document.getElementById("market-grid");

        if (!grid) return;

        grid.innerHTML = "";

        products.forEach(item => {

            const card =
                document.createElement("div");

            card.className =
                "component-card";

            card.addEventListener("mouseenter", () => {
                card.style.backgroundColor = `rgb(6, 182, 212)`;
                card.style.borderColor = `rgb(31, 135, 153)`;
                card.transform = `translateY(-4px)`;
                card.boxShadow = `0 0 20px rgba(6, 182, 212, .5)`;
            });

            card.addEventListener("mouseleave", () => {
                card.style.backgroundColor = `linear-gradient(to right, rgba(10, 15, 25, .95), rgba(5, 7, 13, .95))`;
                card.style.borderColor = `1px solid rgba(255, 255, 255, .06)`;
            });

            card.innerHTML = `

            <div class="product-image">

                <img
                    src="${item.image}"
                    alt="${item.name}"
                >

            </div>

            <div class="product-content">

                <span class="product-category">
                    ${item.category}
                </span>

                <h3 class="product-title">
                    ${item.name}
                </h3>

                <p class="product-desc">
                    ${item.description ||
                "Premium gaming hardware."
                }
                </p>

                <div>

                    <span class="price">
                        €${parseFloat(item.price).toFixed(2)}
                    </span>

                    <span class="stock">
                        ● ${item.stock_status || "In Stock"}                    </span>

                </div>

            </div>

            <button
                class="add-cart-btn"
                data-id="${item.id}"
            >

                <i class="bi bi-cart-plus"></i>

                Add to Cart

            </button>

            `;

            grid.appendChild(card);

        });

        activateButtons();
    }

    // BUTTON EVENTS

    function activateButtons() {

        document
            .querySelectorAll(".add-cart-btn")

            .forEach(btn => {

                btn.addEventListener("click", e => {

                    const id =
                        parseInt(
                            e.currentTarget.dataset.id
                        );

                    addToCart(id);

                    // BUTTON EFFECT

                    btn.innerHTML = `
                    <i class="bi bi-check2"></i>
                    Added
                `;

                    btn.style.background =
                        "#22c55e";

                    setTimeout(() => {

                        btn.innerHTML = `
                        <i class="bi bi-cart-plus"></i>
                        Add to Cart
                    `;

                        btn.style.background =
                            "#06b6d4";

                    }, 1200);

                });
            });
    }

    // ADD TO CART

    function addToCart(id) {

        const product =
            allProducts.find(p => p.id == id);

        if (!product) return;

        const existing =
            pcCart.find(item => item.id == id);

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

    // UPDATE CART

    function updateCart() {

        localStorage.setItem(

            "forge_cart",

            JSON.stringify(pcCart)
        );

        refreshCartBadge();

        renderCartSidebar();
    }

    // BADGE

    function refreshCartBadge() {

        const badge =
            document.getElementById("cart-count");

        if (!badge) return;

        const total =
            pcCart.reduce((sum, item) => {

                return sum + item.quantity;

            }, 0);

        badge.innerText = total;
    }

    // SIDEBAR

    function renderCartSidebar() {

        const container =
            document.getElementById("category-item");

        if (!container) return;

        container.innerHTML = "";

        if (pcCart.length === 0) {

            container.innerHTML = `

            <div class="empty-cart">

                <i class="bi bi-cart-x"></i>

                <p>Your cart is empty.</p>

            </div>

            `;

            return;
        }

        let totalPrice = 0;

        pcCart.forEach(item => {

            totalPrice +=
                item.price * item.quantity;

            const div =
                document.createElement("div");

            div.className =
                "cart-item";

            div.innerHTML = `

            <img src="${item.image}">

            <div class="cart-item-info">

                <h6>${item.name}</h6>

                <p>

                    €${item.price}
                    × ${item.quantity}

                </p>

            </div>

            <button
                class="remove-btn"
                data-id="${item.id}"
            >

                <i class="bi bi-trash"></i>

            </button>

            `;

            container.appendChild(div);

        });

        // TOTAL

        const totalDiv =
            document.createElement("div");

        totalDiv.className =
            "cart-total";

        totalDiv.innerHTML = `

        <h5>Total:</h5>

        <h4>€${totalPrice.toFixed(2)}</h4>

        <button class="checkout-btn">

            Checkout

        </button>

        `;

        container.appendChild(totalDiv);

        activateRemoveButtons();
    }

    // REMOVE

    function activateRemoveButtons() {

        document
            .querySelectorAll(".remove-btn")

            .forEach(btn => {

                btn.addEventListener("click", e => {

                    const id =
                        parseInt(
                            e.currentTarget.dataset.id
                        );

                    removeFromCart(id);
                });
            });
    }

    function removeFromCart(id) {

        pcCart =
            pcCart.filter(item => item.id != id);

        updateCart();
    }

    // CLEAR CART

    const clearBtn =
        document.getElementById("clearCartBtn");

    if (clearBtn) {

        clearBtn.addEventListener("click", () => {

            pcCart = [];

            updateCart();
        });
    }

    // SEARCH ENGINE

    const searchInput =
        document.getElementById("searchInput");

    if (searchInput) {

        searchInput.addEventListener("input", e => {

            const value =
                e.target.value.toLowerCase();

            const filtered =
                allProducts.filter(product => {

                    return (

                        product.name
                            .toLowerCase()
                            .includes(value)


                        ||

                        product.category
                            .toLowerCase()
                            .includes(value)
                    );
                });

            renderInventory(filtered);
        });
    }

    // CATEGORY FILTERS

    document
        .querySelectorAll(".component-card")

        .forEach(category => {

            category.addEventListener("click", () => {

                const categoryName =
                    category.innerText
                        .trim()
                        .toLowerCase();

                const filtered =
                    allProducts.filter(product => {

                        return product.category
                            .toLowerCase()
                            .includes(categoryName);
                    });

                renderInventory(filtered);
            });
        });

});