<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <!-- se acostumbra colocar la sigla de la empresa -->
    <a class="navbar-brand" href="index.php">Inicio</a>
    <!-- Este botón es para cuando se haga pequeña la página, no está visible si está grande la pantalla -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" 
	aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>        
    </button>  

    <!-- Contenido del Menu -->
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <!-- Sección para sedes -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarNavDropdown" role="button" 
				data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Inventario
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarNavDropdown">
                    <a class="dropdown-item" href="sedes_listar.php">Listar</a>
                    <a class="dropdown-item" href="sedes_administrar.php">Administrar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="sedes_crear.php">Crear</a>
                </div>
            </li>
            
             <!-- Sección para estudiantes -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarNavDropdown"
                   role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    Obras
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarNavDropdown">
                    <a class="dropdown-item" href="facultades_listar.php">Listar</a>
                    <a class="dropdown-item" href="#">Administrar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="facultades_crear.php">Crear</a>                    
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarNavDropdown"
                   role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    Empleados
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarNavDropdown">
                    <a class="dropdown-item" href="estudiantes_listar.php">Listar</a>
                    <a class="dropdown-item" href="#">Administrar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Crear</a>                    
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarNavDropdown"
                   role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    Herramientas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarNavDropdown">
                    <a class="dropdown-item" href="">Listar</a>
                    <a class="dropdown-item" href="#">Administrar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Crear</a>                    
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarNavDropdown"
                   role="button" data-toggle="dropdown" aria-haspopup="true"
                   aria-expanded="false">
                    Relprogest
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarNavDropdown">
                    <a class="dropdown-item" href="relprogest_listar.php">Listar</a>
                    <a class="dropdown-item" href="#">Administrar</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="relprogest_crear.php">Crear</a>                    
                </div>
            </li>
        </ul>        
    </div>
</nav>
<p></p>