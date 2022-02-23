
<?php include "core/auth.php"; ?>
<?php include "template/header.php"; ?>
<?php
if (isset($_POST['pay-now'])){
    if (payNow()){
        linkTo("wallet.php");
    }
}
?>
<div class="row">
    <div class="col-12">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-white mb-4">
                <li class="breadcrumb-item"><a href="<?php echo $url; ?>/dashboard.php">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Wallet</li>
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
                        <i class="feather-dollar-sign text-primary"></i> My Wallet
                    </h4>
                    <a href="" class="btn btn-outline-primary">
                        <i class="feather-credit-card"></i> Money: $<?php echo user($_SESSION['user']['id'])['money']; ?>
                    </a>
                </div>
                <hr>

                <form method="post">
                    <div class="form-inline">
                        <select name="to_user" id="" class="custom-select mr-2 w-25" required>
                            <option value="0" selected disabled>Selected Users</option>
                            <?php foreach (users() as $user){ ?>
                                <?php if ($user['id'] != $_SESSION['user']['id']){ ?>
                                    <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                        <input type="number" name="amount" class="form-control mr-2 w-25" min="100" max="<?php echo user($_SESSION['user']['id'])['money']; ?>" placeholder="receiptment" required>
                        <input type="text" name="description" class="form-control mr-2" placeholder="description" required>
                        <button class="btn btn-primary" name="pay-now">Transfer</button>
                    </div>
                </form>
                <hr>

                <table class="table table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Amount</th>
                        <th>Description</th>
                        <th>Transition Time</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach (transitions() as $t) {?>
                    <tr>
                        <td><?php echo $t['id']; ?></td>
                        <td><?php echo user($t['from_user'])['name']; ?></td>
                        <td><?php echo user($t['to_user'])['name']; ?></td>
                        <td><?php echo $t['amount']; ?></td>
                        <td><?php echo $t['description']; ?></td>
                        <td><?php echo showTime($t['created_at'],"d-m-Y / h : i"); ?></td>
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

