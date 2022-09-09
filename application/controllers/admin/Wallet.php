<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Wallet extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Wallet_model');
        $this->load->model('home_model');
    }

    public function index($id = '')
    {
		check_permission(60,'view');

		$staff_id = $this->session->userdata('staff_user_id');
		$data['month'] = date("m");	
	   
	   $data['from_date'] = '';
	  $data['to_date'] = '';
	   
	 
		
        if ($this->input->post()) {
			extract($this->input->post());
			
			$data['from_date'] =$from_date;
			$data['to_date'] = $to_date;
		}
		
		  if(is_admin() == 1){
				$data['staff_list'] = get_staff_list();
		   }else{
			   $data['staff_info'] = get_staff_info($staff_id);
		   }
		
		
		
		
         $data['title'] = 'Manage Wallet';
		
        $this->load->view('admin/wallet/wallet', $data);
    }


	public function settings($id = '')
    {
		
		check_permission('133,265','view');
	   $settings = $this->home_model->get_row('tblwalletsetting', array('id'=>1), '');
	   
	   $data['from'] = $settings->from;
	   $data['to'] = $settings->to;
	   
	   if ($this->input->post()) {
		extract($this->input->post());
		
           	check_permission('133,265','create');
			$success = $this->home_model->update('tblwalletsetting',array('from'=>$from,'to'=>$to),array('id'=>1));
			
            if ($success) {
                set_alert('success', _l('updated_successfully', 'Wallet Setting'));
				redirect(admin_url('wallet/settings'));
            }
          
        }
       
        $data['title'] = 'Wallet Settings';
        $this->load->view('admin/wallet/settings', $data);
    }
	
	
	public function get_wallet_details($id = ''){
		if ($this->input->post()) {
			extract($this->input->post());
			$expense_info = get_wallet_expenses($staff_id,$from_date,$to_date);
			
			$transfer_less_info = get_wallet_transfer_less($staff_id,$from_date,$to_date);
			$transfer_add_info = get_wallet_transfer_add($staff_id,$from_date,$to_date);
		
			
			$request_info = get_wallet_request($staff_id,$from_date,$to_date);	
			$staff_info = get_employee_info($staff_id);
			
			$expenses_amt = 0;
			$request_amt = 0;
			?>
			<style>
			table {
				font-family: arial, sans-serif;
				border-collapse: collapse;
				width: 100%;
			}

			td, th {
				border: 1px solid #dddddd;
				text-align: left;
				padding: 8px;
			}

			tr:nth-child(even) {
				background-color: #dddddd;
			}
			</style>
			
			<h3><?php echo $staff_info->firstname;?></h3>

			<table>
			  <tr>
				<th>Wallet ID</th>
				<th>Convenience</th>
				<th>Advance Convenience</th>
				<th>Added By</th>
				<th>Submit Date</th>
				<th>Approved Date</th>
				<th>Approved By</th>
				<th>Submit Amt</th>
				<th>Approved Amt</th>
			  </tr>
			 <?php
			 if(!empty($expense_info) || !empty($request_info) || !empty($transfer_less_info) || !empty($transfer_add_info) ){				 
				 if(!empty($expense_info)){
					 foreach($expense_info as $expense){
						 $expenses_amt += $expense->amount;
						 
						 if($expense->parent_id > 0){
							 $expense_approval  = get_expense_approval($expense->parent_id);
						 }else{
							$expense_approval  = get_expense_approval($expense->id); 
						 }
						 
						 
				
						 if($staff_id == $expense->addedfrom){
							 $added_by = 'Self';
						 }else{
							 $added_by = get_employee_fullname($expense->addedfrom);
						 }
						 
						 ?>
						  <tr>
							<td><?php echo 'WAL-CON-'.number_series($expense->id); ?></td>
							<td><?php echo get_expense_category($expense->category); ?></td>
							<td>--</td>
							<td><?php echo $added_by; ?></td>
							<td><?php if(!empty($expense_approval)){ echo date('d M, y',strtotime($expense_approval->created_at)); }else{ echo '--'; }  ?></td>
							<td><?php if(!empty($expense_approval)){ echo date('d M, y',strtotime($expense_approval->updated_at)); }else{ echo '--'; }  ?></td>
							<td><?php if(!empty($expense_approval)){ echo get_employee_fullname($expense_approval->staff_id); }else{ echo '--';}?></td>
							<td><?php echo $expense->amount;?></td>
							<td><?php echo '(+) '.$expense->amount;?></td>
						  </tr>
						 <?php
					 }
				 }
				
				 if(!empty($request_info)){
					 foreach($request_info as $request){
						 $request_amt += $request->approved_amount;
						 
						 $request_approval  = get_request_approval($request->id);
						 ?>
						  <tr>
							<td><?php echo 'WAL-ADV-'.number_series($request->id); ?></td>
							<td>--</td>
							<td><?php echo get_request_category($request->category); ?></td>
							<td><?php echo 'Self'; ?></td>
							<td><?php if(!empty($request_approval)){ echo date('d M, y',strtotime($request_approval->created_at)); }else{ echo '--'; }  ?></td>
							<td><?php if(!empty($request_approval)){ echo date('d M, y',strtotime($request_approval->updated_at)); }else{ echo '--'; }  ?></td>
							<td><?php if(!empty($request_approval)){ echo get_employee_fullname($request_approval->staff_id); }else{ echo '--';}?></td>
							<td><?php echo $request->amount;?></td>
							<td><?php echo '(-) '.$request->approved_amount;?></td>
						  </tr>
						 <?php
					 }
				 }
				 
				 
				 
				 if(!empty($transfer_add_info)){
					 foreach($transfer_add_info as $request){
						 $expenses_amt += $request->approved_amount;
						 
						
						 ?>
						  <tr>
							<td><?php echo 'WAL-TRA-'.number_series($request->request_id); ?></td>
							<td>--</td>
							<td><?php echo get_request_category($request->category); ?></td>
							<td><?php echo 'Self'; ?></td>
							<td><?php if(!empty($request)){ echo date('d M, y',strtotime($request->created_at)); }else{ echo '--'; }  ?></td>
							<td><?php if(!empty($request)){ echo date('d M, y',strtotime($request->updated_at)); }else{ echo '--'; }  ?></td>
							<td><?php if(!empty($request)){ echo get_employee_fullname($request->staff_id); }else{ echo '--';}?></td>
							<td><?php echo $request->amount;?></td>
							<td><?php echo '(+) '.$request->approved_amount;?></td>
						  </tr>
						 <?php
					 }
				 }
				 
				 
				 
				 if(!empty($transfer_less_info)){
					 foreach($transfer_less_info as $request){
						 $request_amt += $request->approved_amount;
						 
						
						 ?>
						  <tr>
							<td><?php echo 'CON-'.number_series($request->request_id); ?></td>
							<td>--</td>
							<td><?php echo get_request_category($request->category); ?></td>
							<td><?php if(!empty($request)){ echo get_employee_fullname($request->addedfrom); }else{ echo '--';}?></td>
							<td><?php if(!empty($request)){ echo date('d M, y',strtotime($request->created_at)); }else{ echo '--'; }  ?></td>
							<td><?php if(!empty($request)){ echo date('d M, y',strtotime($request->updated_at)); }else{ echo '--'; }  ?></td>
							<td><?php if(!empty($request)){ echo get_employee_fullname($request->staff_id); }else{ echo '--';}?></td>
							<td><?php echo $request->amount;?></td>
							<td><?php echo '(-) '.$request->approved_amount;?></td>
						  </tr>
						 <?php
					 }
				 }
				 $wallet_amt = ($expenses_amt - $request_amt);
				 ?>				 
				  <tr>
					<td colspan="7"></td>
					<td>Date -:  <?php if(!empty($to_date)){ echo $to_date;}else{ echo date('d/m/Y'); }?></td>
					<td><?php echo number_format($wallet_amt,2);?></td>
				  </tr>
				 <?php
				 
			 }else{
				 ?>
				 <tr>
					<td colspan="9" class="text-center">Wallet Details is Empty!</td>
				 </tr>
				 <?php
			 }
			 
			 ?>
			 
			 
			</table>

			<?php
		}
	}
}