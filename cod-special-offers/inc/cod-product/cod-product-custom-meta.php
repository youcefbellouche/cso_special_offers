<?php

class Cod_Product_Custom_Meta {
	/**
	 * Constrctor.
	 */
	public function __construct() {
		add_action( 'add_meta_boxes_cod-product', array( $this, 'add_cod_product_meta_boxes' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_cod_product_meta_boxes_scripts' ) );
		add_action( 'save_post_cod-product', array( $this, 'cod_product_save_offers' ) );
	}
	/**
	 * Add Cod Product Meta Boxes
	 */
	public function add_cod_product_meta_boxes() {
			add_meta_box( 'cod-product-offers', __( 'Product offers', 'cod' ), array( $this, 'cod_product_metabox_display' ), 'cod-product', 'normal', 'high' );

	}
	/**
	 * Display Cod Product Meta Boxes From
	 */
	public function cod_product_metabox_display( $post, $args ) {
		require_once CSO_PLUGIN_DIR . 'inc/partials/cod-product-offers.php';
	}

	/**
	 * Save Cod Product offers
	 */
	public function cod_product_save_offers( $product_id ) {

		$form_offers = $_POST['cso_product_offers']?$_POST['cso_product_offers']:array();
		$offers      = array();
		array_walk(
			$form_offers,
			function( $value, $key ) use ( &$offers ) {
				if ( $value['label'] != '' && $value['offer'] != '' ) {
					$offers[ uniqid() . uniqid() ] = $value;
				}
			}
		);
		update_post_meta( $product_id, 'cso_product_offers', $offers );
	}
	/**
	 * Enqueue Cod Product Metaboxes Scripts & Styles
	 */
	public function enqueue_cod_product_meta_boxes_scripts() {
			wp_enqueue_script( 'special-offers-metabox-js', CSO_PLUGIN_URL . '/assets/js/special-offers.js', array( 'jquery' ), CSO_PLUGIN_VERSION, true );
			wp_enqueue_style( 'special-offers-metabox-css', CSO_PLUGIN_URL . '/assets/css/special-offers.css', array(), CSO_PLUGIN_VERSION, 'all' );
	}

}
new Cod_Product_Custom_Meta();
