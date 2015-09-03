        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Editor de Fanbot</h4>
	                    </div>
	                    
	                    <div class="btn-add-task col-xs-2">
	                    <div class="btn-add-task col-xs-9">

                        	<button type="submit" class="btn btn-default btn-primary btn-xs"  onclick="callModal()"><i class="fa fa-plus"></i> Agregar</button>
							</div>
                    	</div>
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th class="hidden-phone">Numero de serie</th>
                                <th>Nombre</th>
                                <th>Numero de cliente</th>
                                <th>Particle id</th>

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

											
										$fanbotList = json_decode($output, true);									

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
								                                <td><?php echo $row['deviceId']?></td>
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
        
 <!-- Modal that configures a Fanbot facebook page -->

<script>
    function callModal() {
		$('#configModal').modal('show');
	}

	function addFnbt(){

	        var ajaxurl = 'resources/addFnbt.php';
	        var fanbotId = $("#fanbotId").val();
	        var fanbotName = $( "#fanbotName" ).val();
	        var fanbotClient = $( "#fanbotClient" ).val();
	        var particleId = $( "#particleId" ).val();

	        data =  {'fanbotId' : fanbitId, 'fanbotName': name, 'fanbotClient' : fanbotClient, 'particleId': particleId};
	        alert(data);
	        $.post(ajaxurl, data, function (response) {
	            // Response div goes here.
	            alert("action performed successfully");
	        });
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

<!-- Fanbot Id label -->
					  <div class="form-group">
							<label for="fanbotId" class="control-label">ID</label>
							<input type="text" class="form-control input-sm" id="fanbotId" placeholder="xx-xx-xxx-xxxxx" name="fanbotId">
					  </div>

<!-- Fanbot Name label -->
					  <div class="form-group">
							<label for="fanbotName" class="control-label">Nombre</label>
							<input type="text" class="form-control input-sm" id="fanbotName" placeholder="XXXX" name="fanbotName">
					  </div>

<!-- Fanbot client label -->
					  <div class="form-group">
							<label for="fanbotClient" class="control-label">Cliente</label>
							<input type="text" class="form-control input-sm" id="fanbotClient" name="fanbotClient">
					  </div>

<!-- Fanbot particle ID label -->
					  <div class="form-group">
							<label for="particleId" class="control-label">Particle ID</label>
							<input type="text" class="form-control input-sm" id="particleId" placeholder="ID de particle" name="particleId">
					  </div>
					  					  					  					  
					  </form>					
		        </div>

			    <div class="modal-footer">
					<button id="cambiarBtn" class="btn btn-primary btn-sm" onclick="addFnbt()">Terminar</button>

		        </div>
	      
	      	  </div>
		    </div>
		  </div>


<!-- End modal --> 