<div class="content-panel">
    <?php echo Form::select('question_types', $question_types, NULL, array('id'=>'question_type'))?>
    <span class='ajax-message'></span>
    <div id="questions">
       <?php echo $questions_view?>
    </div>
</div>