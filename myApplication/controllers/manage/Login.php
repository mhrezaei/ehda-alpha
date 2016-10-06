<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
	{
        if ($this->safiran_model->is_manager())
        {
            redirect(base_url('manage/home'));
            exit;
        }

        $data['err'] = '';
        if($this->input->post('txtUsername', true))
        {
            $username = $this->input->post('txtUsername', true);
            $password = $this->input->post('txtPassword', true);
            $question = $this->input->post('txtQuestion', true);
            $questionKey = $this->input->post('txtQuestionKey', true);

            if(nationalCode($username) AND strlen($password) > 3 AND strlen($question) > 0)
            {
                if(securityQuestion($question, $questionKey, TRUE, 'loginPage'))
                {
                    if ($this->safiran_model->login($username, hashStr($password)))
                    {
                        redirect(base_url('manage/home'));
                        exit;
                    }
                    else
                    {
                        $data['err'] = 3; // username or password not valid
                    }
                }
                else
                {
                    $data['err'] = 2; // security question not valid
                }
            }
            else
            {
                $data['err'] = 1; // data not valid
            }
        }
        $this->load->view('manage/login/login.php', $data);
	}

    public function logout()
    {
        $this->safiran_model->log_out();
        redirect(base_url('manage/login'));
        exit;
    }
}