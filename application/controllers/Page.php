<?php

defined('BASEPATH') or exit('No direct script access allowed');
class page extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function not_found(){
               
        $this->load->view("page_not_found");
    }
}
