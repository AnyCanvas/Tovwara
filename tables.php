	<?php 
		include "resources/functions.php"; 
		isLogged();
		
	?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="ThemeBucket">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Usuario</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

    <!--dynamic table-->
    <link href="js/advanced-datatable/css/demo_page.css" rel="stylesheet" />
    <link href="js/advanced-datatable/css/demo_table.css" rel="stylesheet" />
    <link rel="stylesheet" href="js/data-tables/DT_bootstrap.css" />

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
                    <div class="panel-body">
	                <div class="gauge-canvas">
                        <h4 class="widget-h">Acciones de todos los usuarios</h4>
                    </div>

                            <div class="clearfix">
                                <div class="btn-group">
                                </div>
                                <div class="btn-group pull-right">
                                    <button id="editable-sample_new" class="btn btn-primary" onclick="window.exportExcel()">
                                        Descargar
                                    </button>
                                </div>
                			</div>
                <div class="space15"></div>
                    <div class="adv-table">
                    <table  class="table table-striped table-hover table-bordered" id="dynamic-table">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Genero</th>
                        <th>Pagina de Facebook</th>
                        <th>Nombre de la Fanbot</th>
                    </tr>
                    </thead>

                    <tbody>
		    <?php listInteractions() ?>
                    </tbody>

                    <tfoot>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Genero</th>
                        <th>Pagina de Facebook</th>
                        <th>Nombre de la Fanbot</th>
                    </tr>
                    </tfoot>
                    </table>
                    </div>
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

                    <table  class="table table-striped table-hover table-bordered" id="fullTable" style= "display: none;">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Genero</th>
                        <th>Pagina de Facebook</th>
                        <th>Nombre de la Fanbot</th>
                    </tr>
                    </thead>

                    <tbody>
		    <?php listInteractions() ?>
                    </tbody>

                    <tfoot>
                    <tr>
                        <th>Fecha</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Genero</th>
                        <th>Pagina de Facebook</th>
                        <th>Nombre de la Fanbot</th>
                    </tr>
                    </tfoot>
                    </table>
<!-- Placed js at the end of the document so the pages load faster -->

<!--Core js-->
<script src="js/jquery.js"></script>
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

<!--dynamic table-->
<script type="text/javascript" language="javascript" src="js/advanced-datatable/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/data-tables/DT_bootstrap.js"></script>
<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<!--dynamic table initialization -->
<script src="js/dynamic_table_init.js"></script>

<!-- Export table JS -->
<script src="http://alasql.org/console/alasql.min.js"></script>
<script src="http://alasql.org/console/xlsx.core.min.js"></script>

<script>
	window.exportExcel =     function exportExcel() {
        alasql('SELECT * INTO XLSX("usuarios.xlsx",{headers:true}) \
                    FROM HTML("#fullTable",{headers:true})');
    }
</script>

</body>
</html>
