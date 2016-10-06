<?php
class Ajax_model extends CI_Model {

    public function __construct()
    {
        
    }
    public function edit_state_data()
    {
        $data = array(
                       'name' => $this->input->post('cityName')
                    );

        $this->db->where('id', $this->input->post('cityId'));
        $this->db->update('states', $data);
    }
    
    // load state and city
    public function load_state()
    {
        if($this->input->post('stateID') && is_numeric($this->input->post('stateID')) && $this->input->post('stateID') > 0)
        {
            // load city
            $this->db->select(array('id', 'name'));
            $this->db->from('states');
            $this->db->where(array('status' => 1, 'parentID' => $this->input->post('stateID')));
            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $data = $query->result_array();
            return $data;
        }
        else
        {
            // load state
            $this->db->select(array('id', 'name'));
            $this->db->from('states');
            $this->db->where(array('status' => 1, 'parentID' => 0));
            $this->db->order_by('name', 'asc');
            $query = $this->db->get();
            $data = $query->result_array();
            return $data;
        }
    }
    
    // load opu
    public function load_opu()
    {
        $this->db->select(array('id', 'name'));
        $this->db->from('opu');
        $this->db->where(array('status' => 1));
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    // load hospitals
    public function load_hospital()
    {
        $where = array('status' => 1);
        if($this->input->post('where'))
        {
            if($this->input->post('where') == 'state')
            {
                $where['state'] = $this->input->post('stateID');
            }
            elseif($this->input->post('where') == 'city')
            {
                $where['city'] = $this->input->post('stateID');
            }
            elseif($this->input->post('where') == 'opuId')
            {
                $where['opuId'] = $this->input->post('stateID');
            }
        }
        $this->db->select(array('id', 'name'));
        $this->db->from('hospitals');
        $this->db->where($where);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    // load load_inspectors
    public function load_inspectors()
    {
        $where = array('status <' => 12);
        if($this->input->post('opuID'))
        {
            $where['opuId'] = $this->input->post('opuID');
        }
        else
        {
            return false;
            exit;
        }
        $this->db->select(array('id', 'name'));
        $this->db->from('inspectors');
        $this->db->where($where);
        $this->db->order_by('name', 'asc');
        $query = $this->db->get();
        $data = $query->result_array();
        return $data;
    }
    
    // insert new opu
    public function insert_opu()
    {
        if($this->input->post('opuName'))
        {
            if(strlen($this->input->post('opuName')) > 5 AND strlen($this->input->post('headOffice')) > 5 && strlen($this->input->post('mob')) == 11 AND is_numeric($this->input->post('mob')) AND strlen($this->input->post('tel')) == 11 AND is_numeric($this->input->post('tel')) AND strlen($this->input->post('username')) > 2 AND strlen($this->input->post('password')) > 5 AND $this->input->post('stateId') > 0 AND $this->input->post('cityId') > 0)
            {
                $this->db->select('id');
                $this->db->from('opu');
                $this->db->where(array('username' => $this->input->post('username')));
                if($this->db->count_all_results() < 1)
                {
                    // username check for duplicaed
                    $data = array(
                                    'name' => htmlCoding($this->input->post('opuName')),
                                    'state' => $this->input->post('stateId'),
                                    'city' => $this->input->post('cityId'),
                                    'headOffice' => htmlCoding($this->input->post('headOffice')),
                                    'mobile' => htmlCoding($this->input->post('mob')),
                                    'telephone' => htmlCoding($this->input->post('tel')),
                                    'username' => $this->input->post('username'),
                                    'password' => md5(sha1($this->input->post('password'))),
                                    'authCode' => md5(randnum(25) . $this->input->post('password')),
                                    'status' => 1
                                    );
                    $this->db->insert('opu', $data);
                    if($this->db->affected_rows() == 1)
                    {
                        return 1; // insert successful
                    }
                    else
                    {
                        return 2; // insert not successful
                    }
                }
                else
                {
                    return 3; // username is duplicated
                }
            }
            else
            {
                return 4; // data validate problem
            }
        }
        else
        {
            return 5; // data not posted
        }
    }
    
    // select one opu
    public function select_one_opu()
    {
        if($this->input->post('opuID') AND is_numeric($this->input->post('opuID')) AND $this->input->post('opuID') > 0)
        {
            $this->db->select(array('id', 'name', 'headOffice', 'username', 'mobile', 'telephone', 'state', 'city'));
            $this->db->from('opu');
            $this->db->where(array('id' => $this->input->post('opuID'), 'status < ' => 10));
            $query = $this->db->get();
            if(is_array($query->result()) AND count($query->result()) > 0)
            {
                $data['opu'] = $query->row_array();
                $data = json_encode($data['opu']);
                return $data;
            }
            else
            {
                return false;
            }
        }
    }
    
    //edit one opu
    public function edit_one_opu()
    {
        if($this->input->post('opuName'))
        {
            if(strlen($this->input->post('opuName')) > 5 AND strlen($this->input->post('headOffice')) > 5 && strlen($this->input->post('mob')) == 11 AND is_numeric($this->input->post('mob')) AND strlen($this->input->post('tel')) == 11 AND is_numeric($this->input->post('tel')) AND $this->input->post('stateId') > 0 AND $this->input->post('cityId') > 0 AND $this->input->post('opuId') > 0)
            {
                // data validate complete
                $this->db->select(array('id'));
                $this->db->from('opu');
                $this->db->where(array('id' => $this->input->post('opuId'), 'status < ' => 10));
                $query = $this->db->get();
                if(is_array($query->result()) AND count($query->result()) > 0)
                {
                    $data = array(
                                    'name' => htmlCoding($this->input->post('opuName')),
                                    'state' => $this->input->post('stateId'),
                                    'city' => $this->input->post('cityId'),
                                    'headOffice' => htmlCoding($this->input->post('headOffice')),
                                    'mobile' => htmlCoding($this->input->post('mob')),
                                    'telephone' => htmlCoding($this->input->post('tel'))
                                    );
                    if($this->input->post('password') != 'notAffected' AND strlen($this->input->post('password')) > 5)
                    {
                        $data['password'] = md5(sha1($this->input->post('password')));
                        $data['authCode'] = md5(randnum(25) . $this->input->post('password'));
                    }
                    $this->db->where('id', $this->input->post('opuId'));
                    $this->db->update('opu', $data);
                    if($this->db->affected_rows() == 1)
                    {
                        return 1; // update successful
                    }
                    else
                    {
                        return 2; // update not completed
                    } 
                }
                else
                {
                    return 3; // opu not found
                }
            }
            else
            {
                return 4; // data not valid
            }
        }
        else
        {
            return 5; // data not posted
        }
    }
    
    // insert new hospital
    public function add_new_hospital()
    {
        if($this->input->post('hrName'))
        {
            if(strlen($this->input->post('hrName')) > 2 AND $this->input->post('opuId') > 0 AND $this->input->post('stateId') > 0 AND $this->input->post('cityId') > 0)
            {
                $data = array(
                                'name' => htmlCoding($this->input->post('hrName')),
                                'state' => $this->input->post('stateId'),
                                'city' => $this->input->post('cityId'),
                                'opuId' => $this->input->post('opuId'),
                                'status' => 1
                                );
                $this->db->insert('hospitals', $data);
                if($this->db->affected_rows() == 1)
                {
                    return 1; // insert successful
                }
                else
                {
                    return 2; // insert not successful
                }
            }
            else
            {
                return 3; // data not valid
            }
    
        }
        else
        {
            return 4; // data not posted
        }
    }
    
    // select one hospital
    public function select_one_hospital()
    {
        if($this->input->post('hosID') AND is_numeric($this->input->post('hosID')) AND $this->input->post('hosID') > 0)
        {
            $this->db->select(array('id', 'name', 'state', 'city', 'opuId'));
            $this->db->from('hospitals');
            $this->db->where(array('id' => $this->input->post('hosID'), 'status < ' => 10));
            $query = $this->db->get();
            if(is_array($query->result()) AND count($query->result()) > 0)
            {
                $data['hos'] = $query->row_array();
                $data = json_encode($data['hos']);
                return $data;
            }
            else
            {
                return false;
            }
        }
    }
    
    //edit one hospital
    public function edit_one_hospital()
    {
        if($this->input->post('hosName'))
        {
            if(strlen($this->input->post('hosName')) > 2 AND $this->input->post('opuId') > 0 AND $this->input->post('stateId') > 0 AND $this->input->post('cityId') > 0 AND $this->input->post('hosId') > 0)
            {
                // data validate complete
                $this->db->select(array('id'));
                $this->db->from('hospitals');
                $this->db->where(array('id' => $this->input->post('hosId'), 'status < ' => 10));
                $query = $this->db->get();
                if(is_array($query->result()) AND count($query->result()) > 0)
                {
                    $data = array(
                                    'name' => htmlCoding($this->input->post('hosName')),
                                    'state' => $this->input->post('stateId'),
                                    'city' => $this->input->post('cityId'),
                                    'opuId' => $this->input->post('opuId')
                                    );
                    $this->db->where('id', $this->input->post('hosId'));
                    $this->db->update('hospitals', $data);
                    if($this->db->affected_rows() == 1)
                    {
                        return 1; // update successful
                    }
                    else
                    {
                        return 2; // update not completed
                    } 
                }
                else
                {
                    return 3; // hospital not found
                }
            }
            else
            {
                return 4; // data not valid
            }
        }
        else
        {
            return 5; // data not posted
        }
    }
    
    // insert new inspector
    public function add_new_inspector()
    {
        if($this->input->post('insName'))
        {
            if(strlen($this->input->post('insName')) > 5 AND $this->input->post('opuId') > 0 AND strlen($this->input->post('insNationalCode')) == 10 AND is_numeric($this->input->post('insNationalCode')) AND strlen($this->input->post('insMobile')) == 11 AND is_numeric($this->input->post('insMobile')) AND strlen($this->input->post('insPassword')) > 5 AND $this->input->post('insType') > 0 AND $this->input->post('insType') < 4 AND nationalCode($this->input->post('insNationalCode')))
            {
                if($this->userauthentication_model->is_opu())
                {
                    $opu = $this->session->userdata('uid');
                }
                elseif($this->userauthentication_model->is_admin())
                {
                    $opu = $this->input->post('opuId');
                }
                else
                {
                    exit;
                }
                $data = array(
                                'name' => htmlCoding($this->input->post('insName')),
                                'nationalCode' => htmlCoding($this->input->post('insNationalCode')),
                                'password' => md5(sha1(htmlCoding($this->input->post('insPassword')))),
                                'authCode' => md5(randnum(25) . htmlCoding($this->input->post('insPassword'))),
                                'mobile' => htmlCoding($this->input->post('insMobile')),
                                'type' => $this->input->post('insType'),
                                'opuId' => $opu,
                                'status' => 1
                                );
                $this->db->insert('inspectors', $data);
                if($this->db->affected_rows() == 1)
                {
                    return 1; // insert successful
                }
                else
                {
                    return 2; // insert not successful
                }
            }
            else
            {
                return 3; // data not valid
            }
    
        }
        else
        {
            return 4; // data not posted
        }
    }
    
    // select one inspector
    public function select_one_inspector()
    {
        if($this->input->post('insID') AND is_numeric($this->input->post('insID')) AND $this->input->post('insID') > 0)
        {
            $this->db->select(array('id', 'name', 'nationalCode', 'mobile', 'type', 'opuId'));
            $this->db->from('inspectors');
            $this->db->where(array('id' => $this->input->post('insID'), 'status < ' => 10));
            $query = $this->db->get();
            if(is_array($query->result()) AND count($query->result()) > 0)
            {
                $data['ins'] = $query->row_array();
                $data = json_encode($data['ins']);
                return $data;
            }
            else
            {
                return false;
            }
        }
    }
    
    //edit one inspector
    public function edit_one_inspector()
    {
        if($this->input->post('insName'))
        {
            if(strlen($this->input->post('insName')) > 5 AND $this->input->post('opuId') > 0 AND strlen($this->input->post('insNationalCode')) == 10 AND is_numeric($this->input->post('insNationalCode')) AND strlen($this->input->post('insMobile')) == 11 AND is_numeric($this->input->post('insMobile')) AND $this->input->post('insType') > 0 AND $this->input->post('insType') < 4 AND $this->input->post('insID') > 0 AND nationalCode($this->input->post('insNationalCode')))
            {
                // data validate complete
                $this->db->select(array('id'));
                $this->db->from('inspectors');
                $this->db->where(array('id' => $this->input->post('insID'), 'status < ' => 10));
                $query = $this->db->get();
                if(is_array($query->result()) AND count($query->result()) > 0)
                {
                    $data = array(
                                'name' => htmlCoding($this->input->post('insName')),
                                'nationalCode' => htmlCoding($this->input->post('insNationalCode')),
                                'mobile' => htmlCoding($this->input->post('insMobile')),
                                'type' => $this->input->post('insType'),
                                'opuId' => $this->input->post('opuId')
                                );
                    if($this->input->post('insPassword') != 'passwordNotAffected' AND strlen($this->input->post('insPassword')) > 5)
                    {
                        $data['password'] = md5(sha1(htmlCoding($this->input->post('insPassword'))));
                        $data['authCode'] = md5(randnum(25) . htmlCoding($this->input->post('insPassword')));
                    }
                    $this->db->where('id', $this->input->post('insID'));
                    $this->db->update('inspectors', $data);
                    return 1; 
                }
                else
                {
                    return 3; // hospital not found
                }
            }
            else
            {
                return 4; // data not valid
            }
        }
        else
        {
            return 5; // data not posted
        }
    }
    
    // load doc
    public function load_doc()
    {
        $this->db->select(array('id', 'text', 'parentID'))
        ->from('doc')
        ->where(array('status' => 1, 'parentID' => 0))
        ->order_by('text ASC, parentID DESC');
        $query = $this->db->get();
        $data = $query->result_array();
        if(is_array($data) && count($data) > 0)
        {
            for($i = 0; $i < count($data); $i++)
            {
                $this->db->select(array('id', 'text', 'parentID'))
                ->from('doc')
                ->where(array('status' => 1, 'parentID' => $data[$i]['id']))
                ->order_by('text', 'ASC');
                $query = $this->db->get();
                $data[$i]['sub'] = $query->result_array();
            }
            return $data;
        }
        else
        {
            return false;
        }
    }
    
    // load tol option with tol id
    public function load_tol_option()
    {
        if($this->userauthentication_model->is_admin() OR $this->userauthentication_model->is_opu() OR $this->userauthentication_model->is_inspector())
        {
            if($this->input->post('stateID') AND is_numeric($this->input->post('stateID')) AND $this->input->post('stateID') > 0 AND $this->input->post('searchType') != 'ALL')
            {
                $where = array(
                            'tOp.status' => 1,
                            'tol_to_options.status' => 1,
                            'tOp.parentID' => 0,
                            'tol_to_options.tolID' => $this->input->post('stateID')
                            );
                if($this->userauthentication_model->is_inspector())
                {
                    if($this->session->userdata('type') == 1)
                    {
                        $where['tol_to_options.res1'] = 2;
                    }
                    else
                    {
                        $where['tol_to_options.res1 >= '] = 1;
                    }
                }
                else
                {
                    $where['tol_to_options.res1 >= '] = 1;
                }
                
                $this->db->select(array(
                                        'tOp.id AS tolOptionID',
                                        'tOp.name'
                                        ))
                ->from('tol_to_options')
                ->join('tol_options AS tOp', 'tOp.id = tol_to_options.tolOptionsID')
                ->where($where)
                ->order_by('tOp.id', 'ASC');
                $query = $this->db->get();
                $data = $query->result_array();
                if(is_array($data) AND count($data) > 0)
                {
                    for($i = 0; $i < count($data); $i++)
                    {
                        $this->db->select('*')
                        ->from('tol_options')
                        ->where(array('status' => 1, 'parentID' => $data[$i]['tolOptionID']))
                        ->order_by('name', 'ASC');
                        $query = $this->db->get();
                        $data[$i]['sub'] = $query->result_array();
                    }
                }
                return $data;
            }
            elseif($this->input->post('stateID') == '-1')
            {
                $this->db->select(array(
                                        'id AS tolOptionID',
                                        'name'
                                        ))
                ->from('tol_options')
                ->where(array(
                            'status' => 1,
                            'parentID' => 0
                            ))
                ->order_by('name', 'ASC');
                $query = $this->db->get();
                $data = $query->result_array();
                if(is_array($data) AND count($data) > 0)
                {
                    for($i = 0; $i < count($data); $i++)
                    {
                        /*$this->db->select('*')
                        ->from('tol_options')
                        ->where(array('status' => 1, 'parentID' => $data[$i]['id']))
                        ->order_by('name', 'ASC');
                        $query = $this->db->get();*/
                        if($data[$i]['tolOptionID'] == 2)
                        {
                            $data[$i]['name'] = 'درحال پیگیری (GCS3 مرگ مغزی نشده)';
                        }
                        if($data[$i]['tolOptionID'] == 7)
                        {
                            $data[$i]['name'] = 'درحال پیگیری (GCS3 مرگ مغزی شده)';
                        }
                        $data[$i]['sub'] = FALSE;
                    }
                }
                return $data;
            }
            elseif($this->input->post('stateID') AND is_numeric($this->input->post('stateID')) AND $this->input->post('stateID') > 0 AND $this->input->post('searchType') == 'ALL')
            {
                $this->db->select(array(
                                        'tOp.id AS tolOptionID',
                                        'tOp.name'
                                        ))
                ->from('tol_to_options')
                ->join('tol_options AS tOp', 'tOp.id = tol_to_options.tolOptionsID')
                ->where(array(
                            'tOp.status' => 1,
                            'tol_to_options.status' => 1,
                            'tOp.parentID' => 0,
                            'tol_to_options.tolID' => $this->input->post('stateID')
                            ))
                ->order_by('tOp.name', 'ASC');
                $query = $this->db->get();
                $data = $query->result_array();
                if(is_array($data) AND count($data) > 0)
                {
                    for($i = 0; $i < count($data); $i++)
                    {
                        $this->db->select('*')
                        ->from('tol_options')
                        ->where(array('status' => 1, 'parentID' => $data[$i]['tolOptionID']))
                        ->order_by('id', 'ASC');
                        $query = $this->db->get();
                        $data[$i]['sub'] = $query->result_array();
                    }
                }
                return $data;
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }
    
    // active or inactive or delete inspectors
    public function change_inspector_status()
    {
        $this->db->select(array('id', 'status', 'opuId'))
        ->from('inspectors')
        ->where(array('id' => $this->input->post('insID'), 'status < ' => 10));
        $query = $this->db->get();
        $query = $query->row_array();
        
        if($query AND is_array($query) AND count($query) > 0)
        {
            if($this->input->post('insStatus') != 'delete')
            {
                $this->db->select('id')
                ->from('opu')
                ->where(array('id' => $query['opuId'], 'status' => 1));
                $opu = $this->db->get();
                $opu = $opu->row_array();
                if($opu AND is_array($opu) AND count($opu) > 0)
                {
                    // continue
                }
                else
                {
                    echo 2; // user can not change this status
                    exit;
                }
            }
            else
            {
                // continue
            }
            
            if($this->session->userdata('role') == 'ADMIN' AND $query['status'] <= 3)
            {
                if($this->input->post('insStatus') == 'inactive')
                {
                    $status = 3;
                }
                elseif($this->input->post('insStatus') == 'active')
                {
                    $status = 1;
                }
                elseif($this->input->post('insStatus') == 'delete')
                {
                    $status = 12;
                }
            }
            elseif($this->session->userdata('role') == 'OPU' AND $query['status'] < 3)
            {
                if($this->input->post('insStatus') == 'inactive')
                {
                    $status = 2;
                }
                elseif($this->input->post('insStatus') == 'active' AND $query['status'] != 3)
                {
                    $status = 1;
                }
                elseif($this->input->post('insStatus') == 'delete' AND $query['status'] != 3)
                {
                    $status = 12;
                }
                else
                {
                    echo 1; // opu not access to active this inspector
                    exit;
                }
            }
            else
            {
                echo 2; // user can not change this status
                exit;
            }
            
            $update = array('status' => $status);
            $this->db->where('id', $query['id']);
            $this->db->update('inspectors', $update);
            echo 3; // update success
            exit;
        }
    }
    
    // active or inactive or delete opu
    public function change_opu_status()
    {
        $this->db->select(array('id', 'status'))
        ->from('opu')
        ->where(array('id' => $this->input->post('opuId'), 'status < ' => 10));
        $query = $this->db->get();
        $query = $query->row_array();
        if($query AND is_array($query) AND count($query) > 0)
        {
            $whereIns = array('opuId' => $query['id']);
            if($this->input->post('opuStatus') == 'inactive')
            {
                $status = 2;
                $insStatus = 4;
                $whereIns['status'] = 1;
            }
            elseif($this->input->post('opuStatus') == 'active')
            {
                $status = 1;
                $insStatus = 1;
                $whereIns['status'] = 4;
            }
            elseif($this->input->post('opuStatus') == 'delete')
            {
                $status = 12;
                $insStatus = 12;
                
            }
            else
            {
                echo 'Err';
                exit;
            }
            
            $this->db->select('id')
            ->from('inspectors')
            ->where($whereIns);
            $ins = $this->db->get();
            $ins = $ins->result_array();
            if($ins AND is_array($ins) AND count($ins) > 0)
            {
                $insUpdate = array('status' => $insStatus);
                for($i = 0; $i < count($ins); $i++)
                {
                    $this->db->where('id', $ins[$i]['id']);
                    $this->db->update('inspectors', $insUpdate);
                }
            }
                        
            $update = array('status' => $status);
            $this->db->where('id', $query['id']);
            $this->db->update('opu', $update);
            echo 3; // update success
            exit;
        }
        else
        {
            echo 2; // opu not found
            exit;
        }
    }
    
    // load one patient data
    public function load_one_patient()
    {
        if($this->input->post('pID'))
        {
            $where = array('patients.status' => 1, 'patients.id' => $this->input->post('pID'));
            if($this->session->userdata('role') == 'OPU')
            {
                $where['pLog.opu'] = $this->session->userdata('uid');
            }
            elseif($this->session->userdata('role') == 'INSPECTOR')
            {
                $where['pLog.opu'] = $this->session->userdata('opuId');
            }
            $this->db->select(array(
                                'patients.id', 
                                'patients.fullName', 
                                'patients.nationalCode', 
                                'patients.age', 
                                'patients.firstGCS', 
                                'patients.fileNumber', 
                                'patients.bodyType', 
                                'patients.isUnKnown', 
                                'patients.docDetail', 
                                'patients.presentation', 
                                'patients.appRegisterTime', 
                                'patients.inspectorRegisterTime', 
                                'patients.patientStatusDetail', 
                                'patients.patientStatus', 
                                'patients.patientDetail', 
                                'patients.doc', 
                                'patients.tol', 
                                'patients.coordinatorName', 
                                'patients.hospitalizationTime', 
                                'patients.gcs3ByDrTime', 
                                'patients.brainDeathTime', 
                                'patients.cardiacDeathTime', 
                                'patients.organDonationTime', 
                                'docT.text AS docText', 
                                'tolOp.name AS tolOpName', 
                                'tolOp.color AS tolOpColor', 
                                'tolOp.res1 AS tolOpTextColor', 
                                'pLog.breathing', 
                                'pLog.breathingDetail', 
                                'pLog.bodyMovement', 
                                'pLog.bodyMovementDetail', 
                                'pLog.faceMovement', 
                                'pLog.faceMovementDetail', 
                                'pLog.gag', 
                                'pLog.cough', 
                                'pLog.cornea', 
                                'pLog.pupil', 
                                'pLog.dollEye', 
                                'pLog.secondGCS', 
                                'pLog.sedation', 
                                'pLog.inspector', 
                                'pLog.status As pLogStatus', 
                                'pLog.section', 
                                'pLog.hospital', 
                                'pLog.id AS pLogId', 
                                'pLog.typeOfSection', 
                                'pLog.lastUpdateTime', 
                                'pLog.isTransfer', 
                                'hos.name AS hosName', 
                                'opu.name AS opuName', 
                                'opu.id AS opuId', 
                                'states.name AS cityName',
                                'inspectors.name AS insName'
                                ));
            $this->db->from('patients');
            $this->db->join('doc AS docT' ,'docT.id = patients.doc');
            $this->db->join('tol_options AS tolOp' ,'tolOp.id = patients.patientStatus');
            $this->db->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)');
            $this->db->join('hospitals AS hos' ,'hos.id = pLog.hospital');
            $this->db->join('opu' ,'opu.id = pLog.opu');
            $this->db->join('states' ,'states.id = pLog.city');
            $this->db->join('inspectors' ,'inspectors.id = pLog.inspector');
            
            $this->db->where($where);
            $this->db->group_by('pLog.pId');
            $query = $this->db->get();
            $data['pt'] = $query->row_array();
            if($data['pt'] AND is_array($data['pt']) AND count($data['pt']) > 0)
            {
                if($data['pt']['hospitalizationTime'] > 0)
                {
                    $data['pt']['hospitalizationTime'] = pdate('Y/m/d', $data['pt']['hospitalizationTime']);
                }
                if($data['pt']['gcs3ByDrTime'] > 0)
                {
                    $data['pt']['gcs3ByDrTime'] = pdate('Y/m/d', $data['pt']['gcs3ByDrTime']);
                }
                if($data['pt']['brainDeathTime'] > 0)
                {
                    $data['pt']['brainDeathTime'] = pdate('Y/m/d', $data['pt']['brainDeathTime']);
                }
                if($data['pt']['cardiacDeathTime'] > 0)
                {
                    $data['pt']['cardiacDeathTime'] = pdate('Y/m/d', $data['pt']['cardiacDeathTime']);
                }
                if($data['pt']['organDonationTime'] > 0)
                {
                    $data['pt']['organDonationTime'] = pdate('Y/m/d', $data['pt']['organDonationTime']);
                }
                
                $data['pt']['appRegisterTime'] = pdate('Y/m/d - H:i', $data['pt']['appRegisterTime']);
                
                return json_encode($data['pt']);
            }
            else
            {
                echo 'Err';
                exit;
            }
        }
        else
        {
            echo 'Err';
            exit;
        }
    }
    
    // transfer patient
    public function transfer_patient()
    {
        $state = $this->input->post('cbTState');
        $city = $this->input->post('cbTCity');
        $hospital = $this->input->post('cbTHospital');
        $time = $this->input->post('tTime');
        $id = $this->input->post('pId');
        
        
        // find opu id
        $this->db->select('opuId')
        ->from('hospitals')
        ->where(array('id' => $hospital));
        $opu = $this->db->get();
        $opu = $opu->row_array();
        if($opu['opuId'] > 0)
        {
            $opu = $opu['opuId'];
        }
        else
        {
            echo 'Err';
            exit;
        }
        // find opu id
        
        
        if($state > 0 AND $city > 0 AND $hospital > 0 AND strlen($time) > 6 AND $id > 0 AND $opu > 0)
        {
            $where = array('patients.status' => 1, 'patients.id' => $id);
            if($this->session->userdata('role') == 'OPU')
            {
                $where['pLog.opu'] = $this->session->userdata('uid');
            }
            elseif($this->session->userdata('role') == 'INSPECTOR')
            {
                $where['pLog.opu'] = $this->session->userdata('opuId');
            }
            $this->db->select(array(
                                'patients.id', 
                                'patients.fullName', 
                                'patients.nationalCode', 
                                'patients.age', 
                                'patients.firstGCS', 
                                'patients.fileNumber', 
                                'patients.bodyType', 
                                'patients.isUnKnown', 
                                'patients.docDetail', 
                                'patients.presentation', 
                                'patients.appRegisterTime', 
                                'patients.inspectorRegisterTime', 
                                'patients.patientStatusDetail', 
                                'patients.patientStatus', 
                                'patients.patientDetail', 
                                'patients.doc', 
                                'patients.tol', 
                                'patients.coordinatorName', 
                                'docT.text AS docText', 
                                'tolOp.name AS tolOpName', 
                                'tolOp.color AS tolOpColor', 
                                'tolOp.res1 AS tolOpTextColor', 
                                'pLog.breathing', 
                                'pLog.breathingDetail', 
                                'pLog.bodyMovement', 
                                'pLog.bodyMovementDetail', 
                                'pLog.faceMovement', 
                                'pLog.faceMovementDetail', 
                                'pLog.gag', 
                                'pLog.cough', 
                                'pLog.cornea', 
                                'pLog.pupil', 
                                'pLog.dollEye', 
                                'pLog.secondGCS', 
                                'pLog.sedation', 
                                'pLog.inspector', 
                                'pLog.status As pLogStatus', 
                                'pLog.section', 
                                'pLog.hospital', 
                                'pLog.id AS pLogId', 
                                'pLog.typeOfSection', 
                                'pLog.lastUpdateTime', 
                                'pLog.isTransfer', 
                                'hos.name AS hosName', 
                                'opu.name AS opuName', 
                                'opu.id AS opuId', 
                                'states.name AS cityName',
                                'inspectors.name AS insName'
                                ));
            $this->db->from('patients');
            $this->db->join('doc AS docT' ,'docT.id = patients.doc');
            $this->db->join('tol_options AS tolOp' ,'tolOp.id = patients.patientStatus');
            $this->db->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)');
            $this->db->join('hospitals AS hos' ,'hos.id = pLog.hospital');
            $this->db->join('opu' ,'opu.id = pLog.opu');
            $this->db->join('states' ,'states.id = pLog.city');
            $this->db->join('inspectors' ,'inspectors.id = pLog.inspector');
            
            $this->db->where($where);
            $this->db->group_by('pLog.pId');
            $query = $this->db->get();
            $pt = $query->row_array();
            
            if($pt AND is_array($pt) AND count($pt) > 0)
            {
                $this->db->select('id')
                ->from('patients_log')
                ->where(array(
                                'pId' => $id,
                                'status' => 1,
                                'isTransfer' => 0
                                ));
                $log = $this->db->get();
                // change old patient log to isTransfer
                if($log->num_rows() > 0)
                {
                    $log = $log->result_array();
                    $updateData = array('isTransfer' => 1);
                    for($i = 0; $i < count($log); $i++)
                    {
                        $this->db->where('id', $log[$i]['id']);
                        $this->db->update('patients_log', $updateData);
                    }
                }
                // change old patient log to isTransfer
                
                $insertData = array(
                                    'pId' => $id,
                                    'status' => 1,
                                    'breathing' => $pt['breathing'],
                                    'breathingDetail' => $pt['breathingDetail'],
                                    'bodyMovement' => $pt['bodyMovement'],
                                    'bodyMovementDetail' => $pt['bodyMovementDetail'],
                                    'faceMovement' => $pt['faceMovement'],
                                    'faceMovementDetail' => $pt['faceMovementDetail'],
                                    'gag' => $pt['gag'],
                                    'cough' => $pt['cough'],
                                    'cornea' => $pt['cornea'],
                                    'pupil' => $pt['pupil'],
                                    'dollEye' => $pt['dollEye'],
                                    'secondGCS' => $pt['secondGCS'],
                                    'sedation' => $pt['sedation'],
                                    'state' => $state,
                                    'city' => $city,
                                    'opu' => $opu,
                                    'inspector' => $pt['inspector'],
                                    'hospital' => $hospital,
                                    'section' => 2,
                                    'lastUpdateTime' => time(),
                                    'isTransfer' => 0
                                    );
                $this->db->insert('patients_log', $insertData);
                if($this->db->affected_rows() > 0)
                {
                    $time = explode('/', $time);
                    $time = pmktime(0, 0, 0, $time[1], $time[2], $time[0]);
                    $updateData = array(
                                        'status' => 2,
                                        'patientTransferTime' => $time,
                                        'presentation' => 3,
                                        'patientStatus' => 1
                                        );
                    $this->db->where('id', $id);
                    $this->db->update('patients', $updateData);
                    if($this->db->affected_rows() > 0)
                    {
                        echo 1;
                    }
                    else
                    {
                        echo 'Err';
                        exit;
                    }
                }
                else
                {
                    echo 'Err';
                    exit;
                }
            }
            else
            {
                echo 'Err';
                exit;
            }
        }
        else
        {
            echo 'Err';
            exit;
        }
    }
    
    // edit patient data
    public function edit_patient_data()
    {
        if($this->input->post("inputPT") AND is_numeric($this->input->post("inputPT")))
        {
            $id = $this->input->post("inputPT");
            $chisUnknown = $this->input->post("chisUnknown");
            $inputFileNumber = $this->input->post("inputFileNumber");
            $inputFullName = $this->input->post("inputFullName");
            $inputAge = $this->input->post("inputAge");
            $inputNationalCode = $this->input->post("inputNationalCode");
            $cbBodyType = $this->input->post("cbBodyType");
            $inputFirstGCS = $this->input->post("inputFirstGCS");
            $inputSecondGCS = $this->input->post("inputSecondGCS");
            $inputCoordinatorName = $this->input->post("inputCoordinatorName");
            $cbDoc = $this->input->post("cbDoc");
            $inputDocDetail = $this->input->post("inputDocDetail");
            $inputPatientDetail = $this->input->post("inputPatientDetail");
            $cbOpuEdit = $this->input->post("cbOpuEdit");
            $cbHospitalsEdit = $this->input->post("cbHospitalsEdit");
            $cbSectionEdit = $this->input->post("cbSectionEdit");
            $inputTypeOfSection = $this->input->post("inputTypeOfSection");
            $cbPresentioan = $this->input->post("cbPresentioan");
            $cbBreathing = $this->input->post("cbBreathing");
            $inputBreathingDetail = $this->input->post("inputBreathingDetail");
            $cbCornea = $this->input->post("cbCornea");
            $cbPupil = $this->input->post("cbPupil");
            $cbFaceMove = $this->input->post("cbFaceMove");
            $inputFaceMovementDetail = $this->input->post("inputFaceMovementDetail");
            $cbBodyMove = $this->input->post("cbBodyMove");
            $inputBodyMovementDetail = $this->input->post("inputBodyMovementDetail");
            $cbDoll = $this->input->post("cbDoll");
            $cbGag = $this->input->post("cbGag");
            $cbCough = $this->input->post("cbCough");
            $cbSedation = $this->input->post("cbSedation");
            $cbTol = $this->input->post("cbTol");
            $cbPatientStatusEdit = $this->input->post("cbPatientStatusEdit");
            $inputPatientStatusDetail = $this->input->post("inputPatientStatusDetail");
            $inputT = $this->input->post("inputT");
            $inputPR = $this->input->post("inputPR");
            $inputFIO2 = $this->input->post("inputFIO2");
            $inputBP = $this->input->post("inputBP");
            $inputRR = $this->input->post("inputRR");
            $inputO2SAT = $this->input->post("inputO2SAT");
            $cbSedation2 = $this->input->post("cbSedation2");
            $inputNa = $this->input->post("inputNa");
            $inputBUN = $this->input->post("inputBUN");
            $inputALT = $this->input->post("inputALT");
            $inputWBC = $this->input->post("inputWBC");
            $inputHb = $this->input->post("inputHb");
            $inputK = $this->input->post("inputK");
            $inputCr = $this->input->post("inputCr");
            $inputAST = $this->input->post("inputAST");
            $inputPLT = $this->input->post("inputPLT");
            $inputBs = $this->input->post("inputBs");
            $inputOut = $this->input->post("inputOut");
            $chHeart = $this->input->post("chHeart");
            $chLiver = $this->input->post("chLiver");
            $chKidneyRight = $this->input->post("chKidneyRight");
            $chKidneyLeft = $this->input->post("chKidneyLeft");
            $chLungRight = $this->input->post("chLungRight");
            $chLungLeft = $this->input->post("chLungLeft");
            $chPancreas = $this->input->post("chPancreas");
            $chTissue = $this->input->post("chTissue");
            $chBowel = $this->input->post("chBowel");
            $pcal1 = $this->input->post("pcal1");
            $pcal2 = $this->input->post("pcal2");
            $pcal3 = $this->input->post("pcal3");
            $pcal5 = $this->input->post("pcal5");
            $pcal6 = $this->input->post("pcal6");
            
            if($chisUnknown)
            {
                $inputFullName = 'ناشناس';
                $inputNationalCode = '-';
                $inputAge = '-';
                $chisUnknown = 1;
            }
            else
            {
                $chisUnknown = 0;
            }
            $cbSedation = $cbSedation ? 'Yes' : 'No';
            
            // find patient
            $where = array('patients.status' => 1, 'patients.id' => $id);
            if($this->session->userdata('role') == 'OPU')
            {
                $where['pLog.opu'] = $this->session->userdata('uid');
            }
            elseif($this->session->userdata('role') == 'INSPECTOR')
            {
                $where['pLog.opu'] = $this->session->userdata('opuId');
            }
            $this->db->select(array(
                                'patients.id', 
                                'patients.fullName', 
                                'patients.nationalCode', 
                                'patients.age', 
                                'patients.firstGCS', 
                                'patients.fileNumber', 
                                'patients.bodyType', 
                                'patients.isUnKnown', 
                                'patients.docDetail', 
                                'patients.presentation', 
                                'patients.appRegisterTime', 
                                'patients.inspectorRegisterTime', 
                                'patients.patientStatusDetail', 
                                'patients.patientStatus', 
                                'patients.patientDetail', 
                                'patients.doc', 
                                'patients.tol', 
                                'patients.coordinatorName', 
                                'docT.text AS docText', 
                                'tolOp.name AS tolOpName', 
                                'tolOp.color AS tolOpColor', 
                                'tolOp.res1 AS tolOpTextColor', 
                                'pLog.breathing', 
                                'pLog.breathingDetail', 
                                'pLog.bodyMovement', 
                                'pLog.bodyMovementDetail', 
                                'pLog.faceMovement', 
                                'pLog.faceMovementDetail', 
                                'pLog.gag', 
                                'pLog.cough', 
                                'pLog.cornea', 
                                'pLog.pupil', 
                                'pLog.dollEye', 
                                'pLog.secondGCS', 
                                'pLog.sedation', 
                                'pLog.state', 
                                'pLog.city', 
                                'pLog.inspector', 
                                'pLog.status As pLogStatus', 
                                'pLog.section', 
                                'pLog.hospital', 
                                'pLog.id AS pLogId', 
                                'pLog.typeOfSection', 
                                'pLog.lastUpdateTime', 
                                'pLog.isTransfer', 
                                'hos.name AS hosName', 
                                'opu.name AS opuName', 
                                'opu.id AS opuId', 
                                'states.name AS cityName',
                                'inspectors.name AS insName'
                                ));
            $this->db->from('patients');
            $this->db->join('doc AS docT' ,'docT.id = patients.doc');
            $this->db->join('tol_options AS tolOp' ,'tolOp.id = patients.patientStatus');
            $this->db->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)');
            $this->db->join('hospitals AS hos' ,'hos.id = pLog.hospital');
            $this->db->join('opu' ,'opu.id = pLog.opu');
            $this->db->join('states' ,'states.id = pLog.city');
            $this->db->join('inspectors' ,'inspectors.id = pLog.inspector');
            
            $this->db->where($where);
            $this->db->group_by('pLog.pId');
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $pt = $query->row_array();
                $updateData = '';
                if($cbTol == 1)
                {
                    if($cbSedation2)
                    {
                        $cbSedation2 = 'Yes';
                    }
                    else
                    {
                        $cbSedation2 = 'No';
                    }
                    // call last condition if isset
                    $lastCondition = $this->db->select(array('id', 't', 'bp', 'pr', 'rr', 'fio2', 'o2sat', 'sedation', 'out'))
                    ->from('condition')->where(array('pId' => $id, 'status' => 1))->order_by('id', 'DESC')->limit(1,0)->get();
                    if($lastCondition->num_rows() > 0)
                    {
                        $lastCondition = $lastCondition->row_array();
                        // check for on change condition
                        if($lastCondition['t'] != $inputT OR $lastCondition['bp'] != $inputBP OR $lastCondition['pr'] != $inputPR OR $lastCondition['rr'] != $inputRR OR $lastCondition['fio2'] != $inputFIO2 OR $lastCondition['o2sat'] != $inputO2SAT OR $lastCondition['sedation'] != $cbSedation2 OR $lastCondition['out'] != $inputOut)
                        {
                            $insertData = array(
                                        'pId' => $id,
                                        'status' => 1,
                                        't' => $inputT,
                                        'bp' => $inputBP,
                                        'pr' => $inputPR,
                                        'rr' => $inputRR,
                                        'fio2' => $inputFIO2,
                                        'o2sat' => $inputO2SAT,
                                        'sedation' => $cbSedation2,
                                        'out' => $inputOut
                                        );
                            $this->db->insert('condition', $insertData);
                            if($this->db->affected_rows() > 0)
                            {
                                $insertCondition = 1;
                            }
                            else
                            {
                                $insertCondition = 2;
                            }
                        }
                        else
                        {
                            $insertCondition = 1;
                        }
                    }
                    else
                    {
                        $insertData = array(
                                        'pId' => $id,
                                        'status' => 1,
                                        't' => $inputT,
                                        'bp' => $inputBP,
                                        'pr' => $inputPR,
                                        'rr' => $inputRR,
                                        'fio2' => $inputFIO2,
                                        'o2sat' => $inputO2SAT,
                                        'sedation' => $cbSedation2,
                                        'out' => $inputOut
                                        );
                        $this->db->insert('condition', $insertData);
                        if($this->db->affected_rows() > 0)
                        {
                            $insertCondition = 1;
                        }
                        else
                        {
                            $insertCondition = 2;
                        }
                    }
                    if($insertCondition == 1)
                    {
                        // cal last patient test
                        $lastTest = $this->db->select(array('na', 'k', 'bun', 'cr', 'alt', 'ast', 'wbc', 'plt', 'hb', 'bs', 'out'))
                        ->from('tests')->where(array('pId' => $id, 'status' => 1))->order_by('id', 'DESC')->limit(1,0)->get();
                        if($lastTest->num_rows() > 0)
                        {
                            $lastTest = $lastTest->row_array();
                            if($lastTest['na'] != $inputNa OR $lastTest['k'] != $inputK OR $lastTest['bun'] != $inputBUN OR $lastTest['cr'] != $inputCr OR $lastTest['alt'] != $inputALT OR $lastTest['ast'] != $inputAST OR $lastTest['wbc'] != $inputWBC OR $lastTest['plt'] != $inputPLT OR $lastTest['hb'] != $inputHb OR $lastTest['bs'] != $inputBs)
                            {
                                $insertData = array(
                                            'pId' => $id,
                                            'status' => 1,
                                            'na' => $inputNa,
                                            'k' => $inputK,
                                            'bun' => $inputBUN,
                                            'cr' => $inputCr,
                                            'alt' => $inputALT,
                                            'ast' => $inputAST,
                                            'wbc' => $inputWBC,
                                            'plt' => $inputPLT,
                                            'hb' => $inputHb,
                                            'bs' => $inputBs,
                                            'out' => $inputOut
                                            );
                                $this->db->insert('tests', $insertData);
                                if($this->db->affected_rows() > 0)
                                {
                                    $insertTest = 1;
                                }
                                else
                                {
                                    $insertTest = 2;
                                }
                            }
                            else
                            {
                                $insertTest = 1;
                            }
                        }
                        else
                        {
                            $insertData = array(
                                            'pId' => $id,
                                            'status' => 1,
                                            'na' => $inputNa,
                                            'k' => $inputK,
                                            'bun' => $inputBUN,
                                            'cr' => $inputCr,
                                            'alt' => $inputALT,
                                            'ast' => $inputAST,
                                            'wbc' => $inputWBC,
                                            'plt' => $inputPLT,
                                            'hb' => $inputHb,
                                            'bs' => $inputBs,
                                            'out' => $inputOut
                                            );
                            $this->db->insert('tests', $insertData);
                            if($this->db->affected_rows() > 0)
                            {
                                $insertTest = 1;
                            }
                            else
                            {
                                $insertTest = 2;
                            }
                        }
                        if($insertTest == 1)
                        {
                            // insert to tests successful
                            if($cbPatientStatusEdit == 6 AND $chisUnknown != 1)
                            {
                                $updateData['hospitalizationTime'] = explode('/', $pcal1);
                                $updateData['hospitalizationTime'] = pmktime(0, 0, 0, $updateData['hospitalizationTime'][1], $updateData['hospitalizationTime'][2], $updateData['hospitalizationTime'][0]);
                                
                                $updateData['gcs3ByDrTime'] = explode('/', $pcal2);
                                $updateData['gcs3ByDrTime'] = pmktime(0, 0, 0, $updateData['gcs3ByDrTime'][1], $updateData['gcs3ByDrTime'][2], $updateData['gcs3ByDrTime'][0]);
                                
                                $updateData['brainDeathTime'] = explode('/', $pcal3);
                                $updateData['brainDeathTime'] = pmktime(0, 0, 0, $updateData['brainDeathTime'][1], $updateData['brainDeathTime'][2], $updateData['brainDeathTime'][0]);
                                
                                $updateData['organDonationTime'] = explode('/', $pcal5);
                                $updateData['organDonationTime'] = pmktime(0, 0, 0, $updateData['organDonationTime'][1], $updateData['organDonationTime'][2], $updateData['organDonationTime'][0]);
                                
                                $updateData['coordinatorName'] = $inputCoordinatorName;

                                // delete old record for patient organs
                                $this->db->where('pId', $id);
                                $this->db->delete('organs');
                                // delete old record for patient organs
                                
                                $chHeart = $chHeart ? 1 : 0;
                                $chLiver = $chLiver ? 1 : 0;
                                $chKidneyRight = $chKidneyRight ? 1 : 0;
                                $chKidneyLeft = $chKidneyLeft ? 1 : 0;
                                $chLungRight = $chLungRight ? 1 : 0;
                                $chLungLeft = $chLungLeft ? 1 : 0;
                                $chPancreas = $chPancreas ? 1 : 0;
                                $chTissue = $chTissue ? 1 : 0;
                                $chBowel = $chBowel ? 1 : 0;
                                $insertData = array(
                                                    'pId' => $id,
                                                    'status' => 1,
                                                    'heart' => $chHeart,
                                                    'liver' => $chLiver,
                                                    'kidneyRight' => $chKidneyRight,
                                                    'kidneyLeft' => $chKidneyLeft,
                                                    'lungRight' => $chLungRight,
                                                    'lungLeft' => $chLungLeft,
                                                    'pancreas' => $chPancreas,
                                                    'tissue' => $chTissue,
                                                    'bowel' => $chBowel
                                                    );
                                $this->db->insert('organs', $insertData);
                            }
                            elseif($cbPatientStatusEdit == 9 OR $cbPatientStatusEdit == 10 OR $cbPatientStatusEdit == 11 OR $cbPatientStatusEdit == 12 OR $cbPatientStatusEdit == 13 OR $cbPatientStatusEdit == 14 OR $cbPatientStatusEdit == 15)
                            {
                                $updateData['hospitalizationTime'] = explode('/', $pcal1);
                                $updateData['hospitalizationTime'] = pmktime(0, 0, 0, $updateData['hospitalizationTime'][1], $updateData['hospitalizationTime'][2], $updateData['hospitalizationTime'][0]);
                                
                                $updateData['gcs3ByDrTime'] = explode('/', $pcal2);
                                $updateData['gcs3ByDrTime'] = pmktime(0, 0, 0, $updateData['gcs3ByDrTime'][1], $updateData['gcs3ByDrTime'][2], $updateData['gcs3ByDrTime'][0]);
                                
                                $updateData['brainDeathTime'] = explode('/', $pcal3);
                                $updateData['brainDeathTime'] = pmktime(0, 0, 0, $updateData['brainDeathTime'][1], $updateData['brainDeathTime'][2], $updateData['brainDeathTime'][0]);
                                
                                $updateData['cardiacDeathTime'] = explode('/', $pcal6);
                                $updateData['cardiacDeathTime'] = pmktime(0, 0, 0, $updateData['cardiacDeathTime'][1], $updateData['cardiacDeathTime'][2], $updateData['cardiacDeathTime'][0]);
                                
                                $updateData['coordinatorName'] = $inputCoordinatorName;
                            }
                        }
                        else
                        {
                            echo 'Err';
                            exit;
                        }
                    }
                    else
                    {
                        echo 'Err';
                        exit;
                    }
                    
                }
                
                // insert data to patients log
                if($this->session->userdata('role') == 'ADMIN')
                {
                    $ins = 0;
                    $opuid = NULL;
                }
                elseif($this->session->userdata('role') == 'OPU')
                {
                    $ins = -1;
                    $opuid = $this->session->userdata('uid');
                }
                elseif($this->session->userdata('role') == 'INSPECTOR')
                {
                    $ins = $this->session->userdata('uid');
                    $opuid = NULL;
                }
                $insertData = array(
                                    'pId' => $id,
                                    'status' => 1,
                                    'breathing' => $cbBreathing,
                                    'breathingDetail' => $inputBreathingDetail,
                                    'bodyMovement' => $cbBodyMove,
                                    'bodyMovementDetail' => $inputBodyMovementDetail,
                                    'faceMovement' => $cbFaceMove,
                                    'faceMovementDetail' => $inputFaceMovementDetail,
                                    'gag' => $cbGag,
                                    'cough' => $cbCough,
                                    'cornea' => $cbCornea,
                                    'pupil' => $cbPupil,
                                    'dollEye' => $cbDoll,
                                    'secondGCS' => $inputSecondGCS,
                                    'sedation' => $cbSedation,
                                    'state' => $pt['state'],
                                    'city' => $pt['city'],
                                    'opu' => $pt['opuId'],
                                    'inspector' => $ins,
                                    'hospital' => $cbHospitalsEdit,
                                    'section' => $cbSectionEdit,
                                    'typeOfSection' => $inputTypeOfSection,
                                    'lastUpdateTime' => time(),
                                    'isTransfer' => 0,
                                    'res1' => $opuid
                                    );
                $this->db->insert('patients_log', $insertData);
                if($this->db->affected_rows() > 0)
                {
                    $updateData['fileNumber'] = $inputFileNumber;
                    $updateData['fullName'] = $inputFullName;
                    $updateData['age'] = $inputAge;
                    $updateData['bodyType'] = $cbBodyType;
                    $updateData['nationalCode'] = $inputNationalCode;
                    $updateData['firstGCS'] = $inputFirstGCS;
                    $updateData['isUnknown'] = $chisUnknown;
                    $updateData['doc'] = $cbDoc;
                    $updateData['docDetail'] = $inputDocDetail;
                    $updateData['tol'] = $cbTol;
                    $updateData['patientStatus'] = $cbPatientStatusEdit;
                    $updateData['patientStatusDetail'] = $inputPatientStatusDetail;
                    $updateData['patientDetail'] = $inputPatientDetail;
                    $updateData['presentation'] = $cbPresentioan;
                    $updateData['presentation'] = $cbPresentioan;
                    $this->db->where('id', $id);
                    $this->db->update('patients', $updateData);
                    echo 'OK';
                }
            }
        }
    }
    
    // load one patient extra data
    public function load_one_patient_extra_data()
    {
        if($this->input->post('pID'))
        {
            $id = $this->input->post('pID');
            
            // load patient condition
            $this->db->select(array(
                                    't',
                                    'bp',
                                    'pr',
                                    'rr',
                                    'fio2',
                                    'o2sat',
                                    'sedation',
                                    'out'
                                    ))
            ->from('condition')
            ->where(array('pId' => $id, 'status' => 1))
            ->order_by('id', 'DESC')
            ->limit(1,0);
            $data['condition'] = $this->db->get();
            if($data['condition']->num_rows() > 0)
            {
                $data['condition'] = $data['condition']->row_array();
                $data['isCondition'] = 1;
            }
            else
            {
                $data['isCondition'] = 0;
                $data['condition'] = 0;
            }
            
            // load patient test
            $this->db->select(array(
                                    'na',
                                    'k',
                                    'bun',
                                    'cr',
                                    'alt',
                                    'ast',
                                    'wbc',
                                    'plt',
                                    'hb',
                                    'bs',
                                    'out'
                                    ))
            ->from('tests')
            ->where(array('pId' => $id, 'status' => 1))
            ->order_by('id', 'DESC')
            ->limit(1,0);
            $data['test'] = $this->db->get();
            if($data['test']->num_rows() > 0)
            {
                $data['test'] = $data['test']->row_array();
                $data['isTest'] = 1;
            }
            else
            {
                $data['isTest'] = 0;
                $data['test'] = 0;
            }
            
            // load patient organs
            $this->db->select(array(
                                    'heart',
                                    'liver',
                                    'kidneyRight',
                                    'kidneyLeft',
                                    'lungRight',
                                    'lungLeft',
                                    'pancreas',
                                    'tissue',
                                    'bowel'
                                    ))
            ->from('organs')
            ->where(array('pId' => $id, 'status' => 1))
            ->order_by('id', 'DESC')
            ->limit(1,0); 
            $data['organ'] = $this->db->get();
            if($data['organ']->num_rows() > 0)
            {
                $data['organ'] = $data['organ']->row_array();
                $data['isOrgan'] = 1;
            }
            else
            {
                $data['isOrgan'] = 0;
                $data['organ'] = 0;
            }
            return json_encode($data);
        }
    }
    
    // load one patient logs
    public function load_one_patient_log()
    {
        if($this->input->post('pID'))
        {
            $id = $this->input->post('pID');
            
            // load patient condition
            $this->db->select(array(
                                    't',
                                    'bp',
                                    'pr',
                                    'rr',
                                    'fio2',
                                    'o2sat',
                                    'sedation',
                                    'out'
                                    ))
            ->from('condition')
            ->where(array('pId' => $id, 'status < ' => 13))
            ->order_by('id', 'DESC');
            $data['condition'] = $this->db->get();
            if($data['condition']->num_rows() > 0)
            {
                $data['condition'] = $data['condition']->result_array();
                $data['isCondition'] = 1;
                $data['countCondition'] = count($data['condition']);
                $data['isData'] = 1;
            }
            else
            {
                $data['isCondition'] = 0;
                $data['condition'] = 0;
            }
            
            // load patient test
            $this->db->select(array(
                                    'na',
                                    'k',
                                    'bun',
                                    'cr',
                                    'alt',
                                    'ast',
                                    'wbc',
                                    'plt',
                                    'hb',
                                    'bs',
                                    'out'
                                    ))
            ->from('tests')
            ->where(array('pId' => $id, 'status < ' => 13))
            ->order_by('id', 'DESC');
            $data['test'] = $this->db->get();
            if($data['test']->num_rows() > 0)
            {
                $data['test'] = $data['test']->result_array();
                $data['isTest'] = 1;
                $data['countTest'] = count($data['test']);
                $data['isData'] = 1;
            }
            else
            {
                $data['isTest'] = 0;
                $data['test'] = 0;
            }
            
            // load patient organs
            $this->db->select(array(
                                    'heart',
                                    'liver',
                                    'kidneyRight',
                                    'kidneyLeft',
                                    'lungRight',
                                    'lungLeft',
                                    'pancreas',
                                    'tissue',
                                    'bowel'
                                    ))
            ->from('organs')
            ->where(array('pId' => $id, 'status < ' => 13))
            ->order_by('id', 'DESC')
            ->limit(1,0);
            $data['organ'] = $this->db->get();
            if($data['organ']->num_rows() > 0)
            {
                $data['organ'] = $data['organ']->row_array();
                $data['isOrgan'] = 1;
                $data['isData'] = 1;
            }
            else
            {
                $data['isOrgan'] = 0;
                $data['organ'] = 0;
            }
            
            // load patient log
            $where = array('patients_log.status < ' => 13, 'patients_log.pId' => $id);
            if($this->session->userdata('role') == 'OPU')
            {
                $where['patients_log.opu'] = $this->session->userdata('uid');
                $where['isTransfer'] = 0;
            }
            elseif($this->session->userdata('role') == 'INSPECTOR')
            {
                $where['patients_log.opu'] = $this->session->userdata('opuId');
                $where['isTransfer'] = 0;
            }
            $this->db->select(array(
                                    'patients_log.breathing',
                                    'patients_log.breathingDetail',
                                    'patients_log.bodyMovement',
                                    'patients_log.bodyMovementDetail',
                                    'patients_log.faceMovement',
                                    'patients_log.faceMovementDetail',
                                    'patients_log.gag',
                                    'patients_log.cough',
                                    'patients_log.cornea',
                                    'patients_log.pupil',
                                    'patients_log.dollEye',
                                    'patients_log.secondGCS',
                                    'patients_log.sedation',
                                    'patients_log.state',
                                    'patients_log.city',
                                    'patients_log.opu',
                                    'patients_log.inspector',
                                    'patients_log.hospital',
                                    'patients_log.section',
                                    'patients_log.typeOfSection',
                                    'patients_log.lastUpdateTime',
                                    'patients_log.res1'
                                    ))
            ->from('patients_log')
            ->where($where)
            ->order_by('id', 'DESC');
            $data['log'] = $this->db->get();
            if($data['log']->num_rows() > 0)
            {
                $data['isLog'] = 1;
                $data['isData'] = 1;
                $data['log'] = $data['log']->result_array();
                $data['countLog'] = count($data['log']);
                for($i = 0; $i < count($data['log']); $i++)
                {
                    $data['log'][$i]['state'] = $this->db->select('name')->from('states')->where(array('id' => $data['log'][$i]['state']))->get()->row_array();
                    $data['log'][$i]['state'] = $data['log'][$i]['state']['name'];
                    
                    $data['log'][$i]['city'] = $this->db->select('name')->from('states')->where(array('id' => $data['log'][$i]['city']))->get()->row_array();
                    $data['log'][$i]['city'] = $data['log'][$i]['city']['name'];
                    
                    $data['log'][$i]['opu'] = $this->db->select('name')->from('opu')->where(array('id' => $data['log'][$i]['opu']))->get()->row_array();
                    $data['log'][$i]['opu'] = $data['log'][$i]['opu']['name'];
                    
                    $data['log'][$i]['hospital'] = $this->db->select('name')->from('hospitals')->where(array('id' => $data['log'][$i]['hospital']))->get()->row_array();
                    $data['log'][$i]['hospital'] = $data['log'][$i]['hospital']['name'];
                    
                    $data['log'][$i]['lastUpdateTime'] = pdate('Y/m/d', $data['log'][$i]['lastUpdateTime']);
                    
                    if($data['log'][$i]['inspector'] > 0)
                    {
                        $data['log'][$i]['inspector'] = $this->db->select('name')->from('inspectors')->where(array('id' => $data['log'][$i]['inspector']))->get()->row_array();
                        $data['log'][$i]['inspector'] = $data['log'][$i]['inspector']['name'];
                    }
                    elseif($data['log'][$i]['inspector'] < 0)
                    {
                        $data['log'][$i]['inspector'] = $this->db->select('name')->from('opu')->where(array('id' => $data['log'][$i]['res1']))->get()->row_array();
                        $data['log'][$i]['inspector'] = $data['log'][$i]['inspector']['name'];
                    }
                    else
                    {
                        $data['log'][$i]['inspector'] = 'مسئول سامانه بازرسین';
                    }
                }
            }
            
            return json_encode($data);
        }
    }
    
    // delete patient
    public function change_patient_status()
    {
        if($this->input->post('pID'))
        {
            $id = $this->input->post('pID');
            $pt = $this->db->select('id')->from('patients')->where(array('status < ' => 12, 'id' => $id))->get();
            if($pt->num_rows() > 0)
            {
                $pt = $pt->row_array();
                $where = array('pId' => $id, 'status < ' => 12);
                if($this->session->userdata('ROLE') == 'OPU')
                {
                    $where['opu'] = $this->session->userdata('uid');
                }
                $ptLog = $this->db->select('id')->from('patients_log')->where($where)->limit(1,0)->get();
                if($ptLog->num_rows() > 0)
                {
                    $updateData = array('status' => 12);
                    $this->db->where(array('pId' => $id));
                    $this->db->update('patients_log', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('condition', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('tests', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('organs', $updateData);
                    
                    $this->db->where(array('id' => $id));
                    $this->db->update('patients', $updateData);
                    
                    return 1;
                }
                else
                {
                    return 2;
                }
            }
            else
            {
                return 2;
            }
        }
    }
    
    // undo delete patient
    public function change_undo_patient_status()
    {
        if($this->input->post('pID'))
        {
            $id = $this->input->post('pID');
            $pt = $this->db->select('id')->from('patients')->where(array('status' => 12, 'id' => $id))->get();
            if($pt->num_rows() > 0)
            {
                $pt = $pt->row_array();
                $where = array('pId' => $id, 'status' => 12);
                if($this->session->userdata('ROLE') == 'OPU')
                {
                    $where['opu'] = $this->session->userdata('uid');
                }
                $ptLog = $this->db->select('id')->from('patients_log')->where($where)->limit(1,0)->get();
                if($ptLog->num_rows() > 0)
                {
                    $updateData = array('status' => 1);
                    $this->db->where(array('pId' => $id));
                    $this->db->update('patients_log', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('condition', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('tests', $updateData);
                    
                    $this->db->where(array('pId' => $id));
                    $this->db->update('organs', $updateData);
                    
                    $this->db->where(array('id' => $id));
                    $this->db->update('patients', $updateData);
                    
                    return 1;
                }
                else
                {
                    return 2;
                }
            }
            else
            {
                return 2;
            }
        }
    }
    
    // verify or unverify patient transfer
    public function verify_patient_transfer()
    {
        if($this->input->post('pID') AND $this->input->post('pStatus'))
        {
            $id = $this->input->post('pID');
            $status = $this->input->post('pStatus');
            if($status == 'verify')
            {
                $pt = $this->db->select('id')->from('patients')->where(array('id' => $id, 'status' => 2))->get();
                if($pt->num_rows() > 0)
                {
                    $update = array('status' => 1);
                    $this->db->where('id', $id);
                    $this->db->update('patients', $update);
                    return 1;
                    exit;
                }
                else
                {
                    return 2;
                    exit;
                }
            }
            elseif($status == 'unVerify')
            {
                $pt = $this->db->select('id')->from('patients')->where(array('id' => $id, 'status' => 2))->get();
                if($pt->num_rows() > 0)
                {
                    $ptLog = $this->db->select('id')->from('patients_log')->where(array('isTransfer' => 0, 'status' => 1, 'pId' => $id))->get();
                    if($ptLog->num_rows() > 0)
                    {
                        $ptLog = $ptLog->row_array();
                        $this->db->delete('patients_log', array('id' => $ptLog['id']));
                        $update = array('isTransfer' => 0);
                        $this->db->where(array('isTransfer' => 1, 'status' => 1, 'pId' => $id));
                        $this->db->update('patients_log', $update);
                        
                        $update = array('status' => 1);
                        $this->db->where('id', $id);
                        $this->db->update('patients', $update);
                        return 1;
                        exit;
                    }
                    else
                    {
                        return 2;
                        exit;
                    }
                }
                else
                {
                    return 2;
                    exit;
                }
            }
        }
    }
    
    // delete hospital
    public function delete_one_hospital()
    {
        if($this->input->post('hID') AND is_numeric($this->input->post('hID')))
        {
            $id = $this->input->post('hID');
            $hos = $this->db->select('id')->from('hospitals')->where(array('id' => $id, 'status' => 1))->get();
            if($hos->num_rows() > 0)
            {
                $update = array('status' => 12);
                $this->db->where('id', $id);
                $this->db->update('hospitals', $update);
                if($this->db->affected_rows() > 0)
                {
                    return 1;
                    exit;
                }
                else
                {
                    return 2;
                    exit;
                }
            }
            else
            {
                return 2;
                exit;
            }
        }
        else
        {
            return 2;
            exit;
        }
    }
    
    // found patient result in add patient form
    public function found_patient_result()
    {
        if($this->input->post('pName') AND strlen($this->input->post('pName')) > 3)
        {
            $name = $this->input->post('pName');
            $where = array('patients.status' => 1, 'patients.isArchive' => 0);
            if($this->userauthentication_model->is_opu())
            {
                $where['pLog.opu'] = $this->session->userdata('uid');
                $data['url'] = 'opu';
            }
            elseif($this->userauthentication_model->is_inspector())
            {
                $where['pLog.opu'] = $this->session->userdata('opuId');
                $data['url'] = 'inspector';
            }
            if($this->userauthentication_model->is_admin())
            {
                $data['url'] = 'admin';
            }
            
            // query
            $this->db->select(array(
                                'patients.id', 
                                'patients.fullName', 
                                ));
            $this->db->from('patients');
            $this->db->join('patients_log AS pLog' ,'pLog.pId = patients.id AND pLog.id = (SELECT MAX(mhr_patients_log.id) FROM mhr_patients_log WHERE mhr_patients_log.pId = mhr_patients.id)');            
            $this->db->where($where);
            $this->db->like('patients.fullName', htmlCoding($this->input->post('pName')), 'both');
            $this->db->group_by('pLog.pId');
            $query = $this->db->get();
            if($query->num_rows() > 0)
            {
                $data['num_rows'] = $query->num_rows();
            }
            else
            {
                $data['num_rows'] = 0;
            }
        }
        else
        {
            $data['num_rows'] = 0;
        }
        return json_encode($data);
    }
    
    // add state and city
    public function add_state()
    {
        if($this->input->post('stName') AND strlen($this->input->post('stName')) > 1 AND is_numeric($this->input->post('pId')) AND $this->input->post('pId') >= 0)
        {
            $id = $this->input->post('pId');
            $st = htmlCoding($this->input->post('stName'));
            $data = array(
                        'name' => $st,
                        'parentID' => $id,
                        'status' => 1
                        );
            $this->db->insert('states', $data); 
            if($this->db->affected_rows() > 0)
            {
                return 1;
                exit;
            }
            else
            {
                return 2;
                exit;
            }
        }
        else
        {
            return 2;
            exit;
        }
    }
    
    // delete state or city
    public function delete_state_or_city()
    {
        if($this->input->post('sID') AND is_numeric($this->input->post('sID')) AND $this->input->post('sID') > 0)
        {
            $id = $this->input->post('sID');
            $query = $this->db->select('*')->from('states')->where(array('id' => $id, 'status' => 1))->get();
            if($query->num_rows() > 0)
            {
                $query = $query->row_array();
                if($query['parentID'] < 1)
                {
                    $data = array(
                                'status' => 0
                                );
                    $this->db->where(array('parentID' => $id));
                    $this->db->update('states', $data);
                    
                    $this->db->where(array('id' => $id));
                    $this->db->update('states', $data);
                    return 1;
                    exit;
                }
                else
                {
                    $data = array(
                                'status' => 0
                                );
                    
                    $this->db->where(array('id' => $id));
                    $this->db->update('states', $data);
                    return 1;
                    exit;
                }
            }
            else
            {
                return 2;
                exit;
            }
        }
        else
        {
            return 2;
            exit;
        }
    }
}