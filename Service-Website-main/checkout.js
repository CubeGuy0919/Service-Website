document.addEventListener("DOMContentLoaded", () => {

    const cart =
        JSON.parse(
            localStorage.getItem("forge_cart")
        ) || [];

    const container =
        document.getElementById("checkoutItems");

    const subtotalText =
        document.getElementById("subtotalPrice");

    const totalText =
        document.getElementById("totalPrice");

    let subtotal = 0;

    if(cart.length === 0){

        container.innerHTML = `

        <div class="empty-cart-checkout">

            <i class="bi bi-cart-x"></i>

            <p>Your cart is empty.</p>

        </div>

        `;

        return;
    }

    cart.forEach(item => {

        subtotal +=
            item.price * item.quantity;

        const div =
            document.createElement("div");

        div.className =
            "checkout-item";

        div.innerHTML = `

        <img src="${item.image}">

        <div class="checkout-item-info">

            <h5>${item.name}</h5>

            <p>
                Quantity: ${item.quantity}
            </p>

        </div>

        <span>
            €${(item.price * item.quantity).toFixed(2)}
        </span>

        `;

        container.appendChild(div);
    });

    subtotalText.innerText =
        `€${subtotal.toFixed(2)}`;

    const finalTotal =
        subtotal + 9.99;

    totalText.innerText =
        `€${finalTotal.toFixed(2)}`;

    // ORDER BUTTON

    const orderBtn = document.getElementById("placeOrderBtn");

    orderBtn.addEventListener("click", () => {
        if (cart.length === 0) return;

        // Küldjük el a kosár tartalmát a szervernek
        fetch("place_order.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ cart: cart })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                alert("Order placed successfully! Stock updated.");
                localStorage.removeItem("forge_cart");
                window.location.href = "index.php";
            } else {
                // Ha pl. időközben elfogyott a termék
                alert("Error: " + data.message);
            }
        })
        .catch(err => {
            console.error("Hiba a rendelés során:", err);
            alert("Rendszerhiba történt a rendelés feldolgozásakor.");
        });
    });
});
