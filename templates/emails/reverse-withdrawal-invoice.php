<?php
/**
 * Monthly Reverse Withdrawal Invoice Template.
 *
 * Vendors Will get this email once in a month.
 *
 * @class ReverseWithdrawalInvoice
 *
 * @package \WeDevs\Dokan\Emails\ReverseWithdrawalInvoice
 *
 * @since DOKAN_SINCE
 *
 * @var $seller_info \WeDevs\Dokan\Vendor\Vendor
 * @var $due_status array
 * @var $data array
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

do_action( 'woocommerce_email_header', $email_heading, $email ); ?>

<p><?php printf( esc_html__( 'Hi %s,', 'dokan-lite' ), esc_html( $seller_info->get_shop_name() ) ); ?></p>
<p>
    <?php echo sprintf( esc_html__( 'Your %1$s %2$s invoice is now available for store: %3$s.', 'dokan-lite' ), $data['month'], $data['year'], $seller_info->get_shop_name() ); ?>
</p>
<hr>
<ul>
    <li>
        <strong>
            <?php printf( esc_html__( 'Summary for %1$s : ', 'dokan-lite' ), $seller_info->get_shop_name() ); ?>
        </strong>
    </li>
    <li>
        <strong>
            <?php printf( esc_html__( 'Reverse withdrawal charges for %1$s %2$s:', 'dokan-lite' ), $data['month'], $data['year'] ); ?>
        </strong>
        <?php echo wp_kses_post( wc_price( $due_status['balance']['payable_amount'] ) ); ?>
    </li>
    <li>
        <strong>
            <?php esc_html_e( 'Due Date: ', 'dokan-lite' ); ?>
        </strong>
        <?php echo dokan_format_date( $due_status['due_date'] ); ?>
    </li>
</ul>

<p>
    <?php
    printf(
        wp_kses(
            '<a href="' . $data['reverse_withdrawal_url'] . '">' . esc_html__( 'Pay Now', 'dokan-lite' ) . '</a>',
            array(
                'a' => array(
                    'href' => array(),
                ),
            )
        )
    );
    ?>
</p>

<?php
/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
    echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );
