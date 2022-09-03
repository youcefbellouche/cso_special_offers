<?php
class Core_Cso_Ajax {

	function __construct() {
		add_action( 'wp_ajax_nopriv_generate_price_cso', array( $this, 'generate_price_cso' ) );
		add_action( 'wp_ajax_generate_price_cso', array( $this, 'generate_price_cso' ) );
	}
	function generate_price_cso() {
		$product_id     = $_POST['product_id'];
		$state          = $_POST['state'];
		$offer_id       = $_POST['offer_id'];
		$special_offers = get_post_meta( $product_id, 'cso_product_offers', true ) ?: array();
		$response       = Cod_Product::get_product_prices( $product_id, $state );
		if ( $special_offers[ $offer_id ] ) {
			$response['product_price'] = $special_offers[ $offer_id ]['offer'];
			$response['shipping_price'] = $special_offers[ $offer_id ]['free_shipping'] =="on"?0:$response['shipping_price'];
		}

		wp_send_json( $response );
	}
}

new Core_Cso_Ajax();
