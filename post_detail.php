
<?php include "core/auth.php"; ?>
<?php include "template/header.php"; ?>

<?php
    $id = $_GET['id'];
    $current = post($id);
?>

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">Home</a></li>
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/post_list.php">Posts</a></li>
                <li class="breadcrumb-item active" aria-current="page">
                    <?php echo $current['title']; ?>
                </li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-list text-primary"></i> Post's Detail
                    </h4>
                    <div>
                        <a href="<?php echo $url; ?>/post_add.php" class="btn btn-outline-primary">
                            <i class="feather-plus-circle"></i>
                        </a>
                        <a href="<?php echo $url; ?>/post_list.php" class="btn btn-outline-primary">
                            <i class="feather-list"></i>
                        </a>
                    </div>
                </div>
                <hr>

                <h4><?php echo $current['title'] ?></h4>

                <div class="my-3">
                    <i class="feather-user text-primary"></i>
                    <?php echo user($current['user_id'])['name']; ?>

                    <i class="feather-layers text-success"></i>
                    <?php echo category($current['category_id'])['title']; ?>

                    <i class="feather-calendar text-primary"></i>
                    <?php echo showTime($current['created_at'],"d M Y"); ?>
                </div>

                <div class="">
                    <?php echo html_entity_decode($current['description'],ENT_QUOTES); ?>
                </div>

            </div>
        </div>
    </div>
    <div class="col-12 col-md-4 col-lg-6">
        <div class="card">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-eye text-primary"></i> Post's Viewers
                    </h4>
                    <div>
                        <a href="#" class="btn btn-outline-secondary full-screen-btn">
                            <i class="feather-maximize-2"></i>
                        </a>
                    </div>
                </div>
                <hr>
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>Viewer Name</th>
                        <th>Device</th>
                        <th>Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach(viewerCountByPost($id) as $v){ ?>
                        <tr>
                            <td class="text-uppercase text-nowrap">
                                <?php
                                    if ($v['user_id']==0){
                                        echo "Guest";
                                    }else{
                                        echo user($v['user_id'])['name'];
                                    }
                                ?>
                            </td>
                            <td><?php echo $v['device']; ?></td>
                            <td class="text-nowrap"><?php echo showTime($v['created_at']); ?></td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include "template/footer.php"; ?>

