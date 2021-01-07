<?php
/**
 * Email Styles
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-styles.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 4.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Load colors.
$bg        = get_option( 'woocommerce_email_background_color' );
$body      = get_option( 'woocommerce_email_body_background_color' );
$base      = get_option( 'woocommerce_email_base_color' );
$base_text = wc_light_or_dark( $base, '#202020', '#ffffff' );
$text      = get_option( 'woocommerce_email_text_color' );

// Pick a contrasting color for links.
$link_color = wc_hex_is_light( $base ) ? $base : $base_text;

if ( wc_hex_is_light( $body ) ) {
	$link_color = wc_hex_is_light( $base ) ? $base_text : $base;
}

$bg_darker_10    = wc_hex_darker( $bg, 10 );
$body_darker_10  = wc_hex_darker( $body, 10 );
$base_lighter_20 = wc_hex_lighter( $base, 20 );
$base_lighter_40 = wc_hex_lighter( $base, 40 );
$text_lighter_20 = wc_hex_lighter( $text, 20 );
$text_lighter_40 = wc_hex_lighter( $text, 40 );

// !important; is a gmail hack to prevent styles being stripped if it doesn't like something.
// body{padding: 0;} ensures proper scale/positioning of the email in the iOS native email app.
?>
    body {
    padding: 0;
    font-family: "Open Sans", Helvetica, Roboto, Arial, sans-serif;
    font-size: 16px;
    }

    #wrapper {
    background-color: <?php echo esc_attr( $bg ); ?>;
    margin: 0;
    padding: 70px 0;
    -webkit-text-size-adjust: none !important;
    width: 100%;
    }

    #template_container {
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1) !important;
    background-color: <?php echo esc_attr( $body ); ?>;
    border: 1px solid <?php echo esc_attr( $bg_darker_10 ); ?>;
    border-radius: 3px !important;
    }

    #template_header {
    background-color: <?php echo esc_attr( $base ); ?>;
    border-radius: 3px 3px 0 0 !important;
    color: <?php echo esc_attr( $base_text ); ?>;
    border-bottom: 0;
    font-weight: bold;
    line-height: 100%;
    vertical-align: middle;
    font-family: "Open Sans", Helvetica, Roboto, Arial, sans-serif;
    }

    #template_header h1,
    #template_header h1 a {
    color: <?php echo esc_attr( $base_text ); ?>;
    }

    #template_header_image img {
    margin-left: 0;
    margin-right: 0;
    }

    #template_footer td {
    padding: 0;
    border-radius: 6px;
    }


    #template_footer #credit p {
    margin: 0 0 16px;
    }

    #body_content {
    background-color: <?php echo esc_attr( $body ); ?>;
    text-align: center;
    }

    #body_content table td {
    padding: 48px 48px 32px;
    }

    #body_content table td td {
    padding: 12px;
    }

    #body_content table td th {
    padding: 12px;
    }

    #body_content td ul.wc-item-meta {
    font-size: small;
    margin: 1em 0 0;
    padding: 0;
    list-style: none;
    }

    #body_content td ul.wc-item-meta li {
    margin: 0.5em 0 0;
    padding: 0;
    }

    #body_content td ul.wc-item-meta li p {
    margin: 0;
    }

    p {
    margin: 0 0 16px;
    }

    #body_content_inner {
    color: <?php echo esc_attr( $text_lighter_20 ); ?>;
    font-family: "Open Sans", Helvetica, Roboto, Arial, sans-serif;
    line-height: 150%;
    text-align: center;
    }

    .td {
    color: <?php echo esc_attr( $text_lighter_20 ); ?>;
    vertical-align: middle;
    font-size: 13px;
    border: none;
    }

    .address {
    padding: 12px;
    color: <?php echo esc_attr( $text_lighter_20 ); ?>;
    border: none;
    }

    .text {
    color: <?php echo esc_attr( $text ); ?>;
    font-family: "Open Sans", Helvetica, Roboto, Arial, sans-serif;
    }

    .link {
    color: <?php echo esc_attr( $link_color ); ?>;
    }

    #header_wrapper {
    padding: 16px 48px;
    display: block;
    }

    h1 {
    color: <?php echo esc_attr( $base ); ?>;
    font-family: "Quicksand", Helvetica, Roboto, Arial, sans-serif;
    font-size: 30px;
    font-weight: 300;
    line-height: 150%;
    margin: 0;
    text-align: center;
    text-shadow: 0 1px 0 <?php echo esc_attr( $base_lighter_20 ); ?>;
    }

    h2 {
    color: <?php echo esc_attr( $base ); ?>;
    display: block;
    font-family: "Quicksand", Helvetica, Roboto, Arial, sans-serif;
    font-size: 18px;
    font-weight: bold;
    line-height: 130%;
    margin: 0 0 18px;
    text-align: center;
    }

    h3 {
    color: <?php echo esc_attr( $base ); ?>;
    display: block;
    font-family: "Quicksand", Helvetica, Roboto, Arial, sans-serif;
    font-size: 16px;
    font-weight: bold;
    line-height: 130%;
    margin: 16px 0 8px;
    text-align: center;
    }

    a {
    color: <?php echo esc_attr( $link_color ); ?>;
    font-weight: normal;
    text-decoration: underline;
    }

    img {
    border: none;
    display: inline-block;
    font-size: 14px;
    font-weight: bold;
    height: auto;
    outline: none;
    text-decoration: none;
    text-transform: capitalize;
    vertical-align: middle;
    margin-<?php echo is_rtl() ? 'left' : 'right'; ?>: 10px;
    max-width: 100%;
    height: auto;
    }
    #body_content .greeting {
    font-family: "Quicksand", Helvetica, Arial;
    font-size: 31px;
    text-align: center;
    margin-bottom: 25px;
    }
    .text-center {
    text-align:center;
    }
    .fz16 {
    font-size: 16px;
    }
    .image-top-wrap {
    text-align: center;
    margin-bottom: 20px;
    }

    .image-top {
    width: 40;
    }
    .pb20 {
    padding-bottom: 20px;
    }

    .mb20 {
    margin-bottom: 20px;
    }

    .section-underline {
    padding-bottom: 20px;
    border-bottom: 1px solid #969595;
    margin-bottom: 20px;
    }

    .bold {
    font-weight: bold;
    }
    .td-item-image img {
    width: 60px;
    height: auto;
    margin: 0;
    max-width: none;
    }

    .order-details-table {
    border-collapse: collapse;
    }

    .order-details-table tr {
    border-bottom: 1px dashed #969595;
    }

    .order-details-table tfoot tr:last-child {
    background: rgba(216, 32, 105, 0.3);
    border-bottom: 1px solid #969595;
    }

    table address.address {
    padding: 0;
    text-align: center;
    font-size: 13px;
    }

    .h3 {

    }

    .address-table td {
    border-radius: 2px;
    }

    .address-table td:last-child {
    background: #F6F6F6;
    }
    .icon-small {
    width: 50px;
    height: auto;
    }

    .icon-very-small {
    display: inline-block;
    margin-bottom: 10px;
    width: 20px;
    height: auto;
    }

    .table-white {
    background-color: #ffffff;
    text-align: center;
    padding: 48px 48px 32px;
    margin-top: 40px;
    border: 1px solid #d5d5d5;
    box-shadow: 0 1px 4px rgba(0, 0, 0, 0.1);
    border-radius: 3px;
    width: 600px;

    }


    #template_footer p {
    line-height: 1.6;
    font-family: "Open Sans", Helvetica, Roboto, Arial, sans-serif;
    }

    .footer-legal {
    ff
    }

    .wc-bacs-bank-details {
    padding-left: 0;
    }
    .wc-bacs-bank-details li {

    list-style-type: none;
    }


<?php
