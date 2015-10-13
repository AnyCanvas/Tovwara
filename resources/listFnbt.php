        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Mis Fanbot</h4>
	                    </div>
                        <table id="fanbotTable" class="table">
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
										
										if($_SESSION['userId'] == '00'){
											$sql = "SELECT * FROM fanbot";
										}else {
											$sql = "SELECT * FROM fanbot WHERE clientId = '". $_SESSION['userId']. "'";
										}

										$result = $conn->query($sql);
										
										if ($result->num_rows > 0) {		    
										    while($row = $result->fetch_assoc()) { 
											    $config = json_decode($row['config']);
										    ?>
											    			
															<tr>
								                                <td><?php echo $row['id']?></td>
								                                <td><kbd class="text-uppercase"><?php echo $row['name']?></kbd></td>
								                                <td><a class="text-primary" target="_blank" href="http://facebook.com/<?php echo $config['link'];?>"><?php echo $config['link'];?></a></td>

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
																			echo '<span class="label label-mini ';

																			$id = $row['deviceId'];
																			$key = array_search($id, array_column($fanbotList, "id"));
																			if( $fanbotList[$key]["connected"]){
																				echo 'label-success"><span class="fa fa-circle" aria-hidden="true">';
																			} else {
																				echo 'label-default"><span class="fa fa-circle-o" aria-hidden="true">';
																			}
																			if( $fanbotList[$key]["connected"]){
																				echo ' Conectada';
																			} else {
																				echo ' Desconectada';
																	
																			}
																			echo '</span>';
																		?>
																	</td>
																	<td>
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
            alert(response);
        });
    }
</script> 
 <!-- Modal that configures a Fanbot facebook page -->

    	<?php require_once("listModal.php"); ?>

<!-- End modal --> 