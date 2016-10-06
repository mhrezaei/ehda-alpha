<?php

class users_model extends CI_Model
{
	private	$tName	= 'users' ;
    private $tNameData = 'users_data';
    private $tNameForgot = 'forgot_password';

	//=====================================================
	public function __construct()
	{
		//$this->load->database() ;  // databasee in autoload.php already loaded!!!
	}

	//=====================================================
	public function isUnique_username($userName, $status = 1)
	{
		//Query...
        $query = $this->db->select('id')->from($this->tName)->where(
            array(
                'username' => $userName,
                'status' => $status
                )
        )->get();

		//Return...
		if($query->num_rows() > 0)
        {
            $query = $query->row_array();
            return $query;
        }
		else
        {
			return false;
        }

	}

	//=====================================================
	public function isUnique_nationalCode($nationalCode, $status = 1)
	{

		//Query...
		$query	= $this->db->select('*')->from($this->tName)->where(
            array(
                'nationalcode' => $nationalCode,
                'status' => $status
            )
        )->get();

		//Return...
		if($query->num_rows() > 0)
        {
            $query = $query->row_array();
            return $query;
        }
        else
        {
            return false;
        }
	}

	//=====================================================
    public function find_last_memberID()
    {
        $query = $this->db->select('memberID')->from($this->tName)->where('status <', 12)->order_by('memberID', 'DESC')->limit(1,0)->get();
        if($query->num_rows() > 0)
        {
            $query = $query->row_array();
            return $query['memberID'];
        }
        else
        {
            return FALSE;
        }
    }

	//=====================================================
    public function registerNewUser($data)
    {
        $this->db->insert($this->tName, $data);
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

	//=====================================================
    public function registerNewUserData($user_data)
    {
        $this->db->insert($this->tNameData, $user_data);
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function getOneUserByRand($rand)
    {
        if(strlen($rand) > 0)
        {
            $query = $this->db->select()->from($this->tName)->where(array(
                'hash' => $rand,
                'status <' => 12
            ))->get();
            if($query->num_rows() > 0)
            {
                $query = $query->row_array();
                $query['data'] = $this->db->select()->from($this->tNameData)->where(array(
                    'userID' => $query['id']
                ))->get();
                if($query['data']->num_rows() > 0)
                {
                    $query['data'] = $query['data']->row_array();
                }
                else
                {
                    $query['data'] = FALSE;
                }
            }
            else
            {
                $query = FALSE;
            }

            return $query;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function is_user()
    {
        $user = $this->session->userdata('user');
        if($user)
        {
            if($user['role'] == 'USER')
            {
                $query = $this->db->select(array(
                    'id',
                    'nationalcode',
                    'password'
                ))->from('users')->where(array(
                    'id' => $user['id'],
                    'status' => 1
                ))->get();
                if($query->num_rows() > 0)
                {
                    $query = $query->row_array();
                    if(hashStr($query['password']) == $user['auth'])
                    {
                        return $query;
                        exit;
                    }
                    else
                    {
                        $this->session->unset_userdata('user');
                        return FALSE;
                        exit;
                    }
                }
                else
                {
                    $this->session->unset_userdata('user');
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
        else
        {
            return FALSE;
            exit;
        }
    }

    //=====================================================
    public function log_out()
    {
        $user = $this->session->userdata('user');
        if ($user)
        {
            $this->session->unset_userdata('user');
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function selectUserByID($id)
    {
        $query = $this->db->select()->from($this->tName)->where(array(
            'id' => $id,
            'status <' => 12
        ))->get();
        if($query->num_rows() > 0)
        {
            $query = $query->row_array();
            $query['data'] = $this->db->select()->from($this->tNameData)->where(array(
                'userID' => $query['id']
            ))->get();
            if($query['data']->num_rows() > 0)
            {
                $query['data'] = $query['data']->row_array();
            }
            else
            {
                $query['data'] = FALSE;
            }
        }
        else
        {
            $query = FALSE;
        }

        return $query;

    }

    //=====================================================
    public function selectUserBy_national_or_username($username, $password)
    {
        $query = $this->db->select()->from($this->tName)->where(array(
            'status' => 1,
            'password' => $password
        ))->where('(username', $username)->or_where("nationalcode = '$username')", NULL)->get();

        if($query->num_rows() > 0)
        {
            $query = $query->row_array();
            return $query;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function userUpdateField($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->tName, $data);
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function userDataUpdateField($userID, $data)
    {
        $this->db->where('userID', $userID);
        $this->db->update($this->tNameData, $data);
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function insertNewForgotPassword($data)
    {
        $this->db->insert($this->tNameForgot, $data);
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function findForgotRequest($auth, $status = 1)
    {
        $query = $this->db->select()->from($this->tNameForgot)->where(array(
            'auth' => $auth,
            'status' => $status
        ))->get();
        if($query->num_rows() > 0)
        {
            $query = $query->row_array();
            return $query;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function forgotUpdateField($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update($this->tNameForgot, $data);
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function deleteForgotPasswordByUser($userID)
    {
        $this->db->where('userID', $userID);
        $this->db->delete($this->tNameForgot);
        if($this->db->affected_rows() > 0)
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function is_safir($auth)
    {
        $safir = $this->session->userdata('safir');
        if($safir)
        {
            if($safir['role'] == 'SAFIR')
            {
                if($safir['auth'] == hashStr($auth))
                {
                    return TRUE;
                    exit;
                }
                else
                {
                    $this->session->unset_userdata('safir');
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
} 
?>
