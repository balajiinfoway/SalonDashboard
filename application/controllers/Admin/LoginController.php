<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LoginController extends AdminController {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $data['pageTitle'] = "Login";
        $data['script'] = "Login";
        if ($this->input->post()) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() != FALSE) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $conditions['conditions'] = array('email' => $email);
                $result = $this->CommonModel->selectSingleRow('users', $conditions);
                if (count($result) <= 0) {
                    $this->setFlashData('error','Incorrect email Address');
                    redirect($this->adminURL."/Login",$data);
                } else if (password_verify($password,$result['password'])) {
                    if ($result['status'] == 1) {
                        $this->setFlashData('error','Your Account Is Inactive');
                        redirect($this->adminURL."/Login",$data);
                    } else {
                        $userRecords = $result;
                        $this->session->set_userdata($userRecords);
                        $this->session->set_userdata("is_admin", "true");
                        if (isset($redirect_url) && $redirect_url != "") {
                            redirect($redirect_url);
                        } else {
                            $this->setFlashData('success','Login Success');
                            redirect($this->adminURL."/DashboardController");
                        }
                    }
                }else{
                    $this->setFlashData('error','Incorrect Details Entered!');
                    redirect($this->adminURL."/Login",$data);
                }
            } else {
                $data['errors'] = validation_errors();
                redirect($this->adminURL."/Login",$data);
            }
        } else {
            $this->loginView('auth/singin', $data);
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        $this->session->set_flashdata('success', ("You are logout successfully"));
        redirect($this->adminURL.'Login');
    }
}