<form action="" method="POST" id="card-form">
  <span class="card-errors"></span>
  <div class="form-row">
    <label>
      <span>Nombre del tarjetahabiente</span>
      <input type="text" size="20" data-conekta="card[name]" required />
    </label>
  </div>
  <div class="form-row">
    <label>
      <span>Número de tarjeta de crédito</span>
      <input type="text" size="20" data-conekta="card[number]" required />
    </label>
  </div>
  <div class="form-row">
    <label>
      <span>CVC</span>
      <input type="text" size="4" data-conekta="card[cvc]" required />
    </label>
  </div>
  <div class="form-row">
    <label>
      <span>Fecha de expiración (MM/AAAA)</span>
      <input type="text" size="2" data-conekta="card[exp_month]" required />
    </label>
    <span>/</span>
    <input type="text" size="4" data-conekta="card[exp_year]" required />
  </div>
  <div class="form-row">
  	<h1>Datos de facturación</h1>
  </div>  
  <div class="form-row">
    <label>
      <span>Dirección 1</span>
      <input type="text" name="street1" required />
    </label>
  </div>  
  <div class="form-row">
    <label>
      <span>Dirección 2</span>
      <input type="text" name="street2" required />
    </label>
  </div>  
  <div class="form-row">
    <label>
      <span>Minicipio</span>
      <input type="text" name="city" required />
    </label>
  </div> 
  <div class="form-row">
    <label>
      <span>Estado</span>
      <input type="text" name="state" required />
    </label>
  </div> 
  <div class="form-row">
    <label>
      <span>Codigo postal</span>
      <input type="text" name="zip" required />
    </label>
  </div> 
  <div class="form-row">
    <label>
      <span>Pais</span>
      <input type="text" name="zip" required />
    </label>
  </div> 
  <div class="form-row">
    <label>
      <span>Nombre de la empresa</span>
      <input type="text" name="company_name" required />
    </label>
  </div> 
  <div class="form-row">
    <label>
      <span>Teléfono</span>
      <input type="text" name="phone" required />
    </label>
  </div> 
  <div class="form-row">
    <label>
      <span>Email</span>
      <input type="text" name="email" required />
    </label>
  </div> 

  <button type="submit">¡Pagar ahora!</button>
</form>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="https://conektaapi.s3.amazonaws.com/v0.3.2/js/conekta.js"></script>
<script type="text/javascript">
 
 // Conekta Public Key
  Conekta.setPublishableKey('key_KJysdbf6PotS2ut2');

	$(function () {
	  $("#card-form").submit(function(event) {
	    var $form = $(this);
	
	    // Previene hacer submit más de una vez
	    $form.find("button").prop("disabled", true);
	    Conekta.token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
	   
	    // Previene que la información de la forma sea enviada al servidor
	    return false;
	  });
	});
	
	var conektaSuccessResponseHandler = function(token) {
	  var $form = $("#card-form");
	
	  /* Inserta el token_id en la forma para que se envíe al servidor */
	  $form.append($("<input type='hidden' name='conektaTokenId'>").val(token.id));
	  alert(token.id);
	 
	  /* and submit */
	  $form.get(0).submit();
	};
	
	var conektaErrorResponseHandler = function(response) {
	  var $form = $("#card-form");
	  
	  /* Muestra los errores en la forma */
	  $form.find(".card-errors").text(response.message);
	  $form.find("button").prop("disabled", false);
	};
</script>