function append(elem) {
    const loader = document.createElement('div');
    loader.classList.add('am-loader');
    elem.classList.add('loading');
    const style = document.createElement('style');
    style.setAttribute('scoped', '');
    elem.appendChild(loader);


}

function remove(elem) {
    const loader = elem.querySelector('.am-loader');
    const styleEl = elem.querySelector('style');
    if ( loader ) {
        elem.removeChild(loader);
    }
    if ( styleEl ) {
        elem.removeChild(styleEl);
    }
}

export default {
    append,
    remove
}