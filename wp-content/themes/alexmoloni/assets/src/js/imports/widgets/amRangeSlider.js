const widgets = document.querySelectorAll('.am-range-slider');

function updateInputPriceValue(widget, min, max) {

    const unit = widget.dataset.unit;

    if ( widget.matches('.show-dynamic-price-labels') ) {
        const label_price_min = widget.querySelector('.dynamic-label-price-min');
        const label_price_max = widget.querySelector('.dynamic-label-price-max');
        //when moving slider, change the text appearing
        label_price_min.innerHTML = `${min} ${unit}`;
        label_price_max.innerHTML = `${max} ${unit}`;
    }


    const input_price_min = widget.querySelector('input[name="filter_price_min"]');
    const input_price_max = widget.querySelector('input[name="filter_price_max"]');
    //change the values of the input fields
    input_price_min.value = min;
    input_price_max.value = max;

}


function init() {
    for ( let widget of widgets ) {
        const unit = widget.dataset.unit;
        const min = parseInt(widget.dataset.min);
        const max = parseInt(widget.dataset.max);
        const currentMin = parseInt(widget.dataset.currentMin);
        const currentMax = parseInt(widget.dataset.currentMax);
        const slider = widget.querySelector('.price-range');

        noUiSlider.create(slider, {
            start: [currentMin, currentMax],
            connect: true,
            range: {
                'min': min,
                'max': max
            },
            format: {
                to: function (value) {
                    return parseInt(value)
                },
                from: function (value) {
                    return Number(value)
                }
            }
        });

        slider.noUiSlider.on('update', function (values) {
            updateInputPriceValue(widget, values[ 0 ], values[ 1 ]);
        });

        const input_price_min = widget.querySelector('input[name="filter_price_min"]');
        const input_price_max = widget.querySelector('input[name="filter_price_max"]');

        console.log(widget);
        if (widget.matches('.show-interactive-text-inputs')) {
            input_price_min.addEventListener('change', function () {
                slider.noUiSlider.set([this.value, null]);
            });

            input_price_max.addEventListener('change', function () {
                slider.noUiSlider.set([null, this.value]);
            });
        }

    }
}

export default function () {
    init();
}