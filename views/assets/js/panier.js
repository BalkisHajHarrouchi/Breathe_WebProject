// Define the shopping cart object
let shoppingCart = {};

// Function to add a product to the cart
function addToCart(productName, price, quantity) {
  if (productName in shoppingCart) {
    // If the product already exists in the cart, update the quantity
    shoppingCart[productName].quantity += quantity;
  } else {
    // If the product doesn't exist in the cart, add it
    shoppingCart[productName] = {
      price: price,
      quantity: quantity
    };
  }
  
  // Render the shopping cart
  renderCart();
}

// Function to render the shopping cart on the page
function renderCart() {
  let cartElement = document.getElementById('shopping-cart');
  cartElement.innerHTML = '';
  
  for (let productName in shoppingCart) {
    let product = shoppingCart[productName];
    
    // Create an element for the product
    let productElement = document.createElement('div');
    productElement.classList.add('product');
    
    // Add the product name, price, and quantity to the element
    let nameElement = document.createElement('div');
    nameElement.innerText = productName;
    productElement.appendChild(nameElement);
    
    let priceElement = document.createElement('div');
    priceElement.innerText = product.price;
    productElement.appendChild(priceElement);
    
    let quantityElement = document.createElement('div');
    quantityElement.innerText = product.quantity;
    productElement.appendChild(quantityElement);
    
    // Add the product element to the shopping cart element
    cartElement.appendChild(productElement);
  }
}
