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
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Mis Fanbot</h4>
	                    </div>
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th class="hidden-phone">Numero de serie</th>
                                <th>Nombre</th>
                                <th>Pagina de Facebook</th>
                                <th>Plan</th>
                                <th>Status</th>
                                <th></th>
                                <th></th>

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
								                                <td><a class="text-primary" target="_blank" href="http://facebook.com/<?php echo $row['fbPage']?>"><?php echo $row['fbPage']?></a></td>

								                                <td><?php 
																	switch ($row['plan']) {
																	    case '00':
																	        echo "AWESOMERANDOM";
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
									                                
								                                ?> </td>
																	<td>
																		
																		<?php 
																			$id = $row['deviceId'];
																			$key = array_search($id, array_column($fanbotList, "id"));
																			if( $fanbotList[$key]["connected"]){
																				echo $row['deviceId']. ' connected ';
																			} else {
																				echo ' offline ';
																			}
																			//isFanbotOnline($row['accesToken'], $row['deviceId']); 
																		?>
																	</td>
									                                <a class="btn btn-primary btn-xs" onclick="callModal('<?php echo $row['name']?>')">
										                                <span class="fa fa-cog" aria-hidden="true"></span> Configurar
										                                </a>
									                                </td>
									                                <td>
									                                <a class="btn btn-primary btn-xs" onclick="fnbtAction('<?php echo $row['name']?>')">
										                                <span class="fa fa-cog" aria-hidden="true"></span> Activar
										                                </a>
									                                </td>								
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