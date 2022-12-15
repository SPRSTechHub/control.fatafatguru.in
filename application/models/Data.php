<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Data extends CI_Model
{

    function __construct()
    {
        $this->order = array('id' => 'desc');
    }

    public function getRows($postData, $table, $cols)
    {
        $this->_get_datatables_query($postData, $table, $cols);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function countAll($table)
    {
        $this->db->from($table);
        return $this->db->count_all_results();
    }

    public function countFiltered($postData, $table, $cols)
    {
        $this->_get_datatables_query($postData, $table, $cols);
        $query = $this->db->get();
        return $query->num_rows();
    }

    private function _get_datatables_query($postData, $table, $cols)
    {
        $this->db->from($table);
        $i = 0;
        foreach ($cols as $item) {
            if ($postData['search']['value']) {
                if ($i === 0) {
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']['value']);
                } else {
                    $this->db->or_like($item, $postData['search']['value']);
                }
                if (count($cols) - 1 == $i) {
                    $this->db->group_end();
                }
            }
            $i++;
        }
        if (isset($postData['order'])) {
            $this->db->order_by($cols[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    public function getRowsCombo($postData, $table1, $table2, $cols)
    {
        $join_array = $table1 . '.id = ' . $table2 . '.id';

        $this->_get_datatables_query($postData, $table1, $cols);
        if ($postData['length'] != -1) {
            $this->db->limit($postData['length'], $postData['start']);
        }
        $this->db->join($table2, $join_array);
        $query = $this->db->get();
        return $query->result();
    }
}