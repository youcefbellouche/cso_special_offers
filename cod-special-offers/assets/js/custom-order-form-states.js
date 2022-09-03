
(function ($) {
    var cities = []; // SELECT STATES INIT
    var codField = document.createElement("div");
    codField.classList.add("cod_order_field");
    var selectWilaya = document.createElement("select");
    selectWilaya.setAttribute("required", "required");
    selectWilaya.setAttribute("name", "cod-state");
    selectWilaya.classList.add("cod-wilaya-select"); // SELECT CITIES INIT

    var selectCities = document.createElement("select");
    selectCities.setAttribute("name", "cod-city");
    selectCities.classList.add("cod-city-select");
    $(".cod-product-wrapper").hide();
    Promise.all([$.getJSON(wpData.mainFileUrl + "/assets/algeria_cities.json"), $.getJSON(wpData.mainFileUrl + "/assets/algeria_states_lotfi.json")]).then(function (data) {
      cities = data[0];
      $(".cod-product-wrapper").show();
      var option = document.createElement("option");
      option.setAttribute("value", "");
      option.setAttribute("selected", "selected");
      option.setAttribute("disabled", "true");
      option.classList.add("cod-wilaya-option");
      option.append("اختر الولاية *");
      selectWilaya.appendChild(option); // SET SELECT INPUT STATES
  
      data[1].forEach(function (wilaya) {
        var option = document.createElement("option");
        option.setAttribute("value", wilaya.fr_name.replace("'", ""));
        option.classList.add("cod-wilaya-option");
        option.append(wilaya.ar_name);
        selectWilaya.appendChild(option);
      });
      $(".cso-states").append(selectWilaya);
    });
    $(document).on("change", ".cod-wilaya-select", function (e) {
      var selectedState = e.target.value;
      var linkedCities = cities.filter(function (city) {
        return city.wilaya_name_ascii.replace("'", "") === selectedState.replace("'", "");
      });
      selectCities.innerHTML = "";
      linkedCities.forEach(function (city) {
        var option = document.createElement("option");
        option.setAttribute("value", city.commune_name_ascii);
        option.classList.add("cod-city-option");
        option.append(city.commune_name);
        selectCities.appendChild(option);
        
      });
      codField.appendChild(selectCities)
      $(".cso-cities").append(codField);
      $(".cso-cities").show()
    });
  })(jQuery);