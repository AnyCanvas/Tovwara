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
        <!-- page start-->

		<!-- Likes for each month chart html -->        
        <div class="row">
            <div class="col-sm-12">
                <section class="panel">
                    <header class="panel-heading">
                        Interacciones este mes
                        <span class="tools pull-right">
                            <a href="javascript:;" class="fa fa-chevron-down"></a>
                         </span>
                    </header>
                    <div class="panel-body">
                        <div id="chart"></div>
                    </div>
                </section>
            </div>
        </div>
        
        <!-- Likes for each machine likes chart end-->
        <div class="row">
           <div class="col-sm-6">
               <section class="panel">
                   <header class="panel-heading">
                       Sexo
                   <span class="tools pull-right">
                       <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                   </header>
                   <div class="panel-body">
                        <div id="chart2"></div>
                   </div>
               </section>
           </div>
           <div class="col-sm-6">
               <section class="panel">
                   <header class="panel-heading">
                       Nuevos/Retornos
                   <span class="tools pull-right">
                       <a href="javascript:;" class="fa fa-chevron-down"></a>
                    </span>
                   </header>
                   <div class="panel-body">


                       <div class="chartJS">


                           <canvas id="donut-chart-js" height="250" width="800" ></canvas>

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

<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>
<script src="/js/c3/c3.js"></script>
<script>

    $(function () {
      var chart = c3.generate({
	  	bindto: '#chart',
        data: {
          url: 'json/interactionsJson.php',
          mimeType: 'json',
          type: 'area',
        },
        axis: {
            x: {
                min: 1,
                label: {
                   text: 'Interacciones mensuales',
                   position: 'outter-center',
                }
            }
        },
        legend: {
          position: 'right',
        },
      });
    });
    $(function () {
      var chart = c3.generate({
	  	bindto: '#chart2',
        data: {
          url: 'json/interactionsJson.php',
          mimeType: 'json',
          type : 'pie',
        },
		  keys: {
		    // x: 'name', // it's possible to specify 'x' when category axis
		    value: ['"Likes"'],
		  }
      });
    });
</script>


</body>
</html>
