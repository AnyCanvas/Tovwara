<?php 
	include "resources/functions.php"; 
	if (!isLogged()){
		header('Location: ./login.php');
		exit;
	}			
		
?> 

<!DOCTYPE html>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /><head>
    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Fanbot">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Fanbot dashboard</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="css/c3/c3.css" rel="stylesheet" type="text/css">	
    
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

       <div class="row">
           <div class="col-sm-6">
               <section class="panel">
                   <header class="panel-heading">
                       Acciones
                   <span class="tools pull-right">
                       <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                   </header>
                   <div class="panel-body">
                       <div class="chart">
                         <div id="chart2"></div>
                       </div>
                   </div>
               </section>
           </div>
           <div class="col-sm-6">
               <section class="panel">
                   <header class="panel-heading">
                       Totales
                   <span class="tools pull-right">
                       <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                   </header>
                   <div class="panel-body">


                       <div class="chart">
                         <div id="chart3"></div>
                       </div>

                   </div>
               </section>
           </div>
        </div>

        <!-- page start-->

		<?php require_once("resources/listRates.php"); ?>

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

<script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="js/c3/c3.js"></script>
<!--common script init for all pages-->
<script src="js/scripts.js"></script>

<!-- Data tables-->
<script src="css/datatables/js/jquery.dataTables.js"></script>
<script src="css/datatables/js/dataTables.bootstrap.js"></script>

<script>

$(function () {

      var chart2 = c3.generate({
	  	bindto: '#chart2',
        data: {
          url: 'json/rateJson.php',
          mimeType: 'json',
          type : 'pie',
          hide: ['Total'],
        },
        legend: {
	       hide: ['Total'],
	    },
      });

      var chart3 = c3.generate({
	  	bindto: '#chart3',
        data: {
          url: 'json/rateJson.php',
          mimeType: 'json',
          type : 'bar',
        },
		tooltip: {
		  format: {
		    title: function (x) { return 'Totales'; }
		  }
		},
	    axis: {
	        x: {
	            type: 'category',
	            categories: ['Totales']
	        }
	    },
      });
});

$(document).ready( function () {

    $('#fanbotTable').DataTable({
	language: {
	        url: 'https://cdn.datatables.net/plug-ins/1.10.9/i18n/Spanish.json'
	    }	    
    });
} );
</script>
</body>
</html>
