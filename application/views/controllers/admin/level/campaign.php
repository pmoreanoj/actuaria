<div class="content-panel">
    <div>
        <h3>  <?php echo $campaign->name; ?></h3>
    </div>

    <div>
        <table  class="tablesorter table table-striped table-advance table-hover">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Nivel</th>
                </tr>
            </thead>
            <?php
            $levels = $campaign->levels->find_all();
            foreach ($levels as $level):
                if ($level->level != 0):
                    ?>
                    <tr>
                        <td>
                            <a href="<?php echo URL::site('admin/levels/edit') . "?id=" . $level->id ?>">
                                <?php echo $level->name ?>
                            </a>
                        </td>
                        <td><?php echo $level->level ?></td>
                       </tr>
                    <?php
                endif;
            endforeach;
            ?>

        </table>
    </div>
</div>