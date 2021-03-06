<form method="post">
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content" id="modal-content__exports">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Export Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <td>
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control" id="start_date" name="start_date"
                                    required>
                            </td>
                            <td>
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="datetime-local" class="form-control" id="end_date" name="end_date"
                                    required>
                            </td>
                        </tr>
                    </table>
                    <div class="accordion" id="accordionPanelsStayOpenExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="panelsStayOpen-headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false"
                                    aria-controls="panelsStayOpen-collapseTwo">
                                    <strong>Export History</strong>
                                </button>
                            </h2>
                            <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse"
                                aria-labelledby="panelsStayOpen-headingTwo">
                                <div class="accordion-body">
                                    <?php if(count($listSpreadsheets) > 0) : ?>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>File</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        <?php $i = 1; foreach($listSpreadsheets as $spreadsheet): ?>
                                        <tr>
                                            <td class="text-center align-middle"><?= $i++ ?></td>
                                            <td class="align-middle">
                                                <?= $spreadsheet['filename'] ?>
                                                <br>
                                                <span class="form-text">Exported at:
                                                    <?= $spreadsheet['exported_at'] ?></span>
                                            </td>
                                            <td class="text-center align-middle">
                                                <a href="/app/index.php?page=transactions&view=<?=$where . $now_get?>&action=download&file=<?=$spreadsheet['filename']?>"
                                                    class="btn btn-success btn-sm"><i class="bi bi-download"></i>
                                                </a>
                                                <a href="/app/index.php?page=transactions&view=<?=$where . $now_get?>&action=remove&file=<?=$spreadsheet['filename']?>"
                                                    class="btn btn-danger btn-sm mx-1"
                                                    onclick="return confirm('yakin nih?')"><i
                                                        class="bi bi-trash3-fill"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </table>
                                    <?php else: ?>
                                    <div class="alert alert-info mb-0">
                                        <strong>Belum ada data yang di Export!</strong>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer d-flex">
                    <input type="hidden" name="action" v-model="export_action">
                    <select class="form-select w-25" v-model="export_action">
                        <option value="export_pdf" :selected="export_action === 'export_pdf'">PDF</option>
                        <option value="export_spreadsheet" :selected="export_action === 'export_spreadsheet'">
                            Spreadsheet</option>
                    </select>
                    <button type="submit" class="btn btn-success">
                        Export
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</form>