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
										
										if ($result->num_rows > 0) {		    
										    while($row = $result->fetch_assoc()) { 
											    $config = json_decode($row["config"], true);
										    ?>
											    			
															<tr>
								                                <td><kbd class="text-uppercase"><?php echo $row['data']?></kbd></td>								
								                                <td>0</td>										

								                                <td>0</td>										

								                                <td>0</td>										

								                                <td>0</td>										

								                                <td>0</td>										
								                            </tr>
								
								
								<?php			    }
											}
										$conn->close();
								
									?>									

							
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        </div>