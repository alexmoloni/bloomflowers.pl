import loader from "./amLoader";
import cart from "../shop/cart";

let cartKey = null;

function handleAddToCart() {

    document.body.addEventListener('click', function (ev) {
        if ( !ev.target.matches('.js-ajax-add-to-cart') ) {
            return;
        }
        ev.preventDefault();
        const items = [];
        const btn = ev.target;
        const isBuyNowBtn = btn.matches('.js-buy-now-btn');
        btn.classList.add('loading');
        loader.append(ev.target);
        const mainProd = {};
        const productId = btn.dataset.productId;
        if ( !productId ) {
            return;
        }
        mainProd.productId = productId;
        let quantity = 1;
        if ( typeof btn.dataset.quantity !== 'undefined' ) {
            const dataQuantity = parseInt(btn.dataset.quantity);
            if ( !isNaN(dataQuantity) && dataQuantity > 0 ) {
                quantity = dataQuantity;
            }
        }
        mainProd.quantity = quantity;
        const isVariable = typeof btn.dataset.variationId !== 'undefined' && btn.dataset.variationId.length > 1;
        let variationId = null;
        if ( isVariable ) {
            variationId = btn.dataset.variationId;
            mainProd.variationId = variationId;
        }
        const productCardTextarea = document.querySelector('#product-card');
        let cartItemData = null;
        if ( productCardTextarea && productCardTextarea.value.length > 1 ) {
            cartItemData = {
                'product_card_text': productCardTextarea.value
            }
            mainProd.cartItemData = cartItemData;
        }


        items.push(mainProd);

        const hasCompProducts = !!document.querySelector('.am-complementary-products');
        const compProductsIds = [];
        if ( hasCompProducts ) {
            const compInputs = document.querySelectorAll('input[name=comp_item]');
            for ( let input of compInputs ) {
                if ( input.checked ) {
                    compProductsIds.push(input.value)
                }
            }
        }

        for ( let compProdId of compProductsIds ) {
            items.push({
                productId: compProdId,
                quantity: 1
            });
        }

        cart.addToCart(items).then(resp => {
            let miniCartHtml = ''
            if ( typeof resp.mini_cart_html !== 'undefined' ) {
                miniCartHtml = resp.mini_cart_html;
            }
            let cartCount = '';
            if ( typeof resp.cart_count !== 'undefined' ) {
                cartCount = resp.cart_count;
            }
            btn.classList.remove('loading');
            loader.remove(btn);
            btn.closest('.am-cart-btn').classList.add('item-added-to-cart');
            if ( isBuyNowBtn ) {
                let checkoutUrl = btn.dataset.checkoutUrl || '/koszyk';
                window.location = checkoutUrl;
                return;
            }
            cart.populateMiniCart(miniCartHtml);
            cart.updateCartTotals(cartCount, false);
        });


    })
}

function handleRemoveFromCart() {
    document.body.addEventListener('click', function (ev) {
        if ( !ev.target.matches('.js-ajax-remove-from-cart') ) {
            return;
        }
        ev.preventDefault();
        const btn = ev.target;
        const miniCartWrap= document.querySelector('.mini-cart-wrap');
        miniCartWrap.classList.add('loading');
        const prodId = btn.dataset.prodId;
        cart.removeFromCart(prodId).then(() => {
            miniCartWrap.classList.remove('loading');
        });

    });
}

function init() {
    handleAddToCart();
    handleRemoveFromCart();
}

export default function () {
    init();
}