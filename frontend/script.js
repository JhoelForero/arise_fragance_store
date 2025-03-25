'use strict';

// ---------------------
// MOBILE MENU
// ---------------------
const mobileMenuOpenBtn = document.querySelectorAll('[data-mobile-menu-open-btn]');
const mobileMenu = document.querySelectorAll('[data-mobile-menu]');
const mobileMenuCloseBtn = document.querySelectorAll('[data-mobile-menu-close-btn]');
const overlay = document.querySelector('[data-overlay]');

for (let i = 0; i < mobileMenuOpenBtn.length; i++) {
  const mobileMenuCloseFunc = function () {
    mobileMenu[i].classList.remove('active');
    overlay.classList.remove('active');
  };

  mobileMenuOpenBtn[i].addEventListener('click', function () {
    mobileMenu[i].classList.add('active');
    overlay.classList.add('active');
  });

  mobileMenuCloseBtn[i].addEventListener('click', mobileMenuCloseFunc);
  overlay.addEventListener('click', mobileMenuCloseFunc);
}

// ---------------------
// ACCORDION
// ---------------------
const accordionBtn = document.querySelectorAll('[data-accordion-btn]');
const accordion = document.querySelectorAll('[data-accordion]');

for (let i = 0; i < accordionBtn.length; i++) {
  accordionBtn[i].addEventListener('click', function () {
    const clickedBtn = this.nextElementSibling.classList.contains('active');

    for (let j = 0; j < accordion.length; j++) {
      if (clickedBtn) break;

      if (accordion[j].classList.contains('active')) {
        accordion[j].classList.remove('active');
        accordionBtn[j].classList.remove('active');
      }
    }

    this.nextElementSibling.classList.toggle('active');
    this.classList.toggle('active');
  });
}

// ---------------------
// FILTERS & SEARCH
// ---------------------
document.addEventListener("DOMContentLoaded", () => {
  const genderFilter = document.getElementById("availabilityFilter");
  const brandFilter = document.getElementById("brandFilter");
  const searchInput = document.getElementById("searchInput");

  if (genderFilter && brandFilter && searchInput) {
    genderFilter.addEventListener("change", filterProducts);
    brandFilter.addEventListener("change", filterProducts);
    searchInput.addEventListener("keyup", filterProducts);
  }

  filterProducts(); // initial run to show all
});

function filterProducts() {
  const selectedGender = document.getElementById("availabilityFilter").value;
  const selectedBrand = document.getElementById("brandFilter").value;
  const searchTerm = document.getElementById("searchInput").value.toLowerCase();
  const products = document.querySelectorAll(".product");

  products.forEach(product => {
    const productGender = product.getAttribute("data-gender");
    const productBrand = product.getAttribute("data-brand");
    const productTitle = product.querySelector(".product-title").textContent.toLowerCase();

    const genderMatch = selectedGender === "all" || productGender === selectedGender;
    const brandMatch = selectedBrand === "all" || productBrand === selectedBrand;
    const searchMatch = productTitle.includes(searchTerm);

    product.style.display = (genderMatch && brandMatch && searchMatch) ? "block" : "none";
  });
}

// -----------------------------
// CART FUNCTIONALITY + STORAGE
// -----------------------------
let cart = JSON.parse(localStorage.getItem("cart")) || [];

document.addEventListener("DOMContentLoaded", () => {
  // Add to Cart
  document.querySelectorAll(".add-to-cart-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const productEl = btn.closest(".product");
      const title = productEl.querySelector(".product-title").textContent.trim();
      const price = productEl.querySelector(".product-price").textContent.trim();
      const imgSrc = productEl.querySelector("img").src;

      const existing = cart.find((item) => item.title === title);

      if (existing) {
        existing.quantity++;
      } else {
        cart.push({ title, price, imgSrc, quantity: 1 });
      }

      localStorage.setItem("cart", JSON.stringify(cart));
      updateMiniCart();
    });
  });

  updateMiniCart(); // Load cart items
});

// ------------------------
// MINI CART UI UPDATE
// ------------------------
function updateMiniCart() {
  const cartItemsContainer = document.getElementById("miniCartItems");
  const cartSubtotal = document.getElementById("cartSubtotal");
  const cartCount = document.querySelector(".count");

  cartItemsContainer.innerHTML = "";

  let total = 0;
  let count = 0;

  cart.forEach((item, index) => {
    const itemEl = document.createElement("div");
    itemEl.classList.add("mini-cart-item");
    itemEl.innerHTML = `
      <div class="mini-cart-product">
        <img src="${item.imgSrc}" alt="${item.title}" class="mini-cart-img">
        <div class="mini-cart-info">
          <p>${item.title}</p>
          <p>${item.price}</p>
          <p>Qty: ${item.quantity}</p>
        </div>
        <button class="remove-btn" data-index="${index}">&times;</button>
      </div>
    `;
    cartItemsContainer.appendChild(itemEl);

    const priceValue = parseFloat(item.price.replace(/[^0-9.]/g, ""));
    total += priceValue * item.quantity;
    count += item.quantity;
  });

  cartSubtotal.textContent = total.toFixed(2);
  if (cartCount) cartCount.textContent = count;

  document.querySelectorAll(".remove-btn").forEach((btn) => {
    btn.addEventListener("click", () => {
      const index = btn.getAttribute("data-index");
      cart.splice(index, 1);
      localStorage.setItem("cart", JSON.stringify(cart));
      updateMiniCart();
    });
  });
}

// ---------------------
// MINI CART DESKTOP HOVER
// ---------------------
const cartIcon = document.getElementById("cartIcon");
const miniCart = document.getElementById("miniCart");

if (cartIcon && miniCart) {
  cartIcon.addEventListener("mouseenter", () => {
    miniCart.style.display = "block";
  });

  cartIcon.addEventListener("mouseleave", () => {
    setTimeout(() => {
      if (!miniCart.matches(":hover")) {
        miniCart.style.display = "none";
      }
    }, 300);
  });

  miniCart.addEventListener("mouseleave", () => {
    miniCart.style.display = "none";
  });
}

// ------------------------
// PROCEED TO CART PAGE
// ------------------------
document.querySelector(".view-cart-btn").addEventListener("click", () => {
  window.location.href = "/mybag.html";
});

document.querySelector(".checkout-btn").addEventListener("click", () => {
  window.location.href = "/mybag.html";
});

// ------------------------
// USER DROPDOWN DESKTOP
// ------------------------
const userIcon = document.querySelector(".header-user-actions button:nth-child(1)");
const userDropdown = document.getElementById("userDropdown");

if (userIcon && userDropdown) {
  userIcon.addEventListener("mouseenter", () => {
    userDropdown.style.display = "block";
  });

  userIcon.addEventListener("mouseleave", () => {
    setTimeout(() => {
      if (!userDropdown.matches(":hover")) {
        userDropdown.style.display = "none";
      }
    }, 300);
  });

  userDropdown.addEventListener("mouseleave", () => {
    userDropdown.style.display = "none";
  });
}

// ------------------------
// MOBILE NAVIGATION LOGIC
// ------------------------
document.getElementById("mobileHomeBtn").addEventListener("click", () => {
  window.scrollTo({ top: 0, behavior: "smooth" });
});

document.getElementById("mobileSearchBtn").addEventListener("click", () => {
  const searchInput = document.getElementById("searchInput");
  if (searchInput) {
    searchInput.scrollIntoView({ behavior: "smooth" });
    searchInput.focus();
  }
});

// ✅ Replaced hover logic with click toggles for mobile buttons
document.getElementById("mobileUserBtn").addEventListener("click", () => {
  const dropdown = document.getElementById("userDropdown");
  dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
});

document.getElementById("mobileCartBtn").addEventListener("click", () => {
  const cart = document.getElementById("miniCart");
  cart.style.display = cart.style.display === "block" ? "none" : "block";
});
