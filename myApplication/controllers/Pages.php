<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {

	public $data;
    public $navbar;

    public function __construct()
    {
        parent::__construct();
        $this->data = $this->header_model->header_data();
        $this->navbar = $this->users_model->is_user();
        if($this->navbar)
        {
            $this->navbar = $this->users_model->selectUserByID($this->navbar['id']);
        }
    }
    
    public function index($slug)
	{
		if(strlen($slug) > 1)
        {
            $page = $this->db->select()->from('pages')->where(array(
                'slug' => $slug,
                'status' => 1
            ))->get();
            if($page->num_rows())
            {
                $page = $page->row_array();
                $this->load->view('new/template/header', $this->data);
                $this->load->view('new/template/navbar', $this->navbar);
                $this->load->view('new/template/pages_template', $page);
                $this->load->view('new/template/footer');
            }
            else
            {
                redirect(base_url());
            }
        }
        else
        {
            redirect(base_url());
        }
	}

    protected function founders()
    {
        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $navbar);
        $this->load->view('pages/founders', $data);
        $this->load->view('OnePage_template/footer', $data);
    }

    protected function directors()
    {
        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $navbar);
        $this->load->view('pages/directors', $data);
        $this->load->view('OnePage_template/footer', $data);
    }

    protected function trustees()
    {
        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $navbar);
        $this->load->view('pages/trustees', $data);
        $this->load->view('OnePage_template/footer', $data);
    }

    public function historyInIran()
    {
        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('new/template/header', $data);
        $this->load->view('new/template/navbar', $navbar);
        $this->load->view('pages/historyInIran', $data);
        $this->load->view('new/template/footer', $data);
    }

    public function historyInWorld()
    {
        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('new/template/header', $data);
        $this->load->view('new/template/navbar', $navbar);
        $this->load->view('pages/historyInWorld', $data);
        $this->load->view('new/template/footer', $data);
    }

    protected function sponsors()
    {
        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('new/template/header', $data);
        $this->load->view('new/template/navbar', $navbar);
        $this->load->view('pages/sponsors', $data);
        $this->load->view('new/template/footer', $data);
    }

    protected function gallery()
    {
        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $navbar);
        $this->load->view('pages/gallery', $data);
        $this->load->view('OnePage_template/footer', $data);
    }

    protected function nafas()
    {
        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $navbar);
        $this->load->view('pages/nafas', $data);
        $this->load->view('OnePage_template/footer', $data);
    }

    public function employment()
    {
        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $navbar);
        $this->load->view('pages/employment', $data);
        $this->load->view('OnePage_template/footer', $data);
    }
}