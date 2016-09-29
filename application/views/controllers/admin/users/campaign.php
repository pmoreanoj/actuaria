
<div class="content-panel">
    <div class="row">
        <div class="col-md-12">
            <h3><?php echo $campaign->name . ' - ' . $campaign->company->name ?></h3>
        </div>
    </div>

    <?php echo Form::hidden('campaign', $campaign->id, array('id' => 'campaign')) ?>
    <?php if ($users_count > 0): ?>
        <div class="row">
            <div class="col-md-12">
               Hay <?php echo $users_count?> usuarios creados
            </div>
            <div class="col-md-12">
                <input class="pass_type" type="radio" name="option" value="random" checked>Random Password
                <input class="pass_type" type="radio" name="option" value="default">Default Password
            </div>
            <div id="default_password" class="col-md-12">
                <?php echo Form::password('password', NULL, array('id' => 'password')); ?>
            </div>
            <div class="col-md-12">
                <?php echo Form::submit('sbt_generate', 'Generar Usuarios', array('id' => 'sbt_generate')) ?>
            </div>
        </div>
        <div id="users" >
            <?php echo $users ?>
        </div>

    <?php else: ?>
        <div id="users" >
            <div class="row">
                <div class="col-md-12">
                    No hay usuarios
                </div>
                <div class="col-md-12">
                    <input class="pass_type" type="radio" name="option" value="random" checked>Random Password
                    <input class="pass_type" type="radio" name="option" value="default">Default Password
                </div>
                <div id="default_password" class="col-md-12">
                    <?php echo Form::password('password', NULL, array('id' => 'password')); ?>
                </div>
                <div class="col-md-12">
                    <?php echo Form::submit('sbt_generate', 'Generar Usuarios', array('id' => 'sbt_generate')) ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>