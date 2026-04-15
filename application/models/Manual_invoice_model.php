<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Manual_invoice_model extends CI_Model
{
    protected $table = 'manual_invoices';
    protected $itemTable = 'manual_invoice_items';

    public function rows()
    {
        return $this->db
            ->order_by('id', 'DESC')
            ->get($this->table)
            ->result_array();
    }

    public function create($header, $items)
    {
        $this->db->trans_begin();

        $subtotal_amount = 0;
        $total_discount_amount = 0;
        $total_tax_amount = 0;
        $grand_total = 0;

        $clean_items = [];

        foreach ((array)$items as $it) {
            $description = trim((string)($it['description'] ?? ''));
            $qty = (float)($it['qty'] ?? 0);
            $unit = trim((string)($it['unit'] ?? ''));
            $unit_price = (float)($it['unit_price'] ?? 0);
            $discount_percent = (float)($it['discount_percent'] ?? 0);
            $tax_percent = (float)($it['tax_percent'] ?? 0);

            if ($description === '' || $qty <= 0) {
                continue;
            }

            $subtotal = $qty * $unit_price;
            $discount_amount = $subtotal * ($discount_percent / 100);
            $dpp = $subtotal - $discount_amount;
            $tax_amount = $dpp * ($tax_percent / 100);
            $amount = $dpp + $tax_amount;

            $subtotal_amount += $subtotal;
            $total_discount_amount += $discount_amount;
            $total_tax_amount += $tax_amount;
            $grand_total += $amount;

            $clean_items[] = [
                'description'       => $description,
                'qty'               => $qty,
                'unit'              => $unit,
                'unit_price'        => $unit_price,
                'discount_percent'  => $discount_percent,
                'tax_percent'       => $tax_percent,
                'subtotal'          => $subtotal,
                'discount_amount'   => $discount_amount,
                'tax_amount'        => $tax_amount,
                'amount'            => $amount,
            ];
        }

        $paid_amount = (float)($header['paid_amount'] ?? 0);
        $balance_amount = $grand_total - $paid_amount;

        $header['subtotal_amount'] = $subtotal_amount;
        $header['total_discount_amount'] = $total_discount_amount;
        $header['total_tax_amount'] = $total_tax_amount;
        $header['paid_amount'] = $paid_amount;
        $header['balance_amount'] = $balance_amount;
        $header['total_amount'] = $grand_total;

        $this->db->insert($this->table, $header);
        $id = (int)$this->db->insert_id();

        foreach ($clean_items as $it) {
            $it['manual_invoice_id'] = $id;
            $this->db->insert($this->itemTable, $it);
        }

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return $id;
    }

    public function find_with_items($id)
    {
        $invoice = $this->db
            ->get_where($this->table, ['id' => (int)$id])
            ->row_array();

        if (!$invoice) {
            return [null, []];
        }

        $items = $this->db
            ->order_by('id', 'ASC')
            ->get_where($this->itemTable, ['manual_invoice_id' => (int)$id])
            ->result_array();

        return [$invoice, $items];
    }

    public function delete($id)
    {
        $id = (int)$id;

        $this->db->trans_begin();

        $this->db->delete($this->itemTable, ['manual_invoice_id' => $id]);
        $this->db->delete($this->table, ['id' => $id]);

        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
            return false;
        }

        $this->db->trans_commit();
        return true;
    }
}
