<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Coming extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
	{
		echo '<h3>comin soon...</h3>';
	}
}