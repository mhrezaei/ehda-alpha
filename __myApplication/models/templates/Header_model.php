<?php
class Header_model extends CI_Model {

    public function __construct()
    {
        
    }
    
    public function header_data()
    {
        $data['site_title_fa'] = $this->get_options('site_title_fa');

        return $data;
    }
    
    // footer data
    public function footer_data()
    {
        
    }

    // get data from options table
    private function get_options($key)
    {
        $option = $this->db->select('value')->from('options')->where(array(
            'key' => $key,
            'status' => 1
        ))->get();
        if ($option->num_rows())
        {
            $option = $option->row_array();
            $option = $option['value'];
        }
        else
        {
            $option = false;
        }

        return $option;
    }
}