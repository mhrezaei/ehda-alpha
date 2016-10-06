<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Safir extends CI_Controller {

	private $username = 'safir';
    private $password = '1346798520';

    public function __construct()
    {
        parent::__construct();
        if(! $this->users_model->is_safir($this->password) AND $this->uri->segment(2) != 'login')
        {
            redirect(base_url('safir/login'));
            exit;
        }
    }
    
    public function index()
	{
        // validate user
        if(! $this->users_model->is_safir($this->password))
        {
            redirect(base_url('safir/login'));
            exit;
        }

        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $navbar);
        $this->load->view('safir/register', $data);
        $this->load->view('OnePage_template/footer', $data);
	}

    public function login()
    {
        // validate user
        if($this->users_model->is_safir($this->password))
        {
            redirect(base_url('safir'));
            exit;
        }
        else
        {
            if($this->input->post('txtSafirLoginUsername'))
            {
                $username = htmlCoding($this->input->post('txtSafirLoginUsername'));
                $password = htmlCoding($this->input->post('txtSafirLoginPassword'));
                $qs = htmlCoding($this->input->post('txtSafirLoginQa'));
                $qsK = htmlCoding($this->input->post('txtSafirLoginQsK'));

                if(securityQuestion($qs, $qsK, TRUE, 'safirLoginQs'))
                {
                    if($this->username == $username AND $this->password == $password)
                    {
                        $session['safir']['auth'] = hashStr($this->password);
                        $session['safir']['role'] = 'SAFIR';
                        $this->session->set_userdata($session);
                        redirect(base_url('safir'));
                        exit;
                    }
                    else
                    {
                        $data['msg'] = 2; // user and pass not true
                    }
                }
                else
                {
                    $data['msg'] = 1; // qs not true
                }

                $navbar = $this->users_model->is_user();
                if($navbar)
                {
                    $navbar = $this->users_model->selectUserByID($navbar['id']);
                }
                $this->load->view('OnePage_template/header', $data);
                $this->load->view('OnePage_template/navbar', $navbar);
                $this->load->view('safir/login', $data);
                $this->load->view('OnePage_template/footer', $data);

            }
            else
            {
                $data = '';
                $navbar = $this->users_model->is_user();
                if($navbar)
                {
                    $navbar = $this->users_model->selectUserByID($navbar['id']);
                }
                $this->load->view('OnePage_template/header', $data);
                $this->load->view('OnePage_template/navbar', $navbar);
                $this->load->view('safir/login', $data);
                $this->load->view('OnePage_template/footer', $data);
            }
        }
    }

    public function printCard()
    {
        // validate user
        if(! $this->users_model->is_safir($this->password))
        {
            redirect(base_url('safir/login'));
            exit;
        }

        $data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $user = $this->db->select()->from('users')->where('res2', 1)->limit(40, 0)->order_by('id', 'ASC')->get();
        if($user->num_rows() > 0)
        {
            $card['users'] = $user->result_array();
            $card['status'] = 1;
            $card['ids'] = '';
            for($i = 0; $i < count($card['users']); $i++)
            {
                $card['users'][$i] = $this->users_model->selectUserByID($card['users'][$i]['id']);
                if($i != count($card['users']) - 1)
                {
                    $card['ids'] .= $card['users'][$i]['id'] . ',';
                }
                else
                {
                    $card['ids'] .= $card['users'][$i]['id'];
                }
            }
            $total = $this->db->select('id')->from('users')->where('res2', 1)->order_by('id', 'ASC')->get();
            $total = $total->num_rows();
            $card['total'] = $total;
        }
        else
        {
            $card = '';
            $card['status'] = 0;
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $navbar);
        $this->load->view('safir/cardPrint', $card);
        $this->load->view('OnePage_template/footer', $data);
    }

    public function printer()
    {
        // validate user
        if(! $this->users_model->is_safir($this->password))
        {
            redirect(base_url('safir/login'));
            exit;
        }

        $id = $this->input->get('ids');
        if(!$id OR strlen($id) < 1)
        {
            redirect(base_url('safir'));
            exit;
        }
        else
        {
            if(strpos($id, ','))
            {
                $id = explode(',', $id);
            }
            else
            {
                $id[0] = $id;
            }
        }

        $data['id'] = $id;

        $this->load->view('safir/printer', $data);

    }

    public function verifyPrint()
    {
        // validate user
        if(! $this->users_model->is_safir($this->password))
        {
            redirect(base_url('safir/login'));
            exit;
        }

        $id = $this->input->get('ids');
        if(!$id OR strlen($id) < 1)
        {
            redirect(base_url('safir'));
            exit;
        }
        else
        {
            if(strpos($id, ','))
            {
                $ids = explode(',', $id);
            }
            else
            {
                $ids[0] = $id;
            }
        }

        $data['id'] = $ids;

        for($i = 0; $i < count($ids); $i++)
        {
            $user['res2'] = NULL;
            $this->users_model->userUpdateField($ids[$i], $user);
        }

        redirect(base_url('safir/printCard'));
        exit;

    }

}