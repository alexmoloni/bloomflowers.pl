<div class="am-page-kontakt">
	<?php amShopBreadcrumb(); ?>
    <section class="section section-2">
        <div class="container">
            <div class="cols-wrap">
                <div class="col-left">
                    <img class="logo" src="<?= get_field( 'left_image' )['sizes']['medium'] ?>" alt="<?= get_field( 'left_image' )['alt'] ?>">
                    <h2 class="heading-3 heading"><?= get_field( 'left_heading' ); ?></h2>
                    <div class="text-wrap">
						<?= get_field( 'left_text' ); ?>
                        <p>
                            <a href="tel: <?= get_field( 'phone', 'options' ); ?>"><?= get_field( 'phone', 'options' ); ?></a>
                        </p>
                        <p>
                            <a href="mailto: <?= get_field( 'email', 'options' ); ?>"><?= get_field( 'email', 'options' ); ?></a>
                        </p>

                    </div>

                </div>
                <div class="col-right">
                    <h2 class="heading-2 heading"><?= get_field( 'right_heading' ) ?></h2>
                    <div class="text-wrap"><?= get_field( 'right_text' ); ?></div>
                    <a class="btn-cta-1 btn" href="tel: <?= get_field( 'phone', 'options' ); ?>"><?= get_field( 'text_button_call' ); ?></a>
					<?php amSocialsRow(); ?>
                </div>
            </div>
        </div>
    </section>

    <section class="section-1">
        <div class="container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2444.144400403035!2d21.008466415685245!3d52.22259427975903!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecd6b1fcbae61%3A0x8195f5d12e833849!2sBloom%20Flowers%20in%20Warsaw!5e0!3m2!1sen!2spl!4v1606673133307!5m2!1sen!2spl" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0" style="z-index: 3; position: absolute; height: 100%; width: 100%; padding: 0px; border-width: 0px; margin: 0px; left: 0px; top: 0px; touch-action: pan-x pan-y;"></iframe>
        </div>
    </section>


</div>