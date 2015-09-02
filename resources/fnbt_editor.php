        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Editor de Fanbot</h4>
	                    </div>
	                    <div class="btn-add-task col-xs-2">
	                    <div class="btn-add-task col-xs-4">

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

    	<?php require_once("listModal.php"); ?>

<!-- End modal --> 