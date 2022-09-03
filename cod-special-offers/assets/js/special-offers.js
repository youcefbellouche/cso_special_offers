function model(
    index = 0,
    label = "",
    offer = "",
    sale_offer = "",
    shipping = null
  ) {
    const model = `
      <div class="cod_product_offer">
      <input type="text" required name="cso_product_offers[${index}][label]" value="${label}" placeholder="Label" id="">
      <input type="text" required name="cso_product_offers[${index}][offer]" value="${offer}" placeholder="Offer Price" id="">
      <input type="text" name="cso_product_offers[${index}][sale_offer]" value="${sale_offer}" placeholder="Offer Sale Price" id="">
      <div class="cso-free-shipping">
				<label for="">free shipping</label>
				<input type="checkbox" name="cso_product_offers[${index}][free_shipping]" >
			</div>
      <button class="button button-primary remove_offer_field" style="margin-left: 5px;">delete</button>
      </div>
      `;
  
    return model;
  }
  
  function shippingPercentModel(value) {
    let shippingPercentModel;
    for (i = 0; i <= 100; i = i + 10) {
      shippingPercentModel += `
          <option ${value == i ? "selected" : ""} value="${i}">${i}%</option>
          `;
    }
    return shippingPercentModel;
  }
  
  const offersContainer = jQuery(".cod_product_offers");
  const addButton = jQuery(".add_offer_field");
  
  // Add New Field
  addButton.on("click", function (e) {
    e.preventDefault();
    const offerContainer = jQuery(".cod_product_offer");
    offersContainer.append(model(offerContainer.length));
  });
  
  // Remove Field
  jQuery(document).on("click", ".remove_offer_field", function (e) {
    e.preventDefault();
    const offerContainer = jQuery(".cod_product_offer");
    jQuery(this).parent().remove();
  });
  

  