<?php
$with_padding          = get_field( 'with_padding' ) ?? false;
$light_grey_background = get_field( 'light_grey_background' ) ?? false;
$align                 = get_field( 'align' ) ?? 'center';
$link                  = get_field( 'link' ) ?? [];
$btn_style             = get_field( 'btn_style' );


?>
<div class="am-btn-row <?= $with_padding ? 'section' : '' ?> text-<?= $align ?> <?=  $light_grey_background ? 'bg-light-grey' : ''?>">
    <div class="container">
        <a class="btn btn-cta-<?= $btn_style['value'] ?>" href="<?= esc_url( $link['url'] ) ?>"><?= $link['title'] ?></a>
    </div>
</div>