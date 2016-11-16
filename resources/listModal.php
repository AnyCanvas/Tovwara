<script>
    function callModal(fanbotName) {
	    localStorage.setItem("fanbotName", fanbotName);
		$('#configModal').modal('show');
	     document.getElementById('fanbotName').value = fanbotName;

		$( "select" ).change(function() {
		  if( $( this ).val() == '2' ){
			  $("#questions").show();
		  } else{
			  $("#questions").hide();			  
		  }
		});
	}

    function callPrice(fanbotName) {
	    localStorage.setItem("fanbotName", fanbotName);
		$('#priceModal').modal('show');
	     document.getElementById('fanbotName').value = fanbotName;

		$( "select" ).change(function() {
		  if( $( this ).val() == '2' ){
			  $("#questions").show();
		  } else{
			  $("#questions").hide();			  
		  }
		});
	}
    function changeImage() {
        image_url = "https://graph.facebook.com/"+ document.getElementById('facebookPage').value +"/picture";
	    $.get(image_url)
		.done(function() { 
		// Do something now you know the image exists.
            document.getElementById("fbImg").src = image_url;
            $('#modalAlert').hide();
			$('#cambiarBtn').prop('disabled', false);

    	}).fail(function() { 
            $('#modalAlert').show();
			$('#cambiarBtn').prop('disabled', true);

        // Image doesn't exist - do something else.
    })

    } 
	   
	function action(){

	        var ajaxurl = 'resources/actionUrl.php';
	        var facebookPage = $("#facebookPage").val();
	        var fanbotName = $( "#fanbotName" ).val();
	        var actionType = $( "#accion" ).val();
	        data =  {'facebookPage' : facebookPage, 'actionType': actionType,'fanbotName': fanbotName, };
	        if(actionType == '2'){
   	          data =  {'facebookPage' : facebookPage, 'actionType': actionType,'fanbotName': fanbotName, 'q1' : encodeURIComponent( $( "#q1" ).val() ), 'q2': encodeURIComponent( $( "#q2" ).val() ), 'q3': encodeURIComponent( $( "#q3" ).val() ), 'q4': encodeURIComponent( $( "#q4" ).val() )};		    		        
	        } else {
   	          data =  {'facebookPage' : facebookPage, 'actionType': actionType,'fanbotName': fanbotName };		    
	        }
	        console.log(data);	        
	        $.post(ajaxurl, data, function (response) {
	        });
			$('#configModal').modal('hide');
			location.reload();

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
					<form class="form-inline" id="formUrl">
					  <div class="form-group" style="margin-bottom: 2vh;">
						<div class="input-group">									  
							<div for="facebookUrl" class="input-group-addon">https://facebook.com/</div>
							<input type="text" class="form-control input-sm" id="facebookPage" placeholder="Link de tu pagina" name="facebookPage">
	    				</div>		
						<a onclick="changeImage()" class="btn btn-default btn-xs">Verificar</a>						

					  </div>
					  <div class="form-group">
						<input class="form-controlinput-sm" type='hidden' id= 'fanbotName' name='fanbotName' value='' />				  
					  </div>
					  <div class="form-group" style="margin-bottom: 2vh;">
							<label class="checkbox-inline">
								<select name="interaccion" id="accion">
								  <option value="0">Check-in</option>
								  <option value="1">Like y Check-in</option>
								  <option value="2">Encuesta</option>
								</select>
                            </label>
					  </div>
					  
					  <div id="questions" style="display: none;">
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ1" class="control-label">1ª pregunta:</label>
	                            <input type="text" class="form-control" id="q1">
	                      </div>
	
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ2" class="control-label">2ª pregunta:</label>
	                            <input type="text" class="form-control" id="q2">
	                      </div>
	
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ3" class="control-label">3ª pregunta:</label>
	                            <input type="text" class="form-control" id="q3" >
	                      </div>                      
	
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ4" class="control-label">4ª pregunta:</label>
	                            <input type="text" class="form-control" id="q4">
	                      </div>
					  </div>

					</form>					
		        </div>

			    <div class="modal-footer">
				    <div class="center-block">
			            <p style="text-align: center;">Aquí aparecerá la imagen de tu pagina.</p>	            
						<img id="fbImg" src="https://graph.facebook.com/fanbotme/picture" class="img-responsive img-thumbnail center-block" alt="Cinque Terre">
					</div>
					<div id="modalAlert" class="alert alert-danger fade-in text-center" style="display: none; margin: 5px;">
					  <strong>La pagina de Facebook escrita no existe. </strong> 
					</div>
					<p>
					<button onclick="action()" id="cambiarBtn" class="btn btn-primary btn-sm" disabled="disabled">Cambiar</button>
					</p>
		        </div>
		      
	      	  </div>
		    </div>
		  </div>


		  <div class="modal fade" id="priceModal" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Configura tu Fanbot</h4>
		        </div>
		        <div class="modal-body">
					<form class="form-inline" id="formUrl">					  
					  <div id="prices">
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ1" class="control-label">1º premio:</label>
	                            <input type="text" class="form-control" id="p1">
	                      </div>
	
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ2" class="control-label">2º premio:</label>
	                            <input type="text" class="form-control" id="p2">
	                      </div>
	
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ3" class="control-label">3º premio:</label>
	                            <input type="text" class="form-control" id="p3" >
	                      </div>                      
	
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ4" class="control-label">4º premio:</label>
	                            <input type="text" class="form-control" id="p4">
	                      </div>
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ1" class="control-label">5º premio::</label>
	                            <input type="text" class="form-control" id="p5">
	                      </div>
	
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ2" class="control-label">6º premio:</label>
	                            <input type="text" class="form-control" id="p6">
	                      </div>
	
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ3" class="control-label">7º premio:</label>
	                            <input type="text" class="form-control" id="p7" >
	                      </div>                      
	
						  <div class="form-group" style="margin-bottom: 2vh;">
	                            <label for="inputQ4" class="control-label">8º premio:</label>
	                            <input type="text" class="form-control" id="p8">
	                      </div>
					  </div>

					</form>					
		        </div>

			    <div class="modal-footer">
				    <div class="center-block">
					<p>
					<button onclick="action()" id="cambiarBtn" class="btn btn-primary btn-sm" disabled="disabled">Cambiar</button>
					</p>
		        </div>
		      
	      	  </div>
		    </div>
		  </div>
