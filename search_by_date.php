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
                        Serach Date From &nbsp; <b>"<?php echo $_POST['start']?>"</b> &nbsp; To &nbsp; <b>"<?php echo $_POST['end']; ?>"</b>;
                    </li>
                </ol>
            </nav>
            <?php
            $result = fSearchByDate($_POST['start'],$_POST['end']);
            if (count($result) == 0){
                echo alert("Sorry, we couldn't find any matches from ".$_POST['start']." to ".$_POST['end'],"warning");
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




