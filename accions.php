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
        <meta name="viewport"
              content="width=device-width, initial-scale=1.0">
        <meta name="description"
              content="">
        <meta name="author"
              content="ThemeBucket">
        <link rel="shortcut icon"
              href="images/favicon.png">
        <title>
            Acciones
        </title><!--Core CSS -->
        <link href="bs3/css/bootstrap.min.css"
              rel="stylesheet"
              type="text/css">
        <link href="css/bootstrap-reset.css"
              rel="stylesheet"
              type="text/css">
        <link href="font-awesome/css/font-awesome.css"
              rel="stylesheet"
              type="text/css"><!-- Data table-->
        <link href="css/datatables/css/dataTables.bootstrap.css"
              rel="stylesheet"
              type="text/css">
        <link href="css/datatables/css/buttons.bootstrap.min.css"
              rel="stylesheet"
              type="text/css"><!-- Custom styles for this template -->
        <link href="css/style.css"
              rel="stylesheet"
              type="text/css">
        <link href="css/style-responsive.css"
              rel="stylesheet"
              type="text/css"><!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
        <section id="container">
            <!-- Header start -->
            <?php require_once("resources/header.php"); ?><!-- Header end -->
            <!-- Left sidebar start -->
            <?php require_once("resources/leftSidebar.php"); ?><!-- Left sidebar end -->
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
                                    <div role="form">
                                        <div class="form-group">
                                            <div class="form-inline">
                                                <div class="form-group">
                                                    <label for="start-date">Rango de fecha:</label> <input type="date"
                                                         class="datepicker"
                                                         id="start-date"><b>/</b> <input type="date"
                                                         class="datepicker"
                                                         id="end-date">
                                                </div>
                                                <div class="form-group">
                                                    <label for="action-type">Tipo de acción:</label> <select class="form-control"
                                                         id="action-type">
                                                        <option value="0">
                                                            Todos
                                                        </option>
                                                        <option value="1">
                                                            Like
                                                        </option>
                                                        <option value="2">
                                                            Check-in
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-inline">
                                            <div class="form-group  pull-right">
                                                <button type="submit"
                                                     class="btn btn-default" id="reloadTable">Buscar</button> <button type="submit"
                                                     class="btn btn-default">Limpiar</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                        <div class="col-sm-12">
                            <section class="panel">
                                <header class="panel-heading">
                                    Tabla de acciones
                                </header>
                                <div class="panel-body">
                                    <table class="table"
                                           id="actionsTable">
                                        <thead>
                                            <tr>
                                                <th>
                                                    Fecha
                                                </th>
                                                <th>
                                                    Hora
                                                </th>
                                                <th>
                                                    ID
                                                </th>
                                                <th>
                                                    Nombre
                                                </th>
                                                <th>
                                                    FB id
                                                </th>
                                                <th>
                                                    Acción
                                                </th>
                                                <th>
                                                    Pagina de Facebook
                                                </th>
                                                <th>
                                                    Fanbot
                                                </th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>
                                                    Fecha
                                                </th>
                                                <th>
                                                    Hora
                                                </th>
                                                <th>
                                                    ID
                                                </th>
                                                <th>
                                                    Nombre
                                                </th>
                                                <th>
                                                    FB id
                                                </th>
                                                <th>
                                                    Acción
                                                </th>
                                                <th>
                                                    Pagina de Facebook
                                                </th>
                                                <th>
                                                    Fanbot
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </section>
                        </div>
                    </div><!-- page end-->
                </section>
            </section><!--main content end-->
            <!-- Right sidebar start-->
            <?php require_once("resources/rightSidebar.php"); ?><!-- Right sidebar end-->
        </section><!-- Placed js at the end of the document so the pages load faster -->
        <!--Core js-->
        <script src="js/jquery.js"
              type="text/javascript">
</script><script src="js/url.js"
              type="text/javascript">
</script><script src="bs3/js/bootstrap.min.js"
              type="text/javascript">
</script><script class="include"
              type="text/javascript"
              src="js/jquery.dcjqaccordion.2.7.js">
</script><script src="js/jquery.scrollTo.min.js"
              type="text/javascript">
</script><script src="js/jQuery-slimScroll-1.3.0/jquery.slimscroll.js"
              type="text/javascript">
</script><script src="js/jquery.nicescroll.js"
              type="text/javascript">
</script><!--Easy Pie Chart-->
        <script src="js/easypiechart/jquery.easypiechart.js"
              type="text/javascript">
</script><!--Sparkline Chart-->
        <script src="js/sparkline/jquery.sparkline.js"
              type="text/javascript">
</script><!--jQuery Flot Chart-->
        <script src="js/flot-chart/jquery.flot.js"
              type="text/javascript">
</script><script src="js/flot-chart/jquery.flot.tooltip.min.js"
              type="text/javascript">
</script><script src="js/flot-chart/jquery.flot.resize.js"
              type="text/javascript">
</script><script src="js/flot-chart/jquery.flot.pie.resize.js"
              type="text/javascript">
</script><!--common script init for all pages-->
        <script src="js/scripts.js"
              type="text/javascript">
</script><!-- Data tables-->
        <script src="css/datatables/js/jquery.dataTables.js"
              type="text/javascript">
</script><script src="css/datatables/js/dataTables.bootstrap.js"
              type="text/javascript">
</script><script src="css/datatables/js/datatables.buttons.min.js"
              type="text/javascript">
</script><script src="css/datatables/js/buttons.bootstrap.min.js"
              type="text/javascript">
</script><script src="css/datatables/js/buttons.html5.min.js"
              type="text/javascript">
</script><script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"
              type="text/javascript">
</script><script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"
              type="text/javascript">
</script><script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"
              type="text/javascript">
</script><script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.html5.min.js"
              type="text/javascript">
</script><script src="https://cdn.datatables.net/buttons/1.0.3/js/buttons.print.min.js"
              type="text/javascript">
</script><script type="text/javascript">
$(document).ready( function () {
		
		function addZero(i) {
		    if (i < 10) {
		        i = "0" + i;
		    }
		    return i;
		}

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
        "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
        "columnDefs": [
            {
                "targets": 0,
                "render": function ( data, type, full, meta ) {
                    date = new Date(data * 1000);
                    sort  = data=="" ? "" : data;
                    display = data=="" ? "" : date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();

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
                "targets": 1,
                "render": function ( data, type, full, meta ) {
                    date = new Date(data * 1000);
                    sort  = data=="" ? "" : data;
                    display = data=="" ? "" : addZero( date.getHours() ) + ':' + addZero( date.getMinutes() );

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
                    return '<a href="https://www.facebook.com/'+ row[4] +'" target="_blank">'+ data +'<\/a>';
                },
                "targets": 3
            },
		    {
		        // The `data` parameter refers to the data for the cell (defined by the
		        // `data` option, which defaults to the column being worked with, in
		        // this case `data: 0`.
		        "render": function ( data, type, row ) {
			        if ( data.indexOf("MMM") != -1){
		            	return "Mobile";				                
			        } else {
		            	return "Classic";				                
			        }
			        
			        return "N/A";
		        },
		        "targets": 7
		    },
            { "visible": false,  "targets": [ 4 ] }
        ],
        });

        $('#start-date, #end-date').on('change', function(){
            $('#end-date').attr('min', $('#start-date').val());
            $('#start-date').attr('max', $('#end-date').val());
        });


		$('#reloadTable').on('click', function () {
			
			var sD = document.getElementById("start-date").value;
			var eD = document.getElementById("end-date").value;
			var iT = document.getElementById("action-type").value;

			$('#actionsTable').DataTable( {
				destroy: true,
		        "ajax": 'json/interactionsTableJson.php?sd=' + sD + '&ed=' + eD + '&it=' + iT,
		        language: {
		                url: 'https://cdn.datatables.net/plug-ins/1.10.9/i18n/Spanish.json'
		            },
		        "pageLength": 50,       
		        dom: 'Bfrtip',
		        buttons: [
		            'csv', 'pdf'
		        ],
		        "order": [[ 0, 'desc' ], [ 1, 'desc' ]],
		        "columnDefs": [
		            {
		                "targets": 0,
		                "render": function ( data, type, full, meta ) {
		                    date = new Date(data * 1000);
		                    sort  = data=="" ? "" : data;
		                    display = data=="" ? "" : date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear();
		
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
		                "targets": 1,
		                "render": function ( data, type, full, meta ) {
		                    date = new Date(data * 1000);
		                    sort  = data=="" ? "" : data;
		                    display = data=="" ? "" : addZero( date.getHours() ) + ':' + addZero( date.getMinutes() );
		
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
		                    return '<a href="https://www.facebook.com/'+ row[4] +'" target="_blank">'+ data +'<\/a>';
		                },
		                "targets": 3
		            },
		            {
		                // The `data` parameter refers to the data for the cell (defined by the
		                // `data` option, which defaults to the column being worked with, in
		                // this case `data: 0`.
		                "render": function ( data, type, row ) {
			                if ( data.indexOf("MMM") != -1){
		                    	return "Mobile";				                
			                } else {
		                    	return "Classic";				                
			                }
			                
			                return "N/A";
		                },
		                "targets": 7
		            },
		            { "visible": false,  "targets": [ 4 ] }
		        ],
			} );
		  });

        });
        </script>
    </body>
</html>
