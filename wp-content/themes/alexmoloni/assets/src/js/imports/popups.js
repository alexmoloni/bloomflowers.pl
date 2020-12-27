function microModalSet() {
    return typeof MicroModal !== 'undefined';
}

function init() {
    if ( microModalSet() ) {
        MicroModal.init();
    }
}

function showPopup(id) {
    if ( microModalSet() ) {
        MicroModal.show(id);
    }
}

function closePopup(id) {
    if ( microModalSet() ) {
        MicroModal.close(id);
    }
}

export default {
    init,
    showPopup,
    closePopup
}