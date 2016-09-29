<table id="table_list" class="tablesorter table table-striped table-advance table-hover">
    <thead>
        <tr>
            <th>Usuario</th>
        </tr>
    </thead>

    <?php foreach ($users as $user): ?>
        <tr>
            <td>
                <?php echo $user->username ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

