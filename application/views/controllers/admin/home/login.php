<div id="login-page">
    <div class="container">

        <form class="form-login" action="" method="POST">
            <h2 class="form-login-heading">Inicie Sesi&oacute;n</h2>
            <div class="login-wrap">
                <input name="username" type="text" class="form-control" placeholder="Usuario" autofocus>
                <br>
                <input name="password" type="password" class="form-control" placeholder="Contrase&ntilde;a">
                <label class="checkbox">
                    <span class="pull-right">
                        <a data-toggle="modal" href="login.html#myModal"> Olvid&oacute; su contrase&ntilde;a?</a>

                    </span>
                </label>
                <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i>INGRESAR</button>
                <!--
               <hr>
              
               <div class="registration">
                   Don't have an account yet?<br/>
                   <a class="" href="#">
                       Create an account
                   </a>
               </div>
                -->
            </div>
        </form>	  	
        <form class="form-modal-login" action="" method="POST">
            <!-- Modal -->
            <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                            <h4 class="modal-title">Olvidaste tu clave</h4>
                        </div>
                        <div class="modal-body">
                             <p>Ingrese su usuario</p>
                            <input type="text" name="username" id="username" placeholder="Usuario" autocomplete="off" class="form-control placeholder-no-fix">

                            <p>Ingrese su correo</p>
                            <input type="text" name="email" id="email" placeholder="Correo electr&oacute;nico" autocomplete="off" class="form-control placeholder-no-fix">

                        </div>
                        <div class="modal-footer">
                            <button data-dismiss="modal" class="btn btn-default" type="button">Cancelar</button>
                            <button class="btn btn-theme sendButton" data-dismiss="modal" type="button">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- modal -->
        </form>	

    </div>
</div>

<!-- js placed at the end of the document so the pages load faster -->
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<!--BACKSTRETCH-->
<!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
<script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
<script>
    $.backstretch("assets/img/login-bg.jpg", {speed: 500});
</script>

