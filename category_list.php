<table class="table table-hover mt-3 mb-0">
    <thead>
    <tr>
        <th>#</th>
        <th>Title</th>
        <th>User</th>
        <th>Action</th>
        <th>Created</th>
    </tr>
    </thead>

    <tbody>
    <?php
    foreach(categories() as $c){

        ?>
        <tr class="<?php echo $c['ordering'] == 1? 'table-info':''; ?>">
            <td><?php echo $c['id'] ?></td>
            <td><?php echo $c['title'] ?></td>
            <td><?php echo user($c['user_id'])['name']; ?></td>
            <td>
                <a href="category_delete.php?id=<?php echo $c['id'];  ?>" title="Delete" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure? You want to delete.😊  `<?php echo $c['title']?>`')">
                    <i class="feather-trash-2"></i>
                </a>
                <a href="category_update.php?id=<?php echo $c['id'];  ?>" title="Edit" class="btn btn-sm btn-outline-warning">
                    <i class="feather-edit-2"></i>
                </a>
                <?php if( $c['ordering'] != 1 ){ ?>
                <a href="category_pin_to_top.php?id=<?php echo $c['id'];  ?>" title="Pin to Top" class="btn btn-sm btn-outline-info">
                    <i class="feather-feather"></i>
                </a>
                <?php } ?>
                <?php if( $c['ordering'] == 1 ){ ?>
                <a href="category_remove_pin.php?id=<?php echo $c['id'];  ?>" title="Remove Pin" class="btn btn-sm btn-outline-info">
                    <i class="feather-arrow-down"></i>
                </a>
                <?php } ?>
            </td>
            <td><?php echo showTime($c['created_at']); ?></td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
