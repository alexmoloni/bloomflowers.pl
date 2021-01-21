const inputs = document.querySelectorAll('.js-change-variation');

function updatePriceDiv(price, regularPrice = false, onSale = false) {
    const priceDiv = document.querySelector('.col-details .price .woocommerce-Price-amount bdi').childNodes[ 1 ];
    priceDiv.nodeValue = Number(price).toFixed(2);
    const regularPriceWrap = document.querySelector('.col-details .regular-price');

    if ( regularPriceWrap && regularPrice ) {

        const regularPriceDiv = regularPriceWrap.querySelector('.woocommerce-Price-amount bdi').childNodes[ 1 ];
        if ( onSale ) {
            regularPriceWrap.classList.remove('hidden');
            regularPriceDiv.nodeValue = Number(regularPrice).toFixed(2);
        }
        else {
            regularPriceWrap.classList.add('hidden');
        }

    }
}

function updateBuyBtns(newVariationId) {
    const buyBtns = document.querySelectorAll('a[data-variation-id]');
    if ( buyBtns.length ) {
        for ( let btn of buyBtns ) {
            btn.dataset.variationId = newVariationId;
        }
    }
}

function handleChangeVariation() {
    if ( !inputs ) {
        return;
    }

    for ( let input of inputs ) {
        input.addEventListener('change', () => {
            const variationPrice = input.dataset.variationPrice;
            let onSale = false;
            if ( typeof input.dataset.onSale !== 'undefined' && input.dataset.onSale === '1' ) {
                onSale = true;
            }
            const variationId = input.dataset.variationId;
            const variationRegularPrice = input.dataset.variationRegularPrice;

            updatePriceDiv(variationPrice, variationRegularPrice, onSale);
            updateBuyBtns(variationId);
        })
    }
}

function initVariationPrice() {
    if ( inputs.length < 1 || !inputs ) {
        return;
    }
    const inputChecked = Array.from(inputs).find((input) => {
        return input.checked;
    });

    const variationPrice = inputChecked.dataset.variationPrice;
    const variationId = inputChecked.dataset.variationId;
    let onSale = false;
    if ( typeof inputChecked.dataset.onSale !== 'undefined' && inputChecked.dataset.onSale === '1' ) {
        onSale = true;
    }
    const variationRegularPrice = inputChecked.dataset.variationRegularPrice;
    updatePriceDiv(variationPrice, variationRegularPrice, onSale);
    updateBuyBtns(variationId);

}

export default function () {
    handleChangeVariation();
    initVariationPrice();
}