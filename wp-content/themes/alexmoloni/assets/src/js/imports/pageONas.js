const $ = jQuery.noConflict();

export default function () {
    if ( !document.body.matches('.page-template-page_o-nas') ) {
        return;
    }

    const numbers = document.querySelectorAll('.boxes-wrap .number');
    const durations = [1500, 2200, 2200];

    let waypoints = $('.section-2').waypoint({
        handler: function (direction) {
            startAnimations();

            this.destroy();
        },
        offset: function () {
            return this.context.innerHeight() - this.element.clientHeight + 100
        }
    })


    function startAnimations() {
        let i = 0;
        /**
         * @var Node number
         */
        for ( let number of numbers ) {
            number.classList.add('visible');
            const finalVal = parseInt(number.dataset.number);
            let intervalDur = durations[ i ] / finalVal;
            if ( i > 0 ) {
                intervalDur = durations[ i ] * 0.1;
            }
            let currentValue = 0;
            let increment = 1;
            if ( i > 0 ) {
                increment = Math.floor(finalVal * 0.1);
            }
            if ( i < numbers.length ) {
                const timeOut = setTimeout(() => {
                    const int = setInterval(() => {
                        currentValue += increment;
                        if ( currentValue > finalVal ) {
                            number.innerHTML = finalVal;
                            clearInterval(int);
                        }
                        else {
                            number.innerHTML = currentValue;
                        }

                    }, intervalDur);

                }, 1)
                i++;
            }

        }
    }

}

