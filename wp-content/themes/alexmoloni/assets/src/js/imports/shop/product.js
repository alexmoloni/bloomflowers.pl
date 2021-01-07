const inputs = document.querySelectorAll('.js-change-variation');

function updatePriceDiv(price) {
    const priceDiv = document.querySelector('.col-details .woocommerce-Price-amount bdi').childNodes[ 1 ];
    priceDiv.nodeValue = Number(price).toFixed(2);
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
            const variationId = input.dataset.variationId;
            updatePriceDiv(variationPrice);
            updateBuyBtns(variationId);
        })
    }
}

function initVariationPrice() {
    if ( !inputs ) {
        return;
    }
    const inputChecked = Array.from(inputs).find((input) => {
        return input.checked;
    });

    const variationPrice = inputChecked.dataset.variationPrice;
    const variationId = inputChecked.dataset.variationId;
    updatePriceDiv(variationPrice);
    updateBuyBtns(variationId);

}

export default function () {
    handleChangeVariation();
    initVariationPrice();
}