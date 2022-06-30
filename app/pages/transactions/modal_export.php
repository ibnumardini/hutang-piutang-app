<form method="post">
    <div class="modal fade" id="exportModal" tabindex="-1" aria-labelledby="exportModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exportModalLabel">Export Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center">
                    <table class="table table-bordered mb-0">
                        <tr>
                            <td>
                                <label for="start_date" class="form-label">Start Date</label>
                                <input type="datetime-local" class="form-control" id="start_date"
                                    name="start_date" required>
                            </td>
                            <td>
                                <label for="end_date" class="form-label">End Date</label>
                                <input type="datetime-local" class="form-control" id="end_date"
                                    name="end_date" required>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <input type="hidden" name="action" value="export_spreadsheet">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-file-earmark-excel-fill"></i>
                        Spreadsheet
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>