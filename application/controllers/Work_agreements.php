<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Work_agreements extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->require_login();
        $this->load->model('Work_agreement_model', 'wa');
        $this->load->model('Company_model', 'company');
    }

    public function index()
    {
        if ($this->input->method() === 'post') {
            $action = $this->input->post('submit_action');
            $agreement_no = trim((string)$this->input->post('agreement_no'));
            if ($agreement_no === '') {
                $agreement_no = 'SPK-UCO/' . date('Ym') . '/' . str_pad((string)rand(1, 9999), 4, '0', STR_PAD_LEFT);
            }
            $total = (float)$this->input->post('total_amount');
            $dpPercent = (float)$this->input->post('dp_percent');
            $settlementPercent = (float)$this->input->post('settlement_percent');
            $header = [
                'agreement_no' => $agreement_no,
                'agreement_date' => $this->input->post('agreement_date') ?: date('Y-m-d'),
                'language' => $this->input->post('language', true) ?: 'id',
                'template_type' => $this->input->post('template_type', true) ?: 'consulting_service',
                'title' => $this->input->post('title', true),
                'subject' => $this->input->post('subject', true),
                'place_signed' => $this->input->post('place_signed', true) ?: 'Mojokerto',
                'party_one_name' => $this->input->post('party_one_name', true),
                'party_one_position' => $this->input->post('party_one_position', true),
                'party_one_company' => $this->input->post('party_one_company', true),
                'party_one_address' => $this->input->post('party_one_address', true),
                'party_two_name' => $this->input->post('party_two_name', true),
                'party_two_position' => $this->input->post('party_two_position', true),
                'party_two_company' => $this->input->post('party_two_company', true),
                'party_two_address' => $this->input->post('party_two_address', true),
                'work_description' => $this->input->post('work_description', true),
                'duration_text' => $this->input->post('duration_text', true),
                'total_amount' => $total,
                'dp_percent' => $dpPercent,
                'dp_amount' => (float)$this->input->post('dp_amount'),
                'settlement_percent' => $settlementPercent,
                'settlement_amount' => (float)$this->input->post('settlement_amount'),
                'settlement_trigger_text' => $this->input->post('settlement_trigger_text', true),
                'show_tax_clause' => $this->input->post('show_tax_clause') ? 1 : 0,
                'tax_clause_text' => $this->input->post('tax_clause_text', true),
                'evaluation_text' => $this->input->post('evaluation_text', true),
                'force_majeure_text' => $this->input->post('force_majeure_text', true),
                'other_terms_text' => $this->input->post('other_terms_text', true),
                'signer_party_one' => $this->input->post('signer_party_one', true),
                'signer_party_two' => $this->input->post('signer_party_two', true),
                'created_by' => $this->user['id'] ?? null,
            ];
            $scopes = (array)$this->input->post('scope_text');
            $activities = (array)$this->input->post('activity');
            $leadtime = (array)$this->input->post('leadtime');
            $pic = (array)$this->input->post('pic');
            $timelines = [];
            foreach ($activities as $i => $act) {
                $timelines[] = ['activity' => $act, 'leadtime' => $leadtime[$i] ?? '', 'pic' => $pic[$i] ?? ''];
            }
            if ($action === 'update' || $action === 'update_print') {
                $id = (int)$this->input->post('id');
                $this->wa->update($id, $header, $scopes, $timelines);
                $this->session->set_flashdata('success', 'SPK berhasil diperbarui.');
                redirect($action === 'update_print' ? 'work-agreements/print/' . $id : 'work-agreements');
            }
            if ($action === 'save_print') {
                $id = $this->wa->create($header, $scopes, $timelines);
                $this->session->set_flashdata('success', 'SPK berhasil disimpan.');
                redirect('work-agreements/print/' . $id);
            }
            if ($action === 'print_only') {
                $this->session->set_userdata('work_agreement_draft', ['header' => $header, 'scopes' => $scopes, 'timelines' => $timelines]);
                redirect('work-agreements/print-draft');
            }
        }
        $data['page_title'] = 'Work Agreements / SPK';
        $data['rows'] = $this->wa->rows();
        $data['edit'] = null;
        $data['edit_scopes'] = [];
        $data['edit_timelines'] = [];
        if ($this->input->get('edit')) {
            $id = (int)$this->input->get('edit');
            $data['edit'] = $this->wa->get($id);
            $data['edit_scopes'] = $this->wa->scopes($id);
            $data['edit_timelines'] = $this->wa->timelines($id);
        }
        $this->render('admin/work_agreements/index', $data);
    }





    public function print_agreement($id)
    {
        $spk = $this->wa->get($id);
        if (!$spk) show_404();
        $data['company'] = $this->company->latest();
        $data['spk'] = $spk;
        $data['scopes'] = $this->wa->scopes($id);
        $data['timelines'] = $this->wa->timelines($id);
        $view = ($spk['language'] ?? 'id') === 'en' ? 'admin/work_agreements/print_en' : 'admin/work_agreements/print_id';
        $this->load->view($view, $data);
    }

    public function print_draft()
    {
        $draft = $this->session->userdata('work_agreement_draft');
        if (!$draft) redirect('work-agreements');

        $data['company'] = $this->company->latest();
        $data['spk'] = $draft['header'];

        $data['scopes'] = array_values(array_filter(array_map(function ($s) {
            return ['scope_text' => $s];
        }, $draft['scopes']), function ($s) {
            return trim((string)$s['scope_text']) !== '';
        }));

        $data['timelines'] = array_values(array_filter($draft['timelines'], function ($t) {
            return trim((string)$t['activity']) !== '';
        }));

        $this->session->unset_userdata('work_agreement_draft');

        $view = ($data['spk']['language'] ?? 'id') === 'en'
            ? 'admin/work_agreements/print_en'
            : 'admin/work_agreements/print_id';

        $this->load->view($view, $data);
    }

    public function delete($id)
    {
        $this->wa->delete($id);
        $this->session->set_flashdata('success', 'SPK berhasil dihapus.');
        redirect('work-agreements');
    }
}
