function handleSelectProduct() {
    const compInputs = document.querySelectorAll('.comp-input');
    if ( !compInputs.length ) {
        return;
    }

    const cartBtns = document.querySelectorAll('.js-ajax-add-to-cart');
    if ( !cartBtns.length ) {
        return;
    }

    for ( let input of compInputs ) {
        input.addEventListener('change', (ev) => {
            const compProdId = input.dataset.prodId;
            let compProducts = [];
            for ( let btn of cartBtns ) {
                let compProducts = btn.dataset.compProducts;
                if ( compProducts ) {
                    compProducts = compProducts.split(",");
                }
                else {
                }
            }

            if ( input.checked ) {
                compProducts.push(compProdId);
                // btn.dataset.compProducts = compProducts.join(",");

            }
            else {

            }
        });
    }


}

function init() {
    // handleSelectProduct();
}

export default function () {
    init();
}