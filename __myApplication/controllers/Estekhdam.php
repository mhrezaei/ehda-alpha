<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estekhdam extends CI_Controller {

	private $username = 'estekhdam';
    private $password = 'dr@1346798520';

    public function __construct()
    {
        parent::__construct();
        if(! $this->is_estekhdam() AND $this->uri->segment(2) != 'login')
        {
            redirect(base_url('estekhdam/login'));
            exit;
        }
    }
    
    public function index()
	{
        if(!$this->is_estekhdam())
        {
            redirect(base_url('estekhdam/login'));
            exit;
        }

        $data = $this->db->select()->from('employment')->where('status', 1)->order_by('id', 'DESC')->get();
        if($data->num_rows())
        {
            $from['forms'] = $data->result_array();
            for($i = 0; $i < count($from['forms']); $i++)
            {
                $from['forms'][$i]['oJob'] = str_replace("\n", "<br>", $from['forms'][$i]['oJob']);
                $from['forms'][$i]['oJob'] = str_replace("\r", "<br>", $from['forms'][$i]['oJob']);
                $from['forms'][$i]['doc'] = str_replace("\r", "<br>", $from['forms'][$i]['doc']);
                $from['forms'][$i]['doc'] = str_replace("\n", "<br>", $from['forms'][$i]['doc']);
            }
        }
        else
        {
            $from['forms'] = FALSE;
        }
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $navbar);
        $this->load->view('estekhdam/allForms', $from);
        $this->load->view('OnePage_template/footer', $data);
	}

    public function login()
    {
        if($this->is_estekhdam())
        {
            redirect(base_url('estekhdam'));
            exit;
        }

        if($this->input->post('txtSafirLoginUsername', TRUE, TRUE))
        {
            $username = htmlCoding($this->input->post('txtSafirLoginUsername', TRUE, TRUE));
            $password = htmlCoding($this->input->post('txtSafirLoginPassword', TRUE, TRUE));
            $qs = htmlCoding($this->input->post('txtSafirLoginQa', TRUE, TRUE));
            $qsK = htmlCoding($this->input->post('txtSafirLoginQsK', TRUE, TRUE));

            if(securityQuestion($qs, $qsK, TRUE, 'esLoginQs'))
            {
                if($this->username == $username AND $this->password == $password)
                {
                    $session['estekhdam']['auth'] = hashStr($this->password);
                    $session['estekhdam']['role'] = 'ESTEKHDAM';
                    $this->session->set_userdata($session);
                    redirect(base_url('estekhdam'));
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
            $this->load->view('estekhdam/login', $data);
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
            $this->load->view('estekhdam/login', $data);
            $this->load->view('OnePage_template/footer', $data);
        }
    }

    public function is_estekhdam()
    {
        $es = $this->session->userdata('estekhdam');
        if($es)
        {
            if($es['role'] == 'ESTEKHDAM')
            {
                if($es['auth'] == hashStr($this->password))
                {
                    return TRUE;
                    exit;
                }
                else
                {
                    $this->session->unset_userdata('ESTEKHDAM');
                    return FASLE;
                    exit;
                }
            }
            else
            {
                return FALSE;
                exit;
            }
        }
        else
        {
            return FALSE;
            exit;
        }
    }

    public function delForm($id = FALSE)
    {
        if(! $this->is_estekhdam())
        {
            redirect(base_url('estekhdam/login'));
            exit;
        }

        if(is_numeric($id))
        {
            $data['status'] = 2;
            $this->db->where('id', $id);
            $this->db->update('employment', $data);
            redirect(base_url('estekhdam'));
        }
    }

    public function printForm($id = FALSE)
    {
        if(! is_numeric($id) OR $id < 1)
        {
            redirect(base_url('estekhdam'));
            exit;
        }

        $form = $this->db->select()->from('employment')->where('id', $id)->order_by('id', 'DESC')->get();
        if($form->num_rows())
        {
            $from['forms'] = $form->row_array();
            $from['forms']['oJob'] = str_replace("\n", "<br>", $from['forms']['oJob']);
            $from['forms']['oJob'] = str_replace("\r", "<br>", $from['forms']['oJob']);
            $from['forms']['doc'] = str_replace("\r", "<br>", $from['forms']['doc']);
            $from['forms']['doc'] = str_replace("\n", "<br>", $from['forms']['doc']);
        }
        else
        {
            redirect(base_url('estekhdam'));
            exit;
        }

        $data = '';
        $this->load->view('OnePage_template/header', $data);
        $this->load->view('estekhdam/printForm', $from);
        $this->load->view('OnePage_template/footer', $data);
    }

}