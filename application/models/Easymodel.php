<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Easymodel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function count($tbl)
    {
        $query = $this->db->get($tbl);
        if ($query) {
            return $query->num_rows();
        } else {
            return false;
        }
    }

    public function GetData($offset, $limit, $search, $sort, $order, $tbl)
    {
        $result = array();

        $getFields = $this->db->list_fields($tbl);

        $this->db->select($getFields);
        $this->db->order_by($sort, $order);
        $this->db->limit($limit, $offset);
        $query = $this->db->get($tbl);

        if ($query) {
            $result["data"] = $query->result();
            $result["count"] = $this->count($tbl);
        } else {
            $result["data"] = $sort;
            $result["count"] = $this->count($tbl);
        }

        //  $query .= " ORDER BY {$sort} {$order} LIMIT {$offset},{$limit}";

        return $result;
    }

    public function GetListUser()
    {

        /* 
        $query = "SELECT id_user, fullname, phone, email 
			FROM tbl_users 
			WHERE 1=1 ";
        if ($search != "") $query .= " AND (LOWER(fullname) LIKE LOWER('%{$search}%') or LOWER(email) LIKE LOWER('%{$search}%'))";
        $result["count"] = $this->db->query($query)->num_rows();

        $query .= " ORDER BY {$sort} {$order} LIMIT {$offset},{$limit}";
        $result["data"] = $this->db->query($query)->result();
 */
        $result = array();
        $this->db->select('*');
        //$this->db->order_by($sort, $order);
        //$this->db->limit($limit, $offset);
        $this->db->from('tbl_users');
        $query = $this->db->get();

        if ($query) {
            $result["data"] = $query->result();
            $result["count"] = $this->count('tbl_users');
        } else {
            $result["data"] = ''; //$sort;
            $result["count"] = $this->count('tbl_users');
        }
        return $result;
    }

    public function GetDetailUser($id_user)
    {
        $query = "SELECT a.id_user, a.fullname, a.phone, a.email, b.address 
			FROM tbl_users a JOIN tbl_addresses b ON (a.id_user = b.id_user) 
			WHERE 1 =1 
			AND a.id_user = {$id_user}";
        $result = $this->db->query($query)->result();

        return $result;
    }

    public function SaveNewUser($fullname, $phone, $email, $address_arr)
    {
        $query = "SELECT IFNULL(MAX(id_user), 0) + 1 max_id FROM tbl_users";
        $data = $this->db->query($query)->result();
        $id_user = 0;
        foreach ($data as $row) $id_user = $row->max_id;

        $query = "INSERT INTO tbl_users(id_user, fullname, phone, email) VALUES ({$id_user}, '{$fullname}', '{$phone}', '{$email}')";
        $this->db->query($query);

        $query = "INSERT INTO tbl_addresses(id_user, address) VALUES ";
        $idx = 1;
        foreach ($address_arr as $addr) {
            if ($idx == 1) $query .= "({$id_user}, '{$addr}')";
            else $query .= ",({$id_user}, '{$addr}')";
            $idx++;
        }
        $this->db->query($query);
        //return $result;
    }

    public function RemoveUser($id_user)
    {
        $query = "DELETE from tbl_users WHERE id_user = {$id_user}";
        $this->db->query($query);

        $query = "DELETE from tbl_addresses WHERE id_user = {$id_user}";
        $this->db->query($query);
        //return $result;
    }

    public function GetMixedData($offset, $limit, $search, $sort, $order, $tbl, $tbl1, $match, $type)
    {
        $result = array();
        $joinnBy = '' . $tbl . $match . ' = ' . $tbl1 . $match . '';
        $this->db->select('*');
        $this->db->order_by($sort, $order);
        $this->db->limit($limit, $offset);
        $this->db->from($tbl);
        $this->db->join($tbl1, $joinnBy, $type);
        $query = $this->db->get();

        if ($query) {
            $result["data"] = $query->result();
            $result["count"] = $this->count($tbl);
        } else {
            $result["data"] = ''; //$sort;
            $result["count"] = $this->count($tbl);
        }
        return $result;
    }

    public function GetSumData($offset, $limit, $search, $sort, $order, $tbl, $getFields)
    {
        $result = array();


        $this->db->select($getFields);
        $this->db->select_sum('amount');
        $this->db->from($tbl);
        $this->db->group_by('mobile');
        $query = $this->db->get();

        if ($query) {
            $result["data"] = $query->result();
            $result["count"] = $this->count($tbl);
        } else {
            $result["data"] = ''; //$sort;
            $result["count"] = $this->count($tbl);
        }
        return $result;
    }
}