<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class UserController extends AdminController {
    public function __construct() {
        parent::__construct();
    }
    public function index() {
        $this->checkSessionAdmin();
        $data['pageTitle'] = "Users List";

        $conditions['conditions'] = array('role !=' => '0');
        $data["users"] = $this->CommonModel->selectData('mc_users',$conditions);
        $this->adminView('users/index', $data);
    }
    public function add() {
        $this->checkSessionAdmin();
        $data['pageTitle'] = "Users Register";
        if ($this->input->post()) {
            $this->form_validation->set_rules('groom_name', 'Groom Name', 'trim|required');
            $this->form_validation->set_rules('bride_name', 'Bride Name', 'trim|required');
            $this->form_validation->set_rules('marrige_date', 'Marrige Date', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[mc_users.email]');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
                $this->adminView('users/add', $data);
            } else {
                $postData = $this->input->post();
                echo $directoryName = $postData['groom_name']."-".$postData['bride_name']."-".time();
                mkdir("uploads/".$directoryName, 0755);
//                rmdir("uploads/ABCxyz1523691870");
//                echo "<pre>";
//                print_r($postData);
//                exit;

                $records['first_name'] = $postData['groom_name'];
                $records['last_name'] = $postData['bride_name'];
                $records['email'] = $postData['email'];
                $records['marrige_date'] = date('Y-m-d',strtotime($postData['marrige_date']));
                $password = md5($this->input->post('password'));
                $records['password'] = $password;
                $records['folder_name'] = "uploads/".$directoryName;
                $records['unique_id'] = $directoryName;
                $records['created_at'] = date('Y-m-d H:i:s');
                $url = base_url()."/Marriage=".$directoryName;
                $records['url'] = $url;
                $response = $this->CommonModel->insert("mc_users", $records);
                $this->session->set_flashdata('success', ('User have been added Successfully.'));
                redirect($this->adminURL."/Users");
            }
        } else {
            $this->adminView('users/add', $data);
        }
    }
    function sendMail() {
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => '', // change it to yours
            'smtp_pass' => '', // change it to yours
            'mailtype' => 'html',
            'charset' => 'iso-8859-1',
            'wordwrap' => TRUE
        );
        $message = '';
        $this->load->library('email', $config);
        $this->email->set_newline("\r\n");
        $this->email->from(''); // change it to yours
        $this->email->to(''); // change it to yours
        $this->email->subject('Resume from JobsBuddy for your Job posting');
        $this->email->message($message);
        if ($this->email->send()) {
            echo 'Email sent.';
        } else {
            show_error($this->email->print_debugger());
        }
    }
}