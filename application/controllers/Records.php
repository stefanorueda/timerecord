<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Records extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->model('Crud_model');
    }

    public function get_employee_records()
    {

        $id = $this->input->post('id');
        $data = array('id' => $id);
        $res = $this->Crud_model->fetch('employees', $data);

        if ($res) {
            $data2 = array('employee_id' => $id);
            $order = "id DESC";
            $res = $this->Crud_model->fetch('records', $data2,"","",$order);
            if ($res) {
               if($res[0]->time_in) {
                echo "timeout";
               } else {
                echo "timein";
               }
            } else {
                echo 'No records found';
            }
        } else {
            echo 'No employee found';
        }
    }

    public function time_in(){
        $employee_id = $this->input->post('id');
        $time_in = 1;
        $time_out = 0;
        $data = array('employee_id' => $employee_id, 'time_in' => $time_in, 'time_out' => $time_out);
        $this->Crud_model->insert('records', $data);
        echo 'success';
    }

    public function time_out(){
        $employee_id = $this->input->post('id2');
        $time_in = 0;
        $time_out = 1;
        $data = array('employee_id' => $employee_id, 'time_in' => $time_in, 'time_out' => $time_out);
        $this->Crud_model->insert('records', $data);
        echo 'success';
    }
}
