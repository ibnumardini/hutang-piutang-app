<div class="container">
    <h1>Dashboard</h1>

    <div class="row mt-4">
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="height: 170px">
                <div class="card-body">
                    <h5 class="card-title text-center">Jumlah Hutang</h5>
                    <hr>
                    <p class="card-text d-flex justify-content-center align-items-center">
                        <span class="fw-bold fs-4"><?= to_rupiah($resultDebt['nominal']) ?></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="height: 170px">
                <div class="card-body">
                    <h5 class="card-title text-center">Jumlah Piutang</h5>
                    <hr>
                    <p class="card-text d-flex justify-content-center align-items-center">
                        <span class="fw-bold fs-4"><?= to_rupiah($resultReceivable['nominal']) ?></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="height: 170px">
                <div class="card-body">
                    <h5 class="card-title text-center">Jumlah Trx Hutang</h5>
                    <hr>
                    <p class="card-text d-flex justify-content-center align-items-center">
                        <span class="display-4 fw-bold"><?= $resultCountDebt ?></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="height: 170px">
                <div class="card-body">
                    <h5 class="card-title text-center">Jumlah Trx Piutang</h5>
                    <hr>
                    <p class="card-text d-flex justify-content-center align-items-center">
                        <span class="display-4 fw-bold"><?= $resultCountReceivable ?></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="height: 170px">
                <div class="card-body">
                    <h5 class="card-title text-center">Paling Sering Hutang</h5>
                    <hr>
                    <ol>
                        <li>Fulan bin Fulan</li>
                    </ol>
                    <a href="#" class="btn btn-link text-white">More..</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3" style="height: 170px">
                <div class="card-body">
                    <h5 class="card-title text-center">Paling Sering Piutang</h5>
                    <hr>
                    <ol>
                        <li>Fulan bin Fulan</li>
                    </ol>
                    <a href="#" class="btn btn-link text-white">More..</a>
                </div>
            </div>
        </div>
    </div>
</div>
