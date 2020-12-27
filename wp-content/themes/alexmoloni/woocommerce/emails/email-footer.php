<?php
/**
 * Email Footer
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-footer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>
</div>
</td>
</tr>
</table>
<!-- End Content -->
</td>
</tr>
</table>
<!-- End Body -->
</td>
</tr>
</table>
</td>
</tr>
<tr>
    <td align="center" valign="top">
        <!-- Footer -->
        <table style="margin-top: 40px;" class="table-white" border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer">

            <tr>
                <td valign="top">
                    <table border="0" cellpadding="10" cellspacing="0" width="100%">
                        <tr>
                            <td align="center" valign="middle" style="padding-bottom: 15px;">
                                <img width="40" src="<?= get_field( 'email_question_icon', 'options' )['url']; ?>" alt="">
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <h2 style="font-size: 30px; font-weight: 400;"><?= __( 'Masz pytania?', 'alexmoloni' ) ?></h2>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
								<?= get_field( 'footer_text_emails_wc', 'options' ); ?>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <table width="100%" cellpadding="10" cellspacing="20" border="0" align="center">
                                    <tbody>
                                    <tr>
                                        <td style="border-radius: 0;border:1px solid #cfcfcf; padding: 15px;" align="center" width="50%">
                                            <img style="height: 24px;width:auto;margin-bottom: 10px;margin-right: 0;" src="<?= get_field( 'email_phone_icon', 'options' )['url']; ?>" alt="">
                                            <p style="font-weight:bold; text-transform:uppercase; "><?= __( 'Telefon', 'alexmoloni' ) ?></p>
                                            <a style="font-size: 15px" href="tel: <?= get_field( 'phone', 'options' ) ?>"><?= get_field( 'phone', 'options' ) ?></a>
                                        </td>
                                        <td style="border-radius: 0;border:1px solid #cfcfcf; padding: 15px;" align="center" width="50%">
                                            <img style="height: 24px;width:auto;margin-bottom: 10px;margin-right: 0;" src="<?= get_field( 'email_mail_icon', 'options' )['url']; ?>" alt="">
                                            <p style="font-weight:bold; text-transform:uppercase;"><?= __( 'Email', 'alexmoloni' ) ?></p>
                                            <a style="font-size: 13px" href="mailto: <?= get_field( 'email', 'options' ) ?>"><?= get_field( 'email', 'options' ) ?></a>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>


                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <!-- End Footer -->
    </td>
</tr>
<tr>
<td>
    <table align="center" style="margin-top: 40px;" class="table-white">
        <tbody>
        <tr>
            <td style="font-size: 28px; text-align:center;">
                <h2 style="font-weight: 400;"><?= get_field( 'footer_nice_day', 'options' ); ?></h2>
            </td>
        </tr>
        </tbody>
    </table>
</td>
</tr>
<tr style="padding-top: 30px;" id="footer_legal">
    <td>
        <table cellpadding="20" align="center" class="footer-legal" width="600" border="0">
            <tbody>
            <tr align="center">
                <td style="font-size: 12px; color:#555555; text-align:center;"><?= get_field( 'legal_text_footer_emails', 'options' ) ?></td>
            </tr>
            </tbody>
        </table>
    </td>
</tr>
</table>
</div>
</body>
</html>
