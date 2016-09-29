<label class="col-sm-2 col-sm-2 control-label"><?php echo $label?></label>
<div class="col-sm-10">
    <?php echo Form::select($type, $types, NULL, array("id" => $type)); ?>
</div>
