<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Manual Invoice Management</h3>
            <p>Create consulting invoices manually, then save and print or print directly without saving.</p>
        </div>
        <div class="badge-soft badge-soft-primary">Manual Consulting Invoice</div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-1">Create Manual Invoice</h5>
            <div class="text-muted small mb-3">
                Fill in customer information and invoice items manually. This form is intended for consulting or non-sales-order invoices.
            </div>

            <form method="post">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Invoice No</label>
                        <input type="text" name="invoice_no" class="form-control" placeholder="Auto generate if empty">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Invoice Date</label>
                        <input type="date" name="invoice_date" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Currency</label>
                        <select name="currency_id" class="form-select" required>
                            <option value="">- select currency -</option>
                            <?php foreach ($currencies as $c): ?>
                                <option value="<?= e($c['id']); ?>"><?= e($c['currency_code']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">PIC Name</label>
                        <input type="text" name="pic_name" class="form-control" placeholder="PIC / Contact person">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Customer Name</label>
                        <input type="text" name="customer_name" class="form-control" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Incoterm</label>
                        <input type="text" name="incoterm_text" class="form-control" placeholder="EXW / FOB / Not Applicable / Service Based">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Payment Term</label>
                        <input type="text" name="payment_term_text" class="form-control" placeholder="Net 7 Days / 30% Advance / Full Payment">
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Customer Address</label>
                        <textarea name="customer_address" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">Country</label>
                        <input type="text" name="customer_country" class="form-control">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Example: Consulting Service Invoice">
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-sm align-middle" id="manual-items-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th width="110">Qty</th>
                                <th width="120">Unit</th>
                                <th width="170">Unit Price</th>
                                <th width="170">Amount</th>
                                <th width="70">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input type="text" name="description[]" class="form-control" placeholder="Service description / consulting fee">
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="qty[]" class="form-control qty" value="1">
                                </td>
                                <td>
                                    <input type="text" name="unit[]" class="form-control" placeholder="Lot / Job / Pcs">
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="unit_price[]" class="form-control price" value="0">
                                </td>
                                <td>
                                    <input type="text" class="form-control amount" readonly>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-row">×</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4" class="text-end">Total</th>
                                <th><input type="text" class="form-control" id="grand-total" readonly></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <label class="form-label">Notes</label>
                        <textarea name="notes" class="form-control" rows="4" placeholder="Additional notes, bank reminder, service period, etc."></textarea>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="add-row">+ Add Item</button>

                    <button type="submit" name="submit_action" value="save_print" class="btn btn-dark">
                        Save + Print
                    </button>

                    <button type="submit" name="submit_action" value="print_only" class="btn btn-success" formtarget="_blank">
                        Print Only
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Saved Manual Invoice List</h3>
            <p>Invoices saved from this form will appear here.</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Invoice No</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th class="text-end">Total</th>
                            <th width="140">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!$rows): ?>
                            <tr>
                                <td colspan="5" class="empty-state">No manual invoices yet.</td>
                            </tr>
                            <?php else: foreach ($rows as $row): ?>
                                <tr>
                                    <td class="fw-semibold"><?= e($row['invoice_no']); ?></td>
                                    <td><?= format_date_id($row['invoice_date']); ?></td>
                                    <td><?= e($row['customer_name']); ?></td>
                                    <td class="text-end fw-semibold"><?= format_money($row['total_amount']); ?></td>
                                    <td>
                                        <a href="<?= site_url('transactions/print-manual-invoice/' . $row['id']); ?>" target="_blank" class="btn btn-sm btn-success">Print</a>

                                        <a href="<?= site_url('transactions/delete-manual-invoice/' . $row['id']); ?>"
                                            onclick="return confirm('Delete this invoice?')"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                        <?php endforeach;
                        endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function bindManualRow(row) {
        const qty = row.querySelector('.qty');
        const price = row.querySelector('.price');
        const amount = row.querySelector('.amount');

        function calc() {
            amount.value = ((parseFloat(qty.value) || 0) * (parseFloat(price.value) || 0)).toFixed(2);
            calcGrandTotal();
        }

        qty.addEventListener('input', calc);
        price.addEventListener('input', calc);

        row.querySelector('.remove-row').addEventListener('click', () => {
            if (document.querySelectorAll('#manual-items-table tbody tr').length > 1) {
                row.remove();
                calcGrandTotal();
            }
        });

        calc();
    }

    function calcGrandTotal() {
        let total = 0;
        document.querySelectorAll('#manual-items-table tbody .amount').forEach(el => {
            total += parseFloat(el.value || 0);
        });
        document.getElementById('grand-total').value = total.toFixed(2);
    }

    document.querySelectorAll('#manual-items-table tbody tr').forEach(bindManualRow);

    document.getElementById('add-row').addEventListener('click', () => {
        const tbody = document.querySelector('#manual-items-table tbody');
        const row = tbody.querySelector('tr').cloneNode(true);

        row.querySelectorAll('input').forEach(i => {
            if (i.classList.contains('qty')) {
                i.value = '1';
            } else if (i.classList.contains('price') || i.classList.contains('amount')) {
                i.value = '0';
            } else {
                i.value = '';
            }
        });

        tbody.appendChild(row);
        bindManualRow(row);
        calcGrandTotal();
    });
</script>