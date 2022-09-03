<?php

class Cod_Order_New_Form {
	public function __construct() {
		 add_action( 'init', array( $this, 'remove_cod_form_template' ) );

	}
	public function remove_cod_form_template() {

		remove_action( 'cod_product_form_template', 'cod_order_template', 10 );
		add_action( 'cod_product_form_template', array( $this, 'new_cod_form_template' ), 10, 3 );
		add_action( 'after_cod_product_title', array( $this, 'cso_title_start' ) );
		add_action( 'after_cod_product_card_title', array( $this, 'cso_title_start' ) );
	}
	public function new_cod_form_template( $attrs, $product_sale_price, $product_regular_price ) {
		require_once CSO_PLUGIN_DIR . 'inc/partials/cod-order-form-template.php';
	}
	public function cso_title_start() {
		require CSO_PLUGIN_DIR . 'inc/partials/cod-product-stars.php';
	}
}
new Cod_Order_New_Form();
