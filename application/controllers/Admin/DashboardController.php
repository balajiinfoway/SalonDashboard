<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class DashboardController extends AdminController {

    public function __construct() {
        parent::__construct();
    }

    public function index(){
        $this->checkSessionAdmin();
        $data['pageTitle'] = "Dashboard";
        $this->setFlashData('success','Login Success');
        $this->adminView('dashboard',$data);
    }

}