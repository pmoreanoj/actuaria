
<?php if ($tmp!=''): ?>
    <label class="col-sm-2 control-label">Logo</label>
    <div class="col-sm-10">
        <div class="row">
            <div class="col-sm-3"><img src="<?php echo URL::site($tmp) ?>" height="150"/></div>  
        </div>
        <div class="row">
            <div class="col-sm-4"><?php echo Form::file('logo', array('id' => 'logo', 'style' => 'color: transparent')) ?> </div>
        </div>
    </div>

<?php else: ?>
    <label class="col-sm-2 control-label">Logo</label>
    <div class="col-sm-4"><?php echo Form::file('logo', array('id' => 'logo', 'style' => 'color: transparent')) ?> </div>     

<?php endif; ?>
