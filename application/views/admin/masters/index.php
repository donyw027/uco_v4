<?php
$count_rows = is_array($rows) ? count($rows) : 0;
$title_map = [
  'products' => 'Kelola katalog produk, harga jual, dan data NW / GW / CBM per unit.',
  'customers' => 'Simpan buyer dan customer export agar transaksi lebih cepat saat create SO.',
  'suppliers' => 'Kelola data vendor atau supplier untuk kebutuhan sourcing dan operasional.',
  'uom' => 'Atur satuan unit yang dipakai oleh produk dan transaksi.',
  'currencies' => 'Kelola mata uang untuk sales order dan invoice internasional.',
  'incoterms' => 'Standarkan term perdagangan agar dokumen export lebih konsisten.',
  'payment_terms' => 'Simpan skema pembayaran yang sering dipakai saat transaksi.',
  'warehouses' => 'Kelola gudang aktif untuk flow inbound, stock, dan shipment.',
  'users' => 'Atur akses admin dan staff agar operasional lebih tertib.',
];
$form_title = $edit ? 'Edit data ' . strtolower($page_title) : 'Tambah data ' . strtolower($page_title);
$section_desc = $title_map[$slug] ?? 'Kelola master data sistem dengan tampilan yang lebih modern dan mudah dipahami.';
?>

<div class="section-block">
  <div class="section-head">
    <div>
      <h3><?= e($page_title); ?></h3>
      <p><?= e($section_desc); ?></p>
    </div>
    <span class="badge-soft badge-soft-primary"><?= $count_rows; ?> total data</span>
  </div>

  <div class="row g-4">

    <!-- FORM COLLAPSIBLE -->
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
          <div>
            <strong><?= e(ucfirst($form_title)); ?></strong>
            <div class="text-muted small">Form lebih rapi supaya input master data terasa lebih ringan.</div>
          </div>

          <div class="d-flex align-items-center gap-2">
            <?php if ($edit): ?>
              <span class="badge-soft badge-soft-warning">Edit mode</span>
            <?php else: ?>
              <span class="badge-soft badge-soft-success">Create mode</span>
            <?php endif; ?>

            <button
              class="btn btn-sm btn-outline-dark"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#masterFormCollapse"
              aria-expanded="<?= $edit ? 'true' : 'false'; ?>"
              aria-controls="masterFormCollapse">
              <i class="bi bi-chevron-down me-1"></i>
              <?= $edit ? 'Hide / Show Form' : 'Open Form'; ?>
            </button>
          </div>
        </div>

        <div class="collapse <?= $edit ? 'show' : ''; ?>" id="masterFormCollapse">
          <div class="card-body">
            <form method="post" class="row g-3">
              <input type="hidden" name="action" value="<?= $edit ? 'update' : 'create'; ?>">
              <?php if ($edit): ?>
                <input type="hidden" name="id" value="<?= e($edit['id']); ?>">
              <?php endif; ?>

              <?php if ($slug === 'customers'): ?>

                <div class="col-md-4">
                  <label class="form-label">Customer Code</label>
                  <input type="text" name="customer_code" class="form-control" placeholder="Example: CUST-001" value="<?= e($edit['customer_code'] ?? ''); ?>">
                </div>
                <div class="col-md-8">
                  <label class="form-label">Company Name</label>
                  <input type="text" name="company_name" class="form-control" value="<?= e($edit['company_name'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">PIC</label>
                  <input type="text" name="pic_name" class="form-control" value="<?= e($edit['pic_name'] ?? ''); ?>">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Email</label>
                  <input type="text" name="email" class="form-control" value="<?= e($edit['email'] ?? ''); ?>">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Phone</label>
                  <input type="text" name="phone" class="form-control" value="<?= e($edit['phone'] ?? ''); ?>">
                </div>
                <div class="col-md-8">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control"><?= e($edit['address'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-2">
                  <label class="form-label">Country</label>
                  <input type="text" name="country" class="form-control" value="<?= e($edit['country'] ?? ''); ?>">
                </div>
                <div class="col-md-2">
                  <label class="form-label">Status</label>
                  <select name="is_active" class="form-select">
                    <option value="1" <?= (($edit['is_active'] ?? 1) == 1) ? 'selected' : ''; ?>>Active</option>
                    <option value="0" <?= (($edit['is_active'] ?? 1) == 0) ? 'selected' : ''; ?>>Inactive</option>
                  </select>
                </div>

              <?php elseif ($slug === 'suppliers'): ?>

                <div class="col-md-6">
                  <label class="form-label">Company Name</label>
                  <input type="text" name="company_name" class="form-control" value="<?= e($edit['company_name'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">PIC</label>
                  <input type="text" name="pic_name" class="form-control" value="<?= e($edit['pic_name'] ?? ''); ?>">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Email</label>
                  <input type="text" name="email" class="form-control" value="<?= e($edit['email'] ?? ''); ?>">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Phone</label>
                  <input type="text" name="phone" class="form-control" value="<?= e($edit['phone'] ?? ''); ?>">
                </div>
                <div class="col-md-4">
                  <label class="form-label">Country</label>
                  <input type="text" name="country" class="form-control" value="<?= e($edit['country'] ?? ''); ?>">
                </div>
                <div class="col-12">
                  <label class="form-label">Address</label>
                  <textarea name="address" class="form-control"><?= e($edit['address'] ?? ''); ?></textarea>
                </div>

              <?php elseif ($slug === 'uom'): ?>

                <div class="col-md-6">
                  <label class="form-label">UOM Name</label>
                  <input type="text" name="uom_name" class="form-control" placeholder="Example: PCS / KG / MT" value="<?= e($edit['uom_name'] ?? ''); ?>" required>
                </div>

              <?php elseif ($slug === 'currencies'): ?>

                <div class="col-md-3">
                  <label class="form-label">Currency Code</label>
                  <input type="text" name="currency_code" class="form-control text-uppercase" placeholder="USD" value="<?= e($edit['currency_code'] ?? ''); ?>" required>
                </div>
                <div class="col-md-6">
                  <label class="form-label">Currency Name</label>
                  <input type="text" name="currency_name" class="form-control" value="<?= e($edit['currency_name'] ?? ''); ?>" required>
                </div>

              <?php elseif ($slug === 'incoterms'): ?>

                <div class="col-md-4">
                  <label class="form-label">Incoterm Code</label>
                  <input type="text" name="incoterm_code" class="form-control text-uppercase" placeholder="FOB / CIF / CFR" value="<?= e($edit['incoterm_code'] ?? ''); ?>" required>
                </div>
                <div class="col-md-8">
                  <label class="form-label">Description</label>
                  <textarea name="description" class="form-control"><?= e($edit['description'] ?? ''); ?></textarea>
                </div>

              <?php elseif ($slug === 'payment_terms'): ?>

                <div class="col-md-4">
                  <label class="form-label">Term Name</label>
                  <input type="text" name="term_name" class="form-control" placeholder="Advance Payment / 30 Days" value="<?= e($edit['term_name'] ?? ''); ?>" required>
                </div>
                <div class="col-md-8">
                  <label class="form-label">Description</label>
                  <textarea name="description" class="form-control"><?= e($edit['description'] ?? ''); ?></textarea>
                </div>

              <?php elseif ($slug === 'warehouses'): ?>

                <div class="col-md-3">
                  <label class="form-label">Code</label>
                  <input type="text" name="code" class="form-control" value="<?= e($edit['code'] ?? ''); ?>" required>
                </div>
                <div class="col-md-5">
                  <label class="form-label">Warehouse Name</label>
                  <input type="text" name="warehouse_name" class="form-control" value="<?= e($edit['warehouse_name'] ?? ''); ?>" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Status</label>
                  <select name="is_active" class="form-select">
                    <option value="1" <?= (($edit['is_active'] ?? 1) == 1) ? 'selected' : ''; ?>>Active</option>
                    <option value="0" <?= (($edit['is_active'] ?? 1) == 0) ? 'selected' : ''; ?>>Inactive</option>
                  </select>
                </div>
                <div class="col-12">
                  <label class="form-label">Location</label>
                  <textarea name="location" class="form-control"><?= e($edit['location'] ?? ''); ?></textarea>
                </div>

              <?php elseif ($slug === 'users'): ?>

                <div class="col-md-4">
                  <label class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" value="<?= e($edit['nama'] ?? ''); ?>" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Username</label>
                  <input type="text" name="username" class="form-control" value="<?= e($edit['username'] ?? ''); ?>" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Password <?= $edit ? '<small class="text-muted">(kosongkan jika tidak ganti)</small>' : ''; ?></label>
                  <input type="password" name="password" class="form-control" <?= $edit ? '' : 'required'; ?>>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Role</label>
                  <select name="role" class="form-select">
                    <option value="admin" <?= (($edit['role'] ?? '') === 'admin') ? 'selected' : ''; ?>>admin</option>
                    <option value="staff" <?= (($edit['role'] ?? '') === 'staff') ? 'selected' : ''; ?>>staff</option>
                  </select>
                </div>
                <div class="col-md-3">
                  <label class="form-label">Status</label>
                  <select name="is_active" class="form-select">
                    <option value="1" <?= (($edit['is_active'] ?? 1) == 1) ? 'selected' : ''; ?>>Active</option>
                    <option value="0" <?= (($edit['is_active'] ?? 1) == 0) ? 'selected' : ''; ?>>Inactive</option>
                  </select>
                </div>

              <?php elseif ($slug === 'products'): ?>

                <div class="col-md-3">
                  <label class="form-label">Code</label>
                  <input type="text" name="code" class="form-control" value="<?= e($edit['code'] ?? ''); ?>" required>
                </div>
                <div class="col-md-5">
                  <label class="form-label">Product Name</label>
                  <input type="text" name="product_name" class="form-control" value="<?= e($edit['product_name'] ?? ''); ?>" required>
                </div>
                <div class="col-md-4">
                  <label class="form-label">UOM</label>
                  <select name="uom_id" class="form-select">
                    <?php foreach ($uoms as $u): ?>
                      <option value="<?= e($u['id']); ?>" <?= (($edit['uom_id'] ?? '') == $u['id']) ? 'selected' : ''; ?>>
                        <?= e($u['uom_name']); ?>
                      </option>
                    <?php endforeach; ?>
                  </select>
                </div>

                <div class="col-md-8">
                  <label class="form-label">Description</label>
                  <textarea name="description" class="form-control"><?= e($edit['description'] ?? ''); ?></textarea>
                </div>
                <div class="col-md-4">
                  <label class="form-label">Sales Price</label>
                  <input type="number" step="0.01" name="sales_price" class="form-control" value="<?= e($edit['sales_price'] ?? 0); ?>">
                </div>

                <div class="col-md-3">
                  <label class="form-label">NW / Unit</label>
                  <input type="number" step="0.0001" name="nw_unit" class="form-control" value="<?= e($edit['nw_unit'] ?? 0); ?>">
                </div>
                <div class="col-md-3">
                  <label class="form-label">GW / Unit</label>
                  <input type="number" step="0.0001" name="gw_unit" class="form-control" value="<?= e($edit['gw_unit'] ?? 0); ?>">
                </div>
                <div class="col-md-3">
                  <label class="form-label">CBM / Unit</label>
                  <input type="number" step="0.0001" name="cbm_unit" class="form-control" value="<?= e($edit['cbm_unit'] ?? 0); ?>">
                </div>
                <div class="col-md-3">
                  <label class="form-label">Packages / Unit</label>
                  <input type="number" step="0.0001" name="package_unit" class="form-control" value="<?= e($edit['package_unit'] ?? 1); ?>">
                </div>

                <div class="col-md-12">
                  <div class="form-hint">Nilai NW, GW, CBM, dan packages per unit akan dipakai otomatis saat generate Packing List.</div>
                </div>

                <div class="col-md-3">
                  <label class="form-label">Status</label>
                  <select name="is_active" class="form-select">
                    <option value="1" <?= (($edit['is_active'] ?? 1) == 1) ? 'selected' : ''; ?>>Active</option>
                    <option value="0" <?= (($edit['is_active'] ?? 1) == 0) ? 'selected' : ''; ?>>Inactive</option>
                  </select>
                </div>

              <?php endif; ?>

              <div class="col-12 d-flex flex-wrap gap-2 pt-2">
                <button class="btn btn-dark"><?= $edit ? 'Update Data' : 'Save Data'; ?></button>
                <?php if ($edit): ?>
                  <a href="<?= site_url('masters/' . $slug); ?>" class="btn btn-outline-secondary">Cancel</a>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- TABLE -->
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
          <div>
            <strong><?= e($page_title); ?> directory</strong>
            <div class="text-muted small">List data dibuat lebih clean supaya gampang discan dan lebih enak untuk operasional harian.</div>
          </div>

          <div class="d-flex align-items-center gap-2">
            <div class="badge-soft badge-soft-secondary">Module: <?= e($slug); ?></div>

            <button
              class="btn btn-sm btn-dark"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#masterFormCollapse"
              aria-expanded="<?= $edit ? 'true' : 'false'; ?>"
              aria-controls="masterFormCollapse">
              <i class="bi bi-plus-lg me-1"></i> Add New
            </button>
          </div>
        </div>

        <div class="card-body p-0">
          <div class="table-responsive">
            <table class="table table-sm mb-0 align-middle">
              <thead>
                <tr>
                  <?php if ($slug === 'products'): ?>
                    <th>Code</th>
                    <th>Product</th>
                    <th>UOM</th>
                    <th class="text-end">Price</th>
                    <th>Status</th>
                    <th width="160">Action</th>
                  <?php elseif ($slug === 'customers'): ?>
                    <th>Code</th>
                    <th>Company</th>
                    <th>Country</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th width="160">Action</th>
                  <?php elseif ($slug === 'suppliers'): ?>
                    <th>Company</th>
                    <th>Country</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th width="160">Action</th>
                  <?php elseif ($slug === 'uom'): ?>
                    <th>UOM</th>
                    <th width="160">Action</th>
                  <?php elseif ($slug === 'currencies'): ?>
                    <th>Code</th>
                    <th>Name</th>
                    <th width="160">Action</th>
                  <?php elseif ($slug === 'incoterms'): ?>
                    <th>Code</th>
                    <th>Description</th>
                    <th width="160">Action</th>
                  <?php elseif ($slug === 'payment_terms'): ?>
                    <th>Term</th>
                    <th>Description</th>
                    <th width="160">Action</th>
                  <?php elseif ($slug === 'warehouses'): ?>
                    <th>Code</th>
                    <th>Warehouse</th>
                    <th>Location</th>
                    <th>Status</th>
                    <th width="160">Action</th>
                  <?php elseif ($slug === 'users'): ?>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th width="160">Action</th>
                  <?php endif; ?>
                </tr>
              </thead>
              <tbody>
                <?php if (!$rows): ?>
                  <tr>
                    <td colspan="6" class="empty-state">Belum ada data <?= e(strtolower($page_title)); ?>.</td>
                  </tr>
                  <?php else: foreach ($rows as $row): ?>
                    <tr>
                      <?php if ($slug === 'products'): ?>
                        <td class="fw-semibold"><?= e($row['code']); ?></td>
                        <td>
                          <div class="fw-semibold"><?= e($row['product_name']); ?></div>
                          <div class="small-muted"><?= e($row['description']); ?></div>
                        </td>
                        <td><?= e($row['uom_id'] ?? '-'); ?></td>
                        <td class="text-end fw-semibold"><?= format_money($row['sales_price'] ?? 0); ?></td>
                        <td><span class="badge-soft badge-soft-<?= (($row['is_active'] ?? 1) ? 'success' : 'secondary'); ?>"><?= (($row['is_active'] ?? 1) ? 'Active' : 'Inactive'); ?></span></td>

                      <?php elseif ($slug === 'customers'): ?>
                        <td class="fw-semibold"><?= e($row['customer_code']); ?></td>
                        <td>
                          <div class="fw-semibold"><?= e($row['company_name']); ?></div>
                          <div class="small-muted"><?= e($row['pic_name']); ?></div>
                        </td>
                        <td><?= e($row['country']); ?></td>
                        <td><?= e($row['email']); ?></td>
                        <td><span class="badge-soft badge-soft-<?= (($row['is_active'] ?? 1) ? 'success' : 'secondary'); ?>"><?= (($row['is_active'] ?? 1) ? 'Active' : 'Inactive'); ?></span></td>

                      <?php elseif ($slug === 'suppliers'): ?>
                        <td class="fw-semibold"><?= e($row['company_name']); ?></td>
                        <td><?= e($row['country']); ?></td>
                        <td><?= e($row['email']); ?></td>
                        <td><?= e($row['phone']); ?></td>

                      <?php elseif ($slug === 'uom'): ?>
                        <td class="fw-semibold"><?= e($row['uom_name']); ?></td>

                      <?php elseif ($slug === 'currencies'): ?>
                        <td class="fw-semibold"><?= e($row['currency_code']); ?></td>
                        <td><?= e($row['currency_name']); ?></td>

                      <?php elseif ($slug === 'incoterms'): ?>
                        <td class="fw-semibold"><?= e($row['incoterm_code']); ?></td>
                        <td><?= e($row['description']); ?></td>

                      <?php elseif ($slug === 'payment_terms'): ?>
                        <td class="fw-semibold"><?= e($row['term_name']); ?></td>
                        <td><?= e($row['description']); ?></td>

                      <?php elseif ($slug === 'warehouses'): ?>
                        <td class="fw-semibold"><?= e($row['code']); ?></td>
                        <td><?= e($row['warehouse_name']); ?></td>
                        <td><?= e($row['location']); ?></td>
                        <td><span class="badge-soft badge-soft-<?= (($row['is_active'] ?? 1) ? 'success' : 'secondary'); ?>"><?= (($row['is_active'] ?? 1) ? 'Active' : 'Inactive'); ?></span></td>

                      <?php elseif ($slug === 'users'): ?>
                        <td class="fw-semibold"><?= e($row['nama']); ?></td>
                        <td><?= e($row['username']); ?></td>
                        <td class="text-capitalize"><?= e($row['role']); ?></td>
                        <td><span class="badge-soft badge-soft-<?= (($row['is_active'] ?? 1) ? 'success' : 'secondary'); ?>"><?= (($row['is_active'] ?? 1) ? 'Active' : 'Inactive'); ?></span></td>
                      <?php endif; ?>

                      <td>
                        <div class="table-action-group">
                          <a href="<?= site_url('masters/' . $slug . '?edit=' . $row['id']); ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                          <form method="post" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                            <input type="hidden" name="action" value="delete">
                            <input type="hidden" name="id" value="<?= e($row['id']); ?>">
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                          </form>
                        </div>
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

  </div>
</div>