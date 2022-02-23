<?php session_start(); ?>
<?php require_once "front_panel/head.php";?>
<title>Home</title>
<?php require_once "front_panel/side_header.php";?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white mb-4">
                    <li class="breadcrumb-item active" aria-current="page">
                        <i class="feather-home text-primary"></i>
                    </li>
                </ol>
            </nav>

            <div class="dropdown mb-4 text-right">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false">
                    <i class="feather-calendar"></i> Sort News
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="?order_by=created_at&order_type=asc">
                        <i class="feather-arrow-down-circle"></i>
                        Oldest to Newest
                    </a>
                    <a class="dropdown-item" href="?order_by=created_at&order_type=desc">
                        <i class="feather-arrow-up-circle"></i>
                        Newest to Oldest
                    </a>
                    <a class="dropdown-item" href="">
                        <i class="feather-list"></i>
                        Default
                    </a>
                </div>
            </div>

            <?php
            if (isset($_GET['order_by']) && isset($_GET['order_type'])){
                $orderCol = $_GET['order_by'];
                $orderType = strtoupper($_GET['order_type']);
                $posts = fPosts($orderCol,$orderType);
            }else{
                $posts = fPosts();
            }

            foreach($posts as $p){

            ?>
                <?php include "single.php"; ?>
            <?php } ?>

        </div>
        <?php include "right-sidebar.php"; ?>
    </div>
</div>

<?php require_once "front_panel/footer.php";?>




