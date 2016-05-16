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
								                                <td><a href="specialStats.php?fnbtId=<?php echo $row['id']?>" target="_blank"><?php echo $row['id']?></a></td>
								                                <td><kbd class="text-uppercase"><?php echo $row['name']?></kbd></td>
								                                <td><?php echo $row['clientId']?></td>
								                                <td><?php echo $row['deviceId']?></td>
																<td>
									                            <a class="btn btn-primary btn-xs" onclick="callInteractionModal('<?php echo $row['id']?>')">
										                            <span class="fa fa-cog" aria-hidden="true"></span> Configurar
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

    function callInteractionModal(id) {
	    globalFnbtId = id;
		$('#actionModal').modal('show');
	}

	function addFnbt(){

	        var ajaxurl = 'resources/actionUrl.php';
	        var fanbotId = $("#fanbotId").val();
	        var fanbotName = $( "#fanbotName" ).val();
	        var fanbotClient = $( "#fanbotClient" ).val();
	        var particleId = $( "#particleId" ).val();

	        data =  {'fanbotId' : fanbotId, 'fanbotName': fanbotName, 'fanbotClient' : fanbotClient, 'particleId': particleId};
	        console.log(data);
	        $.post(ajaxurl, data, function (response) {
	            // Response div goes here.
	            console.log(response);
	        });
			$('#configModal').modal('hide');
	    }   

	function actionsNumber(id){

	        var ajaxurl = 'json/monthTotalJson.php';
	        var startDate = $( "#startDate" ).val();

	        data =  {'fanbotId' : globalFnbtId, 'startDate': startDate};
	        console.log(data);
	        $.post(ajaxurl, data, function (response) {
	            // Response div goes here.
	            console.log(response);
	        });
			$('#configModal').modal('hide');
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
							<select class="form-control" id="fanbotClient" name="fanbotClient">
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
										    while($row = $result->fetch_assoc()) {	
												echo '<option value="'. $row['clientId'] . ' ">'.  $row['name'] . '</option>';
											}
										}
										$conn->close(); 
?>

							</select>
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


		  <div class="modal fade" id="actionModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Numero de interacciones</h4>
		        </div>
		        <div class="modal-body">

				<form class="form" action="change_page.php" method="get" id="formUrl">
					 Fecha:
					  <input type="date" name="startDate" id="startDate">			  					  					  
		  					  					  
			    </form>					
		        </div>

			    <div class="modal-footer">
					<button id="cambiarBtn" class="btn btn-primary btn-sm" onclick="actionsNumber()">Terminar</button>

		        </div>
	      
	      	  </div>
		    </div>
		  </div>


<!-- End modal --> 