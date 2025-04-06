
const LOCALHOSTDIR = "http://localhost/assignment2%20-%20Copy";

var batch = 1;
var search = "";
var gender = "";
var brand = "";

let isLoggedIn = false;

const genders = {
    "men": "M",
    "women": "F",
    "unisex": "U"
};

// ---------------------
// Request To server For display products in Index.html
// ---------------------
async function getProducts(){
    try {
        //CHANGE LOCALHOST LINK BASED ON YOUR FOLDER SCHEMA
        var textreq = `${LOCALHOSTDIR}/server/products.php?batch=${batch}&search=${search}&gender=${gender}&brand=${brand}`;
        const response = await fetch(textreq);
        batch++;
        const productData = await response.json();
        if (productData['status'] == 200){
            for(const product of productData['products']){
                appendProducts(product);
            }
            if(!productData['canRequestNext']){
                document.getElementById('get-more-products').style.display = 'none';
            }
            else{
                document.getElementById('get-more-products').style.display = 'flex';
            }
        }
        else{
            console.error(`Error: ${productData['status']}, ${productData['message']}` );
        }
    } catch (error) {
        console.error('Error: ', error);
    }
}

// ---------------------
// Functions to set Filters and reload Products
//
// Reprocess Server request with value search
// ---------------------
function doSearchFilter(input){
    batch = 1;
    if (input != ""){
        search = input;
        clearProducts();
        getProducts();
    }
    else{
        
        search = "";
        clearProducts();
        getProducts();
    }
}

// ---------------------
// Reprocess Server request with value gender
// ---------------------
function doGenderFilter(input){
    batch = 1;
    if (input != "all"){

        gender = genders[input.toLowerCase()];
        clearProducts();
        getProducts();
    }
    else{
        gender = "";
        clearProducts();
        getProducts();
    }
}
// ---------------------
// Reprocess Server request with value brand
// ---------------------
function doBrandFilter(input){
    batch = 1;
    if (input != "all"){
        brand = input;
        clearProducts();
        getProducts();
    }
    else{
        brand = "";
        clearProducts();
        getProducts();
    }
}
// ---------------------
// Request To server For display products in Index.html
// ---------------------
function clearProducts(){
    $('#product-grid').empty();
}

function appendProducts(data){
    var stars = "";
    for (let i = 0; i < parseInt(data['score']); i++){
        stars += "⭐";
    }

    $(`#product-grid`).append(`<div class="product">
        <a href="product.html?productId=${data['productId']}">
        <img src="${data['linkImage']}" alt="${data['productName']}">
        <p class="product-title">${data['productName']}</p>
        <div class="product-rating">${stars}</div>
        <p class="product-price">From $${data['productPrice']}</p>
      </a>
        <button class="add-to-cart-btn" onclick="addToCart(${data['productId']})">Add to Cart</button>
      </div>`);
}

// ---------------------
// Function to request individual product
// ---------------------
async function getIndividualProduct(){
    // Get the full URL query string (e.g., "?productName=Fragance%1")
    const queryString = window.location.search;

    const urlParams = new URLSearchParams(queryString);

    const product = urlParams.get('productId'); 

    var textreq = `${LOCALHOSTDIR}/server/products.php?productId=${product}`;
    const response = await fetch(textreq);

    const productData = await response.json();

    setProductDetails(productData['product'][0]);
}


// ---------------------
// Sets the format using Server values of individual products in product.html
// ---------------------
function setProductDetails(data){
    var stars = "";
    for (let i = 0; i < parseInt(data['score']); i++){
        stars += "⭐";
    }
    $(`#product-details`).append(`       
        <nav class="breadcrumb">
          Home / Mens Retail Bottles / ${data['productName']}
        </nav>

        <h1 class="product-title">${data['productName']}</h1>
        <p class="price">$${parseFloat(data['productPrice']).toFixed(2)}</p>
        <p class="installments">or 4 interest-free payments of $${(parseFloat(data['productPrice']) / 4).toFixed(2)} with <strong>Afterpay</strong></p>

        <div class="rating">${stars}  reviews</div>

        <div class="price-box">
          <label>PRICE</label>
          <p class="main-price">$${parseFloat(data['productPrice']).toFixed(2)}</p>
        </div>

        <div class="quantity-cart">
          <div class="quantity-selector">
            <button>-</button>
            <input type="text" value="1" readonly>
            <button>+</button>
          </div>
          <button class="add-to-cart" onclick="addToCart(${data['productId']})>ADD TO CART</button>
        </div>

        <div class="authenticity">
          <p><strong>✅ 100% Authentic</strong><br>Every decant and full-size bottle we offer is genuine, sourced directly from trusted fragrance suppliers.</p>
        </div>

        <div class="description">
          <h3>Description</h3>
          <p>
          ${data['productDescription']}
          </p>

        </div>`);
        $(`#product-image`).append(`<img src="${data['linkImage']}" alt="Jean Paul Gaultier Le Male Elixir Parfum" />`);
        //TODO remove event listeners for addtocart buttons
}


// ---------------------
// Handles processing to sign up once login.handleSignUp() method is called and verifies integrity of values in client side. 
// Even if this function can be called without login.handleSignUp() verification, Server contains internal verifications which
// will be shown both in console and form.
// ---------------------
async function proceedSignUp(myname, myemail, mypassword, mypassword2){
    console.log(mypassword2);
    var textreq = `${LOCALHOSTDIR}/server/register.php`;

        const response = await fetch(textreq, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                'name' : myname,
                'email': myemail,
                'password': mypassword,
                'passwordTwo': mypassword2
            })
        });
    let data = response.json();
    var result = await data;
    console.log(result);
    try {
        
        if (!response.ok) {
            throw new Error(data.error?.message || 'Registration failed');
        }
        
        if (result.success) {
            window.location.replace('login.html');
        }
        else{
            throw new Error(data.error?.message || 'Registration failed');
        }
    } catch (e) {
        var error = (result.type + ": " + result.message);
        console.error('Bad request: ' + error);
        $("#submit-group").append(`<p class="error-handling">*${error}</p>`);
    }
        
} 


async function proceedLogin(myemail, mypassword){
    var textreq = `${LOCALHOSTDIR}/server/login.php`;

    const response = await fetch(textreq, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            'email': myemail,
            'password': mypassword,
        })
    });
    let data = response.json();


    var result = await data;
    
    try {     
        if (!response.ok) {
            throw new Error(data.error?.message || 'Registration failed');
        }
        
        if (result.success) {
            window.location.replace('index.html');
        }
        else if (result.redirect){
            window.location.replace('index.html');
        }
        else{
            throw new Error(data.error?.message || 'Registration failed');
        }
    } catch (e) {
        var error = (result.type + ": " + result.message);
        console.error('Bad request: ' + error);
        $("#submit-group").append(`<p class="error-handling">*${error}</p>`);
    }

}

// ---------------------
// Sets user functionalities starting by defining whether user is logged in or not
// ---------------------
async function isLogged(source){
   
    var textreq = `${LOCALHOSTDIR}/server/userFunctionalities.php?isLogged=`;
    const response = await fetch(textreq);
    const Logged = await response.json();

    isLoggedIn = Logged['isLogged'];
    if(source.localeCompare('index')){
        getUserForSession();
    }
    
    
    if(isLoggedIn)getCartItems(source);
}

async function getUserForSession(){
    if (isLoggedIn){  
        var textreq = `${LOCALHOSTDIR}/server/userFunctionalities.php?getName=`;
        const response = await fetch(textreq);
        const productData = await response.json();
        $('#usernameDisplay').append(productData['username']);
        $('#login-logoutButton').append('Logout');
    }
    else{
        $('#usernameDisplay').append('Guest');
        $('#login-logoutButton').append('Login!');
    }
}

async function buttonForLog(){
    if (isLoggedIn){
        var textreq = `${LOCALHOSTDIR}/server/userFunctionalities.php?logout=`;
        const response = await fetch(textreq);
        const productData = await response.json();
        if (productData['isNotLogged']){
            window.location.replace('index.html');
        }
        else{
            console.error(productData['error']);
        }
    }
    else{
        window.location.replace('login.html');
    }
}

async function addToCart(itemId){
    if(isLoggedIn){
        var textreq = `${LOCALHOSTDIR}/server/userFunctionalities.php?addCart=${itemId}`;
        const response = await fetch(textreq);
        const successReq = await response.json();
        if (!successReq['success']){
            console.error(successReq['error']);
        }
        getCartItems('index');
    }
    else{
        window.location.replace('signup.html');
    }
}

async function removeItemCart(itemId){
    if(isLoggedIn){
        var textreq = `${LOCALHOSTDIR}/server/userFunctionalities.php?removeCart=${itemId}`;
        const response = await fetch(textreq);
        const successReq = await response.json();
        if (!successReq['success']){
            console.error(successReq['error']);
        }
    }
    else{
        window.location.replace('signup.html');
    }
}

async function getCartItems(source){

    var textreq = `${LOCALHOSTDIR}/server/userFunctionalities.php?getCartItems=`;
    const response = await fetch(textreq);
    const successReq = await response.json();
    if(successReq['success']){
        $('#cartCount').empty();
        $('#items-container-cart').empty();
        let itemFeatures = successReq['cartItems'];
        $('#cartCount').append(itemFeatures.length);
        
        if(source.localeCompare("index") == 0) setCartItemsIndex(itemFeatures);
        if(source.localeCompare("bag") == 0) setCartItemsMyBag(itemFeatures);
    }
    
}

function setCartItemsIndex(itemFeatures){
    $('#items-container-cart').empty();
    itemFeatures.forEach((item, index) => {
        $('#items-container-cart').append(`            
            <div class="mini-cart-item">
              <div class="mini-cart-product">
                <img src="${item.linkImage}" alt="${item.productName}" class="mini-cart-img">
                <div class="mini-cart-info">
                  <p>${item.productName}</p>
                  <p>${item.productPrice}</p>
                  <p>Qty: ${item.quantity}</p>
                </div>
                <button class="remove-btn" onclick="removeItemCart(${item.wishId})">&times;</button>
              </div>
            </div>`);
    });
    $('#cartSubtotal').empty();
    if ($('#items-container-cart').text() == ''){
        $('#cartSubtotal').append('CAD $0.00');
    }
    else{
        getTotal();
    }
}

function setCartItemsMyBag(itemFeatures){
    $('#products-box').empty();
    itemFeatures.forEach((item, index) => {
        $('#products-box').append(`            
            <div class="order-item" style="display: flex; justify-content: space-between; margin-bottom: 10px;">
            <span>${item.quantity} ${item.productName}</span>
            <span>$${item.productPrice}</span>
          </div>`);
    });
    $('#cartSubtotal').empty();
    if ($('#products-box').text() == ''){
        $('#cartSubtotal').append('$0.00');
    }
    else{
        
        
        getTotal();
    }
}

async function proceedCheckout(source){
    if(isLoggedIn){
    var textreq = `${LOCALHOSTDIR}/server/userFunctionalities.php?checkout=`;
    const response = await fetch(textreq);
    const successReq = await response.json();
    if (!successReq['success']){
        console.error(successReq['error']);
    }
    getCartItems(source);
    }
    else{
        window.location.replace('signup.html');
    }   
}

async function getTotal(){
    if(isLoggedIn){
    var textreq = `${LOCALHOSTDIR}/server/userFunctionalities.php?getTotal=`;
    const response = await fetch(textreq);
    const successReq = await response.json();
    
        if (!successReq['success']){
            console.error(successReq['error']);
        }
        else{
            
            $('#cartSubtotal').append('CAD $' + successReq['total'][0]['total']);
        }
        
        
    }
    else{
        window.location.replace('signup.html');
    }   
}