<div class="content-panel">
    <div>
        <h3>  <?php echo $campaign->name; ?></h3>
    </div>

    <div>
        <table  class="tablesorter table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                </tr>
            </thead>
            <?php
            $areas = $campaign->areas->find_all();
            foreach ($areas as $area):
                
                    ?>
                    <tr>
                        <td>
                            <!--
                            <a href="<?php echo URL::site('admin/areas/edit') . "?id=" . $area->id ?>"></a>-->
                                <?php echo $area->name ?>
                            
                       </td> 
                      
                       </tr>
                    <?php
               
            endforeach;
            ?>

        </table>
    </div>
</div>