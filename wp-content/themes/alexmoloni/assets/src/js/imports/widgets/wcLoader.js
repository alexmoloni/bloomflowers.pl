function add(parentEl) {
    const loader = document.createElement('div');
    loader.classList.add('blockUI', 'blockOverlay');
    const style = document.createElement('style');
    style.innerHTML = `
     .blockUI.blockOverlay {      
            z-index: 1000;
            border: none;
            margin: 0px;
            padding: 0px;
            width: 100%;
            height: 100%;
            top: 0px;
            left: 0px;
            background: rgb(255, 255, 255);
            opacity: 0.6;
            cursor: default;
    }
    `;
    loader.style.position = 'absolute';
    loader.appendChild(style);
    parentEl.appendChild(loader);
    const parentStyles = window.getComputedStyle(parentEl);
    if ( parentStyles.getPropertyValue('position') === 'static' ) {
        parentEl.style.position = 'relative';
    }
}
function remove(parentEl) {
    const loader = parentEl.querySelector('.blockUI.blockOverlay');
    parentEl.removeChild(loader);
}

export default {
    add,
    remove
}