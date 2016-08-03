<script>
    function callModal(fanbotName) {
	    localStorage.setItem("fanbotName", fanbotName);
		$('#configModal').modal('show');
	     document.getElementById('fanbotName').value = fanbotName;
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
	        var actionType = $("#action").is(':checked') ? "post" : "like";
	        data =  {'facebookPage' : facebookPage, 'actionType': actionType,'fanbotName': fanbotName, };
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
							<div for="facebookUrl" class="input-group-addon">http://facebook.com/</div>
							<input type="text" class="form-control input-sm" id="facebookPage" placeholder="Link de tu pagina" name="facebookPage">
	    				</div>		
						<a onclick="changeImage()" class="btn btn-default btn-xs">Verificar</a>						

					  </div>
					  <div class="form-group">
						<input class="form-controlinput-sm" type='hidden' id= 'fanbotName' name='fanbotName' value='' />				  
					  </div>
					  <div class="form-group" style="margin-bottom: 2vh;">
							<label class="checkbox-inline">
								<select name="interaccion" form="carform">
								  <option value="0">Like</option>
								  <option value="1">Check-in</option>
								  <option value="2">Encuesta</option>
								</select>
                            </label>
					  </div>

					  <div class="form-group" style="margin-bottom: 2vh;">
                            <label for="inputEmail1" class="control-label">Email</label>
                            <input type="email" class="form-control" id="inputEmail1" placeholder="Email">
                      </div>
					  <div class="form-group" style="margin-bottom: 2vh;">
						<div class="input-group">									  
							<input type="text" class="form-control input-sm" id="q1" placeholder="Q1" name="Q1">
							<input type="text" class="form-control input-sm" id="q2" placeholder="Q2" name="Q2">

	    				</div>		
					  </div>
					  <div class="form-group" style="margin-bottom: 2vh;">
						<div class="input-group">									  
							<input type="text" class="form-control input-sm" id="q3" placeholder="Q3" name="Q3">
							<input type="text" class="form-control input-sm" id="q4" placeholder="Q4" name="Q4">
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
