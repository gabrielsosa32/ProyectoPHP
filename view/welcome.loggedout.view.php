<div class="card col-md-6 offset-md-3" style="margin-top: 150px;">
    <div class="card-body">
        <div class="container-fluid text-center">
            <h1>¡Bienvenido a TecnoT!</h1>
        </div>
        <center>
        <div class="align-content-center">
            <h4>Para comenzar a utilizar nuestro sistema, deberás de iniciar sesión con tu usuario primero.</h4>
            <h6>¡Si aún no tienes un usuario generado no te preocupes, puedes registrarte ahora mismo!</h6>
        </div>
        <div class="align-content-center">
        <!-- Botón modal iniciar sesión -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#loginModal">
        Ingresar
        </button>
        <!-- Botón modal registrarse -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#registerModal">
        Registrarse
        </button>

        <!-- Modal iniciar sesión -->
        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Ingresar al sistema</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php include_once 'auth/login.view.php';?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal registrarse -->
        <div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">Registrarse</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?php include_once 'auth/register.view.php';?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
                </div>
            </div>
        </div>

        </div>
         </center>
    </div>

</div>