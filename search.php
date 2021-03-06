<?php require_once "front_panel/head.php";?>
<title>Home</title>
<?php require_once "front_panel/side_header.php";?>

<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-white mb-4">
                    <li class="breadcrumb-item"><a href="<?php echo $url; ?>/index.php">
                            <i class="feather-home text-primary"></i>
                        </a></li>
                    <li class="breadcrumb-item active" aria-current="page">
                        Serach By &nbsp; <b>"<?php echo $_POST['search_key'] ?>"</b>
                    </li>
                </ol>
            </nav>
            <?php
            $result = fSearch($_POST['search_key']);
            if (count($result) == 0){
                echo alert("Sorry, we couldn't find any matches for".$_POST['search_key'],"warning");
            }
            ?>
            <?php foreach($result as $p){ ?>
                <?php include "single.php"; ?>
            <?php } ?>

        </div>
        <?php include "right-sidebar.php"; ?>
    </div>
</div>

<?php require_once "front_panel/footer.php";?>




