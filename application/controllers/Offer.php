<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Offer extends AdminController {
    var $order_column = array(null,"name", "price","discount_price");
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $this->checkSessionAdmin();
        $data['pageTitle'] = "Offer";
        $data['scripts'] = "offer";
        $this->adminView('offer/index', $data);
    }
    public function fetch_data(){
        $conditions = array();

        if(isset($_POST["search"]["value"]) && $_POST["search"]["value"] != '')
        {
            $conditions['like'] = array('name' => $_POST["search"]["value"]);
            $conditions['or_like'] = array('price' =>  $_POST["search"]["value"],'discount_price' =>  $_POST["search"]["value"]);
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
        $fetchData = $this->CommonModel->selectData('offer',$conditions);
        $data = array();
        foreach($fetchData as $row)
        {
            $sub_array = array();
            if($row['image'])
            $sub_array[] = '<img src="'.base_url().'assets/upload/offer/'.$row['image'].'" width="60px" height="60px">';
            else
            $sub_array[] = '';

            $sub_array[] = $row['name'];
            $sub_array[] = $row['price'];
            $sub_array[] = $row['discount_price'];
            $sub_array[] = $row['start_date'];
            $sub_array[] = $row['end_date'];
            $sub_array[] = '<button type="button" data-url="'.$this->adminURL.'offer/edit/'.$row['id'].'" name="update" id="'.$row['id'].'" class="btn btn-warning btn-xs edit-form-button">Update</button>   <button type="button" name="delete" data-url="'.$this->adminURL.'offer/delete/'.$row['id'].'" id="'.$row['id'].'" class="btn btn-danger btn-xs delete-button">Delete</button>';
            $data[] = $sub_array;
        }
        $output = array(
            "draw"             =>     isset($_POST["draw"])?intval($_POST["draw"]):'',
            "recordsTotal"     =>      $this->CommonModel->countAllResult("offer"),
            "recordsFiltered"  =>     $this->CommonModel->num_rows("offer"),
            "data"             =>     $data
       );
       echo json_encode($output);
    }

    public function add() {
        $this->checkSessionAdmin();
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|numeric|required');
        $this->form_validation->set_rules('discount_price', 'Discount Price', 'trim|numeric|required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        if (empty($_FILES['offerImage']['name'])){
            $this->form_validation->set_rules('offerImage', 'Document', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            $this->errorFunction(true,validation_errors());
        } else {
            $postData = $this->input->post();
            if($_FILES["offerImage"]['name'] != ""){
                $imagename = time()."-".str_replace(" ","-",$_FILES["offerImage"]['name']);
                $this->load->library('upload');
                $this->upload->initialize(array(
                    "upload_path" => "./assets/upload/offer/",
                    "allowed_types" => "gif|jpg|png",
                    "file_name"=>$imagename,
                ));
                if (!$this->upload->do_upload("offerImage")){
                    $this->errorFunction(true,$this->upload->display_errors());
                    exit;
                }
                $records['image'] = $imagename;
            }
            $records['name'] = $postData['name'];
            $records['price'] = $postData['price'];
            $records['discount_price'] = $postData['discount_price'];
            $records['start_date'] = $postData['start_date'];
            $records['start_date'] = $postData['start_date'];
            $records['end_date'] = $postData['end_date'];
            $records['created_at'] = $this->timeStamp();
            $response = $this->CommonModel->insert("offer", $records);
            $this->errorFunction(false,"inserted record");
        }

    }

    public function edit($id = null){
        $conditions['conditions'] =array("id" => $id);
        $record =  $this->CommonModel->selectSingleRow("offer",$conditions);
        $data['record'] = $record;
        $data['id'] = $id;
        $this->loadView('offer/edit',$data);
    }
    public function update($id=null){
        $conditions =array("id" => $id);
        $this->form_validation->set_rules('name', 'Name', 'trim|required');
        $this->form_validation->set_rules('price', 'Price', 'trim|numeric|required');
        $this->form_validation->set_rules('discount_price', 'Discount Price', 'trim|numeric|required');
        $this->form_validation->set_rules('start_date', 'Start Date', 'required');
        $this->form_validation->set_rules('end_date', 'End Date', 'required');
        if ($this->form_validation->run() == true){
            $postData = $this->input->post();
            foreach($postData as $key => $value){
                if($key !="submit"){
                    $records[$key] = $value;
                }
            }

            if($_FILES["offerImage"]['name'] != ""){
                $imagename = time()."-".str_replace(" ","-",$_FILES["offerImage"]['name']);
                $this->load->library('upload');
                $this->upload->initialize(array(
                    "upload_path" => "./assets/upload/offer/",
                    "allowed_types" => "gif|jpg|png|jpeg",
                    "file_name"=>$imagename,
                ));
                if (!$this->upload->do_upload("offerImage")){
                    $this->errorFunction(true,$this->upload->display_errors());
                    exit;
                }
                $record = $this->CommonModel->selectSingleData("users",$conditions);
                if($record['image']!= ''){
                    $path = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['SCRIPT_NAME'])."/assets/upload/offer/".$record['image'];
                    unlink($path);
                }
                $records['image'] = $imagename;
            }
            $records['updated_at'] = $this->timeStamp();
            $response = $this->CommonModel->updateTable("offer",$conditions,$records);
            $this->errorFunction(false,"update record");
        }else{
            $this->errorFunction(true,validation_errors());
        }
    }
    public function delete($id = null){
        $conditions =array("id" => $id);
        $record = $this->CommonModel->selectSingleData("offer",$conditions);
        if($record['image']!= ''){
            $path = $_SERVER['DOCUMENT_ROOT'].dirname($_SERVER['SCRIPT_NAME'])."/assets/upload/offer/".$record['image'];
            unlink($path);
        }
        $response = $this->CommonModel->delete("offer",$conditions);
        $this->errorFunction(false,"delete record");
	}
}