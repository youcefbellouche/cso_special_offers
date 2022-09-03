<?php
class Cso_Enqueue {

	function __construct() {
		add_action( 'wp_enqueue_scripts', array( $this, 'cso_register_scripts' ) );
	}
	function cso_register_scripts() {
		/** CSO STYLES */
		wp_enqueue_style( 'cso-main-styles', CSO_PLUGIN_URL . '/assets/css/style.css', array(), CSO_PLUGIN_VERSION, 'all' );
		wp_enqueue_style( 'lineicons', 'https://cdn.lineicons.com/3.0/lineicons.css', array(), CSO_PLUGIN_VERSION, 'all' );

		/** CSO SCRIPTS */
		wp_enqueue_script( 'cso-states-js', CSO_PLUGIN_URL . '/assets/js/custom-order-form-states.js', array( 'jquery' ), CSO_PLUGIN_VERSION, true );
		wp_enqueue_script( 'cso-quantity-js', CSO_PLUGIN_URL . '/assets/js/product-quantity.js', array( 'jquery' ), CSO_PLUGIN_VERSION, true );
		wp_enqueue_script( 'cso-price-js', CSO_PLUGIN_URL . '/assets/js/total-price-calculator.js', array( 'jquery' ), CSO_PLUGIN_VERSION, true );
		/** DATA TO JS */
		$special_offers = get_post_meta( get_the_ID(), 'cso_product_offers', true ) ?: array();
		wp_localize_script(
			'cso-states-js',
			'wpData',
			array(
				'mainFile'    => CSO_PLUGIN_DIR,
				'mainFileUrl' => CSO_PLUGIN_URL,
				'ajaxurl'     => admin_url( 'admin-ajax.php' ),
				'offers_ids'  => array_keys( $special_offers, ),
				'offers'      => $special_offers,
			)
		);
	}
}
new Cso_Enqueue();
