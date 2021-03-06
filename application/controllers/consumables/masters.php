<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Masters extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('projects_model');
		$this->load->model('masters_model');
	}
	function add($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$user=$this->session->userdata('logged_in');
		$data['user_id']=$user[0]['user_id'];
		if($type=="drug_type"){
			$title="Add Drug";
		
			$config=array(
               array(
                     'field'   => 'drug_type',
                     'label'   => 'Drug Name',
                     'rules'   => 'required|trim|xss_clean'
                  ),
               array(
                     'field'   => 'description',
                     'label'   => 'Description',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
/*			$data['drug_type']=$this->masters_model->insert_data("drug_type");
			$data['divisions']=$this->masters_model->get_data("divisions");	
		*/


		}
	else if($type=="dosages"){
		 	$title="Add dosage";
		
			$config=array(
               array(
                     'field'   => 'dosage_unit',
                     'label'   => 'Dosage Name',
                     'rules'   => 'required|trim|xss_clean'
                  )
             	);
}
else if($type=="equipment_type"){
		 	$title="Add Equipment Type";
		
			$config=array(
               array(
                     'field'   => 'equipment_name',
                     'label'   => 'Equipment Name',
                     'rules'   => 'required|trim|xss_clean'
                  )
             
			);
}

else if($type=="service_records"){
		 	$title="Add Service Records";
		
			$config=array(
                         array(
                     'field'   => 'working_status',
                     'label'   =>  'Working Status',
                     'rules'   => 'required|trim|xss_clean'
                  )
        
             
             
			);
$data['user']=$this->masters_model->get_data("user");
		
}


	else if($type=="equipment"){
		 	$title="Add Equipment";
		
			$config=array(
               array(
                     'field'   => 'make',
                     'label'   => 'Make',
                     'rules'   => 'required|trim|xss_clean'
                  ),
               array(
                     'field'   => 'model',
                     'label'   => 'model',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                array(
                     'field'   => 'serial_number',
                     'label'   => 'serial_number',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                 array(
                     'field'   => 'asset_number',
                     'label'   => 'asset_number',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                  array(
                     'field'   => 'procured_by',
                     'label'   => 'procured_by',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                   array(
                     'field'   => 'cost',
                     'label'   => 'cost',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                    array(
                     'field'   => 'supplier',
                     'label'   => 'supplier',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                    array(
                     'field'   => 'supply_date',
                     'label'   => 'supply_date',
                     'rules'   => 'trim|xss_clean'
                  ),
                      array(
                     'field'   => 'warranty_period',
                     'label'   => 'warranty_period',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                       array(
                     'field'   => 'service_engineer',
                     'label'   => 'service_engineer',
                     'rules'   => 'required|trim|xss_clean'
                  ),
                        array(
                     'field'   => 'service_engineer_contact',
                     'label'   => 'service_engineer_contact',
                     'rules'   => 'required|trim|xss_clean'
                  ),
		               array(
                     'field'   => 'equipment_status',
                     'label'   => 'equipment_status',
                     'rules'   => 'required|trim|xss_clean'
                  ),
		);

        $data['equipment_types']=$this->masters_model->get_data("equipment_types");
		$data['hospital']=$this->masters_model->get_data("hospital");
		$data['department']=$this->masters_model->get_data("department");
		$data['user']=$this->masters_model->get_data("user");
		

}
	
		else if($type=="generic"){
			$title="Add Generic Details";
			$config=array(
               array(
                     'field'   => 'generic_name',
                     'label'   => 'Generic Name',
                     'rules'   => 'required|trim|xss_clean'
                  ) 	
		     
			);
			$data['item_type']=$this->masters_model->get_data("item_type");
		$data['drug_type']=$this->masters_model->get_data("drug_type");
		
		}
		else if($type=="division"){
			$title="Add Division";
			$config=array(
               array(
                     'field'   => 'division_name',
                     'label'   => 'Division Name',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);	
			$data['district']=$this->masters_model->get_data("districts");
		}
		else if($type=="grant"){
			$title="Add Grant";
			$config=array(
               array(
                     'field'   => 'grant_name',
                     'label'   => 'Grant Name',
                     'rules'   => 'required|trim|xss_clean'
                  ),
			  array(
                     'field'   => 'phase_name[]',
                     'label'   => 'Phase Name',
                     'rules'   => 'required|trim|xss_clean'
               )
			);
			$data['grant_sources']=$this->masters_model->get_data("grant_sources");
		}
		else if($type=="user"){
			$title="Add User";
			$config=array(
               array(
                     'field'   => 'user_name',
                     'label'   => 'User Name',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
		}
			
		else{
			show_404();
		}
		$page="pages/consumables/add_".$type."_form";
		$data['title']=$title;
		$this->load->view('templates/header',$data);
		$this->load->view('templates/leftnav2');
		$this->form_validation->set_rules($config);
 		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$data);
		}
		else{
				if(($this->input->post('submit'))||($this->masters_model->insert_data($type))){
					$data['msg']=" Inserted  Successfully";
					$this->load->view($page,$data);
				}
				else{
					$data['msg']="Failed";
					$this->load->view($page,$data);
				}
		}
		$this->load->view('templates/footer');
  	}	
function edit($type=""){
	 	$this->load->helper('form');
		$this->load->library('form_validation');
		$user=$this->session->userdata('logged_in');
		$data['user_id']=$user[0]['user_id'];
	if($type=="drugs"){
			$title="Edit Drugs";
			$config=array(
               array(
                     'field'   => 'drug_type',
                     'label'   => 'Drugs',
                     'rules'   => 'trim|xss_clean'
                  ),
               array(
                     'field'   => 'description',
                     'label'   => 'Description',
                     'rules'   => 'trim|xss_clean'
                  )
		
			);
$data['drug']=$this->masters_model->get_data("drugs");

		/*	$data['facility_types']=$this->masters_model->get_data("facility_types");
			$data['divisions']=$this->masters_model->get_data("divisions");	
		*/}
		else if($type=="agency"){
			$title="Edit Agency";
			$config=array(
               array(
                     'field'   => 'search_agency_name',
                     'label'   => 'Agency',
                     'rules'   => 'trim|xss_clean'
                  )
			);
			$data['agency']=$this->masters_model->get_data("agency");

		}
		else if($type=="equipment_type"){
		 	$title="Edit Equipment Type";
		
			$config=array(
               array(
                     'field'   => 'equipment_name',
                     'label'   => 'Equipment Name',
                     'rules'   => 'trim|xss_clean'
                  )
             
			);
      
$data['equipment_types']=$this->masters_model->get_data("equipment_type");

}

else if($type=="equipments"){
		 	$title="Edit Equipment Details";
		
			$config=array(
               array(
                     'field'   => 'equipment_name',
                     'label'   => 'Equipment Name ',
                     'rules'   => 'trim|xss_clean'
                  )
             

			);
if($this->input->post('select')){

$data['equipments']=$this->masters_model->get_data("equipments");
$data['equipment_type']=$this->masters_model->get_data("equipment_types");
$data['hospital']=$this->masters_model->get_data("hospital");
$data['department']=$this->masters_model->get_data("department");
$data['user']=$this->masters_model->get_data("user");
 }
}
		else if($type=="generics"){
			$title="Edit Generic";
			$config=array(
               array(
                     'field'   => 'generic_name',
                     'label'   => 'Generic',
                     'rules'   => 'trim|xss_clean'
                  )
			);
		$data['generic']=$this->masters_model->get_data("generics");
		$data['item_type']=$this->masters_model->get_data("item_type");
		$data['drug_type']=$this->masters_model->get_data("drug_type");
		
		}
		else if($type=="dosages"){
			$title="Edit Dosage";
			$config=array(
               array(
                     'field'   => 'dosage_unit',
                     'label'   => 'Dosage Unit',
                     'rules'   => 'trim|xss_clean'
                  ),
                array(
                     'field'   => 'dosage',
                     'label'   => 'Dosage',
                     'rules'   => 'trim|xss_clean'
                  )
		
			);
			$data['dosage']=$this->masters_model->get_data("dosages");
		}
		
		else if($type=="division"){
			$title="Edit Division";
			$config=array(
               array(
                     'field'   => 'search_division',
                     'label'   => 'Division',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);	
			$data['district']=$this->masters_model->get_data("districts");
			$data['divisions']=$this->masters_model->get_data("division");	
		}
		else if($type=="grant"){
			$title="Edit Grant";
			$config=array(
               array(
                     'field'   => 'grant_phase_id',
                     'label'   => 'Grant',
                     'runles'   => 'required|trim|xss_clean'
                  )
			);
			$data['grant_sources']=$this->masters_model->get_data("grant_sources");
		}
		else if($type=="user"){
			$title="Edit User";
			$config=array(
               array(
                     'field'   => 'user_id',
                     'label'   => 'Username',
                     'rules'   => 'required|trim|xss_clean'
                  )
			);
				$data['users']=$this->masters_model->get_data("user");
		}
			
		else{
			show_404();
		}
		
		$page="pages/consumables/edit_".$type."_form";
		$data['title']=$title;
		$this->load->view('templates/header',$data);
      $this->load->view('templates/leftnav2',$data);
		
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run() === FALSE)
		{
			$this->load->view($page,$data);
		}
		else{
			if($this->input->post('update')){
				if($this->masters_model->update_data($type)){
					$data['msg']="Updated Successfully";
					$this->load->view($page,$data);
				}
				else{
					$data['msg']="Failed";
					$this->load->view($page,$data);
				}
			}
			else if($this->input->post('select')){
            $data['mode']="select";
			   $data[$type]=$this->masters_model->get_data($type);
         
         	$this->load->view($page,$data);
			}
			else if($this->input->post('search')){
				$data['mode']="search";
				$data[$type]=$this->masters_model->get_data($type);
				$this->load->view($page,$data);
			}
		}
		$this->load->view('templates/footer');
	}
	
}

