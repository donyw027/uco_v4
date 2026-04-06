<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Sales order management</h3>
            <p>Form dibuat lebih rapi supaya input transaksi terasa lebih ringan dan daftar order lebih cepat dibaca.</p>
        </div>
        <div class="badge-soft badge-soft-primary">SO → PL → Invoice workflow</div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-4 align-items-start">
                <div class="col-lg-8">
                    <h5 class="mb-1">Create Sales Order</h5>
                    <div class="text-muted small mb-3">Isi header order, lalu tambahkan item. Harga akan otomatis terisi saat pilih produk.</div>
                </div>
                <div class="col-lg-4">
                    <div class="quick-note">
                        <h6>Quick tip</h6>
                        <p>Setelah SO dibuat, kamu bisa langsung confirm, ship, generate packing list, atau generate invoice dari tabel di bawah.</p>
                    </div>
                </div>
            </div>
            <form method="post">
                <div class="row g-3 mt-1">
                    <div class="col-md-2"><label class="form-label">Order Date</label><input type="date" name="order_date" class="form-control" value="<?= date('Y-m-d'); ?>"></div>
                    <div class="col-md-4"><label class="form-label">Customer</label><select name="customer_id" class="form-select" required><option value="">- pilih customer -</option><?php foreach ($customers as $c): ?><option value="<?= e($c['id']); ?>"><?= e($c['company_name']); ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-2"><label class="form-label">Currency</label><select name="currency_id" class="form-select" required><?php foreach ($currencies as $c): ?><option value="<?= e($c['id']); ?>"><?= e($c['currency_code']); ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-2"><label class="form-label">Warehouse</label><select name="warehouse_id" class="form-select" required><?php foreach ($warehouses as $w): ?><option value="<?= e($w['id']); ?>"><?= e($w['warehouse_name']); ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-2"><label class="form-label">Incoterm</label><select name="incoterm_id" class="form-select"><?php foreach ($incoterms as $i): ?><option value="<?= e($i['id']); ?>"><?= e($i['incoterm_code']); ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-3"><label class="form-label">Payment Term</label><select name="payment_term_id" class="form-select"><?php foreach ($payment_terms as $p): ?><option value="<?= e($p['id']); ?>"><?= e($p['term_name']); ?></option><?php endforeach; ?></select></div>
                    <div class="col-md-5"><label class="form-label">Destination Port</label><input type="text" name="destination_port" class="form-control" placeholder="Example: Port of Rotterdam"></div>
                    <div class="col-md-4"><label class="form-label">Remarks</label><input type="text" name="remarks" class="form-control" placeholder="Additional order notes"></div>
                </div>
                <div class="table-responsive mt-4">
                    <table class="table table-sm align-middle" id="items-table">
                        <thead>
                            <tr>
                                <th width="25%">Product</th>
                                <th>Description</th>
                                <th width="12%">Qty</th>
                                <th width="15%">Unit Price</th>
                                <th width="15%">Amount</th>
                                <th width="70">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><select name="product_id[]" class="form-select product-select" required><option value="">- pilih produk -</option><?php foreach ($products as $p): ?><option value="<?= e($p['id']); ?>" data-price="<?= e($p['sales_price']); ?>"><?= e($p['product_name']); ?></option><?php endforeach; ?></select></td>
                                <td><input type="text" name="description[]" class="form-control" placeholder="Product detail / specification"></td>
                                <td><input type="number" step="0.01" name="qty[]" class="form-control qty"></td>
                                <td><input type="number" step="0.01" name="unit_price[]" class="form-control price"></td>
                                <td><input type="text" class="form-control amount" readonly></td>
                                <td><button type="button" class="btn btn-sm btn-outline-danger remove-row">x</button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="add-row">+ Add Item</button>
                    <button class="btn btn-dark">Save Sales Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Sales order list</h3>
            <p>Daftar order dengan action cepat untuk confirm, ship, generate packing list, dan generate invoice.</p>
        </div>
    </div>
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0">
                    <thead>
                        <tr>
                            <th>SO No</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Warehouse</th>
                            <th>Status</th>
                            <th>Currency</th>
                            <th class="text-end">Total</th>
                            <th width="420">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php if (!$rows): ?>
                        <tr><td colspan="8" class="empty-state">Belum ada data sales order.</td></tr>
                    <?php else: foreach ($rows as $row): ?>
                        <?php $status_class = $row['status'] === 'SHIPPED' ? 'success' : ($row['status'] === 'CONFIRMED' ? 'primary' : 'secondary'); ?>
                        <tr>
                            <td><a href="#" class="view-so fw-semibold" data-id="<?= e($row['id']); ?>"><?= e($row['so_no']); ?></a></td>
                            <td><?= format_date_id($row['order_date']); ?></td>
                            <td><?= e($row['company_name']); ?></td>
                            <td><?= e($row['warehouse_name']); ?></td>
                            <td><span class="badge-soft badge-soft-<?= $status_class; ?>"><?= e($row['status']); ?></span></td>
                            <td><?= e($row['currency_code']); ?></td>
                            <td class="text-end fw-semibold"><?= format_money($row['total_amount']); ?></td>
                            <td>
                                <div class="table-action-group">
                                    <?php if ($row['status'] === 'DRAFT'): ?><a href="<?= site_url('transactions/sales-orders?confirm=' . $row['id']); ?>" class="btn btn-sm btn-outline-primary">Confirm</a><?php endif; ?>
                                    <?php if ($row['status'] !== 'SHIPPED'): ?><a href="<?= site_url('transactions/sales-orders?ship=' . $row['id']); ?>" class="btn btn-sm btn-warning" onclick="return confirm('Ship SO ini dan kurangi stok gudang?')">Ship</a><?php endif; ?>
                                    <a href="<?= site_url('transactions/sales-orders?generate_pl=' . $row['id']); ?>" class="btn btn-sm btn-primary">Generate PL</a>
                                    <a href="<?= site_url('transactions/sales-orders?generate_inv=' . $row['id']); ?>" class="btn btn-sm btn-success">Generate Invoice</a>
                                    <form method="post" class="d-inline" onsubmit="return confirm('Hapus sales order ini?')"><input type="hidden" name="action" value="delete"><input type="hidden" name="id" value="<?= e($row['id']); ?>"><button class="btn btn-sm btn-outline-danger">Delete</button></form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="soModal" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content glass-card">
            <div class="modal-header">
                <h5 class="modal-title">Sales Order Detail</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body" id="soDetailContent">Loading...</div>
        </div>
    </div>
</div>
<script>
function bindRow(row) {
    const product = row.querySelector('.product-select');
    const qty = row.querySelector('.qty');
    const price = row.querySelector('.price');
    const amount = row.querySelector('.amount');
    const calc = () => { amount.value = ((parseFloat(qty.value) || 0) * (parseFloat(price.value) || 0)).toFixed(2) };
    product.addEventListener('change', () => { price.value = product.selectedOptions[0]?.dataset?.price || ''; calc(); });
    qty.addEventListener('input', calc);
    price.addEventListener('input', calc);
    row.querySelector('.remove-row').addEventListener('click', () => {
        if (document.querySelectorAll('#items-table tbody tr').length > 1) row.remove();
    });
}
document.querySelectorAll('#items-table tbody tr').forEach(bindRow);
document.getElementById('add-row').addEventListener('click', () => {
    const tbody = document.querySelector('#items-table tbody');
    const row = tbody.querySelector('tr').cloneNode(true);
    row.querySelectorAll('input').forEach(i => i.value = '');
    row.querySelector('select').selectedIndex = 0;
    tbody.appendChild(row);
    bindRow(row);
});
document.querySelectorAll('.view-so').forEach(btn => {
    btn.addEventListener('click', function(e) {
        e.preventDefault();
        fetch('<?= site_url('transactions/so-detail'); ?>/' + this.dataset.id).then(r => r.text()).then(html => {
            document.getElementById('soDetailContent').innerHTML = html;
            new bootstrap.Modal(document.getElementById('soModal')).show();
        });
    });
});
</script>
