        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Pagar con tarjeta
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
								<form action="resources/cardCharge.php" method="POST" id="card-form">
								  <input type='hidden' name='amount' value="<?php echo $_GET["amount"]?>"/>
								  <span class="card-errors"></span>
								  <div class="form-row">
								    <label>
								      <span>Nombre del tarjetahabiente</span>
								      <input type="text" size="20" data-conekta="card[name]" name="name" required />
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
								      <span>RFC</span>
								      <input type="text" name="rfc" required />
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

                            </div>

                        </div>
                    </section>
            </div>
        </div>