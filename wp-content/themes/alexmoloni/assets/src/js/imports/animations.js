function parallaxImages() {
    const images = document.querySelectorAll('.js-parallax-image');
    if ( !images ) {
        return;
    }

    for ( let image of images ) {
        gsap.to(image, {
            scrollTrigger: {
                trigger: image,
                start: "10% top",
                end: "100% 50px",
                scrub: true,
            },
            yPercent: 20
        });
    }
}

function initFadeInElements() {
    const elems = gsap.utils.toArray('.js-fade-in-on-scroll');

    elems.forEach((elem, i) => {
        const anim = gsap.fromTo(elem, {autoAlpha: 0, y: 50}, {duration: 1, autoAlpha: 1, y: 0});
        ScrollTrigger.create({
            trigger: elem,
            start: '10% bottom',
            animation: anim,
            toggleActions: 'play none none none',
            once: true,
            onEnter: self => {
                // If it's scrolled past, set the state
                // If it's scrolled to, play it
                self.progress === 1 ? anim.progress(1) : anim.play()
            }
        });
    });
}

export default function () {

    if ( typeof ScrollTrigger !== 'undefined' ) {
        parallaxImages();
        initFadeInElements();
    }
}