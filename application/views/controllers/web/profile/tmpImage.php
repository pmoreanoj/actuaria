<?php if ($tmp!=''): ?>
    <label class="col-sm-3 control-label right">Foto</label>
    <div class="col-sm-10 center-block centered">
        <div class="row">
            <div class="row center-block centered"><img src="<?php echo URL::site($tmp) ?>" height="150"/></div>  
        </div>
        <div class="row centered center-block">
            <div class="col-sm-4"><?php echo Form::file('image', array('id' => 'image', 'style' => 'color: transparent')) ?> </div>
        </div>
    </div>

<?php else: ?>
    <label class="col-sm-2 control-label">Foto</label>
    <div class="col-sm-4"><?php echo Form::file('image', array('id' => 'image', 'style' => 'color: transparent')) ?> </div>     
<?php endif; ?>