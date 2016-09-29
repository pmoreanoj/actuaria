<div>
    <p>Hola <?php echo $user->name?></p>
    <p>Hemos recibido tu solicitud para resetear tu contrase&ntilde;a. Por favor ingresa al siguiente link:</p>
    <p>
        <a href="http://actuaria.panda-corp.com/admin/users/restorePassword?p=<?php echo $user_hash?>">Para resetear tu contrase&ntilde;a</a>
    </p>
    <p>Atentamente,</p>
    <p>Actuaria 360</p>
</div>