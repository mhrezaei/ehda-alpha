<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
	{
		$data = '';
        $navbar = $this->users_model->is_user();
        if($navbar)
        {
            $navbar = $this->users_model->selectUserByID($navbar['id']);
        }
        $data['angels'] = $this->db->select()->from('angels_pic')->where('status', 1)->order_by('id', 'random')->limit(60, 0)->get();
        if($data['angels']->num_rows() > 0)
        {
            $data['angels'] = $data['angels']->result_array();
        }
        else
        {
            $data['angels'] = FALSE;
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $navbar);
        $this->load->view('OnePage_template/onePage_fullPage', $data);
        $this->load->view('OnePage_template/footer', $data);
	}

    public function register()
    {
        $data = '';
        if($this->users_model->is_user())
        {
            redirect(base_url('users'));
            exit;
        }

        $this->load->view('OnePage_template/header', $data);
        $this->load->view('OnePage_template/navbar', $data);
        $this->load->view('OnePage_template/onePage_registerForm', $data);
        $this->load->view('OnePage_template/footer', $data);
    }

    public function logOut()
    {
        $this->users_model->log_out();
        redirect(site_url());
        exit;
    }

    protected function state()
    {
        $state = '';
        $city1 = '';
        $query = $this->db->select(array('id', 'name'))->from('states')->where(array('status' => 1, 'parentID' => 0))->order_by('name', 'ASC')->get();
        if($query->num_rows() > 0)
        {
            $query = $query->result_array();
            for($i = 0; $i < count($query); $i++)
            {
                $state[$i]['name'] = $query[$i]['name'];
                $state[$i]['id'] = $query[$i]['id'];
                $city = $this->db->select(array('id', 'name'))->from('states')->where(array(
                    'status' => 1,
                    'parentID' => $query[$i]['id']
                ))->order_by('name', 'ASC')->get();
                if($city->num_rows() > 0)
                {
                    $city = $city->result_array();
                    for($a = 0; $a < count($city); $a++)
                    {
                        $city1[$query[$i]['id']][$city[$a]['id']]['name'] = $city[$a]['name'];
                        $city1[$query[$i]['id']][$city[$a]['id']]['id'] = $city[$a]['id'];
                    }
                }
            }
            $state = json_encode($state);
            $city = json_encode($city1);
            echo "var state = " . $state . ", city = " . $city;
        }
    }

    protected function convert()
    {
        $oldUsers = $this->db->select()->from('users_old')->where('status', 1)->order_by('id', 'ASC')->limit(200, 0)->get();
        if($oldUsers->num_rows() > 0)
        {
            $oldUsers = $oldUsers->result_array();
            $a = 0;
            for($i = 0; $i < count($oldUsers); $i++, $a++)
            {
                $user['nationalcode'] = $oldUsers[$i]['nationalCode'];
                $user['username'] = str_replace(' ', '', $oldUsers[$i]['userName']);
                $user['email'] = $oldUsers[$i]['email'];
                $user['password'] = $oldUsers[$i]['passWord'];
                $user['status'] = 1;
                $user['memberID'] = $oldUsers[$i]['id'] + 1500;
                $user['hash'] = hashStr($oldUsers[$i]['nationalCode']);
                $user['id'] = null;

                $this->users_model->registerNewUser($user);

                $user = $this->users_model->isUnique_nationalCode($oldUsers[$i]['nationalCode']);
                // user data
                $userData['id'] = null;
                $userData['userID'] = $user['id'];
                $userData['firstName'] = $oldUsers[$i]['firstName'];
                $userData['lastName'] = $oldUsers[$i]['lastName'];
                $userData['fatherName'] = $oldUsers[$i]['firstFatherName'];
                $userData['sex'] = $oldUsers[$i]['sex'];
                $userData['identifier'] = $oldUsers[$i]['identifier'];
                $userData['placeOfBirth'] = $oldUsers[$i]['placeOfBirth'];
                $userData['dateOfBirth'] = $oldUsers[$i]['dateOfBirth'];
                $userData['education'] = $oldUsers[$i]['education'];
                $userData['job'] = $oldUsers[$i]['job'];
                $userData['phone'] = $oldUsers[$i]['homePhone'];
                $userData['mobile'] = $oldUsers[$i]['mobile'];
                $userData['state'] = $oldUsers[$i]['state'];
                $userData['city'] = $oldUsers[$i]['city'];
                $userData['address'] = $oldUsers[$i]['address'];
                $userData['postalCode'] = $oldUsers[$i]['postalCode'];
                $userData['organs'] = "All";
                $userData['status'] = 1;
                $userData['registerTime'] = $oldUsers[$i]['registerTime'];

                $this->users_model->registerNewUserData($userData);

                $update['status'] = 2;
                $this->db->where('id', $oldUsers[$i]['id']);
                $this->db->update('users_old', $update);

            }
            echo $a;
            echo '<script>setTimeout(function(){ location.reload(); }, 5000);</script>';
        }
    }

    protected function names()
    {
        $names = $this->db->select()->from('angels_pic')->get();
        if($names->num_rows() > 0)
        {
            $names = $names->result_array();
            for($i = 0; $i < count($names); $i++)
            {
                $data['name'] = str_replace('/r/n', '', str_replace('\r\n', '', htmlCoding($names[$i]['name'])));
                $this->db->where('id', $names[$i]['id']);
                $this->db->update('angels_pic', $data);
            }
        }
    }
}