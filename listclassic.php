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
    <meta name="author" content="Fanbot">
    <link rel="shortcut icon" href="images/favicon.png">

    <title>Fanbot dashboard</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
	<link href="css/datatables/css/dataTables.bootstrap.css" rel="stylesheet" />	
    
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

		<?php require_once("resources/listFnbtCs.php"); ?>

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

<!--Morris Chart-->
<script src="js/morris-chart/morris.js"></script>
<script src="js/morris-chart/raphael-min.js"></script>
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

<script>
	$(document).ready( function () {

		function addZero(i) {
		    if (i < 10) {
		        i = "0" + i;
		    }
		    return i;
		}

    $('#fanbotTable').DataTable({
        "order": [[ 5, 'desc' ], [ 1, 'desc' ]],
    "columnDefs": [
        {
            "targets": 5,
            "render": function ( data, type, full, meta ) {
                date = new Date(data * 1000);
                sort  = data=="" ? "" : data;
                display = data=="" ? "" : date.getDate() + '/' + (date.getMonth() + 1) + '/' + date.getFullYear() + ' ' + addZero( date.getHours() ) + ':' + addZero( date.getMinutes() );
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
	],
	language: {
	        url: 'https://cdn.datatables.net/plug-ins/1.10.9/i18n/Spanish.json'
	    }	    
    });
} );
</script>

</body>
</html>
