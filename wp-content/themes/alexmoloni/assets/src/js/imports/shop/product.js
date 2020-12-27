function handleChangeVariation() {
    const inputs = document.querySelectorAll('.js-change-variation');

    for ( let input of inputs ) {
        input.addEventListener('change', () => {
            const variationPrice = input.dataset.variationPrice;
            const variationId = input.dataset.variationId;
            const priceDiv = input.closest('.col-details')
                                  .querySelector(' .woocommerce-Price-amount bdi').childNodes[ 1 ];
            priceDiv.nodeValue = Number(variationPrice).toFixed(2);
            const buyBtns = document.querySelectorAll('a[data-variation-id]');
            if ( buyBtns.length ) {
                for ( let btn of buyBtns ) {
                    btn.dataset.variationId = variationId;
                }
            }

        })
    }
}

export default function () {
    handleChangeVariation();
}