<div class="container">
    <div class="row">
        <div class="col-md-6">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/app/index.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">List Person <?=$title?></li>
                </ol>
            </nav>
            <h2 class="mb-4">List Person <?=$title?></h2>
            <div class="btn-group">
                <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    Sort <?= $sort ? "~ " . $sort : ""?>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/app/index.php?page=most-freq-trx&view=<?=$where?>&sort=az">A - Z</a></li>
                    <li><a class="dropdown-item" href="/app/index.php?page=most-freq-trx&view=<?=$where?>&sort=za">Z - A</a></li>
                </ul>
            </div>
            <div class="card mt-4" style="width: 18rem;">
                <ul class="list-group list-group-flush">
                    <?php $i = 1;foreach ($personsTrx as $trx): ?>
                        <li class="list-group-item"><?=$i++ . ".  " . ucfirst($trx['name'])?></li>
                    <?php endforeach;?>
                </ul>
            </div>
        </div>
    </div>
</div>
