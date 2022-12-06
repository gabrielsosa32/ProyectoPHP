<nav class="navbar navbar-expand-md bg-dark navbar-dark justify-content-center fixed-top">
    
    <a class="navbar-brand" href="index.php">TecnoT</a>
  
    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <!-- Navbar links -->
    <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-item-custom-1 nav-link" href="?c=project">LISTAR PROYECTOS</a>
        </li>
        <li class="nav-item">
          <a class="nav-item-custom-1 nav-link" href="?c=user">VER ESCUELA</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <?php echo $userDetails->username ?>
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <a class="dropdown-item" href="?c=core&a=logout">Desconectarse</a>
            <a class="dropdown-item" href="#">Solicitudes</a>
          </div>
        </li>
      </ul>
    </div>
</nav>