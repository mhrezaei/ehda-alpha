<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
	{
		$data = '';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/footer', $data);
	}
}