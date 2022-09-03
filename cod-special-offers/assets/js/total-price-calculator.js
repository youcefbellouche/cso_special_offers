// import "jquery"
// import "jquery"
(function ($) {
   
    
    $(document).on("change", ".cod-wilaya-select,.cod_product_quantity_input,input[name='cso_product_offers']", function (e) {
      var offer_id = $("input[name='cso_product_offers']:checked").val()
      $(".cso-total-price").html(`<span class="loader"></span>`);
      const state = $(".cod-wilaya-select").val();
      if (state){
        $.ajax(wpData.ajaxurl, {
          method: "POST",
          data: {
            action: "generate_price_cso",
            offer_id: offer_id,
            product_id: $(".cod-product-id").val(),
            state: state,
          },
          success: function (res) {
            console.log(res)
            const totalPrice =
              parseInt(res.product_price) * $(".cod_product_quantity_input").val();
            const shippingPrice = parseInt(res.shipping_price);
            $(".cso-total-price").html(`<p>السعر الإجمالي مع سعر الشحن</p>`);
            var totalPriceHtml = totalPrice + "DA +" + shippingPrice + "DA =" + (totalPrice + shippingPrice) + "DA"
            $(".cso-total-price").append(totalPriceHtml);
        },
        })
      }
      else{
        $(".cso-total-price").html("")
      }
        
    });
  })(jQuery);