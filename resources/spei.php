        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Solicitar clabe SPEI
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" id="name" placeholder="Nombre del cliente">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email del cliente">
                                </div>
                                <div class="form-group">
                                    <label for="concept">Concepto</label>
                                    <input type="text" class="form-control" id="concept" placeholder="Concepto de la compra">
                                </div>
                                <div class="form-group">
                                    <label for="amount">Cantidad</label>
                                    <input type="number" class="form-control" id="amount" placeholder="Cantidad a pagar">
                                </div>
                                <button type="submit" onclick="sendInfo()" class="btn btn-info">Enviar</button>
                            </form>

							<script>
							function sendInfo(){
							        var ajaxurl = 'resources/speiJSON.php',
							        data =  {'name': 'nombre'};
							        $.post(ajaxurl, data, function (response) {
							            // Response div goes here.
							            alert(response);
							        });
							    }
							</script>
                            </div>

                        </div>
                    </section>
            </div>
        </div>
 <!-- Modal that configures a Fanbot facebook page -->

    	<?php require_once("listModal.php"); ?>

<!-- End modal --> 