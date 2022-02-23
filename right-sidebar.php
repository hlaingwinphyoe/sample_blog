<div class="col-12 col-md-4">
    <div class="front_panel_right_sidebar">

        <div class="card">
            <div class="card-body">
                <?php if (isset($_SESSION['user']['id'])){ ?>
                    <p>
                        Hi <b><?php echo $_SESSION['user']['name']; ?></b>
                    </p>
                    <a href="dashboard.php" class="btn btn-primary">
                        Go Panel <i class="feather-arrow-right"></i>
                    </a>
                <?php }else{ ?>
                    <p>
                        Hi <b>Guest</b>
                    </p>
                    <a href="login.php" class="btn btn-primary">
                        Register Here: <i class="feather-arrow-right"></i>
                    </a>
                <?php } ?>
            </div>
        </div>

        <h4>Category List</h4>

        <div class="list-group mb-4">
            <a href="<?php echo $url; ?>/index.php" class="list-group-item list-group-item-action
            <?php echo isset($_GET['category_id'])? '':'active'; ?>">
                All Categories
            </a>
            <?php
            foreach (fCategories() as $c) {
                ?>
                <a href="category_based_post.php?category_id=<?php echo $c['id']; ?>" class="list-group-item list-group-item-action
                <?php echo isset($_GET['category_id'])? $_GET['category_id'] == $c['id']? "active":'':'' ?>">
                    <?php echo $c['title']; ?>
                    <?php if ($c['ordering']==1){ ?>
                        <i class="feather-paperclip text-info float-right"></i>
                    <?php } ?>
                </a>
            <?php } ?>

        </div>

        <div class="mb-4">
            <div class="card">
                <div class="card-body">
                    <form action="search_by_date.php" method="post">
                        <div class="form-group">
                            <label for="">Start Date</label>
                            <input type="date" name="start" class="form-control" id="">
                        </div>
                        <div class="form-group">
                            <label for="">End Date</label>
                            <input type="date" name="end" class="form-control" id="">
                        </div>
                        <button class="btn btn-primary"><i class="feather-filter mr-2"></i>Filter</button>
                    </form>
                </div>
            </div>
        </div>


    </div>
</div>