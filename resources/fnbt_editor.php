        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Editor de Fanbot</h4>
	                    </div>
	                    <div class="btn-add-task col-xs-2">
	                    <div class="btn-add-task col-xs-9">

                        	<button type="submit" class="btn btn-default btn-primary btn-xs"><i class="fa fa-plus"></i>Agregar Fanbot</button>
							</div>
                    	</div>
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th class="hidden-phone">Numero de serie</th>
                                <th>Nombre</th>
                                <th>Numero de cliente</th>
                                <th>Particle id</th>
                                <th>Plan</th>
                                <th>Credito</th>
                                <th>Fecha de corte</th>
                                <th>Mes gratis</th>
                                <th>Pagado</th>

                            </tr>
                            </thead>
                            <tbody>

								<?php
										$ch = curl_init("https://api.particle.io/v1/devices/?access_token=8f143ea31dd63ec40437558c3d352b560a2dfcd4");
										curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
										curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
										$output = curl_exec($ch);
										curl_close($ch);
										
									
									
										$fanbotList = json_decode($output, true);									

											
										$servername="localhost"; // Host name 
										$username="Dev"; // Mysql username 
										$password="\"TRFBMIsCWh{19"; // Mysql password 
										$dbname="fanbot_db"; // Database name 
								
										
											
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
								                                <td><?php echo $row['deviceId']?></td>
								                                <td><?php echo $row['plan']?></td>
								                                <td><?php echo $row['credit']?></td>
								                                <td><?php echo $row['courtDate']?></td>
								                                <td><?php echo $row['paid']?></td>
																<td><?php echo 'TBA';?></td>
																	<td>
									                                <a class="btn btn-primary btn-xs" onclick="callModal('<?php echo $row['name']?>')">
										                                <span class="fa fa-cog" aria-hidden="true"></span> Editar
										                                </a>
									                                </td>
									                                <td>							
								                            </tr>
								
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
function fnbtAction(name){
        var ajaxurl = 'resources/activateFnbt.php',
        data =  {'name': name};
        $.post(ajaxurl, data, function (response) {
            // Response div goes here.
            alert("action performed successfully");
        });
    }
</script> 
 <!-- Modal that configures a Fanbot facebook page -->

<script>
    function callModal(fanbotName) {
	    localStorage.setItem("fanbotName", fanbotName);
		$('#configModal').modal('show');
	     document.getElementById('hiddenField').value = fanbotName;
	}

    function changeImage() {
        image_url = "https://graph.facebook.com/"+ document.getElementById('facebookUrl').value +"/picture";
	    $.get(image_url)
		.done(function() { 
		// Do something now you know the image exists.
            document.getElementById("fbImg").src = image_url;
            $('#modalAlert').hide()
			$('#cambiarBtn').prop('disabled', false);

    	}).fail(function() { 
            $('#modalAlert').show()
			$('#cambiarBtn').prop('disabled', true);

        // Image doesn't exist - do something else.
    })

    }
    

	  function mySubmit() {
	     document.getElementById("myForm").submit();
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
<! Fanbot Id label ->
					  <div class="form-group">
							<label for="fanbotId" class="control-label">ID</label>
							<input type="text" class="form-control input-sm" id="fanbotId" placeholder="xx-xx-xxx-xxxxx" name="fanbotId">
					  </div>

<! Fanbot Name label ->
					  <div class="form-group">
							<label for="fanbotName" class="control-label">Nombre</label>
							<input type="text" class="form-control input-sm" id="fanbotName" placeholder="XXXX" name="fanbotName">
					  </div>

<! Fanbot client label ->
					  <div class="form-group">
							<label for="fanbotClient" class="control-label">Cliente</label>
							<input type="text" class="form-control input-sm" id="fanbotClient" name="fanbotClient">
					  </div>

<! Fanbot particle ID label ->
					  <div class="form-group">
							<label for="particleId" class="control-label">Particle ID</label>
							<input type="text" class="form-control input-sm" id="particleId" placeholder="ID de particle" name="particleId">
					  </div>

<! Fanbot plan label ->
					  <div class="form-group">
							<label for="fanbotPlan" class="control-label">Plan</label>
							<input type="text" class="form-control input-sm" id="fanbotPlan" name="fanbotPlan">
					  </div>

<! Fanbot court date ->
					  <div class="form-group">
							<label for="courtDate" class="control-label">Fecha de corte</label>
							<input type="text" class="form-control input-sm" id="courtDate" name="courtDate">
					  </div>

<! Fanbot free month ->
					  <div class="form-group">
							<label for="freeMonth" class="control-label">Mes gratis</label>
							<input type="text" class="form-control input-sm" id="freeMonth" name="freeMonth">
					  </div>

<! Fanbot paid status ->
					  <div class="form-group">
							<label for="paidStatus" class="control-label">Estado de pago</label>

<div class="has-switch" tabindex="0"><div class="switch-animate switch-on"><span class="switch-left">ON</span><label>&nbsp;</label><span class="switch-right">OFF</span><input type="checkbox" checked=""></div></div>

					  </div>
					  					  					  
					  <div class="form-group">
						<input class="form-controlinput-sm" type='hidden' id= 'hiddenField' name='name' value='' />				  
					  </div>
			
		        </div>

			    <div class="modal-footer">
					<button type="submit" id="cambiarBtn" class="btn btn-primary btn-sm" >Cambiar</button>
					</form>		
		        </div>
		      
	      	  </div>
		    </div>
		  </div>


<!-- End modal --> 