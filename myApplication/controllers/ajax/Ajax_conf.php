<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax_conf extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ajax/ajax_model');
 		$this->load->model('users/users_model');
   }
    
    public function index()
    {
        // index
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
    }
    
    // load state and city
    public function load_states()
    {
        if (!$this->input->is_ajax_request()) {
           show_404();
           exit;
        }
        $data = $this->ajax_model->load_state();
        if($this->input->post('isSelected'))
        {
            $selected = ' selected="selected" ';
        }
        else
        {
            $selected = '';
        }
        $op = '<option value="0">انتخاب کنید...</option>';
        if($data AND is_array($data) AND count($data) > 0)
        {
            for($i = 0; $i < count($data); $i++)
            {
                if($this->input->post('isSelected') == $data[$i]['id'])
                {
                    $op .= '<option value="' . $data[$i]['id'] . '"' . $selected . '>' . $data[$i]['name'] . '</option>';
                }
                else
                {
                    $op .= '<option value="' . $data[$i]['id'] . '">' . $data[$i]['name'] . '</option>';
                }
            }
        }
        
        echo $op;
    }
    
    //=========================================================================================
    public function checkPhoneNo($number , $mode)
    {
		if(!is_numeric($number))		return false ; 
		if(strlen($number)!=11)			return false ;
		if(substr($number,0,1)!="0")	return false ;
		if(substr($number,1,1)=="0")	return false ;
		
		if($mode=="mob") {
			if(substr($number,1,1)!="9")	return false ;
		}
		elseif($mode=="fixed") {
			if(substr($number,1,1)=="9")	return false ;
		}
		
		return true ; 
    }

    
    //=========================================================================================
    public function cardRegister()
    {
    	$this->load->library("JsonFeed");
    	$this->load->library("Strings");

        if (!$this->input->is_ajax_request()) {
            show_404();
            exit;
        }
    	
		//Load Values...
		$data['firstName']			= strings::safe($this->input->post('txtName'			, TRUE, TRUE) , "F"	);
		$data['lastName']			= strings::safe($this->input->post('txtFam'				, TRUE, TRUE) , "F"	);
		$data['sex']				= strings::safe($this->input->post('cmbGender'			, TRUE, TRUE) , "9"	);
		$data['firstFatherName']	= strings::safe($this->input->post('txtFather'			, TRUE, TRUE) , "F"	);
		$data['identifier']			= strings::safe($this->input->post('txtShenas'			, TRUE, TRUE) , "E"	);
		$data['nationalCode']		= strings::safe($this->input->post('txtMelli'			, TRUE, TRUE) , "E"	);
		$data['dateOfBirth']		= strings::safe($this->input->post('txtExtraBirthday'	, TRUE, TRUE) 		);
		$data['placeOfBirth']		= strings::safe($this->input->post('txtBirthCity'		, TRUE, TRUE) , "F"	);
		$data['education']			= strings::safe($this->input->post('cmbEducation'		, TRUE, TRUE) , "9"	);
		$data['job']				= strings::safe($this->input->post('txtJob'				, TRUE, TRUE) , "F"	);
		$data['mobile']				= strings::safe($this->input->post('txtMob'				, TRUE, TRUE) , "E"	);
		$data['homePhone']			= strings::safe($this->input->post('txtTel'				, TRUE, TRUE) , "E"	);
		$data['state']				= strings::safe($this->input->post('txtState'			, TRUE, TRUE) , "9"	);
		$data['city']				= strings::safe($this->input->post('txtCity'			, TRUE, TRUE) , "9"	);
		$data['email']				= strings::safe($this->input->post('txtEmail'			, TRUE, TRUE) , "E"	);
		$data['userName']			= strings::safe($this->input->post('txtUsername'		, TRUE, TRUE) , "E"	);
		$data['pass1']				= strings::safe($this->input->post('txtPass1'			, TRUE, TRUE) , "E"	);
		$data['pass2']				= strings::safe($this->input->post('txtPass2'			, TRUE, TRUE) , "E"	);
		$data['organ_all']			= strings::safe($this->input->post('chkAll'				, TRUE, TRUE) , "Y"	);
		$data['organ_heart']		= strings::safe($this->input->post('chkHeart'			, TRUE, TRUE) , "Y"	);
		$data['organ_liver']		= strings::safe($this->input->post('chkLiver'			, TRUE, TRUE) , "Y"	);
		$data['organ_lung']			= strings::safe($this->input->post('chkLung'			, TRUE, TRUE) , "Y"	);
		$data['organ_kidney']		= strings::safe($this->input->post('chkKidney'			, TRUE, TRUE) , "Y"	);
		$data['organ_panreas']		= strings::safe($this->input->post('chkPancreas'		, TRUE, TRUE) , "Y"	);
		$data['organ_tissues']		= strings::safe($this->input->post('chkTissues'			, TRUE, TRUE) , "Y"	);
		$dobleChecked				= strings::safe($this->input->post('txtDoubleCheck'		, TRUE, TRUE) , "Y"	);

		//Validation... 
		if(1) {
			if(!nationalCode($data['nationalCode']))
				JsonFeed::say("ساختار کد ملی درست نیست" , array("fields"=>"#txtMelli"));
				
	        $temp = explode('/', $data['dateOfBirth']);
	        if(!is_array($temp) OR !isset($temp[1]) OR !isset($temp[2]) OR !isset($temp[0]))
    			JsonFeed::say("ساختار تاریخ تولد درست نیست" , array("fields"=>"#txtBirthday"));
	        $data['dateOfBirth'] = mktime(0, 0, 0, $temp[1], $temp[2], $temp[0]);
			
			if(!$data['firstName'] OR !$data['lastName'] OR !$data['sex'] OR !$data['firstFatherName'] OR !$data['identifier'] OR !$data['nationalCode'] OR !$data['dateOfBirth'] OR !$data['placeOfBirth'] OR !$data['mobile'] OR !$data['homePhone'] OR !$data['state'] OR !$data['city'] OR !$data['userName'] OR !$data['pass1'] OR !$data['pass2'])
				JsonFeed::say("fill-stared" , array("fields"=>"#txtName,#txtFam,#cmbGender,#txtFather,#txtShenas,#txtMelli,#txtBirthCity,#txtMob,#txtTel,#txtState,#txtCity,#txtUsername,#txtPass1,#txtPass2"));
						
			if(!persianChar($data['firstName']) OR !persianChar($data['lastName'])  OR !persianChar($data['firstFatherName']) OR !persianChar($data['placeOfBirth']))
				JsonFeed::say("اطلاعات فارسی را با الفبای فارسی تکمیل نمایید" , array("fields"=>"#txtName,#txtFam,#txtFather,#txtBirthCity,#txtJob"));

            if(strlen($data['job']) > 0 AND !persianChar($data['job']))
                JsonFeed::say("اطلاعات فارسی را با الفبای فارسی تکمیل نمایید" , array("fields"=>"s#txtJob"));
				
			$maxDate	= time() ; //time() - 15 * 12 * 30 * 24 * 3600	;
			if($data['dateOfBirth'] > $maxDate) 
				JsonFeed::say("تاریخ تولد مورد قبول نیست" , array("fields"=>"#txtBirthday"));//JsonFeed::say("ثبت‌نام برای زیر ۱۵ سال فعلا مجاز نیست");

			if($data['sex'] != 1 AND $data['sex'] != 2)
				jsonfeed::say("جنسیت را از فهرست انتخاب کنید" , array("fields"=>"#cmbGender"));
				
			if($data['education']>6)
				jsonfeed::say("میزان تحصیلات را از فهرست انتخاب کنید" , array("fields"=>"#cmbEducation"));

			if(!is_numeric($data['identifier']) OR strlen($data['identifier'])==0)
				JsonFeed::say("ساختار شماره شناسنامه درست نیست" , array("fields"=>"#txtShenas"));
				
			if ($data['email'] && !filter_var($data['email'], FILTER_VALIDATE_EMAIL))
				JsonFeed::say("ساختار نشانی ایمیل درست نیست" , array("fields"=>"#txtEmail"));
			
			if(!self::checkPhoneNo($data['homePhone'] , "fixed"))
				JsonFeed::say("ساختار شماره تلفن درست نیست" , array("fields"=>"#txtTel"));
			
				if(!self::checkPhoneNo($data['mobile'] , "mob"))
			JsonFeed::say("ساختار شماره تلفن همراه درست نیست" , array("fields"=>"#txtMob"));

			if($data['pass1']!=$data['pass2']) 
				JsonFeed::say("کلمه‌ی عبور و تکرار آن یکسان نیستند" , array("fields"=>"#txtPass1,#txtPass2"));
			if(strlen($data['pass1'])<5)
				JsonFeed::say("کلمه‌ی عبوری انتخاب کنید که لااقل پنج حرف داشته باشد" , array("fields"=>"#txtPass1,#txtPass2"));

			if($data['organ_all']+$data['organ_heart']+$data['organ_liver']+$data['organ_lung']+$data['organ_kidney']+$data['organ_panreas']+$data['organ_tissues'] <1)		
				JsonFeed::say("حداقل یکی از اعضا و بافت‌های نشان‌داده‌شده را جهت اهدا علامت بزنید");

			if(!is_numeric($data['nationalCode']) OR strlen($data['nationalCode'])!=10)
				JsonFeed::say("ساختار کد ملی درست نیست" , array("fields"=>"#txtMelli"));
			if(!$this->users_model->isUnique_nationalCode($data['nationalCode']))
				JsonFeed::say("برای این کد ملی، پیش‌تر نیز کارت اهدای عضو صادر شده است" , array("fields"=>"#txtMelli"));
				
			if(persianChar($data['userName']))
				JsonFeed::say("نام کاربری را با الفبای انگلیسی وارد کنید" , array("fields"=>"#txtUsername"));
			if(strpos($data['userName'], " ")>0)
				JsonFeed::say("نام کاربری را با الفبای انگلیسی وارد کنید. جای خالی هم ممنوع است" , array("fields"=>"#txtUsername"));
				
			if(strlen($data['userName'])<5)
				JsonFeed::say("نام کاربری را چنان انتخاب کنید که لااقل پنج حرف داشته باشد" , array("fields"=>"#txtUsername"));
			if(!$this->users_model->isUnique_un($data['userName']))
				JsonFeed::say("نام کاربری تکراری است" , array("fields"=>"#txtUsername"));
		}
		//double check...
		if(!$dobleChecked)
			JsonFeed::say(NULL , array("ok" => "1"));
			
		//save...
		$code	= $this->users_model->save($data);
		
		if(!$code)
        {
            JsonFeed::say("بروز خطا هنگام ذخیره‌سازی اطلاعات");
        }
		else
        {
            $user = $this->users_model->getOneUserByRand($code);
            if($user)
            {
                $session['user']['id'] = $user['id'];
                $session['user']['auth'] = hashStr($user['passWord']);
                $session['user']['role'] = 'USER';
                $this->session->set_userdata($session);
                JsonFeed::say($code , array("ok" => "2"));
            }
            else
            {
                JsonFeed::say("خطای سیستمی به وجود آمده است، دوباره تلاش کنید.");
            }
        }
    }
    
    //=========================================================================================
    // insert cart
    public function _cardRegister()
    {

        $txtName = $this->input->post('txtName', TRUE, TRUE);
        $txtFam = $this->input->post('txtFam', TRUE, TRUE);
        $cmbCardPos = $this->input->post('cmbCardPos', TRUE, TRUE);
        $txtFather = $this->input->post('txtFather', TRUE, TRUE);
        $cmbCardPos = $this->input->post('cmbCardPos', TRUE, TRUE);
        $txtShenas = $this->input->post('txtShenas', TRUE, TRUE);
        $txtMelli = $this->input->post('txtMelli', TRUE, TRUE);
        $txtExtraBirthday = $this->input->post('txtExtraBirthday', TRUE, TRUE);
        $txtBirthCity = $this->input->post('txtBirthCity', TRUE, TRUE);
        $txtEducation = $this->input->post('txtEducation', TRUE, TRUE);
        $txtJob = $this->input->post('txtJob', TRUE, TRUE);
        $txtMob = $this->input->post('txtMob', TRUE, TRUE);
        $txtTel = $this->input->post('txtTel', TRUE, TRUE);
        $txtState = $this->input->post('txtState', TRUE, TRUE);
        $txtCity = $this->input->post('txtCity', TRUE, TRUE);
        $txtEmail = $this->input->post('txtEmail', TRUE, TRUE);
        $txtUsername = $this->input->post('txtUsername', TRUE, TRUE);
        $txtPass1 = $this->input->post('txtPass1', TRUE, TRUE);
        $txtPass2 = $this->input->post('txtPass2', TRUE, TRUE);
        $chkAll = $this->input->post('chkAll', TRUE, TRUE);
        $chkHeart = $this->input->post('chkHeart', TRUE, TRUE);
        $chkLiver = $this->input->post('chkLiver', TRUE, TRUE);
        $chkLung = $this->input->post('chkLung', TRUE, TRUE);
        $chkKidney = $this->input->post('chkKidney', TRUE, TRUE);
        $chkPancreas = $this->input->post('chkPancreas', TRUE, TRUE);
        $chkTissues = $this->input->post('chkTissues', TRUE, TRUE);
        
        if(1 OR persianChar($txtName) AND strlen($txtName) > 1 AND persianChar($txtFam) AND strlen($txtFam) > 1 AND persianChar($txtFather) AND strlen($txtFather) > 1 AND is_numeric($txtShenas) AND strlen($txtShenas) > 0 AND is_numeric($txtMelli) AND strlen($txtMelli) == 10 AND strlen($txtExtraBirthday) > 4 AND persianChar($txtBirthCity) AND strlen($txtBirthCity) > 1 AND $txtEducation > 0 AND is_numeric($txtMob) AND strlen($txtMob) == 11 AND is_numeric($txtTel) AND strlen($txtTel) == 11 AND $txtState > 0 AND $txtCity > 0 AND !persianChar($txtUsername) AND strlen($txtUsername) > 2 AND strlen($txtPass1) > 5 AND $txtPass1 == $txtPass2 AND $cmbCardPos > 0 AND nationalCode($txtMelli))
        {
            $date = explode('/', $txtExtraBirthday);
            $date = mktime(0, 0, 0, $date[1], $date[2], $date[0]);
            $rand = randnum(100);
            $data = array(
                            'firstName' => $txtName,
                            'lastName' => $txtFam,
                            'firstFatherName' => $txtFather,
                            'sex' => $cmbCardPos,
                            'identifier' => $txtShenas,
                            'nationalCode' => $txtMelli,
                            'placeOfBirth' => $txtBirthCity,
                            'dateOfBirth' => $date,
                            'education' => $txtEducation,
                            'job' => $txtJob,
                            'homePhone' => $txtTel,
                            'mobile' => $txtMob,
                            'state' => $txtState,
                            'city' => $txtCity,
                            'email' => $txtEmail,
                            'userName' => $txtUsername,
                            'passWord' => md5(sha1($txtPass1)),
                            'organs' => 1,
                            'status' => 1,
                            'registerTime' => time(),
                            'updateStatus' => 0,
                            'res4' => $rand
                            );
            $this->db->insert('users', $data); 
            if($this->db->affected_rows() > 0)
            {
                $c = $this->db->select('id')->from('users')->where('res4', $rand)->get();
                if($c->num_rows() > 0)
                {
                    $c = $c->row_array();
                    //$cartID = $this->encrypt->encode($c['id']);
                    $cartID = $rand;
                    $result = 1;
                }
                else
                {
                    $result = 2;
                }
            }
            else
            {
                $result = 2;
                $cartID = FALSE;
            }
        }
        else
        {
            $result = 3;
            $cartID = FALSE;
        }
        
        $data = array('result' => $result, 'cartID' => $cartID);
        echo json_encode($data);
    }

    //=========================================================================================
    // user login
    public function userLogin()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            exit;
        }

        $this->load->helper('email');

        $username = $this->input->post('username', TRUE, TRUE);
        $password = $this->input->post('password', TRUE, TRUE);
        $qs = $this->input->post('qs', TRUE, TRUE);
        $qsk = $this->input->post('qsk', TRUE, TRUE);

        if(securityQuestion($qs, $qsk, FALSE, 'userLoginQs'))
        {
            if(strlen($username) > 4 AND strlen($password) > 4)
            {
                $query = $this->db->select(array(
                    'id',
                    'firstName',
                    'lastName',
                    'res4'
                ))->from('users');
                if(valid_email($username))
                {
                    $query->where(array(
                        'email' => $username,
                        'passWord' => hashStr($password),
                        'status' => 1
                    ));
                }
                else
                {
                    $query->where(array(
                        'userName' => $username,
                        'passWord' => hashStr($password),
                        'status' => 1
                    ));
                }

                $query = $query->get();
                if($query->num_rows() > 0)
                {
                    $data['user'] = $query->row_array();
                    $data['msg'] = 2; // user is true
                    $session['user']['id'] = $data['user']['id'];
                    $session['user']['auth'] = hashStr(hashStr($password));
                    $session['user']['role'] = 'USER';
                    $this->session->set_userdata($session);
                    $this->session->unset_userdata('userLoginQs');
                }
                else
                {
                    $data['msg'] = 3; // user not true
                }

            }
            else
            {
                $data['msg'] = 4; // all field not complete
            }
        }
        else
        {
            $data['msg'] = 1; // qs not equal
        }

        echo json_encode($data);
    }
}