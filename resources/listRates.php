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
                                <th>Pregunta</th>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
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
										
//										if($_SESSION['userId'] == '00'){
											$sql = "SELECT * FROM interactions WHERE action = 'rate'";
//										}else {
//											$sql = "SELECT data FROM interactions WHERE action = '". $_SESSION['userId']. "' AND action = 'rate'";
//										}

										$result = $conn->query($sql);
										
										$c = 0;
										if ($result->num_rows > 0) {		    
										    while($row = $result->fetch_assoc()) { 
											    $data = json_decode($row['data'], true);
										    ?>
											    			
															<tr>
								                                <td><?php echo $row['data']?></td>								
								                                <td>0</td>										

								                                <td>0</td>										

								                                <td>0</td>										

								                                <td>0</td>										

								                                <td>0</td>										
								                            </tr>
								
								<?php			$Q[$c] = $data['q'];
												$A[$c*2] = $data['q'];
												$A[($c*2)+1] = $data['a'];
												$c++;
											    	}
											$c = 1;
											$Q = array_unique($Q);    	   	
											foreach ($Q as $Qfor){
												$Atable[$c][1]=0;
												$Atable[$c][2]=0;
												$Atable[$c][3]=0;
												$Atable[$c][4]=0;
												$Atable[$c][5]=0;

												foreach($A as $Afor){
													if($Qfor == $Afor){
														switch($Afor+1){
															case 1:
																$Atable[$c][1]++;
																break;
															case 2:
																$Atable[$c][1]++;
																break;
															case 3:
																$Atable[$c][1]++;
																break;
															case 4:
																$Atable[$c][1]++;
																break;
															case 5:
																$Atable[$c][1]++;
																break;
															
															
														}
													}
												}
												$c++;
											}
											}
										$conn->close();
								
									?>									

							
                            </tbody>
                        </table>
						<p><?php 
								  print_r($Q); ?></p>
						
						<p><?php print_r($A); ?></p>

						<p><?php print_r($Atable); ?></p>

                    </div>
                </section>
            </div>
        </div>