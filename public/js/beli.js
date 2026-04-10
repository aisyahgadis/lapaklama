const searchInput = document.getElementById("searchInput");
const categoryFilter = document.getElementById("categoryFilter");
const minPriceInput = document.getElementById("minPrice");
const maxPriceInput = document.getElementById("maxPrice");

const products = document.querySelectorAll(".product-card");
function filterProducts(){

let search = document.getElementById("searchInput").value.toLowerCase();
let category = document.getElementById("categoryFilter").value;

const products = document.querySelectorAll(".product-card");

products.forEach(product => {

let name = product.innerText.toLowerCase();
let productCategory = product.dataset.category;
let productPrice = parseInt(product.dataset.price);

let matchSearch = name.includes(search);
let matchCategory = category === "all" || productCategory === category;
let matchPrice = productPrice >= minPrice && productPrice <= maxPrice;

if(matchSearch && matchCategory && matchPrice){
product.style.display = "block";
}else{
product.style.display = "none";
}

});

}

/* EVENT */

searchInput?.addEventListener("keyup", filterProducts);
categoryFilter?.addEventListener("change", filterProducts);
minPriceInput?.addEventListener("input", filterProducts);
maxPriceInput?.addEventListener("input", filterProducts);
let minPrice = 0;
let maxPrice = Infinity;

function togglePriceCard(){

let card = document.getElementById("priceCard");

card.style.display = (card.style.display === "block") ? "none" : "block";

}

/* APPLY FILTER */

function applyPrice(){

let minInput = document.getElementById("minPrice");
let maxInput = document.getElementById("maxPrice");

/* VALIDASI */

minPrice = Math.max(0, parseInt(minInput.value) || 0);
maxPrice = Math.max(0, parseInt(maxInput.value) || Infinity);

filterProducts();

/* tutup card */
document.getElementById("priceCard").style.display = "none";

}