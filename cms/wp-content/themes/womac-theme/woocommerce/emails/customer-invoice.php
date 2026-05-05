<?php
/**
 * Rechnungs-E-Mail / Zahlungsaufforderung – Kunde
 *
 * Überschreibt: woocommerce/templates/emails/customer-invoice.php
 * E-Mail-Typ:   customer_invoice
 * Auslöser:     Manuelle Rechnungs-E-Mail aus dem Backend oder ausstehende Zahlung
 *
 * @package womactheme\WooCommerceEmails
 * @since   1.16.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p><?php printf(
    esc_html__( 'Hallo %s,', 'womactheme' ),
    esc_html( $order->get_billing_first_name() )
); ?></p>

<?php if ( $order->needs_payment() ) : ?>

<p><?php printf(
    /* translators: %s: order number */
    esc_html__( 'hier ist die Rechnung für Bestellung #%s. Bitte schließe die Zahlung über den untenstehenden Button ab.', 'womactheme' ),
    esc_html( $order->get_order_number() )
); ?></p>

<!-- Info-Box -->
<div class="order-info-box">
    <strong><?php esc_html_e( 'Bestellnummer:', 'womactheme' ); ?></strong>
    #<?php echo esc_html( $order->get_order_number() ); ?> &nbsp;·&nbsp;
    <strong><?php esc_html_e( 'Betrag:', 'womactheme' ); ?></strong>
    <?php echo wp_kses_post( $order->get_formatted_order_total() ); ?>
</div>

<?php do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<!-- Zahlungs-CTA -->
<p style="text-align:center;margin:28px 0;">
    <a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>"
       style="display:inline-block;background-color:<?php echo esc_attr( apply_filters( 'womactheme_email_primary_color', get_option( 'woocommerce_email_base_color', '#ff0000' ) ) ); ?>;
              color:#ffffff;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
              font-size:15px;font-weight:600;text-decoration:none;
              padding:13px 28px;border-radius:6px;">
        <?php esc_html_e( 'Jetzt bezahlen', 'womactheme' ); ?>
    </a>
</p>

<?php else : ?>

<p><?php printf(
    esc_html__( 'anbei die Übersicht zu Bestellung #%s.', 'womactheme' ),
    esc_html( $order->get_order_number() )
); ?></p>

<div class="order-info-box">
    <strong><?php esc_html_e( 'Bestellnummer:', 'womactheme' ); ?></strong>
    #<?php echo esc_html( $order->get_order_number() ); ?> &nbsp;·&nbsp;
    <strong><?php esc_html_e( 'Status:', 'womactheme' ); ?></strong>
    <?php echo esc_html( wc_get_order_status_name( $order->get_status() ) ); ?>
</div>

<?php do_action( 'woocommerce_email_order_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_order_meta', $order, $sent_to_admin, $plain_text, $email ); ?>

<?php do_action( 'woocommerce_email_customer_details', $order, $sent_to_admin, $plain_text, $email ); ?>

<p style="text-align:center;margin:28px 0;">
    <a href="<?php echo esc_url( $order->get_view_order_url() ); ?>"
       style="display:inline-block;background-color:<?php echo esc_attr( apply_filters( 'womactheme_email_primary_color', get_option( 'woocommerce_email_base_color', '#ff0000' ) ) ); ?>;
              color:#ffffff;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Arial,sans-serif;
              font-size:15px;font-weight:600;text-decoration:none;
              padding:13px 28px;border-radius:6px;">
        <?php esc_html_e( 'Bestellung ansehen', 'womactheme' ); ?>
    </a>
</p>

<?php endif; ?>

<?php do_action( 'woocommerce_email_footer', $email ); ?>
