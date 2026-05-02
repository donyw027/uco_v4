<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Work_agreement_model extends CI_Model
{
    public function rows()
    {
        return $this->db->order_by('id', 'DESC')->get('work_agreements')->result_array();
    }

    public function get($id)
    {
        return $this->db->get_where('work_agreements', ['id' => (int)$id])->row_array();
    }

    public function scopes($agreement_id)
    {
        return $this->db->order_by('sort_order', 'ASC')->order_by('id', 'ASC')
            ->get_where('work_agreement_scopes', ['agreement_id' => (int)$agreement_id])->result_array();
    }

    public function timelines($agreement_id)
    {
        return $this->db->order_by('sort_order', 'ASC')->order_by('id', 'ASC')
            ->get_where('work_agreement_timelines', ['agreement_id' => (int)$agreement_id])->result_array();
    }

    public function create($header, $scopes, $timelines)
    {
        $this->db->trans_begin();
        $this->db->insert('work_agreements', $header);
        $id = $this->db->insert_id();
        $this->_save_children($id, $scopes, $timelines);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return $id;
    }

    public function update($id, $header, $scopes, $timelines)
    {
        $id = (int)$id;
        $this->db->trans_begin();
        $this->db->where('id', $id)->update('work_agreements', $header);
        $this->db->delete('work_agreement_scopes', ['agreement_id' => $id]);
        $this->db->delete('work_agreement_timelines', ['agreement_id' => $id]);
        $this->_save_children($id, $scopes, $timelines);
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            return false;
        }
        $this->db->trans_commit();
        return $id;
    }

    private function _save_children($id, $scopes, $timelines)
    {
        foreach ((array)$scopes as $i => $text) {
            if (trim((string)$text) === '') continue;
            $this->db->insert('work_agreement_scopes', [
                'agreement_id' => $id,
                'scope_text' => trim((string)$text),
                'sort_order' => $i + 1,
            ]);
        }
        foreach ((array)$timelines as $i => $row) {
            $activity = trim((string)($row['activity'] ?? ''));
            if ($activity === '') continue;
            $this->db->insert('work_agreement_timelines', [
                'agreement_id' => $id,
                'activity' => $activity,
                'leadtime' => trim((string)($row['leadtime'] ?? '')),
                'pic' => trim((string)($row['pic'] ?? '')),
                'sort_order' => $i + 1,
            ]);
        }
    }

    public function delete($id)
    {
        return $this->db->delete('work_agreements', ['id' => (int)$id]);
    }
}
