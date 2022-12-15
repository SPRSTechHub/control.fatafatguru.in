<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Datafunction extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Data' => 'data'));
    }

    public function index()
    {
        $data = array();
        $cols = $this->db->list_fields('rcp_steps_tbl');
        $resultData = $this->data->getRows($_POST, 'rcp_steps_tbl', $cols);
        foreach ($resultData as $dataVal) {
            foreach ($cols as $col) {
                $rows[$col] = $dataVal->$col;
            }
            array_push($data, $rows);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->data->countAll('rcp_steps_tbl'),
            "recordsFiltered" => $this->data->countFiltered($_POST, 'rcp_steps_tbl', $cols),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function get_tbl_data()
    {
        $data = array();
        $tbl = $this->input->post('table');
        $cols = $this->db->list_fields($tbl);
        $resultData = $this->data->getRows($_POST, $tbl, $cols);
        foreach ($resultData as $dataVal) {
            foreach ($cols as $col) {
                $rows[$col] = $dataVal->$col;
            }
            array_push($data, $rows);
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->data->countAll($tbl),
            "recordsFiltered" => $this->data->countFiltered($_POST, $tbl, $cols),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function addSteps()
    {
        $result = array();
        $data = $this->input->raw_input_stream;
        $data = json_decode($data, false);
        $table = $data->table;
        $filterby = array('id' => $data->id);

        if ((array_key_exists('table', $data)) !== false) {
            unset($data->table);
            unset($data->id);
        }
        $insert =  $this->HomeModel->insert($data, $table);

        if ($insert) {
            $result['status'] = '1';
            $result['msg'] = 'Added successfully';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'Added failed!';
        }
        echo json_encode($result);
    }

    public function get_tbl_data_combo()
    {
        $data = array();
        $tbl1 = $this->input->post('table1');
        $tbl2 = $this->input->post('table2');

        $cols1 = $this->db->list_fields($tbl1);
        $cols2 = $this->db->list_fields($tbl2);
        $cols = array_merge($cols1, $cols2);
        $ncols = $this->mergeTable($cols1, $tbl1);
        $resultData = $this->data->getRowsCombo($_POST, $tbl1, $tbl2, $ncols);

        foreach ($resultData as $dataVal) {
            foreach ($cols as $col) {
                $rows[$col] = $dataVal->$col;
            }
            array_push($data, $rows);
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->data->countAll($tbl1),
            "recordsFiltered" => $this->data->countFiltered($_POST, $tbl1, $cols),
            "data" => $data,
        );

        echo json_encode($output);
    }

    public function mergeTable($cols, $tbl)
    {
        foreach ($cols as $key => $value) {
            $cols[$key] = $tbl . '.' . $value;
        }
        return $cols;
    }

    public function get_wallet_combo()
    {
        $data = array();
        $tbl = $this->input->post('table1');
        $cols = $this->db->list_fields($tbl);

        $resultData = $this->data->getRows($_POST, $tbl, $cols);
        foreach ($resultData as $dataVal) {

            $data[] = array(
                'id' => $dataVal->id,
                'mobile' => $dataVal->mobile,
                'fullname' => $dataVal->fullname,
                'status' => $dataVal->status,
                'credit' => $this->getWallet($dataVal->mobile, 'credit'),
                'debit' => $this->getWallet($dataVal->mobile, 'debit'),
            );
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->data->countAll($tbl),
            "recordsFiltered" => $this->data->countFiltered($_POST, $tbl, $cols),
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function update()
    {
        $result = array();
        $data = $this->input->raw_input_stream;
        $data = json_decode($data, false);
        $table = $data->table;
        $filterby = array('id' => $data->id);

        if ((array_key_exists('table', $data)) !== false) {
            unset($data->table);
            unset($data->id);
        }
        $update =  $this->HomeModel->update($filterby, $data, $table);

        if ($update) {
            $result['status'] = '1';
            $result['msg'] = 'update successfully';
        } else {
            $result['status'] = '0';
            $result['msg'] = 'update failed!';
        }
        echo json_encode($result);
    }

    public function fields_replace($arr, $key, $key1)
    {
        $getfields = array_map(function ($v) use ($key, $key1) {
            return $v == $key ? $key1 : $v;
        }, $arr);
        return $getfields;
    }

    public function getWallet($param, $type)
    {
        $filter = array(
            'mobile' => $param,
            'trtype' => $type
        );
        $this->db->select_sum('amount');
        $this->db->where($filter);
        $query = $this->db->get('tbl_wallet');
        if ($query->num_rows() > 0) {
            return $query->row()->amount;
        } else {
            return 0;
        }
    }
}