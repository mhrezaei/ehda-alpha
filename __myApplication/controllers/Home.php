<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

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
    
    public function index()
	{
		$data = '';

        // angels
        $data['angels'] = $this->db->select()->from('angels_pic')->where('status', 1)->order_by('id', 'random')->limit(60, 0)->get();
        if($data['angels']->num_rows() > 0)
        {
            $data['angels'] = $data['angels']->result_array();
        }
        else
        {
            $data['angels'] = FALSE;
        }

        // news
        $data['news'] = $this->db->select(array(
            'id',
            'title',
            'time'
        ))->from('news')->where('status', 1)->order_by('time', 'DESC')->limit(10, 0)->get();
        if($data['news']->num_rows() > 0)
        {
            $data['news'] = $data['news']->result_array();
        }
        else
        {
            $data['news'] = FALSE;
        }

        $this->load->view('new/template/header', $this->data);
        $this->load->view('new/template/navbar2', $this->navbar);
        $this->load->view('new/template/slider');
        $this->load->view('new/template/main', $data);
        $this->load->view('new/template/footer', $data);
	}

    public function organDonation()
    {
        $data = '';

        $this->load->view('new/template/header', $this->data);
        $this->load->view('new/template/navbar', $this->navbar);
        $this->load->view('new/template/organDonation');
        $this->load->view('new/template/footer', $data);
    }

    public function aboutUs()
    {
        $data = '';

        $this->load->view('new/template/header', $this->data);
        $this->load->view('new/template/navbar', $this->navbar);
        $this->load->view('new/template/aboutUs');
        $this->load->view('new/template/footer', $data);
    }

    public function contactUs()
    {
        $data = '';

        $this->load->view('new/template/header', $this->data);
        $this->load->view('new/template/navbar', $this->navbar);
        $this->load->view('new/template/contactUs');
        $this->load->view('new/template/footer', $data);
    }

    public function register()
    {
        $data = '';
        if($this->users_model->is_user())
        {
            redirect(base_url('users'));
            exit;
        }

        $this->load->view('new/template/header', $this->data);
        $this->load->view('new/template/navbar', $data);
        $this->load->view('new/template/organDonation_registerForm', $data);
        $this->load->view('new/template/footer', $data);
    }

    public function safiran()
    {
        $data = '';

        $this->load->view('new/template/header', $this->data);
        $this->load->view('new/template/navbar', $this->navbar);
        $this->load->view('new/template/safiran', $data);
        $this->load->view('new/template/footer', $data);
    }

    public function safiranExam()
    {
        $data = '';

        $data['questions'] = $this->db->select()->from('exam_questions')->where(array(
            'examId' => 1,
            'status' => 1
        ))->order_by('id', 'ASC')->get();
        if($data['questions']->num_rows())
        {
            $data['questions'] = $data['questions']->result_array();
        }
        else
        {
            redirect(base_url());
        }

        $data['safiranActivities'] = $this->db->select()->from('safiran_activities')->where('status', 1)->get();
        if($data['safiranActivities']->num_rows())
        {
            $data['safiranActivities'] = $data['safiranActivities']->result_array();
        }
        else
        {
            $data['safiranActivities'] = FALSE;
        }

        $this->load->view('new/template/header', $this->data);
        $this->load->view('new/template/navbar', $this->navbar);
        $this->load->view('new/template/safiranExam', $data);
        $this->load->view('new/template/footer', $data);
    }

    public function logOut()
    {
        $this->users_model->log_out();
        redirect(site_url());
        exit;
    }

    public function user_email()
    {
        $user = $this->db
            ->select()
            ->from('users')
            ->where('has_mail > ', 0)
            ->order_by('id', 'RANDOM')
            ->limit(30)
            ->get();
        if ($user->num_rows())
        {
            $user = $user->result_array();

            $this->load->library('email');
            $a = 1;
            for ($i = 0; $i < count($user); $i++)
            {
                // email send
                $config['protocol']    = 'smtp';
                $config['smtp_host']    = 'smtp.ehda.center';
                $config['smtp_port']    = '587';
                $config['smtp_timeout'] = '7';
                $config['smtp_user']    = 'no-reply@ehda.center';
                $config['smtp_pass']    = 'qacOKBoZVM';
                $config['charset']    = 'utf-8';
                $config['newline']    = "\r\n";
                $config['mailtype'] = 'html'; // or text
                $config['validation'] = TRUE; // bool whether to validate email or not

                $this->email->initialize($config);

                $this->email->from('no-reply@ehda.center', 'ehda.center');
                $this->email->to($user[$i]['email']);

                $this->email->subject('اهدای عضو، اهدای زندگی');
                $mail = $this->load->view('email_template/user_email', null, true);
                $this->email->message($mail);

                $this->email->send();

                $update = array(
                    'has_mail' => 0,
                );
                $this->db->where('id', $user[$i]['id']);
                $this->db->update('users', $update);
                $a++;
            }

            echo $a . ' Mail Send!';
        }
        else
        {
            echo 'No User!';
        }
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

    protected function zzz()
    {
        $role = array('safir', 'root');
        showArray($role);
        $role = json_encode($role);
        showArray($role);
        $role = $this->encrypt->encode($role);
        showArray($role);
        $role = $this->encrypt->decode($role);
        $role = json_decode($role, true);
        showArray($role);
//        showArray(in_array('root', $role));
//        showArray(hashStr('001207'));
    }

    protected function ddd()
    {
        echo 'users data';
        $data = $this->db->select(array(
            'firstName',
            'lastName',
            'phone',
            'mobile'
        ))->from('users_data')->order_by('id', 'RANDOM')->limit(200)->get();
        if ($data->num_rows())
        {
            $data = $data->result_array();
            echo '<table style="font-family: Tahoma; font-size: 12px; border: 1px solid black;"><thead><tr><th>ردیف</th><th>نام</th><th>نام خانوادگی</th><th>شماره تماس</th><th>شماره موبایل</th></tr></thead><tbody>';
            for ($i = 0, $a = 1; $i < count($data); $i++)
            {
                echo '<tr style="border: 1px solid black;"><th style="border: 1px solid black;">' . $a++ . '</th>';
                echo '<td style="border: 1px solid black;">' . $data[$i]['firstName'] . '</td>';
                echo '<td style="border: 1px solid black;">' . $data[$i]['lastName'] . '</td>';
                echo '<td style="border: 1px solid black;">' . $data[$i]['phone'] . '</td>';
                echo '<td style="border: 1px solid black;">' . $data[$i]['mobile'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        }
        else
        {
            echo 'no data';
        }
    }
}