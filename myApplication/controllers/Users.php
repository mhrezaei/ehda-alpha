<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller {

	public $data;

    public function __construct()
    {
        parent::__construct();
        $this->data = $this->header_model->header_data();
        if(! $this->users_model->is_user() AND $this->uri->segment(2) != 'forgotPassword')
        {
            redirect(base_url());
            exit;
        }
    }
    
    public function index()
	{
        // validate user
        if(! $this->users_model->is_user())
        {
            redirect(base_url());
            exit;
        }

        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('new/template/header', $this->data);
        $this->load->view('new/template/navbar', $navbar);
        $this->load->view('new/template/usersIndex', $data);
        $this->load->view('new/template/footer', $data);
	}

    public function edit()
    {
        // validate user
        if(! $this->users_model->is_user())
        {
            redirect(base_url());
            exit;
        }

        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('new/template/header', $this->data);
        $this->load->view('new/template/navbar', $navbar);
        $this->load->view('new/template/userEditForm', $data);
        $this->load->view('new/template/footer', $data);
    }

    public function forgotPassword($key)
    {
        if(!$key || $this->users_model->is_user())
        {
            show_404();
            exit;
        }
        else
        {
            $key = $this->users_model->findForgotRequest($key);
            if($key)
            {
                $user = $this->users_model->selectUserByID($key['userID']);
                if($user AND $user['status'] == 1)
                {
                    $user['key'] = $key;
                    $navbar = '';

                    $this->load->view('new/template/header', $this->data);
                    $this->load->view('new/template/navbar', $navbar);
                    $this->load->view('new/template/main', $navbar);
                    $this->load->view('new/template/forgotPasswordModal', $user);
                    $this->load->view('new/template/footer', $navbar);

                    if($key['time'] + (60 * 60) < time())
                    {
                        $this->users_model->deleteForgotPasswordByUser($user['id']);
                    }
                }
                else
                {
                    redirect(base_url());
                    exit;
                }
            }
            else
            {
                redirect(base_url());
                exit;
            }
        }
    }

}