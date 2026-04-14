<div class="section-block">
    <div class="section-head">
        <div>
            <h3>Inquiry Management</h3>
            <p>Create consulting service proposals manually, then save and print or print directly without saving.</p>
        </div>
        <div class="badge-soft badge-soft-primary">Manual Consulting Inquiry</div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5 class="mb-1">Create Inquiry / Proposal</h5>
            <div class="text-muted small mb-3">
                This form is intended for consulting service proposals and manual inquiries.
            </div>

            <form method="post">
                <div class="row g-3">
                    <div class="col-md-3">
                        <label class="form-label">Proposal No</label>
                        <input type="text" name="proposal_no" class="form-control" placeholder="Auto generate if empty">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Proposal Date</label>
                        <input type="date" name="proposal_date" class="form-control" value="<?= date('Y-m-d'); ?>" required>
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Currency Text</label>
                        <input type="text" name="currency_text" class="form-control" value="IDR" placeholder="IDR / USD / GBP">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Attention / PIC</label>
                        <input type="text" name="recipient_pic" class="form-control" placeholder="PIC / Director / Manager">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Recipient Company</label>
                        <input type="text" name="recipient_company" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Subject / Service Title</label>
                        <input type="text" name="subject" class="form-control" value="Pengurusan Izin Penambahan Barang Jadi Kategori DHE SDA">
                    </div>

                    <div class="col-12">
                        <label class="form-label">Recipient Address</label>
                        <textarea name="recipient_address" class="form-control" rows="3" placeholder="Pasuruan – Indonesia"></textarea>
                    </div>

                    <div class="col-12">
                        <label class="form-label">Opening Text</label>
                        <textarea name="opening_text" class="form-control" rows="4">Bersama ini kami menyampaikan penawaran jasa pengurusan perizinan penambahan barang jadi kategori DHE SDA yang akan berhubungan dengan KPPBC Pusat serta Kementerian Perdagangan Republik Indonesia.</textarea>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-sm align-middle" id="manual-inquiry-items-table">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th width="220">Agency / Instansi</th>
                                <th width="150">Duration</th>
                                <th width="170">Amount</th>
                                <th width="70">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <textarea name="description[]" class="form-control" rows="2" placeholder="Service description">Registrasi & Izin Penambahan Barang Jadi (Calcium Soap & Shortening)</textarea>
                                </td>
                                <td>
                                    <input type="text" name="agency[]" class="form-control" value="KPPBC Pusat & Kemendag">
                                </td>
                                <td>
                                    <input type="text" name="duration_text[]" class="form-control" value="±5 Hari Kerja">
                                </td>
                                <td>
                                    <input type="number" step="0.01" name="amount[]" class="form-control inquiry-amount" value="32000000">
                                </td>
                                <td>
                                    <button type="button" class="btn btn-sm btn-outline-danger remove-row">×</button>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="3" class="text-end">Total</th>
                                <th><input type="text" class="form-control" id="inquiry-grand-total" readonly></th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <label class="form-label">Terms / Ketentuan</label>
                        <textarea name="terms_text" class="form-control" rows="5">• Pembayaran: 30% saat SPK, 70% setelah izin terbit
• Dokumen disiapkan oleh pihak perusahaan
• Biaya belum termasuk perubahan regulasi tambahan</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Closing Text</label>
                        <textarea name="closing_text" class="form-control" rows="5">Demikian proposal ini kami sampaikan. Kami berharap dapat menjalin kerja sama yang baik dengan perusahaan Bapak/Ibu.</textarea>
                    </div>
                </div>

                <div class="d-flex flex-wrap gap-2 align-items-center mt-3">
                    <button type="button" class="btn btn-outline-secondary btn-sm" id="add-inquiry-row">+ Add Item</button>

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
            <h3>Saved Inquiry List</h3>
            <p>Saved manual proposals will appear here.</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm mb-0 align-middle">
                    <thead>
                        <tr>
                            <th>Proposal No</th>
                            <th>Date</th>
                            <th>Recipient</th>
                            <th>Subject</th>
                            <th width="140">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($rows)): ?>
                            <tr>
                                <td colspan="5" class="empty-state">No inquiries yet.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td class="fw-semibold"><?= e($row['proposal_no']); ?></td>
                                    <td><?= format_date_id($row['proposal_date']); ?></td>
                                    <td><?= e($row['recipient_company']); ?></td>
                                    <td><?= e($row['subject']); ?></td>
                                    <td>
                                        <a href="<?= site_url('transactions/print-manual-inquiry/' . $row['id']); ?>" target="_blank" class="btn btn-sm btn-success">Print</a>

                                        <a href="<?= site_url('transactions/delete-manual-inquiry/' . $row['id']); ?>"
                                            onclick="return confirm('Delete this inquiry?')"
                                            class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function formatNumberInquiry(num) {
        num = parseFloat(num || 0);
        return num.toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function calcInquiryGrandTotal() {
        let total = 0;
        document.querySelectorAll('.inquiry-amount').forEach(el => {
            total += parseFloat(el.value || 0);
        });
        document.getElementById('inquiry-grand-total').value = formatNumberInquiry(total);
    }

    function bindInquiryRow(row) {
        const amount = row.querySelector('.inquiry-amount');

        amount.addEventListener('input', calcInquiryGrandTotal);

        row.querySelector('.remove-row').addEventListener('click', () => {
            if (document.querySelectorAll('#manual-inquiry-items-table tbody tr').length > 1) {
                row.remove();
                calcInquiryGrandTotal();
            }
        });
    }

    document.querySelectorAll('#manual-inquiry-items-table tbody tr').forEach(bindInquiryRow);
    calcInquiryGrandTotal();

    document.getElementById('add-inquiry-row').addEventListener('click', () => {
        const tbody = document.querySelector('#manual-inquiry-items-table tbody');
        const row = tbody.querySelector('tr').cloneNode(true);

        row.querySelectorAll('input, textarea').forEach(i => {
            if (i.name === 'agency[]') {
                i.value = '';
            } else if (i.name === 'duration_text[]') {
                i.value = '';
            } else if (i.name === 'amount[]') {
                i.value = '0';
            } else {
                i.value = '';
            }
        });

        tbody.appendChild(row);
        bindInquiryRow(row);
        calcInquiryGrandTotal();
    });
</script>