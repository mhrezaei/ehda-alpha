<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Processing extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ajax/Processing_model');
    }

    public function index()
    {
        // index
        if (!$this->input->is_ajax_request()) {
            show_404();
            exit;
        }
    }

    public function newUserRegister()
    {
        if (!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }

        // give all data from post
        $firstName = htmlCoding($this->input->post('txtRegisterFirstName', TRUE, TRUE));
        $lastName = htmlCoding($this->input->post('txtRegisterLastName', TRUE, TRUE));
        $fatherName = htmlCoding($this->input->post('txtRegisterFatherName', TRUE, TRUE));
        $sex = htmlCoding($this->input->post('cbRegisterGender', TRUE, TRUE));
        $idNumber = htmlCoding($this->input->post('txtRegisterIDNumber', TRUE, TRUE));
        $nationalcode = htmlCoding($this->input->post('txtRegisterNationalCode', TRUE, TRUE));
        $birthDatePer = htmlCoding($this->input->post('cbRegisterBirthDate', TRUE, TRUE));
        $birthDate = htmlCoding($this->input->post('txtExtraBirthday', TRUE, TRUE));
        $place = htmlCoding($this->input->post('txtRegisterPlaceOfBirth', TRUE, TRUE));
        $education = htmlCoding($this->input->post('cbRegisterEducation', TRUE, TRUE));
        $job = htmlCoding($this->input->post('txtRegisterJob', TRUE, TRUE));
        $mobile = htmlCoding($this->input->post('txtRegisterMobile', TRUE, TRUE));
        $tel = htmlCoding($this->input->post('txtRegisterTel', TRUE, TRUE));
        $state = htmlCoding($this->input->post('cbRegisterState', TRUE, TRUE));
        $city = htmlCoding($this->input->post('cbRegisterCity', TRUE, TRUE));
        $email = htmlCoding($this->input->post('txtRegisterEmail', TRUE, TRUE));
        $username = htmlCoding($this->input->post('txtRegisterUsername', TRUE, TRUE));
        $password = htmlCoding($this->input->post('txtRegisterPassword', TRUE, TRUE));
        $verifyPassword = htmlCoding($this->input->post('txtRegisterVerifyPassword', TRUE, TRUE));
        $allOrgan = htmlCoding($this->input->post('chRegisterAll', TRUE, TRUE));
        $heart = htmlCoding($this->input->post('chRegisterHeart', TRUE, TRUE));
        $lung = htmlCoding($this->input->post('chRegisterLung', TRUE, TRUE));
        $liver = htmlCoding($this->input->post('chRegisterLiver', TRUE, TRUE));
        $kidney = htmlCoding($this->input->post('chRegisterKidney', TRUE, TRUE));
        $pancreas = htmlCoding($this->input->post('chRegisterPancreas', TRUE, TRUE));
        $tissues = htmlCoding($this->input->post('chRegisterTissues', TRUE, TRUE));
        $txtDbCheck = htmlCoding($this->input->post('txtDbCheck', TRUE, TRUE));
        $user = '';
        $user_data = '';

        // validation
        $err = 0;
        $msg = '';
        // first name
        if(strlen($firstName) < 2 || is_numeric($firstName) || !persianChar($firstName))
        {
            $msg[$err]['id'] = '#txtRegisterFirstName';
            $msg[$err]['msg'] = 'نام را به صورت صحیح وارد نمائید.';
            $err++;
        }
        else
        {
            $user_data['firstName'] = $firstName;
        }

        // last name
        if(strlen($lastName) < 2 || is_numeric($lastName) || !persianChar($lastName))
        {
            $msg[$err]['id'] = '#txtRegisterLastName';
            $msg[$err]['msg'] = 'نام خانوادگی را به صورت صحیح وارد نمائید.';
            $err++;
        }
        else
        {
            $user_data['lastName'] = $lastName;
        }

        // sex
        if($sex < 1 || $sex > 2)
        {
            $msg[$err]['id'] = '#cbRegisterGender';
            $msg[$err]['msg'] = 'جنسیت خود را انتخاب نمائید.';
            $err++;
        }
        else
        {
            $user_data['sex'] = $sex;
        }

        // first father name
        if(strlen($fatherName) < 2 || is_numeric($fatherName) || !persianChar($fatherName))
        {
            $msg[$err]['id'] = '#txtRegisterFatherName';
            $msg[$err]['msg'] = 'نام پدر را به صورت صحیح وارد نمائید.';
            $err++;
        }
        else
        {
            $user_data['fatherName'] = $fatherName;
        }

        // ID number
        if(strlen($idNumber) < 1 || !is_numeric($idNumber) || $idNumber < 1)
        {
            $msg[$err]['id'] = '#txtRegisterIDNumber';
            $msg[$err]['msg'] = 'شماره شناسنامه خود را به صورت صحیح وارد نمائید.';
            $err++;
        }
        else
        {
            $user_data['identifier'] = $idNumber;
        }

        // national code
        if(strlen($nationalcode) != 10 || !is_numeric($nationalcode) || !nationalCode($nationalcode))
        {
            $msg[$err]['id'] = '#txtRegisterNationalCode';
            $msg[$err]['msg'] = 'کدملی خود را به صورت صحیح وارد نمائید.';
            $err++;
        }
        else
        {
            $user['nationalcode'] = $nationalcode;
        }

        // national code duplicate
        if(strlen($nationalcode) == 10 AND nationalCode($nationalcode))
        {
            if($this->users_model->isUnique_nationalCode($nationalcode))
            {
                $msg[$err]['id'] = '#txtRegisterNationalCode';
                $msg[$err]['msg'] = 'ثبت نام برای این کدملی قبلاً صورت گرفته است.';
                $err++;
            }
        }

        // birth date
        $temp = explode('/', $birthDate);
        if(!is_array($temp) OR !isset($temp[1]) OR !isset($temp[2]) OR !isset($temp[0]))
        {
            $msg[$err]['id'] = '#txtRegisterNationalCode';
            $msg[$err]['msg'] = 'ساختار تاریخ تولد صحیح نمی باشد.';
            $err++;
        }
        else
        {
            $birthDate = mktime(0, 0, 0, $temp[1], $temp[2], $temp[0]);
            $maxDate	= time() ; //time() - 15 * 12 * 30 * 24 * 3600;
            if($birthDate > $maxDate)
            {
                $msg[$err]['id'] = '#txtRegisterNationalCode';
                $msg[$err]['msg'] = 'تاریخ تولد مورد قبول نمی باشد.';
                $err++;
            }
            else
            {
                $user_data['dateOfBirth'] = $birthDate;
            }
        }

        // place of birth
        if(strlen($place) < 2 || is_numeric($place) || !persianChar($place))
        {
            $msg[$err]['id'] = '#txtRegisterPlaceOfBirth';
            $msg[$err]['msg'] = 'محل تولد خود را به صورت صحیح وارد نمائید.';
            $err++;
        }
        else
        {
            $user_data['placeOfBirth'] = $place;
        }

        // education
        if($education > 6)
        {
            $msg[$err]['id'] = '#cbRegisterEducation';
            $msg[$err]['msg'] = 'تحصیلات خود را به درستی وارد نمایید.';
            $err++;
        }
        else{
            $user_data['education'] = $education;
        }

        // job
        if(strlen($job) > 0)
        {
            if(!persianChar($job))
            {
                $msg[$err]['id'] = '#txtRegisterJob';
                $msg[$err]['msg'] = 'شغل خود را با حروف فارسی وارد نمایید.';
                $err++;
            }
            else
            {
                $user_data['job'] = $job;
            }
        }

        // mobile
        if( ! checkPhoneNo($mobile, "mob"))
        {
            $msg[$err]['id'] = '#txtRegisterMobile';
            $msg[$err]['msg'] = 'شماره همراه خود را به صورت صحیح وارد نمائید.';
            $err++;
        }
        else
        {
            $user_data['mobile'] = $mobile;
        }

        // tel
        if( ! checkPhoneNo($tel))
        {
            $msg[$err]['id'] = '#txtRegisterTel';
            $msg[$err]['msg'] = 'شماره تلفن ثابت خود را به صورت صحیح وارد نمائید.';
            $err++;
        }
        else
        {
            $user_data['phone'] = $tel;
        }

        // state
        if($state < 1)
        {
            $msg[$err]['id'] = '#cbRegisterState';
            $msg[$err]['msg'] = 'استان خود را انتخاب نمائید.';
            $err++;
        }
        else
        {
            $user_data['state'] = $state;
        }

        // city
        if($city < 1)
        {
            $msg[$err]['id'] = '#cbRegisterCity';
            $msg[$err]['msg'] = 'شهر خود را انتخاب نمائید.';
            $err++;
        }
        else
        {
            $user_data['city'] = $city;
        }

        // email
        if(strlen($email) > 0)
        {
            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $msg[$err]['id'] = '#txtRegisterEmail';
                $msg[$err]['msg'] = 'ایمیل خود را به صورت صحیح وارد نمائید.';
                $err++;
            }
            else
            {
                $user['email'] = strtolower($email);
            }
        }

        // username
        if(!preg_match('/^[A-Za-z0-9_\-\.]{6,32}$/', $username))
        {
            $msg[$err]['id'] = '#txtRegisterUsername';
            $msg[$err]['msg'] = 'نام کاربری خود را به صورت صحیح وارد نمائید.';
            $err++;
        }
        else
        {
            if($this->users_model->isUnique_username($username))
            {
                $msg[$err]['id'] = '#txtRegisterUsername';
                $msg[$err]['msg'] = 'این نام کاربری توسط شخص دیگری استفاده شده است.';
                $err++;
            }
            else
            {
                $user['username'] = $username;
            }
        }

        // password
        if(!preg_match('/^[A-Za-z0-9!@#$%^&*()_\-\.]{6,32}$/', $password))
        {
            $msg[$err]['id'] = '#txtRegisterPassword';
            $msg[$err]['msg'] = 'رمز عبور را به صورت صحیح وارد نمائید.';
            $err++;
        }
        else
        {
            $user['password'] = hashStr($password);
        }

        // password verify
        if($password != $verifyPassword)
        {
            $msg[$err]['id'] = '#txtRegisterVerifyPassword';
            $msg[$err]['msg'] = 'رمز عبور با تکرار آن مطابقت ندارد.';
            $err++;
        }

        // organs
        $organ = '';
        $allOrgan ? $allOrgan = 1 : $allOrgan = 0;
        $heart ? $heart = 1 : $heart = 0;
        $lung ? $lung = 1 : $lung = 0;
        $kidney ? $kidney = 1 : $kidney = 0;
        $liver ? $liver = 1 : $liver = 0;
        $tissues ? $tissues = 1 : $tissues = 0;
        $pancreas ? $pancreas = 1 : $pancreas = 0;

        if($allOrgan < 1)
        {
            if($heart + $lung + $kidney + $liver + $tissues + $pancreas < 1)
            {
                $msg[$err]['id'] = '#organCheck';
                $msg[$err]['msg'] = 'حداقل یکی از ارگان ها را جهت اهدا انتخاب نمائید.';
                $err++;
                $organ = '';
            }
            else
            {
                $organs = '';
                $heart ? $organs[] = 'Heart' : $heart = 0;
                $lung ? $organs[] = 'Lung' : $lung = 0;
                $kidney ? $organs[] = 'Kidney' : $kidney = 0;
                $liver ? $organs[] = 'Liver' : $liver = 0;
                $tissues ? $organs[] = 'Tissues' : $tissues = 0;
                $pancreas ? $organs[] = 'Pancreas' : $pancreas = 0;
                for($i = 0; $i < count($organs); $i++)
                {
                    if($i == (count($organs) - 1))
                    {
                        $organ .= $organs[$i];
                    }
                    else
                    {
                        $organ .= $organs[$i] . ',';
                    }
                }
            }
        }
        else
        {
            $organ = 'All';
        }

        $user_data['organs'] = $organ;


        // parsing data
        if($err > 0)
        {
            $data['status'] = 0;
            $data['data'] = $msg;
        }
        else
        {
            if(strlen($txtDbCheck) == 32)
            {
                if(hashStr($nationalcode) != $txtDbCheck)
                {
                    $data['status'] = 3; // when user try to change data after validation
                }
                else
                {
                    $user_data['status'] = 1;
                    $user_data['registerTime'] = time();
                    $user['status'] = 1;
                    $user['hash'] = hashStr($nationalcode);
                    $user['memberID'] = $this->users_model->find_last_memberID();
                    if($user['memberID'])
                    {
                        $user['memberID']++;
                    }
                    else
                    {
                        $user['memberID'] = 1500;
                    }

                    // insert data to users table
                    if($this->users_model->registerNewUser($user))
                    {
                        $user = $this->users_model->isUnique_nationalCode($nationalcode);
                        if($user)
                        {
                            $user_data['userID'] = $user['id'];
                            if($this->users_model->registerNewUserData($user_data))
                            {
                                $data['status'] = 5; // insert data success
                                $data['key'] = hashStr($nationalcode);
                                $session['user']['id'] = $user['id'];
                                $session['user']['auth'] = hashStr(hashStr($password));
                                $session['user']['role'] = 'USER';
                                $this->session->set_userdata($session);
                            }
                            else
                            {
                                $data['status'] = 6; // insert data to users_data table not success
                            }
                        }
                        else
                        {
                            $data['status'] = 4; // after insert data to users table i can't find this record
                        }
                    }
                    else
                    {
                        $data['status'] = 7; // insert data to users table not success
                    }
                }
            }
            else
            {
                $data['status'] = 1;
                $data['key'] = hashStr($nationalcode);
            }
        }

        echo json_encode($data);



    }

    public function userLogin()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            exit;
        }

        $username = htmlCoding($this->input->post('username', TRUE, TRUE));
        $password = htmlCoding($this->input->post('password', TRUE, TRUE));
        $qs = htmlCoding($this->input->post('qs', TRUE, TRUE));
        $qsk = htmlCoding($this->input->post('qsk', TRUE, TRUE));

        if(securityQuestion($qs, $qsk, TRUE, 'userLoginQs'))
        {
            $user = $this->users_model->selectUserBy_national_or_username($username, hashStr($password));
            if($user)
            {
                $data['user'] = $user;
                $data['msg'] = 1; // user is true
                $session['user']['id'] = $user['id'];
                $session['user']['auth'] = hashStr(hashStr($password));
                $session['user']['role'] = 'USER';
                $this->session->set_userdata($session);
            }
            else
            {
                $data['msg'] = 2; // user not true
                $userLoginQs = securityQuestion('y', NULL, FALSE, 'userLoginQs');
                $data['qs'] = $userLoginQs['value'];
                $data['key'] = $userLoginQs['key'];
            }

        }
        else
        {
            $data['msg'] = 3; // security question not true
            $userLoginQs = securityQuestion('y', NULL, FALSE, 'userLoginQs');
            $data['qs'] = $userLoginQs['value'];
            $data['key'] = $userLoginQs['key'];
        }
        echo json_encode($data);
    }

    public function changeUserPassword()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            exit;
        }

        $oldPass = htmlCoding($this->input->post('oldPass', TRUE, TRUE));
        $newPass = htmlCoding($this->input->post('newPass', TRUE, TRUE));
        $newPassV = htmlCoding($this->input->post('newPassV', TRUE, TRUE));
        $data = '';
        $id = $this->users_model->is_user();
        if(!$id)
        {
            $data['msg'] = 1; // user not login
        }
        else
        {
            $user = $this->users_model->selectUserByID($id['id']);
            if(! $user || $user['status'] != 1)
            {
                $data['msg'] = 2; // user not found
            }
            else
            {
                if(hashStr($oldPass) != $user['password'])
                {
                    $data['msg'] = 3; // old password not true
                }
                else
                {
                    // password
                    if(!preg_match('/^[A-Za-z0-9!@#$%^&*()_\-\.]{6,32}$/', $newPass))
                    {
                        $data['msg'] = 4; // new password not accept
                    }
                    else
                    {
                        if($newPass != $newPassV)
                        {
                            $data['msg'] = 5; // new pass and new passV not equal
                        }
                        else
                        {
                            $newData = '';
                            $newData['password'] = hashStr($newPass);
                            $this->users_model->userUpdateField($id['id'], $newData);
                            $data['msg'] = 6; // update success
                        }
                    }
                }
            }
        }
        echo json_encode($data);
    }

    public function updateUserData()
    {
        if (!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }

        $id = $this->users_model->is_user();
        $updateStatus = '';
        if(!$id)
        {
            $updateStatus['msg'] = -1; // user not login
        }
        else
        {
            $id = $id['id'];
            // give all data from post
            $firstName = htmlCoding($this->input->post('txtRegisterFirstName', TRUE, TRUE));
            $lastName = htmlCoding($this->input->post('txtRegisterLastName', TRUE, TRUE));
            $fatherName = htmlCoding($this->input->post('txtRegisterFatherName', TRUE, TRUE));
            $sex = htmlCoding($this->input->post('cbRegisterGender', TRUE, TRUE));
            $idNumber = htmlCoding($this->input->post('txtRegisterIDNumber', TRUE, TRUE));
            $birthDatePer = htmlCoding($this->input->post('cbRegisterBirthDate', TRUE, TRUE));
            $birthDate = htmlCoding($this->input->post('txtExtraBirthday', TRUE, TRUE));
            $place = htmlCoding($this->input->post('txtRegisterPlaceOfBirth', TRUE, TRUE));
            $education = htmlCoding($this->input->post('cbRegisterEducation', TRUE, TRUE));
            $job = htmlCoding($this->input->post('txtRegisterJob', TRUE, TRUE));
            $mobile = htmlCoding($this->input->post('txtRegisterMobile', TRUE, TRUE));
            $tel = htmlCoding($this->input->post('txtRegisterTel', TRUE, TRUE));
            $state = htmlCoding($this->input->post('cbRegisterState', TRUE, TRUE));
            $city = htmlCoding($this->input->post('cbRegisterCity', TRUE, TRUE));
            $address = htmlCoding($this->input->post('txtEditAddress', TRUE, TRUE));
            $postal = htmlCoding($this->input->post('txtEditPostalCode', TRUE, TRUE));
            $email = htmlCoding($this->input->post('txtRegisterEmail', TRUE, TRUE));
            $allOrgan = htmlCoding($this->input->post('chRegisterAll', TRUE, TRUE));
            $heart = htmlCoding($this->input->post('chRegisterHeart', TRUE, TRUE));
            $lung = htmlCoding($this->input->post('chRegisterLung', TRUE, TRUE));
            $liver = htmlCoding($this->input->post('chRegisterLiver', TRUE, TRUE));
            $kidney = htmlCoding($this->input->post('chRegisterKidney', TRUE, TRUE));
            $pancreas = htmlCoding($this->input->post('chRegisterPancreas', TRUE, TRUE));
            $tissues = htmlCoding($this->input->post('chRegisterTissues', TRUE, TRUE));
            $txtDbCheck = htmlCoding($this->input->post('txtDbCheck', TRUE, TRUE));
            $user = '';
            $user_data = '';

            // validation
            $err = 0;
            $msg = '';
            // first name
            if(strlen($firstName) < 2 || is_numeric($firstName) || !persianChar($firstName))
            {
                $err++;
            }
            else
            {
                $user_data['firstName'] = $firstName;
            }

            // last name
            if(strlen($lastName) < 2 || is_numeric($lastName) || !persianChar($lastName))
            {
                $err++;
            }
            else
            {
                $user_data['lastName'] = $lastName;
            }

            // sex
            if($sex < 1 || $sex > 2)
            {
                $err++;
            }
            else
            {
                $user_data['sex'] = $sex;
            }

            // first father name
            if(strlen($fatherName) < 2 || is_numeric($fatherName) || !persianChar($fatherName))
            {
                $err++;
            }
            else
            {
                $user_data['fatherName'] = $fatherName;
            }

            // ID number
            if(strlen($idNumber) < 1 || !is_numeric($idNumber) || $idNumber < 1)
            {
                $err++;
            }
            else
            {
                $user_data['identifier'] = $idNumber;
            }

            // birth date
            $temp = explode('/', $birthDate);
            if(!is_array($temp) OR !isset($temp[1]) OR !isset($temp[2]) OR !isset($temp[0]))
            {
                $err++;
            }
            else
            {
                $birthDate = mktime(0, 0, 0, $temp[1], $temp[2], $temp[0]);
                $maxDate	= time() ; //time() - 15 * 12 * 30 * 24 * 3600;
                if($birthDate > $maxDate)
                {
                    $err++;
                }
                else
                {
                    $user_data['dateOfBirth'] = $birthDate;
                }
            }

            // place of birth
            if(strlen($place) < 2 || is_numeric($place) || !persianChar($place))
            {
                $err++;
            }
            else
            {
                $user_data['placeOfBirth'] = $place;
            }

            // education
            if($education > 6)
            {
                $err++;
            }
            else{
                $user_data['education'] = $education;
            }

            // job
            if(strlen($job) > 0)
            {
                if(!persianChar($job))
                {
                    $err++;
                }
                else
                {
                    $user_data['job'] = $job;
                }
            }

            // mobile
            if( ! checkPhoneNo($mobile, "mob"))
            {
                $err++;
            }
            else
            {
                $user_data['mobile'] = $mobile;
            }

            // tel
            if( ! checkPhoneNo($tel))
            {
                $err++;
            }
            else
            {
                $user_data['phone'] = $tel;
            }

            // state
            if($state < 1)
            {
                $err++;
            }
            else
            {
                $user_data['state'] = $state;
            }

            // city
            if($city < 1)
            {
                $err++;
            }
            else
            {
                $user_data['city'] = $city;
            }

            // address
            if(strlen($address) > 0)
            {
                if(! persianChar($address))
                {
                    $err++;
                }
                else
                {
                    $user_data['address'] = $address;
                }
            }

            // postalCode
            if(strlen($postal) > 0)
            {
                if(strlen($postal) != 10 || !is_numeric($postal))
                {
                    $err++;
                }
                else
                {
                    $user_data['postalCode'] = $postal;
                }
            }

            // email
            if(strlen($email) > 0)
            {
                if(!filter_var($email, FILTER_VALIDATE_EMAIL))
                {
                    $msg[$err]['id'] = '#txtRegisterEmail';
                    $msg[$err]['msg'] = 'ایمیل خود را به صورت صحیح وارد نمائید.';
                    $err++;
                }
                else
                {
                    $user['email'] = strtolower($email);
                }
            }

            // organs
            $organ = '';
            $allOrgan ? $allOrgan = 1 : $allOrgan = 0;
            $heart ? $heart = 1 : $heart = 0;
            $lung ? $lung = 1 : $lung = 0;
            $kidney ? $kidney = 1 : $kidney = 0;
            $liver ? $liver = 1 : $liver = 0;
            $tissues ? $tissues = 1 : $tissues = 0;
            $pancreas ? $pancreas = 1 : $pancreas = 0;

            if($allOrgan < 1)
            {
                if($heart + $lung + $kidney + $liver + $tissues + $pancreas < 1)
                {
                    $err++;
                    $organ = '';
                }
                else
                {
                    $organs = '';
                    $heart ? $organs[] = 'Heart' : $heart = 0;
                    $lung ? $organs[] = 'Lung' : $lung = 0;
                    $kidney ? $organs[] = 'Kidney' : $kidney = 0;
                    $liver ? $organs[] = 'Liver' : $liver = 0;
                    $tissues ? $organs[] = 'Tissues' : $tissues = 0;
                    $pancreas ? $organs[] = 'Pancreas' : $pancreas = 0;
                    for($i = 0; $i < count($organs); $i++)
                    {
                        if($i == (count($organs) - 1))
                        {
                            $organ .= $organs[$i];
                        }
                        else
                        {
                            $organ .= $organs[$i] . ',';
                        }
                    }
                }
            }
            else
            {
                $organ = 'All';
            }

            $user_data['organs'] = $organ;


            // parsing data
            if($err > 0)
            {
                $updateStatus['msg'] = 1;
            }
            else
            {
//                showArray($user);
//                showArray($user_data);
                if (is_array($user))
                {
                    $this->users_model->userUpdateField($id, $user);
                }

                if (is_array($user_data))
                {
                    $this->users_model->userDataUpdateField($id, $user_data);
                }
                $updateStatus['msg'] = 2;
            }
        }

        echo json_encode($updateStatus);



    }

    public function forgotPassword()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            exit;
        }

        $nationalcode = htmlCoding($this->input->post('nationalcode', TRUE, TRUE));
        $username = htmlCoding($this->input->post('username', TRUE, TRUE));
        $email = htmlCoding($this->input->post('email', TRUE, TRUE));
        $qs = htmlCoding($this->input->post('qs', TRUE, TRUE));
        $qsk = htmlCoding($this->input->post('qsk', TRUE, TRUE));
        $data = '';

        if(securityQuestion($qs, $qsk, TRUE, 'forgotPassQs'))
        {
            $user = $this->users_model->isUnique_nationalCode($nationalcode);
            if($user)
            {
                if($user['username'] == $username || $user['email'] == $email)
                {
                    if(!filter_var($user['email'], FILTER_VALIDATE_EMAIL))
                    {
                        $data['msg'] = 4; // email not true or not entered
                        $userLoginQs = securityQuestion('y', NULL, FALSE, 'forgotPassQs');
                        $data['qs'] = $userLoginQs['value'];
                        $data['key'] = $userLoginQs['key'];
                    }
                    else
                    {
                        // delete old auth
                        $this->users_model->deleteForgotPasswordByUser($user['id']);

                        // forgot auth insert to db
                        $forgot['auth'] = randnum(32) . '-' . randnum(15) . '-' . randnum(15);
                        $forgot['status'] = 1;
                        $forgot['time'] = time();
                        $forgot['userID'] = $user['id'];
                        $this->users_model->insertNewForgotPassword($forgot);

                        // email send
                        $this->load->library('email');
                        $config['protocol']    = 'smtp';
                        $config['smtp_host']    = 'smtp.ehda.center';
                        $config['smtp_port']    = '587';
                        $config['smtp_timeout'] = '7';
                        $config['smtp_user']    = 'card@ehda.center';
                        $config['smtp_pass']    = 'mhr@0012071112030';
                        $config['charset']    = 'utf-8';
                        $config['newline']    = "\r\n";
                        $config['mailtype'] = 'html'; // or text
                        $config['validation'] = TRUE; // bool whether to validate email or not

                        $this->email->initialize($config);

                        $this->email->from('card@ehda.center', 'Ehda.Center');
                        $this->email->to($user['email']);

                        $this->email->subject('password recovery');
                        $mail = $this->load->view('email_template/email', $forgot, TRUE);
                        $this->email->message($mail);

                        $this->email->send();

                        $data['msg'] = 5; // forgot password link send to email
                        $userLoginQs = securityQuestion('y', NULL, FALSE, 'forgotPassQs');
                        $data['qs'] = $userLoginQs['value'];
                        $data['key'] = $userLoginQs['key'];
                    }
                }
                else
                {
                    $data['msg'] = 3; // username or email not equal
                    $userLoginQs = securityQuestion('y', NULL, FALSE, 'forgotPassQs');
                    $data['qs'] = $userLoginQs['value'];
                    $data['key'] = $userLoginQs['key'];
                }
            }
            else
            {
                $data['msg'] = 2; // user not found
                $userLoginQs = securityQuestion('y', NULL, FALSE, 'forgotPassQs');
                $data['qs'] = $userLoginQs['value'];
                $data['key'] = $userLoginQs['key'];
            }
        }
        else
        {
            $userLoginQs = securityQuestion('y', NULL, FALSE, 'forgotPassQs');
            $data['qs'] = $userLoginQs['value'];
            $data['key'] = $userLoginQs['key'];
            $data['msg'] = 1; // qs not true
        }

        echo json_encode($data);
    }

    public function changePassByForgot()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            exit;
        }

        $pass = htmlCoding($this->input->post('pass', TRUE, TRUE));
        $passV = htmlCoding($this->input->post('passV', TRUE, TRUE));
        $qs = htmlCoding($this->input->post('qs', TRUE, TRUE));
        $qsk = htmlCoding($this->input->post('qsk', TRUE, TRUE));
        $auth = htmlCoding($this->input->post('auth', TRUE, TRUE));
        $data = '';

        if(securityQuestion($qs, $qsk, TRUE, 'fPassQs'))
        {
            $key = $this->users_model->findForgotRequest($auth);
            if($key AND $key['time'] + (60 * 60) > time())
            {
                $user = $this->users_model->selectUserByID($key['userID']);
                if($user AND $user['status'] == 1)
                {
                    if(preg_match('/^[A-Za-z0-9!@#$%^&*()_\-\.]{6,32}$/', $pass) AND $pass == $passV)
                    {
                        $userData['password'] = hashStr($passV);
                        $this->users_model->userUpdateField($user['id'], $userData);
                        $this->users_model->deleteForgotPasswordByUser($key['userID']);
                        $data['msg'] = 5; // update success
                        $userQs = securityQuestion('y', NULL, FALSE, 'fPassQs');
                        $data['qs'] = $userQs['value'];
                        $data['key'] = $userQs['key'];
                    }
                    else
                    {
                        $data['msg'] = 4; // password not valid
                        $userQs = securityQuestion('y', NULL, FALSE, 'fPassQs');
                        $data['qs'] = $userQs['value'];
                        $data['key'] = $userQs['key'];
                    }
                }
                else
                {
                    $data['msg'] = 3; // user not found
                    $this->users_model->deleteForgotPasswordByUser($key['userID']);
                    $userQs = securityQuestion('y', NULL, FALSE, 'fPassQs');
                    $data['qs'] = $userQs['value'];
                    $data['key'] = $userQs['key'];
                }
            }
            else
            {
                if($key)
                {
                    $this->users_model->deleteForgotPasswordByUser($key['userID']);
                }
                $data['msg'] = 2; // auth not found
                $userQs = securityQuestion('y', NULL, FALSE, 'fPassQs');
                $data['qs'] = $userQs['value'];
                $data['key'] = $userQs['key'];
            }
        }
        else
        {
            $data['msg'] = 1; // qs not true
            $userQs = securityQuestion('y', NULL, FALSE, 'fPassQs');
            $data['qs'] = $userQs['value'];
            $data['key'] = $userQs['key'];
        }

        echo json_encode($data);
    }

    public function safiranNewExam()
    {
        if (!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }

        $national = htmlCoding($this->input->post('txtRegisterNationalCode', TRUE, TRUE));
        $name = htmlCoding($this->input->post('txtRegisterFirstName', TRUE, TRUE));
        $family = htmlCoding($this->input->post('txtRegisterLastName', TRUE, TRUE));
        $email = htmlCoding($this->input->post('txtRegisterEmail', TRUE, TRUE));
        $msg = '';

        $safir = $this->db->select()->from('safiran_data')->where(array(
            'status < ' => 12,
            'nationalcode' => $national
        ))->get();
        if($safir->num_rows())
        {
            $safir = $safir->row_array();
            if($safir['status'] > 1)
            {
                $msg['status'] = 2; // safir can't use exam he now is a valid safir
            }
            else
            {
                if($safir['lastExamTime'] + 80000 < time())
                {
                    $msg['status'] = 3; // safir found and can use exam
                    $msg['safirId'] = $this->encrypt->encode($safir['id']);
                    $msg['safirNational'] = $this->encrypt->encode($safir['nationalcode']);
                }
                else
                {
                    $msg['status'] = 4; // safir found and can't use exam
                    $msg['safirId'] = $this->encrypt->encode($safir['id']);
                }
            }
        }
        else
        {
            if(nationalCode($national) AND strlen($name) > 2 AND persianChar($name) AND strlen($family) > 2 AND persianChar($family) AND filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $msg['status'] = 1; // safir not found he can use exam
                $data = array(
                    'firstName' => $name,
                    'lastName' => $family,
                    'nationalcode' => $national,
                    'email' => $email,
                    'registerTime' => time(),
                    'lastExamTime' => time(),
                    'status' => 1
                );
                $this->db->insert('safiran_data', $data);

                $safir = $this->db->select()->from('safiran_data')->where(array(
                    'status < ' => 12,
                    'nationalcode' => $national
                ))->get();
                if($safir->num_rows())
                {
                    $safir = $safir->row_array();
                    $msg['safirId'] = $this->encrypt->encode($safir['id']);
                    $msg['safirNational'] = $this->encrypt->encode($safir['nationalcode']);
                }
            }
            else
            {
                $msg['status'] = 5; // post data not valid
            }
        }

        echo json_encode($msg);
    }

    public function safiranSubmitExam()
    {
        if (!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }

        $userId = $this->encrypt->decode($this->input->post('txtUserId', TRUE, TRUE));
        $userNational = $this->encrypt->decode($this->input->post('txtUserNational', TRUE, TRUE));
        $allAnswer = $this->encrypt->decode($this->input->post('txtQuestions', TRUE, TRUE));
        $msg = '';
        $allAnswer = explode(',', $allAnswer);
        $data['grading']['trueAnswer'] = 0;
        $data['grading']['falseAnswer'] = 0;
        $data['grading']['total'] = count($allAnswer);
        $data['grading']['examResult'] = '';
        $safir = $this->db->select()->from('safiran_data')->where(array(
            'status < ' => 12,
            'nationalcode' => $userNational,
            'id' => $userId
        ))->get();
        if($safir->num_rows())
        {
            $safir = $safir->row_array();
            for($i = 0; $i < $data['grading']['total']; $i++)
            {
                $answer = $this->input->post('answer' . $allAnswer[$i], TRUE, TRUE);
                $answerk = $this->encrypt->decode($this->input->post('answerK' . $allAnswer[$i], TRUE, TRUE));
                if($answer)
                {
                    $data['grading']['examResult'][$allAnswer[$i]] = $answer;
                    if($answer == $answerk)
                    {
                        $data['grading']['trueAnswer']++;
                    }
                    else
                    {
                        $data['grading']['falseAnswer']++;
                    }
                }

            }

            if($data['grading']['trueAnswer'] > 15)
            {
                $data['grading']['status'] = 'success';
                $msg['examScore'] = 'success';
            }
            else
            {
                $data['grading']['status'] = 'notSuccess';
                $msg['examScore'] = 'notSuccess';
            }

            $update = array(
                'lastExamTime' => time(),
                'examResult' => json_encode($data['grading'])
            );
            $this->db->where('id', $safir['id']);
            $this->db->update('safiran_data', $update);

            $msg['status'] = 2; // exam finished
            $msg['score'] = ceil(($data['grading']['trueAnswer'] * 100) / $data['grading']['total']);

        }
        else
        {
            $msg['status'] = 1; // safir not foud!!!
        }

        echo json_encode($msg);

    }

    public function safiranExtraData()
    {
        if (!$this->input->is_ajax_request())
        {
            show_404();
            exit;
        }
        $cbRegisterGender = htmlCoding($this->input->post('cbRegisterGender', TRUE, TRUE));
        $cbRegisterBirthDate = htmlCoding($this->input->post('cbRegisterBirthDate', TRUE, TRUE));
        $txtExtraBirthday = htmlCoding($this->input->post('txtExtraBirthday', TRUE, TRUE));
        $cbRegisterMaried = htmlCoding($this->input->post('cbRegisterMaried', TRUE, TRUE));
        $txtEducation = htmlCoding($this->input->post('txtEducation', TRUE, TRUE));
        $txtEducationCity = htmlCoding($this->input->post('txtEducationCity', TRUE, TRUE));
        $txtNumberOfMonth = htmlCoding($this->input->post('txtNumberOfMonth', TRUE, TRUE));
        $txtJob = htmlCoding($this->input->post('txtJob', TRUE, TRUE));
        $txtHomeAddress = htmlCoding($this->input->post('txtHomeAddress', TRUE, TRUE));
        $txtJobAddress = htmlCoding($this->input->post('txtJobAddress', TRUE, TRUE));
        $txtMobile = htmlCoding($this->input->post('txtMobile', TRUE, TRUE));
        $txtHomeTel = htmlCoding($this->input->post('txtHomeTel', TRUE, TRUE));
        $txtJobTel = htmlCoding($this->input->post('txtJobTel', TRUE, TRUE));
        $txtEmergencyTel = htmlCoding($this->input->post('txtEmergencyTel', TRUE, TRUE));
        $activity = $this->input->post('activity', TRUE, TRUE);
        $txtOtherDetail = htmlCoding($this->input->post('txtOtherDetail', TRUE, TRUE));
        $cbIntroduction = htmlCoding($this->input->post('cbIntroduction', TRUE, TRUE));
        $txtFarakhan = htmlCoding($this->input->post('txtFarakhan', TRUE, TRUE));
        $txtMotivation = htmlCoding($this->input->post('txtMotivation', TRUE, TRUE));
        $txtUserData = $this->encrypt->decode($this->input->post('txtUserData', TRUE, TRUE));
        $txtUserNationalCode = $this->encrypt->decode($this->input->post('txtUserNationalCode', TRUE, TRUE));

        $temp = explode('/', $txtExtraBirthday);
        $birthDate = mktime(0, 0, 0, $temp[1], $temp[2], $temp[0]);

        if(is_array($activity))
        {
            $activity = json_encode($activity);
        }
        else
        {
            $activity = '';
        }

        $role = array('safir');
        $role = $this->encrypt->encode(json_encode($role));

        $update = array(
            'sex' => $cbRegisterGender,
            'dateOfBirth' => $birthDate,
            'maried' => $cbRegisterMaried,
            'education' => $txtEducation,
            'educationCity' => $txtEducationCity,
            'numberOfMonth' => $txtNumberOfMonth,
            'homeAddress' => $txtHomeAddress,
            'jobAddress' => $txtJobAddress,
            'job' => $txtJob,
            'homeTel' => $txtHomeTel,
            'jobTel' => $txtJobTel,
            'mobile' => $txtMobile,
            'emergencyTel' => $txtEmergencyTel,
            'introduction' => $cbIntroduction,
            'activityDetail' => $txtOtherDetail,
            'notice' => $txtFarakhan,
            'motivation' => $txtMotivation,
            'registerTime' => time(),
            'status' => 2,
            'activity' => $activity,
            'password' => hashStr($txtMobile),
            'roles' => $role

        );
        $this->db->where('id', $txtUserData);
        $this->db->update('safiran_data', $update);

        $msg['status'] = 1;
        echo json_encode($msg);

//        showArray($this->input->post());
    }

    public function safirNewRegister()
    {
        $password = '1346798520';
        if (!$this->input->is_ajax_request() || !$this->users_model->is_safir($password))
        {
            show_404();
            exit;
        }

        // give all data from post
        $firstName = htmlCoding($this->input->post('txtRegisterFirstName', TRUE, TRUE));
        $lastName = htmlCoding($this->input->post('txtRegisterLastName', TRUE, TRUE));
        $fatherName = htmlCoding($this->input->post('txtRegisterFatherName', TRUE, TRUE));
        $sex = htmlCoding($this->input->post('cbRegisterGender', TRUE, TRUE));
        $idNumber = htmlCoding($this->input->post('txtRegisterIDNumber', TRUE, TRUE));
        $nationalcode = htmlCoding($this->input->post('txtRegisterNationalCode', TRUE, TRUE));
        $birthDatePer = htmlCoding($this->input->post('cbRegisterBirthDate', TRUE, TRUE));
        $birthDate = htmlCoding($this->input->post('txtExtraBirthday', TRUE, TRUE));
        $place = htmlCoding($this->input->post('txtRegisterPlaceOfBirth', TRUE, TRUE));
        $mobile = htmlCoding($this->input->post('txtRegisterMobile', TRUE, TRUE));
        $tel = htmlCoding($this->input->post('txtRegisterTel', TRUE, TRUE));
        $state = htmlCoding($this->input->post('cbRegisterState', TRUE, TRUE));
        $city = htmlCoding($this->input->post('cbRegisterCity', TRUE, TRUE));
        $allOrgan = htmlCoding($this->input->post('chRegisterAll', TRUE, TRUE));
        $heart = htmlCoding($this->input->post('chRegisterHeart', TRUE, TRUE));
        $lung = htmlCoding($this->input->post('chRegisterLung', TRUE, TRUE));
        $liver = htmlCoding($this->input->post('chRegisterLiver', TRUE, TRUE));
        $kidney = htmlCoding($this->input->post('chRegisterKidney', TRUE, TRUE));
        $pancreas = htmlCoding($this->input->post('chRegisterPancreas', TRUE, TRUE));
        $tissues = htmlCoding($this->input->post('chRegisterTissues', TRUE, TRUE));
        $user = '';
        $user_data = '';
        $err = 0;
        $msg = '';

        if(!$this->users_model->isUnique_nationalCode($nationalcode))
        {
            // validation
            // first name
            if(strlen($firstName) < 2 || is_numeric($firstName) || !persianChar($firstName))
            {
                $msg[$err]['id'] = '#txtRegisterFirstName';
                $msg[$err]['msg'] = 'نام را به صورت صحیح وارد نمائید.';
                $err++;
            }
            else
            {
                $user_data['firstName'] = $firstName;
            }

            // last name
            if(strlen($lastName) < 2 || is_numeric($lastName) || !persianChar($lastName))
            {
                $msg[$err]['id'] = '#txtRegisterLastName';
                $msg[$err]['msg'] = 'نام خانوادگی را به صورت صحیح وارد نمائید.';
                $err++;
            }
            else
            {
                $user_data['lastName'] = $lastName;
            }

            // sex
            if($sex < 1 || $sex > 2)
            {
                $msg[$err]['id'] = '#cbRegisterGender';
                $msg[$err]['msg'] = 'جنسیت  را انتخاب نمائید.';
                $err++;
            }
            else
            {
                $user_data['sex'] = $sex;
            }

            // first father name
            if(strlen($fatherName) < 2 || is_numeric($fatherName) || !persianChar($fatherName))
            {
                $msg[$err]['id'] = '#txtRegisterFatherName';
                $msg[$err]['msg'] = 'نام پدر را به صورت صحیح وارد نمائید.';
                $err++;
            }
            else
            {
                $user_data['fatherName'] = $fatherName;
            }

            // ID number
            if(strlen($idNumber) < 1 || !is_numeric($idNumber) || $idNumber < 1)
            {
                $msg[$err]['id'] = '#txtRegisterIDNumber';
                $msg[$err]['msg'] = 'شماره شناسنامه  را به صورت صحیح وارد نمائید.';
                $err++;
            }
            else
            {
                $user_data['identifier'] = $idNumber;
            }

            // national code
            if(strlen($nationalcode) != 10 || !is_numeric($nationalcode) || !nationalCode($nationalcode))
            {
                $msg[$err]['id'] = '#txtRegisterNationalCode';
                $msg[$err]['msg'] = 'کدملی  را به صورت صحیح وارد نمائید.';
                $err++;
            }
            else
            {
                $user['nationalcode'] = $nationalcode;
            }

            // birth date
            $temp = explode('/', $birthDate);
            if(!is_array($temp) OR !isset($temp[1]) OR !isset($temp[2]) OR !isset($temp[0]))
            {
                $msg[$err]['id'] = '#txtRegisterNationalCode';
                $msg[$err]['msg'] = 'ساختار تاریخ تولد صحیح نمی باشد.';
                $err++;
            }
            else
            {
                $birthDate = mktime(0, 0, 0, $temp[1], $temp[2], $temp[0]);
                $maxDate	= time() ; //time() - 15 * 12 * 30 * 24 * 3600;
                if($birthDate > $maxDate)
                {
                    $msg[$err]['id'] = '#txtRegisterNationalCode';
                    $msg[$err]['msg'] = 'تاریخ تولد مورد قبول نمی باشد.';
                    $err++;
                }
                else
                {
                    $user_data['dateOfBirth'] = $birthDate;
                }
            }

            // place of birth
            if(strlen($place) < 2 || is_numeric($place) || !persianChar($place))
            {
                $msg[$err]['id'] = '#txtRegisterPlaceOfBirth';
                $msg[$err]['msg'] = 'محل تولد  را به صورت صحیح وارد نمائید.';
                $err++;
            }
            else
            {
                $user_data['placeOfBirth'] = $place;
            }

            // mobile
            if( ! checkPhoneNo($mobile, "mob"))
            {
                $msg[$err]['id'] = '#txtRegisterMobile';
                $msg[$err]['msg'] = 'شماره همراه  را به صورت صحیح وارد نمائید.';
                $err++;
            }
            else
            {
                $user_data['mobile'] = $mobile;
            }

            // tel
            if( ! checkPhoneNo($tel))
            {
                $msg[$err]['id'] = '#txtRegisterTel';
                $msg[$err]['msg'] = 'شماره تلفن ثابت  را به صورت صحیح وارد نمائید.';
                $err++;
            }
            else
            {
                $user_data['phone'] = $tel;
            }

            // state
            if($state < 1)
            {
                $msg[$err]['id'] = '#cbRegisterState';
                $msg[$err]['msg'] = 'استان  را انتخاب نمائید.';
                $err++;
            }
            else
            {
                $user_data['state'] = $state;
            }

            // city
            if($city < 1)
            {
                $msg[$err]['id'] = '#cbRegisterCity';
                $msg[$err]['msg'] = 'شهر  را انتخاب نمائید.';
                $err++;
            }
            else
            {
                $user_data['city'] = $city;
            }

            // organs
            $organ = '';
            $allOrgan ? $allOrgan = 1 : $allOrgan = 0;
            $heart ? $heart = 1 : $heart = 0;
            $lung ? $lung = 1 : $lung = 0;
            $kidney ? $kidney = 1 : $kidney = 0;
            $liver ? $liver = 1 : $liver = 0;
            $tissues ? $tissues = 1 : $tissues = 0;
            $pancreas ? $pancreas = 1 : $pancreas = 0;

            if($allOrgan < 1)
            {
                if($heart + $lung + $kidney + $liver + $tissues + $pancreas < 1)
                {
                    $msg[$err]['id'] = '#organCheck';
                    $msg[$err]['msg'] = 'حداقل یکی از ارگان ها را جهت اهدا انتخاب نمائید.';
                    $err++;
                    $organ = '';
                }
                else
                {
                    $organs = '';
                    $heart ? $organs[] = 'Heart' : $heart = 0;
                    $lung ? $organs[] = 'Lung' : $lung = 0;
                    $kidney ? $organs[] = 'Kidney' : $kidney = 0;
                    $liver ? $organs[] = 'Liver' : $liver = 0;
                    $tissues ? $organs[] = 'Tissues' : $tissues = 0;
                    $pancreas ? $organs[] = 'Pancreas' : $pancreas = 0;
                    for($i = 0; $i < count($organs); $i++)
                    {
                        if($i == (count($organs) - 1))
                        {
                            $organ .= $organs[$i];
                        }
                        else
                        {
                            $organ .= $organs[$i] . ',';
                        }
                    }
                }
            }
            else
            {
                $organ = 'All';
            }

            $user_data['organs'] = $organ;
            $user['username'] = $nationalcode;
            $user['password'] = hashStr($mobile);
        }
        else
        {
            $data['status'] = -1; // national code already used
            $err++;
        }


        // parsing data
        if($err > 0)
        {
            if(isset($data['status']) AND $data['status'] == -1)
            {
                $data['status'] = -1;
                $data['data'] = $msg;
            }
            else
            {
                $data['status'] = 0;
                $data['data'] = $msg;
            }
        }
        else
        {
            $user_data['status'] = 1;
            $user_data['registerTime'] = time();
            $user['status'] = 1;
            $user['res2'] = 1; // go to print list
            $user['hash'] = hashStr($nationalcode);
            $user['memberID'] = $this->users_model->find_last_memberID();
            if($user['memberID'])
            {
                $user['memberID']++;
            }
            else
            {
                $user['memberID'] = 1500;
            }

            // insert data to users table
            if($this->users_model->registerNewUser($user))
            {
                $user = $this->users_model->isUnique_nationalCode($nationalcode);
                if($user)
                {
                    $user_data['userID'] = $user['id'];
                    if($this->users_model->registerNewUserData($user_data))
                    {
                        $data['status'] = 1; // insert data success
                    }
                    else
                    {
                        $data['status'] = 2; // insert data to users_data table not success
                    }
                }
                else
                {
                    $data['status'] = 3; // after insert data to users table i can't find this record
                }
            }
            else
            {
                $data['status'] = 4; // insert data to users table not success
            }
        }

        echo json_encode($data);



    }

    public function safirPrintAgainUser()
    {
        $password = '1346798520';
        if (!$this->input->is_ajax_request() || !$this->users_model->is_safir($password))
        {
            show_404();
            exit;
        }

        // give all data from post
        $national = htmlCoding($this->input->post('national', TRUE, TRUE));

        $user = $this->users_model->isUnique_nationalCode($national);
        if($user)
        {
            $newData['res2'] = 1;
            $this->users_model->userUpdateField($user['id'], $newData);
            $data['status'] = 1; // status success change
        }
        else
        {
            $data['status'] = -1; // user not found
        }

        echo json_encode($data);

    }

    public function submitEmployment()
    {
        if (!$this->input->is_ajax_request()) {
            show_404();
            exit;
        }

        $name = $this->input->post('txtRegisterName', TRUE, TRUE);
        $age = $this->input->post('txtRegisterAge', TRUE, TRUE);
        $mar = $this->input->post('cbRegisterMar', TRUE, TRUE);
        $edu = $this->input->post('txtRegisterEdu', TRUE, TRUE);
        $eduT = $this->input->post('txtRegisterEduType', TRUE, TRUE);
        $nJob = $this->input->post('txtRegisterNJob', TRUE, TRUE);
        $mob = $this->input->post('txtRegisterMobile', TRUE, TRUE);
        $tel = $this->input->post('txtRegisterTel', TRUE, TRUE);
        $address = $this->input->post('txtRegisterAddress', TRUE, TRUE);
        $aJob = $this->input->post('txtRegisterAddressJob', TRUE, TRUE);
        $tJob = $this->input->post('txtRegisterTelJob', TRUE, TRUE);
        $email = $this->input->post('txtRegisterEmail', TRUE, TRUE);
        $oJob = $this->input->post('txtRegisterOldJobs', TRUE, TRUE);
        $doc = $this->input->post('txtRegisterDoc', TRUE, TRUE);
        $rel = $this->input->post('txtRegisterRel', TRUE, TRUE);
        $pr = $this->input->post('txtRegisterPr', TRUE, TRUE);

        if(strlen($name) > 0 AND strlen($age) > 0 AND $mar > 0 AND strlen($edu) > 0 AND strlen($eduT) > 0 AND
        strlen($nJob) > 0 AND strlen($mob) == 11 AND is_numeric($mob) AND strlen($tel) == 11 AND is_numeric($tel) AND
        strlen($address) > 0 AND strlen($email) > 0 AND strlen($oJob) > 0 AND strlen($rel) > 0 AND strlen($pr) > 0)
        {
            $data = array(
                'name' => htmlCoding($name),
                'age' => htmlCoding($age),
                'mar' => htmlCoding($mar),
                'edu' => $edu,
                'eduType' => $eduT,
                'nJob' => $nJob,
                'mobile' => $mob,
                'tel' => $tel,
                'address' => $address,
                'aJob' =>$aJob,
                'tJob' =>$tJob,
                'email' => $email,
                'oJob' => $oJob,
                'doc' => $doc,
                'rel' => $rel,
                'pr' => $pr,
                'status' => 1
            );
            $this->db->insert('employment', $data);
            $result['done'] = 1;
        }
        else
        {
            $result['done'] = 2;
        }

        echo json_encode($result);
    }
}