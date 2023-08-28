// Start Header > Buttons 

// Start Button toggle-menu
let btnToggleMenu = document.querySelector(".toggle-menu");
let links = document.querySelector('.links');

btnToggleMenu.addEventListener('click', e => {
    if(btnToggleMenu.classList.contains("fa-bars")){
        links.style.opacity = 1;
        links.style.zIndex = 99;
    }
    else{
        links.style.opacity = 0;
        links.style.zIndex = -99;
    }
    btnToggleMenu.classList.toggle('fa-bars');
    btnToggleMenu.classList.toggle('fa-remove');
})
// End Button toggle-menu
// Start Button Menu
let btnMenu = document.querySelector(".menu-list");
let btnCloseMenu = document.querySelector('.close');
let listItems = document.querySelector('.list-items');

btnMenu.addEventListener('click', e => {
        listItems.style.opacity = 1;
        listItems.style.zIndex = 99;
})
btnCloseMenu.addEventListener('click', e => {
        listItems.style.opacity = 0;
        listItems.style.zIndex = -99;
})
listItems.querySelectorAll('li').forEach(element => {
    element.addEventListener('click', e => btnCloseMenu.click())
});
// End Button Menu

let logo = document.querySelector(".container .logo img");
logo.addEventListener("click", () =>{
    logo.parentElement.querySelector("a").click();
})
// End Header > Buttons 

// Cart
let _cart = document.querySelector("header .cart-shopping");
_cart.addEventListener("click", () => {
    let cart_page = document.querySelector(".cart");
    if(cart_page.classList.contains("hide")){
        cart_page.classList.remove("hide");
        cart_page.classList.add("close");
        document.body.classList.remove("hide");
    } else{
        cart_page.classList.remove("close");
        cart_page.classList.add("hide");
        document.body.classList.add("hide");
    }      
})

let boxes = document.querySelectorAll("section .box");
boxes.forEach(b => {
    let add_cart = b.querySelector(".btn-add");
    add_cart.addEventListener("click", e => {
        if(!add_cart.classList.contains("click")){
            add_cart.classList.add("click")
            add_cart.innerHTML += '<i style="margin-right: 10px;" class="fa-solid fa-check"></i>'
            let view_cart = document.createElement('button');
            view_cart.classList.add("view-cart");
            view_cart.innerText = "عرض السلة";
            add_cart.parentElement.appendChild(view_cart);
            view_cart.addEventListener("click", c =>{
                let cart_page = document.querySelector(".cart");
                cart_page.classList.remove("close");
                cart_page.classList.add("hide");
                document.body.classList.add("hide");
            })
        }
    })
})
let add_cart = document.querySelector(".product .request .add-cart")
if(add_cart != null)
    add_cart.addEventListener("click", () => {
        if(!add_cart.classList.contains("click")){
            add_cart.classList.add("click")
            add_cart.innerHTML += '<i style="margin-right: 10px;" class="fa-solid fa-check"></i>'
        }
    })
let close_cart = document.querySelector(".cart .cart-content .head-cart .cart-close");
close_cart.addEventListener("click", () => {
    let cart_page = document.querySelector(".cart");
    cart_page.classList.remove("hide");
    cart_page.classList.add("close");
    document.body.classList.remove("hide");
})

// Click Box
boxes.forEach(box => {
    box.addEventListener("click", e => {
        let button = box.querySelector(".btn-add")
        let cart = box.querySelector(".view-cart")
        if(e.target != button && e.target != cart){
            let link = box.querySelector(".title a")
            link.click();
        }
    })
})

// Add To Cart

let cart = document.querySelector(".cart .products-cart")
let product_content = document.querySelectorAll("section .box")
// Empty Array Prodcuts
let arrayOfProducts = [];
// Check If Local Storage Empty
if(localStorage.getItem("products")){
    arrayOfProducts = JSON.parse(localStorage.getItem("products"))
}
// Get Data From Local Storage
getDataFromLocalStorage();

product_content.forEach(box => {
    let submit = box.querySelector(".btn-add")
    submit.onclick = function () {
        addProductToArray(box);
        // submit.setAttribute("href")
    }
})

cart.addEventListener("click", e => {
    if(e.target.classList.contains("remove-product")){
        let id = e.target.parentElement.parentElement.getAttribute("data-id")
        removeProduct(id)
        e.target.parentElement.parentElement.remove();
    }
})

function addProductToArray(box){
    let a_link = box.querySelector(".title a")
    let a_href = a_link.getAttribute("href").toString()
    let id = a_href.substring(a_href.indexOf("=")+1)
    let title = box.querySelector(".title a").innerText
    let price = box.querySelector(".prices span").innerText
    let img_src = box.querySelector(".image img").getAttribute("src")

    const product = {
        id: id,
        title: title,
        price: price,
        quantity: 1,
        src: img_src
    }

    // // Check Product Is Found
    // if(!isFound(id)){
        
    // } else {
    //     changeQuantity()
    // }
    
    // Add Product To Array
    arrayOfProducts.push(product)
    // Add Product To cart
    addElementsToCart(arrayOfProducts)
    // Add Product To LocalStorage
    addProductToLocalStorage(arrayOfProducts)
}

function addElementsToCart(array){
    cart.innerHTML = ""
    array.forEach(data => {
        let product = document.createElement("div");
        product.classList.add("product")
        product.setAttribute("data-id", data.id)
        // Block 1
        let image_product = document.createElement("div");
        image_product.classList.add("image-product")
        let img = document.createElement("img")
        img.setAttribute("src", data.src)
        image_product.appendChild(img)
        // Block 2
        let info_product = document.createElement("div")
        info_product.classList.add("info-product")
        let info_text = document.createElement("div")
        info_text.classList.add("info-text")
        let title_prod = document.createElement("div")
        title_prod.classList.add("title-prod")
        title_prod.innerText = data.title
        let price = document.createElement("div")
        price.classList.add("price")
        price.innerText = data.price
        info_text.appendChild(title_prod)
        info_text.appendChild(price)
        // Block 3
        let details = document.createElement("p")
        details.classList.add("details")
        details.innerText = ""
        // Boclk 4
        let input = document.createElement("input")
        input.classList.add("count")
        input.setAttribute("type", "number")
        input.value = data.quantity
        // Block 5
        let remove_product = document.createElement("div")
        remove_product.classList.add("remove-product")
        remove_product.innerText = "حذف"

        info_product.appendChild(info_text)
        info_product.appendChild(details)
        info_product.appendChild(input)
        info_product.appendChild(remove_product)

        product.appendChild(image_product)
        product.appendChild(info_product)
        
        cart.appendChild(product)
    })
    
}

function addProductToLocalStorage(array){
    window.localStorage.setItem("products", JSON.stringify(array))
}

function getDataFromLocalStorage(){
    let data = window.localStorage.getItem("products")
    if(data){
        let products = JSON.parse(data)
        addElementsToCart(products)
    }
}

function removeProduct(id){
    arrayOfProducts = arrayOfProducts.filter( product => product.id != id)
    addProductToLocalStorage(arrayOfProducts)
}

// function isFound(id){
//     let id_product = arrayOfProducts.find(product => product.id == id)
//     if(id_product == id){
//         return true
//     } 
//     return false
// }

















