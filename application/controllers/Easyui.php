<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Easyui extends CI_Controller
{

    public function index()
    {
        $this->load->model("m_users");

        $data = $this->m_users->GetListUser(0, 0, "", "id_user", "ASC");

        if ($data["count"] == 0) $this->load->view("v_users_empty");
        else $this->load->view("v_users");
    }

    public function FetchData()
    {
        $tbl = $this->uri->segment(3, 0);
        $offset = !empty($this->input->post("page")) ? intval($this->input->post("page")) : 1;
        $limit = !empty($this->input->post("rows")) ? intval($this->input->post("rows")) : 10;
        $search = !empty($this->input->post("search")) ? $this->input->post("search") : "";
        $sort = !empty($this->input->post('sort')) ? $this->input->post('sort') : "id";
        $order = !empty($this->input->post('order')) ? $this->input->post('order') : "asc";
        $offset = ($offset - 1) * $limit;

        $data = $this->esymodel->GetData($offset, $limit, $search, $sort, $order, $tbl);
        $rows = array();

        $getFields = $this->db->list_fields($tbl);

        foreach ($data["data"] as $row) {
            foreach ($getFields as $col) {
                $arr[$col] = $row->$col;
            }
            array_push($rows, $arr);
        }

        $result = array("total" => $data["count"], "rows" => $rows);
        echo json_encode($result);
    }

    public function GetListUser()
    {
        $this->load->model("m_users");

        $offset = isset($_POST["page"]) ? intval($_POST["page"]) : 1;
        $limit = isset($_POST["rows"]) ? intval($_POST["rows"]) : 10;
        $search = isset($_POST["search"]) ? $_POST["search"] : "";
        $sort = isset($_POST['sort']) ? $_POST['sort'] : "id_user";
        $order = isset($_POST['order']) ? $_POST['order'] : "ASC";
        $offset = ($offset - 1) * $limit;

        $data = $this->m_users->GetListUser($offset, $limit, $search, $sort, $order);
        $rows = array();
        $idx = 0;

        foreach ($data["data"] as $row) {
            $rows[$idx]["id_user"] = $row->id_user;
            $rows[$idx]["fullname"] = $row->fullname;
            $rows[$idx]["phone"] = $row->phone;
            $rows[$idx]["email"] = $row->email;
            $idx++;
        }

        $result = array("total" => $data["count"], "rows" => $rows);
        echo json_encode($result);
    }

    public function SaveNewUser()
    {
        $this->load->model("m_users");

        $fullname = $_REQUEST["fullname"];
        $phone = $_REQUEST["phone"];
        $email = $_REQUEST["email"];
        $address_arr = $_REQUEST["address"];
        $this->m_users->SaveNewUser($fullname, $phone, $email, $address_arr);

        echo json_encode(array('success' => true));
    }

    public function RemoveUser()
    {
        $this->load->model("m_users");

        $id_user = intval($_REQUEST['id_user']);
        $this->m_users->RemoveUser($id_user);

        echo json_encode(array('success' => true));
    }

    //////////////////////////////////////////////////////
    public function FetchDataMixed()
    {
        /*
        $getFields = preg_filter('/^/', $tbl . '.', $this->db->list_fields($tbl));
        $getFields1 = preg_filter('/^/', $tbl . '.', $this->db->list_fields($tbl1));
       */

        $tbl = $this->uri->segment(3, 0);
        $tbl1 = $this->uri->segment(4, 0);
        $offset = !empty($this->input->post("page")) ? intval($this->input->post("page")) : 1;
        $limit = !empty($this->input->post("rows")) ? intval($this->input->post("rows")) : 10;
        $search = !empty($this->input->post("search")) ? $this->input->post("search") : "";
        $sort = !empty($this->input->post('sort')) ? $this->input->post('sort') : $tbl . ".id";
        $order = !empty($this->input->post('order')) ? $this->input->post('order') : "asc";
        $offset = ($offset - 1) * $limit;
        $match = '.match_id';
        $data = $this->esymodel->GetMixedData($offset, $limit, $search, $sort, $order, $tbl, $tbl1, $match, 'left');
        $rows = array();

        $getFields = $this->db->list_fields($tbl);
        $getFields1 = $this->db->list_fields($tbl1);
        $getFields = array_merge($getFields, $getFields1);
        foreach ($data["data"] as $row) {
            foreach ($getFields as $col) {
                $arr[$col] = $row->$col;
            }
            array_push($rows, $arr);
        }
        $result = array("total" => $data["count"], "rows" => $rows);
        echo json_encode($result);
    }

    public function FetchSummaryData()
    {
        /*
        $getFields = preg_filter('/^/', $tbl . '.', $this->db->list_fields($tbl));
        $getFields1 = preg_filter('/^/', $tbl . '.', $this->db->list_fields($tbl1));
       */

        $tbl = $this->uri->segment(3, 0);
        $offset = !empty($this->input->post("page")) ? intval($this->input->post("page")) : 1;
        $limit = !empty($this->input->post("rows")) ? intval($this->input->post("rows")) : 10;
        $search = !empty($this->input->post("search")) ? $this->input->post("search") : "";
        $sort = !empty($this->input->post('sort')) ? $this->input->post('sort') : $tbl . ".id";
        $order = !empty($this->input->post('order')) ? $this->input->post('order') : "asc";
        $offset = ($offset - 1) * $limit;

        $getFields = $this->db->list_fields($tbl);
        unset($getFields[0]);

        $data = $this->esymodel->GetSumData($offset, $limit, $search, $sort, $order, $tbl, $getFields);
        $rows = array();

        foreach ($data["data"] as $row) {
            foreach ($getFields as $col) {
                $arr[$col] = $row->$col;
            }
            array_push($rows, $arr);
        }
        print_r($rows);

        /*$result = array("total" => $data["count"], "rows" => $rows);
        echo json_encode($result); */
    }

    //////////////////////////////////////////////////////

    public function getWAlletdata()
    {
        $users = $this->esymodel->GetListUser(0, 0, "", "id_user", "ASC");

        print_r($users);

        if ($users) {
            foreach ($users as $rowdata) {
                $tt[] = array(
                    'userid' => $rowdata['mobile']
                );
            }
        }
    }
}