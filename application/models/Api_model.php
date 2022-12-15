<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Api_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function Authcheck($settings)
    {
        $this->db->select('status');
        $this->db->where('settings', $settings);
        $this->db->where('status', '0');
        $this->db->from('meta_settings');
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    function get_meta($title)
    {
        $this->db->select('*');
        $this->db->where('title', $title);
        $this->db->from('meta_details');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row()->descp;
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

    function findWithFilter($params, $sort, $limit, $tbl)
    {
        $this->db->select('*');
        $this->db->where($params);
        if (!empty($sort)) {
            $this->db->order_by($sort['sortBy'], $sort['sortTo']);
        } else {
            $this->db->order_by("id", "desc");
        }
        if (!empty($limit)) {
            $this->db->limit($limit['lstart'], $limit['lend']);
        } else {
            $this->db->limit('50');
        }
        $query = $this->db->get($tbl);

        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function find_field($field, $params, $tbl)
    {
        $this->db->select('*');
        $this->db->where($params);
        $this->db->limit('1');
        $query = $this->db->get($tbl);

        if ($query->num_rows() > 0) {
            return $query->row()->$field;
        } else {
            return false;
        }
    }

    public function get_count_filter($params, $tbl)
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

    function Exister($param, $tbl)
    {
        $this->db->select('*');
        $this->db->where($param);
        $query = $this->db->get($tbl);

        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function Insert($param, $tbl)
    {
        $insert = $this->db->insert($tbl, $param);
        if ($insert) {
            return true;
        } else {
            return false;
        }
    }

    function insert_check($chkby, $rf_data, $tbl)
    {
        $this->db->select('*');
        $this->db->where($chkby);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return false;
        } else {
            $this->Insert($rf_data, $tbl) ? true : false;
        }
    }

    function Update($param, $key, $tbl)
    {
        $update = $this->db->update($tbl, $param, $key);
        if ($update) {
            return true;
        } else {
            return false;
        }
    }

    function delete($param, $tbl)
    {
        $deleter = $this->db->delete($tbl, $param);
        if ($deleter) {
            return true;
        } else {
            return false;
        }
    }

    function GameCatagories($day)
    {
        $this->db->select('tbl_gamelist.day,tbl_gamelist.cat_id');
        $this->db->where('tbl_gamelist.day', $day);
        $this->db->from('tbl_gamelist');
        $this->db->group_by('tbl_gamelist.cat_id');
        $this->db->order_by('tbl_gamelist.id', 'asc');
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function GameData($params)
    {
        $this->db->select('*');
        $this->db->where($params);
        $this->db->order_by('match_time', 'asc');
        $query = $this->db->get('tbl_gamelist');
        if ($query->num_rows() > 0) {
            return $query;
        } else {
            return false;
        }
    }

    function get_bal($params)
    {
        $this->db->select_sum('amount');
        $this->db->where($params);
        $query = $this->db->get('tbl_wallet');
        if ($query->num_rows() > 0) {
            return $query->row()->amount;
        } else {
            return false;
        }
    }

    function get_filter_bal($resp, $params, $tbl)
    {
        $this->db->select_sum($resp);
        $this->db->where($params);
        $query = $this->db->get($tbl);
        if ($query->num_rows() > 0) {
            return $query->row()->$resp;
        } else {
            return false;
        }
    }

    function getApiSecret($params)
    {
        $this->db->select('*');
        $this->db->where($params);
        $query = $this->db->get('client_api_secret');

        if ($query->num_rows() > 0) {
            return $query->row()->api_key_secret;
        } else {
            return false;
        }
    }
}