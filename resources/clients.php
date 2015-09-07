        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Editor de Cliente</h4>
	                    </div>
	                    
	                    <div class="btn-add-task col-xs-2">
	                    <div class="btn-add-task col-xs-9">

                        	<button type="submit" class="btn btn-default btn-primary btn-xs"  onclick="callModal()"><i class="fa fa-plus"></i> Agregar</button>
							</div>
                    	</div>
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th class="hidden-phone">Id de cliente</th>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Permisos</th>

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
										
											$sql = "SELECT * FROM accounts";	

										$result = $conn->query($sql);
										
										if ($result->num_rows > 0) {		    
										    while($row = $result->fetch_assoc()) { ?>
											    			
															<tr>
								                                <td><?php echo $row['clientId']?></td>
								                                <td><kbd class="text-uppercase"><?php echo $row['name']?></kbd></td>
								                                <td><?php echo $row['username']?></td>
								                                <td><?php 
									                                switch($row['mode']){
										                                case 0: echo "Admin";
										                                		break;
										                                case 1: echo"Ventas";
										                                		break; 
									                                	case 2: echo "Producción";
									                                			break;
									                                	case 3: echo "Client";
									                                			break;
									                                }
									                                ?></td>
								                            </tr>
								
								
								
								<?php			    }
											} else {	
															?> 
															
															<tr>
								                                <td>No hay ningún cliente</td>
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
        
 <!-- Modal that configures a Fanbot facebook page -->

<script>
    function callModal() {
		$('#configModal').modal('show');
	}

	function action(){

	        var ajaxurl = 'resources/actionUrl.php';
	        var clientId = $("#clientId").val();
	        var clientName = $( "#clientName" ).val();
	        var clientMail = $( "#clientMail" ).val();
	        var password = $( "#password" ).val();
			var mode = $( "#mode" ).val();
	        data =  {'clientId' : clientId, 'clientName': clientName, 'clientMail' : clientMail, 'password': $.md5(password), 'mode': mode};
	        console.log(data);
	        $.post(ajaxurl, data, function (response) {
	            // Response div goes here.
	            alert(response);
	        });
	    }   
    
</script>

		  <div class="modal fade" id="configModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Agregar usuario</h4>
		        </div>
		        <div class="modal-body">

				<form class="form" action="change_page.php" method="get" id="formUrl">

<!-- Client Id label -->
					  <div class="form-group">
							<label for="clientId" class="control-label">ID </label>
							<input type="number" class="form-control input-sm" id="clientId"  name="clientId" min="1" placeholder="00">
					  </div>

<!-- Client Name label -->
					  <div class="form-group">
							<label for="clientName" class="control-label">Nombre</label>
							<input type="text" class="form-control input-sm" id="clientName" name="clientName" placeholder="Nombre del cliente">
					  </div>

<!-- Client Mail label -->
					  <div class="form-group">
							<label for="clientMail" class="control-label">Correo</label>
							<input type="email" class="form-control input-sm" id="clientMail" name="clientMail" placeholder="Correo del cliente">
					  </div>

<!-- Client Password label -->
					  <div class="form-group">
							<label for="password" class="control-label">Contraseña</label>
							<input  type="password" class="form-control input-sm" id="password" name="password" placeholder="Contraseña de la cuenta">
					  </div>

<!-- Client permisions label -->
					  <div class="form-group">
							<label for="mod" class="control-label">Permisos</label>
							<select class="form-control" id="mode">
					        <option value="0">Admin</option>
					        <option value="1">Ventas</option>
					        <option value="2">Producción</option>
					        <option value="3" selected>Cliente</option>
					      </select>
					  </div>

					  					  					  					  
					  </form>					
		        </div>

			    <div class="modal-footer">
					<button id="cambiarBtn" class="btn btn-primary btn-sm" onclick="action()">Terminar</button>

		        </div>
	      
	      	  </div>
		    </div>
		  </div>


<!-- End modal --> 