<div class="card col-md-6 offset-md-3" style="margin-top: 150px;">
    <div class="card-body" style="padding-top: 55px;">
        <div class="container-fluid text-center">
            <h1>¡Bienvenido a TecnoT!</h1>
            <h3>Bienvenido <?php echo $userDetails->username; ?></h3>
            <h5>Tu escuela es: <?php echo $userDetails->user_escuela ?></h5>
            <h6>Tu nivel en el sistema es: <?php echo $showUserLevel ?>.</h6>
            <a href="?c=project" class="btn btn-primary m-5">Comenzar</a>
        </div>
    </div>
</div>