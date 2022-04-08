<div class="container">
    <h1 class="mb-3">Transactions</h1>

    <table class="table table-striped table-bordered">
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
        <tbody>
            <?php
                $num = 1;

                foreach ($transactions as $transaction) :
            ?>
            <tr>
                <td><?= $num++ ?></td>
                <td><?= $transaction['user_for'] ?></td>
                <td><?= $transaction['person_id'] ?></td>
                <td><?= $transaction['nominal'] ?></td>
                <td>
                    <span class="badge bg-danger">
                        <?= $transaction['status'] ?>
                    </span>
                </td>
                <td><?= date("d F Y H:i:s", strtotime($transaction['due_date'])); ?></td>
                <td>
                    <button class="btn btn-warning btn-sm">
                        <i class="bi bi-pencil-square"></i>
                    </button>
                    <button class="btn btn-danger btn-sm">
                        <i class="bi bi-trash3-fill"></i>
                    </button>
                    <button class="btn btn-info btn-sm">
                        <i class="bi bi-eye-fill"></i>
                    </button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
