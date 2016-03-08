        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <div class="panel-body">
		                <div class="gauge-canvas">
	                        <h4 class="widget-h">Mis Fanbot</h4>
	                    </div>
							<div id="images"></div>
							 
							<script>
							(function() {
							  var flickerAPI = "http://api.flickr.com/services/feeds/photos_public.gne?jsoncallback=?";
							  $.getJSON( flickerAPI, {
							    tags: "mount rainier",
							    tagmode: "any",
							    format: "json"
							  })
							    .done(function( data ) {
							      $.each( data.items, function( i, item ) {
							        $( "<img>" ).attr( "src", item.media.m ).appendTo( "#images" );
							        if ( i === 3 ) {
							          return false;
							        }
							      });
							    });
							})();
							</script>
	                    </div>
                </section>
            </div>
        </div>
 <!-- Modal that configures a Fanbot facebook page -->

    	<?php require_once("listModal.php"); ?>

<!-- End modal --> 