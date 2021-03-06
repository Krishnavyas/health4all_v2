<?php 
class Masters_model extends CI_Model{
	function __construct(){
		parent::__construct();
	}
	
	function get_data($type){
		if($type=="equipment_types"){
			
			$this->db->select("equipment_type_id,equipment_name")->from("equipment_type");
		}
		else if($type=="hospital"){
		
			$this->db->select("hospital_id,hospital")->from("hospitals");
		}
		else if($type=="department"){
			
			$this->db->select("department_id,department")->from("departments");
		}
		else if($type=="user"){
			
			$this->db->select("user_id,username")->from("users");
		}
		else if($type=="item_type"){
			$this->db->select("item_type_id,item_type")->from("item_type");
		}
		else if($type=="drug_type"){
			$this->db->select("drug_type_id,drug_type,description")->from("drug_type");
		}
		
		else if($type=="dosages"){

if($this->input->post('search')){
				
		$dosage_type=strtolower($this->input->post('dosage_name'));
			$this->db->like('LOWER(dosage)',$dosage_type,'after');
			}
	if($this->input->post('select')){
				$dosage_id=$this->input->post('dosage_id');

				$this->db->where('dosage_id',$dosage_id);
		}
	$this->db->select("dosage,dosage_id,dosage_unit")->from("dosages");
					
}
	
		else if($type=="generics"){
		
		if($this->input->post('select')){
				$generic_id=$this->input->post('generic_item_id');

				$this->db->where('generic_item_id',$generic_id);
				
}
if($this->input->post('search')){
			$generic_type=strtolower($this->input->post('generic_name'));
			$this->db->like('LOWER(generic_name)',$generic_type,'after');
			}
$this->db->select("generic_item_id,generic_name,drug_type,item_type,drug_type.drug_type_id,item_type.item_type_id")->from("generic_item")
			->join('drug_type','generic_item.drug_type_id=drug_type.drug_type_id','left')
			->join('item_type','generic_item.item_type_id=item_type.item_type_id','left')
			->order_by('generic_name');	

		
		}
else if($type=="equipments"){
		
		if($this->input->post('select')){
				$equipment_id=$this->input->post('equipment_id');

				$this->db->where('equipment_id',$equipment_id);
				
}
if($this->input->post('search')){
			$equipment=strtolower($this->input->post('equipment_name'));
			$this->db->like('LOWER(equipment_name)',$equipment,'after');
			
}
$this->db->select("equipment_id,make,serial_number,asset_number,equipment_name,equipments.equipment_id,equipments.equipment_type_id,model,procured_by,cost,supplier,supply_date,warranty_period,service_engineer,service_engineer_contact,hospital,department,username,equipment_status,hospitals.hospital_id,departments.department_id,users.user_id")->from("equipments")
			->join('equipment_type','equipments.equipment_type_id=equipment_type.equipment_type_id','left')
			->join('hospitals','equipments.hospital_id=hospitals.hospital_id','left')
			->join('departments','equipments.department_id=departments.department_id','left')
			->join('users','equipments.user_id=users.user_id','left')
			
			->order_by('equipment_name');	
		
		}

else if($type=="service"){
		
		


if($this->input->post('select')){
				$equipment_id=$this->input->post('equipment_id');

				$this->db->where('equipment_id',$equipment_id);
				
}
if($this->input->post('search')){
			$equipment=strtolower($this->input->post('equipment_name'));
			$this->db->like('LOWER(equipment_name)',$equipment,'after');

			
			
}
$this->db->select("equipment_id,make,serial_number,asset_number,equipment_name,equipments.equipment_id,equipments.equipment_type_id,model,procured_by,cost,supplier,supply_date,warranty_period,service_engineer,service_engineer_contact,hospital,department,username,equipment_status,hospitals.hospital_id,departments.department_id,users.user_id")->from("equipments")
			->join('equipment_type','equipments.equipment_type_id=equipment_type.equipment_type_id','left')
			->join('hospitals','equipments.hospital_id=hospitals.hospital_id','left')
			->join('departments','equipments.department_id=departments.department_id','left')
			->join('users','equipments.user_id=users.user_id','left')
			
			->order_by('equipment_name');	
		

		}
	
		else if($type=="equipment_type"){



	if($this->input->post('select')){
				$equipment_type_id=$this->input->post('equipment_type_id');


			$this->db->where('equipment_type_id',$equipment_type_id);
				
		}
if($this->input->post('search')){
				
            $equipment_type_id=strtolower($this->input->post('equipment_name'));
			$this->db->like('LOWER(equipment_name)',$equipment_type_id,'after');
			
}
		$this->db->select("equipment_type_id,equipment_name")->from("equipment_type")->order_by("equipment_name");
		
}
  else if($type=="drug_type"){
				if($this->input->post('search')){
				$drug_type=strtolower($this->input->post('drug_type'));
				$this->db->like('LOWER(drug_type)',$drug_type,'after');
	
				}
			if($this->input->post('select')){
					
					$drug_id=$this->input->post('drug_type_id');
					$this->db->where('drug_type_id',$drug_id);
				}
			
$this->db->select("drug_type_id,drug_type,description")->from("drug_type");	

	}		

		$query=$this->db->get();
		return $query->result();
	
}
function update_data($type){
		if($type=="facility"){
			$data = array(
					  'facility_type_id'=>$this->input->post('facility_type'),
					  'facility_name'=>$this->input->post('facility_name'),
					  'division_id'=>$this->input->post('division'),
					   'longitude'=>$this->input->post('longitude'),
					   'latitude'=>$this->input->post('latitude')
			);
			$this->db->where('facility_id',$this->input->post('facility_id'));
			$table="facilities";
		
		
	}
		else if($type=="drugs"){
			$data = array(
					  'drug_type'=>$this->input->post('drug_type'),
					  'description'=>$this->input->post('description'),
					  	
				
				);
			$this->db->where('drug_type_id',$this->input->post('drug_type_id'));
			$table="drug_type";
		
		
	}
	else if($type=="equipment_type"){
			$data = array(
					  'equipment_name'=>$this->input->post('equipment_name')
				);
			$this->db->where('equipment_type_id',$this->input->post('equipment_type_id'));
			$table="equipment_type";
		
		
	}
	else if($type=="equipments"){
			$data = array(
					  'equipment_type_id'=>$this->input->post('equipment_name'),
					  'make'=>$this->input->post('make'),	
					  'model'=>$this->input->post('model'),	
					  'serial_number'=>$this->input->post('serial_number'),	
					  'asset_number'=>$this->input->post('asset_number'),	
					  'procured_by'=>$this->input->post('procured_by'),	
					  'cost'=>$this->input->post('cost'),	
					  'supplier'=>$this->input->post('supplier'),	
					  'supply_date'=>date("Y-m-d",strtotime($this->input->post('service_date'))),
					  'warranty_period'=>$this->input->post('warranty_period'),	
					  'service_engineer'=>$this->input->post('service_engineer'),	
					  'service_engineer_contact'=>$this->input->post('service_engineer_contact'),	
					  'hospital_id'=>$this->input->post('hospital'),	
					  'department_id'=>$this->input->post('department'),	
					  'user_id'=>$this->input->post('user'),	
					  'equipment_status'=>$this->input->post('equipment_status')	
					  	
				
				);
			$this->db->where('equipment_id',$this->input->post('equipment_id'));
			$table="equipments";
		

	}


else if($type=="generics"){
			$data = array(
					  'generic_name'=>$this->input->post('generic_name'),
					  'item_type_id'=>$this->input->post('item_type'),
					   'drug_type_id'=>$this->input->post('drug_type')
					  );
			$this->db->where('generic_item_id',$this->input->post('generic_item_id'));
			$table="generic_item";
		
		
	}
else if($type=="dosages"){
			$data = array(
					  'dosage'=>$this->input->post('dosage'),
					  'dosage_unit'=>$this->input->post('dosage_unit')
					  );
			$this->db->where('dosage_id',$this->input->post('dosage_id'));
			$table="dosages";
		
		
	}


		
			$this->db->trans_start();
			$this->db->update($table,$data);
	
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
			return false;
		}
		else{
		  return true;
		}
	}
	
	function insert_data($type){
		if($type=="drug_type"){
		$data = array(
					  'drug_type'=>$this->input->post('drug_type'),
					 'description'=>$this->input->post('description')
		);

		$table="drug_type";
		}
		elseif($type=="equipment_type"){
		$data = array(
					  'equipment_name'=>$this->input->post('equipment_name')
		);

		$table="equipment_type";
		}
		
		elseif($type=="dosages"){
		$data = array(
					  'dosage_unit'=>$this->input->post('dosage_unit'),
					 'dosage'=>$this->input->post('dosage')
		);

		$table="dosages";
		}
		elseif($type=="generic"){
		$data = array(
					  'generic_name'=>$this->input->post('generic_name'),
					 'item_type_id'=>$this->input->post('item_type'),
					 'drug_type_id'=>$this->input->post('drug_type')
		);

		$table="generic_item";
		}
		elseif($type=="equipment"){
		$data = array(
					  'equipment_type_id'=>$this->input->post('equipment_type'),
					 'make'=>$this->input->post('make'),
					 'model'=>$this->input->post('model'),
					  'serial_number'=>$this->input->post('serial_number'),
					   'asset_number'=>$this->input->post('asset_number'),
					   'procured_by'=>$this->input->post('procured_by'),
					    'cost'=>$this->input->post('cost'),
					     'supplier'=>$this->input->post('supplier'),
					      'supply_date'=>date("Y-m-d",strtotime($this->input->post('supply_date'))),
					       'warranty_period'=>$this->input->post('warranty_period'),
					        'service_engineer'=>$this->input->post('service_engineer'),
					        'service_engineer_contact'=>$this->input->post('service_engineer_contact'),
					        'hospital_id'=>$this->input->post('hospital'),
					        'department_id'=>$this->input->post('department'),
		'user_id'=>$this->input->post('user'),
		'equipment_status'=>$this->input->post('equipment_status')
		
			);

		$table="equipments";
		}
	
		elseif($type=="service"){
		$data = array(
					  'equipment_type_id'=>$this->input->post('equipment_type'),
					 'make'=>$this->input->post('make'),
					 'model'=>$this->input->post('model'),
					  'serial_number'=>$this->input->post('serial_number'),
					   'asset_number'=>$this->input->post('asset_number'),
					   'procured_by'=>$this->input->post('procured_by'),
					    'cost'=>$this->input->post('cost'),
					     'supplier'=>$this->input->post('supplier'),
					      'supply_date'=>date("Y-m-d",strtotime($this->input->post('supply_date'))),
					       'warranty_period'=>$this->input->post('warranty_period'),
					        'service_engineer'=>$this->input->post('service_engineer'),
					        'service_engineer_contact'=>$this->input->post('service_engineer_contact'),
					        'hospital_id'=>$this->input->post('hospital'),
					        'department_id'=>$this->input->post('department'),
		'user_id'=>$this->input->post('user'),
		'equipment_status'=>$this->input->post('equipment_status')
		
			);

		$table="equipments";
		}
		
		elseif($type=="service_records"){
		$data = array(
					  'call_date'=>date("Y-m-d",strtotime($this->input->post('call_date'))),
					 'call_time'=>$this->input->post('call_time'),
					 'user_id'=>$this->input->post('user'),
					
					 'call_information_type'=>$this->input->post('call_information_type'),
					  'call_information'=>$this->input->post('call_information'),
					   'service_provider'=>$this->input->post('service_provider'),
					   'service_person'=>$this->input->post('service_person'),
					    'service_person_remarks'=>$this->input->post('service_person_remarks'),
					     'service_date'=>date("Y-m-d",strtotime($this->input->post('service_date'))),
					      'service_time'=>$this->input->post('service_time'),
					       'problem_status'=>$this->input->post('problem_status'),
					        'working_status'=>$this->input->post('working_status')
			);

		$table="service_records";
		}
		
		elseif($type=="equipment_type"){
		$data = array(
					  'equipment_name'=>$this->input->post('equipment_name')
		);

		$table="equipment_type";
		}
		
		
		$this->db->trans_start();
			$this->db->insert($table,$data);
		$this->db->trans_complete();
		if($this->db->trans_status()===FALSE){
			return false;
		}
		else{
		  return true;
		}	
	}

}
?>
