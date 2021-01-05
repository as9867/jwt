<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require(APPPATH.'/libraries/REST_Controller.php');
use Restserver\Libraries\REST_Controller;
class Api extends REST_Controller
{

	public function __construct()
	{
		parent::__construct();	
		$this->load->library('Authorization_Token');	
		$this->load->library('form_validation');
		$this->load->model('registration_model');
		$this->load->library('pagination'); 
		$this->load->library('upload');  

	}
  
	public function user_post()
	{  
		$array  = array('status'=>'ok','data'=>1);
		$this->response($array); 
	}
	public function record_post()
	{  
		$array  = array('status'=>'ok','data'=>'post api');
		$this->response($array); 
	}
	
	public function register_post()
	{   
		$token_data['user_id'] = 1;
		$token_data['fullname'] = 'test'; 
		$token_data['email'] = 'test@gmail.com';

		$tokenData = $this->authorization_token->generateToken($token_data);



		$final = array();
		$final['token'] = $tokenData;
		$final['status'] = 'ok';
 		 
 		$this->output
        ->set_content_type('application')
        ->set_status_header(200) // Return status
        ->set_output($tokenData);
		///$this->response($final); 
		//$this->output->set_header($tokenData);
		//$this->table_get($tokenData);



	}
	public function verify_post()
	{  
		$headers = $this->input->request_headers(); 
		
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);

		  
		if($decodedToken['status']==1){
			return true;
		}else{
			return false;
		}
	}

	public function add_post()
	{    
		$headers = $this->input->request_headers(); 
		$decodedToken = $this->authorization_token->validateToken($headers['Authorization']);
		
		if($decodedToken['status']){

		
		
		if($this->input->post()){  
			
			
			if($this->input->post()){
					
				$record['name'] = $this->input->post('userName');
				$record['email'] = $this->input->post('emailId');
				$record['phone_no'] = $this->input->post('phoneNo');
				$record['password'] = $this->input->post('password'); 
				$record['role_type'] = $this->input->post('role_type'); 
				$id = $this->input->post('id'); 
				
				
				
			    
				$response1=false;
				$response2=false;

			    if(!empty($id)){
			    	
					$response1  = $this->registration_model->updateRecord($record,$id);
				}else{

					$valid_no  = $this->registration_model->getData('student',array('phone_no'=>$record['phone_no']));
					$valid_email  = $this->registration_model->getData('student',array('email'=>$record['email']));
					if(!empty($valid_no)){
						echo "Mobile no already registered.";die;
					}
					else if(!empty($valid_email)){
						echo "Email already registered.";die;
					}
					else{
					
				   $response2  = $this->registration_model->addRecord($record);
				}

				}
				
				if($response1){
					echo "successfully updated";
				}
				else if($response2){
					echo "successfully added";
				}

				else{
					echo "Something went wrong";
				}
				
			} 
		 
		}
		$title = $data['pageType'].' Registration';
		$this->load->view('common/header',array('title'=>$title));
		$this->load->view('reg_form',$data);
		$this->load->view('common/footer');
		
	}else{
		echo "Bad Reqest";
	}
	}

	public function table_get(){
		//$headers = $this->input->request_headers(); 
		//$this->register_post();
		$token_data['user_id'] = 1;
		$token_data['fullname'] = 'test'; 
		$token_data['email'] = 'test@gmail.com';

		$tokenData = $this->authorization_token->generateToken($token_data);




		$final = array();
		$final['token'] = $tokenData;
		$final['status'] = 'ok';
 		 
 		$this->session->set_userdata($final);
		
        $param = array();
		$start = ($this->uri->segment(3)) ? ($this->uri->segment(3)-1) : 0;
		$limit = 4;
		$config['base_url'] = base_url() . '/Registration/table';
		$config['total_rows'] = $this->registration_model->getTotalRow(); 
		$config['per_page'] = $limit;
		$config["uri_segment"] = 3;

		//////////////////////////////
		$config['num_links'] = 2;
		$config['use_page_numbers'] = TRUE;
		$config['reuse_query_string'] = TRUE;
		
		$config['full_tag_open'] = '<div class="pagination sdsds">';
		$config['full_tag_close'] = '</div>';
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<button class="firstlink">';
		$config['first_tag_close'] = '</button>';
		
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<button class="lastlink">';
		$config['last_tag_close'] = '</button>';
		
		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<button class="nextlink">';
		$config['next_tag_close'] = '</button>';

		$config['prev_link'] = 'Prev Page';
		$config['prev_tag_open'] = '<button class="prevlink">';
		$config['prev_tag_close'] = '</button>';

		$config['cur_tag_open'] = '<button class="curlink">';
		$config['cur_tag_close'] = '</button>';

		$config['num_tag_open'] = '<button class="numlink">';
		$config['num_tag_close'] = '</button>';

		/////////////////////////////////////
		 
		$this->pagination->initialize($config);

		$param['userList'] =  $this->registration_model->getRecord($limit,$start); 

		foreach (json_decode(json_encode($param['userList'] ), true) as $key => $value) {
			if($value['role_type']!=$_GET['role_type']){
				unset($param['userList'][$key]);

			}
			if($value['created_at']>=$_GET['frm_date']&&$value['created_at']<=$_GET['to_date']){
				

			}else{
				unset($param['userList'][$key]);
			}

			
		}
		$param['links'] = $this->pagination->create_links();

		$this->load->view('common/header');
		$this->load->view('reg_table',$param);
		$this->load->view('common/footer'); 
	


 
}
}

