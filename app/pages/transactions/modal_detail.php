<div class="modal fade" id="trx_modal_<?=$transaction['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    <?=strtoupper($transaction['type'])?>#<?=$transaction['id']?></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Trx Id</th>
                                    <td><?=strtoupper($transaction['type'])?>#<?=$transaction['id']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Tipe</th>
                                    <td><?=$transaction['type']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Orang</th>
                                    <td><?=$transaction['name']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Untuk</th>
                                    <td><?=$transaction['use_for']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Nominal</th>
                                    <td><?=$transaction['nominal']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Installment</th>
                                    <td><?=$transaction['temp_nominal']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-bordered">
                            <tbody>
                                <tr>
                                    <th scope="row">Status</th>
                                    <td><span
                                            class="badge bg-<?=$transaction['status_badge_color'][0]?> <?=$transaction['status_badge_color'][1]?>">
                                            <?=$transaction['status']?></span></td>
                                </tr>
                                <tr>
                                    <th scope="row">Transaction At</th>
                                    <td><?=$transaction['transaction_at']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Due Date</th>
                                    <td><?=$transaction['due_date']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Created At</th>
                                    <td><?=$transaction['created_at']?></td>
                                </tr>
                                <tr>
                                    <th scope="row">Updated At</th>
                                    <td><?=$transaction['updated_at']?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>