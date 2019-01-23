<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends AdminController {
    var $order_column = array("name", "email");
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->checkSessionAdmin();
        $data['pageTitle'] = "Users List";
        $data['scripts'] = "user";
        $this->adminView('user/index', $data);
    }
    public function fetch_data(){
        $conditions = array();
        if(isset($_POST["search"]["value"]))
        {
            $conditions['like'] = array('name' => $_POST["search"]["value"]);
            $conditions['or_like'] = array('email' =>  $_POST["search"]["value"], 'password' => $_POST["search"]["value"]);
        }
        if(isset($_POST["order"]))
        {
            $conditions['order_by'] = array("field"=>$this->order_column[$_POST['order']['0']['column']],"order"=>$_POST['order']['0']['dir']);
        }else{
            $conditions['order_by'] = array("field"=>"id","order"=>"desc");
        }
        if(isset($_POST["length"]) && $_POST["length"] != -1)
        {
            $conditions['limits'] = array("limit" => $_POST['length'],"start" => $_POST['start']);
        }
        $fetchData = $this->CommonModel->selectData('users',$conditions);
        $data = array();
        foreach($fetchData as $row)
        {
            $sub_array = array();
            $sub_array[] = $row['name'];
            $sub_array[] = $row['email'];
            $sub_array[] = '<button type="button" data-url="'.$this->adminURL.'user/edit/'.$row['id'].'" name="update" id="'.$row['id'].'" class="btn btn-warning btn-xs edit-form-button">Update</button>';
            $sub_array[] = '<button type="button" name="delete" data-url="'.$this->adminURL.'user/delete/'.$row['id'].'" id="'.$row['id'].'" class="btn btn-danger btn-xs delete-button">Delete</button>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"             =>     isset($_POST["draw"])?intval($_POST["draw"]):'',
            "recordsTotal"     =>      $this->CommonModel->countAllResult("users"),
            "recordsFiltered"  =>     $this->CommonModel->num_rows("users"),
            "data"             =>     $data
       );
       echo json_encode($output);
    }

    public function create(){
        $this->loadView('subservice/add');
    }

    public function add() {
        $this->checkSessionAdmin();
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->errorFunction(true,validation_errors());
        } else {
            $postData = $this->input->post();
            $records['name'] = $postData['name'];
            $records['email'] = $postData['email'];
            $password = password_hash($this->input->post('password'),PASSWORD_BCRYPT);
            $records['password'] = $password;
            $response = $this->CommonModel->insert("users", $records);
            $this->errorFunction(false,"inserted record");
        }

    }

    public function edit($id = null){
        $conditions['conditions'] =array("id" => $id);
        $record =  $this->CommonModel->selectSingleRow("users",$conditions);
        $data['record'] = $record;
        $data['id'] = $id;
        $this->loadView('user/edit',$data);
    }
    public function update($id=null){
        $conditions =array("id" => $id);
        $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        if ($this->form_validation->run() == true){
            $postData = $this->input->post();
            foreach($postData as $key => $value){
                if($key !="submit"){
                    $records[$key] = $value;
                }
            }
            $response = $this->CommonModel->updateTable("users",$conditions,$records);
            $this->errorFunction(false,"update record");
        }else{
            $this->errorFunction(true,validation_errors());
        }
    }
    public function delete($id = null){
		$conditions =array("id" => $id);
        $response = $this->CommonModel->delete("users",$conditions);
        $this->errorFunction(false,"delete record");
	}
}