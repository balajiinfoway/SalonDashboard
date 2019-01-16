<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class MY_Controller extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->library("pagination");
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('CommonModel');
    }
    public function loadView($fileName, $param = array()) {
        $data = $param;
        $data['menu_active'] = $this->uri->segment(1);
        $data['menu_active1'] = $this->uri->segment(2);
        // $this->load->view('common/header', $data);
        // $this->load->view($fileName, $data);
        // $this->load->view('common/footer', $data);
    }
    public function checkSession() {
        if (empty($this->session->userdata('is_login'))) {
            redirect("/");
        }
    }

}
class AdminController extends MY_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->helper('text');
        $this->load->library('form_validation');
        $this->load->library("pagination");
        $this->load->library('upload');
        $this->load->library('session');
        $this->load->model('CommonModel');
        $this->folder = "admin";
        $this->adminURL = base_url()."".$this->folder."/";
    }
    public function adminView($fileName, $param = array()) {
        $data = $param;
        $data['menu_active'] = $this->uri->segment(1);
        $data['menu_active1'] = $this->uri->segment(2);
        $data['page'] = $fileName;
        $this->load->view($this->folder.'/layouts/master', $data);
    }
    public function loginView($fileName, $param = array()) {
        $data = $param;
        $data['page'] = $fileName;
        $this->load->view($this->folder.'/layouts/guest', $data);
    }
    public function setFlashData($type, $message){
        $msg = array('type' => $type, 'message' => $message);
        $this->session->set_flashdata('message',$msg);
    }
    public function checkSessionAdmin() {
        if (empty($this->session->userdata('is_admin'))) {
            redirect("/".$this->folder.'/Login');
        }
    }

}