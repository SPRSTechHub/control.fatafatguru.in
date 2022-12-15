<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Homemodel extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function getValue($key, $tbl)
    {
        $this->db->select('*');
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query->row()->$key;
        } else {
            return false;
        }
    }

    function counter($params, $tbl)
    {
        $this->db->select('*');
        $this->db->where($params);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        } else {
            return 0;
        }
    }

    function last_id($params, $tbl)
    {
        $this->db->select('*');
        $this->db->select('max(id) as lid');
        $this->db->where($params);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query->row()->lid;
        } else {
            return false;
        }
    }
    function find($params, $tbl)
    {
        $this->db->select('*');
        $this->db->where($params);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function findLike($params, $tbl)
    {
        $this->db->select('*');
        $this->db->like($params);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function findOne($params, $tbl)
    {
        $this->db->select('*');
        $this->db->where($params);
        $this->db->order_by('id', "desc");
        $this->db->limit(1);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function findMatch($params, $tbl)
    {
        $this->db->select('*');
        $this->db->where($params);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function findBets($params, $tbl)
    {
        $this->db->select('*');
        $this->db->select('sum(bet_amnt) as bb');
        $this->db->select('count(id) as bbi');
        $this->db->where($params);
        $this->db->group_by('bet_val');
        $this->db->order_by('bet_val', 'asc');
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function findDBets($params)
    {
        $this->db->select('*');
        $this->db->select('sum(bet_amnt) as bbv');
        $this->db->select('count(id) as bbc');
        $this->db->where('bet_type', 'SingleDigit');
        $this->db->where($params);
        $this->db->group_by('bet_val');
        $this->db->order_by('bet_val', 'asc');
        $query = $this->db->get('tbl_bets');
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }

    function getTitle($field, $param, $tbl)
    {
        $this->db->select('*');
        $this->db->where($param);
        $this->db->limit('1');
        $query = $this->db->get($tbl);

        if ($query->num_rows() > 0) {
            return $query->row()->$field;
        } else {
            return false;
        }
    }

    function searchQuery($qry)
    {
        $query = $this->db->query($qry);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function insert($params, $tbl)
    {
        $query =  $this->db->insert($tbl, $params);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    function insert_check($chkby, $data, $tbl)
    {
        $this->db->select('*');
        $this->db->where($chkby);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return $this->db->insert($tbl, $data) ? true : false;
        }
    }

    function insert_check_update($chkby, $data, $tbl)
    {
        $this->db->select('*');
        $this->db->where($chkby);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $this->update($chkby, $data, $tbl) ? true : false;
        } else {
            return $this->db->insert($tbl, $data) ? true : false;
        }
    }

    function insert_batch_check($chkby, $data, $tbl)
    {
        $this->db->select('*');
        $this->db->where($chkby);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return false;
        } else {
            return $this->db->insert_batch($tbl, $data) ? true : false;
        }
    }

    function update($chkby, $data, $tbl)
    {
        $this->db->where($chkby);
        $query = $this->db->update($tbl, $data);

        if ($query) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($param, $tbl)
    {
        $this->db->where($param);
        $query = $this->db->delete($tbl);
        return ($query) ? true : false;
    }

    public function fetchResult($param, $gpby, $tbl)
    {
        $this->db->select('*');
        $this->db->where($param);
        if ($gpby) {
            $this->db->group_by($gpby);
            $this->db->order_by('id', 'asc');
            $this->db->order_by('date', 'desc');
        } else {
            $this->db->order_by('id', 'desc');
        }


        //$this->db->order_by('cat_id', 'asc');
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    public function fetchResultAll($param, $gpby, $limit, $tbl)
    {
        $this->db->select('*');
        $this->db->where($param);
        if ($gpby) {
            $this->db->group_by($gpby);
        }
        $this->db->order_by('date', 'desc');
        $this->db->order_by('match_id', 'asc');

        if ($limit) {
            $this->db->limit($limit['rowno'], $limit['start']);
        } else {
            $this->db->limit(31, 0);
        }

        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function addNotify($params)
    {
        $query =  $this->db->insert('tbl_notify', $params);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}