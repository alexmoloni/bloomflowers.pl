import wpRestApi from "../wpRestApi";

/**
 *
 * @param items Array of Objects containing: productId, quantity, variationId, cartItemData
 * @returns {Promise<*>}
 */
function addToCart(items) {
    items = JSON.stringify(items);
    const formData = new FormData;
    formData.append('items', items);
    formData.append('action', 'am_add_to_cart');

    // formData.append('nonce', wpRest.nonce);
    return wpRestApi.post('', formData).then(resp => {
        return resp.data;
    });
}

function removeFromCart(prodId, quantity = 1) {
    const formData = new FormData;
    formData.append('prodId', prodId);
    formData.append('quantity', toString(quantity));
    formData.append('action', 'am_remove_cart');
    formData.append('nonce', wpRest.nonce);

    return wpRestApi.post('', formData).then(resp => {
        if ( typeof resp.data[ 'mini_cart_html' ] !== 'undefined' ) {
            const miniCartHtml = resp.data[ 'mini_cart_html' ];
            populateMiniCart(miniCartHtml);
        }
        if ( typeof resp.data[ 'cart_count' ] !== 'undefined' ) {
            const cartCount = resp.data[ 'cart_count' ];
            updateCartTotals(cartCount);
        }
    });
}

function refreshCartDivs() {
    const formData = new FormData;
    formData.append('action', 'am_refresh_cart_divs');
    formData.append('nonce', wpRest.nonce);
    wpRestApi.post('', formData).then(resp => {
        if ( typeof resp.data[ 'mini_cart_html' ] !== 'undefined' ) {
            const miniCartHtml = resp.data[ 'mini_cart_html' ];
            populateMiniCart(miniCartHtml);
        }
        if ( typeof resp.data[ 'cart_count' ] !== 'undefined' ) {
            const cartCount = resp.data[ 'cart_count' ];
            updateCartTotals(cartCount);
        }

    })
}

function populateMiniCart(miniCartHtml) {
    const amMiniCart = document.querySelector('.am-mini-cart');
    const parent = amMiniCart.parentElement;
    parent.innerHTML = miniCartHtml;
}

function updateCartTotals(updatedCount) {
    document.querySelectorAll('.cart-total-items').forEach(elem => {
        elem.innerHTML = '' + updatedCount;
        elem.classList.remove('animated');
        setTimeout(() => {
            elem.classList.add('animated');
        }, 10);
    })


}

export default {
    addToCart,
    updateCartTotals,
    populateMiniCart,
    refreshCartDivs,
    removeFromCart
}