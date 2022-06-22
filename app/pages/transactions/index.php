<div class="container">
    <h1 class="mb-3">Transactions - <?=$where === "debt" ? "Hutang" : "Piutang"?></h1>

    <div class="row">
        <div class="col-md-12 d-flex justify-content-between">
            <a href="/app/index.php?page=transactions&view=<?=$where?>&action=create" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Tambah
            </a>
            <form action="/app/index.php" method="get" class="d-flex">
                <input type="hidden" name="page" value="transactions">
                <input type="hidden" name="view" value="<?= $where ?>">
                <input class="form-control me-2" name="search" type="search" placeholder="Search by use for"
                    aria-label="Search" value="<?=$search ?? ''?>">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>

    <?php

    if (isset($alert)):
    ?>
    <div class="alert alert-<?=$alert[0]?> alert-dismissible fade show mt-3" role="alert">
        <ul class="mb-0">
            <?php

            foreach ($alert[1] as $alert_msg) {
                echo '<li><strong>' . $alert_msg . '</strong></li>';
            }

            ?>
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php
endif;
?>
    <?=$search ? "<h1 class='mt-4'>Hasil dari: " . $search . "</h1>" : ''?>
    <table class="table table-striped table-bordered mt-4">
        <thead class="table-dark">
            <tr>
                <th class="text-center">No</th>
                <th>Untuk</th>
                <th>Orang</th>
                <th>Nominal</th>
                <th>Status</th>
                <th>Jatuh Tempo</th>
                <th class="text-center">Action</th>
            </tr>
        </thead>
        <?php if (count($transactions) === 0): ?>
        <tbody>
            <tr>
                <td colspan="7" class="text-center fw-bold">Data transaksi belum ada!</td>
            </tr>
        </tbody>
        <?php endif;?>
        <tbody>
            <?php
            $num = $start_page + 1;
            foreach ($transactions as $transaction):
            ?>
            <tr>
                <td class="text-center"><?=$num++?></td>
                <td><?=$transaction['use_for']?></td>
                <td><?=$transaction['name']?></td>
                <td><?=to_rupiah($transaction['nominal'])?></td>
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <span
                                class="badge bg-<?=$transaction['status_badge_color'][0]?> <?=$transaction['status_badge_color'][1]?>">
                                <?=$transaction['status']?>
                            </span>
                        </button>
                        <ul class="dropdown-menu">
                            <li>
                                <?php foreach ($transaction['trx_status'] as $ts): ?>
                                <form method="post">
                                    <input type="hidden" name="id" value="<?=$transaction['id']?>">
                                    <input type="hidden" name="action" value="change_trx_status">
                                    <input type="hidden" name="trx_status" value="<?=$ts?>">
                                    <button type="submit" class="dropdown-item"><?=ucwords($ts)?></button>
                                </form>
                                <?php endforeach;?>
                            </li>

                            <?php if ((count($transaction['trx_status']) === 1 && $transaction['status'] !== 'paid') || $transaction['status'] === 'installment'): ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item"
                                    href="/app/index.php?page=transactions&view=debt&action=installment&id=<?=$transaction['id']?>">Installment</a>
                            </li>
                            <?php endif;?>
                        </ul>
                    </div>
                </td>
                <td><?=date("d F Y H:i:s", strtotime($transaction['due_date']));?></td>
                <td class="text-center">
                    <a href="/app/index.php?page=transactions&view=<?=$where?>&action=edit&id=<?=$transaction['id']?>"
                        class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </a>
                    <form method="post" class="form_trx_delete" onclick="return confirm('Yakin ga?')">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?=$transaction['id']?>">
                        <button type="submit" class="btn btn-danger btn-sm">
                            <i class="bi bi-trash3-fill"></i>
                        </button>
                    </form>
                    <button class="btn btn-info btn-sm" type="button" data-bs-toggle="modal"
                        data-bs-target="#trx_modal_<?=$transaction['id']?>">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-printer"></i>
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">PDF</a></li>
                            <li><a class="dropdown-item" href="#">Excel</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">RAW</a></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach;?>
        </tbody>
    </table>
    <?php if ($total_pages > 1): ?>
    <nav>
        <ul class="pagination">
            <?php if ($now > 1): ?>
            <li class="page-item"><a class="page-link"
                    href="/app/index.php?page=transactions&view=debt&now=<?=$now - 1?><?= $isset_search ? "&search=$isset_search" : '' ?>">Previous</a>
            </li>
            <?php endif;?>

            <?php if ($now - 1 > 0): ?>
            <li class="page-item"><a class="page-link"
                    href="/app/index.php?page=transactions&view=debt&now=<?=$now - 1?><?= $isset_search ? "&search=$isset_search" : '' ?>"><?=$now - 1?></a>
            </li>
            <?php endif?>

            <li class="page-item active"><a class="page-link"
                    href="/app/index.php?page=transactions&view=debt&now=<?=$now?>"
                    <?= $isset_search ? "&search=$isset_search" : '' ?>><?=$now?></a>
            </li>

            <?php if ($now + 1 < ($total_pages + 1)): ?>
            <li class="page-item"><a class="page-link"
                    href="/app/index.php?page=transactions&view=debt&now=<?=$now + 1?><?= $isset_search ? "&search=$isset_search" : '' ?>"><?=$now + 1?></a>
            </li>
            <?php endif?>

            <?php if ($now < $total_pages): ?>
            <li class="page-item"><a class="page-link"
                    href="/app/index.php?page=transactions&view=debt&now=<?=$now + 1?><?= $isset_search ? "&search=$isset_search" : '' ?>">Next</a>
            </li>
            <?php endif;?>
        </ul>
    </nav>
    <?php endif;?>
</div>

<?php
foreach ($transactions as $transaction) {
    include './pages/transactions/modal_detail.php';
}