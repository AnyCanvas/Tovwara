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
									if((@include 'resources/phpSpark.class.php') === false)  die("Unable to load phpSpark class");
									if((@include 'resources/phpSpark.config.php') === false)  die("Unable to load phpSpark configuration file");
									// Grab a new instance of our phpSpark object
									$spark = new phpSpark();
									// Set our access token (set in the phpConfig.config.php file)
									$spark->setAccessToken($accessToken);
									// List all the devices on your account
									if($spark->listDevices() == true)
									{
									    $fanbotList = $spark->getResult();
									}
									print_r($fanbotList);
											
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
																			$name = strtolower($row['name']);
																			$key = array_search($name, array_column($fanbotList, "name"));
																			if( $fanbotList[$key]["connected"]){
																				echo ' connected ';
																			} else {
																				echo ' offline ';
																			}
																			//isFanbotOnline($row['accesToken'], $row['deviceId']); 
																		?>
																	</td>
								                                <td>
									                                <a class="btn btn-primary btn-xs" onclick="callModal('<?php echo $row['name']?>')">
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
										$conn->close();
								
									?>									

							
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>
        
 
 <!-- Modal that configures a Fanbot facebook page -->

    	<?php require_once("resources/listModal.php"); ?>

<!-- End modal --> 