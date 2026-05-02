<?php
$edit = isset($edit) && is_array($edit) ? $edit : null;
$GLOBALS['edit'] = $edit;
function spkf($k, $d = '')
{
  $e = $GLOBALS['edit'] ?? null;
  return e(is_array($e) ? ($e[$k] ?? $d) : $d);
}
$scopes = !empty($edit_scopes) ? $edit_scopes : [
  ['scope_text' => 'Konsultasi pengurusan izin penambahan barang jadi kategori DHE SDA'],
  ['scope_text' => 'Training pengurusan izin penambahan barang jadi kategori DHE SDA'],
  ['scope_text' => 'Pengajuan dan penerbitan izin penambahan barang jadi kategori DHE SDA'],
  ['scope_text' => 'Koordinasi dengan pejabat/instansi terkait'],
];
$timelines = !empty($edit_timelines) ? $edit_timelines : [
  ['activity' => 'SPK, Payment', 'leadtime' => 'D.I', 'pic' => 'CGG - UCO'],
  ['activity' => 'Verifikasi akun', 'leadtime' => 'D.I - D.II', 'pic' => 'UCO'],
  ['activity' => 'Pendampingan', 'leadtime' => 'D.II', 'pic' => 'UCO'],
  ['activity' => 'Pemenuhan Data', 'leadtime' => 'D.II - D.III', 'pic' => 'CGG'],
  ['activity' => 'Pengajuan izin', 'leadtime' => 'D.III', 'pic' => 'UCO'],
  ['activity' => 'Penerbitan izin', 'leadtime' => 'D.IV', 'pic' => 'UCO'],
];
?>
<div class="section-block">
  <div class="section-head">
    <div>
      <h3>Work Agreement / SPK</h3>
      <p>Create bilingual service agreements with Word-like A4 print output.</p>
    </div>
    <div class="badge-soft badge-soft-primary">SPK Jasa Konsultasi</div>
  </div>
  <div class="card shadow-sm mb-4">
    <div class="card-body">
      <h5 class="mb-1"><?= $edit ? 'Edit SPK' : 'Create SPK'; ?></h5>
      <form method="post" id="spkForm"><?php if ($edit): ?><input type="hidden" name="id" value="<?= e($edit['id']); ?>"><?php endif; ?>
        <div class="row g-3">
          <div class="col-md-3"><label class="form-label">SPK No</label><input type="text" name="agreement_no" class="form-control" value="<?= spkf('agreement_no'); ?>" placeholder="Auto if empty"></div>
          <div class="col-md-3"><label class="form-label">Date</label><input type="date" name="agreement_date" class="form-control" value="<?= spkf('agreement_date', date('Y-m-d')); ?>" required></div>
          <div class="col-md-3"><label class="form-label">Language</label><select name="language" class="form-select">
              <option value="id" <?= spkf('language', 'id') === 'id' ? 'selected' : ''; ?>>Indonesia</option>
              <option value="en" <?= spkf('language') === 'en' ? 'selected' : ''; ?>>English</option>
            </select></div>
          <div class="col-md-3"><label class="form-label">Template</label><select name="template_type" class="form-select">
              <option value="consulting_service">Consulting Service</option>
              <option value="permit_service">Permit Processing Service</option>
              <option value="export_import_consulting">Export / Import Consulting</option>
            </select></div>
          <div class="col-md-6"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="<?= spkf('title', 'SURAT PERJANJIAN KERJA'); ?>"></div>
          <div class="col-md-6"><label class="form-label">Subject</label><input type="text" name="subject" class="form-control" value="<?= spkf('subject', 'Pekerjaan Jasa Konsultan Penyusunan Izin Penambahan Barang Jadi Kategori DHE SDA'); ?>"></div>
          <div class="col-md-3"><label class="form-label">Place Signed</label><input type="text" name="place_signed" class="form-control" value="<?= spkf('place_signed', 'Mojokerto'); ?>"></div>
        </div>
        <hr>
        <h6>PIHAK KESATU / First Party</h6>
        <div class="row g-3">
          <div class="col-md-3"><label class="form-label">PIC Name</label><input type="text" name="party_one_name" class="form-control" value="<?= spkf('party_one_name', 'Fred Dean Kurambek'); ?>"></div>
          <div class="col-md-3"><label class="form-label">Position</label><input type="text" name="party_one_position" class="form-control" value="<?= spkf('party_one_position', 'Direktur'); ?>"></div>
          <div class="col-md-3"><label class="form-label">Company</label><input type="text" name="party_one_company" class="form-control" value="<?= spkf('party_one_company', 'PT. CANADA GREEN GATE'); ?>"></div>
          <div class="col-md-3"><label class="form-label">Address / Domicile</label><input type="text" name="party_one_address" class="form-control" value="<?= spkf('party_one_address', 'Kabupaten Pasuruan, Jawa Timur'); ?>"></div>
        </div>
        <hr>
        <h6>PIHAK KEDUA / Second Party</h6>
        <div class="row g-3">
          <div class="col-md-3"><label class="form-label">PIC Name</label><input type="text" name="party_two_name" class="form-control" value="<?= spkf('party_two_name', 'Doni Wicaksono'); ?>"></div>
          <div class="col-md-3"><label class="form-label">Position</label><input type="text" name="party_two_position" class="form-control" value="<?= spkf('party_two_position', 'Head Of Marketing'); ?>"></div>
          <div class="col-md-3"><label class="form-label">Company</label><input type="text" name="party_two_company" class="form-control" value="<?= spkf('party_two_company', 'CV UCO EXPORTINDO CONSULTING'); ?>"></div>
          <div class="col-md-3"><label class="form-label">Address / Domicile</label><input type="text" name="party_two_address" class="form-control" value="<?= spkf('party_two_address', 'Mojokerto, Jawa Timur'); ?>"></div>
        </div>
        <hr>
        <div class="row g-3">
          <div class="col-md-8"><label class="form-label">Work Description</label><textarea name="work_description" class="form-control" rows="3"><?= spkf('work_description', 'Pekerjaan Jasa Konsultan Penyusunan Izin Penambahan Barang Jadi Kategori DHE SDA yaitu Caustic Soda Liquid'); ?></textarea></div>
          <div class="col-md-4"><label class="form-label">Duration Text</label><textarea name="duration_text" class="form-control" rows="3"><?= spkf('duration_text', 'Maksimal 5 hari kerja terhitung pembayaran Tahap Pertama dilakukan dan disertai kelengkapan data perizinan yang dibutuhkan terpenuhi.'); ?></textarea></div>
        </div>
        <div class="table-responsive mt-3">
          <table class="table table-sm" id="scopeTable">
            <thead>
              <tr>
                <th>Scope of Work</th>
                <th width="60"></th>
              </tr>
            </thead>
            <tbody><?php foreach ($scopes as $s): ?><tr>
                  <td><input type="text" name="scope_text[]" class="form-control" value="<?= e($s['scope_text'] ?? ''); ?>"></td>
                  <td><button type="button" class="btn btn-sm btn-danger btn-remove">&times;</button></td>
                </tr><?php endforeach; ?></tbody>
          </table>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary" id="addScope">+ Add Scope</button>
        <hr>
        <h6>Payment & Tax Clause</h6>
        <div class="row g-3">
          <div class="col-md-3"><label class="form-label">Total Amount</label><input type="number" step="0.01" name="total_amount" id="total_amount" class="form-control paycalc" value="<?= spkf('total_amount', '32000000'); ?>"></div>
          <div class="col-md-2"><label class="form-label">DP %</label><input type="number" step="0.01" name="dp_percent" id="dp_percent" class="form-control paycalc" value="<?= spkf('dp_percent', '30'); ?>"></div>
          <div class="col-md-3"><label class="form-label">DP Amount</label><input type="number" step="0.01" name="dp_amount" id="dp_amount" class="form-control" value="<?= spkf('dp_amount', '9600000'); ?>"></div>
          <div class="col-md-2"><label class="form-label">Settlement %</label><input type="number" step="0.01" name="settlement_percent" id="settlement_percent" class="form-control paycalc" value="<?= spkf('settlement_percent', '70'); ?>"></div>
          <div class="col-md-2"><label class="form-label">Settlement Amount</label><input type="number" step="0.01" name="settlement_amount" id="settlement_amount" class="form-control" value="<?= spkf('settlement_amount', '22400000'); ?>"></div>
          <div class="col-md-12"><label class="form-label">Settlement Trigger</label><input type="text" name="settlement_trigger_text" class="form-control" value="<?= spkf('settlement_trigger_text', 'pada saat terbitnya Skep Kawasan Berikat Yang Baru'); ?>"></div>
          <div class="col-md-12">
            <div class="form-check form-switch"><input class="form-check-input" type="checkbox" name="show_tax_clause" value="1" id="show_tax_clause" <?= (!$edit || !empty($edit['show_tax_clause'])) ? 'checked' : ''; ?>><label class="form-check-label" for="show_tax_clause">Tampilkan klausul PPN/PPH pada SPK</label></div>
          </div>
          <div class="col-md-12"><label class="form-label">Tax Clause Text</label><textarea name="tax_clause_text" class="form-control" rows="2"><?= spkf('tax_clause_text', 'Harga yang tercantum dalam perjanjian ini belum termasuk PPN dan PPH atas jasa, dan apabila dikenakan maka PPN akan dibebankan kepada PIHAK KESATU sesuai ketentuan perpajakan yang berlaku.'); ?></textarea></div>
        </div>
        <hr>
        <div class="row g-3">
          <div class="col-md-4"><label class="form-label">Evaluation Clause</label><textarea name="evaluation_text" class="form-control" rows="5"><?= spkf('evaluation_text', 'Dokumen Perizinan yang akan diajukan oleh PIHAK KEDUA kepada instansi terkait terlebih dahulu harus direview oleh kedua belah pihak sehingga dapat diterima/disetujui oleh PIHAK KESATU. Dalam pelaksanaan pekerjaan, PIHAK KEDUA senantiasa harus memelihara komunikasi dengan PIHAK KESATU maupun dengan Instansi/Kementerian terkait penerbit izin.'); ?></textarea></div>
          <div class="col-md-4"><label class="form-label">Force Majeure Clause</label><textarea name="force_majeure_text" class="form-control" rows="5"><?= spkf('force_majeure_text', 'Apabila kelambatan tersebut ternyata karena hal-hal di luar kemampuan manusia/Force Majeure, maka para pihak saling memberitahukan secara tertulis dan menyelesaikan keadaan tersebut dengan musyawarah untuk mencapai kemufakatan.'); ?></textarea></div>
          <div class="col-md-4"><label class="form-label">Other Terms Clause</label><textarea name="other_terms_text" class="form-control" rows="5"><?= spkf('other_terms_text', 'Para Pihak wajib menjaga segala kerahasiaan data ataupun identitas yang diberikan masing-masing pihak. Apabila ada perselisihan maka kedua belah pihak akan menyelesaikan secara musyawarah mufakat.'); ?></textarea></div>
        </div>
        <div class="table-responsive mt-3">
          <table class="table table-sm" id="timelineTable">
            <thead>
              <tr>
                <th>Activity</th>
                <th width="170">Leadtime</th>
                <th width="170">PIC</th>
                <th width="60"></th>
              </tr>
            </thead>
            <tbody><?php foreach ($timelines as $t): ?><tr>
                  <td><input type="text" name="activity[]" class="form-control" value="<?= e($t['activity'] ?? ''); ?>"></td>
                  <td><input type="text" name="leadtime[]" class="form-control" value="<?= e($t['leadtime'] ?? ''); ?>"></td>
                  <td><input type="text" name="pic[]" class="form-control" value="<?= e($t['pic'] ?? ''); ?>"></td>
                  <td><button type="button" class="btn btn-sm btn-danger btn-remove">&times;</button></td>
                </tr><?php endforeach; ?></tbody>
          </table>
        </div>
        <button type="button" class="btn btn-sm btn-outline-secondary" id="addTimeline">+ Add Timeline</button>
        <hr>
        <div class="row g-3">
          <div class="col-md-6"><label class="form-label">Signer First Party</label><input type="text" name="signer_party_one" class="form-control" value="<?= spkf('signer_party_one', 'Fred Dean Kurambek'); ?>"></div>
          <div class="col-md-6"><label class="form-label">Signer Second Party</label><input type="text" name="signer_party_two" class="form-control" value="<?= spkf('signer_party_two', 'Doni Wicaksono'); ?>"></div>
        </div>
        <div class="admin-form-actions mt-3">
          <?php if ($edit): ?><button type="submit" name="submit_action" value="update" class="btn btn-dark">Update</button><button type="submit" name="submit_action" value="update_print" class="btn btn-success">Update + Print</button><a href="<?= site_url('work-agreements'); ?>" class="btn btn-outline-secondary">Cancel</a><?php else: ?><button type="submit" name="submit_action" value="save_print" class="btn btn-dark">Save + Print</button><button type="submit" name="submit_action" value="print_only" class="btn btn-success" formtarget="_blank">Print Only</button><?php endif; ?>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="section-block">
  <div class="section-head">
    <div>
      <h3>Saved SPK List</h3>
      <p>Saved work agreement documents.</p>
    </div>
  </div>
  <div class="card shadow-sm">
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-sm mb-0 align-middle">
          <thead>
            <tr>
              <th>SPK No</th>
              <th>Date</th>
              <th>Party One</th>
              <th>Subject</th>
              <th>Language</th>
              <th class="action-cell">Action</th>
            </tr>
          </thead>
          <tbody><?php if (!$rows): ?><tr>
                <td colspan="6" class="empty-state">No SPK yet.</td>
              </tr><?php else: foreach ($rows as $row): ?><tr>
                  <td class="fw-semibold"><?= e($row['agreement_no']); ?></td>
                  <td><?= format_date_id($row['agreement_date']); ?></td>
                  <td><?= e($row['party_one_company']); ?></td>
                  <td><?= e($row['subject']); ?></td>
                  <td><?= strtoupper(e($row['language'])); ?></td>
                  <td class="action-cell">
                    <div class="table-action-group"><a href="<?= site_url('work-agreements?edit=' . $row['id']); ?>" class="btn btn-sm btn-outline-primary">Edit</a> <a href="<?= site_url('work-agreements/print/' . $row['id']); ?>" target="_blank" class="btn btn-sm btn-success">Print</a> <a href="<?= site_url('work-agreements/delete/' . $row['id']); ?>" onclick="return confirm('Delete this SPK?')" class="btn btn-sm btn-danger">Delete</a></div>
                  </td>
                </tr><?php endforeach;
                  endif; ?></tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  (function() {
    function n(v) {
      v = parseFloat(v);
      return isNaN(v) ? 0 : v
    }

    function calc() {
      let total = n(document.getElementById('total_amount').value),
        dp = n(document.getElementById('dp_percent').value),
        st = n(document.getElementById('settlement_percent').value);
      document.getElementById('dp_amount').value = (total * dp / 100).toFixed(0);
      document.getElementById('settlement_amount').value = (total * st / 100).toFixed(0)
    }
    document.querySelectorAll('.paycalc').forEach(e => e.addEventListener('input', calc));

    function bindRemove(root) {
      root.querySelectorAll('.btn-remove').forEach(b => {
        b.onclick = function() {
          let tb = this.closest('tbody');
          if (tb.children.length > 1) this.closest('tr').remove();
        };
      });
    }
    bindRemove(document);
    document.getElementById('addScope').onclick = function() {
      let tb = document.querySelector('#scopeTable tbody'),
        r = tb.querySelector('tr').cloneNode(true);
      r.querySelector('input').value = '';
      tb.appendChild(r);
      bindRemove(r)
    };
    document.getElementById('addTimeline').onclick = function() {
      let tb = document.querySelector('#timelineTable tbody'),
        r = tb.querySelector('tr').cloneNode(true);
      r.querySelectorAll('input').forEach(i => i.value = '');
      tb.appendChild(r);
      bindRemove(r)
    };
  })();
</script>