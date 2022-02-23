<?php include "core/auth.php"; ?>
<?php include "template/header.php"; ?>

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Post</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-list text-primary"></i>  Post List
                    </h4>
                    <div class="">

                        <a href="<?php echo $url; ?>/post_add.php" class="btn btn-outline-primary">
                            <i class="feather-plus-circle"></i>
                        </a>
                        <a href="#" class="btn btn-outline-secondary full-screen-btn">
                            <i class="feather-maximize-2"></i>
                        </a>
                    </div>
                </div>


                <hr>



                <table class="table table-hover table-bordered mt-3 mb-0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Owner Name</th>
                        <th>Photo</th>
                        <th>Link</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php

                    foreach (adShow() as $c){
                        ?>
                        <tr>
                            <td><?php echo $c['id']; ?></td>
                            <td class="text-nowrap"><?php echo $c['owner_name']; ?></td>
                            <td><?php echo short($c['photo'],30); ?></td>
                            <td><?php echo short($c['link'],30); ?></td>
                            <td class="text-nowrap"><?php echo $c['start']; ?></td>
                            <td class="text-nowrap"><?php echo $c['end']; ?></td>

                            <td class="text-nowrap">
                                <a href="post_detail.php?id=<?php echo $c['id']; ?>" class="btn btn-outline-info btn-sm">
                                    <i class="feather-info fa-fw"></i>
                                </a>
                                <a href="post_delete.php?id=<?php echo $c['id']; ?>"
                                   onclick="return confirm('Are U sure to delete. 😊')"
                                   class="btn btn-outline-danger btn-sm">
                                    <i class="feather-trash-2 fa-fw"></i>
                                </a>
                                <a href="post_edit.php?id=<?php echo $c['id']; ?>" class="btn btn-outline-warning btn-sm">
                                    <i class="feather-edit-2 fa-fw"></i>
                                </a>
                            </td>
                            <td class="text-nowrap"><?php echo showTime($c['created_at']); ?></td>
                        </tr>

                    <?php } ?>
                    </tbody>
                </table>


            </div>
        </div>
    </div>
</div>

<?php include "template/footer.php"; ?>
<script>
    $(".table").dataTable({
        "order": [[0, "desc" ]]
    });
</script>
