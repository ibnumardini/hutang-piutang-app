<div class="container">
    <h1>Installment</h1>
    <div class="row">
        <div class="col-md-6">
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
            <form method="post">
                <div class="mb-3">
                    <label for="temp_nominal" class="form-label">Installment Nominal</label>
                    <input type="number" class="form-control" id="temp_nominal" name="temp_nominal"
                        value="<?= $transaction['temp_nominal'] ?>">
                </div>
                <div class="mb-3">
                    <div class="card p-3">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Jumlah Hutang</th>
                                    <td><?= to_rupiah($transaction['nominal']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Jumlah Angsuran</th>
                                    <td><?= to_rupiah($transaction['temp_nominal']) ?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Sisa Angsuran</th>
                                    <td><?= to_rupiah($transaction['nominal'] - $transaction['temp_nominal']) ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="mb-3">
                    <input type="hidden" name="action" value="change_trx_installment">
                    <input type="hidden" name="id" value="<?= $transaction['id'] ?>">
                    <button class="btn btn-primary">Save</button>
                    <a href="/app/index.php?page=transactions&view=debt" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>