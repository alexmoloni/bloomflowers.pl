const $ = jQuery.noConflict();

function revealText() {
    function showTextClick() {
        const type = $(this).attr('data-type');
        let hidden_text = $(this).attr('data-hidden-text');
        const hidden_text_trimmed = hidden_text.replace(/\s/g, '');
        if ( type === 'phone' ) {
            $(this).html('<a href="tel:' + hidden_text_trimmed + '">' + hidden_text + '</a>');
        }
        else if ( type === 'email' ) {
            $(this).html('<a href="mailto:' + hidden_text_trimmed + '">' + hidden_text + '</a>');
        } else {
            $(this).html(hidden_text);
        }

        $(this).off('click', showTextClick);
    }

    $('.js-reveal-text').on('click', showTextClick);
}

export default function () {
    revealText();
}