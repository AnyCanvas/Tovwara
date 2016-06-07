<?php 
	include "resources/functions.php"; 
	if (!isLogged()){
		header('Location: ./login.php');
		exit;
	}  
  ?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Acciones</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

	<!-- Data table-->
	<link href="css/datatables/css/dataTables.bootstrap.css" rel="stylesheet" />	
	<link href="css/datatables/css/buttons.bootstrap.min.css" rel="stylesheet" />	

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/style-responsive.css" rel="stylesheet" />

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<section id="container" >

<!-- Header start -->

	<?php require_once("resources/header.php"); ?>

<!-- Header end -->


<!-- Left sidebar start -->

	<?php require_once("resources/leftSidebar.php"); ?>

<!-- Left sidebar end -->


<!--main content start-->
    <section id="main-content">
        <section class="wrapper">
        <!-- page start-->
			<div class="row">
				
	            <div class="col-sm-12">
	                <section class="panel">
	                    <header class="panel-heading">
							Filtrar
	                    </header>
	                    <div class="panel-body">

							<form role="form">
							  <div class="form-group">
								<div class="form-inline">
								  <div class="form-group">
								    <label for="start-date">Rango de fecha:</label>
								    <input type="date" class="datepicker" id="start-date"><b><h1>/</h1></b>
								    <input type="date" class="datepicker" id="end-date">
								  </div>

    						      <div class="form-group">
									<label for="sel1">Tipo de acción:</label>
									  <select class="form-control" id="sel1">
									    <option>Todos</option>
									    <option>Like</option>
									    <option>Check-in</option>
									  </select>
    							  </div>
							    </div>
							  </div>  

						      <div class="form-inline">
      						    <div class="form-group">

    							  <button type="submit" class="btn btn-default">Buscar</button>
    						 	  <button type="submit" class="btn btn-default">Limpiar</button>
      						    </div>
						      </div>

							</form>	                    

	                    </div>
	                </section>
	            </div>

	            <div class="col-sm-12">
	                <section class="panel">
	                    <header class="panel-heading">
							Tabla de acciones
	                    </header>
	                    <div class="panel-body">
	                    <table  class="table" id="actionsTable">
	                    <thead>
	                    <tr>
	                        <th>Fecha</th>
	                        <th>Hora</th>
	                        <th>ID</th>
	                        <th>Nombre</th>
	                        <th>FB id</th>
	                        <th>Acción</th>
	                        <th>Pagina de Facebook</th>
	                        <th>Fanbot</th>
	                    </tr>
	                    </thead>
	
	                    <tbody>			
			            </tbody>
	
	                    <tfoot>
	                    <tr>
	                        <th>Fecha</th>
	                        <th>Hora</th>
	                        <th>ID</th>
	                        <th>Nombre</th>
	                        <th>FB id</th>
	                        <th>Acción</th>
	                        <th>Pagina de Facebook</th>
	                        <th>Fanbot</th>
	                    </tr>
	                    </tfoot>
	                    </table>
	                    </div>
	                </section>
	            </div>
	        </div>
        <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    
<!-- Right sidebar start-->

	<?php require_once("resources/rightSidebar.php"); ?>

<!-- Right sidebar end-->

</section>
<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script src="js/jquery.js"></script>
<script src="js/url.js"></script>
<script src="bs3/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
<script src="js/jquery.scrollTo.min.js"></script>
<script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"></script>
<script src="js/jquery.nicescroll.js"></script>
<!--Easy Pie Chart-->
<script src="js/easypiechart/jquery.easypiechart.js"></script>
<!--Sparkline Chart-->
<script src="js/sparkline/jquery.sparkline.js"></script>
<!--jQuery Flot Chart-->
<script src="js/flot-chart/jquery.flot.js"></script>
<script src="js/flot-chart/jquery.flot.tooltip.min.js"></script>
<script src="js/flot-chart/jquery.flot.resize.js"></script>
<script src="js/flot-chart/jquery.flot.pie.resize.js"></script>

<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<!-- Data tables-->
<script src="css/datatables/js/jquery.dataTables.js"></script>
<script src="css/datatables/js/dataTables.bootstrap.js"></script>
<script src="css/datatables/js/datatables.buttons.min.js"></script>
<script src="css/datatables/js/buttons.bootstrap.min.js"></script>
<script src="css/datatables/js/buttons.html5.min.js"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
<script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
<script src="http://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
<script src="http://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"></script>
<script src="http://cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"></script>


<script>
	$(document).ready( function () {
	    
	var table = $('#actionsTable').DataTable({
		"ajax": 'json/interactionsTableJson.php',
		language: {
		        url: 'https://cdn.datatables.net/plug-ins/1.10.9/i18n/Spanish.json'
		    },
		"pageLength": 50,		
		dom: 'Bfrtip',
	    buttons: [
	        'csv', 'pdf'
	    ],
	    "order": [[ 0, 'asc' ], [ 1, 'asc' ]],
        "columnDefs": [
            {
	            "targets": 0,
				"render": function ( data, type, full, meta ) {
					date = new Date(data * 1000);
				    sort  = data=="" ? "" : data;
				    display = data=="" ? "" : date.getDay() + '/' + date.getMonth() + '/' + date.getFullYear();

				    if (type === 'display') {
				        return display;
				      }
				      else if (type === 'sort') {
				        return sort;
				      }
				      // 'sort', 'type' and undefined all just use the integer
				      return display;
			    }
            },
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    return '<a href="http://www.facebook.com/'+ row[4] +'" target="_blank">'+ data +'</a>';
                },
                "targets": 3
            },
            { "visible": false,  "targets": [ 4 ] }
        ],
		});

		$('#start-date, #end-date').on('change', function(){
		    $('#end-date').attr('min', $('#start-date').val());
		});

	});
</script>

</body>
</html>
