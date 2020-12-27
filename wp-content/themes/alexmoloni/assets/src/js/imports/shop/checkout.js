function handleNoAddress() {
    const input = document.querySelector('input#no_address');
    input.addEventListener('change', (ev) => {
        const fields = document.querySelectorAll(' #shipping_city_field, #shipping_address_1_field, #shipping_address_2_field, #shipping_state_field');

        if ( input.checked ) {
            for ( let field of fields ) {
                field.style.display = 'none';
                field.querySelector('input').value = '';
            }
        }
        else {
            for ( let field of fields ) {
                field.style.display = 'block';
            }
        }
    });
}

function handleCopyBillingDetails() {
    const btn = document.querySelector('#copy-buyer-details');
    btn.addEventListener('click', (ev) => {
        ev.preventDefault();
        const billingName = document.querySelector('#billing_first_name').value;
        const billingSurname = document.querySelector('#billing_last_name').value;
        const billingPhone = document.querySelector('#billing_phone').value;

        const shippingName = document.querySelector('#shipping_first_name');
        const shippingSurname = document.querySelector('#shipping_last_name');
        const shippingPhone = document.querySelector('#shipping_phone');

        shippingName.value = billingName;
        shippingSurname.value = billingSurname;
        shippingPhone.value = billingPhone;


    });

}

export default function () {
    if ( !document.body.matches('.woocommerce-checkout ') ) {
        return;
    }
    handleNoAddress();
    handleCopyBillingDetails();
}