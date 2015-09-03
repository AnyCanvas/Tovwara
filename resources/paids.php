        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Editor de pagos</h4>
	                    </div>
	                    
                        <table class="table  table-hover general-table">
                            <thead>
                            <tr>
                                <th class="hidden-phone">Numero de serie</th>
                                <th>Nombre</th>
                                <th>Numero de cliente</th>
                                <th>Plan</th>
                                <th>Credito</th>
                                <th>Fecha de corte</th>
                                <th>Mes gratis</th>
                                <th>Pagado</th>
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
								                                <td><?php echo $row['clientId']?></td>
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

<!-- Fanbot plan label -->
					  <div class="form-group">
							<label class="control-label">Plan</label>
							<select name="fanbotPlan" class="form-control">
							  <option>Basic</option>
							  <option>Pro</option>
							  <option>Premium</option>
							  <option>Asombrandom</option>
							</select>
					  </div>

<!-- Fanbot court date -->
					  <div class="form-group">
							<label for="courtDate">Select list (select one):</label>
							<select class="form-control" id="courtDate">
					        <option>1</option>
					        <option>2</option>
					        <option>3</option>
					        <option>4</option>
					        <option>5</option>
					        <option>6</option>
					        <option>7</option>
					        <option>8</option>
					        <option>9</option>
					        <option>10</option>
					        <option>11</option>
					        <option>12</option>
					        <option>13</option>
					        <option>14</option>
					        <option>15</option>
					        <option>16</option>
					        <option>17</option>
					        <option>18</option>
					        <option>19</option>
					        <option>20</option>
					        <option>21</option>
					        <option>22</option>
					        <option>23</option>
					        <option>24</option>
					        <option>25</option>
					        <option>26</option>
					        <option>27</option>
					        <option>28</option>
					        <option>29</option>
					        <option>30</option>
					        <option>31</option>
					      </select>
					  </div>

<!-- Fanbot free month -->
					  <div class="form-group">
							<label class="control-label">Mes gratis: </label>
							<input  type="checkbox" name="freeMonth" value="1"><br>
					  </div>

<!-- Fanbot paid status -->
					  <div class="form-group">
							<label class="control-label">Estado de pago: </label>

							 <label class="radio-inline">
								  <input type="radio" name="paidStatus" id="paidStatus1" value="1"> Pagado
							</label>
							<label class="radio-inline">
								 <input type="radio" name="paidStatus" id="paidStatus2" value="0"> Vencido
							</label>
					  
					  </div>
					  					  					  
					  <div class="form-group">
						<input class="form-controlinput-sm" type='hidden' id= 'hiddenField' name='name' value='' />				  
					  </div>

					  </form>					
		        </div>

			    <div class="modal-footer">
					<button type="submit" id="cambiarBtn" class="btn btn-primary btn-sm" >Cambiar</button>

		        </div>
		      
	      	  </div>
		    </div>
		  </div>


<!-- End modal --> 