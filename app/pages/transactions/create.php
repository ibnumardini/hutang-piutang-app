<div class="container">
    <h1 class="mb-3">Create <?=$title?></h1>

    <div class="row mb-5">
        <div class="col-6">
            <?php
            
            if(isset($alert)) :
                ?>
            <div class="alert alert-<?= $alert[0] ?> alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    <?php
                    
                    foreach ($alert[1] as $alert_msg) {
                        echo '<li><strong>'. $alert_msg .'</strong></li>';
                    }

                    ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php
            endif;
            ?>
            <form action="<?=$_SERVER['REQUEST_URI']?>" method="POST">
                <div class="mb-3">
                    <label for="person_name" class="form-label">Orang</label>
                    <input type="text" class="form-control" id="person_name" name="person_name" value="<?= $personById['name'] ?? '' ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="use_for" class="form-label">Kegunaan</label>
                    <input type="text" class="form-control" id="use_for" name="use_for" value="<?= $use_for ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="nominal" class="form-label">Nominal</label>
                    <input type="text" class="form-control" id="nominal" name="nominal" value="<?= $nominal ?? '' ?>">
                </div>
                <div class="mb-3">
                    <label for="transaction_at" class="form-label">Waktu <?=$title?></label>
                    <input type="datetime-local" class="form-control" id="transaction_at" name="transaction_at" value="">
                </div>
                <div class="mb-3">
                    <label for="due_date" class="form-label">Kapan Bayar</label>
                    <input type="datetime-local" class="form-control" id="due_date" name="due_date" value="">
                </div>
                <input type="hidden" name="type" value="<?= $where ?>">
                <input type="hidden" name="person_id" value="<?= $personById['id'] ?>">
                <input type="hidden" name="action" value="create_trx">
                <button class="btn btn-primary me-1">Buat <?=$title?></button>
                <a class="btn btn-danger" href="/app/index.php?page=transactions&view=<?=$where?>">Cancel</a>
            </form>
        </div>
        <div class="col-3"></div>
        <div class="col-3"></div>
    </div>
</div>
