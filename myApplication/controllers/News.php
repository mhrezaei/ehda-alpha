<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News extends CI_Controller
{

    public $data;

    public function __construct()
    {
        parent::__construct();
        $this->data = $this->header_model->header_data();
    }

    public function index()
    {
        redirect(base_url());
    }

    public function showNews($id)
    {
        if(is_numeric($id) AND $id > 0)
        {
            $data = '';
            $navbar = $this->users_model->is_user();
            if($navbar)
            {
                $navbar = $this->users_model->selectUserByID($navbar['id']);
            }

            $news = $this->db->select()->from('news')->where(array(
                'id' => $id,
                'status' => 1
            ))->get();
            if($news->num_rows())
            {
                $news = $news->row_array();
                $this->data['news'] = $news;
            }
            else
            {
                redirect(base_url());
            }

            $this->load->view('new/template/header', $this->data);
            $this->load->view('new/template/navbar', $navbar);
            $this->load->view('new/template/showOneNews');
            $this->load->view('new/template/footer', $data);
        }
        else
        {
            redirect(base_url());
        }
    }

    protected function tabdil()
    {
        echo pmktime(0,0,0,11,24,1394);
    }
}