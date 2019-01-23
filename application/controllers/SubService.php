<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SubService extends AdminController {
    var $order_column = array("name", "price");
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->checkSessionAdmin();
        $data['pageTitle'] = "Sub Service";
        $data['scripts'] = "subservice";
        // $conditions['fields'] = "id, name";
        $services= $this->CommonModel->selectData('services');
        $data['services'] = $services;
        $this->adminView('subservice/index', $data);
    }
    public function fetch_data(){
        $conditions = array();

        if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != '')
        {
            $conditions['like'] = array('name' => $_POST["search"]["value"]);
            $conditions['or_like'] = array('price' =>  $_POST["search"]["value"]);
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
        $conditions['fields'] = "services.id as service_id, services.name as services_name, sub_services.*";
        $conditions['joins'][] = array('table'=> 'services','joinWith' => 'services.id = sub_services.service_id', 'type'=> 'LEFT');
        $fetchData = $this->CommonModel->selectData('sub_services',$conditions);

        $data = array();
        foreach($fetchData as $row)
        {
            $sub_array = array();
            $sub_array[] = $row['name'];
            $sub_array[] = $row['price'];
            // if($row['image'])
            // $sub_array[] = '<img src="'.base_url().'assets/upload/service/'.$row['image'].'" width="60px" height="60px">';
            // else
            // $sub_array[] = '';
            $sub_array[] = '<button type="button" data-url="'.$this->adminURL.'subservice/edit/'.$row['id'].'" name="update" id="'.$row['id'].'" class="btn btn-warning btn-xs edit-form-button">Update</button>   <button type="button" name="delete" data-url="'.$this->adminURL.'subservice/delete/'.$row['id'].'" id="'.$row['id'].'" class="btn btn-danger btn-xs delete-button">Delete</button>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"             =>     isset($_POST["draw"])?intval($_POST["draw"]):'',
            "recordsTotal"     =>      $this->CommonModel->countAllResult("sub_services"),
            "recordsFiltered"  =>     $this->CommonModel->num_rows("sub_services"),
            "data"             =>     $data
       );
       echo json_encode($output);
    }

    public function create(){
        $services= $this->CommonModel->selectData('services');
        $data['services'] = $services;
        $this->loadView('subservice/add', $data);
    }

    public function add() {
        $this->checkSessionAdmin();
        $this->form_validation->set_rules('service_id', 'Service', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('details', 'Details', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        // if (empty($_FILES['subServiceImage']['name'])){
        //     $this->form_validation->set_rules('subServiceImage', 'Image', 'required');
        // }
        if ($this->form_validation->run() == FALSE) {
            $this->errorFunction(true,validation_errors());
        } else {
            $postData = $this->input->post();
            // if($_FILES["subServiceImage"]['name'] != ""){
            //     $imagename = time()."-".str_replace(" ","-",$_FILES["subServiceImage"]['name']);
            //     $this->load->library('upload');
            //     $this->upload->initialize(array(
            //         "upload_path" => "./assets/upload/service/",
            //         "allowed_types" => "gif|jpg|png",
            //         "file_name"=>$imagename,
            //     ));
            //     if (!$this->upload->do_upload("subServiceImage")){
            //         $this->errorFunction(true,$this->upload->display_errors());
            //         exit;
            //     }
            //     $records['image'] = $imagename;
            // }
            foreach($postData as $key => $value){
                if($key !="submit"){
                    $records[$key] = $value;
                }
            }
            $records['created_at'] = $this->timeStamp();
            $response = $this->CommonModel->insert("sub_services", $records);
            $this->errorFunction(false,"inserted record");
        }

    }

    public function edit($id = null){
        $services= $this->CommonModel->selectData('services');
        $data['services'] = $services;
        $conditions['conditions'] =array("id" => $id);
        $record =  $this->CommonModel->selectSingleRow("sub_services",$conditions);
        $data['record'] = $record;
        $data['id'] = $id;
        $this->loadView('subservice/edit',$data);
    }
    public function update($id=null){
        $conditions =array("id" => $id);
        $this->form_validation->set_rules('service_id', 'Service', 'trim|required');
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('details', 'Details', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|required');
        if ($this->form_validation->run() == true){
            $postData = $this->input->post();
            foreach($postData as $key => $value){
                if($key !="submit"){
                    $records[$key] = $value;
                }
            }
            // if($_FILES["subServiceImage"]['name'] != ""){
            //     $imagename = time()."-".str_replace(" ","-",$_FILES["subServiceImage"]['name']);
            //     $this->load->library('upload');
            //     $this->upload->initialize(array(
            //         "upload_path" => "./assets/upload/service/",
            //         "allowed_types" => "gif|jpg|png|jpeg",
            //         "file_name"=>$imagename,
            //     ));
            //     if (!$this->upload->do_upload("subServiceImage")){
            //         $this->errorFunction(true,$this->upload->display_errors());
            //         exit;
            //     }
            //     $record = $this->CommonModel->selectSingleData("sub_services",$conditions);
            //     if($record['image']!= ''){
            //         $path = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['SCRIPT_NAME'])."/assets/upload/service/".$record['image'];
            //         unlink($path);
            //     }
            //     $records['image'] = $imagename;
            // }
            $records['updated_at'] = $this->timeStamp();
            $response = $this->CommonModel->updateTable("sub_services",$conditions,$records);
            $this->errorFunction(false,"update record");
        }else{
            $this->errorFunction(true,validation_errors());
        }
    }
    public function delete($id = null){
        $conditions =array("id" => $id);
        $record = $this->CommonModel->selectSingleData("sub_services",$conditions);
        if($record['image']!= ''){
            $path = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['SCRIPT_NAME'])."/assets/upload/zubservice/".$record['image'];
            unlink($path);
        }
        $response = $this->CommonModel->delete("sub_services",$conditions);
        $this->errorFunction(false,"delete record");
	}
}