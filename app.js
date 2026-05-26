if(document.querySelector(".heroSwiper")){

    let heroSwiper = new Swiper(".heroSwiper",{

        loop:true,

        autoplay:{
            delay:4000
        },

        pagination:{
            el:".swiper-pagination"
        }

    });

}

// =========================
// CART SIDEBAR
// =========================

const cartBtn =
document.getElementById("cartBtn");

const cartSidebar =
document.getElementById("cartSidebar");

const cartOverlay =
document.getElementById("cartOverlay");

const closeCart =
document.getElementById("closeCart");

// OPEN

if(cartBtn && cartSidebar && cartOverlay){

    cartBtn.onclick = () => {

        cartSidebar.classList.add("active");

        cartOverlay.classList.add("active");
    };
}

// CLOSE BUTTON

if(closeCart && cartSidebar && cartOverlay){

    closeCart.onclick = () => {

        cartSidebar.classList.remove("active");

        cartOverlay.classList.remove("active");
    };
}

// CLICK OUTSIDE

if(cartOverlay && cartSidebar){

    cartOverlay.onclick = () => {

        cartSidebar.classList.remove("active");

        cartOverlay.classList.remove("active");
    };
}

// =========================
// ESC KEY CLOSE
// =========================

document.addEventListener("keydown", e => {

    if(e.key === "Escape"){

        if(cartSidebar && cartOverlay){

            cartSidebar.classList.remove("active");

            cartOverlay.classList.remove("active");
        }
    }
});

// =========================
// SMOOTH BUTTON HOVER
// =========================

document
.querySelectorAll(
    ".hero-btn, .add-cart-btn"
)

.forEach(button => {

    button.addEventListener("mouseenter", () => {

        button.style.transform =
        "translateY(-3px)";
    });

    button.addEventListener("mouseleave", () => {

        button.style.transform =
        "translateY(0px)";
    });

});