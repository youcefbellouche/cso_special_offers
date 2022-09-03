<?php
/**
 * Cod Product Offer Meta Box Callback
 *
 * @package cod
 */

global $product;
$offers = get_post_meta( get_the_ID(), 'cso_product_offers', true ) ?: array();

?>
<div class="cod_product_offers">
	<?php foreach ( $offers as $key => $offer ) : ?>
	<div class="cod_product_offer">
		<input type="text" name="cso_product_offers[<?php echo $key; ?>][label]" value="<?php echo $offer['label']; ?>"
			placeholder="Label" id="">
		<input type="text" name="cso_product_offers[<?php echo $key; ?>][offer]" value="<?php echo $offer['offer']; ?>"
			placeholder="Offer Price" id="">
		<input type="text" name="cso_product_offers[<?php echo $key; ?>][sale_offer]" value="<?php echo $offer['sale_offer']; ?>"
			placeholder="Sale Offer" id="">
			<div class="cso-free-shipping">
				<label for="">free shipping</label>
				<input type="checkbox" name="cso_product_offers[<?php echo $key; ?>][free_shipping]" <?php echo checked( 'on', $offer['free_shipping'], false );?>  >
			</div>
		<button class="button button-primary remove_offer_field" style="margin-left: 5px;">delete</button>
	</div>
	<?php endforeach; ?>
</div>
<button style="margin-top: 20px ;" class="button add_offer_field">Add Field</button>
