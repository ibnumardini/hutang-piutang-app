<div class="container">
    <h1 class="mb-3">Transactions - <?=$where === "debt" ? "Hutang" : "Piutang"?></h1>

    <a href="/app/index.php?page=transactions&view=<?=$where?>&action=create" class="btn btn-primary"><i
            class="bi bi-plus-circle"></i> Tambah</a>

    <?php
            
            if(isset($alert)) :
                ?>
    <div class="alert alert-<?= $alert[0] ?> alert-dismissible fade show mt-3" role="alert">
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

    <table class="table table-striped table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Untuk</th>
                <th>Orang</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Jatuh Tempo</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php if(count($transactions) === 0) : ?>
        <tbody>
            <tr>
                <td colspan="7" class="text-center fw-bold">Data transaksi belum ada!</td>
            </tr>
        </tbody>
        <?php endif; ?>
        <tbody>
            <?php
                $num = 1;

                foreach ($transactions as $transaction):
                ?>
            <tr>
                <td><?=$num++?></td>
                <td><?=$transaction['use_for']?></td>
                <td><?=$transaction['name']?></td>
                <td><?=to_rupiah($transaction['nominal'])?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span class="badge bg-<?= $transaction['status_badge_color'][0] ?> <?= $transaction['status_badge_color'][1] ?>">
                                <?=$transaction['status']?>
                            </span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <?php foreach ($transaction['trx_status'] as $ts) : ?>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?=$transaction['id']?>">
                                    <input type="hidden" name="action" value="change_trx_status">
                                    <input type="hidden" name="trx_status" value="<?= $ts ?>">
                                    <button type="submit" class="dropdown-item"><?= ucwords($ts) ?></button>
                                </form>
                                <?php endforeach; ?>
                            </li>

                            <?php if(count($transaction['trx_status']) === 1 && $transaction['status'] !== 'paid') : ?>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="/app/index.php?page=transactions&view=debt&action=installment&id=<?= $transaction['id'] ?>">Installment</a></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </td>
                <td><?=date("d F Y H:i:s", strtotime($transaction['due_date']));?></td>
                <td>
                    <button class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <form method="post" class="form_trx_delete" onclick="return confirm('Yakin ga?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?=$transaction['id']?>">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                    <button class="btn btn-info btn-sm">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
</div>