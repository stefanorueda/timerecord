<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employees extends CI_Controller {

    public function __construct() {
		parent::__construct();
		date_default_timezone_set('Asia/Manila');
		$this->load->model('Crud_model');
		
    }
    
	public function index()
	{
        $data['employees'] = $this->Crud_model->fetch_data('employees','','','','');
		$this->load->view('employee',$data);
    }

    function generate_qrcode($data)
	{
        /* Load QR Code Library */
        $this->load->library('ciqrcode');
        
        /* Data */
        $hex_data   = bin2hex($data);
        $save_name  = $hex_data.'.png';

        /* QR Code File Directory Initialize */
        $dir = 'assets/media/qrcode/';
        if (!file_exists($dir)) {
            mkdir($dir, 0775, true);
        }

        /* QR Configuration  */
        $config['cacheable']    = true;
        $config['imagedir']     = $dir;
        $config['quality']      = true;
        $config['size']         = '1024';
        $config['black']        = array(255,255,255);
        $config['white']        = array(255,255,255);
        $this->ciqrcode->initialize($config);
  
        /* QR Data  */
        $params['data']     = $data;
        $params['level']    = 'L';
        $params['size']     = 10;
        $params['savename'] = FCPATH.$config['imagedir']. $save_name;
        
        $this->ciqrcode->generate($params);

        /* Return Data */
        $return = array(
            'content' => $data,
            'file'    => $dir. $save_name
        );
        return $return;
    }
    
    public function add_employee(){

        // if($_POST)
		// {
            $fname = ucwords($this->input->post('fname'));
            $lname = ucwords($this->input->post('lname'));
            $created_by = 1;
            
           
            $qr_data = $fname.$lname;
            $qr = $this->generate_qrcode( $qr_data );
            $qrfile = $qr['file'];
            $data = array('first_name'=>$fname,'last_name'=>$lname,'created_by'=>$created_by, 'file' => $qrfile);
            $this->Crud_model->insert('employees',$data);
           echo 'success';
        // }
        //  else
        //  {
        //     echo 'error';
        //  }
    }


}
