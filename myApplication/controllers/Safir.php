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

        // pvc add to print
        if ($this->input->post('pvcPrint', true) and $this->input->post('ids', true))
        {
            $ids = $this->input->post('ids', true);
            if (is_array($ids) and count($ids) > 0)
            {
                for ($i = 0; $i < count($ids); $i++)
                {
                    $users = $this->db->select()->from('users')->where(array(
                        'id' => $ids[$i],
                    ))->get();
                    if ($users->num_rows())
                    {
                        $users = $users->row_array();
                        $users['data'] = $this->db->select()->from('users_data')->where('userID', $ids[$i])->get();
                        $users['data'] = $users['data']->row_array();

                        $insert = array(
                            'full_name' => $users['data']['firstName'] . ' ' . $users['data']['lastName'],
                            'father_name' => $users['data']['fatherName'],
                            'national_code' => $users['nationalcode'],
                            'birth_date' => pdate('Y/m/d', $users['data']['dateOfBirth']),
                            'register_date' => pdate('Y/m/d', $users['data']['registerTime']),
                            'register_number' => $users['memberID'],
                            'status' => 1,
                            'userID' => $ids[$i],
                        );
                        $this->db->insert('users_print', $insert);
                    }
                }
                $data['pvc'] = 'ok';
            }
        }

        // pvc verify print
        if ($this->input->post('verifyPvcPrint', true) and $this->input->post('ids', true))
        {
            $ids = $this->input->post('ids', true);
            if (is_array($ids) and count($ids) > 0)
            {
                for($i = 0; $i < count($ids); $i++)
                {
                    $user['res2'] = NULL;
                    $this->users_model->userUpdateField($ids[$i], $user);
                    $this->db->where('userID', $ids[$i]);
                    $this->db->delete('users_print');
                }
            }
        }

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

    public function pvc_print()
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
                $ids[] = $id;
            }
        }
        for ($i = 0; $i < count($ids); $i++)
        {
            $users = $this->db->select()->from('users')->where(array(
                'id' => $ids[$i],
            ))->get();
            if ($users->num_rows())
            {
                $users = $users->row_array();
                $users['data'] = $this->db->select()->from('users_data')->where('userID', $ids[$i])->get();
                $users['data'] = $users['data']->row_array();

                $insert = array(
                    'full_name' => $users['data']['firstName'] . ' ' . $users['data']['lastName'],
                    'father_name' => $users['data']['fatherName'],
                    'national_code' => $users['nationalcode'],
                    'birth_date' => pdate('Y/m/d', $users['data']['dateOfBirth']),
                    'register_date' => pdate('Y/m/d', $users['data']['registerTime']),
                    'register_number' => $users['memberID'],
                    'status' => 1,
                    'userID' => $ids[$i],
                );
                $this->db->insert('users_print', $insert);
            }
        }

        redirect(base_url('safir/printCard?pvc=ok'));

    }

    public function verifyPrintPvc()
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
            $this->db->where('userID', $ids[$i]);
            $this->db->delete('users_print');
        }

        redirect(base_url('safir/printCard'));
        exit;

    }

    public function editOneUser()
    {
        if(! $this->users_model->is_safir($this->password))
        {
            redirect(base_url('safir'));
            exit;
        }
        else
        {
            $data['user'] = '';
            $data['success'] = 'Err';
            if ($this->input->get('txtnationalcode', true))
            {
                $national = $this->input->get('txtnationalcode', true);
                $data['user'] = $this->users_model->isUnique_nationalCode($national);
                if ($data['user'])
                {

                    if ($this->input->post('txtRegisterID', true) and $this->input->post('txtRegisterID', true) == $data['user']['id'])
                    {
                        if ($this->input->post('txtPrint', true) == 3)
                        {
                            $this->db->where('userID', $data['user']['id']);
                            $this->db->delete('users_data');

                            $this->db->where('id', $data['user']['id']);
                            $this->db->delete('users');
                            $data['success'] = 'delete';
                            $data['user'] = 'Err';
                        }
                        else
                        {
                            $temp = explode('/', $this->input->post('txtExtraBirthday', true));
                            $birthDate = mktime(0, 0, 0, $temp[1], $temp[2], $temp[0]);
                            $user_update = array(
                                'firstName' => $this->input->post('txtRegisterFirstName', true),
                                'lastName' => $this->input->post('txtRegisterLastName', true),
                                'fatherName' => $this->input->post('txtRegisterFatherName', true),
                                'sex' => $this->input->post('cbRegisterGender', true),
                                'identifier' => $this->input->post('txtRegisterIDNumber', true),
                                'placeOfBirth' => $this->input->post('txtRegisterPlaceOfBirth', true),
                                'dateOfBirth' => $birthDate,
                                'mobile' => $this->input->post('txtRegisterMobile', true),
                                'phone' => $this->input->post('txtRegisterTel', true),
                                'state' => $this->input->post('cbRegisterState', true),
                                'city' => $this->input->post('cbRegisterCity', true),
                            );
                            $this->db->where('userID', $data['user']['id']);
                            $this->db->update('users_data', $user_update);

                            if ($this->input->post('txtPrint', true) == 1)
                            {
                                $user_info['res2'] = 1;
                            }
                            else
                            {
                                $user_info['res2'] = null;
                            }

                            if ($this->input->post('changePasswordFromMobile', true))
                            {
                                $user_info['password'] = hashStr($this->input->post('changePasswordFromMobile', true));
                            }
                            
                            $this->db->where('id', $data['user']['id']);
                            $this->db->update('users', $user_info);
                            $data['success'] = 'ok';
                        }

                    }

                    if (is_array($data['user']))
                    {
                        $data['user']['data'] = $this->db->select()->from('users_data')->where('userID', $data['user']['id'])->get();
                        $data['user']['data'] = $data['user']['data']->row_array();
                    }

                }
                else
                {
                    $data['user'] = 'Err';
                }
            }

            $navbar = $this->users_model->is_user();
            if($navbar)
            {
                $navbar = $this->users_model->selectUserByID($navbar['id']);
            }

            $this->load->view('OnePage_template/header', $data);
            $this->load->view('OnePage_template/navbar', $navbar);
            $this->load->view('safir/editUser', $data);
            $this->load->view('OnePage_template/footer', $data);
        }
    }

    public function test()
    {
        showArray($this->input->post());
    }

}