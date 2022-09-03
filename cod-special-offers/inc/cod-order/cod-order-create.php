<?php

class Cso_Order {
	public function __construct() {
		// remove_action( 'init', 'create_order' );
		add_action( 'init', array( $this, 'create_order' ) );
		add_action( 'cod_order_metabox_product_details', array( $this, 'change_order_metabox_display' ) );
		add_action( 'cod_order_email_after_product_details', array( $this, 'change_order_metabox_display' ) );
		add_filter( 'cod_order_to_google_sheet_info', array( $this, 'cso_order_google_sheet' ) );
	}

	function create_order() {

		if ( isset( $_POST['cso-order-form'] )
			&& wp_verify_nonce( $_POST['cso-order-form'], 'cso-order-form' ) ) {
			$product_id  = $_POST['cod-product-id'];
			$name        = $_POST['cod-name'];
			$quantity    = $_POST['quantity'];
			$phone       = $_POST['cod-phone'];
			$offer_id    = $_POST['cso_product_offers'];
			$email       = $_POST['cod-email'];
			$city        = $_POST['cod-city'];
			$state       = $_POST['cod-state'];
			$status      = 'pending';
			$full_adress = $_POST['cod-full-adress'];
			$attributes  = Cod_Product::get_product_attributes( $product_id );

			$prices = Cod_Product::get_product_prices( $product_id, $state );
			if ( $offer_id ) {
				$special_offers = get_post_meta( $product_id, 'cso_product_offers', true ) ?: array();
				if ( $special_offers[ $offer_id ] ) {
					$offer                   = $special_offers[ $offer_id ]['label'];
					$prices['product_price'] = $special_offers[ $offer_id ]['offer'];
				}
			}

			$total_price_no_shipping = intval( $prices['product_price'] ) * $quantity;
			$total_price             = $total_price_no_shipping + ( $prices['shipping_price'] ?: 0 );
			$order_key               = rand( 20, 999999 );

			if ( isset( $product_id ) && isset( $quantity ) && isset( $phone ) && isset( $state ) && isset( $city ) && isset( $name ) ) {
				var_dump( $prices );
				$order_id = wp_insert_post(
					array(
						'post_type'   => 'cod-order',
						'post_status' => 'publish',
						'post_title'  => sanitize_text_field( $name ),
					)
				);
				if ( isset( $attributes ) ) {
					foreach ( $attributes as $key => $attribute ) {
						$attrs[ $key ] = $_POST[ $key ];
					}
				}

				update_post_meta(
					$order_id,
					'order_infos',
					array(
						'name'           => sanitize_text_field( $name ),
						'phone'          => sanitize_text_field( $phone ),
						'email'          => sanitize_text_field( $email ),
						'city'           => sanitize_text_field( $city ),
						'full_adress'    => sanitize_text_field( $full_adress ),
						'state'          => sanitize_text_field( $state ),
						'phone'          => sanitize_text_field( $phone ),
						'product'        => get_the_title( $product_id ),
						'product_id'     => $product_id,
						'product_price'  => $prices['product_price'],
						'offer'          => $offer,
						'shipping_price' => $prices['shipping_price'],
						'quantity'       => sanitize_text_field( $quantity ),
						'total_price'    => $total_price,
						'status'         => $status,
						'attributes'     => isset( $attrs ) ? $attrs : array(),
						'order_key'      => $order_key,
					)
				);
				$product_current_stock = get_field( 'cod-stock', $product_id );
				if ( $product_current_stock ) {
					update_field( 'cod-stock', $product_current_stock - $quantity, $product_id, $product_id );
				}
				do_action( 'cod_order_completed', $product_id, $order_id );
				wp_redirect( "thankyou?order_id=$order_id&key=$order_key" );
				exit();
			}
		}
	}
	public function change_order_metabox_display( $order_infos ) {
		if ( $order_infos['offer'] != '' && $order_infos['offer'] != null ) {
			?>
			<p>Offer Name : <?php echo $order_infos['offer']; ?></p>
			<?php

		}

	}
	public function cso_order_google_sheet( $args ) {
		$args[0][3] = $args[2]['offer'] ? $args[2]['offer'] : '/';
		return $args;
	}

}
new Cso_Order();
