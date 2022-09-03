const removeQuantity = jQuery(".cod_product_remove_quantity");
const addQuantity = jQuery(".cod_product_add_quantity");
const quantityDiv = jQuery(".cod-quantity");
const quantityInput = jQuery(".cod_product_quantity_input");

addQuantity.on("click", function () {
  if (parseInt(quantityDiv.text()) >= 10 || parseInt(quantityDiv.val()) >= 10) {
    quantityDiv.text(10);
    quantityInput.val(10);
    return;
  }
  quantityInput.val(parseInt(quantityInput.val()) + 1);
  quantityDiv.text(quantityInput.val());
  quantityInput.trigger("change");
});

removeQuantity.on("click", function () {
  if (parseInt(quantityDiv.text()) <= 1 || parseInt(quantityDiv.val()) <= 10) {
    quantityDiv.text(1);
    quantityInput.val(1);
    return;
  }
  quantityInput.val(parseInt(quantityInput.val()) - 1);
  quantityDiv.text(quantityInput.val());
  quantityInput.trigger("change");
});
