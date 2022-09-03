<?php
$special_offers = get_post_meta( get_the_ID(), 'cso_product_offers', true ) ?: array();
?>
<div class="cso-order">				
	<form class="cod_product_order_form" method="POST">
	<? wp_nonce_field( 'cso-order-form','cso-order-form' );?>
		<input class="cod-product-id" type="hidden" name="cod-product-id" value="<?php echo get_the_ID(); ?>">
		<h1 class="cod_product_order_form_title">معلومات الزبون</h1>
		<div class="cod_product_order_form_inputs">
			<div class="cod_order_field">
				<input name="cod-name" required type="text" placeholder="الإسم واللقب *">
			</div>
			<div class="cod_order_field">
				<input name="cod-phone" required type="tel" pattern="[0-9]+" placeholder="رقم الهاتف *">
			</div>
			<div class="cod_order_field">
				<input type="email" name="cod-email" placeholder="البريد الإلكتروني">
			</div>
			<?php
			if ( $attrs ) {
				foreach ( $attrs as $title => $options ) {
					echo '<div class="cod_order_field">';
					echo '<select required name=' . $title . '>';
					echo "<option value=''>" . $title . ' *</option>';
					foreach ( $options as $option ) {
						echo '<option value=' . $option . '>' . $option . '</option>';
					}
					echo '</select>';
					echo '</div>';
				}
			}
			?>
			<div class="cod_order_field">
				<div class="cso-states"></div>
			</div>
			<div class="cso-cities" style="display:none ;">
			</div>
			<div class="cod_order_field">
				<input name="cod-full-adress" type="text" placeholder="العنوان الكامل">
			</div>
		</div>	
		<div class="cod_product_attributes">
			<?php
			if ( ! empty( $special_offers ) ) :
				?>
			<label class="cod_product_attribute_container">
				<div class="cod_product_attribute_left_section">
					<div class="cso_offer_input">
						<input  type="radio" name="cso_product_offers" value="default" checked>
					</div>
					<p><?php echo 'العرض العادي'; ?></p>
				</div>
				<p class="cso_offer_price">
					
					<?php if ( $product_sale_price != '' ) : ?>
					<span class="cso_offer_standard_price">
						<?php echo $product_regular_price; ?>DA
					
					</span>
					<?php endif; ?>
					<span class="cso_offer_price_text"><?php echo $product_sale_price != '' ? $product_sale_price : $product_regular_price; ?>DA</span>
				</p>
			</label>
				<?php
				foreach ( $special_offers as $key => $attribute ) :
					?>
			<label class="cod_product_attribute_container">
				<div class="cod_product_attribute_left_section">
					<div class="cso_offer_input">
					<input type="hidden" name="free_shipping" value="<?php echo $value["free_shipping"]?>">
						<input  type="radio" name="cso_product_offers" value="<?php echo $key; ?>">
					</div>
					<p><?php echo $attribute['label']; ?></p>
				</div>
				<p class="cso_offer_price">
					<?php if ( $attribute['sale_offer'] ) : ?>
					<span class="cso_offer_standard_price">
						<?php echo $attribute['sale_offer']; ?>DA
					
					</span>
					<?php endif; ?>
					<span class="cso_offer_price_text"><?php echo $attribute['offer']; ?>DA</span>
				</p>
			</label>
					<?php
			endforeach;
			endif;
			?>
		</div>
		<div class="cso-total-price"></div>
		<div class="cod_product_order_form_add_to_cart_section">
			<div class="cod_product_order_form_quantity_section">
				<input class="cod_product_quantity_input" type="hidden" name="quantity" value="1">
				<i class="lni lni-minus cod_product_remove_quantity"></i>
				<div class="cod-quantity">1</div>
				<i class="lni lni-plus cod_product_add_quantity"></i>
			</div>
			<button class="cod_product_buy_button"><?php echo __( 'أطلب الان' ); ?></button>
		</div>

			
	</form>
</div>
