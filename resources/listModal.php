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
	        var actionType = $("#ans").is(':checked') "like" : "post";


	        data =  {'facebookPage' : facebookPage, 'actionType': actionType,'fanbotName': fanbotName, };
	        console.log(data);
	        $.post(ajaxurl, data, function (response) {
	            // Response div goes here.
	            alert(response);
	        });
			$('#configModal').modal('hide');

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
					  <div class="form-group">
						<div class="input-group">									  
							<div for="facebookUrl" class="input-group-addon">http://facebook.com/</div>
							<input type="text" class="form-control input-sm" id="facebookPage" placeholder="Link de tu pagina" name="facebookPage">
	    				</div>		
					  </div>
					  <div class="form-group">
						<input class="form-controlinput-sm" type='hidden' id= 'fanbotName' name='fanbotName' value='' />				  
					  </div>
					  <div class="form-group">
							<label class="checkbox-inline">
                                <input type="checkbox" id="action" value="1"> Check-in
                            </label>
					  </div>
					  <a onclick="changeImage()" class="btn btn-default btn-xs">Verificar</a>						
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
