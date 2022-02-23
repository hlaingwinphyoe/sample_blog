
<?php include "core/auth.php"; ?>
<?php include "template/header.php"; ?>

<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Advertisements</li>
            </ol>
        </nav>
    </div>
</div>
<div class="row">
    <div class="col-12 col-xl-8">
        <div class="card mb-4">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="feather-layers text-primary"></i> Ads Manager
                    </h4>
                </div>
                <hr>
                <?php
                if (isset($_POST['add-ads'])){
                    adAdd();
                }
                ?>

                <form method="post">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="aa">Ad Owner Name</label>
                                <input type="text" name="owner-name" class="form-control" id="aa">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="bb">Ad Photo</label>
                                <input type="text" name="adPhoto" class="form-control p-1" id="bb">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cc">Ad Link</label>
                            <input type="text" name="adLink" class="form-control" id="cc">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="dd">Ad Start Date</label>
                                <input type="date" name="adStart" class="form-control" id="dd">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ee">Ad End Date</label>
                                <input type="date" name="adEnd" class="form-control" id="ee">
                            </div>
                        </div>
                        <hr>
                        <button name="add-ads" class="btn btn-primary">Add Advertisement</button>
                    </form>




            </div>
        </div>
    </div>
</div>

<?php include "template/footer.php"; ?>