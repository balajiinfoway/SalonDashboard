<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Salon extends AdminController {
    var $order_column = array("name");
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->checkSessionAdmin();
        $data['pageTitle'] = "Salon";
        $data['scripts'] = "salon";
        $this->adminView('salon/index', $data);
    }
    public function fetch_data(){
        $conditions = array();

        if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != '')
        {
            $conditions['like'] = array('name' => $_POST["search"]["value"]);
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
        $fetchData = $this->CommonModel->selectData('salons',$conditions);
        $data = array();
        foreach($fetchData as $row)
        {
            $sub_array = array();
            if($row['image'])
            $sub_array[] = '<img src="'.base_url().'assets/upload/salon/'.$row['image'].'" width="60px" height="60px">';
            else
            $sub_array[] = '';

            $sub_array[] = $row['name'];
            $sub_array[] = '<button type="button" data-url="'.$this->adminURL.'salon/edit/'.$row['id'].'" name="update" id="'.$row['id'].'" class="btn btn-warning btn-xs edit-form-button">Update</button>   <button type="button" name="delete" data-url="'.$this->adminURL.'salon/delete/'.$row['id'].'" id="'.$row['id'].'" class="btn btn-danger btn-xs delete-button">Delete</button>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"             =>     isset($_POST["draw"])?intval($_POST["draw"]):'',
            "recordsTotal"     =>      $this->CommonModel->countAllResult("salons"),
            "recordsFiltered"  =>     $this->CommonModel->num_rows("salons"),
            "data"             =>     $data
       );
       echo json_encode($output);
    }
    public function create(){
        $this->loadView('salon/add');
    }

    public function add() {
        $this->checkSessionAdmin();
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('decription', 'Decription', 'trim|required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if (empty($_FILES['salonImage']['name'])){
            $this->form_validation->set_rules('salonImage', 'Image', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->errorFunction(true,validation_errors());
        } else {
            $postData = $this->input->post();
            if($_FILES["salonImage"]['name'] != ""){
                $imagename = time()."-".str_replace(" ","-",$_FILES["salonImage"]['name']);
                $this->load->library('upload');
                $this->upload->initialize(array(
                    "upload_path" => "./assets/upload/salon/",
                    "allowed_types" => "gif|jpg|png",
                    "file_name"=>$imagename,
                ));
                if (!$this->upload->do_upload("salonImage")){
                    $this->errorFunction(true,$this->upload->display_errors());
                    exit;
                }
                $records['image'] = $imagename;
            }
            $records['name'] = $postData['name'];
            $records['decription'] = $postData['decription'];
            $records['latitude'] = $postData['latitude'];
            $records['longitude'] = $postData['longitude'];
            $records['address'] = $postData['address'];
            $records['created_at'] = $this->timeStamp();
            $response = $this->CommonModel->insert("salons", $records);
            $this->errorFunction(false,"inserted record");
        }

    }

    public function edit($id = null){
        $conditions['conditions'] =array("id" => $id);
        $record =  $this->CommonModel->selectSingleRow("salons",$conditions);
        $data['record'] = $record;
        $data['id'] = $id;
        $this->loadView('salon/edit',$data);
    }

    public function update($id=null){
        $conditions =array("id" => $id);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('decription', 'Decription', 'trim|required');
        $this->form_validation->set_rules('latitude', 'Latitude', 'trim|required');
        $this->form_validation->set_rules('longitude', 'Longitude', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'required');
        if ($this->form_validation->run() == true){
            $postData = $this->input->post();
            foreach($postData as $key => $value){
                if($key !="submit"){
                    $records[$key] = $value;
                }
            }

            if($_FILES["salonImage"]['name'] != ""){
                $imagename = time()."-".str_replace(" ","-",$_FILES["salonImage"]['name']);
                $this->load->library('upload');
                $this->upload->initialize(array(
                    "upload_path" => "./assets/upload/salon/",
                    "allowed_types" => "gif|jpg|png|jpeg",
                    "file_name"=>$imagename,
                ));
                if (!$this->upload->do_upload("salonImage")){
                    $this->errorFunction(true,$this->upload->display_errors());
                    exit;
                }
                $record = $this->CommonModel->selectSingleData("salons",$conditions);
                if($record['image']!= ''){
                    $path = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['SCRIPT_NAME'])."/assets/upload/salon/".$record['image'];
                    unlink($path);
                }
                $records['image'] = $imagename;
            }
            $records['updated_at'] = $this->timeStamp();
            $response = $this->CommonModel->updateTable("salons",$conditions,$records);
            $this->errorFunction(false,"update record");
        }else{
            $this->errorFunction(true,validation_errors());
        }
    }
    public function delete($id = null){
        $conditions =array("id" => $id);
        $record = $this->CommonModel->selectSingleData("salons",$conditions);
        if($record['image']!= ''){
            $path = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['SCRIPT_NAME'])."/assets/upload/salon/".$record['image'];
            unlink($path);
        }
        $response = $this->CommonModel->delete("salons",$conditions);
        $this->errorFunction(false,"delete record");
	}
}