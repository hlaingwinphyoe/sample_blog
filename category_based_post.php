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
            <hr>
            <?php foreach(fPostByCat($_GET['category_id']) as $p){ ?>
                <?php include "single.php"; ?>
            <?php } ?>

        </div>
        <?php include "right-sidebar.php"; ?>
    </div>
</div>

<?php require_once "front_panel/footer.php";?>




