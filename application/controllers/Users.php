<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Manila');
        $this->load->model('Crud_model');

      
    }

    public function index()
    {
        if($this->session->user_type == 2)
		{
			redirect(base_url());
		}
        $data['users'] = $this->Crud_model->fetch_data('users', '', '', '', '');
        $this->load->view('users', $data);
    }

    public function add_users()
    {
        $this->load->library('form_validation');
        $rules = array(
            [
                'field' => 'password',
                'label' => 'Password',
                'rules' => 'callback_valid_password',
            ],
            [
                'field' => 'confirm_password',
                'label' => 'Confirm Password',
                'rules' => 'matches[password]',
            ],
        );
        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $user_type = 2;
            $data = array(
                'user_name' => $username,
                'user_password' => hash_password($password),
                'user_type' => $user_type
            );


            $res = $this->Crud_model->insert('users', $data);
            echo "success";
        } else {
            echo 'Error! <ul>' . validation_errors('<li>', '</li>') . '</ul>';
        }
    }

    public function valid_password($password = '')
    {
        $password = trim($password);

        $regex_lowercase = '/[a-z]/';
        $regex_uppercase = '/[A-Z]/';
        $regex_number = '/[0-9]/';
        $regex_special = '/[!@#$%^&*()\-_=+{};:,<.>§~]/';

        if (empty($password)) {
            $this->form_validation->set_message('valid_password', 'The {field} field is required.');

            return FALSE;
        }

        if (preg_match_all($regex_lowercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one lowercase letter.');

            return FALSE;
        }

        if (preg_match_all($regex_uppercase, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least one uppercase letter.');

            return FALSE;
        }

        if (preg_match_all($regex_number, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one number.');

            return FALSE;
        }

        if (preg_match_all($regex_special, $password) < 1) {
            $this->form_validation->set_message('valid_password', 'The {field} field must have at least one special character.' . ' ' . htmlentities('!@#$%^&*()\-_=+{};:,<.>§~'));

            return FALSE;
        }

        if (strlen($password) < 10) {
            $this->form_validation->set_message('valid_password', 'The {field} field must be at least 10 characters in length.');

            return FALSE;
        }

        if (strlen($password) > 32) {
            $this->form_validation->set_message('valid_password', 'The {field} field cannot exceed 32 characters in length.');

            return FALSE;
        }

        return TRUE;
    }

    public function login()
    {

        $username = $this->input->post('username');
        $filter = array('user_name' => $username);
        $data = $this->Crud_model->fetch_tag_row('user_name,user_password,user_type', 'users', $filter);

        if ($data) {
            $password = $data->user_password;
            if (password_verify($this->input->post('password'), $password)) {
                $newdata = array(
                    'user_name' => $username,
                    'user_type' =>  $data->user_type,
                );

                $this->session->set_userdata($newdata);
               
                echo "success";
            } else {
                echo "error1";
            }
        } else {
            echo "error2";
        }
    }

    public function logout()
	{

		if(isset($this->session->user_name))
		{
			$this->session->sess_destroy();
			redirect(base_url());
		}
		else
		{
			redirect(base_url());
		}
		
	}
}
