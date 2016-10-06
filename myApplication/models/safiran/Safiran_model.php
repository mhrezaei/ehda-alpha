<?php

class safiran_model extends CI_Model
{
    private	$tName	= 'safiran_data' ;

    //=====================================================
    public function __construct()
    {

    }

    //=====================================================
    public function login($username, $password)
    {
        $user = $this->db->select(array(
            'id', 'nationalcode', 'password', 'roles'
        ))->from($this->tName)->where(array(
            'nationalcode' => $username,
            'password' => $password,
            'status' => 3
        ))->get();
        if ($user->num_rows())
        {
            $user = $user->row_array();
            $user['password'] = hashStr($user['password']);
            $data['manager'] = $user;
            $this->session->set_userdata($data);
            return true;
        }
        else
        {
            return false;
        }
    }
    //=====================================================
    public function is_manager()
    {
        $user = $this->session->userdata('manager');
        if($user)
        {
            $query = $this->db->select(array(
                'id',
                'password'
            ))->from($this->tName)->where(array(
                'id' => $user['id'],
                'status' => 3
            ))->get();
            if($query->num_rows())
            {
                $query = $query->row_array();
                if(hashStr($query['password']) == $user['password'])
                {
                    return $query['id'];
                }
                else
                {
                    $this->session->unset_userdata('manager');
                    return FALSE;
                }
            }
            else
            {
                $this->session->unset_userdata('manager');
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function log_out()
    {
        $user = $this->session->userdata('manager');
        if ($user)
        {
            $this->session->unset_userdata('manager');
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    //=====================================================
    public function selectManagerByID($id)
    {
        $query = $this->db->select()->from($this->tName)->where(array(
            'id' => $id,
            'status <' => 12
        ))->get();
        if($query->num_rows())
        {
            $query = $query->row_array();
        }
        else
        {
            $query = FALSE;
        }

        return $query;
    }

    //=====================================================
    public function managerUpdateField($id, $data)
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
    public function haveRoles($role)
    {
        $user = $this->session->userdata('manager');
        if ($user)
        {
            $user = json_decode($this->encrypt->decode($user['roles']), true);
            if(in_array($role, $user))
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else
        {
            $this->log_out();
            return false;
        }
    }
}
?>
