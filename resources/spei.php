        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Solicitar clabe SPEI
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="resources/speiJSON.php" method="post" target="_blank">
                                <div class="form-group">
                                    <label for="name">Nombre</label>
                                    <input type="text" class="form-control" name="name" placeholder="Nombre del cliente" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Email del cliente" required>
                                </div>
                                <div class="form-group">
                                    <label for="concept">Concepto</label>
                                    <input type="text" class="form-control" name="concept" placeholder="Concepto de la compra" required>
                                </div>
                                <div class="form-group">
                                    <label for="amount">Cantidad</label>
                                    <input type="number" class="form-control" name="amount" placeholder="Cantidad a pagar" required>
                                </div>
                                <div class="form-group">
                                    <label for="xmlFile">XML de factura</label>
                                    <input type="file" name="xmlFile" required>
                                </div>
                                <div class="form-group">
                                    <label for="pdfFile">PDF de factura</label>
                                    <input type="file" name="pdfFile" required>
                                </div>

                                <button type="submit" class="btn btn-info">Enviar</button>
                            </form>
                            </div>

                        </div>
                    </section>
            </div>
        </div>
 <!-- Modal that configures a Fanbot facebook page -->

    	<?php require_once("listModal.php"); ?>

<!-- End modal --> 