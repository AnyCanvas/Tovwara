<!-- Header start -->

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

    <title>Fanbot dashboard</title>

    <!--Core CSS -->
    <link href="bs3/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-reset.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet" />

    
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

    <script type="text/javascript">
		new Morris.Area({
		  // ID of the element in which to draw the chart.
		  element: 'likes',
		  // Chart data records -- each entry in this array corresponds to a point on
		  // the chart.
		  data: [
		    { day: '1', value: 100 },
		    { day: '2', value: 120 },
		    { day: '3', value: 155 },
		    { day: '4', value: 255 },
		    { day: '5', value: 100 },
		    { day: '6', value: 150 },
		    { day: '7', value: 130 },
		    { day: '8', value: 100 },
		    { day: '9', value: 156 },
		    { day: '10', value: 103 },
		    { day: '11', value: 120 },
		    { day: '12', value: 110 },
		    { day: '13', value: 154 },
		    { day: '14', value: 155 },
		    { day: '15', value: 180 },
		    { day: '16', value: 120 },
		    { day: '17', value: 190 },
		    { day: '18', value: 110 },
		    { day: '19', value: 125 },
		    { day: '20', value: 120 },
		    { day: '21', value: 220 },
		    { day: '22', value: 110 },
		    { day: '23', value: 155 },
		    { day: '24', value: 150 },
		    { day: '25', value: 180 },
		    { day: '26', value: 120 },
		    { day: '27', value: 180 },
		    { day: '28', value: 100 },
		    { day: '29', value: 145 },
		    { day: '30', value: 120 },
		    { day: '31', value: 190 }

		  ],
		  // The name of the data record attribute that contains x-values.
		  xkey: 'day',
		  // A list of names of data record attributes that contain y-values.
		  ykeys: ['value'],
		  // Labels for the ykeys -- will be displayed when you hover over the
		  // chart.
		  labels: ['Likes'],
		  smooth: true,
		  parseTime: false,

		});
    </script>


</body>
</html>
