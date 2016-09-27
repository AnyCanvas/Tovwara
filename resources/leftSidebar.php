<aside>
    <div id="sidebar" class="nav-collapse">
	    <div class="leftside-navigation">

		<!-- sidebar menu start--> 
            <ul class="sidebar-menu" id="nav-accordion">
            <li>
                <a href="dashboard.php">
                    <i class="fa fa-dashboard"></i>
                    <span>Inicio</span>
                </a>
            </li>
            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-laptop"></i>
                    <span>Estadísticas</span>
                </a>
                <ul class="sub">  
                    <li><a href="stats.php">Generales</a></li>
                    <li><a href="accions.php">Acciones</a></li>
                    <li><a href="users.php">Usuarios</a></li>
                    <li><a href="rate.php">Encuestas</a></li>
                </ul>
            </li>


            <li class="sub-menu">
                <a href="javascript:;">
                    <i class="fa fa-laptop"></i>
                    <span>Estadísticas</span>
                </a>
                <ul class="sub">  
                    <li><a href="stats.php">Generales</a></li>
                    <li><a href="accions.php">Acciones</a></li>
                    <li><a href="users.php">Usuarios</a></li>
                    <li><a href="rate.php">Encuestas</a></li>
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
                    <li><a href="clientsDev.php">Editar Clientes </a></li>
                    <li><a href="paidsDev.php">Editar pagos </a></li>
                </ul>
            </li>
					
			<?php	} ?>
        	</ul>
		<!-- sidebar menu end-->

        </div>        
    </div>

</aside>
