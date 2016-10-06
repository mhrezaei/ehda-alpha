<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public $data;
    public $navbar;

    public function __construct()
    {
        parent::__construct();
        $this->data['manager'] = $this->safiran_model->selectManagerByID($this->safiran_model->is_manager());
        if (! $this->data['manager'] OR ! $this->safiran_model->haveRoles('safir'))
        {
            redirect('manage/login');
            exit;
        }
    }
    
    public function index()
	{
		$this->data['main'] = $this->db->select()->from('pages')->where(array(
            'slug' => 'mainManagement',
            'status' => 1
        ))->get();
        if ($this->data['main']->num_rows())
        {
            $this->data['main'] = $this->data['main']->row_array();
        }
        else
        {
            $this->data['main'] = false;
        }

        $this->load->view('manage/template/header', $this->data);
		$this->load->view('manage/template/navbar');
		$this->load->view('manage/template/sidebar');
		$this->load->view('manage/template/main');
	}

    public function addNews()
    {

        $this->data['insert'] = 0;
        if ($this->input->post('txtTitle', TRUE, TRUE))
        {
            $title = $this->input->post('txtTitle', TRUE, TRUE);
            $date = $this->input->post('txtExtraDate', TRUE, TRUE);
            $content = $this->input->post('txtContent');
            if (strlen($title) > 5 && strlen($date) > 5 && strlen($content) > 20)
            {
                $date = explode('/', $date);
                $date = mktime(0, 0, 0, $date[1], $date[2], $date[0]);

                $insert = array(
                    'title' => $title,
                    'content' => htmlCoding($content),
                    'time' => $date,
                    'status' => 1
                );
                $this->db->insert('news', $insert);
                $this->data['insert'] = 1;
            }
        }

        $this->load->view('manage/template/header', $this->data);
        $this->load->view('manage/template/navbar');
        $this->load->view('manage/template/sidebar');
        $this->load->view('manage/template/addNews');
    }

    public function manageNews()
    {

        if ($this->input->get('action', TRUE, TRUE) AND $this->input->get('action', TRUE, TRUE) == 'del')
        {
            $id = $this->input->get('id', TRUE, TRUE);
            if ($id > 0 AND is_numeric($id))
            {
                $update = array(
                    'status' => 15
                );
                $this->db->where('id', $id);
                $this->db->update('news', $update);
                redirect(base_url('manage/home/manageNews'));
            }
        }

        $this->data['news'] = $this->db->select(array(
            'id',
            'title',
            'time'
        ))->from('news')->where('status', 1)->order_by('id', 'desc')->get();
        if ($this->data['news']->num_rows())
        {
            $this->data['news'] = $this->data['news']->result_array();
        }
        
        $this->load->view('manage/template/header', $this->data);
        $this->load->view('manage/template/navbar');
        $this->load->view('manage/template/sidebar');
        $this->load->view('manage/template/manageNews');
    }

    public function editNews($id)
    {

        if (!$id || !is_numeric($id) || $id < 1)
        {
            redirect(base_url('manage/home'));
        }

        $this->data['insert'] = 0;
        if ($this->input->post('txtTitle', TRUE, TRUE))
        {
            $title = $this->input->post('txtTitle', TRUE, TRUE);
            $date = $this->input->post('txtExtraDate', TRUE, TRUE);
            $content = $this->input->post('txtContent');
            if (strlen($title) > 5 && strlen($date) > 5 && strlen($content) > 20)
            {
                $date = explode('/', $date);
                $date = mktime(0, 0, 0, $date[1], $date[2], $date[0]);

                $update = array(
                    'title' => $title,
                    'content' => htmlCoding($content),
                    'time' => $date,
                    'status' => 1
                );
                $this->db->where('id', $id);
                $this->db->update('news', $update);
                $this->data['insert'] = 1;
            }
        }

        $this->data['news'] = $this->db->select()->from('news')->where(array(
            'id' => $id,
            'status' => 1
        ))->get();
        if ($this->data['news']->num_rows())
        {
            $this->data['news'] = $this->data['news']->row_array();
        }
        else
        {
            redirect(base_url('manage/home'));
        }

        $this->load->view('manage/template/header', $this->data);
        $this->load->view('manage/template/navbar');
        $this->load->view('manage/template/sidebar');
        $this->load->view('manage/template/editNews');
    }
}