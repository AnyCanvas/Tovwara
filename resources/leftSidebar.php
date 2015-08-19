<aside>
    <div id="sidebar" class="nav-collapse">
	    <div class="leftside-navigation">

		<!-- sidebar menu start--> 
            <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="index.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-laptop"></i>
                    <span>Reportes</span>
                </a>
                <ul class="sub">  
                    <li><a href="stats.php">Estadísticas</a></li>
                    <li><a href="tables.php">Usuarios</a></li>
                </ul>
            </li>

            <li>
                <a href="list.php">
                    <i class="fa fa-cogs"></i>
                    <span>Mis Fanbot</span>
                </a>
            </li>

			<?php if($_SESSION['userId'] == '00'){ ?>

            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-briefcase"></i>
                    <span>Administracíon</span>
                </a>
                <ul class="sub">
                    <li><a href="fnbtDev.php">Editar Fanbot</a></li>
                    <li><a href="clientssDev.php">Editar Clientes </a></li>
                    <li><a href="paidsDev.php">Editar pagos </a></li>
                </ul>
            </li>
					
			<?php	} ?>
        	</ul>
		<!-- sidebar menu end-->

        </div>        
    </div>

</aside>
