function initSqueezebox() {
    if ( typeof Squeezebox === 'undefined' ) {
        return;
    }
    const squeezebox = new Squeezebox({
        onOpen: function (wrapper, clickedHeader, content) {
            clickedHeader.classList.add('open');
            content.classList.add('open');
        },
        onClose: function (wrapper, clickedHeader, content) {
            clickedHeader.classList.remove('open')
            content.classList.remove('open')
        }
    });
    squeezebox.init();
}

export default function () {
    initSqueezebox();
}