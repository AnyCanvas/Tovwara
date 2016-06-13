        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Editor de pagos</h4>
	                    </div>
	                    
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th class="hidden-phone">Numero de serie</th>
                                <th>Nombre</th>
                                <th>Numero de cliente</th>
                                <th>Plan</th>
                                <th>Acciones</th>
                                <th>Fecha de corte</th>
                                <th>Mes gratis</th>
                                <th>Estatus</th>
                            </tr>
                            </thead>
                            <tbody>

								<?php

										require(realpath(dirname(__FILE__) . "/./config.php"));
								    	$servername = $config["db"]["fanbot"]["host"];
										$username = $config["db"]["fanbot"]["username"];
										$password = $config["db"]["fanbot"]["password"];
										$dbname = $config["db"]["fanbot"]["dbname"];								

								
										
											
										// Create connection
										$conn = new mysqli($servername, $username, $password, $dbname);
										// Check connection
										if ($conn->connect_error) {
										    die("Connection failed: " . $conn->connect_error);
										}
										
											$sql = "SELECT * FROM fanbot";	

										$result = $conn->query($sql);
										
										if ($result->num_rows > 0) {		    
										    while($row = $result->fetch_assoc()) { ?>
											    			
															<tr>
								                                <td><?php echo $row['id']?></td>
								                                <td><kbd class="text-uppercase"><?php echo $row['name']?></kbd></td>
								                                <td><?php echo $row['clientId']?></td>
								                                <td><?php
																	switch ($row['plan']) {
																	    case '00':
																	        echo "ASOMBRANDOM";
																	        break;
																	    case '01':
																	        echo "BASIC";
																	        break;
																	    case '02':
																	        echo "PRO";
																	        break;
																	    case '03':
																	        echo "PREMIUM";
																	        break;
																	}												                                
									                                ?></td>
								                                <td><?php echo $row['credit']?></td>
								                                <td><?php echo $row['courtDate']?></td>
																<td><?php 
																	switch($row['freeMonth']){ 
																		case 0: echo "No";
																	 		break;	
																		case 1: echo "Si";
																	 		break;	
																	}																	
																	?></td>
																<td><?php 
																	switch($row['estatus']){ 
																		case 0: echo "Vencido";
																	 		break;	
																		case 1: echo "Pagado";
																	 		break;	
																	}
																	?></td>
																	<td>
									                                <a class="btn btn-primary btn-xs" onclick="callModal('<?php echo $row['id']. "','". $row['plan']. "','". $row['courtDate']. "','". $row['freeMonth']. "','". $row['estatus'];?>')">
										                                <span class="fa fa-cog" aria-hidden="true"></span> Editar
										                                </a>
									                                </td>	
									                                <td>					
									                                <a class="btn btn-primary btn-xs" onclick="callPaid('<?php echo $row['id']. "','". $row['plan']. "','". $row['courtDate']. "','". $row['freeMonth']. "','". $row['estatus'];?>')">
										                                <span class="fa fa-credit-card" aria-hidden="true"></span> Cobrar
										                                </a>
									                                </td>			
								                            </tr>
								
								
								
								<?php			    }
											} else {	
															?> 
															
															<tr>
								                                <td>No tienes ninguna Fanbot asignada</td>
								                            </tr>
								                            
								                            <?php
																										
											}
										$conn->close();
								
									?>									

							
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        
<script>
function fnbtAction(){
        var ajaxurl = 'resources/actionUrl.php';
		var fanbotPlan = $("#fanbotPlan").val();
	    var courtDate = $( "#courtDate" ).val();
	    var freeMonth = $( "#freeMonth" ).val();
	    var paidStatus = $( "#paidStatus" ).val();
	    var id = localStorage.getItem("fanbotId");
        data =  {'id': id, 'fanbotPlan' : fanbotPlan, 'courtDate': courtDate, 'freeMonth': freeMonth, 'paidStatus': paidStatus};
		console.log (data);
        $.post(ajaxurl, data, function (response) {
            // Response div goes here.
            console.log(response);
        });
		$('#configModal').modal('hide');
    }

    function callModal(fanbotId, fanbotPlan,courtDate,freeMonth,paidStatus) {
	    localStorage.setItem("fanbotId", fanbotId);
	    $("select#fanbotPlan").val("0" + fanbotPlan);
	    $("select#courtDate").val(courtDate);
	    $("select#freeMonth").val(freeMonth);
	    $("select#paidStatus").val(paidStatus);

		console.log(fanbotPlan + ' ' + courtDate + ' ' + freeMonth + ' ' + paidStatus);
		$('#configModal').modal('show');
	}

    function callPaid(fanbotId, fanbotPlan,courtDate,freeMonth,paidStatus) {
		console.log(fanbotPlan + ' ' + courtDate + ' ' + freeMonth + ' ' + paidStatus);
		$('#speiModal').modal('show');
	}
</script>

		  <div class="modal fade" id="configModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Configura tu Fanbot</h4>
		        </div>
		        <div class="modal-body">

				<form class="form" action="change_page.php" method="get" id="formUrl">

<!-- Fanbot court date -->
					  <div class="form-group">
							<label for="courtDate">Dia de corte:</label>
							<input type="date" class="form-control" id="courtDate"></select>
					  </div>

<!-- Fanbot paid status -->
					  <div class="form-group">
							<label class="control-label">Estado de pago: </label>
							<select class="form-control" id="paidStatus">
					        	<option value="1">Pagado</option>
								<option value="0">Vencido</option>
							</select>
					  </div>
					  					  					  
					  <div class="form-group">
						<input class="form-controlinput-sm" type='hidden' id= 'hiddenField' name='name' value='' />				  
					  </div>

					  </form>					
		        </div>

			    <div class="modal-footer">
					<button id="cambiarBtn" class="btn btn-primary btn-sm" onclick="fnbtAction()">Cambiar</button>

		        </div>
		      
	      	  </div>
		    </div>
		  </div>

		  <div class="modal fade" id="speiModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Configura tu Fanbot</h4>
		        </div>
		        <div class="modal-body">

                    <form role="form" action="resources/speiJSON.php" method="post">
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
                            <input type="file" name="xmlfile" required>
                        </div>

                        <button type="submit" class="btn btn-info">Enviar</button>
                    </form>
		        </div>

			    <div class="modal-footer">
					<button id="cambiarBtn" class="btn btn-primary btn-sm" onclick="fnbtAction()">Cambiar</button>

		        </div>
		      
	      	  </div>
		    </div>
		  </div>


<!-- End modal --> 