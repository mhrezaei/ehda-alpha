<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ShowCart extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
    
    public function index($userID)
	{
        //$userID = $this->encrypt->decode($userID);
//        if(is_numeric($userID) AND $userID > 0)
			if($userID)
        {
            $data = $this->db->select('*')->from('users')->where(array('res4' => $userID, 'status' => 1))->get();
            if($data->num_rows() > 0)
            {
                $data = $data->row_array();
                $this->load->view('templates/showCart', $data);
                $this->load->view('templates/footer', $data);
            }
            else
            {
                show_404();
            }
        }
        else
        {
            show_404();
        }
	}
}