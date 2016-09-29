<style>
    #feedback { font-size: 1.4em; }
    .selectable li.ui-selectee:hover{cursor: pointer}
    .selectable .ui-selecting { background: #FECA40; }
    .selectable .ui-selected { background: #F39814; color: white; }
    .selectable { list-style-type: none; /*margin: 0; padding: 0;*/ width: 90%; }
    .selectable li {/* margin: 3px; padding: 0.4em; /*font-size: 1.4em;height: 18px; */}
</style>
<script>
  $(function() {
    $("#evaluator .selectable").selectable({
        selecting: function(event, ui){
            if( $("#evaluator .ui-selected, .ui-selecting").length > 1){
                  $(ui.selecting).removeClass("ui-selecting");
            }
        }
    });
     $("#evaluated .selectable").selectable({
        selecting: function(event, ui){
            if( $("#evaluated .ui-selected, .ui-selecting").length > 1){
                  $(ui.selecting).removeClass("ui-selecting");
            }
        }
    });
    $("#employees .selectable").selectable({
        selecting: function(event, ui){
            if( $("#employees .ui-selected, .ui-selecting").length > 1){
                  $(ui.selecting).removeClass("ui-selecting");
            }
        }
    });
     //$( document ).tooltip();
});

</script>

<ol class="selectable">
    <?php foreach ($employees as $employee): ?>
    <li class="ui-widget-content" employee="<?php echo $employee->id?>"><?php echo $employee->name. ' - '.$employee->position?></li>
        <?php endforeach; ?>
</ol>