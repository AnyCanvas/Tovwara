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
								                                <td><?php echo $row['id']?></td>
								                                <td><kbd class="text-uppercase"><?php echo $row['name']?></kbd></td>
								                                <td><?php echo $row['clientId']?></td>
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
									                                ?></td>
								                                <td><?php echo $row['credit']?> Acciones</td>
								                                <td><?php echo $row['courtDate']?> de cada mes</td>
																<td><?php 
																	switch($row['freeMonth']){ 
																		case 0: echo "No";
																	 		break;	
																		case 1: echo "Si";
																	 		break;	
																	}																	
																	?></td>
																<td><?php 
																	switch($row['estatus']){ 
																		case 0: echo "Vencido";
																	 		break;	
																		case 1: echo "Pagado";
																	 		break;	
																	}
																	?></td>
																	<td>
									                                <a class="btn btn-primary btn-xs" onclick="callModal('<?php echo $row['name']. ",". $row['plan']. ",". $row['courtDate']. ",". $row['freeMonth']. ",". $row['estatus'];?>')">
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
function fnbtAction(){
        var ajaxurl = 'resources/activateFnbt.php';
		var fanbotPlan = $("#fanbotPlan").val();
	    var courtDate = $( "#courtDate" ).val();
	    var freeMonth = $( "#freeMonth" ).val();
	    var paidStatus = $('input[name="paidStatus"]:checked').val();
	    var name = localStorage.getItem("fanbotName");
        data =  {'name': name, 'fanbotPlan' : fanbotPlan, 'courtDate': courtDate, 'freeMonth': freeMonth, 'paidStatus': paidStatus};
		console.log (data);
        $.post(ajaxurl, data, function (response) {
            // Response div goes here.
            alert("action performed successfully");
        });
    }

    function callModal(fanbotName,plan,courtDate,freeMonth,estatus) {
	    localStorage.setItem("fanbotName", fanbotName);
		$('#configModal').modal('show');
	     document.getElementById('hiddenField').value = fanbotName;
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
							<select name="fanbotPlan" id="fanbotPlan" class="form-control">
							  <option value="1" selected>Basic</option>
							  <option value="2">Pro</option>
							  <option value="3">Premium</option>
							  <option value="0">Asombrandom</option>
							</select>
					  </div>

<!-- Fanbot court date -->
					  <div class="form-group">
							<label for="courtDate">Dia de corte:</label>
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
							<label for="freeMonth" class="control-label">Mes gratis: </label>
							<input  type="checkbox" id="freeMonth" name="freeMonth" value="1"><br>
					  </div>

<!-- Fanbot paid status -->
					  <div class="form-group">
							<label class="control-label">Estado de pago: </label>

							 <label class="radio-inline">
								  <input type="radio" name="paidStatus" id="paidStatus1"> Pagado
							</label>
							<label class="radio-inline">
								 <input type="radio" name="paidStatus" id="paidStatus2"> Vencido
							</label>
					  
					  </div>
					  					  					  
					  <div class="form-group">
						<input class="form-controlinput-sm" type='hidden' id= 'hiddenField' name='name' value='' />				  
					  </div>

					  </form>					
		        </div>

			    <div class="modal-footer">
					<button id="cambiarBtn" class="btn btn-primary btn-sm" onclick="fnbtAction()">Cambiar</button>

		        </div>
		      
	      	  </div>
		    </div>
		  </div>


<!-- End modal --> 