<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**

 *

 * 	clear cache

 *

 */

if (!function_exists('clear_cache')) {

    function clear_cache()
    {

        $CI = & get_instance();

        $CI->output->set_header('Expires: Wed, 11 Jan 1984 05:00:00 GMT');

        $CI->output->set_header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT');

        $CI->output->set_header("Cache-Control: no-cache, no-store, must-revalidate");

        $CI->output->set_header("Pragma: no-cache");

    }



}


if(!function_exists('get_lat_lng'))
{
    function get_lat_lng($address)
    {
        $CI =& get_instance();
		$user_info = $CI->session->userdata('user_info');
        // Address
		//$address = 'BTM 2nd Stage, Bengaluru, Karnataka 560076';
		$geo = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address='.urlencode($address).'&sensor=false');

		// Convert the JSON to an array

		$geo = json_decode($geo, true);

		if ($geo['status'] == 'OK') {
		   $latitude = $geo['results'][0]['geometry']['location']['lat'];
		   $longitude = $geo['results'][0]['geometry']['location']['lng'];

		   return $latitude.','.$longitude;
		}

    }
}


if(!function_exists('GetDistance'))
{
    function GetDistance($lat1, $lon1, $lat2, $lon2, $unit)
    {
		/*$rad = M_PI / 180;
    //Calculate distance from latitude and longitude
    $theta = $longitudeFrom - $longitudeTo;
    $dist = sin($latitudeFrom * $rad) * sin($latitudeTo * $rad) +  cos($latitudeFrom * $rad) * cos($latitudeTo * $rad) * cos($theta * $rad);

    return acos($dist) / $rad * 60 *  1.853;*/
	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515;
	  $unit = strtoupper($unit);

	  if ($unit == "K") {
		return number_format(($miles * 1.609344),2);
	  } else if ($unit == "N") {
		  return ($miles * 0.8684);
		} else {
			return $miles;
		  }

    }
}

if(!function_exists('is_admin'))
{
    function is_admin()
    {
		$CI =& get_instance();
		$user_id = $CI->session->userdata('staff_user_id');

		$query = $CI->db->query("SELECT * FROM `tblstaff` where `staffid`='".$user_id."'");
			if($query->num_rows()>0){
				return $query->row()->admin;
			}else{
				echo '0';
			}

    }
}


if(!function_exists('get_branch_employees'))
{
    function get_branch_employees()
    {
		$CI =& get_instance();
		$branch_id = $CI->session->userdata('staffbranch');

		if($branch_id > 0){
			$query = $CI->db->query("SELECT * FROM `tblstaff` where `admin`='0' and `active`='1' and FIND_IN_SET('".$branch_id."', branch_id)");
		}else{
			$query = $CI->db->query("SELECT * FROM `tblstaff` where `admin`='0' and `active`='1' ");
		}

		if($query->num_rows()>0){
			return $query->result();
		}

    }
}

if(!function_exists('get_last_expense'))
{
    function get_last_expense($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tblexpenses` where parent_id = '".$id."' ||  id = '".$id."'  Order by id desc LIMIT 1");

		if($query->num_rows()>0){
			return $query->result();
		}

    }
}

if(!function_exists('get_sub_expenses'))
{
    function get_sub_expenses($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tblexpenses` where parent_id = '".$id."'  Order by id asc");

		if($query->num_rows()>0){
			return $query->result();
		}

    }
}

if(!function_exists('get_expenses_ids'))
{
    function get_expenses_ids()
    {
		$ids = '';
		$CI =& get_instance();


			$query = $CI->db->query("SELECT * FROM `tblexpensesapproval` where staff_id = '".get_staff_user_id()."' and status = 1  ");

		if($query->num_rows()>0){
			$expensesapproval = $query->result();

			if(!empty($expensesapproval)){
				foreach($expensesapproval as $row){
					$ids .= $row->expense_id.',';
				}
				$ids = rtrim($ids,",");
			}

		}
		return $ids;
    }
}

if(!function_exists('get_source_thread'))
{
    function get_source_thread($id,$p_id)
    {

		$CI =& get_instance();

		if($p_id == 0){
			$parent_id = $id;
		}else{
			$parent_id = $p_id;
		}

		$query = $CI->db->query("SELECT `form_destination`,`to_destination`,`logistic_from_address`,`logistic_to_address`,`trmpo_form_destination`,`trmpo_to_destination` FROM `tblexpenses` where id = '".$parent_id."' || parent_id = '".$parent_id."' order by id asc");

		if($query->num_rows()>0){
			 return $query->result();


		}
    }
}


if(!function_exists('get_request_category'))
{
    function get_request_category($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblrequestscategories` where `id`='".$id."'");
			if($query->num_rows()>0){
				return $query->row()->name;
			}

    }
}

if(!function_exists('get_expense_category'))
{
    function get_expense_category($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblexpensescategories` where `id`='".$id."'");

			if($query->num_rows()>0){
				return $query->row()->name;
			}

    }
}

if(!function_exists('get_leave_category'))
{
    function get_leave_category($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblleavescategories` where `id`='".$id."'");
			if($query->num_rows()>0){
				return $query->row()->name;
			}

    }
}

if(!function_exists('branch_employee'))
{
    function branch_employee($branch_id,$staff_id)
    {
		$CI =& get_instance();


		$query = $CI->db->query("SELECT * FROM `tblstaff` where active = 1 and staffid !=  '".$staff_id."' and FIND_IN_SET('".$branch_id."', branch_id)");
			if($query->num_rows()>0){
				return $query->result();
			}

    }
}

if(!function_exists('get_request_status'))
{
    function get_request_status($request_id)
    {
		$html = '--';

		$CI =& get_instance();
		$staff_id = get_staff_user_id();

		$query = $CI->db->query("SELECT * FROM `tblrequests` where id =  '".$request_id."' ");
			if($query->num_rows()>0){
				$status  = $query->row()->approved_status;

				if($status == 1){
					$html = '<a href="'.admin_url('requests/request_comfirm/'.$request_id).'" class="text-success">Approved</a>';
				}elseif($status == 2){
					$html = '<a href="'.admin_url('requests/request_comfirm/'.$request_id).'" class="text-danger">Rejected</a>';
				}else{
					$html = '<a href="#" class="text-warning">Pending</a>';
				}

			}

		return $html;
    }
}


if(!function_exists('get_leave_status'))
{
    function get_leave_status($request_id)
    {
		$html = '--';

		$CI =& get_instance();
		$staff_id = get_staff_user_id();

		$query = $CI->db->query("SELECT * FROM `tblleaves` where id =  '".$request_id."' ");
			if($query->num_rows()>0){
				$status  = $query->row()->approved_status;

				if($status == 1){
					$html = '<span class="text-success">Approved</span>';
				}elseif($status == 2){
					$html = '<span class="text-danger">Rejected</span>';
				}else{
					$html = '<span class="text-warning">Pending</span>';
				}

			}

		return $html;
    }
}

if(!function_exists('sendFCM'))
{
	   function sendFCM($message, $title, $id, $page=1)
	   {
			$url = 'https://fcm.googleapis.com/fcm/send';
			$fields = array (
					'registration_ids' => array (
							$id
					),
					'data' => array (
							"page" => $page,
							"title" => $title,
							"message" => $message
					)
			);
			$fields = json_encode ( $fields );

			$headers = array (
					'Authorization: key=' . "AIzaSyArBEyEl8sFmY7jqAuW3bkXOzmmpIpquVI",
					'Content-Type: application/json'
			);

			$ch = curl_init ();
			curl_setopt ( $ch, CURLOPT_URL, $url );
			curl_setopt ( $ch, CURLOPT_POST, true );
			curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

			$result = curl_exec ( $ch );
			//return $result;
			curl_close ( $ch );
		}
}

if(!function_exists('get_staff_token'))
{
    function get_staff_token($user_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblstaff` where staffid =  '".$user_id."' ");
		if($query->num_rows()>0){
			return $query->row()->token_id;
		}

    }
}

if(!function_exists('get_month'))
{
    function get_month($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblmonths` where id =  '".$id."' ");
		if($query->num_rows()>0){
			return $query->row()->month_name;
		}

    }
}


if(!function_exists('leave_validate'))
{
    function leave_validate($user_id,$cat_id,$month,$year)
    {
		$CI =& get_instance();

		$user_info = get_staff_info($user_id);
		$paid_leave_time = $user_info->paid_leave_time;
		$joining_date = $user_info->joining_date;

		$effectiveDate = date('Y-m-d', strtotime("+".$paid_leave_time." months", strtotime($joining_date)));
		if($effectiveDate > date('Y-m-d')){
			return 0;
		}
		//$query = $CI->db->query("SELECT * FROM `tblleavesettings` where FIND_IN_SET('".$cat_id."', category_id) ");
		$query = $CI->db->query("SELECT * FROM `tblleavesettings` where category_id =  '".$cat_id."' ");
		if($query->num_rows()>0){
			$ttl_leaves = $query->row()->leave_count;
			$category_id = $query->row()->category_id;

					//$query_1 = $CI->db->query("SELECT COUNT(`id`) as ttl_count FROM tblleaves WHERE YEAR(from_date) = '".$year."' AND MONTH(from_date) = '".$month."' and addedfrom = '".$user_id."' and category IN (".$category_id.") and approved_status != '2'");
					//$query_1 = $CI->db->query("SELECT SUM(`total_days`) as ttl_count FROM tblleaves WHERE YEAR(from_date) = '".$year."' and addedfrom = '".$user_id."' and category IN (".$category_id.") and approved_status = '1'");
					$query_1 = $CI->db->query("SELECT SUM(`total_days`) as ttl_count FROM tblleaves WHERE YEAR(from_date) = '".$year."' and addedfrom = '".$user_id."' and category IN (".$category_id.") and approved_status = '1' and is_paid_leave = '1'");

					if($query_1->num_rows()>0){
						$leave_count = $query_1->row()->ttl_count;
					}else{
						$leave_count = 0;
					}

					if($ttl_leaves <=  $leave_count){
						return  0;
					}else{
						return 1;
					}

		}

    }
}

/*if(!function_exists('leave_validate_final'))
{
    function leave_validate_final($user_id,$cat_id,$month,$year,$ttl_days=0)
    {
		$CI =& get_instance();

		$user_info = get_staff_info($user_id);
		$paid_leave_time = $user_info->paid_leave_time;
		$joining_date = $user_info->joining_date;

		$effectiveDate = date('Y-m-d', strtotime("+".$paid_leave_time." months", strtotime($joining_date)));
		if($effectiveDate > date('Y-m-d')){
			return 0;
		}
		$query = $CI->db->query("SELECT * FROM `tblleavesettings` where category_id =  '".$cat_id."' ");
		if($query->num_rows()>0){
			$ttl_leaves = $query->row()->leave_count;
			$category_id = $query->row()->category_id;



			$query_1 = $CI->db->query("SELECT SUM(`total_days`) as ttl_count FROM tblleaves WHERE YEAR(from_date) = '".$year."' and addedfrom = '".$user_id."' and category IN (".$category_id.") and approved_status = '1' and is_paid_leave = '1'");

			if($query_1->num_rows()>0){
				$leave_count = $query_1->row()->ttl_count;
			}else{
				$leave_count = 0;
			}

			$f_leave_count = ($leave_count + $ttl_days);

			if($ttl_leaves <  $f_leave_count){
				return  0;
			}else{
				return 1;
			}

		}

    }
}*/


if(!function_exists('leave_validate_final'))
{
    function leave_validate_final($user_id,$cat_id,$month,$year,$ttl_days=0)
    {
		$CI =& get_instance();

		$user_info = get_staff_info($user_id);
		$paid_leave_time = $user_info->paid_leave_time;
		$joining_date = $user_info->joining_date;

		$effectiveDate = date('Y-m-d', strtotime("+".$paid_leave_time." months", strtotime($joining_date)));
		if($effectiveDate > date('Y-m-d')){
			return 0;
		}
		$query = $CI->db->query("SELECT * FROM `tblleavesettings` where category_id =  '".$cat_id."' ");
		if($query->num_rows()>0){
			$ttl_leaves = $query->row()->leave_count;
			$category_id = $query->row()->category_id;

			$date_range = staff_leave_daterange($user_id);
			$from_date = $date_range['from_date'];
			$to_date = $date_range['to_date'];


			//$query_1 = $CI->db->query("SELECT SUM(`total_days`) as ttl_count FROM tblleaves WHERE YEAR(from_date) = '".$year."' and addedfrom = '".$user_id."' and category IN (".$category_id.") and approved_status = '1' and is_paid_leave = '1'");
			$query_1 = $CI->db->query("SELECT SUM(`total_days`) as ttl_count FROM tblleaves WHERE from_date BETWEEN '".$from_date."' and '".$to_date."' and addedfrom = '".$user_id."' and category IN (".$category_id.") and approved_status = '1' and is_paid_leave = '1'");

			if($query_1->num_rows()>0){
				$leave_count = $query_1->row()->ttl_count;
			}else{
				$leave_count = 0;
			}

			$f_leave_count = ($leave_count + $ttl_days);

			if($ttl_leaves <  $f_leave_count){
				return  0;
			}else{
				return 1;
			}

		}

    }
}

if(!function_exists('get_leave_categories_by_ids'))
{
    function get_leave_categories_by_ids($ids)
    {
		$CI =& get_instance();

		$categories = '';

		$id_arr = explode(',',$ids);
		if(!empty($id_arr)){
			foreach($id_arr as $id){
				$query = $CI->db->query("SELECT * FROM `tblleavescategories` where id =  '".$id."' ");
				if($query->num_rows()>0){
					$cat_name = $query->row()->name;
					$categories .= $cat_name.' ,';
				}
			}
		}

		return rtrim($categories,",");


    }
}


if(!function_exists('get_staff_list'))
{
    function get_staff_list($branch_id = '')
    {
		$CI =& get_instance();

		if(!empty($branch_id)){
			$query = $CI->db->query("SELECT * FROM `tblstaff` where active = 1 and FIND_IN_SET('".$branch_id."', branch_id) ORDER BY firstname ASC ");
		}else{
			$query = $CI->db->query("SELECT * FROM `tblstaff` where active = 1 ORDER BY firstname ASC");
		}

		if($query->num_rows()>0){
			return $staff_info = $query->result();
		}



    }
}

if(!function_exists('get_employee_name'))
{
    function get_employee_name($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tblstaff` where staffid = '".$id."' ");

		if($query->num_rows()>0){
			return $query->row()->firstname;
		}

    }
}


if(!function_exists('get_employee_info'))
{
    function get_employee_info($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tblstaff` where staffid = '".$id."' ");

		if($query->num_rows()>0){
			return $query->row();
		}

    }
}

if(!function_exists('get_employee_fullname'))
{
    function get_employee_fullname($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tblstaff` where staffid = '".$id."' ");

		if($query->num_rows()>0){
			$row = $query->row();
			return $row->firstname.' '.$row->lastname;
		}

    }
}

if(!function_exists('get_designation'))
{
    function get_designation($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tbldesignation` where id = '".$id."' ");

		if($query->num_rows()>0){
			return $query->row()->designation;
		}

    }
}







/*if(!function_exists('get_loan_installment'))
{
    function get_loan_installment($staff_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 and paid_amount = 0 order by id asc LIMIT 1 ");

		if($query->num_rows()>0){
			$amount = $query->row()->amount;

			$id = $query->row()->id;

			$query_2 = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 and id < '".$id."' order by id asc LIMIT 1 ");
			if($query_2->num_rows()>0){

					$amount = $query_2->row()->amount;
					$paid_amount = $query_2->row()->paid_amount;

					if($paid_amount < $amount){
						$remail_amt = ($amount - $paid_amount);
						return $installment = ($remail_amt+$amount);
					}
			}else{
				return $amount;
			}
		}else{
			$query_1 = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 order by id desc LIMIT 1 ");
			if($query_1->num_rows()>0){
				$amount = $query_1->row()->amount;
				$paid_amount = $query_1->row()->paid_amount;

				if($paid_amount < $amount){
					$installment = ($amount - $paid_amount);
					return $installment;
				}
			}
		}

    }
}*/


if(!function_exists('get_loan_installment_count'))
{
    function get_loan_installment_count($staff_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 and paid_amount = 0 order by id asc LIMIT 1 ");

		if($query->num_rows()>0){
			$instalment = $query->row()->instalment;

			$id = $query->row()->id;

			$query_2 = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 and id < '".$id."' order by id asc LIMIT 1 ");
			if($query_2->num_rows()>0){

					$amount = $query_2->row()->amount;
					$paid_amount = $query_2->row()->paid_amount;
					$instalment = $query_2->row()->instalment;

					if($paid_amount < $amount){
						return $instalment;
					}
			}else{
				return $instalment;
			}
		}else{
			$query_1 = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 order by id desc LIMIT 1 ");
			if($query_1->num_rows()>0){
				$amount = $query_1->row()->amount;
				$paid_amount = $query_1->row()->paid_amount;
				$instalment = $query_1->row()->instalment;

				if($paid_amount < $amount){
					return $instalment;
				}
			}
		}

    }
}


if(!function_exists('get_ttl_loan_installment_count'))
{
    function get_ttl_loan_installment_count($staff_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 and paid_amount = 0 order by id asc LIMIT 1 ");

		if($query->num_rows()>0){
			$request_id = $query->row()->request_id;
			$querycount_1 = $CI->db->query("SELECT COUNT(`id`) as ttl_count FROM tblstaffloanlog WHERE request_id = '".$request_id."'");

			$id = $query->row()->id;

			$query_2 = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 and id < '".$id."' order by id asc LIMIT 1 ");
			if($query_2->num_rows()>0){

					$amount = $query_2->row()->amount;
					$paid_amount = $query_2->row()->paid_amount;
					$request_id = $query_2->row()->request_id;

					if($paid_amount < $amount){
						$querycount_2 = $CI->db->query("SELECT COUNT(`id`) as ttl_count FROM tblstaffloanlog WHERE request_id = '".$request_id."'");
						return $querycount_2->row()->ttl_count;
					}
			}else{
				return $querycount_1->row()->ttl_count;
			}
		}else{
			$query_1 = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 order by id desc LIMIT 1 ");
			if($query_1->num_rows()>0){
				$amount = $query_1->row()->amount;
				$paid_amount = $query_1->row()->paid_amount;
				$request_id = $query_1->row()->request_id;

				if($paid_amount < $amount){
					$querycount_3 = $CI->db->query("SELECT COUNT(`id`) as ttl_count FROM tblstaffloanlog WHERE request_id = '".$request_id."'");
					return $querycount_3->row()->ttl_count;
				}
			}
		}

    }
}


/*if(!function_exists('manage_loan_installment'))
{
    function manage_loan_installment($staff_id,$paid_amt)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 order by id asc LIMIT 1 ");

		if($query->num_rows()>0){

			$id = $query->row()->id;
			$amt = $query->row()->amount;
			$p_amt = $query->row()->paid_amount;

			if($p_amt == 0 && $amt == $paid_amt){
				$update = $CI->db->query("Update `tblstaffloanlog` set status = 1, paid_amount = '".$paid_amt."' where id = '".$id."' ");
			}else{
				$bal_amt = ($p_amt + $paid_amt);
				if($bal_amt == $amt){
					$update = $CI->db->query("Update `tblstaffloanlog` set status = 1, paid_amount = '".$bal_amt."' where id = '".$id."' ");
				}elseif($bal_amt < $amt){
					$update = $CI->db->query("Update `tblstaffloanlog` set paid_amount = '".$bal_amt."' where id = '".$id."' ");
				}elseif($bal_amt > $amt){

					$b_amt = ($amt - $p_amt);

					$update = $CI->db->query("Update `tblstaffloanlog` set status = 1, paid_amount = '".$b_amt."' where id = '".$id."' ");

					$f_bal_amt = ($paid_amt - $b_amt);

					$query_1 = $CI->db->query("SELECT * FROM `tblstaffloanlog` where staff_id = '".$staff_id."' and status = 0 and id > '".$id."' order by id asc LIMIT 1 ");
					if($query_1->num_rows()>0){
						$f_amt = $query_1->row()->amount;
						$f_id = $query_1->row()->id;

						if($f_amt == $f_bal_amt){
							$update = $CI->db->query("Update `tblstaffloanlog` set status = 1, paid_amount = '".$f_bal_amt."' where id = '".$f_id."' ");
						}elseif($f_bal_amt < $f_amt){
							$update = $CI->db->query("Update `tblstaffloanlog` set paid_amount = '".$f_bal_amt."' where id = '".$f_id."' ");
						}

					}

				}
			}

		}

    }
}*/
if(!function_exists('get_staff_advance_salary_month'))
{
	function get_staff_advance_salary_month($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT SUM(`approved_amount`) as amount FROM `tblrequests` where addedfrom = '".$id."' and confirmed_by_user = 1 and receive_status = 1 and is_taken = 0 and approved_status = 1 and category = 1 and cancel = 0 and date >= ".date('Y-m-1'));

		if($query->row()->amount==null){
			return 0;
		}
		else
		{
			return $query->row()->amount;
		}

    }
}
if(!function_exists('get_staff_advance_salary'))
{
    function get_staff_advance_salary($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT SUM(`approved_amount`) as amount FROM `tblrequests` where addedfrom = '".$id."' and confirmed_by_user = 1 and receive_status = 1 and is_taken = 0 and approved_status = 1 and category = 1 and cancel = 0");

		if($query->num_rows()>0){
			return $query->row()->amount;
		}

    }
}

if(!function_exists('get_staff_net_salary'))
{
    function get_staff_net_salary($staff_id,$month,$year)
    {
		$CI =& get_instance();
		$c_month = date('m');
		/*$c_year = date('Y');*/
		$c_day = date('d');

		if($month == $c_month){
			$query = $CI->db->query("SELECT * FROM `tblstaffattendance` where staff_id = '".$staff_id."' and status IN (1,3,4,5,6) and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' and DAY(date) <= '".$c_day."'");
		}else{
			$query = $CI->db->query("SELECT * FROM `tblstaffattendance` where staff_id = '".$staff_id."' and status IN (1,3,4,5,6) and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ");
		}

		$employee_info = get_employee_info($staff_id);
		$ttl_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
		//$ttl_days = '30';
		$day_salary = $employee_info->monthly_salary/$ttl_days;

		$halfday_salary = ($day_salary/2);

		$net_salary = 0;
		if($query->num_rows()>0){

			$result = $query->result();

			if(!empty($result)){
				foreach($result as $row){
					if($row->status == 1 || $row->status == 3 || $row->status == 6){
						$net_salary += $day_salary;
					}elseif($row->status == 4){
						$net_salary += $halfday_salary;
					}elseif($row->status == 5){

						$hourly_pay = employee_hourly_salary($staff_id);

						$extra_pay = ($hourly_pay*$row->extra_hours);

						$net_salary += ($day_salary+$extra_pay);
					}
				}
			}

		}
		return $net_salary;
    }
}



if(!function_exists('get_staff_gross_salary'))
{
    function get_staff_gross_salary($staff_id,$month,$year)
    {
		$CI =& get_instance();
		$c_month = date('m');
		/*$c_year = date('Y');*/
		$c_day = date('d');

		if($month == $c_month){
			$query = $CI->db->query("SELECT * FROM `tblstaffattendance` where staff_id = '".$staff_id."' and status IN (1,3,4,5,6) and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' and DAY(date) <= '".$c_day."'");
		}else{
			$query = $CI->db->query("SELECT * FROM `tblstaffattendance` where staff_id = '".$staff_id."' and status IN (1,3,4,5,6) and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ");
		}

		$employee_info = get_employee_info($staff_id);
		$ttl_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);
		//$ttl_days = '30';
		$day_salary = $employee_info->gross_salary/$ttl_days;

		$halfday_salary = ($day_salary/2);

		$gross_salary = 0;
		if($query->num_rows()>0){

			$result = $query->result();

			if(!empty($result)){
				foreach($result as $row){
					if($row->status == 1 || $row->status == 3 || $row->status == 6){
						$gross_salary += $day_salary;
					}elseif($row->status == 4){
						$gross_salary += $halfday_salary;
					}elseif($row->status == 5){

						$hourly_pay = employee_hourly_salary($staff_id);

						$extra_pay = ($hourly_pay*$row->extra_hours);

						$gross_salary += ($day_salary+$extra_pay);
					}
				}
			}

		}
		return $gross_salary;
    }
}


/*if(!function_exists('get_staff_gross_salary'))
{
    function get_staff_gross_salary($staff_id,$month,$year)
    {
		$CI =& get_instance();
		$c_month = date('m');
		$c_day = date('d');

		if($month == $c_month){
			$att_info = $CI->db->query("SELECT count(id) as ttl_days FROM `tblstaffattendance` where staff_id = '".$staff_id."' and status IN (1,3,4,5,6) and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' and DAY(date) <= '".$c_day."'")->row();
		}else{
			$att_info = $CI->db->query("SELECT count(id) as ttl_days FROM `tblstaffattendance` where staff_id = '".$staff_id."' and status IN (1,3,4,5,6) and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ")->row();
		}

		$employee_info = get_employee_info($staff_id);
		$ttl_days = cal_days_in_month(CAL_GREGORIAN,$month,$year);

		$day_salary = $employee_info->gross_salary/$ttl_days;


		$gross_salary = 0;

		if(!empty($att_info)){
			$gross_salary = ($day_salary*$att_info->ttl_days);
		}


		return $gross_salary;
    }
}*/

if(!function_exists('employee_hourly_salary'))
{
    function employee_hourly_salary($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tblstaff` where staffid = '".$id."' ");

		if($query->num_rows()>0){

			$time1 = strtotime($query->row()->working_from);
			$time2 = strtotime($query->row()->working_to);
			$working_hours = round(abs($time2 - $time1) / 3600,2);

			$ttl_days = '30';
			$day_salary = $query->row()->monthly_salary/$ttl_days;
			return $hour_pay = ($day_salary/$working_hours);
		}

    }
}


if(!function_exists('employee_day_salary'))
{
    function employee_day_salary($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tblstaff` where staffid = '".$id."' ");

		if($query->num_rows()>0){

			$ttl_days = '30';
			return $day_salary = $query->row()->monthly_salary/$ttl_days;
		}

    }
}

if(!function_exists('employee_working_hour'))
{
    function employee_working_hour($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tblstaff` where staffid = '".$id."' ");

		if($query->num_rows()>0){

			$time1 = strtotime($query->row()->working_from);
			$time2 = strtotime($query->row()->working_to);
			return $working_hours = round(abs($time2 - $time1) / 3600,2);

		}

    }
}


if(!function_exists('convenience_balance'))
{
    function convenience_balance($id,$month,$year)
    {
		/*$year = date('Y');*/

		$CI =& get_instance();

		//$query = $CI->db->query("SELECT paidby_employee,category,hotel_paid_by,tempo_paid_by,extra_paid_by,logistic_paid_by,amount,id FROM `tblexpenses` where (addedfrom = '".$id."' || paidby_employee = '".$id."') and is_taken = 0 and approved_status = 1 and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."'  ");
		$query = $CI->db->query("SELECT paidby_employee,category,hotel_paid_by,tempo_paid_by,extra_paid_by,logistic_paid_by,amount,id FROM `tblexpenses` where (addedfrom = '".$id."' || paidby_employee = '".$id."') and approved_status = 1 and date >= '".FROM_WALLET_DATE."'  ");

		$expenses = 0;
		$request = 0;

		//Getting Epenses
		if($query->num_rows()>0){
			$result = $query->result();

			if(!empty($result)){
			foreach($result as $row){
					if($row->category == 2 || $row->category == 4 || $row->category == 5 || $row->category == 6){

						/*if($row->tempo_paid_by == 1 || $row->hotel_paid_by == 1 || $row->extra_paid_by == 1 || $row->logistic_paid_by == 1){

							$expenses += $row->amount;
						}*/

						if($row->paidby_employee == 0 || $row->paidby_employee == $id){

							$expenses += $row->amount;
						}

					}else{
							$expenses += $row->amount;
						}
				}
			}

		}


		// Adding Transfer Amount
		//$transfer_add_amt = $CI->db->query("SELECT COALESCE(SUM(approved_amount),0) as amt from tblrequests where addedfrom = '".$id."' and is_taken = 0 and approved_status = 1 and receive_status = 1 and category = 4 and cancel = 0 and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ")->row()->amt;
		$transfer_add_amt = $CI->db->query("SELECT COALESCE(SUM(approved_amount),0) as amt from tblrequests where addedfrom = '".$id."' and approved_status = 1 and receive_status = 1 and category = 4 and cancel = 0 and date >= '".FROM_WALLET_DATE."' ")->row()->amt;

		$expenses += $transfer_add_amt;


		//Getting Request
		//$query_1 = $CI->db->query("SELECT SUM(approved_amount) as amt FROM `tblrequests` where addedfrom = '".$id."' and is_taken = 0 and approved_status = 1 and receive_status = 1 and category = 2 and cancel = 0 and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ");
		$query_1 = $CI->db->query("SELECT SUM(approved_amount) as amt FROM `tblrequests` where addedfrom = '".$id."' and approved_status = 1 and receive_status = 1 and category = 2 and cancel = 0 and date >= '".FROM_WALLET_DATE."' ");

		if($query_1->num_rows()>0){
			$request = $query_1->row()->amt;
		}

		//Less Transfer Amount
		//$transfer_less_amt = $CI->db->query("SELECT COALESCE(SUM(approved_amount),0) as amt from tblrequests where person_id = '".$id."' and is_taken = 0 and approved_status = 1 and receive_status = 1 and category = 4 and cancel = 0 and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ")->row()->amt;
		$transfer_less_amt = $CI->db->query("SELECT COALESCE(SUM(approved_amount),0) as amt from tblrequests where person_id = '".$id."' and approved_status = 1 and receive_status = 1 and category = 4 and cancel = 0 and date >= '".FROM_WALLET_DATE."' ")->row()->amt;

		$request += $transfer_less_amt;


		if($request > $expenses){
			return ($request - $expenses);
		}else{
			return 0;
		}


    }
}



if(!function_exists('update_convenience_status'))
{
    function update_convenience_status($id,$month,$year)
    {
		/*$year = date('Y');*/
		$CI =& get_instance();

		$query = $CI->db->query("SELECT paidby_employee,category,hotel_paid_by,tempo_paid_by,extra_paid_by,logistic_paid_by,amount,id FROM `tblexpenses` where (addedfrom = '".$id."' || paidby_employee = '".$id."') and is_taken = 0 and approved_status = 1 and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."'  ");


		//Updating Epenses
		if($query->num_rows()>0){
			$result = $query->result();

			if(!empty($result)){
			foreach($result as $row){

					$expense_id = $row->id;

					if($row->category == 2 || $row->category == 4 || $row->category == 5 || $row->category == 6){

						if($row->tempo_paid_by == 1 || $row->hotel_paid_by == 1 || $row->extra_paid_by == 1 || $row->logistic_paid_by == 1){

							$update = $CI->db->query("Update `tblexpenses` set is_taken = '1' where id = '".$expense_id."' ");
						}

						/*if($row->paidby_employee == 0 || $row->paidby_employee == $id){

							$update = $CI->db->query("Update `tblexpenses` set is_taken = '1' where id = '".$expense_id."' ");
						}*/

					}else{
							$update = $CI->db->query("Update `tblexpenses` set is_taken = '1' where id = '".$expense_id."' ");
						}
				}
			}

		}

		$query_1 = $CI->db->query("Update `tblrequests` set is_taken = '1' where addedfrom = '".$id."' and is_taken = 0 and approved_status = 1 and receive_status = 1 and category = 4 and cancel = 0 and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ");


		//Updating Request

		$update_request = $CI->db->query("Update `tblrequests` set is_taken = '1' where addedfrom = '".$id."' and is_taken = 0 and approved_status = 1 and category = 2 and cancel = 0 and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ");

		$query_3 = $CI->db->query("Update `tblrequests` set is_taken = '1' where person_id = '".$id."' and is_taken = 0 and approved_status = 1 and receive_status = 1 and category = 4 and cancel = 0 and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ");

    }
}

if(!function_exists('manage_advance_salary'))
{
    function manage_advance_salary($id)
    {
		$CI =& get_instance();

		$update_request = $CI->db->query("Update `tblrequests` set is_taken = '1' where addedfrom = '".$id."' and confirmed_by_user = 1 and receive_status = 1 and is_taken = 0 and approved_status = 1 and category = 1 and cancel = 0");

    }
}

if(!function_exists('get_month_attendance'))
{
    function get_month_attendance($id,$year,$month)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblstaffattendance` WHERE `staff_id` = '".$id."' AND YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ");

		if($query->num_rows()>0){
			return $query->result();
		}

    }
}


if(!function_exists('get_superscript'))
{
    function get_superscript($digit)
    {
		if($digit == 1){
			return 'st';
		}elseif($digit == 2){
			return 'nd';
		}elseif($digit == 3){
			return 'rd';
		}else{
			return 'th';
		}
	}
}


if(!function_exists('convert_number_to_words'))
{
    function convert_number_to_words($number,$currency=0)
    {

       if($currency == 1){
       		$currency_1 = 'Dollar';
       		$currency_2 = 'Cents';
       }else{
       		$currency_1 = 'Rupees';
       		$currency_2 = 'Paise';
       }

       //$number = 190908100.25;
	   $no = floor($number);
	   $point = round($number - $no, 2) * 100;
	   $hundred = null;
	   $digits_1 = strlen($no);
	   $i = 0;
	   $str = array();
	   $words = array('0' => '', '1' => 'One', '2' => 'Two',
	    '3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
	    '7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
	    '10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
	    '13' => 'Thirteen', '14' => 'fourteen',
	    '15' => 'Fifteen', '16' => 'sixteen', '17' => 'Seventeen',
	    '18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
	    '30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
	    '60' => 'Sixty', '70' => 'Seventy',
	    '80' => 'Eighty', '90' => 'Ninety');
	   $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
	   while ($i < $digits_1) {
	     $divider = ($i == 2) ? 10 : 100;
	     $number = floor($no % $divider);
	     $no = floor($no / $divider);
	     $i += ($divider == 10) ? 1 : 2;
	     if ($number) {
	        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
	        $hundred = ($counter == 1 && $str[0]) ? '  ' : null;
	        $str [] = ($number < 21) ? $words[$number] .
	            " " . $digits[$counter] . $plural . " " . $hundred
	            :
	            $words[floor($number / 10) * 10]
	            . " " . $words[$number % 10] . " "
	            . $digits[$counter] . $plural . " " . $hundred;
	     } else $str[] = null;
	  }
	  $str = array_reverse($str);
	  $result = implode('', $str);
	  $points = ($point) ?
	    "and " . $words[$point / 10] . " " .
	          $words[$point = $point % 10] : '';

	  if($points != ''){
	  	return $result .$currency_1. " " . $points . $currency_2 ." Only/-";
	  }else{
	  	return $result .$currency_1. " Only/-";
	  }

    }
}

/*if(!function_exists('convert_number_to_words'))
{
    function convert_number_to_words($number)
    {
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();

        $words = array('0' => '', '1' => 'one', '2' => 'two',
        '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
        '7' => 'seven', '8' => 'eight', '9' => 'nine',
        '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
        '13' => 'thirteen', '14' => 'fourteen',
        '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
        '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
        '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
        '60' => 'sixty', '70' => 'seventy',
        '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1)
        {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;

            if ($number)
            {
                $plural = (($counter = count($str)) && $number > 9) ? ' ' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number] .
                " " . $digits[$counter] . $plural . " " . $hundred
                :
                $words[floor($number / 10) * 10]
                . " " . $words[$number % 10] . " "
                . $digits[$counter] . $plural . " " . $hundred;


            }
            else $str[] = null;
        }

            $str = array_reverse($str);
            $result = implode('', $str);

            $points = ($point) ?
            "." . $words[$point / 10] . " " .
                  $words[$point = $point % 10] : '';

        if((isset($points)) && ($points > 0))
        {
            return ucwords($result) . "Rupees  " . ucwords($points) . " Paise Only.";
        }
        else
        {
            return ucwords($result) . "Rupees Only.";
        }
    }
}*/


if(!function_exists('get_salary_deduction'))
{
    function get_salary_deduction($id,$gross_salary)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblsalarydeduction` WHERE `status` = 1 and `role` = 1 and `id` = '".$id."' ");

		if($query->num_rows()>0){
			$row = $query->row();
			if($row->type == 1){
				$percentage = $row->rate;
				$less_amt = ($percentage / 100) * $gross_salary;

				return $less_amt;
			}else{
				return  $row->rate;
			}

		}else{
			return 0;
		}

    }
}

if(!function_exists('get_salary_earning'))
{
    function get_salary_earning($id,$gross_salary)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblsalarydeduction` WHERE `status` = 1 and `role` = 2 and `id` = '".$id."' ");

		if($query->num_rows()>0){
			$row = $query->row();
			if($row->type == 1){
				$percentage = $row->rate;
				$less_amt = ($percentage / 100) * $gross_salary;

				return $less_amt;
			}else{
				return  $row->rate;
			}

		}else{
			return 0;
		}

    }
}

if(!function_exists('salary_deduction_name'))
{
    function salary_deduction_name($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblsalarydeduction` WHERE `id` = '".$id."' ");

		if($query->num_rows()>0){

			$row = $query->row();


			/*if($row->type == 1){
				$prefix = '('.$row->rate.' %)';
			}else{
				$prefix = '(Fixed)';
			}*/



			return $row->name;


		}

    }
}

if(!function_exists('get_any_category_name'))
{
    function get_any_category_name($module_id,$category_id)
    {
		$CI =& get_instance();


		if($module_id == 1){
			$query = $CI->db->query("SELECT * FROM `tblrequestscategories` WHERE `id` = '".$category_id."' ");
		}elseif($module_id == 2){
			$query = $CI->db->query("SELECT * FROM `tblexpensescategories` WHERE `id` = '".$category_id."' ");
		}elseif($module_id == 3){
			$query = $CI->db->query("SELECT * FROM `tblleavescategories` WHERE `id` = '".$category_id."' ");
		}



		if(!empty($query)){
			if($query->num_rows()>0){

				$row = $query->row();

				return $row->name;


			}
		}else{
			return '--';
		}


    }
}


if(!function_exists('get_company_info'))
{
    function get_company_info()
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tbloptions` where name = 'invoice_company_name' || name = 'invoice_company_address'");

		if($query->num_rows()>0){
		  return $query->result();

		}

    }
}

if(!function_exists('get_request_info'))
{
    function get_request_info($requset_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblrequests` where id ='".$requset_id."' ");

		if($query->num_rows()>0){
			return $query->row();
		}

    }
}

if(!function_exists('get_expense_info'))
{
    function get_expense_info($expense_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblexpenses` where id ='".$expense_id."' ");

		if($query->num_rows()>0){
			return $query->row();
		}

    }
}

if(!function_exists('get_leave_info'))
{
    function get_leave_info($leave_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblleaves` where id ='".$leave_id."' ");

		if($query->num_rows()>0){
			return $query->row();
		}

    }
}

if(!function_exists('wallet_amount'))
{
    function wallet_amount($id,$from_date="",$to_date="")
    {
		$CI =& get_instance();

		$year = date('Y');
		$month = date('m');

		$query_2 = $CI->db->query("SELECT * FROM `tblwalletsetting` where status = 1 ");

		$form = $query_2->row()->from;
		$to = $query_2->row()->to;

		$a_date = $year.'-'.$month.'-'.$form;
		$f_date = date('Y-m-d', strtotime($a_date));


		$b_date = $year.'-'.$month.'-'.$to;
		$t_date = date('Y-m-d', strtotime($b_date));


		if(!empty($from_date) && !empty($to_date)){

			$from_date = str_replace("/","-",$from_date);
			$from_date = date("Y-m-d",strtotime($from_date));
			$to_date = str_replace("/","-",$to_date);
			$to_date = date("Y-m-d",strtotime($to_date));

			$query = $CI->db->query("SELECT category,hotel_paid_by,tempo_paid_by,extra_paid_by,logistic_paid_by,amount,id FROM `tblexpenses` where addedfrom = '".$id."' and approved_status = 1 and paidby_employee = 0 and date BETWEEN '".$from_date."' AND '".$to_date."'");

			$query_1 = $CI->db->query("SELECT category,hotel_paid_by,tempo_paid_by,extra_paid_by,logistic_paid_by,amount,id FROM `tblexpenses` where paidby_employee = '".$id."' and approved_status = 1 and date BETWEEN '".$from_date."' AND '".$to_date."'");

			$query_2 = $CI->db->query("select * from tblrequests where addedfrom = '".$id."' and receive_status = 1 and category = 4 and cancel = 0 and date BETWEEN '".$from_date."' AND '".$to_date."' ");
		}else{

			/*
			$query = $CI->db->query("SELECT category,hotel_paid_by,tempo_paid_by,extra_paid_by,logistic_paid_by,amount,id FROM `tblexpenses` where addedfrom = '".$id."' and is_taken = 0 and approved_status = 1 and paidby_employee = 0 and date BETWEEN '".$f_date."' AND '".$t_date."'");
			$query_1 = $CI->db->query("SELECT category,hotel_paid_by,tempo_paid_by,extra_paid_by,logistic_paid_by,amount,id FROM `tblexpenses` where paidby_employee = '".$id."' and is_taken = 0 and approved_status = 1 and date BETWEEN '".$f_date."' AND '".$t_date."'");
			$query_2 = $CI->db->query("select * from tblrequests where addedfrom = '".$id."' and receive_status = 1 and category = 4 and cancel = 0 and date BETWEEN '".$f_date."' AND '".$t_date."' ");
			*/

			$query = $CI->db->query("SELECT category,hotel_paid_by,tempo_paid_by,extra_paid_by,logistic_paid_by,amount,id FROM `tblexpenses` where addedfrom = '".$id."' and  approved_status = 1 and paidby_employee = 0 and date >= '".FROM_WALLET_DATE."' ");

			$query_1 = $CI->db->query("SELECT category,hotel_paid_by,tempo_paid_by,extra_paid_by,logistic_paid_by,amount,id FROM `tblexpenses` where paidby_employee = '".$id."' and approved_status = 1 and date  >= '".FROM_WALLET_DATE."' ");

			$query_2 = $CI->db->query("select * from tblrequests where addedfrom = '".$id."' and receive_status = 1 and category = 4 and cancel = 0 and date >= '".FROM_WALLET_DATE."' ");


		}


		$expenses = 0;
		$request = 0;

		//Getting Epenses
		if($query->num_rows()>0){
			$result = $query->result();

			if(!empty($result)){
			foreach($result as $row){
					if($row->category == 2 || $row->category == 4 || $row->category == 5 || $row->category == 6){

						if($row->tempo_paid_by == 1 || $row->hotel_paid_by == 1 || $row->extra_paid_by == 1 || $row->logistic_paid_by == 1){

							$expenses += $row->amount;
						}

					}else{
							$expenses += $row->amount;
						}
				}
			}

		}


		if($query_1->num_rows()>0){
			$result_1 = $query_1->result();

			if(!empty($result_1)){
			foreach($result_1 as $row){
					if($row->category == 2 || $row->category == 4 || $row->category == 5 || $row->category == 6){

						if($row->tempo_paid_by == 2 || $row->hotel_paid_by == 2 || $row->extra_paid_by == 2 || $row->logistic_paid_by == 2){

							$expenses += $row->amount;
						}

					}else{
							$expenses += $row->amount;
					}
				}
			}

		}

		//Transfer Add
		if($query_2->num_rows()>0){
			$result_2 = $query_2->result();
			if(!empty($result_2)){
			foreach($result_2 as $row){
					$expenses += $row->amount;
				}
			}
		}

		//Getting Request
		if(!empty($from_date) && !empty($to_date)){

			$from_date = str_replace("/","-",$from_date);
			$from_date = date("Y-m-d",strtotime($from_date));
			$to_date = str_replace("/","-",$to_date);
			$to_date = date("Y-m-d",strtotime($to_date));

			$query_1 = $CI->db->query("SELECT SUM(approved_amount) as amt FROM `tblrequests` where addedfrom = '".$id."' and receive_status = 1 and category = 2 and cancel = 0 and date BETWEEN '".$from_date."' AND '".$to_date."'");

			$query_3 = $CI->db->query("select * from tblrequests  where person_id = '".$id."' and receive_status = 1 and category = 4 and cancel = 0 and date BETWEEN '".$from_date."' AND '".$to_date."'");
		}else{
			/*$query_1 = $CI->db->query("SELECT SUM(approved_amount) as amt FROM `tblrequests` where addedfrom = '".$id."' and is_taken = 0 and receive_status = 1 and category = 2 and cancel = 0 and date BETWEEN '".$f_date."' AND '".$t_date."'");

			$query_3 = $CI->db->query("select * from tblrequests where person_id = '".$id."' and receive_status = 1 and category = 4 and cancel = 0 and date BETWEEN '".$f_date."' AND '".$t_date."'");*/

			$query_1 = $CI->db->query("SELECT SUM(approved_amount) as amt FROM `tblrequests` where addedfrom = '".$id."' and receive_status = 1 and category = 2 and cancel = 0 and date >= '".FROM_WALLET_DATE."' ");

			$query_3 = $CI->db->query("select * from tblrequests where person_id = '".$id."' and receive_status = 1 and category = 4 and cancel = 0 and date >= '".FROM_WALLET_DATE."' ");
		}


		if($query_1->num_rows()>0){
			$request = $query_1->row()->amt;
		}

		//Transfer Less
		if($query_3->num_rows()>0){
			$result_3 = $query_3->result();
			if(!empty($result_3)){
			foreach($result_3 as $row){
					$request += $row->amount;
				}
			}
		}



		return ($expenses - $request);
    }
}


if(!function_exists('get_wallet_expenses'))
{
    function get_wallet_expenses($id,$from_date="",$to_date="")
    {
		$CI =& get_instance();

		$year = date('Y');
		$month = date('m');

		$query_2 = $CI->db->query("SELECT * FROM `tblwalletsetting` where status = 1 ");

		$form = $query_2->row()->from;
		$to = $query_2->row()->to;

		$a_date = $year.'-'.$month.'-'.$form;
		$f_date = date('Y-m-d', strtotime($a_date));


		$b_date = $year.'-'.$month.'-'.$to;
		$t_date = date('Y-m-d', strtotime($b_date));


		if(!empty($from_date) && !empty($to_date)){

			$from_date = str_replace("/","-",$from_date);
			$from_date = date("Y-m-d",strtotime($from_date));
			$to_date = str_replace("/","-",$to_date);
			$to_date = date("Y-m-d",strtotime($to_date));



			$query = $CI->db->query("SELECT * FROM `tblexpenses` where addedfrom = '".$id."' and paidby_employee = 0 and approved_status = 1 and date BETWEEN '".$from_date."' AND '".$to_date."' ORDER by id Desc");

			$query_1 = $CI->db->query("SELECT * FROM `tblexpenses` where paidby_employee = '".$id."' and approved_status = 1 and date BETWEEN '".$from_date."' AND '".$to_date."' ORDER by id Desc");
		}else{

			/*$query = $CI->db->query("SELECT * FROM `tblexpenses` where addedfrom = '".$id."' and paidby_employee = 0  and is_taken = 0 and approved_status = 1 and date BETWEEN '".$f_date."' AND '".$t_date."' ORDER by id Desc");
			$query_1 = $CI->db->query("SELECT * FROM `tblexpenses` where paidby_employee = '".$id."' and is_taken = 0 and approved_status = 1 and date BETWEEN '".$f_date."' AND '".$t_date."' ORDER by id Desc");*/

			$query = $CI->db->query("SELECT * FROM `tblexpenses` where addedfrom = '".$id."' and paidby_employee = 0 and approved_status = 1 and date >= '".FROM_WALLET_DATE."' ORDER by id Desc");
			$query_1 = $CI->db->query("SELECT * FROM `tblexpenses` where paidby_employee = '".$id."' and approved_status = 1 and date >= '".FROM_WALLET_DATE."' ORDER by id Desc");
		}

		$retrun_arr = array();


		//Getting Epenses
		if($query->num_rows()>0){
			$result = $query->result();

			if(!empty($result)){
			foreach($result as $row){
					if($row->category == 2 || $row->category == 4 || $row->category == 5 || $row->category == 6){

						if($row->tempo_paid_by == 1 || $row->hotel_paid_by == 1 || $row->extra_paid_by == 1 || $row->logistic_paid_by == 1){

							$retrun_arr[] = $row;
						}

					}else{
							$retrun_arr[] = $row;
						}
				}
			}

		}

		if($query_1->num_rows()>0){
			$result_1 = $query_1->result();

			if(!empty($result_1)){
			foreach($result_1 as $row){
					if($row->category == 2 || $row->category == 4 || $row->category == 5 || $row->category == 6){

						if($row->tempo_paid_by == 2 || $row->hotel_paid_by == 2 || $row->extra_paid_by == 2 || $row->logistic_paid_by == 2){

							$retrun_arr[] = $row;
						}

					}else{
							$retrun_arr[] = $row;
						}
				}
			}

		}

		return $retrun_arr;

    }
}



if(!function_exists('get_wallet_request'))
{
    function get_wallet_request($id,$from_date="",$to_date="")
    {
		$CI =& get_instance();

		$year = date('Y');
		$month = date('m');

		$query_2 = $CI->db->query("SELECT * FROM `tblwalletsetting` where status = 1 ");

		$form = $query_2->row()->from;
		$to = $query_2->row()->to;

		$a_date = $year.'-'.$month.'-'.$form;
		$f_date = date('Y-m-d', strtotime($a_date));


		$b_date = $year.'-'.$month.'-'.$to;
		$t_date = date('Y-m-d', strtotime($b_date));


		//Getting Request
		if(!empty($from_date) && !empty($to_date)){

			$from_date = str_replace("/","-",$from_date);
			$from_date = date("Y-m-d",strtotime($from_date));
			$to_date = str_replace("/","-",$to_date);
			$to_date = date("Y-m-d",strtotime($to_date));

			$query_1 = $CI->db->query("SELECT * FROM `tblrequests` where addedfrom = '".$id."' and receive_status = 1 and category = 2 and cancel = 0 and date BETWEEN '".$from_date."' AND '".$to_date."' ORDER by id Desc");
		}else{
			//$query_1 = $CI->db->query("SELECT * FROM `tblrequests` where addedfrom = '".$id."' and is_taken = 0 and receive_status = 1 and category = 2 and cancel = 0 and date BETWEEN '".$f_date."' AND '".$t_date."' ORDER by id Desc");
			$query_1 = $CI->db->query("SELECT * FROM `tblrequests` where addedfrom = '".$id."' and receive_status = 1 and category = 2 and cancel = 0 and date >= '".FROM_WALLET_DATE."' ORDER by id Desc");
		}


		if($query_1->num_rows()>0){
			return $request = $query_1->result();
		}




    }
}



if(!function_exists('get_expense_approval'))
{
    function get_expense_approval($expense_id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblexpensesapproval` where expense_id = '".$expense_id."' and status = 1 and approve_status = 1 ");

		if($query_1->num_rows()>0){
			return $query_1->row();
		}

    }
}


if(!function_exists('get_request_approval'))
{
    function get_request_approval($request_id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblrequestapproval` where request_id = '".$request_id."' and status = 1 and approve_status = 1 and approved_amount > 0 ");

		if($query_1->num_rows()>0){
			return $query_1->row();
		}

    }
}

if(!function_exists('get_expense_approved_by'))
{
    function get_expense_approved_by($expense_id)
    {
		$CI =& get_instance();

		$approval_info = get_expense_approval($expense_id);
		if(!empty($approval_info)){
			$employee_name = get_employee_fullname($approval_info->staff_id);
			$html = '<p>'.$employee_name.'</p>';
			$html .= '<small>'._d($approval_info->updated_at).'</small>';
			return ($html);
		}else{
			return '--';
		}

    }
}

if(!function_exists('get_request_approved_by'))
{
    function get_request_approved_by($request_id)
    {
		$CI =& get_instance();

		$approval_info = get_request_approval($request_id);
		if(!empty($approval_info)){
			$employee_name = get_employee_fullname($approval_info->staff_id);
			$html = '<p>'.$employee_name.'</p>';
			$html .= '<small>'._d($approval_info->updated_at).'</small>';
			return ($html);
		}else{
			return '--';
		}

    }
}

if(!function_exists('get_expense_approved_remark'))
{
    function get_expense_approved_remark($expense_id)
    {
		$CI =& get_instance();

		$approval_info = get_expense_approval($expense_id);
		if(!empty($approval_info->approvereason)){
			return $approval_info->approvereason;
		}else{
			return '--';
		}

    }
}

if(!function_exists('get_request_approved_remark'))
{
    function get_request_approved_remark($request_id)
    {
		$CI =& get_instance();

		$approval_info = get_request_approval($request_id);
		if(!empty($approval_info->approvereason)){
			return $approval_info->approvereason;
		}else{
			return '--';
		}

    }
}

if(!function_exists('get_leave_approval'))
{
    function get_leave_approval($leave_id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblleaveapproval` where leave_id = '".$leave_id."' and status = 1 and approve_status = 1  ");

		if($query_1->num_rows()>0){
			return $query_1->row();
		}

    }
}


if(!function_exists('get_expense_list'))
{
    function get_expense_list($user_id,$type_id,$category_id=0,$saved_status=2)
    {
		$CI =& get_instance();

		$from_date = date('Y-m-d', strtotime(' - 30 days'));

		//$query_1 = $CI->db->query("SELECT `id`,`category`,`amount`,`date`,`related_to`,`purpose`,`approved_status`,`save_status`,`dateadded` FROM `tblexpenses` where addedfrom = '".$user_id."' and parent_id = 0 and status = 1 ORDER BY id DESC LIMIT 253");
		$where = "addedfrom = '".$user_id."' and type_id = '".$type_id."' and parent_id = 0 and status = 1 and date > '".$from_date."' ";
		if($category_id > 0){
			$where .= " and category = '".$category_id."' ";
		}
		if($saved_status != 2){
			$where .= " and save_status = '".$saved_status."' ";
		}

		$query_1 = $CI->db->query("SELECT `id`,`category`,`amount`,`date`,`related_to`,`purpose`,`approved_status`,`save_status`,`dateadded` FROM `tblexpenses` where  ".$where." ORDER BY id DESC");

		if($query_1->num_rows()>0){
			return $query_1->result();
		}

    }
}

if(!function_exists('get_expense_list_by_date'))
{
    function get_expense_list_by_date($user_id,$date)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT `id`,`category`,`amount`,`date`,`related_to`,`purpose`,`approved_status`,`save_status`,`dateadded`,`type_id`,`typesub_id`,`head_id` FROM `tblexpenses` where addedfrom = '".$user_id."' and parent_id = 0 and status = 1 and date = '".$date."' and approved_status = 0  ORDER BY id DESC");

		if($query_1->num_rows()>0){
			return $query_1->result();
		}

    }
}

if(!function_exists('get_single_expense'))
{
    function get_single_expense($id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT `dateadded`,`addedfrom`,`id`,`category`,`amount`,`date`,`related_to`,`purpose`,`approved_status`,`note`,`type_id`,`typesub_id`,`head_id` FROM `tblexpenses` where id = '".$id."' ");

		if($query_1->num_rows()>0){
			return $query_1->row();
		}

    }
}


if(!function_exists('get_city'))
{
    function get_city($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblcities` where id = '".$id."' ");

		if($query->num_rows()>0){
			$row = $query->row();
			return $row->name;
		}

    }
}

if(!function_exists('get_state'))
{
    function get_state($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblstates` where id = '".$id."' ");

		if($query->num_rows()>0){
			$row = $query->row();
			return $row->name;
		}

    }
}


if(!function_exists('get_product_component'))
{
    function get_product_component($id)
    {
		$CI =& get_instance();
		$product_component = '';
		$query = $CI->db->query("SELECT * FROM `tblproductcomponentrawmaterial` where id = '".$id."' ");

		if($query->num_rows()>0){
			$row = $query->row();
			if($row->type == 1){
				$query_1 = $CI->db->query("SELECT * FROM `tblcomponents` where id = '".$row->component."' ");
				if($query_1->num_rows()>0){
					$row_1 = $query_1->row();
					$product_component = $row_1->name;
				}
			}else{
				$query_1 = $CI->db->query("SELECT * FROM `tblproducts` where id = '".$row->product."' ");
				if($query_1->num_rows()>0){
					$row_1 = $query_1->row();
					$product_component = $row_1->name;
				}
			}
		}

		return $product_component;

    }
}


if(!function_exists('get_component'))
{
    function get_component($component = 0)
    {
		$CI =& get_instance();

		$cmpo_str = '0';

		if(!empty($component)){

			$query = $CI->db->query("SELECT * FROM `tblproductcomponentrawmaterial` where status = '1' and component != '".$component."'  ");
		}else{
			$query = $CI->db->query("SELECT * FROM `tblproductcomponentrawmaterial` where status = '1' ");
		}


		if($query->num_rows()>0){
			$info = $query->result();

			if(!empty($info)){
				$i = 1;
				foreach($info as $row){
					if($i == 1){
						$cmpo_str .= $row->component;
					}else{
						$cmpo_str .= ','.$row->component;
					}

					$i++;
				}





			}
		}

		$query_1 = $CI->db->query("SELECT id,name FROM `tblcomponents` where status = '1'  and id NOT IN (".$cmpo_str.")");
					if($query_1->num_rows()>0){
						return $query_1->result();
					}

		/*$query_1 = $CI->db->query("SELECT * FROM `tblcomponents` where status = '1'  ");
			if($query_1->num_rows()>0){
				return $query_1->result();
			}*/

    }
}



if(!function_exists('get_product_by_cat_id'))
{
    function get_product_by_cat_id($category_id, $product = 0)
    {
		$CI =& get_instance();

		$cmpo_str = '0';

		if(!empty($product)){
			$tes = "SELECT * FROM `tblproductcomponentrawmaterial` where status = '1' and product != '".$product."'  ";
			$query = $CI->db->query("SELECT * FROM `tblproductcomponentrawmaterial` where status = '1' and product != '".$product."'  ");
		}else{
			$tes = "SELECT * FROM `tblproductcomponentrawmaterial` where status = '1' ";
			$query = $CI->db->query("SELECT * FROM `tblproductcomponentrawmaterial` where status = '1' ");
		}


		if($query->num_rows()>0){
			$info = $query->result();

			if(!empty($info)){
				$i = 1;
				foreach($info as $row){
					if($i == 1){
						$cmpo_str .= $row->product;

					}else{
						$cmpo_str .= ','.$row->product;
					}

					$i++;
				}


			}
		}

		$query_1 = $CI->db->query("SELECT id,name FROM `tblproducts` where status = '1' and product_cat_id = '".$category_id."'  and id NOT IN (".$cmpo_str.")");
		if($query_1->num_rows()>0){
			return $query_1->result_array();
		}

		/*$query_1 = $CI->db->query("SELECT * FROM `tblcomponents` where status = '1'  ");
			if($query_1->num_rows()>0){
				return $query_1->result();
			}*/

    }
}

if(!function_exists('get_staff_mail_setting'))
{
    function get_staff_mail_setting($id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblstaffemailsettings` where staff_id = '".$id."' ");

		if($query_1->num_rows()>0){
			return $query_1->row_array();
		}

    }
}

if(!function_exists('get_staffemail'))
{
    function get_staffemail($field)
    {
		$CI =& get_instance();
		$user_id = $CI->session->userdata('staff_user_id');

		$query_1 = $CI->db->query("SELECT $field FROM `tblstaffemailsettings` where staff_id = '".$user_id."' ");

		if($query_1->num_rows()>0){
			return $query_1->row()->$field;
		}else{
			return get_option($field);
		}

    }
}


/*if(!function_exists('get_staff_group'))
{
    function get_staff_group($id = '')
    {
		$CI =& get_instance();

		if(!empty($id)){
			$query = $CI->db->query("SELECT * FROM `tblstaffgroup` where status = 1 and FIND_IN_SET('".$id."', multiselect_id) ");
		}else{
			$query = $CI->db->query("SELECT * FROM `tblstaffgroup` where status = 1 ");
		}

		if($query->num_rows()>0){
			return $query->result_array();
		}



    }
}*/

if(!function_exists('get_staff_group'))
{
    function get_staff_group($id,$user_id='')
    {
		$CI =& get_instance();

		$employee_info = get_employee_info($user_id);

		if((!empty($id)) && (!empty($employee_info->employee_group))){
			$query = $CI->db->query("SELECT * FROM `tblstaffgroup` where status = 1 and FIND_IN_SET('".$id."', multiselect_id)  and id IN (".$employee_info->employee_group.") ");

			if($query->num_rows()>0){
				return $query->result_array();
			}
		}


    }
}

if(!function_exists('number_series'))
{
    function number_series($num)
    {
		//return sprintf("%'.06d\n", $num);
		return sprintf("%'.06d", $num);

    }
}

if(!function_exists('product_code'))
{
    function product_code($id)
    {
		return ' (PRO-'.$id.')';

    }
}
if(!function_exists('temp_product_code'))
{
    function temp_product_code($id)
    {
		return ' (TEMP-PRO-'.$id.')';

    }
}

if(!function_exists('get_short'))
{
    function get_short($word)
    {
		return $str = strtoupper(substr($word, 0, 3));

    }
}

if(!function_exists('get_last'))
{
    function get_last($word)
    {
		$arr = explode(' ',$word);
		if(!empty($arr[1])){
			return $arr[1];
		}else{
			return $word;
		}


    }
}


if(!function_exists('get_expense_attachment'))
{
    function get_expense_attachment($id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblfiles` where rel_id = '".$id."' and rel_type = 'expense' ");

		if($query_1->num_rows()>0){
			return $query_1->result();
		}

    }
}

if(!function_exists('get_staff_info'))
{
    function get_staff_info($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tblstaff` where staffid = '".$id."' ");

		if($query->num_rows()>0){
			return $row = $query->row();
		}

    }
}


if(!function_exists('get_branch'))
{
    function get_branch($id)
    {
		$branch_str = get_staff_info($id)->branch_id;

		$CI =& get_instance();

		$branch_arr = explode(' ',$branch_str);
		if(!empty($branch_str)){
			$query = $CI->db->query("SELECT * FROM `tblcompanybranch` where id = '".$branch_str[0]."' ");
			if($query->num_rows()>0){
				return $query->row()->comp_branch_name;
			}else{
				return '--';
			}
		}else{
			return '--';
		}

	}
}



/* For Expense Print Fomrat */



if(!function_exists('get_expense_by_date'))
{
    function get_expense_by_date($id,$from_date="",$to_date="")
    {
		$CI =& get_instance();

		$from_date = str_replace("/","-",$from_date);
		$from_date = date("Y-m-d",strtotime($from_date));
		$to_date = str_replace("/","-",$to_date);
		$to_date = date("Y-m-d",strtotime($to_date));

		//$query_1 = $CI->db->query("SELECT * FROM `tblexpenses` where addedfrom = '".$id."' and approved_status = 1 and category = 2 and cancel = 0 and date BETWEEN '".$from_date."' AND '".$to_date."'");

		$query_1 = $CI->db->query("SELECT * FROM `tblexpenses` where addedfrom = '".$id."' and approved_status = 1 and parent_id = 0 and date BETWEEN '".$from_date."' AND '".$to_date."' GROUP by date");

		if($query_1->num_rows()>0){
			return $query_1->result();
		}




    }
}


if(!function_exists('expense_request_count'))
{
    function expense_request_count($id,$date="")
    {
		$CI =& get_instance();


		//$query_1 = $CI->db->query("SELECT * FROM `tblexpenses` where addedfrom = '".$id."' and approved_status = 1 and category = 2 and cancel = 0 and date BETWEEN '".$from_date."' AND '".$to_date."'");

		$query_1 = $CI->db->query("SELECT COUNT(id) as ttl_row FROM `tblexpenses` where addedfrom = '".$id."' and approved_status = 1 and date = '".$date."' ");

		$query_2 = $CI->db->query("SELECT COUNT(id) as ttl_row FROM `tblrequests` where addedfrom = '".$id."' and approved_status = 1 and category = 2 and cancel = 0 and date = '".$date."' ");

		$expense_count = $query_1->row()->ttl_row;

		$request_count = $query_2->row()->ttl_row;

		return ($expense_count + $request_count);

    }
}


if(!function_exists('get_expense'))
{
    function get_expense($id,$date="")
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblexpenses` where (addedfrom = '".$id."' || paidby_employee = '".$id."')  and parent_id = 0 and approved_status = 1 and date = '".$date."' ");

		if($query_1->num_rows()>0){
			return $query_1->result();
		}

    }
}

if(!function_exists('get_request'))
{
    function get_request($id,$date="")
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblrequests` where addedfrom = '".$id."' and approved_status = 1 and receive_status = 1 and category = 2 and cancel = 0 and date = '".$date."' ");

		if($query_1->num_rows()>0){
			return $query_1->result();
		}

    }
}

if(!function_exists('get_expense_by_parent'))
{
    function get_expense_by_parent($id)
    {

		$CI =& get_instance();


		//$query = $CI->db->query("SELECT * FROM `tblexpenses` where id = '".$id."' || parent_id = '".$id."' order by id asc");
		$query = $CI->db->query("SELECT * FROM `tblexpenses` where parent_id = '".$id."' order by id asc");

		if($query->num_rows()>0){
			 return $query->result();


		}
    }
}


if(!function_exists('get_expense_purpose'))
{
    function get_expense_purpose($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblexpenses` where id = '".$id."' ");
		$expense = $query->row();

		$query_1 = $CI->db->query("SELECT * FROM `tblpurpose` where id = '".$expense->purpose."' ");
		if($query_1->num_rows()>0){
			 $purpose_info = $query_1->row();
			 if($purpose_info->name == 'Other'){
				if(!empty($expense->other_purpose)){
					return $expense->other_purpose;
				}
			}else{
				return $purpose_info->name;
			}
		}else{
			return '--';
		}

	}
}


if(!function_exists('get_expense_related'))
{
    function get_expense_related($id)
    {
		$CI =& get_instance();
		$CI->load->model('home_model');

		$query = $CI->db->query("SELECT * FROM `tblexpenses` where id = '".$id."' ");
		$expense = $query->row();

		$related_name = '--';
		if($expense->related_to == 1){
			$related_to = 'Customers';
			$client_info = $CI->home_model->get_row('tblclientbranch', array('userid'=>$expense->clientid), '');
			if(!empty($client_info)){
				$related_name = $client_info->company;
			}
		}elseif($expense->related_to == 2){
			$related_to = 'leads';
			$expense_info = $CI->home_model->get_row('tblexpenses', array('id'=>$expense->id), '');
			$lead_info = $CI->home_model->get_row('tblclientbranch', array('userid'=>$expense_info->leadid), '');
			if(!empty($lead_info)){
				$related_name = $lead_info->company;
			}
		}elseif($expense->related_to == 3){
			$related_to = 'New Leads';
			$related_name = $expense->newlead_company;
		}elseif($expense->related_to == 4){
			$related_to = 'Others';
			$related_name = $expense->expense_other;
		}

		return  $related_to.' - '.$related_name;
	}
}


if(!function_exists('get_expense_from'))
{
    function get_expense_from($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblexpenses` where id = '".$id."' ");
		$expense = $query->row();

		if($expense->category == 1 || $expense->category == 2 || $expense->category == 5){
			if($expense->category == 1){
				return	$from_destination = $expense->form_destination;
			}elseif($expense->category == 2){
				return	$from_destination = $expense->trmpo_form_destination;
			}elseif($expense->category == 5){
				return	$from_destination = $expense->logistic_to_address;
			}
		}else{
			return '--';
		}
	}
}

if(!function_exists('get_expense_to'))
{
    function get_expense_to($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblexpenses` where id = '".$id."' ");
		$expense = $query->row();

		if($expense->category == 1 || $expense->category == 2 || $expense->category == 5){
			if($expense->category == 1){
				return	$to_destination = $expense->to_destination;
			}elseif($expense->category == 2){
				return	$to_destination = $expense->trmpo_to_destination;
			}elseif($expense->category == 5){
				return	$to_destination = $expense->logistic_from_address;
			}
		}else{
			return '--';
		}
	}
}


if(!function_exists('get_expense_head'))
{
    function get_expense_head($id)
    {
		$CI =& get_instance();
		$CI->load->model('home_model');

		$query = $CI->db->query("SELECT * FROM `tblexpenses` where id = '".$id."' ");
		$expense = $query->row();

		$head = '';

		if($expense->category == 1){
			$mode_info = $CI->home_model->get_row('tbltravelmode', array('id'=>$expense->travel_mode), '');
			if(!empty($mode_info)){
				$head = $mode_info->name;
			}
		}elseif($expense->category == 2){
				$head = $expense->tempo_name;
		}elseif($expense->category == 5){
			$head = $expense->expense_name;
		}elseif($expense->category == 3){
			if($expense->meal_type == 1){
				$head = 'Breakfast';
			}elseif($expense->meal_type == 5){
				$head = 'Lunch';
			}elseif($expense->meal_type == 3){
				$head = 'Dinner';
			}
		}elseif($expense->category == 4){
			$head = $expense->hotel_name;
		}elseif($expense->category == 6){
			$bill_info = $CI->home_model->get_row('tblbilltype', array('id'=>$expense->bill_type), '');
			if(!empty($bill_info)){
				$head = $bill_info->name;
			}
		}


		if(!empty($head)){
			return $head;
		}else{
			return '--';
		}
	}
}

if(!function_exists('get_bill_status'))
{
    function get_bill_status($id)
    {
		$CI =& get_instance();
		$CI->load->model('home_model');

		$query = $CI->db->query("SELECT * FROM `tblexpenses` where id = '".$id."' ");
		$expense = $query->row();

		$type = '--';
		if($expense->category == 2){
			if($expense->tempo_bill_type == 1){
				$type = 'With Bill';
			}elseif($expense->tempo_bill_type == 2){
				$type = 'Without Bill';
			}
		}elseif($expense->category == 6){
			if($expense->extra_bill_type == 1){
				$type = 'With Bill';
			}elseif($expense->extra_bill_type == 2){
				$type = 'Without Bill';
			}
		}elseif($expense->category == 4){
			if($expense->hotel_bill_type == 1){
				$type = 'With Bill';
			}elseif($expense->hotel_bill_type == 2){
				$type = 'Without Bill';
			}
		}elseif($expense->category == 3){
			if($expense->food_bill_type == 1){
				$type = 'With Bill';
			}elseif($expense->food_bill_type == 2){
				$type = 'Without Bill';
			}
		}


			return $type;

	}
}

if(!function_exists('get_request_paidy'))
{
    function get_request_paidy($request_id)
    {
		$CI =& get_instance();
		$approval_info = get_request_approval($request_id);
		if(!empty($approval_info)){
			return get_employee_fullname($approval_info->staff_id);
		}else{
			return '--';
		}

    }
}


if(!function_exists('get_expense_paidy'))
{
    function get_expense_paidy($id)
    {
		$CI =& get_instance();
		$CI->load->model('home_model');

		$query = $CI->db->query("SELECT * FROM `tblexpenses` where id = '".$id."' ");
		$expense = $query->row();

		$head = '';

		if($expense->paidby_employee > 0){
			return get_employee_fullname($expense->paidby_employee);
		}else{
			return '--';
		}

    }
}

if(!function_exists('get_pdf_data'))
{
    function get_pdf_data($f_date,$t_date,$staff_id,$date_list)
    {
			$html = '<html>

	<head>

		<style type="text/css">
			@import url(\'https://fonts.googleapis.com/css?family=Roboto\');

			@page{
				margin:0px 15px;
			}

			table{
				width:100%;
				font-family: \'Roboto\', sans-serif;
				font-size:15px;
			}

			.print_button {
				background-color: #08b3f6; /* Green */
				border: none;
				color: white;
				padding: 10px 25px;
				text-align: center;
				text-decoration: none;
				display: inline-block;
				font-size: 16px;
			}

		</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	</head>

	<body>

		<table cellpadding="0" cellspacing="0">
			<tr>
				<td rowspan="3" style="padding:5px; border: 1px solid #111; border-right:none; width:20%;"><img src="uploads/company/logo.png" alt="Schach Engineers Pvt Ltd"></td>
				<td rowspan="3" style="padding:5px; border: 1px solid #111; border-left:none; width:20%;"><h2 style="text-transform: uppercase; margin: 0;">Expense Details</h2></td>
				<td colspan="3" style="padding:5px; border: 1px solid #111; width:20%;"><b>Date : '.date('d/m/Y',strtotime($f_date)).' To '.date('d/m/Y',strtotime($t_date)).'</b></td>
				<td style="padding:5px; border: 1px solid #111; border-left:none;"><b>Employee ID : EMP-'.$staff_id.'</b></td>
				<td colspan="3" style="padding:5px; border: 1px solid #111;"><b>Branch : '.get_branch($staff_id).'</b></td>
			</tr>

			<tr>
				<td colspan="3" style="padding:5px; border: 1px solid #111;"><b>Name : '.get_employee_fullname($staff_id).' </b></td>
				<td colspan="2" style="padding:5px; border: 1px solid #111;"><b>Contact No. : '.get_staff_info($staff_id)->phonenumber.'	</b></td>
			</tr>

		</table>

		<table cellpadding="0" cellspacing="0">
			<thead>
				<tr>
					<th rowspan="2" style="background:#323a45; color:#fff; text-align:center; padding:5px; border: 1px solid #111; width:10%;">Date</th>
					<th rowspan="2" style="background:#323a45; color:#fff; text-align:center; padding:5px; border: 1px solid #111; width:10%;">ID</th>
					<th rowspan="2" style="background:#323a45; color:#fff; text-align:center; padding:5px; border: 1px solid #111; width:20%;">Details</th>
					<th rowspan="2" style="background:#323a45; color:#fff; text-align:center; padding:5px; border: 1px solid #111; width:10%;">Category</th>
					<th colspan="6" style="background:#323a45; color:#fff; text-align:center; padding:5px; border: 1px solid #111; width:60%;">Expense Details</th>
				</tr>

				<tr>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">Head</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">From</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">To</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">KM</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">Paid By</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">Amount</th>
					<th style="background:#323a45; color:#fff; text-align:center; padding:8px; border: 1px solid #111;">Advance</th>
				</tr>
			</thead>

			<tbody>';
			if(!empty($date_list)){
				$ttl_advance = 0;
				$ttl_amount = 0;
				$ttl_paid = 0;
				foreach($date_list as $date){

					$date_r = expense_request_count($staff_id,$date);
					$expense_info = get_expense($staff_id,$date);
					$request_info = get_request($staff_id,$date);
					$transfer_add_info = get_expense_transfer_add($staff_id,$date);
					$transfer_less_info = get_expense_transfer_less($staff_id,$date);

					if(!empty($expense_info)){
						foreach($expense_info as $row_1){
						$sub_expense_list = get_expense_by_parent($row_1->id);
						$sub_expense_count = count($sub_expense_list)+1;

						$expense_paid_by = get_expense_paidy($row_1->id);
						if($expense_paid_by != '--'){
							$ttl_paid += $row_1->amount;
						}else{
							$ttl_amount += $row_1->amount;
						}



			$html .= '<tr>
							<td rowspan="'.$sub_expense_count.'" style="text-align:center; padding:8px; border: 1px solid #111;">'.date('d/m/Y',strtotime($date)).'</td>
							<td rowspan="'.$sub_expense_count.'" style="text-align:center; padding:8px; border: 1px solid #111;">'.'EXP-'.get_short(get_expense_category($row_1->category)).'-'.number_series($row_1->id).'</td>
							<td rowspan="'.$sub_expense_count.'" style="text-align:left; padding:8px; border: 1px solid #111;">
								Purpose - '.get_expense_purpose($row_1->id).' <br>
								'.get_expense_related($row_1->id).'
							</td>
							<td rowspan="'.$sub_expense_count.'" style="text-align:center; padding:8px; border: 1px solid #111;">'.get_expense_category($row_1->category).'</td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_expense_head($row_1->id).'</td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_expense_from($row_1->id).'</td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_expense_to($row_1->id).'</td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_kilometer_limit($row_1->id).'</td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;">'.$expense_paid_by.'</td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;">'.$row_1->amount.'</td>
							<td style="text-align:center; padding:8px; border: 1px solid #111;">0</td>
						</tr>';


				if(!empty($sub_expense_list)){
							foreach($sub_expense_list as $row_2){

								$sub_expense_paid_by = get_expense_paidy($row_2->id);
								if($sub_expense_paid_by != '--'){
									$ttl_paid += $row_2->amount;
								}else{
									$ttl_amount += $row_2->amount;
								}


						$html .= '<tr>
									<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_expense_head($row_2->id).'</td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_expense_from($row_2->id).'</td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_expense_to($row_2->id).'</td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_kilometer_limit($row_2->id).'</td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;">'.$sub_expense_paid_by.'</td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;">'.$row_2->amount.'</td>
									<td style="text-align:center; padding:8px; border: 1px solid #111;">0</td>
								</tr>';
							}
							}
						}
					}

					if(!empty($request_info)){
						foreach($request_info as $row_3){
							$ttl_advance += $row_3->approved_amount;

							$cat = get_last(get_request_category($row_3->category));
							$cat_id = 'REQ-'.get_short($cat).'-'.number_series($row_3->id);

							if($row_3->pettycash_id > 0 ){ $pt_cash = '<small style="color: #e8283f;">(Petty Cash)</small>'; }else{ $pt_cash = ''; }

						$html .= '<tr>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.date('d/m/Y',strtotime($date)).'</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.$cat_id.' '.$pt_cash.'</td>
								<td style="text-align:left; padding:8px; border: 1px solid #111;">'.$row_3->reason.'</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_request_category($row_3->category).'</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">0.00</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.$row_3->approved_amount.'</td>
							</tr>';
						}
					}


					if(!empty($transfer_less_info)){
						foreach($transfer_less_info as $row_5){
							$ttl_advance += $row_5->approved_amount;

							$cat = get_last(get_request_category($row_5->category));
							$cat_id = 'REQ-'.get_short($cat).'-'.number_series($row_5->id);

							if($row_5->pettycash_id > 0 ){ $pt_cash = '<small style="color: #e8283f;">(Petty Cash)</small>'; }else{ $pt_cash = ''; }

							$added_by = '<br><small> (By '.get_employee_name($row_5->addedfrom).')</small>';

						$html .= '<tr>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.date('d/m/Y',strtotime($date)).'</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.$cat_id.' '.$pt_cash.'</td>
								<td style="text-align:left; padding:8px; border: 1px solid #111;">'.$row_5->reason.'</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_request_category($row_5->category).$added_by.'</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">0.00</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.$row_5->approved_amount.'</td>
							</tr>';
						}
					}


					if(!empty($transfer_add_info)){
						foreach($transfer_add_info as $row_4){
							$ttl_amount += $row_4->approved_amount;

							$cat = get_last(get_request_category($row_4->category));
							$cat_id = 'REQ-'.get_short($cat).'-'.number_series($row_4->id);

							if($row_4->pettycash_id > 0 ){ $pt_cash = '<small style="color: #e8283f;">(Petty Cash)</small>'; }else{ $pt_cash = ''; }

						$html .= '<tr>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.date('d/m/Y',strtotime($date)).'</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.$cat_id.' '.$pt_cash.'</td>
								<td style="text-align:left; padding:8px; border: 1px solid #111;">'.$row_4->reason.'</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.get_request_category($row_4->category).'</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">--</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">'.$row_4->approved_amount.'</td>
								<td style="text-align:center; padding:8px; border: 1px solid #111;">0.00</td>

							</tr>';
						}
					}

				}
			}

		$html .= '</tbody>

			<tfoot>
				<tr>
					<td colspan="8" style="background:#f0f0f0; text-align:center; padding:8px; border: 1px solid #111;"><b>Total</b></td>
					<td style="background:#f0f0f0; text-align:center; padding:8px; border: 1px solid #111;"><b>'.$ttl_amount.'</b></td>
					<td style="background:#f0f0f0; text-align:center; padding:8px; border: 1px solid #111;"><b>'.$ttl_advance.'</b></td>
				</tr>
			</tfoot>

		</table>

		<table cellpadding="0" cellspacing="0">

			<tr>
				<td style="padding:5px; border: 1px solid #111; border-left:none;"><b>Total Expense :  '.$ttl_amount.'</b></td>
				<td  style="padding:5px; border: 1px solid #111;"><b>Advance  : '.$ttl_advance.'</b></td>
				<td  style="padding:5px; border: 1px solid #111;"><b>Expense Paid  : '.$ttl_paid.'</b></td>
				<td  style="padding:5px; border: 1px solid #111;"><b>Final Amount  : '.($ttl_amount - $ttl_advance).'</b></td>
			</tr>

		</table>


	</body>

</html>';

	return $html;
	}
}


if(!function_exists('get_kilometer_limit'))
{
    function get_kilometer_limit($id)
    {
		$CI =& get_instance();
		$CI->load->model('home_model');

		$query = $CI->db->query("SELECT * FROM `tblexpenses` where id = '".$id."' ");
		$expense = $query->row();


		if($expense->category == 1){
			return $expense->kilometer_limit;
		}else{
			return '--';
		}

    }
}

if(!function_exists('total_expense_amount'))
{
    function total_expense_amount($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT SUM(amount) as amt  FROM `tblexpenses` where id = '".$id."' || parent_id = '".$id."'");

		if($query->num_rows()>0){
			 return $query->row()->amt;


		}
    }
}


if(!function_exists('get_wallet_transfer_less'))
{
    function get_wallet_transfer_less($id,$from_date="",$to_date="")
    {
		$CI =& get_instance();

		//Getting Request
		if(!empty($from_date) && !empty($to_date)){

			$from_date = str_replace("/","-",$from_date);
			$from_date = date("Y-m-d",strtotime($from_date));
			$to_date = str_replace("/","-",$to_date);
			$to_date = date("Y-m-d",strtotime($to_date));


		}else{

			$year = date('Y');
			$month = date('m');

			$query_2 = $CI->db->query("SELECT * FROM `tblwalletsetting` where status = 1 ");

			$form = $query_2->row()->from;
			$to = $query_2->row()->to;

			$a_date = $year.'-'.$month.'-'.$form;
			$from_date = date('Y-m-d', strtotime($a_date));


			$b_date = $year.'-'.$month.'-'.$to;
			$to_date = date('Y-m-d', strtotime($b_date));
		}

		//$query_1 = $CI->db->query("select r.*, ra.* from tblrequests as r LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where ra.staff_id = '".$id."' and r.receive_status = 1 and r.category = 4 and r.cancel = 0 and r.date BETWEEN '".$from_date."' AND '".$to_date."' ORDER by r.id Desc ");

		$query_1 = $CI->db->query("select *, dateadded as created_at, confirmed_date as updated_at, person_id as staff_id from tblrequests where person_id = '".$id."' and receive_status = 1 and category = 4 and cancel = 0 and date BETWEEN '".$from_date."' AND '".$to_date."' ORDER by id Desc ");


		if($query_1->num_rows()>0){
			return $request = $query_1->result();
		}


    }
}


if(!function_exists('get_wallet_transfer_add'))
{
    function get_wallet_transfer_add($id,$from_date="",$to_date="")
    {
		$CI =& get_instance();

		//Getting Request
		if(!empty($from_date) && !empty($to_date)){

			$from_date = str_replace("/","-",$from_date);
			$from_date = date("Y-m-d",strtotime($from_date));
			$to_date = str_replace("/","-",$to_date);
			$to_date = date("Y-m-d",strtotime($to_date));

		}else{
			$year = date('Y');
			$month = date('m');

			$query_2 = $CI->db->query("SELECT * FROM `tblwalletsetting` where status = 1 ");

			$form = $query_2->row()->from;
			$to = $query_2->row()->to;

			$a_date = $year.'-'.$month.'-'.$form;
			$from_date = date('Y-m-d', strtotime($a_date));


			$b_date = $year.'-'.$month.'-'.$to;
			$to_date = date('Y-m-d', strtotime($b_date));
		}

		//$query_1 = $CI->db->query("select r.*, ra.* from tblrequests as r LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where r.addedfrom = '".$id."' and r.receive_status = 1 and r.category = 4 and r.cancel = 0 and r.date BETWEEN '".$from_date."' AND '".$to_date."' ORDER by r.id Desc");
		$query_1 = $CI->db->query("select *, dateadded as created_at, confirmed_date as updated_at, person_id as staff_id from tblrequests where addedfrom = '".$id."' and receive_status = 1 and category = 4 and cancel = 0 and date BETWEEN '".$from_date."' AND '".$to_date."' ORDER by id Desc");


		if($query_1->num_rows()>0){
			return $request = $query_1->result();
		}


    }
}


if(!function_exists('get_available_leave_count'))
{
	function get_available_leave_count($user_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT SUM(`leave_count`) as ttl_leave FROM `tblleavesettings` where  status = 1 and category_id = 3");
		$ttl_leave = $query->row()->ttl_leave;



		$leave_taken = 0;
		$query_2 = $CI->db->query("SELECT SUM(total_days) as ttl_row  FROM `tblleaves` where approved_status = 1 and addedfrom = '".$user_id."' and category = '3' and (YEAR(from_date) = '".date('Y')."' || YEAR(to_date) = '".date('Y')."') and is_paid_leave = 1");
		if($query_2->num_rows()>0){
			$leave_taken += $query_2->row()->ttl_row;
		}

		return ($ttl_leave-$leave_taken);

		/*
		$query_1 = $CI->db->query("SELECT *  FROM `tblleavesettings` where  status = 1");
		if($query_1->num_rows()>0){

			$setting_list = $query_1->result();

			$leave_taken = 0;
			foreach($setting_list as $row){

				$category_arr = explode(",",$row->category_id);
				if(!empty($category_arr)){
					foreach($category_arr as $cat_id){
						$query_2 = $CI->db->query("SELECT SUM(total_days) as ttl_row  FROM `tblleaves` where approved_status = 1 and addedfrom = '".$user_id."' and category = '".$cat_id."' and (YEAR(from_date) = '".date('Y')."' || YEAR(to_date) = '".date('Y')."') and is_paid_leave = 1");
						if($query_2->num_rows()>0){
							$leave_taken += $query_2->row()->ttl_row;
						}
					}
				}
			}

			return ($ttl_leave-$leave_taken);
		}
		*/

    }
}




if(!function_exists('get_leave_category'))
{
    function get_leave_category($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblleavescategories` where `id`='".$id."'");
			if($query->num_rows()>0){
				return $query->row()->name;
			}

    }
}

/*if(!function_exists('get_leave_taken'))
{
    function get_leave_taken($user_id,$category_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblleaves` where approved_status = 1 and addedfrom = '".$user_id."' and category = '".$category_id."' and (YEAR(from_date) = '".date('Y')."' || YEAR(to_date) = '".date('Y')."') and is_paid_leave = 1");

			if($query->num_rows()>0){
				return $query->result();
			}

    }
}
*/

if(!function_exists('get_leave_taken'))
{
    function get_leave_taken($user_id,$category_id)
    {
		$CI =& get_instance();


		$date_range = staff_leave_daterange($user_id);
		$from_date = $date_range['from_date'];
		$to_date = $date_range['to_date'];

		$query = $CI->db->query("SELECT * FROM `tblleaves` where approved_status = 1 and addedfrom = '".$user_id."' and category = '".$category_id."' and from_date BETWEEN '".$from_date."' and '".$to_date."' and is_paid_leave = 1");

			if($query->num_rows()>0){
				return $query->result();
			}

    }
}

if(!function_exists('getComplimentaryLeaveBalance'))
{
    function getComplimentaryLeaveBalance($user_id)
    {
		$CI =& get_instance();


		$leave_info = $CI->db->query("SELECT * FROM `tblleaves` where approved_status = 1 and addedfrom = '".$user_id."' and category = '5' and is_paid_leave = 1")->result();

		$staff_data = get_employee_info($user_id);
		$taken_count = 0;
		if(!empty($leave_info)){
			foreach($leave_info as $row){
				$taken_count += $row->total_days;
			}
		}
		return ($staff_data->complimentry_leaves-$taken_count);
    }
}

if(!function_exists('get_employee_locations'))
{
    function get_employee_locations($from_date,$to_date,$user_id)
    {
		$CI =& get_instance();

		$from_date = str_replace("/","-",$from_date);
		$from_date = date("Y-m-d",strtotime($from_date));
		$to_date = str_replace("/","-",$to_date);
		$to_date = date("Y-m-d",strtotime($to_date));

		$query = $CI->db->query("SELECT * FROM `tblemployeelocations` where user_id = '".$user_id."' and status = 1 and updated_at between '".$from_date."' and  '".$to_date."' ");

		if($query->num_rows()>0){
			return $query->result();
		}

    }
}


if(!function_exists('get_mark_out_info'))
{
    function get_mark_out_info($staff_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblmarkedattendance` where staff_id = '".$staff_id."' and date = '".date('Y-m-d')."' and status = '1' order by id DESC LIMIT 1");
			if($query->num_rows()>0){
				return $query->row();
			}

    }
}

if(!function_exists('get_att_info'))
{
    function get_att_info($staff_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblmarkedattendance` where staff_id = '".$staff_id."' and date = '".date('Y-m-d')."' order by id DESC LIMIT 1");
			if($query->num_rows()>0){
				return $query->row()->status;
			}else{
			    return 0;
			}

    }
}


if(!function_exists('get_staff_day_work_hour'))
{
    function get_staff_day_work_hour($staff_id)
    {
		$CI =& get_instance();

		$working_sec = 0;

		$query = $CI->db->query("SELECT * FROM `tblmarkedattendance` where staff_id = '".$staff_id."' and date = '".date('Y-m-d')."' and status = '2' and working_time != '' ");
			if($query->num_rows()>0){
				$att_info = $query->result();
				foreach($att_info as $row){
					$working_sec += $row->working_time;
				}
			}
		$att_info = get_mark_out_info($staff_id);
		if(!empty($att_info)){
			$timeFirst  = strtotime($att_info->checkin_time);
			$timeSecond = strtotime(date('H:i:s'));
			$working_sec += $timeSecond - $timeFirst;
		}

		return gmdate("H:i:s", $working_sec);
		//return $working_sec;
    }
}

if(!function_exists('get_staff_location'))
{
    function get_staff_location($staff_id,$date)
    {
		$CI =& get_instance();

		$date = str_replace("/","-",$date);
		$date = date("Y-m-d",strtotime($date));

		$query = $CI->db->query("SELECT * FROM `tblstafflocations` where staff_id = '".$staff_id."' and date = '".$date."' and status = 1 GROUP by location");

		if($query->num_rows()>0){
			return $query->result();
		}

    }
}


if(!function_exists('get_expense_edit'))
{
    function get_expense_edit($id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT `id`,`addedfrom` FROM `tblexpenses` where addedfrom = '".get_staff_user_id()."' and id = '".$id."' ");


		if($query_1->num_rows()>0){
			return 1;
		}else{
			return 0;
		}

    }
}


if(!function_exists('get_location_name'))
{
    function get_location_name($latitude,$longitude)
    {
		$CI =& get_instance();

		 //Send request and receive json data by address
	        $geocodeFromLatLong = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json?latlng='.trim($latitude).','.trim($longitude).'&sensor=false&key=AIzaSyCog0SwrdpgOuhxZ3ftbUhyJVKwWSTA0iI');
	        $output = json_decode($geocodeFromLatLong);
	        $status = $output->status;
	       	        //Get address from json data
	        $address = ($status=="OK")?$output->results[1]->formatted_address:'';
	        //Return address of the given latitude and longitude
	        if(!empty($address)){
	            return  $address;
	        }else{
	            return   'Not found';
	        }

    }
}


if(!function_exists('check_pending_leave'))
{
    function check_pending_leave()
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblleaves` where addedfrom = '".get_staff_user_id()."' order by id desc LIMIT 1 ");


		if($query_1->num_rows()>0){
			$id = $query_1->row()->id;

			$query_2 = $CI->db->query("SELECT * FROM `tblleaveapproval` where leave_id = '".$id."' and approve_status != 0 ");

			if($query_2->num_rows()>0){
				return 0;
			}else{
				return 0;
			}

		}else{
			return 0;
		}

    }
}


if(!function_exists('check_pending_leave_app'))
{
    function check_pending_leave_app($user_id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblleaves` where addedfrom = '".$user_id."' order by id desc LIMIT 1 ");


		if($query_1->num_rows()>0){
			$id = $query_1->row()->id;

			$query_2 = $CI->db->query("SELECT * FROM `tblleaveapproval` where leave_id = '".$id."' and approve_status != 0 ");

			if($query_2->num_rows()>0){
				return 0;
			}else{
				return 1;
			}

		}else{
			return 0;
		}

    }
}


if(!function_exists('get_paid_by'))
{
    function get_paid_by($id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblexpenses` where id = '".$id."' ");
		$expense_info = $query_1->row();

		$category_id = $expense_info->category;

		if($category_id == 2){
			if($expense_info->tempo_paid_by == 1){
				return 'Self';
			}elseif($expense_info->tempo_paid_by == 2){
				return 'Company ('.get_employee_fullname($expense_info->paidby_employee).')';
			}else{
				return '--';
			}
		}elseif($category_id == 4){
			if($expense_info->hotel_paid_by == 1){
				return 'Self';
			}elseif($expense_info->hotel_paid_by == 2){
				return 'Company ('.get_employee_fullname($expense_info->paidby_employee).')';
			}else{
				return '--';
			}
		}elseif($category_id == 6){
			if($expense_info->extra_paid_by == 1){
				return 'Self';
			}elseif($expense_info->extra_paid_by == 2){
				return 'Company ('.get_employee_fullname($expense_info->paidby_employee).')';
			}else{
				return '--';
			}
		}elseif($category_id == 5){
			if($expense_info->logistic_paid_by == 1){
				return 'Self';
			}elseif($expense_info->logistic_paid_by == 2){
				return 'Company ('.get_employee_fullname($expense_info->paidby_employee).')';
			}else{
				return '--';
			}
		}else{
			return '--';
		}

    }
}


if(!function_exists('cancel_leave_requset'))
{
    function cancel_leave_requset($id)
    {

		$CI =& get_instance();

		$leave_info = get_leave_info($id);

		if($leave_info->approved_status == 0){
			$query_1 = $CI->db->query("DELETE FROM `tblleaves` where id = '".$id."' ");
			$query_2 = $CI->db->query("DELETE FROM `tblleaveapproval` where leave_id = '".$id."' ");
			$query_3 = $CI->db->query("DELETE FROM `tblnotifications` where table_id = '".$id."' and module_id = '3' ");

			return true;
		}


	}
}



if(!function_exists('get_live_location'))
{
    function get_live_location($user_id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblemployeelocations` where status = 1 and user_id = '".$user_id."' || view_status = '1' order by id desc ");

		if($query_1->num_rows()>0){
			return $query_1->result();
		}
	}
}

if(!function_exists('get_att_exist'))
{
    function get_att_exist($date,$staff_id)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT `id` FROM `tblstaffattendance` where staff_id = '".$staff_id."' and date = '".$date."' ");

		if($query_1->num_rows()>0){
			return 1;
		}else{
			return 0;
		}
	}
}

if(!function_exists('get_unread_notifications_count'))
{
    function get_unread_notifications_count($user_id)
    {
		$CI =& get_instance();

		$from_date = date('Y-m-d', strtotime(' - 10 days'));
		$to_date = date('Y-m-d');

		//$query_1 = $CI->db->query("SELECT COALESCE(count(id),0) as ttl_rows FROM `tblnotifications` where touserid = '".$user_id."' and isread = 0 and module_id != 7 and module_id > 0 and table_id > 0 and date between '".$from_date."' and '".$to_date."' ")->row();
		$query_1 = $CI->db->query("SELECT COALESCE(count(id),0) as ttl_rows FROM `tblnotifications` where touserid = '".$user_id."' and isread = 0 and module_id != 7 and module_id > 0 and table_id > 0  ")->row();
		return $query_1->ttl_rows;
	}
}

if(!function_exists('get_notifications'))
{
    function get_notifications($user_id,$from_date,$to_date,$overall_pending)
    {
		$CI =& get_instance();
		//$limit = '15';

		if($overall_pending == 0){

			if(empty($from_date)){
				$from_date = date('Y-m-d', strtotime(' - 3 days'));
			}else{
				$from_date = date('Y-m-d', strtotime($from_date));
			}


			if(empty($to_date)){
				$to_date = date('Y-m-d');
			}else{
				$to_date = date('Y-m-d', strtotime($to_date));
			}

			$from_date = $from_date.' 00:00:00';
			$to_date = $to_date.' 23:59:59';


			/*if($offset == 'blank'){
				$query_1 = $CI->db->query("SELECT * FROM `tblnotifications` where touserid = '".$user_id."' and module_id > 0 and table_id > 0 and date between '".$from_date."' and '".$to_date."' order by date desc");
			}else{
				$query_1 = $CI->db->query("SELECT * FROM `tblnotifications` where touserid = '".$user_id."' and module_id > 0 and table_id > 0 and date between '".$from_date."' and '".$to_date."' and id > '".$offset."' order by date desc LIMIT ".$limit." ");
			}*/

			//$query_1 = $CI->db->query("SELECT * FROM `tblnotifications` where touserid = '".$user_id."' and module_id IN (1,2,3,4,5,7,8,9,10,11,12) and table_id > 0 and date between '".$from_date."' and '".$to_date."' order by date desc");
			$query_1 = $CI->db->query("SELECT * FROM `tblnotifications` where touserid = '".$user_id."' and module_id IN (1,2,3,4,5,8,9,10,11,12,13) and table_id > 0 and date between '".$from_date."' and '".$to_date."' order by date desc");




			if($query_1->num_rows()>0){
				return $query_1->result();
			}

		}else{
			return get_pending_notifications($user_id);
		}

	}
}


if(!function_exists('get_pending_notifications'))
{
    function get_pending_notifications($user_id)
    {
		$CI =& get_instance();

		$notification_info = array();

		// $pending_request = $CI->db->query("SELECT r.id from tblrequests as r LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where r.approved_status = 0 and ra.staff_id = '".$user_id."'	")->result();

		 // $pending_expense = $CI->db->query("SELECT e.id from tblexpenses as e LEFT JOIN tblexpensesapproval as ea ON e.id = ea.expense_id where e.approved_status = 0 and ea.staff_id = '".$user_id."'	")->result();

		// $pending_leaves = $CI->db->query("SELECT l.id from tblleaves as l LEFT JOIN tblleaveapproval as la ON l.id = la.leave_id where l.approved_status = 0 and la.staff_id = '".$user_id."'	")->result();

		// $pettycash_request = $CI->db->query("SELECT p.id from tblpettycashrequest as p LEFT JOIN tblpettycashrequestapproval as pa ON p.id = pa.pettycash_id where p.approved_status = 0 and pa.staff_id = '".$user_id."'	")->result();



		$pending_request = $CI->db->query("SELECT n.* from `tblnotifications` as n LEFT JOIN tblrequests as r ON n.table_id = r.id LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where r.approved_status = 0 and ra.staff_id = '".$user_id."' and n.touserid = '".$user_id."' and n.module_id = 1  ")->result();
		if(!empty($pending_request)){
			foreach($pending_request as $request_notification){
				$notification_info[] = $request_notification;
			}
		}



		$pending_expense = $CI->db->query("SELECT n.* from `tblnotifications` as n LEFT JOIN tblexpenses as e ON n.table_id = e.id LEFT JOIN tblexpensesapproval as ea ON e.id = ea.expense_id where e.approved_status = 0 and ea.staff_id = '".$user_id."' and n.touserid = '".$user_id."' and n.module_id = 2  ")->result();
		if(!empty($pending_expense)){
			foreach($pending_expense as $expense_notification){
				$notification_info[] = $expense_notification;
			}
		}

		$pending_leaves = $CI->db->query("SELECT n.* from `tblnotifications` as n LEFT JOIN tblleaves as l ON n.table_id = l.id LEFT JOIN tblleaveapproval as la ON l.id = la.leave_id where l.approved_status = 0 and la.staff_id = '".$user_id."' and n.touserid = '".$user_id."' and n.module_id = 3 ")->result();
		if(!empty($pending_leaves)){
			foreach($pending_leaves as $leave_notification){
				$notification_info[] = $leave_notification;
			}
		}



		$pettycash_request = $CI->db->query("SELECT n.* from `tblnotifications` as n LEFT JOIN tblpettycashrequest as p ON n.table_id = p.id LEFT JOIN tblpettycashrequestapproval as pa ON p.id = pa.pettycash_id where p.approved_status = 0 and pa.staff_id = '".$user_id."' and n.touserid = '".$user_id."' and n.module_id = 9 ")->result();
		if(!empty($pettycash_request)){
			foreach($pettycash_request as $pettycash_notification){
				$notification_info[] = $pettycash_notification;
			}
		}



		/*if(!empty($pending_request)){
			foreach ($pending_request as $r1) {
				$notification = $CI->db->query("SELECT * FROM `tblnotifications` where touserid = '".$user_id."' and module_id = 1 and table_id = '".$r1->id."' ")->row();
				if(!empty($notification)){
					$notification_info[] = $notification;

				}
			}
		}

		if(!empty($pending_expense)){
			foreach ($pending_expense as $r2) {
				$notification = $CI->db->query("SELECT * FROM `tblnotifications` where touserid = '".$user_id."' and module_id = 2 and table_id = '".$r2->id."' ")->row();
				if(!empty($notification)){
					$notification_info[] = $notification;

				}
			}
		}

		if(!empty($pending_leaves)){
			foreach ($pending_leaves as $r3) {
				$notification = $CI->db->query("SELECT * FROM `tblnotifications` where touserid = '".$user_id."' and module_id = 3 and table_id = '".$r3->id."' ")->row();
				if(!empty($notification)){
					$notification_info[] = $notification;
				}
			}
		}

		if(!empty($pettycash_request)){
			foreach ($pettycash_request as $r4) {
				$notification = $CI->db->query("SELECT * FROM `tblnotifications` where touserid = '".$user_id."' and module_id = 9 and table_id = '".$r4->id."' ")->row();
				if(!empty($notification)){
					$notification_info[] = $notification;
				}
			}
		}*/

		arsort($notification_info);
		return $notification_info;

	}
}

if(!function_exists('get_pending_notifications_count'))
{
    function get_pending_notifications_count($user_id)
    {
		$CI =& get_instance();

		$notification_info = array();

		$pending_request = $CI->db->query("SELECT r.id from tblrequests as r LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where r.approved_status = 0 and ra.staff_id = '".$user_id."'	")->result();

		$pending_expense = $CI->db->query("SELECT e.id from tblexpenses as e LEFT JOIN tblexpensesapproval as ea ON e.id = ea.expense_id where e.approved_status = 0 and ea.staff_id = '".$user_id."'	")->result();

		$pending_leaves = $CI->db->query("SELECT l.id from tblleaves as l LEFT JOIN tblleaveapproval as la ON l.id = la.leave_id where l.approved_status = 0 and la.staff_id = '".$user_id."'	")->result();

		$pettycash_request = $CI->db->query("SELECT p.id from tblpettycashrequest as p LEFT JOIN tblpettycashrequestapproval as pa ON p.id = pa.pettycash_id where p.approved_status = 0 and pa.staff_id = '".$user_id."'	")->result();

		$count = 0;
		if(!empty($pending_request)){
			foreach ($pending_request as $r1) {
				$notification = $CI->db->query("SELECT id FROM `tblnotifications` where touserid = '".$user_id."' and module_id = 1 and table_id = '".$r1->id."' ")->row();
				if(!empty($notification)){
					$count++;

				}
			}
		}

		if(!empty($pending_expense)){
			foreach ($pending_expense as $r2) {
				$notification = $CI->db->query("SELECT id FROM `tblnotifications` where touserid = '".$user_id."' and module_id = 2 and table_id = '".$r2->id."' ")->row();
				if(!empty($notification)){
					$count++;

				}
			}
		}

		if(!empty($pending_leaves)){
			foreach ($pending_leaves as $r3) {
				$notification = $CI->db->query("SELECT id FROM `tblnotifications` where touserid = '".$user_id."' and module_id = 3 and table_id = '".$r3->id."' ")->row();
				if(!empty($notification)){
					$count++;
				}
			}
		}

		if(!empty($pettycash_request)){
			foreach ($pettycash_request as $r4) {
				$notification = $CI->db->query("SELECT id FROM `tblnotifications` where touserid = '".$user_id."' and module_id = 9 and table_id = '".$r4->id."' ")->row();
				if(!empty($notification)){
					$count++;
				}
			}
		}

		return $count;

	}
}


if(!function_exists('expense_notification_exist'))
{
    function expense_notification_exist($add_from,$add_to,$expense_date)
    {
		$CI =& get_instance();

		//$query_1 = $CI->db->query("SELECT * FROM `tblnotifications` where fromuserid = '".$add_from."' and touserid = '".$add_to."' and module_id = 2 and type = 1 and expense_date = '".$expense_date."' order by id desc ");

		$query_1 = $CI->db->query("SELECT * FROM `tblnotifications` where fromuserid = '".$add_from."' and touserid = '".$add_to."' and module_id = 2 and type = 1 and expense_date = '".$expense_date."' and description != 'Expense approve Successfully' and description != 'Expense Decline' order by id desc ");

		if($query_1->num_rows()>0){
			return $query_1->row();
		}

	}

}

if(!function_exists('check_approved_reject_expense'))
{
    function check_approved_reject_expense($add_from,$expense_date)
    {
		$CI =& get_instance();

		$query_1 = $CI->db->query("SELECT * FROM `tblexpenses` where addedfrom = '".$add_from."' and date = '".$expense_date."' and approved_status != 0 ");

		if($query_1->num_rows()>0){
			//return $query_1->row();
			return '1';
		}else{
			return '0';
		}

	}

}


if(!function_exists('get_expense_transfer_less'))
{
    function get_expense_transfer_less($id,$date="")
    {
		$CI =& get_instance();

		//Getting Request
		//$query_1 = $CI->db->query("select r.*, ra.* from tblrequests as r LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where ra.staff_id = '".$id."' and r.receive_status = 1 and r.category = 4 and r.cancel = 0 and r.date = '".$date."' ORDER by r.id Desc");
		$query_1 = $CI->db->query("select * from tblrequests where person_id = '".$id."' and receive_status = 1 and category = 4 and cancel = 0 and date = '".$date."' ORDER by id Desc");


		if($query_1->num_rows()>0){
			return $request = $query_1->result();
		}

    }
}

if(!function_exists('get_expense_transfer_add'))
{
    function get_expense_transfer_add($id,$date="")
    {

		$CI =& get_instance();

		//$query_1 = $CI->db->query("select r.*, ra.* from tblrequests as r LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where r.addedfrom = '".$id."' and r.receive_status = 1 and r.category = 4 and r.cancel = 0 and r.date = '".$date."' ORDER by r.id Desc");

		$query_1 = $CI->db->query("select * from tblrequests where addedfrom = '".$id."' and receive_status = 1 and category = 4 and cancel = 0 and date = '".$date."' ORDER by id Desc");


		if($query_1->num_rows()>0){
			return $request = $query_1->result();
		}
    }
}


if(!function_exists('get_last_requets_expense_pending'))
{
    function get_last_requets_expense_pending($user_id)
    {

		$pending = 0;

		$date = date('Y-m-d', strtotime(' - 10 days'));

		$last_date = $date.' 00:00:00';

		$CI =& get_instance();

		/*$query = $CI->db->query("select e.*, ea.* from tblexpenses as e LEFT JOIN tblexpensesapproval as ea ON e.id = ea.expense_id where ea.staff_id = '".$user_id."' and e.approved_status = 0 and e.status = 1 and e.dateadded < '".$last_date."' ");*/
		$query = $CI->db->query("select e.*, ea.* from tblexpenses as e LEFT JOIN tblexpensesapproval as ea ON e.id = ea.expense_id where ea.staff_id = '".$user_id."' and e.approved_status = 0 and e.status = 1 and e.dateadded < '".$last_date."' and MONTH(e.dateadded) = '".date('m')."' and YEAR(e.dateadded) = '".date('Y')."' ");

		/*$query_1 = $CI->db->query("select r.*, ra.* from tblrequests as r LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where ra.staff_id = '".$user_id."' and r.approved_status = 0 and r.cancel = 0 and r.dateadded < '".$last_date."' ");*/
		$query_1 = $CI->db->query("select r.*, ra.* from tblrequests as r LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where ra.staff_id = '".$user_id."' and r.approved_status = 0 and r.cancel = 0 and r.dateadded < '".$last_date."' and MONTH(r.dateadded) = '".date('m')."' and YEAR(r.dateadded) = '".date('Y')."'");


		if($query->num_rows()>0){
			$pending = 1;
		}

		if($query_1->num_rows()>0){
			$pending = 1;
		}

		return $pending;
    }
}

if(!function_exists('get_confim_requet_pending'))
{
    function get_confim_requet_pending($user_id)
    {

		$CI =& get_instance();

		$msg = '';
		$query = $CI->db->query("SELECT * FROM `tblrequests` where category != 4 and cancel = 0 and approved_status = 1 and manager_approved_status = 1 and confirmed_by_user = 0 and addedfrom = '".$user_id."' ");


		if($query->num_rows()>0){

			$request = $query->row();

			$cat = get_last(get_request_category($request->category));
			$request_no = 'REQ-'.get_short($cat).'-'.number_series($request->id);

			$msg = 'Your Reuqest ('.$request_no.') is Approved but not Confirmed yet, Please Comfirm First !';
		}

		return $msg;
    }
}

if(!function_exists('get_month_name'))
{
	function get_month_name($no){

		switch($no){

			case 1:
				return "January";
				break;
			case 2:
				return "February";
				break;
			case 3:
				return "March";
				break;
			case 4:
				return "April";
				break;
			case 5:
				return "May";
				break;
			case 6:
				return "June";
				break;
			case 7:
				return "July";
				break;
			case 8:
				return "August";
				break;
			case 9:
				return "September";
				break;
			case 10:
				return "October";
				break;
			case 11:
				return "November";
				break;
			case 12:
				return "December";
				break;
		}


	}
}

if(!function_exists('get_paid_salary'))
{
    function get_paid_salary($year,$month,$type)
    {

		$CI =& get_instance();

		$query_1 = $CI->db->query("select sp.*,s.account_no,s.ifsc_code,s.payment_mode,s.firstname from tblsalarypaidlog as sp LEFT JOIN tblstaff as s ON sp.staff_id = s.staffid where s.payment_mode = '".$type."' and sp.month = '".$month."' and sp.year = '".$year."' and sp.status = '1' and sp.net_salary > '0' ORDER by sp.id ASC");

		if($query_1->num_rows()>0){
			return $query_1->result();
		}
    }
}

if(!function_exists('value_by_id'))
{
    function value_by_id($table,$id,$field) {

        $CI =& get_instance();

        if(!empty($id)){
        	$query = $CI->db->query("select * from ".$table." where id = ".$id)->row();

	        if(!empty($query->$field)){
	            return $query->$field;
	        }
	        else{
	            return "--";
	        }
        }

    }
}

if(!function_exists('value_by_id_empty'))
{
    function value_by_id_empty($table,$id,$field) {

        $CI =& get_instance();

        $query = $CI->db->query("select * from ".$table." where id = ".$id)->row();

        return (!empty($query)) ? $query->$field : "";
    }
}

if(!function_exists('get_staff_loan_requst'))
{
    function get_staff_loan_requst($staff_id,$status,$from_date='',$to_date='')
    {

		$CI =& get_instance();


		$where = " r.category = 3 and r.approved_status = 1 and r.confirmed_by_user = 1 and r.receive_status=1 and r.cancel = 0";

		if($staff_id > 0){
			$where  .= " and r.addedfrom = '".$staff_id."' ";
		}


		if($status == 0){
			$where .= " and l.status = '0'";
		}elseif($status == 1){
			$where .= " and l.closed = '1' ";
		}

		if(!empty($from_date) && !empty($to_date)){
			$where .= " and r.date between '".$from_date."' and '".$to_date."' ";
		}

		$query_1 = $CI->db->query("SELECT r.* from tblrequests as r LEFT JOIN tblstaffloanlog as l ON r.id = l.request_id where  ".$where." group by r.id ORDER BY r.date desc");



		if($query_1->num_rows()>0){
			return $query_1->result();
		}
    }
}



if(!function_exists('get_loan_installment'))
{
    function get_loan_installment($staff_id)
    {

		$CI =& get_instance();

		$loan_amount = 0;

		$query_1 = $CI->db->query("SELECT r.* from tblrequests as r LEFT JOIN tblstaffloanlog as l ON r.id = l.request_id where r.category = 3 and r.addedfrom = '".$staff_id."' and r.approved_status = 1 and r.confirmed_by_user = 1 and r.receive_status=1 and r.cancel = 0  and l.status = 0 group by r.id ORDER BY r.date desc");

		if($query_1->num_rows()>0){
			$request_info = $query_1->result();

			foreach ($request_info as $value) {
					$query_1 = $CI->db->query("SELECT * FROM `tblstaffloanlog` where request_id = '".$value->id."' and status = 0 order by id asc LIMIT 1 ");

					if($query_1->num_rows()>0){
						$loan_amount += $query_1->row()->amount;
					}
			}
		}

		return number_format($loan_amount, 2, '.', '');
    }
}

if(!function_exists('manage_loan_installment'))
{
    function manage_loan_installment($staff_id)
    {

		$CI =& get_instance();


		$query_1 = $CI->db->query("SELECT r.* from tblrequests as r LEFT JOIN tblstaffloanlog as l ON r.id = l.request_id where r.category = 3 and r.addedfrom = '".$staff_id."' and r.approved_status = 1 and r.confirmed_by_user = 1 and r.receive_status=1 and r.cancel = 0  and l.status = 0 group by r.id ORDER BY r.date desc");

		if($query_1->num_rows()>0){
			$request_info = $query_1->result();

			foreach ($request_info as $value) {
					$query_1 = $CI->db->query("SELECT * FROM `tblstaffloanlog` where request_id = '".$value->id."' and status = 0 order by id asc LIMIT 1 ");

					if($query_1->num_rows()>0){

						$id = $query_1->row()->id;
						$amt = $query_1->row()->amount;
						$update = $CI->db->query("Update `tblstaffloanlog` set status = 1, paid_amount = '".$amt."' where id = '".$id."' ");
					}
			}
		}

    }
}


if(!function_exists('get_staff_loan_requst'))
{
    function get_staff_loan_requst($staff_id)
    {

		$CI =& get_instance();

		$where_status = " ";
		if($status == 0){
			$where_status = "and l.status = '0'";
		}if($status == 1){
			$where_status = "and l.closed = '1' ";
		}

		if(empty($from_date) && empty($to_date)){
			$query_1 = $CI->db->query("SELECT r.* from tblrequests as r LEFT JOIN tblstaffloanlog as l ON r.id = l.request_id where r.category = 3 and r.addedfrom = '".$staff_id."' and r.approved_status = 1 and r.confirmed_by_user = 1 and r.receive_status=1 and r.cancel = 0 ".$where_status." group by r.id ORDER BY r.date desc");
		}else{
			$query_1 = $CI->db->query("SELECT r.* from tblrequests as r LEFT JOIN tblstaffloanlog as l ON r.id = l.request_id where r.category = 3 and r.addedfrom = '".$staff_id."' and r.approved_status = 1 and r.confirmed_by_user = 1 and r.receive_status=1 and r.cancel = 0 ".$where_status." and r.date between '".$from_date."' and '".$to_date."' group by r.id ORDER BY r.date desc");
		}



		if($query_1->num_rows()>0){
			return $query_1->result();
		}
    }
}


if(!function_exists('get_loan_total_amount'))
{
    function get_loan_total_amount($staff_id)
    {

		$CI =& get_instance();
		$loan_amount = 0;

		$query_1 = $CI->db->query("SELECT r.* from tblrequests as r LEFT JOIN tblstaffloanlog as l ON r.id = l.request_id where r.category = 3 and r.addedfrom = '".$staff_id."' and r.approved_status = 1 and r.confirmed_by_user = 1 and r.receive_status=1 and r.cancel = 0  and l.status = 0 group by r.id ORDER BY r.date desc");

		if($query_1->num_rows()>0){
			$request_info = $query_1->result();

			foreach ($request_info as $value) {

					$loan_amount += $value->approved_amount;

			}
		}

		return $loan_amount;
    }
}


if(!function_exists('getQuotientAndRemainder'))
{
    function getQuotientAndRemainder($divisor, $dividend)
    {
    	$quotient = (int)($divisor / $dividend);
    	$remainder = $divisor % $dividend;
   		return array( $quotient, $remainder );
    }

}


if(!function_exists('get_product_category'))
{
    function get_product_category($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * FROM `tblproductcategory` where `id`='".$id."'");
			if($query->num_rows()>0){
				return $query->row()->name;
			}else{
				return '--';
			}

    }
}


if(!function_exists('get_warehouse_staff'))
{
    function get_warehouse_staff($warehouse_id,$designation_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT * from tblcompanybranch  where FIND_IN_SET('".$warehouse_id."', `warehouse_id`)  ");
		if($query->num_rows()>0){

			$comp_info = $query->result();


			$query = $CI->db->query("SELECT * from tblcompanybranch  where FIND_IN_SET('".$warehouse_id."', `warehouse_id`)  ");


		}

    }
}


if(!function_exists('nestedUppercase'))
{
    function nestedUppercase($value)
    {
		$CI =& get_instance();

		if (is_array($value)) {
	        return array_map('nestedUppercase', $value);
	    }
	    return ucfirst($value);

    }
}


if(!function_exists('get_challan_address'))
{
    function get_challan_address($challan_ids,$type=1)
    {
		$CI =& get_instance();
		$CI->load->model('home_model');
		$html = '';
		$i = 1;

		if($type == 1){
			$style = 'style="margin-top:19%;"';
		}else{
			$style = '';
		}

		if(!empty($challan_ids)){
			$html .= '<div class="table-responsive s_table proddv" '.$style.' >
		                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
		                    <thead>
		                        <tr>
		                            <th align="left">S.No.</th>
		                            <th align="left">Challan No.</th>
		                            <th align="left">State/City</th>
		                            <th align="left">Location</th>
		                            <th align="left">Address</th>
		                        </tr>
		                    </thead>
		                    <tbody class="ui-sortable">';
			foreach ($challan_ids as  $challan_id) {
				$challan_info = $CI->home_model->get_row('tblchalanmst', array('id'=>$challan_id), '');
				if(!empty($challan_info)){
					$site_info = $CI->home_model->get_row('tblsitemanager', array('id'=>$challan_info->site_id), '');
					if(!empty($site_info)){
						$state = value_by_id('tblstates',$site_info->state_id,'name');
						$city = value_by_id('tblcities',$site_info->city_id,'name');
						$html .='<tr class="main" id="tr0">
									<td>'.$i++.'</td>
									<td>'.$challan_info->chalanno.'</td>
									<td>'.$state.', '.$city.'</td>
									<td>'.$site_info->location.'</td>
									<td>'.$site_info->address.'</td>
								</tr>';
					}
				}


			}

			$html .= '</tbody></table></div>';
		}

		return $html;

    }
}


if(!function_exists('check_quotation'))
{
    function check_quotation($lead_id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT `id` FROM `tblproposals` where `rel_id`='".$lead_id."' and `rel_type` = 'proposal' ");
		if($query->num_rows()>0){
			return 1;
		}else{
			return 0;
		}
	}

}


if(!function_exists('get_groups_name'))
{
    function get_groups_name($groups_id)
    {
		$CI =& get_instance();

		$groups_name = '';

		$id_arr = explode(',',$groups_id);
		if(!empty($id_arr)){
			foreach($id_arr as $id){
				$g_name = value_by_id('tblstaffgroup',$id,'name');
				if(!empty($g_name)){

					$groups_name .= $g_name.' ,';
				}
			}
		}

		return rtrim($groups_name,",");

	}

}


if(!function_exists('client_balance_amt'))
{
    function client_balance_amt($client_id,$service_type='')
    {
		$CI =& get_instance();

		$parent_ids = 0;

		if(!empty($service_type)){
			$where = "clientid = '".$client_id."' and status != '5' and service_type = '".$service_type."' ";
		}else{
			$where = "clientid = '".$client_id."' and status != '5' ";
		}



		$invoice_info = $CI->db->query("SELECT `id`,`total`,`parent_id` from `tblinvoices` where ".$where."  ")->result();
		$invoice_amt = 0;
		$paid_amt = 0;
		if(!empty($invoice_info)){
			foreach ($invoice_info as $invoice) {
				if($invoice->parent_id == 0){
					$parent_ids .= ','.$invoice->id;
				}
				$invoice_amt += $invoice->total;
				$paid_amt += invoice_received($invoice->id);
				$paid_amt += invoice_tds_received($invoice->id);
			}
		}


		$debit_note_info = $CI->db->query("SELECT `id`,`totalamount`,`number` FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' ")->result();
		if(!empty($debit_note_info)){
			foreach ($debit_note_info as $debitnote) {
				$invoice_amt += $debitnote->totalamount;
				$paid_amt += debitnote_received($debitnote->number);
				$paid_amt += debitnote_tds_received($debitnote->number);
			}
		}

		$credit_note_info = $CI->db->query("SELECT `id`,`totalamount`,`number` FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' ")->result();
		if(!empty($credit_note_info)){
			foreach ($credit_note_info as $creditnote) {
				$paid_amt += $creditnote->totalamount;
			}
		}

		//if($service_type == 3 || $service_type == 1){
			if(!empty($service_type)){
				$payment_debitnote = $CI->db->query("SELECT d.id,d.amount,d.number FROM tbldebitnotepayment as d LEFT JOIN tbldebitnotepaymentitems as di ON d.id = di.debitnote_id LEFT JOIN tblinvoices as i ON di.invoice_id = i.id  where d.clientid = '".$client_id."' and d.status = '1' and i.service_type = '".$service_type."' group by d.id  ")->result();

			}else{
				$payment_debitnote = $CI->db->query("SELECT `id`,`amount`,`number` FROM tbldebitnotepayment where clientid = '".$client_id."' and status = '1' ")->result();
			}

			if(!empty($payment_debitnote)){
				foreach ($payment_debitnote as $debitnote) {
					$invoice_amt += $debitnote->amount;
					$paid_amt += debitnote_received($debitnote->number);
					$paid_amt += debitnote_tds_received($debitnote->number);
				}
			}

		//}

		//getting all client branches in order to match balace amount with ledger balance amount
		$main_client_id = client_info($client_id)->client_id;	
		$onaccout_amt_info = $CI->db->query("SELECT * FROM `tblclientbranch`  where client_id = '".$main_client_id."' and active = 1")->result();
		$client_ids = 0;
		if(!empty($onaccout_amt_info)){
			foreach ($onaccout_amt_info as $r) {
				$client_ids .= ','.$r->userid;
			}
		}


		if(!empty($service_type)){
			//$onaccout_amt_info = $CI->db->query("SELECT * FROM `tblclientpayment`  where client_id = '".$client_id."' and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ")->result();
			$onaccout_amt_info = $CI->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$client_ids.") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ")->result();
			$waveoff_amt = $CI->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id = '".$client_id."' and status = 1 and service_type = '".$service_type."' ")->row()->ttl_amount;
		}else{
			//$onaccout_amt_info = $CI->db->query("SELECT * FROM `tblclientpayment`  where client_id = '".$client_id."' and payment_behalf = 1 and status = 1")->result();
			$onaccout_amt_info = $CI->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$client_ids.") and payment_behalf = 1 and status = 1")->result();
			$waveoff_amt = $CI->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id = '".$client_id."' and status = 1 ")->row()->ttl_amount;
		}

		$onaccout_amt = 0;
        if(!empty($onaccout_amt_info)){
        	foreach ($onaccout_amt_info as $on_am) {
        		$to_see = ($on_am->payment_mode == 1 && $on_am->chaque_status != 1) ? '0' : '1';
				if($to_see == 1){
					$onaccout_amt += $on_am->ttl_amt;
				}
        	}
        }
	
	if(!empty($service_type)){
		$where_refund = "r.client_id = '".$client_id."' and r.service_type = '".$service_type."' and pd.utr_no != ''";
	}else{
		$where_refund = "r.client_id = '".$client_id."' and pd.utr_no != ''";
	}
    $clientrefund_amt = $CI->db->query("SELECT COALESCE(SUM(r.amount),0) AS ttl_amount from  tblclientrefund as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'client_refund' where ".$where_refund." order by r.id desc")->row()->ttl_amount;
		$balance_amt = ($invoice_amt - $paid_amt - $onaccout_amt - $waveoff_amt + $clientrefund_amt);
		return number_format($balance_amt, 2, '.', '');

		//$invoice_info = $CI->db->query("SELECT COALESCE(SUM(total),0) as ttl_amt FROM `tblinvoices` where  `status` != '2' and `clientid` = '".$client_id."' ")->row();

		//return $invoice_info->ttl_amt;
	}

}


if(!function_exists('get_staff_clients'))
{
    function get_staff_clients($user_id)
    {
		$CI =& get_instance();
		$branch_id = $CI->session->userdata('staffbranch');

		$client_array = array();

		$query = $CI->db->query("SELECT `id` FROM `tblstaffgroup` where `status`='1' and FIND_IN_SET('".$user_id."', staff_id)");

		if($query->num_rows()>0){
			$group_ids = $query->result();

			foreach ($group_ids as $group_id) {
				$client_info = $CI->db->query("SELECT * FROM `tblclientbranch` where `active`='1' and FIND_IN_SET('".$group_id->id."', staff_group)")->result();

				if(!empty($client_info)){
					$string = '';
					foreach ($client_info as $key => $value) {
						$client_array[] = $value->userid;
					}
				}
			}
		}
		return array_unique($client_array);

    }
}


if(!function_exists('product_tax_rate'))
{
    function product_tax_rate($id)
    {
		$CI =& get_instance();

		$product_info = $CI->db->query("SELECT * FROM `tblproducts` where id = '".$id."' ")->row();
		if(!empty($product_info)){
			$tax_id = $product_info->gst_id;

			if($tax_id > 0){
				$tax_info = $CI->db->query("SELECT * FROM `tbltaxes` where id = '".$tax_id."' ")->row();
				if(!empty($tax_info)){
					return $tax_info->taxrate;
				}else{
					return 0;
				}
			}else{
				return 0;
			}

		}

    }
}



if(!function_exists('get_gst_type'))
{
    function get_gst_type($client_id)
    {
		$CI =& get_instance();
		$branch_id = $CI->session->userdata('staffbranch');

		if(!empty($branch_id)){
			$branch_info = $CI->db->query("SELECT * FROM `tblcompanybranch` where `id`='".$branch_id."' ")->row();
			$branch_state = $branch_info->state;



			$client_info = $CI->db->query("SELECT * FROM `tblclientbranch` where `userid`='".$client_id."' ")->row();
			$client_state = $client_info->state;

			//return $branch_state.' - '.$client_state;


			if($branch_state == $client_state){
				return 1;
			}else{
				return 2;
			}
		}else{
			return 1;
		}



    }
}

if(!function_exists('get_gst_type_by_state'))
{
    function get_gst_type_by_state($state_id)
    {
		$CI =& get_instance();
		$branch_id = $CI->session->userdata('staffbranch');

		if(!empty($branch_id)){
			$branch_info = $CI->db->query("SELECT * FROM `tblcompanybranch` where `id`='".$branch_id."' ")->row();
			$branch_state = $branch_info->state;


			//return $branch_state.' - '.$client_state;


			if($branch_state == $state_id){
				return 1;
			}else{
				return 2;
			}
		}else{
			return 1;
		}



    }
}


if(!function_exists('get_employee_joindate'))
{
    function get_employee_joindate($id)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT `joining_date` FROM `tblstaff` where staffid = '".$id."' ");

		if($query->num_rows()>0){
			return $query->row()->joining_date;
		}

    }
}


if(!function_exists('get_proposal_gst_type'))
{
    function get_proposal_gst_type($client_state)
    {
		$CI =& get_instance();
		$branch_id = $CI->session->userdata('staffbranch');

		if(!empty($branch_id)){
			$branch_info = $CI->db->query("SELECT * FROM `tblcompanybranch` where `id`='".$branch_id."' ")->row();
			$branch_state = $branch_info->state;



			if($branch_state == $client_state){
				return 1;
				die;
			}else{
				return 2;
				die;
			}
		}else{
			return 1;
			die;
		}



    }
}



if(!function_exists('check_already_converted'))
{
    function check_already_converted($id,$for)
    {
		$CI =& get_instance();

		if($for == 'proposal'){
			$exist_info = $CI->db->query("SELECT * FROM `tblestimates` where `proposal_id`='".$id."' ")->row();
		}elseif($for == 'estimate'){
			$exist_info = $CI->db->query("SELECT * FROM `tblinvoices` where `estimate_id`='".$id."' ")->row();
		}

		if(!empty($exist_info)){
			return 1;
		}else{
			return 0;
		}

    }
}

if(!function_exists('last_purchaseorder'))
{
    function last_purchaseorder()
    {
		$CI =& get_instance();

		$last_info = $CI->db->query("SELECT id FROM `tblpurchaseorder`  Order by id desc LIMIT 1")->row();

		if(!empty($last_info)){
			return ($last_info->id + 1);
		}else{
			return 1;
		}

    }
}

if(!function_exists('get_task_status'))
{
    function get_task_status($task_id)
    {
		$CI =& get_instance();

		$assignee_info = $CI->db->query("SELECT * FROM `tbltaskassignees`  where task_id = '".$task_id."' ")->result();


		$ttl = 0;
		$pending = 0;
		$reject = 0;
		$complete = 0;
		if(!empty($assignee_info)){
			foreach ($assignee_info as $row) {

				$task_status = $row->task_status;
				if($task_status == 0){
					$pending++;
				}elseif($task_status == 1){
					$complete++;
				}elseif($task_status == 2){
					$reject++;
				}

				$ttl++;
			}
		}


		if($ttl == $pending){
			$status = 0;
		}elseif($ttl == $complete){
			$status = 1;
		}elseif($ttl == $reject){
			$status = 2;
		}else{
			$status = 3;
		}

		return $status;
    }
}

if(!function_exists('get_pending_task_msg'))
{
    function get_pending_task_msg($user_id)
    {

		$CI =& get_instance();

		$msg = '';
		$query = $CI->db->query("SELECT t.status, ta.* FROM tbltasks as  t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where t.status = 1 and ta.task_status = 0 and ta.staff_id = '".$user_id."' ");


		if($query->num_rows()>0){

			$msg = 'You have Pending Task to Complete, Please Check Your Task List!';
		}

		return $msg;
    }
}


if(!function_exists('get_new_other_allowance'))
{
    function get_new_other_allowance($salary,$for)
    {
        $CI =& get_instance();

        $pf_amt = 0;
        $esic_amt = 0;
        $bonus = 0;
        $other_allowance = 0;

        $basic = (50 / 100) * $salary;
        $hra = (20 / 100) * $salary;
        $convenience = (4 / 100) * $salary;
        $medical = (4 / 100) * $salary;
        $uniform = (4 / 100) * $salary;

        $gross = ($basic+$hra+$convenience+$medical+$uniform);


        if($for == 3 || $for == 4){
        	//getting PF
	        $all_allownce = ($gross-$hra);
	        $pf_amt = (12 / 100) * $all_allownce;
	        if($pf_amt > '1800'){
	            $pf_amt = '1800';
	        }

	        //getting ESIC
	        if($gross < '21000'){
	            $esic_amt = (3.75 / 100) * $gross;
	        }
        }

        if($for == 2 || $for == 4){
        	//getting bonus
        	$bonus = round($gross/12);
        }

       $final = ($gross+$pf_amt+$esic_amt+$bonus);

       $difference = round($salary-$final);

       if($for == 1){
       		$other_allowance = (18 / 100) * $salary;
       }elseif($for == 3){
       		//$other_allowance = $difference;
       		if($salary <= '21900'){
       	 		$other_allowance = (86.4 / 100) * $difference;
       	 	}else if($salary >= '25650'){
       	 		$other_allowance =  $difference;
       	 	}else if($salary >= '21900' && $salary <= '25650'){
				die;
			}
       }elseif($for == 2){
       		$other_allowance = (92.31 / 100) * $difference;
       }elseif($for == 4){
       	 	if($salary >= '25300'){
       	 		$other_allowance = (92.31 / 100) * $difference;
       	 	}else{
       	 		$other_allowance = (80.30 / 100) * $difference;
       	 	}

       }

    	return round($other_allowance);
    }
}

if(!function_exists('get_new_ctc'))
    {
        function get_new_ctc($salary,$other_allowance,$for)
        {
            $CI =& get_instance();

            $pf_amt = 0;
	        $esic_amt = 0;
	        $employee_esic = 0;
	        $bonus = 0;

	        $basic = (50 / 100) * $salary;
	        $hra = (20 / 100) * $salary;
	        $convenience = (4 / 100) * $salary;
	        $medical = (4 / 100) * $salary;
	        $uniform = (4 / 100) * $salary;

            $gross = ($basic+$hra+$convenience+$medical+$uniform+$other_allowance);

            if($for == 3 || $for == 4){

	            //getting PF
	            $all_allownce = ($gross-$hra);
	            $pf_amt = (12 / 100) * $all_allownce;
	            if($pf_amt > '1800'){
	                $pf_amt = '1800';
	            }

	            //getting ESIC
	            if($gross < '21000'){
	                $esic_amt = round((3.75 / 100) * $gross);
	            }

	            //getting Employee ESIC
	            if($gross < '21000'){
	                $employee_esic = round((0.75 / 100) * $gross);
	            }
	        }

            //getting bonus
            if($for == 2 || $for == 4){
	        	$bonus = round($gross/12);
	        }


            //getting PT
            if($gross < '10000'){
                $pt = '0';
            }else{
                if(date('m') == '02'){
                    $pt = '300';
                }else{
                    $pt = '200';
                }
            }

            $return_arr =array(
                'basic'             => $basic,
                'hra'               => $hra,
                'convenience'       => $convenience,
                'medical'           => $medical,
                'uniform'           => $uniform,
                'other_allowance'   => $other_allowance,
                'gross'             => $gross,
                'pf'                => $pf_amt,
                'esic'              => $esic_amt,
                'monthly_ctc'       => round($pf_amt+$esic_amt+$gross),
                'bonus'             => $bonus,
                'final'             => $salary,
                'pt'                => $pt,
                'employee_esic'     => $employee_esic,
            );


             return $return_arr;



        }
    }


if(!function_exists('get_other_allowance'))
{
    function get_other_allowance($salary)
    {
        $CI =& get_instance();

        $basic = (45 / 100) * $salary;
        $hra = (20 / 100) * $salary;
        $convenience = (5 / 100) * $salary;
        $medical = (5 / 100) * $salary;
        $uniform = (5 / 100) * $salary;

        $gross = round($basic+$hra+$convenience+$medical+$uniform);


        //getting PF
        $all_allownce = round($basic+$convenience+$medical+$uniform);
        $pf_amt = (12 / 100) * $all_allownce;
        if($pf_amt > '1800'){
            $pf_amt = '1800';
        }

        //getting ESIC
        if($gross > '21000'){
            $esic_amt = '0';
        }else{
            $esic_amt = (3.75 / 100) * $gross;
        }

        //getting bonus
        $bonus = round($gross/12);

        $final = ($gross+$pf_amt+$esic_amt+$bonus);


        return $other_allowance = ($salary-$final);

    }
}

if(!function_exists('final_other_allowance'))
{
    function final_other_allowance($salary)
    {

        $CI =& get_instance();

        $basic = (45 / 100) * $salary;
        $hra = (20 / 100) * $salary;
        $convenience = (5 / 100) * $salary;
        $medical = (5 / 100) * $salary;
        $uniform = (5 / 100) * $salary;

         $other_allowance = get_other_allowance($salary);

        $gross = round($basic+$hra+$convenience+$medical+$uniform+$other_allowance);


        //getting PF
        $all_allownce = ($basic+$convenience+$medical+$uniform+$other_allowance);
        $pf_amt = (12 / 100) * $all_allownce;
        if($pf_amt > '1800'){
            $pf_amt = '1800';
        }

        //getting ESIC
        if($gross > '21000'){
            $esic_amt = '0';
        }else{
            $esic_amt = round((3.75 / 100) * $gross);
        }

        //getting bonus
        $bonus = round($gross/12);

        $final = round($gross+$pf_amt+$esic_amt+$bonus);


         $difference = round($salary-$final);




       $i = 0;

        while($difference > 0 || $difference < 0) {


            $other_allowance = round($other_allowance + $difference);

            $gross = round($basic+$hra+$convenience+$medical+$uniform+$other_allowance);


            //getting PF
            $all_allownce = round($basic+$convenience+$medical+$uniform+$other_allowance);
            $pf_amt = (12 / 100) * $all_allownce;
            /*$pf_amt = round($basic+$convenience+$medical+$uniform+$other_allowance);
            if($pf_amt > '1800'){
                $pf_amt = '1800';
            }*/

            //getting ESIC
            if($gross > '21000'){
                $esic_amt = '0';
            }else{
                $esic_amt = (3.75 / 100) * $gross;
            }

            //getting bonus
            $bonus = round($gross/12);

            $final = ($gross+$pf_amt+$esic_amt+$bonus);


            $difference = ($salary-$final);

            $difference = round($difference);
            $other_allowance = round($other_allowance);
           /* if($i == 2){
                echo $difference;
                echo '<br/>';
                echo $final;
                echo '<br/>';
                echo $other_allowance;
                echo '<br/>';
                die;
            }*/

            if($i > 53 && $difference == 1){
                return  round($other_allowance);
                die;
            }

            $i++;
        }
        return  round($other_allowance);

    }

}

    if(!function_exists('get_ctc'))
    {
        function get_ctc($salary,$other_allowance)
        {
            $CI =& get_instance();

            $basic = (45 / 100) * $salary;
            $hra = (20 / 100) * $salary;
            $convenience = (5 / 100) * $salary;
            $medical = (5 / 100) * $salary;
            $uniform = (5 / 100) * $salary;

            $gross = ($basic+$hra+$convenience+$medical+$uniform+$other_allowance);


            //getting PF
            $all_allownce = ($basic+$convenience+$medical+$uniform+$other_allowance);
            $pf_amt = (12 / 100) * $all_allownce;
            if($pf_amt > '1800'){
                $pf_amt = '1800';
            }

            //getting ESIC
            if($gross > '21000'){
                $esic_amt = '0';
            }else{
                $esic_amt = round((3.75 / 100) * $gross);
            }

            //getting bonus
            $bonus = round($gross/12);

            $final = round($gross+$pf_amt+$esic_amt+$bonus);



            //getting PT

            if($gross < '10000'){
                $pt = '0';
            }else{
                if(date('m') == '02'){
                    $pt = '300';
                }else{
                    $pt = '200';
                }
            }

            //getting Employee ESIC
            if($gross > '21000'){
                $employee_esic = '0';
            }else{
                $employee_esic = round((0.75 / 100) * $gross);
            }

             $return_arr =array(
                    'basic'             => $basic,
                    'hra'               => $hra,
                    'convenience'       => $convenience,
                    'medical'           => $medical,
                    'uniform'           => $uniform,
                    'other_allowance'   => $other_allowance,
                    'gross'             => $gross,
                    'pf'                => $pf_amt,
                    'esic'              => $esic_amt,
                    'monthly_ctc'       => round($pf_amt+$esic_amt+$gross),
                    'bonus'             => $bonus,
                    'final'             => $final,
                    'pt'             => $pt,
                    'employee_esic'             => $employee_esic,
              );


             return $return_arr;



        }
    }



if(!function_exists('get_product_print_name'))
{
    function get_product_print_name($id)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tblproducts` where id = '".$id."' ");

		if($query->num_rows()>0){
			return $query->row()->sub_name;
		}

    }
}


if(!function_exists('get_productfields'))
{
    function get_productfields($slug)
    {
		$CI =& get_instance();

			$query = $CI->db->query("SELECT * FROM `tbl_productfields` where slug = '".$slug."' ");

		if($query->num_rows()>0){
			return $query->row()->name;
		}

    }
}


if(!function_exists('get_productfields_list'))
{
    function get_productfields_list($table,$id,$product_id)
    {
		$CI =& get_instance();

		$html = '';

		$product_fields = $CI->db->query("SELECT * FROM ".$table." where proposalid = '".$id."' and fieldname != 'name' and fieldname != '' and field_id = 0 group by fieldname ")->result();
		$product_custom_fields = $CI->db->query("SELECT pf.id as id, pf.field_for, pf.name FROM `tblproductcustomfields` as pf LEFT JOIN ".$table." as ft ON pf.id = ft.field_id where ft.proposalid = '".$id."' and ft.field_id > 0 order by field_for desc ")->result();

		$sac_hsn_value = '';
		$dec_value = '';
		$is_sac_field_exist = 0;

		// Getting SAC code for service category product (by priyanka)
		$product_details = $CI->db->query("SELECT p.id,c.for_service FROM `tblproducts` as p LEFT JOIN tblproductcategory as c ON p.product_cat_id = c.id WHERE p.id = '".$product_id."' ")->row();
		$sac_for_servie = '';
		if($product_details->for_service == 1){
			$sac_info = $CI->db->query("SELECT * FROM `tblproductsfield` where product_id = '".$product_id."' and field_id = '2'  ")->row();
			if(!empty($sac_info->field_value)){
				$sac_for_servie = '<p><b style="color:#000;">SAC :</b> '.$sac_info->field_value. '</p>';
			}
		}



		if(!empty($product_fields)){
			foreach ($product_fields as $key => $value) {

				$product_info = $CI->db->query("SELECT * FROM `tblproducts` where id = '".$product_id."' ")->row();

				$fieldname = $value->fieldname;

				if(!empty($product_info->$fieldname)){

					if($value->fieldname == 'sac_code' || $value->fieldname == 'hsn_code'){
						$sac_hsn_value .= '<p><b style="color:#000;">'.get_productfields($value->fieldname).' :</b> '.$product_info->$fieldname. '</p>';
					}elseif($value->fieldname == 'product_description'){
						$dec_value .= '<p><b>'.get_productfields($value->fieldname).' :</b> '.$product_info->$fieldname. '</p>';
					}else{
						$html .= '<p><b>'.get_productfields($value->fieldname).' :</b> '.$product_info->$fieldname. '</p>';
					}

				}

			}
			return $sac_hsn_value.$html.$dec_value;
		}elseif(!empty($product_custom_fields)){
			foreach ($product_custom_fields as $key => $value) {
				if($value->field_for == 2){
					$is_sac_field_exist = 1;
				}
				$product_info = $CI->db->query("SELECT * FROM `tblproductsfield` where product_id = '".$product_id."' and field_id = '".$value->id."'  ")->row();

				if(!empty($product_info)){
					if($value->field_for == 1 || $value->field_for == 2){
						if(!empty($product_info->field_value)){
							$html .= '<p><b style="color:#000;">'.$value->name.' :</b> '.$product_info->field_value. '</p>';
						}

					}else{
						if(!empty($product_info->field_value)){
							$html .= '<p><b>'.$value->name.' :</b> '.$product_info->field_value. '</p>';
						}

					}
				}
			}
			if($is_sac_field_exist == 1){
				return $html;
			}else{
				return $sac_for_servie.$html;
			}

		}


    }
}

if (!function_exists('get_temp_productfields_list')) {

    function get_temp_productfields_list($table, $id, $product_id) {
        $CI = & get_instance();

        $html = '';

        $product_fields = $CI->db->query("SELECT * FROM " . $table . " where proposalid = '" . $id . "' and fieldname != 'name' and fieldname != '' and field_id = 0 group by fieldname ")->result();
        $product_custom_fields = $CI->db->query("SELECT pf.id as id, pf.field_for, pf.name FROM `tblproductcustomfields` as pf LEFT JOIN " . $table . " as ft ON pf.id = ft.field_id where ft.proposalid = '" . $id . "' and ft.field_id > 0 order by field_for desc ")->result();
        $sac_hsn_value = '';
        $dec_value = '';
        if (!empty($product_fields)) {
            foreach ($product_fields as $key => $value) {

                $product_info = $CI->db->query("SELECT * FROM `tbltemperoryproduct` where id = '" . $product_id . "' ")->row();

                $fieldname = $value->fieldname;

                if (!empty($product_info->$fieldname)) {

                    if ($value->fieldname == 'sac_code' || $value->fieldname == 'hsn_code') {
                        $field_name = ($value->fieldname == 'sac_code') ? $value->sac : $value->hsn;
                        $sac_hsn_value .= '<p><b style="color:#000;">' . get_productfields($value->fieldname) . ' :</b> ' . $product_info->$field_name . '</p>';
                    } elseif ($value->fieldname == 'product_description') {
                        $dec_value .= '<p><b>' . get_productfields($value->fieldname) . ' :</b> ' . $product_info->product_desc . '</p>';
                    }
                }
            }
            return $sac_hsn_value . $html . $dec_value;
        } elseif (!empty($product_custom_fields)) {
            foreach ($product_custom_fields as $key => $value) {

                $product_info = $CI->db->query("SELECT * FROM `tbltemperoryproduct` where id = '" . $product_id . "' ")->row();
                if (!empty($product_info)) {
                    if ($value->field_for == 1 || $value->field_for == 2) {
                        $value_fields = ($value->field_for == 1) ? $product_info->hsn : $product_info->sac;
                        if (!empty($value_fields)) {
                            $html .= '<p><b style="color:#000;">' . $value->name . ' :</b> ' . $value_fields . '</p>';
                        }
                    } else if($value->field_for == 0) {
                        if (!empty($product_info->product_desc)) {
                            $html .= '<p><b>' . $value->name . ' :</b> ' . $product_info->product_desc . '</p>';
                        }
                    }
                }
            }
            return $html;
        }
    }

}

if(!function_exists('get_proposal_to_data'))
{
    function get_proposal_to_data($proposal_id)
    {
		$CI =& get_instance();

		$proposal_info = $CI->db->query("SELECT * FROM `tblproposals` where id = '".$proposal_id."' ")->row();


		$city_name = '--';
		$state_name = '--';
		if($proposal_info->city > 0){
			$city_name = value_by_id('tblcities',$proposal_info->city,'name');
		}
		if($proposal_info->state > 0){
			$state_name = value_by_id('tblstates',$proposal_info->state,'name');
		}


		$html = '<b>'.$proposal_info->proposal_to.'</b><br />'.$proposal_info->address.'<br />'.$city_name.', '.$state_name.'<br />'.$proposal_info->email.'<br />'.$proposal_info->phone;

		return $html;


    }
}


if(!function_exists('get_invoice_shipto_data'))
{
    function get_invoice_shipto_data($invoice_id)
    {
		$CI =& get_instance();

		$invoice_info = $CI->db->query("SELECT * FROM `tblinvoices` where id = '".$invoice_id."' ")->row();


		/*$city_name = '--';
		$state_name = '--';
		if($proposal_info->city > 0){
			$city_name = value_by_id('tblcities',$proposal_info->city,'name');
		}
		if($proposal_info->state > 0){
			$state_name = value_by_id('tblstates',$proposal_info->state,'name');
		}
		*/

		$html = '<br /><b>Ship To</b><br />'.$invoice_info->shipping_street.'<br />'.$invoice_info->shipping_city.', '.$invoice_info->shipping_state.'<br />'.$invoice_info->shipping_zip.'<br />';

		return $html;


    }
}


if(!function_exists('get_proposal_items_list'))
{
    function get_proposal_items_list($id,$type)
    {
		$CI =& get_instance();

		$is_sale = ($type == 'sale') ? '1' : '0';

		$item_info = $CI->db->query("SELECT * FROM `tblitems_in` where rel_type = 'proposal' and rel_id = '".$id."' and is_sale = '".$is_sale."' order by id asc")->result_array();

		if(!empty($item_info)){
			return $item_info;
		}

    }
}

if(!function_exists('get_invoice_items_list'))
{
    function get_invoice_items_list($id,$type,$for)
    {
		$CI =& get_instance();

		$is_sale = ($type == 'sale') ? '1' : '0';

		$item_info = $CI->db->query("SELECT * FROM `tblitems_in` where rel_type = '".$for."' and rel_id = '".$id."' and is_sale = '".$is_sale."' order by id asc")->result_array();

		if(!empty($item_info)){
			return $item_info;
		}

    }
}


if(!function_exists('get_service_type'))
{
    function get_service_type()
    {
		$CI =& get_instance();

		$item_info = $CI->db->query("SELECT * FROM `tblenquiryformaster` where id != '3' ")->result_array();

		if(!empty($item_info)){
			return $item_info;
		}

    }
}


if(!function_exists('get_material_value'))
{
    function get_material_value($product_id,$qty)
    {
		$CI =& get_instance();

		$product_info = $CI->db->query("SELECT * FROM `tblproducts` where id = '".$product_id."' ")->row();

		if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
           $rate = $product_info->sale_price_cat_a;
        }else{
           $rate = $product_info->price;
        }



		return $material_value = ($rate*$qty);

    }
}


if(!function_exists('get_product_name'))
{
    function get_product_name($product_id)
    {
		$CI =& get_instance();

		$product_info = $CI->db->query("SELECT `sub_name` FROM `tblproducts` where id = '".$product_id."' ")->row();

		if(!empty($product_info->sub_name)){
			return	cc($product_info->sub_name);
		}else{
			return $product_id;
		}
    }
}


if(!function_exists('get_sub_products'))
{
    function get_sub_products($product_id)
    {
		$CI =& get_instance();

		return $items_info = $CI->db->query("SELECT * FROM `tblproductitems` where product_id = '".$product_id."' and status = 1 and item_id > 0")->result();

    }
}


if(!function_exists('createTreeView')){
	function createTreeView($p_id,$id_arr) {



	   $sub_products = get_sub_products($p_id);
	   $html = '';

	   $html .= '<li style="color:red;"><h4>'.get_product_name($p_id).product_code($p_id).'</h4>';

	   if(!empty($sub_products)){
	   	$id_arr[] = $p_id;
	   		$html .= '<ul>';

	   		foreach ($sub_products as $key => $value) {



	   			if (!in_array($value->item_id,$id_arr, TRUE)){
	   				$html .= getChildTreeView($value->item_id,$id_arr,$value->qty);
	   			}

	   			$is_parent = get_sub_products($value->item_id);
	   			if(!empty($is_parent)){
	   				$id_arr[]  = $value->item_id;
	   			}



	   		}
	   		$html .= '</ul>';
	   }

	   $html .= '</li>';

	   return $html;

	}
}



if(!function_exists('getChildTreeView')){
	function getChildTreeView($p_id,$id_arr,$qty) {


	   $sub_products = get_sub_products($p_id);
	   $html = '';

	   $html .= '<li><b>'.get_product_name($p_id).product_code($p_id).' - <span style="color:orange;">('.$qty.')</span></b>';

	   if(!empty($sub_products)){
	   	$id_arr[] = $p_id;
	   		$html .= '<ul>';

	   		foreach ($sub_products as $key => $value) {



	   			if (!in_array($value->item_id,$id_arr, TRUE)){
	   				$html .= getChildTreeView($value->item_id,$id_arr,$value->qty);
	   			}

	   			$is_parent = get_sub_products($value->item_id);
	   			if(!empty($is_parent)){
	   				$id_arr[]  = $value->item_id;
	   			}



	   		}
	   		$html .= '</ul>';
	   }

	   $html .= '</li>';

	   return $html;

	}
}




if(!function_exists('createTreeArray')){
	function createTreeArray($p_id,$nid_arr,$qty) {

	  $html = '';


	   $sub_products = get_sub_products($p_id);

	   $html .= ' - '.$p_id.':'.$qty;

	   if(!empty($sub_products)){
	   	$nid_arr[] = $p_id;

	   		foreach ($sub_products as $key => $value) {



	   			if (!in_array($value->item_id,$nid_arr, TRUE)){
	   				$html .= createTreeArray($value->item_id,$nid_arr,$value->qty);
	   			}

	   			$is_parent = get_sub_products($value->item_id);
	   			if(!empty($is_parent)){
	   				$nid_arr[]  = $value->item_id;
	   			}



	   		}
	   }


	   return $html;

	}
}

if(!function_exists('custom_array_column')){
	function custom_array_column($item_id, $table) {
		$n_key = 0;
		foreach ($table as $key => $value) {
				if($value == $item_id){
					$n_key = $key;
				}
		}

		return $n_key;

	}

}


if(!function_exists('super_unique')){
	function super_unique($itemsdata)
    {

       $new_array = array();
       foreach ($itemsdata as $key => $value) {
       		$item_id = $value['item_id'];
       		$req_qty = $value['req_qty'];

       		$temp_array = array();
       		foreach ($itemsdata as $key => $row) {
       			$qty = 0;
       			if($item_id == $row['item_id']){
       				$temp_array = array('item_id' => $row['item_id'], 'req_qty' => $row['req_qty']);
       			}
       		}

       		$new_array[] = $temp_array;

       }

       $tempArr = array_unique(array_column($new_array, 'item_id'));
	   return array_intersect_key($new_array, $tempArr);

    }


}


if(!function_exists('super_unique_2')){
	function super_unique_2($itemsdata)
    {

       $new_array = array();
       foreach ($itemsdata as $key => $value) {
       		$componentid = $value['componentid'];
       		$requiredqty = $value['requiredqty'];

       		$temp_array = array();
       		foreach ($itemsdata as $key => $row) {
       			$qty = 0;
       			if($componentid == $row['componentid']){
       				$temp_array = array('componentid' => $row['componentid'], 'requiredqty' => $row['requiredqty'], 'availableqty' => $row['availableqty'], 'name' => $row['name']);
       			}
       		}

       		$new_array[] = $temp_array;

       }

       $tempArr = array_unique(array_column($new_array, 'componentid'));
	   return array_intersect_key($new_array, $tempArr);

    }


}


if(!function_exists('get_provisional_time')){
	function get_provisional_time($userid)
    {

       $CI =& get_instance();

	   $staff_info = $CI->db->query("SELECT * FROM `tblstaff` where staffid = '".$userid."' ")->row();

	   $joining_date = $staff_info->joining_date;
	   $month = $staff_info->paid_leave_time;

	   $time = strtotime($joining_date);
	   $paid_after = date("Y-m-d", strtotime('+'.$month.' month', $time));

	   if($paid_after <= date('Y-m-d')){
	   		return 1;
	   }else{
	   	 	return 0;
	   }

    }

}

if(!function_exists('get_proposal_to_array'))
{
    function get_proposal_to_array($proposal_id)
    {
		$CI =& get_instance();

		$proposal_info = $CI->db->query("SELECT * FROM `tblproposals` where id = '".$proposal_id."' ")->row();


		$city_name = '';
		$state_name = '';
		$gst = '--';
		$contact_name = '--';
		if($proposal_info->city > 0){
			$city_name = value_by_id('tblcities',$proposal_info->city,'name');
		}
		if($proposal_info->state > 0){
			$state_name = value_by_id('tblstates',$proposal_info->state,'name');
		}
		if($proposal_info->rel_id > 0){
			$gst = value_by_id('tblleads',$proposal_info->rel_id,'gst_no');
			$contact_name = value_by_id('tblleads',$proposal_info->rel_id,'client_person_name');
		}


		$p_data = array(
			'name' => $proposal_info->proposal_to,
			'address' => $proposal_info->address,
			'city' => $city_name,
			'state' => $state_name,
			'contact_name' => $contact_name,
			'email' => $proposal_info->email,
			'phone' => $proposal_info->phone,
			'gst' => $gst,
		 );
		return $p_data;


    }
}


if(!function_exists('app_announcement'))
{
    function app_announcement()
    {

    	$CI =& get_instance();

    	$html = '';

		$joining_info = $CI->db->query("SELECT * FROM `tblstaff` where joining_date = '".date('Y-m-d')."' ")->result();

		$birthday_info = $CI->db->query("SELECT * FROM `tblstaff` where MONTH(actual_birth_date) = '".date('m')."' and DAY(actual_birth_date) =  '".date('d')."' and active = 1")->result();

		
		$arr = [];
		if(!empty($birthday_info)){
			foreach ($birthday_info as $key => $value) {
				$profile_image = '';
				if(!empty($value->profile_image)){
					$profile_image = base_url('uploads/staff_profile_images/'.$value->staffid.'/'.$value->profile_image);
				}
				$arr[] = array(
					'type' => "1",
					'message' => "Happy Birthday",
					'name' => $value->firstname,
					'profile_image' => $profile_image,
					'designation' => get_designation($value->designation_id),	
					'branch' => value_by_id_empty('tblcompanybranch',$value->reporting_branch_id,'comp_branch_name'),
				 );
			}
		}
		if(!empty($joining_info)){
			foreach ($joining_info as $key => $value) {
				$profile_image = '';
				if(!empty($value->profile_image)){
					$profile_image = base_url('uploads/staff_profile_images/'.$value->staffid.'/'.$value->profile_image);
				}
				$arr[] = array(
					'type' => "2",
					'message' => "Welcome",
					'name' => $value->firstname,
					'profile_image' => $profile_image,
					'designation' => get_designation($value->designation_id),	
					'branch' => value_by_id_empty('tblcompanybranch',$value->reporting_branch_id,'comp_branch_name'),
				 );
			}
		}

		/*if(!empty($joining_info)){
			$html .= " <b>New Joining : </b>";
			$i = 0;
			foreach ($joining_info as $key => $value) {
				if($i == 0){
					$html .= $value->firstname;
				}else{
					$html .= ', '.$value->firstname;
				}
				$i++;
			}
		}

		if(!empty($birthday_info)){
			$html .= " <b>Today's Birthday : </b>";
			$i = 0;
			foreach ($birthday_info as $key => $row) {
				if($i == 0){
					$html .= $row->firstname;
				}else{
					$html .= ', '.$row->firstname;
				}
				$i++;
			}
		}*/


		return $arr;

	}

}


if(!function_exists('get_estimate_to_array'))
{
    function get_estimate_to_array($estimate_id)
    {
		$CI =& get_instance();

		$estimate_info = $CI->db->query("SELECT * FROM `tblestimates` where id = '".$estimate_id."' ")->row();
		$client_info = $CI->db->query("SELECT * FROM `tblclientbranch` where userid = '".$estimate_info->clientid."' ")->row();


		/*$p_data = array(
			'name' => $client_info->client_branch_name,
			'address' => $estimate_info->billing_street,
			'city' => $estimate_info->billing_city,
			'state' => $estimate_info->billing_state,
			'zip' => $estimate_info->billing_zip,
			'phone' => $client_info->phone_no_1,
			'gst' => $client_info->vat,
			'contact_name' => $client_info->client_person_name,
			'email' => $client_info->email_id
		 );*/


		 $p_data = array(
			'name' => $client_info->client_branch_name,
			'address' => $client_info->address,
			'city' => value_by_id('tblcities',$client_info->city,'name'),
			'state' => value_by_id('tblstates',$client_info->state,'name'),
			'zip' => $client_info->zip,
			'phone' => $client_info->phone_no_1,
			'gst' => $client_info->vat,
			'contact_name' => $client_info->client_person_name,
			'email' => $client_info->email_id
		 );
		return $p_data;


    }
}


if(!function_exists('get_invoice_to_array'))
{
    function get_invoice_to_array($invoice_id)
    {
		$CI =& get_instance();

		$invoice_info = $CI->db->query("SELECT * FROM `tblinvoices` where id = '".$invoice_id."' ")->row();
		$client_info = $CI->db->query("SELECT * FROM `tblclientbranch` where userid = '".$invoice_info->clientid."' ")->row();


		/*$p_data = array(
			'name' => $client_info->client_branch_name,
			'address' => $invoice_info->billing_street,
			'city' => $invoice_info->billing_city,
			'state' => $invoice_info->billing_state,
			'zip' => $invoice_info->billing_zip,
			'phone' => $client_info->phone_no_1,
			'gst' => $client_info->vat,
		 );*/

		 $p_data = array(
			'name' => $client_info->client_branch_name,
			'address' => $client_info->address,
			'city' => value_by_id('tblcities',$client_info->city,'name'),
			'state' => value_by_id('tblstates',$client_info->state,'name'),
			'zip' => $client_info->zip,
			'phone' => $client_info->phone_no_1,
			'gst' => $client_info->vat,
		 );
		return $p_data;


    }
}

if(!function_exists('get_debitnote_to_array'))
{
    function get_debitnote_to_array($clientid)
    {
		$CI =& get_instance();

		$client_info = $CI->db->query("SELECT * FROM `tblclientbranch` where userid = '".$clientid."' ")->row();

		 $p_data = array(
			'name' => $client_info->client_branch_name,
			'address' => $client_info->address,
			'city' => value_by_id('tblcities',$client_info->city,'name'),
			'state' => value_by_id('tblstates',$client_info->state,'name'),
			'zip' => $client_info->zip,
			'phone' => $client_info->phone_no_1,
			'gst' => $client_info->vat,
		 );
		return $p_data;


    }
}


if(!function_exists('get_ship_to_array'))
{
    function get_ship_to_array($site_id,$client_id = '')
    {
        $CI =& get_instance();


        $city = '';

        $site_info = $CI->db->query("SELECT * FROM `tblsitemanager` where id = '".$site_id."' ")->row();
        if(!empty($site_info)){
            $get_state_details=$CI->db->query("SELECT * FROM `tblstates` WHERE `id`='".$site_info->state_id."'")->row();
            $get_city_details=$CI->db->query("SELECT * FROM `tblcities` WHERE `id`='".$site_info->city_id."'")->row();

            if(!empty($get_city_details)){
                    $city =$get_city_details->name;
            }

            $phone = '';
            if(!empty($client_id)){
                    $client_info = $CI->db->query("SELECT * FROM `tblclientbranch` where userid = '".$client_id."' ")->row();
                    $phone = $client_info->phone_no_1;
            }


            $p_data = array(
                    'name' => $site_info->name,
                    'location' => $site_info->location,
                    'address' => $site_info->address,
                    'city' => $city,
                    'phone' => $phone,
                    'state' => (!empty($get_state_details)) ? $get_state_details->name : '',
                    'zip' => $site_info->pincode,
                    'landmark' => $site_info->landmark
             );
            return $p_data;
        }
    }
}

if(!function_exists('lead_site_id'))
{
    function lead_site_id($id)
    {

    	$CI =& get_instance();

    	return $CI->db->query("SELECT * FROM `tblleads` where id = '".$id."' ")->row()->site_id;
    }


}


if(!function_exists('get_staff_vendor_data'))
{
    function get_staff_vendor_data()
    {

    	$CI =& get_instance();

    	$name_data = array();

    	$vendor_info = $CI->db->query("SELECT * FROM `tblvendor` where status = '1' and account_no != '' ")->result();
    	$staff_info = $CI->db->query("SELECT * FROM `tblstaff` where active = '1' and account_no != '' ")->result();

    	if(!empty($vendor_info)){
    		foreach ($vendor_info as $key => $value) {
    			$name_data[] = array('name' => $value->name);
    		}
    	}

    	if(!empty($staff_info)){
    		foreach ($staff_info as $key => $value) {
    			$name_data[] = array('name' => $value->firstname);
    		}
    	}

    	return $name_data;
    }


}



if(!function_exists('invoice_ship_to_array'))
{
    function invoice_ship_to_array($site_id)
    {
		$CI =& get_instance();

		$site_info = $CI->db->query("SELECT site_id,shipping_street,shipping_city,shipping_state,shipping_zip FROM `tblinvoices`  where id = '".$site_id."' ")->row();


		$p_data = array(
			'address' => $site_info->shipping_street,
			'city' => $site_info->shipping_city,
			'state' => $site_info->shipping_state,
			'zip' => $site_info->shipping_zip
		 );
		return $p_data;


    }
}


if(!function_exists('invoice_contact_person'))
{
    function invoice_contact_person($invoice_id, $no = 1)
    {
		$CI =& get_instance();

		$office_name = '';
		$office_number = '';
		
		if ($no == 'all'){

			$office_info = $CI->db->query("SELECT c.`firstname`,c.`phonenumber` from tblinvoiceclientperson as ic LEFT JOIN tblcontacts as c ON ic.`contact_id` = c.`id` where ic.`type` = 'invoice' and c.`contact_type` = 1 and ic.`invoice_id` = '".$invoice_id."'  ")->result();
			if(!empty($office_info)){
				$officename = array();
				foreach($office_info as $k => $office){
					$k++;
					$officename[] = '<br>'.$k.') '.$office->firstname.' - '.$office->phonenumber;
				}
				$office_name = implode(',', $officename);
			}
		}else{
			$office_info = $CI->db->query("SELECT c.`firstname`,c.`phonenumber` from tblinvoiceclientperson as ic LEFT JOIN tblcontacts as c ON ic.`contact_id` = c.`id` where ic.`type` = 'invoice' and c.`contact_type` = 1 and ic.`invoice_id` = '".$invoice_id."'  ")->row();
			if(!empty($office_info)){
				$office_name = $office_info->firstname;
				$office_number = $office_info->phonenumber;
			}
		}
		
		$site_name = '';
		$site_number = '';
		if ($no == 'all'){
			$site_info = $CI->db->query("SELECT c.`firstname`,c.`phonenumber` from tblinvoiceclientperson as ic LEFT JOIN tblcontacts as c ON ic.`contact_id` = c.`id` where ic.`type` = 'invoice' and c.`contact_type` = 2 and ic.`invoice_id` = '".$invoice_id."'  ")->result();
			if(!empty($site_info)){
				$sitename = array();
				foreach($site_info as $k => $site){
					$k++;
					$sitename[] = '<br>'.$k.') '.$site->firstname.' - '.$site->phonenumber;
				}
				$site_name = implode(',', $sitename);
			}
		}else{
			$site_info = $CI->db->query("SELECT c.`firstname`,c.`phonenumber` from tblinvoiceclientperson as ic LEFT JOIN tblcontacts as c ON ic.`contact_id` = c.`id` where ic.`type` = 'invoice' and c.`contact_type` = 2 and ic.`invoice_id` = '".$invoice_id."'  ")->row();
			if(!empty($site_info)){
				$site_name = $site_info->firstname;
				$site_number = $site_info->phonenumber;
			}
		}

		$person_data = array(
						'office_name' => $office_name,
						'office_number' => $office_number,
						'site_name' => $site_name,
						'site_number' => $site_number,
					);
		return $person_data;
    }
}


if(!function_exists('debitnote_contact_person'))
{
    function debitnote_contact_person($invoice_id,$type='debitnote')
    {
		$CI =& get_instance();

		$office_info = $CI->db->query("SELECT c.`firstname`,c.`phonenumber` from tblinvoiceclientperson as ic LEFT JOIN tblcontacts as c ON ic.`contact_id` = c.`id` where ic.`type` = '".$type."' and c.`contact_type` = 1 and ic.`invoice_id` = '".$invoice_id."'  ")->row();

		$site_info = $CI->db->query("SELECT c.`firstname`,c.`phonenumber` from tblinvoiceclientperson as ic LEFT JOIN tblcontacts as c ON ic.`contact_id` = c.`id` where ic.`type` = '".$type."' and c.`contact_type` = 2 and ic.`invoice_id` = '".$invoice_id."'  ")->row();

		$office_name = '';
		$office_number = '';
		$site_name = '';
		$site_number = '';
		if(!empty($office_info)){
			$office_name = $office_info->firstname;
			$office_number = $office_info->phonenumber;
		}
		if(!empty($site_info)){
			$site_name = $site_info->firstname;
			$site_number = $site_info->phonenumber;
		}


		$person_data = array(
			'office_name' => $office_name,
			'office_number' => $office_number,
			'site_name' => $site_name,
			'site_number' => $site_number,
		 );
		return $person_data;


    }
}

if(!function_exists('creditnote_contact_person'))
{
    function creditnote_contact_person($invoice_id)
    {
		$CI =& get_instance();

		$office_info = $CI->db->query("SELECT c.`firstname`,c.`phonenumber` from tblinvoiceclientperson as ic LEFT JOIN tblcontacts as c ON ic.`contact_id` = c.`id` where ic.`type` = 'creditnote' and c.`contact_type` = 1 and ic.`invoice_id` = '".$invoice_id."'  ")->row();

		$site_info = $CI->db->query("SELECT c.`firstname`,c.`phonenumber` from tblinvoiceclientperson as ic LEFT JOIN tblcontacts as c ON ic.`contact_id` = c.`id` where ic.`type` = 'creditnote' and c.`contact_type` = 2 and ic.`invoice_id` = '".$invoice_id."'  ")->row();


		$office_name = '';
		$office_number = '';
		$site_name = '';
		$site_number = '';
		if(!empty($office_info)){
			$office_name = $office_info->firstname;
			$office_number = $office_info->phonenumber;
		}
		if(!empty($site_info)){
			$site_name = $site_info->firstname;
			$site_number = $site_info->phonenumber;
		}


		$person_data = array(
			'office_name' => $office_name,
			'office_number' => $office_number,
			'site_name' => $site_name,
			'site_number' => $site_number,
		 );
		return $person_data;


    }
}


if(!function_exists('invoice_received'))
{
    function invoice_received($invoice_id)
    {
		$CI =& get_instance();

		//return $CI->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblinvoicepaymentrecords`  where `paymentmethod` = '2' and invoiceid = '".$invoice_id."' ")->row()->ttl_amount;

		$payment_info = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,p.amount FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$invoice_id."' and cp.status = 1 order by p.id asc ")->result();

		$amount = 0;
		if(!empty($payment_info)){
			foreach ($payment_info as $value) {
				$to_see = ($value->payment_mode == 1 && $value->chaque_status != 1) ? '0' : '1';
				if($to_see == 1){
					$amount += $value->amount;
				}
			}
		}
		return $amount;

    }
}

if(!function_exists('invoice_tds_received'))
{
    function invoice_tds_received($invoice_id)
    {
		$CI =& get_instance();

		//return $CI->db->query("SELECT COALESCE(SUM(paid_tds_amt),0) AS ttl_amount FROM `tblinvoicepaymentrecords`  where `paymentmethod` = '2' and  invoiceid = '".$invoice_id."' ")->row()->ttl_amount;

		$payment_info = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,p.paid_tds_amt FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$invoice_id."' and cp.status = 1 order by p.id asc ")->result();

		$amount = 0;
		if(!empty($payment_info)){
			foreach ($payment_info as $value) {
				$to_see = ($value->payment_mode == 1 && $value->chaque_status != 1) ? '0' : '1';
				if($to_see == 1){
					$amount += $value->paid_tds_amt;
				}
			}
		}
		return $amount;

    }
}

if(!function_exists('debitnote_received'))
{
    function debitnote_received($debitnote_no)
    {
		$CI =& get_instance();

		//return $CI->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblinvoicepaymentrecords`  where `paymentmethod` = '3' and debitnote_no = '".$debitnote_no."' ")->row()->ttl_amount;

		$payment_info = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,p.amount FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote_no."' and cp.status = 1 order by p.id asc ")->result();

		$amount = 0;
		if(!empty($payment_info)){
			foreach ($payment_info as $value) {
				$to_see = ($value->payment_mode == 1 && $value->chaque_status != 1) ? '0' : '1';
				if($to_see == 1){
					$amount += $value->amount;
				}
			}
		}
		return $amount;

    }
}

if(!function_exists('debitnote_tds_received'))
{
    function debitnote_tds_received($debitnote_no)
    {
		$CI =& get_instance();

		//return $CI->db->query("SELECT COALESCE(SUM(paid_tds_amt),0) AS ttl_amount FROM `tblinvoicepaymentrecords`  where `paymentmethod` = '3' and debitnote_no = '".$debitnote_no."' ")->row()->ttl_amount;

		$payment_info = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,p.paid_tds_amt FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote_no."' and cp.status = 1 order by p.id asc ")->result();

		$amount = 0;
		if(!empty($payment_info)){
			foreach ($payment_info as $value) {
				$to_see = ($value->payment_mode == 1 && $value->chaque_status != 1) ? '0' : '1';
				if($to_see == 1){
					$amount += $value->paid_tds_amt;
				}
			}
		}
		return $amount;

    }
}


if(!function_exists('update_invoice_final_amount'))
{
    function update_invoice_final_amount($id)
    {
		$CI =& get_instance();
		$CI->load->model('invoices_model');

		$invoice =  $CI->invoices_model->get($id);

		$check_invoice_rent_item = check_proposal_item($invoice->id,0,'invoice');
        $check_invoice_sale_item = check_proposal_item($invoice->id,1,'invoice');

        if($check_invoice_rent_item>=1){
          $type = 'rent';
        }elseif($check_invoice_sale_item>=1){
          $type = 'sale';
        }

        if($type=='sale')
        {
            $othercharges=get_pro_invoice_othercharges($invoice->id,'1');

        }
        else if($type=='rent')
        {
            $othercharges=get_pro_invoice_othercharges($invoice->id,'0');

        }


		$final_amount = 0;
		$ttl_tax_amt = 0;

		 if(!empty($invoice->items)){
               $total_price = 0;
               foreach ($invoice->items as $key => $value) {
                  $qty = $value['qty'];
                  $rate = $value['rate'];
                  $weight = $value['weight'];
                  $dis = $value['discount'];
                  if($invoice->invoice_for == 1){
		          $prodtax = $value['prodtax'];
		        }else{
		          $prodtax = 0.1;
		        }

                  if($value['is_sale'] == 0){
                     $totalmonths = ($value['months'] + ($value['days'] / 30));
                     $price = ($rate * $qty * $totalmonths * $weight);
                  }else{
                     $price = ($rate * $qty * $weight);
                  }

                  $dis_price = ($price*$dis/100);

                  $final_price = ($price - $dis_price);

				//Applying TAX after discount
				$tax_amt = ($final_price*$prodtax/100);
				$final_price = ($final_price+$tax_amt);
				$ttl_tax_amt += $tax_amt;

                  $total_price += $final_price;

              }
        }

		$discount = 0;
		if(!empty($invoice->discount_percent > 0)){
			$discount = ($total_price*$invoice->discount_percent/100);
		}

		$othercharges_ttl = 0;
		if(!empty($othercharges)){
			foreach ($othercharges as $key => $value) {
				$total_price += $value['total_maount'];
				$othercharges_ttl += $value['total_maount'];
			}

		if($invoice->other_charges_tax == 2){
			$other_tax_amt = ($othercharges_ttl*18/100);
			$total_price = ($other_tax_amt+$total_price);
			$ttl_tax_amt += $other_tax_amt;
		}

		}

      	$final_amount = ($total_price - $discount);
        $update = $CI->db->query("Update `tblinvoices` set total_tax = '".$ttl_tax_amt."', total = '".$final_amount."' where id = '".$id."' ");

    }
}

if(!function_exists('get_company_details'))
{
    function get_company_details()
    {
		$CI =& get_instance();

		$info = $CI->db->query("SELECT * FROM `tbloptions` where id IN (29,30,31,32,33,190,178) ")->result();

		$arrayName = array(
					'company_name' => $info[0]->value,
					'gst' => $info[5]->value,
					'address' => $info[1]->value.' <br/>'.$info[2]->value.', '.$info[6]->value.', '.$info[3]->value.' - '.$info[4]->value,
			);

		return $arrayName;

    }
}

if(!function_exists('get_branch_details'))
{
    function get_branch_details($id)
    {
		$CI =& get_instance();

		$info = $CI->db->query("SELECT * FROM `tblcompanybranch` where id = '".$id."' ")->row();

		$city_name = '--';
		$state_name = '--';
		if($info->city > 0){
			$city_name = value_by_id('tblcities',$info->city,'name');
		}
		if($info->state > 0){
			$state_name = value_by_id('tblstates',$info->state,'name');
		}

		$arrayName = array(
					'gst' => $info->gst_no,
					'address' => $info->address.' <br/>'.$city_name.', '.$state_name.', IN - '.$info->pincode,
			);

		return $arrayName;

    }
}


if(!function_exists('employee_single_branch'))
{
    function employee_single_branch($id)
    {
		$CI =& get_instance();

		$staff_info = $CI->db->query("SELECT `branch_id` FROM `tblstaff` where `staffid`= '".$id."' ")->row();

		$branch_str = $staff_info->branch_id;

		$branch_arr = explode(",",$branch_str);

		return $branch_arr[0];


    }
}

if(!function_exists('main_client_info'))
{
    function main_client_info($id)
    {
		$CI =& get_instance();

		$client_info = $CI->db->query("SELECT * FROM `tblclients` where `userid`= '".$id."' ")->row();

		return $client_info;


    }
}

if(!function_exists('client_info'))
{
    function client_info($id)
    {
		$CI =& get_instance();

		$client_info = $CI->db->query("SELECT * FROM `tblclientbranch` where `userid`= '".$id."' ")->row();

		return $client_info;


    }
}


if(!function_exists('get_staff_loan_balance'))
{
    function get_staff_loan_balance($staff_id)
    {

		$CI =& get_instance();

		$loan_info = $CI->db->query("SELECT r.* from tblrequests as r LEFT JOIN tblstaffloanlog as l ON r.id = l.request_id where r.category = 3 and r.addedfrom = '".$staff_id."' and r.approved_status = 1 and r.confirmed_by_user = 1 and r.receive_status=1 and r.cancel = 0 and l.status = '0'  group by r.id ORDER BY r.date desc")->result();
		$paid_amt = 0;
		$req_amt = 0;
		if(!empty($loan_info)){
			foreach ($loan_info as $row) {
				$query = $CI->db->query("SELECT sum(paid_amount) as paid_amt FROM `tblstaffloanlog` where request_id = '".$row->id."' ");
				if($query->num_rows()>0){
					$paid_amt += $query->row()->paid_amt;
				}

				$req_amt += $row->approved_amount;
			}
		}

		$f_amt = ($req_amt-$paid_amt);

		return number_format($f_amt, 2, '.', '');

    }
}


if(!function_exists('get_company_signature'))
{
    function get_company_signature($staff_id = "")
    {
        $from_email = "admin@schachengineers.com";
        $from_contact = "+91-7304997369";
        if ($staff_id != ""){
            $staff_data = get_employee_info($staff_id);
            $from_email = $staff_data->email;
            $from_contact = "+91-".$staff_data->phonenumber;
        }
    	$company_info = get_company_details();

    	//$html = '<br/><img height="100" width="250" src="'.base_url('uploads/company/logo.png').'">';
    	/*$html = '<br/><hr><img height="100" width="250" src="https://schachengineers.com/schacrm/uploads/company/logo.png">';
    	$html .= '<h3>'.$company_info['company_name'].'</h3><p>|+91-73049 97369| admin@schachengineers.com www.schachengineers.com</p><p>'.$company_info['address'].'</p>';
*/
$html = '<br/>
<table style="width: 525px; font-size: 11pt; font-family: Arial, sans-serif;"  cellspacing="0" cellpadding="0">
<tbody>
 <tr>
  <td style="font-size: 10pt; font-family: Arial, sans-serif; border-right: 1px solid; border-right-color: #fb6303; width: 125px; padding-right: 10px; vertical-align: top;" rowspan="6"  width="125" valign="top">	<a href="https://schachengineers.com" target="_blank"><img alt="Logo" style="width:200px; height:80px; border:0;" src="https://schachengineers.com/schacrm/uploads/company/mail_logo.png" width="105" border="0"></a>
  <hr>
  <div style="font-size: 10px; color: #AF3737; margin-top: 10px;">Mumbai | Delhi NCR | Pune | Ahmedabad | Bengaluru | Chennai | Hyderabad | Kolkata | Bhubaneshwar | Lucknow | Panaji </div>
  </td>

 <td style="padding-left:10px">
  <table cellspacing="0" cellpadding="0">
  <tbody>
    <tr>
      <td style="font-size: 10pt; color:#0079ac; font-family: Arial, sans-serif; width: 400px; padding-bottom: 5px; padding-left: 10px; vertical-align: top;" valign="top">
       <strong><span style="font-size: 11pt; font-family: Arial, sans-serif; color:#fb6303;">'.$company_info['company_name'].'</span></strong>
      </td>
    </tr>
    <tr>
      <td style="font-size: 10pt; color:#444444; font-family: Arial, sans-serif; padding-bottom: 5px; padding-top: 5px; padding-left: 10px; vertical-align: top; line-height:17px;" valign="top">  	<span>		<span style="color: #fb6303;"><strong>Address: </strong></span>	</span>	<span>		<span style="font-family: Arial, sans-serif; font-size:10pt; color:#000000;">'.$company_info['address'].'</span>   	</span>	<br/><span style="color: #fb6303;"><strong>Email:</strong></span><span style="font-size: 10pt; font-family: Arial, sans-serif; color:#000000;"> '.$from_email.'</span></span>	<span><span> <br/> </span><span style="color: #fb6303;"><strong>Website:</strong></span><a href="https://www.schachengineers.com" target="_blank" rel="noopener" style="text-decoration:none;"><span style="font-size: 10pt; font-family: Arial, sans-serif; color:#000000;"> www.schachengineers.com</span></a></span>
        	<span><br></span>	<span><span style="color: #fb6303;"><strong>Phone:</strong></span><span style="font-size: 10pt; font-family: Arial, sans-serif; color:#000000;"> '.$from_contact.'</span></span>

      </td>
    </tr>
    <tr>
      <td style="font-size: 10pt; font-family: Arial, sans-serif; padding-bottom: 0px; padding-top: 5px; padding-left: 10px; vertical-align: bottom;" valign="bottom">
        <span><a href="https://www.facebook.com/SchachEngineers/" target="_blank" rel="noopener"><img alt="facebook icon" style="border:0; height:19px; width:19px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/pad-box/fb.png" width="19" border="0"></a>&nbsp;</span><span><a href="https://twitter.com/schachengineers" target="_blank" rel="noopener"><img alt="twitter icon" style="border:0; height:19px; width:19px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/pad-box/tt.png" width="19" border="0"></a>&nbsp;</span><span><a href="https://www.youtube.com/user/schachengineers" target="_blank" rel="noopener"><img alt="youtube icon" style="border:0; height:19px; width:19px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/pad-box/yt.png" width="19" border="0"></a>&nbsp;</span><span><a href="http://us.linkedin.com/in/schach-engineers-p-ltd" target="_blank" rel="noopener"><img alt="linkedin icon" style="border:0; height:19px; width:19px" src="https://codetwocdn.azureedge.net/images/mail-signatures/generator/pad-box/ln.png" width="19" border="0"></a>&nbsp;&nbsp;</span><span><a href="http://api.whatsapp.com/send?phone=919029902958&amp;amp;text=I+am+interested,+please+call+me+back." target="_blank" rel="noopener"><img alt="whatsapp icon" style="border:0; height:19px; width:19px" src="https://ci6.googleusercontent.com/proxy/DCtUmd04UjBwlN1UiRsex8kibUPmyO8DgWedZALOf1YwUkkyP9oM3MNUqsKyTU8blGJQwL00tikzvJyM-dcTz8Hldw1AJ2XTga8V7A=s0-d-e1-ft#https://schachengineers.com/upload/signature/whatsapp.png" width="19" border="0"></a>&nbsp;</span>
      </td>
     </tr>

  </tbody>
  </table>
 </td></tr>
</tbody>
</table>

';
    	return $html;

	}

}



if(!function_exists('get_menu'))
{
    function get_menu()
    {
		$staff_id = get_staff_user_id();
		$CI =& get_instance();

		$html = '';
		$perent_menu  = $CI->db->query("SELECT * FROM tblmenumaster WHERE parent_id = 0 and status =  '1' order by order_no asc ")->result();

		if(!empty($perent_menu)){
			foreach ($perent_menu as $r) {
				$p_assigned  = $CI->db->query("SELECT * FROM tblmenuassigned WHERE staff_id = '".$staff_id."' and menu_id =  '".$r->id."' and view = 1 ")->row();

				if(!empty($p_assigned)){
					if($r->link == '#'){
						$child_menu  = $CI->db->query("SELECT * FROM tblmenumaster WHERE parent_id = '".$r->id."' and status =  '1' order by order_no asc ")->result();

						$html .= '<li><a href="#" aria-expanded="false"><i class="'.$r->icon.'"></i>'.$r->name.'<span class="fa arrow"></span></a>';

						if(!empty($child_menu)){
							$html .= '<ul class="nav nav-second-level collapse" aria-expanded="false">';

							foreach ($child_menu as $r1) {
								$c_assigned  = $CI->db->query("SELECT * FROM tblmenuassigned WHERE staff_id = '".$staff_id."' and menu_id =  '".$r1->id."' and view = 1 ")->row();

								if(!empty($c_assigned)){
									$html .= '<li><a href="' . base_url($r1->link) . '">'.$r1->name.'</a></li>';
								}
							}

							$html .= '</ul>';
						}

        				$html .= '</li>';
					}else{
						$html .= '<li class="menu-item-customers">
                       					<a href="' . base_url($r->link) . '" aria-expanded="false"><i class="'.$r->icon.'"></i>'.$r->name.'</a>
                                  </li>';
					}

				}

			}
		}

		return $html;

    }
}

if(!function_exists('get_new_menu'))
{
    function get_new_menu()
    {
		$staff_id = get_staff_user_id();
		$CI =& get_instance();

		$html = '';
		$perent_menu  = $CI->db->query("SELECT m.* FROM tblmenumaster as m INNER JOIN tblmenuassigned as ma ON m.id = ma.menu_id WHERE ma.staff_id = '".$staff_id."' and m.parent_id = 0 and m.status =  '1' order by order_no asc ")->result();

		if(!empty($perent_menu)){
			foreach ($perent_menu as $r) {

					if($r->link == '#'){
						$child_menu  = $CI->db->query("SELECT m.* FROM tblmenumaster as m INNER JOIN tblmenuassigned as ma ON m.id = ma.menu_id WHERE ma.staff_id = '".$staff_id."' and m.parent_id = '".$r->id."' and m.sub_id = 0 and m.status =  '1' order by order_no asc ")->result();

						$html .= '<li><a href="#" aria-expanded="false"><i class="'.$r->icon.'"></i>'.$r->name.'<span class="fa arrow"></span></a>';


						if(!empty($child_menu)){
							$html .= '<ul class="nav nav-second-level collapse" aria-expanded="false">';
							foreach ($child_menu as $r1) {
								if($r1->is_sub == 1){
									$sub_menu  = $CI->db->query("SELECT m.* FROM tblmenumaster as m INNER JOIN tblmenuassigned as ma ON m.id = ma.menu_id WHERE ma.staff_id = '".$staff_id."' and m.parent_id = '".$r->id."' and m.sub_id = '".$r1->id."' and m.status =  '1' order by order_no asc ")->result();

									$html .= '<li><a href="#" aria-expanded="false">'.$r1->name.'<span class="fa arrow"></span></a>';
									if(!empty($sub_menu)){
										$html .= '<ul class="nav nav-second-level collapse" aria-expanded="false">';
										foreach ($sub_menu as $r2) {
											$html .= '<li><a href="' . base_url($r2->link) . '">'.$r2->name.'</a></li>';
										}
										$html .= '</ul>';
									}

								}else{
									$html .= '<li><a href="' . base_url($r1->link) . '">'.$r1->name.'</a></li>';
								}

							}
							$html .= '</ul>';
						}



        				$html .= '</li>';
					}else{
						$html .= '<li class="menu-item-customers">
                       					<a href="' . base_url($r->link) . '" aria-expanded="false"><i class="'.$r->icon.'"></i>'.$r->name.'</a>
                                  </li>';
					}


			}
		}

		return $html;

    }
}

if(!function_exists('get_po_items_list'))
{
    function get_po_items_list($id)
    {
		$CI =& get_instance();

		$item_info = $CI->db->query("SELECT * FROM `tblpurchaseorderproduct` where po_id = '".$id."' ")->result_array();

		if(!empty($item_info)){
			return $item_info;
		}

    }
}

if(!function_exists('get_debitnote_items_list'))
{
    function get_debitnote_items_list($id)
    {
		$CI =& get_instance();

		$item_info = $CI->db->query("SELECT * FROM `tbldebitnoteproduct` where debitnote_id = '".$id."' ")->result_array();

		if(!empty($item_info)){
			return $item_info;
		}

    }
}

if(!function_exists('get_creditnote_items_list'))
{
    function get_creditnote_items_list($id)
    {
		$CI =& get_instance();

		$item_info = $CI->db->query("SELECT * FROM `tblcreditnoteproduct` where creditnote_id = '".$id."' ")->result_array();

		if(!empty($item_info)){
			return $item_info;
		}

    }
}

if(!function_exists('get_purchase_creditnote_items_list'))
{
    function get_purchase_creditnote_items_list($id)
    {
		$CI =& get_instance();

		$item_info = $CI->db->query("SELECT * FROM `tblpurchasecreditnoteproduct` where creditnote_id = '".$id."' ")->result_array();

		if(!empty($item_info)){
			return $item_info;
		}

    }
}

if(!function_exists('get_vendor_info'))
{
    function get_vendor_info($id)
    {
		$CI =& get_instance();

		$vendor_info = $CI->db->query("SELECT * FROM `tblvendor` where id = '".$id."' ")->row();


		$city_name = '--';
		$state_name = '--';
		if($vendor_info->city_id > 0){
			$city_name = value_by_id('tblcities',$vendor_info->city_id,'name');
		}
		if($vendor_info->state_id > 0){
			$state_name = value_by_id('tblstates',$vendor_info->state_id,'name');
		}


		$p_data = array(
			'name' => $vendor_info->name,
			'address' => $vendor_info->address,
			'city' => $city_name,
			'state' => $state_name,
			'email' => $vendor_info->email,
			'phone' => $vendor_info->contact_number,
			'contact_person' => $vendor_info->vendor_contact_person,
			'gst' => $vendor_info->gst_no,
			'zip' => $vendor_info->pincode,
			'pan_no' => $vendor_info->pan_no,
		 );
		return $p_data;


    }
}

if(!function_exists('get_warehouse_info'))
{
    function get_warehouse_info($id)
    {
		$CI =& get_instance();

		$warehouse_info = $CI->db->query("SELECT * FROM `tblwarehouse` where id = '".$id."' ")->row();


		$city_name = '--';
		$state_name = '--';
		if($warehouse_info->city > 0){
			$city_name = value_by_id('tblcities',$warehouse_info->city,'name');
		}
		if($warehouse_info->state > 0){
			$state_name = value_by_id('tblstates',$warehouse_info->state,'name');
		}


		$p_data = array(
			'name' => $warehouse_info->name,
			'address' => $warehouse_info->address,
			'cont_name' => $warehouse_info->cont_name,
			'city' => $city_name,
			'state' => $state_name,
			'email' => $warehouse_info->email_id_1,
			'phone' => $warehouse_info->cont_no_1,
			'phone_2' => $warehouse_info->cont_no_2,
			'zip' => $warehouse_info->pincode,
			'pincode' => $warehouse_info->pincode,
		 );
		return $p_data;


    }
}

if(!function_exists('get_branch_info'))
{
    function get_branch_info($id)
    {
		$CI =& get_instance();

		$info = $CI->db->query("SELECT * FROM `tblcompanybranch` where id = '".$id."' ")->row();


		$city_name = '--';
		$state_name = '--';
		if($info->city > 0){
			$city_name = value_by_id('tblcities',$info->city,'name');
		}
		if($info->state > 0){
			$state_name = value_by_id('tblstates',$info->state,'name');
		}


		$p_data = array(
			'name' => $info->comp_branch_name,
			'address' => $info->address,
			'cont_name' => '',
			'city' => $city_name,
			'state' => $state_name,
			'email' => $info->email_id,
			'phone' => $info->phone_no_1,
			'zip' => $info->pincode,
		);
		return $p_data;
    }
}

if(!function_exists('get_vendor_gst_type'))
{
    function get_vendor_gst_type($vendor_id)
    {
		$CI =& get_instance();
		$branch_id = $CI->session->userdata('staffbranch');

		if(!empty($branch_id)){
			$branch_info = $CI->db->query("SELECT * FROM `tblcompanybranch` where `id`='".$branch_id."' ")->row();
			$branch_state = $branch_info->state;

			$vendor_info = $CI->db->query("SELECT * FROM `tblvendor` where `id`='".$vendor_id."' ")->row();
			$client_state = $vendor_info->state_id;

			if($branch_state == $client_state){
				return 1;
			}else{
				return 2;
			}
		}else{
			return 1;
		}

    }
}

if(!function_exists('get_client_gst_type'))
{
    function get_client_gst_type($client_id)
    {
		$CI =& get_instance();
		$branch_id = $CI->session->userdata('staffbranch');

		if(!empty($branch_id)){
			$branch_info = $CI->db->query("SELECT * FROM `tblcompanybranch` where `id`='".$branch_id."' ")->row();
			$branch_state = $branch_info->state;

			$client_info = $CI->db->query("SELECT * FROM `tblclientbranch` where `userid`='".$client_id."' ")->row();
			$client_state = $client_info->state;

			if($branch_state == $client_state){
				return 1;
			}else{
				return 2;
			}
		}else{
			return 1;
		}

    }
}


if(!function_exists('check_permission'))
{
    function check_permission($menu_id,$type)
    {
		$CI =& get_instance();
		$user_id = $CI->session->userdata('staff_user_id');

		$permission_info = $CI->db->query("SELECT * FROM `tblmenuassigned` where `staff_id`='".$user_id."' and menu_id IN (".$menu_id.") and `".$type."` = '1' ")->row();

		if(empty($permission_info)){
			access_denied();
		}

    }
}

if(!function_exists('check_permission_page'))
{
    function check_permission_page($menu_id,$type)
    {
		$CI =& get_instance();
		$user_id = $CI->session->userdata('staff_user_id');

		$permission_info = $CI->db->query("SELECT * FROM `tblmenuassigned` where `staff_id`='".$user_id."' and menu_id IN (".$menu_id.") and `".$type."` = '1' ")->row();

		if(empty($permission_info)){
			return FALSE;
		}else{
			return TRUE;
		}

    }
}


if(!function_exists('leave_maturity_date'))
{
    function leave_maturity_date($user_id)
    {
		$CI =& get_instance();

		$user_info = get_staff_info($user_id);
		$paid_leave_time = $user_info->paid_leave_time;
		$joining_date = $user_info->joining_date;

		$effectiveDate = date('m-d', strtotime("+".$paid_leave_time." months", strtotime($joining_date)));


		$n_year = date('Y')-1;

		$maturity_date = $n_year.'-'.$effectiveDate;

		return date('Y-m-d', strtotime($maturity_date));
	}

}


if(!function_exists('leave_provisional_date'))
{
    function leave_provisional_date($user_id)
    {
		$CI =& get_instance();

		$user_info = get_staff_info($user_id);
		$paid_leave_time = $user_info->paid_leave_time;
		$joining_date = $user_info->joining_date;

		return $effectiveDate = date('Y-m-d', strtotime("+".$paid_leave_time." months", strtotime($joining_date)));

	}
}


if(!function_exists('staff_leave_daterange'))
{
    function staff_leave_daterange($user_id)
    {

		$CI =& get_instance();

		$from_date  = '0000:00:00';
    	$to_date  = '0000:00:00';

		$provision_date = leave_provisional_date($user_id);
		$current_year = date('Y');
		$provision_year = date('Y',strtotime($provision_date));

		$balance_year = ($current_year - $provision_year);

		if($balance_year <= 1){
			$from_date = $provision_date;
			$to_date = date("Y-m-d", strtotime("+1 years", strtotime($from_date)));

			// New Logic
			if($to_date < date('Y-m-d')){
				$from_date = $to_date;
				$to_date = date("Y-m-d", strtotime("+1 years", strtotime($to_date)));
			}
			//End New Logic
		}else{
			/*$from_date = date('Y-m-d', strtotime("+".$balance_year." years", strtotime($provision_date)));
			$to_date = date("Y-m-d", strtotime("+1 years", strtotime($from_date)));

			if($to_date > date('Y-m-d')){
				$from_date = date("Y-m-d", strtotime("-1 years", strtotime($from_date)));
				$to_date = date("Y-m-d", strtotime("+1 years", strtotime($from_date)));
			}*/

			// New Logic By Kapil
			$start_date= date('Y-m-d', strtotime("+".$balance_year." years", strtotime($provision_date)));
			if($start_date > date('Y-m-d')){

				$from_date = date("Y-m-d", strtotime("-1 years", strtotime($start_date)));
				$to_date = $start_date;

			}else{
				$from_date = $start_date;
				$to_date = date("Y-m-d", strtotime("+1 years", strtotime($from_date)));
			}


		}





		$return_arr = array(
				'from_date' => $from_date,
				'to_date' => $to_date,
			);

		return $return_arr;
	}

}


if(!function_exists('leave_taken_inmonth'))
{
    function leave_taken_inmonth($user_id,$category,$month,$year,$total_days)
    {
    	$CI =& get_instance();

    	$check = 1;
    	if($category == 1 || $category == 2){

    		$count = $CI->db->query("SELECT count(id) as ttl_count FROM `tblleaves` WHERE YEAR(from_date) = '".$year."' AND MONTH(from_date) = '".$month."' and category IN (1,2) and approved_status = '1' and is_paid_leave = '1' and addedfrom = '".$user_id."' ")->row()->ttl_count;
    		$final_count = ($count + $total_days);
    		if($final_count > 2){
    			$check = 0;
    		}
    	}
    	return $check;
    }
}

if(!function_exists('po_next_number'))
{
    function po_next_number()
    {
        $CI =& get_instance();
        $year_id = financial_year();
        $number = $CI->db->query("SELECT COALESCE(max(po_number),0) as po_number FROM `tblpurchaseorder` where  cancel = 0 and year_id = '".$year_id."' ")->row()->po_number;
        if($number > 0){
            $next_no = ($number + 1);
    	}else{
            $next_no = value_by_id_empty('tblfinancialyear',$year_id,'po_no');
    	}

    	$prefix = 'PO';
    	$suffix = value_by_id_empty('tblfinancialyear',$year_id,'slug');
        $po_number = str_pad($next_no, 4, '0', STR_PAD_LEFT);

        return $po_number.'/'.$prefix.'/'.$suffix;
        //return $year_id;
    }
}

if(!function_exists('mr_next_number'))
{
    function mr_next_number()
    {
        $CI =& get_instance();
        $year_id = financial_year();
        $number = $CI->db->query("SELECT COALESCE(max(mr_number),0) as mr_number FROM `tblmaterialreceipt` where  year_id = '".$year_id."' ")->row()->mr_number;
        if($number > 0){
            $next_no = ($number + 1);
    	}else{
            $next_no = value_by_id_empty('tblfinancialyear',$year_id,'mr_no');
    	}

    	$prefix = 'MR';
    	$suffix = value_by_id_empty('tblfinancialyear',$year_id,'slug');
        $mr_number = str_pad($next_no, 4, '0', STR_PAD_LEFT);

	if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
//            return $n_prefix.'/'.$po_number.'/'.$suffix;
            return $mr_number.'/'.$prefix.'/'.$suffix;
        }else{
            return $mr_number.'/'.$prefix.'/'.$suffix;
        }
    }
}

if(!function_exists('handover_for_send'))
{
    function handover_for_send($user_id)
    {
		$CI =& get_instance();

		$info = $CI->db->query("SELECT handover_id,id FROM `tblhandoverlog` where received_status = 1 and receiver_id = '".$user_id."' order by id desc  ")->result();

		$return_arr = array();
		if(!empty($info)){
			foreach ($info as $value) {

				$check_row = $CI->db->query("SELECT id FROM `tblhandoverlog` where handover_id = '".$value->handover_id."' and sender_staff_id = '".$user_id."' and id > '".$value->id."' ")->row();
				if(empty($check_row)){

					//$receiver_list = $CI->db->query("SELECT h.title,h.receiver_id as r_id,hl.* from tblhandover as h LEFT JOIN tblhandoverlog as hl ON h.id = hl.handover_id where  hl.id = '".$value->id."' ")->row();

					$receiver_list = $CI->db->query("SELECT h.title,h.receiver_id as r_id,hl.* from tblhandover as h LEFT JOIN tblhandoverlog as hl ON h.id = hl.handover_id where  hl.id = '".$value->id."' and h.final_receive = 0 ")->row();

					if(!empty($receiver_list->id > 0)){
						$return_arr[] = $receiver_list;
					}


				}
			}
		}


		return $return_arr;

    }
}


if(!function_exists('get_terms_conditions'))
{
    function get_terms_conditions($slug,$for=0,$type=0)
    {
		$CI =& get_instance();
		if(!empty($type) && !empty($type)){
			$info = $CI->db->query("SELECT tc.terms_conditions FROM `tbltermsandconditions` as tc RIGHT JOIN `tblproducttypemaster` as pt ON pt.type = tc.type WHERE tc.slug = '".$slug."' and tc.for = '".$for."' and pt.id = '".$type."' ")->row();
		}else{
			$info = $CI->db->query("SELECT terms_conditions FROM `tbltermsandconditions` where slug = '".$slug."' and `for` = '0' and `type` = '0' ")->row();
		}
		

		return $info->terms_conditions;

	}

  function getTermsConditions($slug,$for=0,$type=0)
  {
      $CI =& get_instance();
      $condition_list = array();
      if(!empty($type) && !empty($type)){
        $info = $CI->db->query("SELECT tc.id FROM `tbltermsandconditions` as tc RIGHT JOIN `tblproducttypemaster` as pt ON pt.type = tc.type WHERE tc.slug = '".$slug."' and tc.for = '".$for."' and pt.id = '".$type."' ")->row();

        if (!empty($info)){
           $condition_list = $CI->db->query("SELECT * FROM tbltermsandconditionspointers WHERE terms_condition_id = '".$info->id."'")->result();
        }
      }else{
        $info = $CI->db->query("SELECT id FROM `tbltermsandconditions` where slug = '".$slug."' and `for` = '0' and `type` = '0' ")->row();
        if (!empty($info)){
           $condition_list = $CI->db->query("SELECT * FROM tbltermsandconditionspointers WHERE terms_condition_id = '".$info->id."'")->result();
        }
      }
      
      return $condition_list;
  }

}

if(!function_exists('get_product_units'))
{
    function get_product_units($product_id)
    {
		$CI =& get_instance();
		//$info = $CI->db->query("SELECT terms_conditions FROM `tbltermsandconditions` where slug = '".$slug."' and `for` = '".$for."' and `type` = '".$type."' ")->row();

		$unit = 'pcs';

		$unit_id = value_by_id('tblproducts',$product_id,'unit_2');
		if($unit_id > 0){
			$unit = value_by_id('tblunitmaster',$unit_id,'name');
		}


		return $unit;

	}

}


if(!function_exists('get_login_branch'))
{
    function get_login_branch()
    {
		$CI =& get_instance();
		return $branch_id = $CI->session->userdata('staffbranch');
	}
}


if(!function_exists('update_quotation_billto_datails'))
{
    function update_quotation_billto_datails($lead_id)
    {
		$CI =& get_instance();
		$lead_info = $CI->db->query("SELECT * FROM `tblleads` where id = '".$lead_id."' ")->row();

		if(empty($lead_info->company)) {
			$clientbranchdet = $CI->db->query("SELECT * FROM `tblclientbranch` WHERE `userid`='".$lead_info->client_branch_id."'")->row();
			$to = $clientbranchdet->client_branch_name;
		}else{
			$to = $lead_info->company;
		}

        $address = $lead_info->address;
        $email   = $lead_info->email;
        $zip     = $lead_info->zip;
        $phone   = $lead_info->phonenumber;
        $state   = $lead_info->state;
        $city    = $lead_info->city;

        $proposal_info = $CI->db->query("SELECT * FROM `tblproposals` WHERE `rel_id`='".$lead_id."'")->result();
        if(!empty($proposal_info)){
        	foreach ($proposal_info as $row) {
        		$update = $CI->db->query("Update `tblproposals` set proposal_to = '".$to."', address = '".$address."', city = '".$city."', state = '".$state."', email = '".$email."', phone = '".$phone."', zip = '".$zip."' where id = '".$row->id."' ");
        	}
        }
	}

}

if(!function_exists('get_po_approvers'))
{
    function get_po_approvers($id)
    {
		$CI =& get_instance();
		$info = $CI->db->query("SELECT * FROM `tblpurchaseorderapproval` where po_id = '".$id."' and approve_status = 1 order by id asc LIMIT 2  ")->result();

        return $info;
	}

}

if(!function_exists('update_masterapproval_single'))
{
    function update_masterapproval_single($staff_id,$module_id,$table_id,$approve_status)
    {
    	$CI =& get_instance();
    	$update = $CI->db->query("Update `tblmasterapproval` set approve_status = '".$approve_status."', updated_at = '".date('Y-m-d H:i:s')."' where staff_id = '".$staff_id."' and module_id = '".$module_id."' and table_id = '".$table_id."' ");
    }
}

if(!function_exists('update_masterapproval_all'))
{
    function update_masterapproval_all($module_id,$table_id,$status)
    {
    	$CI =& get_instance();
    	$update = $CI->db->query("Update `tblmasterapproval` set status = '".$status."' where module_id = '".$module_id."' and table_id = '".$table_id."' ");
    }
}

if(!function_exists('get_common_status'))
{
    function get_common_status($status)
    {
    	$status_name = '--';
    	if($status == '1'){
    		$status_name = 'Pending';
    	}elseif($status == '2'){
    		$status_name = 'Approved';
    	}elseif($status == '3'){
    		$status_name = 'Rejected';
    	}

    	return $status_name;
	}

}

if(!function_exists('financial_year'))
{
    function financial_year()
    {
    	$CI =& get_instance();
    	return $CI->session->userdata('year_id');
    }
}


if(!function_exists('get_invoice_number'))
{
    function get_invoice_number($service_type, $year_id = '')
    {
    	$CI =& get_instance();
    	if(empty($year_id)){
    		$year_id = financial_year();
    	}
    	

    	$number=$CI->db->query("SELECT COALESCE(max(invoice_number),0) as inv_number FROM `tblinvoices` where service_type = '".$service_type."' and year_id = '".$year_id."' ")->row()->inv_number;

    	if($number > 0){
    		$next_no = ($number + 1);
    	}else{

    		if($service_type == 1){
    			$next_no = value_by_id_empty('tblfinancialyear',$year_id,'invoice_rent_no');
    		}else{
    			$next_no = value_by_id_empty('tblfinancialyear',$year_id,'invoice_sales_no');
    		}
    	}

    	if($service_type == 2){
    		$prefix = 'ST';
    		$n_prefix = 'NT/SO';
    	}else{
    		$prefix = 'RT';
    		$n_prefix = 'NT/RO';
    	}


    	$suffix = value_by_id_empty('tblfinancialyear',$year_id,'slug');
		$invoice_number = str_pad($next_no, 4, '0', STR_PAD_LEFT);

		if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            return $n_prefix.'/'.$invoice_number.'/'.$suffix;
        }else{
            return $invoice_number.'/'.$prefix.'/'.$suffix;
        }
    }
}

if(!function_exists('get_debitnote_number'))
{
    function get_debitnote_number()
    {
    	$CI =& get_instance();
    	$year_id = financial_year();

    	$number_1 =$CI->db->query("SELECT COALESCE(max(dn_number),0) as `number` FROM `tbldebitnote` where year_id = '".$year_id."' and status = 1 ")->row()->number;
    	$number_2 =$CI->db->query("SELECT COALESCE(max(dn_number),0) as `number` FROM `tbldebitnotepayment` where year_id = '".$year_id."' and status = 1 ")->row()->number;

    	if($number_1 > $number_2){
    		$number = $number_1;
    	}else{
    		$number = $number_2;
    	}

    	if($number > 0){
    		$next_no = ($number + 1);
    	}else{
    		$next_no = value_by_id_empty('tblfinancialyear',$year_id,'debitnote_no');
    	}

    	$prefix = 'D';
    	$n_prefix = 'NT/DN';
    	$suffix = value_by_id_empty('tblfinancialyear',$year_id,'slug');
		$invoice_number = str_pad($next_no, 4, '0', STR_PAD_LEFT);

		if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            return $n_prefix.'/'.$invoice_number.'/'.$suffix;
        }else{
            return $invoice_number.'/'.$prefix.'/'.$suffix;
        }
    }
}

if(!function_exists('get_creditnote_number'))
{
    function get_creditnote_number()
    {
    	$CI =& get_instance();
    	$year_id = financial_year();

    	$number =$CI->db->query("SELECT COALESCE(max(cn_number),0) as `number` FROM `tblcreditnote` where year_id = '".$year_id."' and status = 1 ")->row()->number;


    	if($number > 0){
    		$next_no = ($number + 1);
    	}else{
    		$next_no = value_by_id_empty('tblfinancialyear',$year_id,'creditnote_no');
    	}

    	$prefix = 'C';
    	$n_prefix = 'NT/CN';
    	$suffix = value_by_id_empty('tblfinancialyear',$year_id,'slug');
		$invoice_number = str_pad($next_no, 4, '0', STR_PAD_LEFT);

		if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            return $n_prefix.'/'.$invoice_number.'/'.$suffix;
        }else{
            return $invoice_number.'/'.$prefix.'/'.$suffix;
        }
    }
}

if(!function_exists('get_purchase_creditnote_number'))
{
    function get_purchase_creditnote_number()
    {
    	$CI =& get_instance();
    	$year_id = financial_year();

    	$number =$CI->db->query("SELECT COALESCE(max(cn_number),0) as `number` FROM `tblpurchasecreditnote` where year_id = '".$year_id."' and status = 1 ")->row()->number;


    	if($number > 0){
    		$next_no = ($number + 1);
    	}else{
    		$next_no = value_by_id_empty('tblfinancialyear',$year_id,'purchase_creditnote_no');
    	}

    	$prefix = 'C';
    	$n_prefix = 'NT/CN';
    	$suffix = value_by_id_empty('tblfinancialyear',$year_id,'slug');
		$invoice_number = str_pad($next_no, 4, '0', STR_PAD_LEFT);

		if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            return $n_prefix.'/'.$invoice_number.'/'.$suffix;
        }else{
            return $invoice_number.'/'.$prefix.'/'.$suffix;
        }
    }
}


if(!function_exists('get_quotation_number'))
{
    function get_quotation_number($service_type)
    {
    	$CI =& get_instance();
    	$year_id = financial_year();

    	$number=$CI->db->query("SELECT COALESCE(max(proposal_number),0) as pr_number FROM `tblproposals` where service_type = '".$service_type."' and year_id = '".$year_id."' ")->row()->pr_number;

    	if($number > 0){
    		$next_no = ($number + 1);
    	}else{

    		if($service_type == 1){
    			$next_no = value_by_id_empty('tblfinancialyear',$year_id,'quotation_rent_no');
    		}else{
    			$next_no = value_by_id_empty('tblfinancialyear',$year_id,'quotation_sales_no');
    		}
    	}

    	if($service_type == 2){
    		$prefix = 'QT-ST';
    		$n_prefix = "NT/S/QT";
    	}else{
    		$prefix = 'QT-RT';
    		$n_prefix = "NT/R/QT";
    	}


    	$suffix = value_by_id_empty('tblfinancialyear',$year_id,'slug');
		$invoice_number = str_pad($next_no, 4, '0', STR_PAD_LEFT);

		if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            return $n_prefix.'/'.$invoice_number.'/'.$suffix;
        }else{
            return $invoice_number.'/'.$prefix.'/'.$suffix;
        }

    }
}

if(!function_exists('get_pi_number'))
{
    function get_pi_number($service_type)
    {
    	$CI =& get_instance();
    	$year_id = financial_year();

    	$number=$CI->db->query("SELECT COALESCE(max(pi_number),0) as pi_number FROM `tblestimates` where service_type = '".$service_type."' and year_id = '".$year_id."' ")->row()->pi_number;

    	if($number > 0){
    		$next_no = ($number + 1);
    	}else{

    		if($service_type == 1){
    			$next_no = value_by_id_empty('tblfinancialyear',$year_id,'pi_rent_no');
    		}else{
    			$next_no = value_by_id_empty('tblfinancialyear',$year_id,'pi_sales_no');
    		}
    	}

    	if($service_type == 2){
    		$prefix = 'PI-ST';
    		$n_prefix = 'NT/S/PI';
    	}else{
    		$prefix = 'PI-RT';
    		$n_prefix = 'NT/R/PI';
    	}


    	$suffix = value_by_id_empty('tblfinancialyear',$year_id,'slug');
		$invoice_number = str_pad($next_no, 4, '0', STR_PAD_LEFT);

		if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            return $n_prefix.'/'.$invoice_number.'/'.$suffix;
        }else{
            return $invoice_number.'/'.$prefix.'/'.$suffix;
        }
    }
}

if(!function_exists('get_challan_number'))
{
    function get_challan_number($service_type,$rel_id)
    {
		$CI =& get_instance();
    	$year_id = financial_year();

    	$number=$CI->db->query("SELECT COALESCE(max(ch_number),0) as ch_number FROM `tblchalanmst` where service_type = '".$service_type."' and year_id = '".$year_id."' ")->row()->ch_number;

    	$id = $CI->db->query("SELECT COALESCE(count(id),0) as id FROM `tblchalanmst` where rel_id = '".$rel_id."' ")->row()->id;

    	if($number > 0){
    		if($id > 0){
    			$last_number = $CI->db->query("SELECT ch_number FROM `tblchalanmst` where rel_id = '".$rel_id."' ")->row()->ch_number;
    			$next_no = $last_number;
    		}else{
    			$next_no = ($number + 1);
    		}

    	}else{

    		if($service_type == 1){
    			$next_no = value_by_id_empty('tblfinancialyear',$year_id,'challan_rent_no');
    		}else{
    			$next_no = value_by_id_empty('tblfinancialyear',$year_id,'challan_sales_no');
    		}
    	}

    	if($service_type == 2){
    		$prefix = 'CH-ST';
    	}else{
    		$prefix = 'CH-RT';
    	}


    	$suffix = value_by_id_empty('tblfinancialyear',$year_id,'slug');

    	if($id > 0){
    		$invoice_number = str_pad($next_no, 4, '0', STR_PAD_LEFT).'.'.$id;
    	}else{
    		$invoice_number = str_pad($next_no, 4, '0', STR_PAD_LEFT);
    	}


		return $invoice_number.'/'.$prefix.'/'.$suffix;
	}

}


if(!function_exists('get_revice_quotation_number'))
{
    function get_revice_quotation_number($service_type,$quotation_id)
    {
    	$CI =& get_instance();
    	$year_id = financial_year();

    	$next_no=$CI->db->query("SELECT proposal_number as pr_number FROM `tblproposals` where id = '".$quotation_id."' ")->row()->pr_number;
    	$id = $CI->db->query("SELECT COALESCE(count(id),0) as id FROM `tblproposals` where revice_id = '".$quotation_id."' ")->row()->id+1;

    	if($service_type == 2){
    		$prefix = 'QT-ST';
    		$n_prefix = 'NT/S/QT';
    	}else{
    		$prefix = 'QT-RT';
    		$n_prefix = 'NT/R/QT';
    	}


    	$suffix = value_by_id_empty('tblfinancialyear',$year_id,'slug');
		$invoice_number = str_pad($next_no, 4, '0', STR_PAD_LEFT).'.'.$id;

		if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            return $n_prefix.'/'.$invoice_number.'/'.$suffix;
        }else{
            return $invoice_number.'/'.$prefix.'/'.$suffix;
        }
    }
}

if(!function_exists('lead_followup_count'))
{
    function lead_followup_count($finished)
    {
    	$CI =& get_instance();

    	$count = $CI->db->query("SELECT COALESCE(count(id),0) as ttl_count FROM `tblleadfollowup` where finished = '".$finished."' and date = '".date('Y-m-d')."' and staffid = '".get_staff_user_id()."' ")->row()->ttl_count;

		return $count;
    }
}

if(!function_exists('payment_followup_count'))
{
    function payment_followup_count($finished)
    {
    	$CI =& get_instance();

    	$count = $CI->db->query("SELECT COALESCE(count(id),0) as ttl_count FROM `tblpaymentfollowupclients` where finished = '".$finished."' and date = '".date('Y-m-d')."' and staffid = '".get_staff_user_id()."' ")->row()->ttl_count;

		return $count;
    }
}



if(!function_exists('update_po_invoice_status'))
{
    function update_po_invoice_status($po_id)
    {
    	$CI =& get_instance();

    	$mr_info = $CI->db->query("SELECT `id` FROM `tblmaterialreceipt` where po_id='".$po_id."' and status = 1 and invoice_status = 0")->result();
    	if(empty($mr_info)){
    		$update = $CI->db->query("Update `tblpurchaseorder` set invoice_status = 1 where id = '".$po_id."' ");
    	}
	}

}


if(!function_exists('update_purchase_invoice_status_when_delete_edit'))
{
    function update_purchase_invoice_status_when_delete_edit($id)
    {
    	$CI =& get_instance();

    	$purchaseinvoice_info = $CI->db->query("SELECT * FROM `tblpurchaseinvoice` where id='".$id."' ")->row();
    	if(!empty($purchaseinvoice_info)){
    		$po_id = $purchaseinvoice_info->po_id;
    		$mr_id = $purchaseinvoice_info->mr_id;
    		$update_po = $CI->db->query("Update `tblpurchaseorder` set invoice_status = 0 where id = '".$po_id."' ");
    		$update_mr = $CI->db->query("Update `tblmaterialreceipt` set invoice_status = 0 where id IN (".$mr_id.") ");
    	}
	}

}


if(!function_exists('update_purchaseinvoice_final_amount'))
{
    function update_purchaseinvoice_final_amount($id)
    {
		$CI =& get_instance();
		$CI->load->model('invoices_model');

		$invoice_info = $CI->db->query("SELECT * FROM `tblpurchaseinvoice` where id='".$id."' ")->row();
		$purchase_items = $CI->db->query("SELECT * FROM tblpurchaseinvoiceproduct where invoice_id = '".$invoice_info->id."' ")->result_array();
		$discount_percent = $invoice_info->finaldiscountpercentage;
  		$othercharges= $CI->db->query("SELECT * FROM `tblpurchaseinvoiceothercharges` where `proposalid`='".$invoice_info->id."' and category_name > 0 ")->result_array();


		$final_amount = 0;
		$total_price = 0;

		 if(!empty($purchase_items)){
	     $total_price = 0;
		     foreach ($purchase_items as $key => $value) {

		        $qty = $value['qty'];
		        $rate = $value['price'];
		        $price = ($rate * $qty);
		        $total_price += $price;
	        }

	    }

	    $discount = 0;
	     if(!empty($discount_percent > 0)){
	        $discount = ($total_price*$discount_percent/100);
        }

        if($invoice_info->other_charges_tax == 2){
            if(!empty($othercharges)){
            foreach ($othercharges as $key => $value) {
              $total_price += $value['total_maount'];
           }
         }

      }

		$afr_dis_price = ($total_price - $discount);
		$final_discount_price = ($afr_dis_price*18/100);
		$final_amount = ($final_discount_price + $total_price - $discount);

		if($invoice_info->other_charges_tax == 1){
            if(!empty($othercharges)){
            foreach ($othercharges as $key => $value) {
              $final_amount += $value['total_maount'];
           }
         }

      }


        $update = $CI->db->query("Update `tblpurchaseinvoice` set totalamount = '".$final_amount."' where id = '".$id."' ");

    }
}


if(!function_exists('get_expense_type_by_category'))
{
    function get_expense_type_by_category($category_id)
    {
		$CI =& get_instance();

		$type_info = $CI->db->query("SELECT `id` FROM `tblexpensetype` where category_id = '".$category_id."' ")->row();

		if(!empty($type_info)){
			return $type_info->id;
		}else{
			return 0;
		}

    }
}

if(!function_exists('get_expense_type_default'))
{
    function get_expense_type_default($id)
    {
		$CI =& get_instance();

		$type_info = $CI->db->query("SELECT `default_sub_category` FROM `tblexpensetype` where id = '".$id."' ")->row();

		if(!empty($type_info)){
			return $type_info->default_sub_category;
		}else{
			return 0;
		}

    }
}


/*function update_debitnote_final_amount($id){
  $CI =& get_instance();
  $debit_info = $CI->db->query("SELECT * FROM `tbldebitnote` where id='".$id."' ")->row();

  	$tax_type = get_client_gst_type($debit_info->clientid);


	  $discount_percent = $debit_info->finaldiscountpercentage;

	  //Getting the item list
	  $po_items = get_debitnote_items_list($debit_info->id);
	  $othercharges= $CI->db->query("SELECT * FROM `tbldebitnoteothercharges` where `proposalid`='".$debit_info->id."' and category_name > 0 ")->result_array();

	    $ttl_value = 0;

	  	if($debit_info->debit_note_type == '2'){
	  		if(!empty($po_items)){
		     $total_price = 0;
		     foreach ($po_items as $key => $value) {
		        $price = $value['price'];
		        $total_price += $price;

		        }
		    }
	  	}else{
	  		if(!empty($po_items)){
		     $total_price = 0;
		     foreach ($po_items as $key => $value) {
		     	$qty = $value['qty'];
		        $rate = $value['price'];
		        $price = ($rate * $qty);
		        $total_price += $price;

		        }
		    }
	  	}



	      $discount = 0;
	      if(!empty($discount_percent > 0)){
		     	$discount = ($total_price*$discount_percent/100);
		    }

	   // For Excluding Other Charges Tax
	      if($debit_info->other_charges_tax == 2){
	            if(!empty($othercharges)){
	            foreach ($othercharges as $key => $value) {

	              $total_price += $value['total_maount'];

	           }
	         }

	      }


	    $afr_dis_price = ($total_price - $discount);


	    $final_discount_price = ($afr_dis_price*18/100);

	      if($debit_info->tax_type == 1){
	        $final_amount = ($total_price - $discount);
	      }else{
	        $final_amount = ($final_discount_price + $total_price - $discount);
	      }

	      $update = $CI->db->query("Update `tbldebitnote` set total_tax = '".$final_discount_price."', totalamount = '".$final_amount."' where id = '".$id."' ");


}*/

function get_date_range($range){
	$from_date = '';
	$to_date = '';

	if($range == 1){
		$from_date = date('Y-m-d');
		$to_date = date('Y-m-d');
	}elseif($range == 2){
		$from_date = date('Y-m-d', strtotime('monday this week'));
		$to_date = date('Y-m-d', strtotime('sunday this week'));
	}elseif($range == 3){
		$from_date = date('Y-m-01');
		$to_date = date('Y-m-t');
	}elseif($range == 4){
		$from_date = date('Y-m-01', strtotime("-1 MONTH"));
		$to_date = date('Y-m-t', strtotime('-1 MONTH'));
	}elseif($range == 5){
		$from_date = date('Y-m-d',strtotime(date('Y-01-01')));
		$to_date = date('Y-m-d',strtotime(date('Y-12-31')));
	}elseif($range == 'period'){
		$f_date = str_replace("/","-",$_POST['f_date']);
		$from_date = date("Y-m-d",strtotime($f_date));

		$t_date = str_replace("/","-",$_POST['t_date']);
		$to_date = date("Y-m-d",strtotime($t_date));
	}

	return array('from_date' => $from_date, 'to_date' => $to_date);
}

function master_report_tab($report){
	$lead_active = '';
	$quotation_active = '';
	$pi_active = '';
	$invoice_active = '';
	$challan_active = '';
	$debitnote_active = '';
	$debitnotepayment_active = '';
	$purchaseorder_active = '';
	$purchaseinvoice_active = '';
	$paymentreceipt_active = '';
	$mr_active = '';
	$paymentdone_active = '';
	$expense_active = '';
	if($report == 'lead'){
		$lead_active = 'active';
	}elseif($report == 'quotation'){
		$quotation_active = 'active';
	}elseif($report == 'pi'){
		$pi_active = 'active';
	}elseif($report == 'invoice'){
		$invoice_active = 'active';
	}elseif($report == 'challan'){
		$challan_active = 'active';
	}elseif($report == 'debitnote'){
		$debitnote_active = 'active';
	}elseif($report == 'debitnotepayment'){
		$debitnotepayment_active = 'active';
	}elseif($report == 'purchaseorder'){
		$purchaseorder_active = 'active';
	}elseif($report == 'mr'){
		$mr_active = 'active';
	}elseif($report == 'purchaseinvoice'){
		$purchaseinvoice_active = 'active';
	}elseif($report == 'paymentreceipt'){
		$paymentreceipt_active = 'active';
	}elseif($report == 'paymentdone'){
		$paymentdone_active = 'active';
	}elseif($report == 'expense'){
		$expense_active = 'active';
	}



	$html = '<ul class="nav navbar-pills navbar-pills-flat nav-tabs nav-stacked customer-tabs" role="tablist">
            <li class="'.$lead_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/lead_report').'"><i class="fa fa-area-chart menu-icon" aria-hidden="true"></i>Leads</a>
            </li>
            <li class="'.$quotation_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/quotation_report').'"><i class="fa fa-file-powerpoint-o menu-icon" aria-hidden="true"></i>Quotations</a>
            </li>
            <li class="'.$pi_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/perfomainvoice_report').'"><i class="fa fa-clipboard menu-icon" aria-hidden="true"></i>Perfoma Invoice</a>
            </li>
            <li class="'.$invoice_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/invoice_report').'"><i class="fa fa-file-text menu-icon" aria-hidden="true"></i>Invoices</a>
            </li>
            <li class="'.$challan_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/challan_report').'"><i class="fa fa-clock-o menu-icon" aria-hidden="true"></i>Challans</a>
            </li>
            <li class="'.$debitnote_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/debitnote_report').'"><i class="fa fa-money menu-icon menu-icon" aria-hidden="true"></i>Debit Note</a>
            </li>
            <li class="'.$debitnotepayment_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/debitnotepyament_report').'"><i class="fa fa-money menu-icon menu-icon" aria-hidden="true"></i>Debit Note Payment</a>
            </li>
            <li class="'.$purchaseorder_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/purchaseorder_report').'"><i class="fa fa-file-powerpoint-o menu-icon" aria-hidden="true"></i>Purchase Orders</a>
            </li>
            <li class="'.$mr_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/mr_report').'"><i class="fa fa-file-text menu-icon" aria-hidden="true"></i>Material Receipts</a>
            </li>
            <li class="'.$purchaseinvoice_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/purchaseinvoice_report').'"><i class="fa fa-sticky-note-o menu-icon" aria-hidden="true"></i>Purchase Invoices</a>
            </li>
            <li class="'.$paymentreceipt_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/paymentreceipt_report').'"><i class="fa fa-money menu-icon" aria-hidden="true"></i>Payment Receipts</a>
            </li>
            <li class="'.$paymentdone_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/paymentdone_report').'"><i class="fa fa-money menu-icon" aria-hidden="true"></i>Payment Done</a>
            </li>
            <li class="'.$expense_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('master_report/expense_report').'"><i class="fa fa-file-text menu-icon" aria-hidden="true"></i>Expense</a>
            </li>

         </ul>';

    return $html;

}

function prodcutwise_report_tab($report){
	$lead_active = '';
	$quotation_active = '';
	$pi_active = '';
	$invoice_active = '';
	$purchaseorder_active = '';
	$challanreport_active = '';
	if($report == 'lead'){
		$lead_active = 'active';
	}elseif($report == 'quotation'){
		$quotation_active = 'active';
	}elseif($report == 'pi'){
		$pi_active = 'active';
	}elseif($report == 'invoice'){
		$invoice_active = 'active';
	}elseif($report == 'purchaseorder'){
		$purchaseorder_active = 'active';
	}elseif($report == 'challan_product_report'){
		$challanreport_active = 'active';
	}


	$html = '<ul class="nav navbar-pills navbar-pills-flat nav-tabs nav-stacked customer-tabs" role="tablist">
            <li class="'.$lead_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('productwise_report/lead_report').'"><i class="fa fa-area-chart menu-icon" aria-hidden="true"></i>Leads</a>
            </li>
            <li class="'.$quotation_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('productwise_report/quotation_report').'"><i class="fa fa-file-powerpoint-o menu-icon" aria-hidden="true"></i>Quotations</a>
            </li>
            <li class="'.$pi_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('productwise_report/perfomainvoice_report').'"><i class="fa fa-clipboard menu-icon" aria-hidden="true"></i>Perfoma Invoice</a>
            </li>
            <li class="'.$invoice_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('productwise_report/invoice_report').'"><i class="fa fa-file-text menu-icon" aria-hidden="true"></i>Invoices</a>
            </li>
            <li class="'.$purchaseorder_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('productwise_report/purchaseorder_report').'"><i class="fa fa-file-powerpoint-o menu-icon" aria-hidden="true"></i>Purchase Order</a>
            </li>
            <li class="'.$challanreport_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('productwise_report/challan_product_report').'"><i class="fa fa-file-text menu-icon" aria-hidden="true"></i>Delivery Challan </a>
            </li>
         </ul>';

    return $html;

}

function prodcutwise_sale_report_tab($report){
	$lead_active = '';
	$quotation_active = '';
	$pi_active = '';
	$invoice_active = '';
	if($report == 'lead'){
		$lead_active = 'active';
	}elseif($report == 'quotation'){
		$quotation_active = 'active';
	}elseif($report == 'pi'){
		$pi_active = 'active';
	}elseif($report == 'invoice'){
		$invoice_active = 'active';
	}


	$html = '<ul class="nav navbar-pills navbar-pills-flat nav-tabs nav-stacked customer-tabs" role="tablist">
            <li class="'.$lead_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('productwise_report/lead_sale_report').'"><i class="fa fa-area-chart menu-icon" aria-hidden="true"></i>Leads</a>
            </li>
            <li class="'.$quotation_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('productwise_report/quotation_sale_report').'"><i class="fa fa-file-powerpoint-o menu-icon" aria-hidden="true"></i>Quotations</a>
            </li>
            <li class="'.$pi_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('productwise_report/perfomainvoice_sale_report').'"><i class="fa fa-clipboard menu-icon" aria-hidden="true"></i>Perfoma Invoice</a>
            </li>
            <li class="'.$invoice_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('productwise_report/invoice_sale_report').'"><i class="fa fa-file-text menu-icon" aria-hidden="true"></i>Invoices</a>
            </li>
         </ul>';

    return $html;

}

function lead_report_tab($report,$lead_id){

	$profile_active = '';
	$quotation_active = '';
	$pi_active = '';
	$invoice_active = '';
	$followup_active = '';
	$activity_active = '';
	$attachment_active = '';
	$lead_active = '';
	if($report == 'profile'){
		$profile_active = 'active';
	}elseif($report == 'quotation'){
		$quotation_active = 'active';
	}elseif($report == 'pi'){
		$pi_active = 'active';
	}elseif($report == 'invoice'){
		$invoice_active = 'active';
	}elseif($report == 'followup'){
		$followup_active = 'active';
	}elseif($report == 'attachment'){
		$attachment_active = 'active';
	}elseif($report == 'lead_activity'){
		$lead_active = 'active';
	}elseif($report == 'activity'){
		$activity_active = 'active';
	}





	$html = '<ul class="nav navbar-pills navbar-pills-flat nav-tabs nav-stacked customer-tabs" role="tablist">
			<li class="'.$profile_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('leads/lead_profile/'.$lead_id).'"><i class="fa fa-user-circle menu-icon" aria-hidden="true"></i>Profile</a>
            </li>
            <li class="'.$quotation_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('leads/lead_quotation/'.$lead_id).'"><i class="fa fa-file-powerpoint-o menu-icon" aria-hidden="true"></i>Quotations</a>
            </li>
            <li class="'.$pi_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('leads/lead_perfomainvoice/'.$lead_id).'"><i class="fa fa-clipboard menu-icon" aria-hidden="true"></i>Perfoma Invoice</a>
            </li>
            <li class="'.$invoice_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('leads/lead_invoice/'.$lead_id).'"><i class="fa fa-file-text menu-icon" aria-hidden="true"></i>Invoices</a>
            </li>
            <li class="'.$followup_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('leads/lead_followup/'.$lead_id).'"><i class="fa fa-phone menu-icon" aria-hidden="true"></i>Follow Up</a>
            </li>
            <li class="'.$attachment_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('leads/lead_attachment/'.$lead_id).'"><i class="fa fa fa-paperclip menu-icon" aria-hidden="true"></i>Attachment</a>
            </li>
            <li class="'.$lead_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('leads/activity_lead/'.$lead_id).'"><i class="fa fa-database menu-icon" aria-hidden="true"></i>Lead Activity</a>
            </li>
            <li class="'.$activity_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('leads/lead_activity/'.$lead_id).'"><i class="fa fa-database menu-icon" aria-hidden="true"></i>Activity Log</a>
            </li>

         </ul>';

    return $html;

}

function vendor_report_tab($report,$vendor_id){

    $CI =& get_instance();
	$profile_active = '';
	$po_active = '';
	$mr_active = '';
	$invoice_active = '';
	$payment_active = '';
	$product_active = '';
	$document_active = '';
	$contacts_active = '';
	$product_term_condition_active = '';
	$po_activity_active = '';
	$ledger_reco_active = '';
	if($report == 'profile'){
		$profile_active = 'active';
	}elseif($report == 'po'){
		$po_active = 'active';
	}elseif($report == 'mr'){
		$mr_active = 'active';
	}elseif($report == 'invoice'){
		$invoice_active = 'active';
	}elseif($report == 'payment'){
		$payment_active = 'active';
	}elseif($report == 'product'){
		$product_active = 'active';
	}elseif($report == 'document'){
		$document_active = 'active';
	}elseif($report == 'product_term_condition'){
		$product_term_condition_active = 'active';
	}elseif($report == 'po_activity'){
		$po_activity_active = 'active';
	}elseif($report == 'contacts'){
		$contacts_active = 'active';
	}elseif($report == 'ledger_reco'){
		$ledger_reco_active = 'active';
	}


	$html = '<ul class="nav navbar-pills navbar-pills-flat nav-tabs nav-stacked customer-tabs" role="tablist">
			<li class="'.$profile_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('vendor/vendor_profile/'.$vendor_id).'"><i class="fa fa-user-circle menu-icon" aria-hidden="true"></i>Profile</a>
            </li>
            
			<li class="'.$contacts_active.' customer_tab_profile">
				<a data-group="profile" href="'.admin_url('vendor/vendor_contact/'.$vendor_id).'"><i class="fa fa-phone menu-icon" aria-hidden="true"></i>Contacts</a>
			</li>
            <li class="'.$po_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('vendor/vendor_purchaseorder/'.$vendor_id).'"><i class="fa fa-file-powerpoint-o menu-icon" aria-hidden="true"></i>Purchase Order</a>
            </li>
            <li class="'.$mr_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('vendor/vendor_mr/'.$vendor_id).'"><i class="fa fa-file-text menu-icon" aria-hidden="true"></i>Material Receipt</a>
            </li>
            <li class="'.$invoice_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('vendor/vendor_invoice/'.$vendor_id).'"><i class="fa fa-sticky-note-o menu-icon" aria-hidden="true"></i>Invoices</a>
            </li>
            <li class="'.$payment_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('vendor/vendor_payment/'.$vendor_id).'"><i class="fa fa-money menu-icon" aria-hidden="true"></i>Payments</a>
            </li>
            <li class="'.$product_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('vendor/vendor_products/'.$vendor_id).'"><i class="fa fa-window-restore menu-icon" aria-hidden="true"></i>Products</a>
            </li>
            <li class="'.$document_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('vendor/vendor_documents/'.$vendor_id).'"><i class="fa fa-file menu-icon" aria-hidden="true"></i>Vendor Documents</a>
            </li>
            <li class="'.$product_term_condition_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('vendor/product_term_condition/'.$vendor_id).'"><i class="fa fa-file menu-icon" aria-hidden="true"></i>Product Term And Condition</a>
            </li>
            <li class="'.$ledger_reco_active.' customer_tab_profile">
               <a data-group="profile" href="'.admin_url('vendor/vendor_ledger_reco/'.$vendor_id).'"><i class="fa fa-file menu-icon" aria-hidden="true"></i>Ledger Reco</a>
            </li>';

        $where = "po.vendor_id = '".$vendor_id."' and po.show_list  = '1'";
        $activity_log = $CI->db->query("SELECT poa.id FROM `tblpurchaseorderactivity` as poa LEFT JOIN `tblpurchaseorder` as po ON po.id = poa.po_id WHERE ".$where." ORDER BY poa.id DESC LIMIT 5")->result();
        if (!empty($activity_log)){
            $html .= '<li class="'.$po_activity_active.' customer_tab_profile">
                <a data-group="profile" href="'.admin_url('vendor/vendor_po_activity/'.$vendor_id).'"><i class="fa fa-file menu-icon" aria-hidden="true"></i>PO Activity</a>
             </li>';
        }

        $html .=  '</ul>';

    return $html;

}

function get_product_sales_quantity($from_date,$to_date,$service_type,$product_id,$used_for='invoice'){
  $CI =& get_instance();
  if($service_type == '3'){
    if ($used_for == 'estimate') {
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblestimates as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }else if($used_for == 'proposal'){
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblproposals as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }else{
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }
  }else{
    if ($used_for == 'estimate') {
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblestimates as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.service_type = '".$service_type."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }else if($used_for == 'proposal'){
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblproposals as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.service_type = '".$service_type."' and (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }else{
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.service_type = '".$service_type."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }
  }
  return $sale_qty;
}

function get_product_sales_value($from_date,$to_date,$service_type,$product_id,$used_for='invoice'){
  $CI =& get_instance();
  $ttl_value = 0;
  if($service_type == '3'){
    if ($used_for == 'estimate') {
        $product_info = $CI->db->query("SELECT p.qty,p.rate from tblitems_in as p LEFT JOIN tblestimates as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->result();
    }else if($used_for == 'proposal'){
        $product_info = $CI->db->query("SELECT p.qty,p.rate from tblitems_in as p LEFT JOIN tblproposals as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->result();
    }else{
        $product_info = $CI->db->query("SELECT p.qty,p.rate from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->result();
    }

  }else{
    if ($used_for == 'estimate') {
        $product_info = $CI->db->query("SELECT p.qty,p.rate from tblitems_in as p LEFT JOIN tblestimates as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.service_type = '".$service_type."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->result();
    }else if($used_for == 'proposal'){
        $product_info = $CI->db->query("SELECT p.qty,p.rate from tblitems_in as p LEFT JOIN tblproposals as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.service_type = '".$service_type."' and (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->result();
    }else{
        $product_info = $CI->db->query("SELECT p.qty,p.rate from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.service_type = '".$service_type."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->result();
    }
  }
  if(!empty($product_info)){
  	foreach ($product_info as $row) {
  		$ttl_value += ($row->qty*$row->rate);
  	}
  }

  return $ttl_value;
}

function get_product_sales_quantity_client($from_date,$to_date,$service_type,$product_id,$client_id,$used_for='invoice'){
  $CI =& get_instance();
  if($service_type == '3'){
    if ($used_for == 'estimate') {
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblestimates as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.clientid = '".$client_id."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }else if($used_for == 'proposal'){
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblproposals as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.proposal_to = '".$client_id."' and (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }else{
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.clientid = '".$client_id."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }
  }else{
    if ($used_for == 'estimate') {
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblestimates as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.clientid = '".$client_id."' and i.service_type = '".$service_type."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }else if($used_for == 'proposal'){
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblproposals as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.proposal_to = '".$client_id."' and i.service_type = '".$service_type."' and (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }else{
        $sale_qty = $CI->db->query("SELECT COALESCE(SUM(p.qty),0) as ttl_qty from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = '".$used_for."' and p.pro_id = '".$product_id."' and i.clientid = '".$client_id."' and i.service_type = '".$service_type."' and  (i.date BETWEEN '".db_date($from_date)."' and '".db_date($to_date)."')  ")->row()->ttl_qty;
    }
  }

  return $sale_qty;
}


function db_date($date){
	$date = str_replace("/","-",$date);
	return date("Y-m-d",strtotime($date));
}

function getProductTax($product_id) {
	$CI =& get_instance();
	$tax = $CI->db->query("SELECT t.taxrate as tax from tbltaxes as t LEFT JOIN tblproducts as p on p.gst_id = t.id where p.id = '".$product_id."'")->row();

	if(!empty($tax)){
		return $tax->tax;
	}else{
		return '18.00';
	}
}

function update_proposal_final_amount($id){
 	$CI =& get_instance();
 	$CI->load->model('proposals_model');

 	$proposal = $CI->proposals_model->get($id);

	$check_proposal_rent_item = check_proposal_item($proposal->id,0,'proposal');
	$check_proposal_sale_item = check_proposal_item($proposal->id,1,'proposal');

	$total_tax = 0;

	if($check_proposal_rent_item>=1){
		$type = 'rent';
	  }elseif($check_proposal_sale_item>=1){
		$type = 'sale';
	  }

	if($type=='sale')
	{
		$othercharges=get_pro_othercharges($proposal->id,'1');
		$profor='Quotation For Sale';
		$discount_percent = $proposal->sale_discount_percent;
	}
	else if($type=='rent')
	{
		$othercharges=get_pro_othercharges($proposal->id,'0');
		$profor='Quotation For Rent';
		$discount_percent = $proposal->rent_discount_percent;
	}


	//Getting the item list
	$proposal->items = get_proposal_items_list($proposal->id,$type);


	//For dicount show

	$show_discount = 0;
	if(!empty($proposal->items)){
	  foreach ($proposal->items as $key => $value) {
		  if($value['discount'] > 0){
			$show_discount = 1;
		  }
	  }

	}

    $ttl_value = 0;

    if(!empty($proposal->items)){
     $total_price = 0;
	     foreach ($proposal->items as $key => $value) {
		        $qty = $value['qty'];
		        $rate = $value['rate'];
		        $weight = $value['weight'];
		        $dis = $value['discount'];
		        if($proposal->proposal_for == 1){
		          $prodtax = $value['prodtax'];
		        }else{
		          $prodtax = 0.1;
		        }

		        if($value['is_sale'] == 0){
		           $totalmonths = ($value['months'] + ($value['days'] / 30));
		           $price = ($rate * $qty * $totalmonths * $weight);
		        }else{
		           $price = ($rate * $qty * $weight);
		        }

		        if($value['rate_view'] > 0){
		          $show_rate = $value['rate_view'];
		        }else{
		          $show_rate = $value['rate'];
		        }

		        $dis_price = ($price*$dis/100);

		        $final_price = ($price - $dis_price);

		        //Applying TAX after discount
		        $tax_amt = ($final_price*$prodtax/100);
		        $final_price = ($final_price+$tax_amt);
		        $total_price += $final_price;
		        $total_tax += $tax_amt;


	        }


    }


    	$discount = 0;
		if(!empty($discount_percent > 0)){
			$discount = ($total_price*$discount_percent/100);
		}

        $othercharges_ttl = 0;
       if(!empty($othercharges)){
          foreach ($othercharges as $key => $value) {
              $total_price += $value['total_maount'];
              $othercharges_ttl += $value['total_maount'];

           }

           if($proposal->other_charges_tax == 2){
                $other_tax_amt = ($othercharges_ttl*18/100);
                $total_price = ($other_tax_amt+$total_price);
                $total_tax += $other_tax_amt;

           }

       }

      $final_amount = ($total_price - $discount);

      $update = $CI->db->query("Update `tblproposals` set total = '".$final_amount."', total_tax = '".$total_tax."' where id = '".$id."' ");


}

function update_pi_final_amount($id){
    $CI =& get_instance();
    $CI->load->model('estimates_model');
    $estimate = $CI->estimates_model->get($id);

    $total_tax = 0;
	$check_estimate_rent_item=check_estimate_item($estimate->id,0);
	$check_estimate_sale_item=check_estimate_item($estimate->id,1);

	if($check_estimate_rent_item>=1){
	  $type = 'rent';
	}elseif($check_estimate_sale_item>=1){
	  $type = 'sale';
	}


	if($type=='sale')
	{
		$othercharges=get_pro_estimate_othercharges($estimate->id,'1');
		$is_sale=1;
		$type='sale';
		$subtotal=$estimate->salesubtotal;
	}
	else if($type=='rent')
	{
		$othercharges=get_pro_estimate_othercharges($estimate->id,'0');
		$is_sale=0;
		$type='rent';
		$subtotal=$estimate->rentsubtotal;
	}
	else
	{
		$othercharges=get_pro_estimate_othercharges($estimate->id,'0');
		$is_sale=2;
		$type='sale';
		$subtotal=$estimate->salesubtotal+$estimate->rentsubtotal;
	}

	//For dicount show
	$show_discount = 0;
	if(!empty($estimate->items)){
	  foreach ($estimate->items as $key => $value) {
		  if($value['discount'] > 0){
			$show_discount = 1;
		  }
	  }

	}


    if(!empty($estimate->items)){
     $total_price = 0;
     foreach ($estimate->items as $key => $value) {
        $qty = $value['qty'];
        $rate = $value['rate'];
		$weight = $value['weight'];
        $dis = $value['discount'];
        if($estimate->estimate_for == 1){
          $prodtax = $value['prodtax'];
        }else{
          $prodtax = 0.1;
        }

        if($value['is_sale'] == 0){
           $totalmonths = ($value['months'] + ($value['days'] / 30));
           $price = ($rate * $qty * $totalmonths * $weight);
        }else{
           $price = ($rate * $qty * $weight);
        }

        $dis_price = ($price*$dis/100);

        $final_price = ($price - $dis_price);

        //Applying TAX after discount
        $tax_amt = ($final_price*$prodtax/100);
        $final_price = ($final_price+$tax_amt);
        $total_tax += $tax_amt;


        $total_price += $final_price;

        if($value['rate_view'] > 0){
          $show_rate = $value['rate_view'];
        }else{
          $show_rate = $value['rate'];
        }


        }
    }


	$discount = 0;
	if(!empty($estimate->discount_percent > 0)){
		$discount = ($total_price*$estimate->discount_percent/100);

	}


	$othercharges_ttl = 0;
	if(!empty($othercharges)){
	  foreach ($othercharges as $key => $value) {
	      $total_price += $value['total_maount'];
	      $othercharges_ttl += $value['total_maount'];

	   }

	   if($estimate->other_charges_tax == 2){
	        $other_tax_amt = ($othercharges_ttl*18/100);
	        $total_price = ($other_tax_amt+$total_price);
	        $total_tax += $other_tax_amt;
	   }

	}

    $final_amount = ($total_price - $discount);

	$update = $CI->db->query("Update `tblestimates` set total = '".$final_amount."', total_tax = '".$total_tax."' where id = '".$id."' ");

}


function update_po_final_amount($id){

	$CI =& get_instance();
	$purchase = $CI->db->query("SELECT * FROM `tblpurchaseorder` where id =  '".$id."' ")->row();
	$tax_type = get_vendor_gst_type($purchase->vendor_id);
	$total_tax = 0;

	$discount_percent = $purchase->finaldiscountpercentage;
	$discount_amount = $purchase->finaldiscountamount;
	$roundoff_amt = $purchase->roundoff_amount;
	//Getting the item list
	$po_items = get_po_items_list($purchase->id);
	$othercharges= $CI->db->query("SELECT * FROM `tblpurchaseothercharges` where `proposalid`='".$purchase->id."' and category_name > 0 ")->result_array();

    $ttl_value = 0;
    if(!empty($po_items)){
		$total_price = 0;
		$shown_total_price = 0;
     	foreach ($po_items as $key => $value) {
			$qty = $value['qty'];
			$rate = $value['price'];
			$discount = $value['discount'];

			$price = ($rate * $qty);
			$discount_amt = (($price*$discount) / 100);
			$discount_price = ($price-$discount_amt);

			//Applying TAX after discount
			if($purchase->tax_type == 2){
				$tax_amt = ($discount_price*$value['prodtax']/100);
				$final_price = ($discount_price+$tax_amt);
				$total_tax += $tax_amt;
			}else{
				$final_price = $discount_price;
			}
			$total_price += number_format($final_price, 2, '.', '');
        }
    }

	$discount = 0;
	if(!empty($discount_percent > 0)){
		$discount = ($total_price*$discount_percent/100);
	}

	$othercharges_ttl = 0;
	if(!empty($othercharges)){
		foreach ($othercharges as $key => $value) {
			$total_price += $value['total_maount'];
			$othercharges_ttl += $value['total_maount'];
		}

		if($purchase->other_charges_tax == 2){
			$other_tax_amt = ($othercharges_ttl*18/100);
			$total_price = ($other_tax_amt+$total_price);
			$total_tax += $other_tax_amt;
		}
	}

	$final_amount = ($total_price - $discount_amount);
	$final_amount = ($final_amount + $roundoff_amt);
	$final_amount = number_format(($final_amount), 2, '.', '');

  	$update = $CI->db->query("Update `tblpurchaseorder` set finalsubtotalamount = '".$total_price."', totalamount = '".$final_amount."' where id = '".$id."' ");
}

function update_debitnote_final_amount($id){
	$CI =& get_instance();
	$debit_info = $CI->db->query("SELECT * FROM `tbldebitnote` where id =  '".$id."' ")->row();
	$tax_type = get_client_gst_type($debit_info->clientid);

	$total_tax = 0;
	$discount_percent = $debit_info->finaldiscountpercentage;

	//Getting the item list
	$po_items = get_debitnote_items_list($debit_info->id);
	$othercharges= $CI->db->query("SELECT * FROM `tbldebitnoteothercharges` where `proposalid`='".$debit_info->id."' and category_name > 0 ")->result_array();

  	if($debit_info->debit_note_type == '1'){

		$ttl_value = 0;
		if(!empty($po_items)){
       		$total_price = 0;
       		foreach ($po_items as $key => $value) {

        		$qty = $value['qty'];
          		$rate = $value['price'];
          		$price = ($rate * $qty);
          		$tax_amt = ($price*$value['prodtax']/100);
          		$final_price = ($price+$tax_amt);

          		$total_price += $final_price;
         		$total_tax += $tax_amt;
            }
	    }
  	}else{

    	$ttl_value = 0;
		if(!empty($po_items)){
			$total_price = 0;
			foreach ($po_items as $key => $value) {

				$price = $value['price'];
				$tax_amt = ($price*$value['prodtax']/100);
				$final_price = ($price+$tax_amt);
				$total_tax += $tax_amt;
				$total_price += $final_price;
			}
		}
	}

	$discount = 0;
	if(!empty($discount_percent > 0)){
		$discount = ($total_price*$discount_percent/100);
	}

	$othercharges_ttl = 0;
	if(!empty($othercharges)){
		foreach ($othercharges as $key => $value) {
			$total_price += $value['total_maount'];
			$othercharges_ttl += $value['total_maount'];
		}

		if($debit_info->other_charges_tax == 2){
			$other_tax_amt = ($othercharges_ttl*18/100);
			$total_price = ($other_tax_amt+$total_price);
			$total_tax += $other_tax_amt;
		}
	}

    $final_amount = ($total_price - $discount);

  	$update = $CI->db->query("Update `tbldebitnote` set total_tax = '".$total_tax."', totalamount = '".$final_amount."' where id = '".$id."' ");
}

function update_payment_debitnote_final_amount($id){
	$CI =& get_instance();
	$debit_info = $CI->db->query("SELECT * FROM `tbldebitnotepayment` where id =  '".$id."' ")->row();
	$tax_type = $debit_info->tax_type;
	$invoicedata_info = $CI->db->query("SELECT * FROM tbldebitnotepaymentitems where debitnote_id = '".$debit_info->id."' and status = 1 ")->result();

	$ttl_amount = 0;
  	if(!empty($invoicedata_info)){
      	foreach ($invoicedata_info as $key => $value) {
        	$ttl_amount += $value->amount;
      	}
		$total_tax = ($ttl_amount*18/100);
		$ttl_finalamount = ($total_tax+$ttl_amount);
		$update = $CI->db->query("Update `tbldebitnotepayment` set total_tax = '".$total_tax."', amount = '".$ttl_finalamount."'  where id = '".$id."' ");
    }
}


function update_creditnote_final_amount($id){
	$CI =& get_instance();
	$debit_info = $CI->db->query("SELECT * FROM `tblcreditnote` where id =  '".$id."' ")->row();
	$tax_type = get_client_gst_type($debit_info->clientid);

	$total_tax = 0;

	//Getting the item list
	$po_items = get_creditnote_items_list($debit_info->id);
	$othercharges= $CI->db->query("SELECT * FROM `tblcreditnoteothercharges` where `proposalid`='".$debit_info->id."' and category_name > 0 ")->result_array();

  	$ttl_value = 0;

    if(!empty($po_items)){
     	$total_price = 0;
     	foreach ($po_items as $key => $value) {

			$price = ($value['price']*$value['qty']*$value['days']);
			$tax_amt = ($price*$value['prodtax']/100);
			$final_price = ($price+$tax_amt);
			$total_tax += $tax_amt;
			$total_price += $final_price;
        }
    }

    $othercharges_ttl = 0;
    if(!empty($othercharges)){
      	foreach ($othercharges as $key => $value) {
			$total_price += $value['total_maount'];
			$othercharges_ttl += $value['total_maount'];
        }

        if($debit_info->other_charges_tax == 2){
            $other_tax_amt = ($othercharges_ttl*18/100);
            $total_price = ($other_tax_amt+$total_price);
            $total_tax += $other_tax_amt;
        }
    }

    $final_amount = $total_price;
  	$update = $CI->db->query("Update `tblcreditnote` set total_tax = '".$total_tax."', totalamount = '".$final_amount."' where id = '".$id."' ");
}


function update_purchase_invoice_final_amount($id){
	$CI =& get_instance();
	$invoice_info = $CI->db->query("SELECT * FROM `tblpurchaseinvoice` where id =  '".$id."' ")->row();
	$total_tax = 0;

	//Getting the item list
	$purchase_items = $CI->db->query("SELECT * FROM tblpurchaseinvoiceproduct where invoice_id = '".$id."' ")->result_array();
	$ttl_value = 0;

    if(!empty($purchase_items)){
     	$total_price = 0;
     	foreach ($purchase_items as $key => $value) {

	        $prodtax = $value['prodtax'];
	        $qty = $value['qty'];
	        $rate = $value['price'];
	        $price = ($rate * $qty);

	        $tax_amt = ($price*$prodtax/100);
	        $total_tax += $tax_amt;

	        $final_price = ($price+$tax_amt);
	        $total_price += $final_price;
        }
    }
	if ($invoice_info->roundoff_amount > 0){
		$total_price += $invoice_info->roundoff_amount;
	}
	$final_amount = $total_price;
  	$update = $CI->db->query("Update `tblpurchaseinvoice` set total_tax = '".$total_tax."' where id = '".$id."' ");
}


function update_purchase_creditnote_final_amount($id){
	$CI =& get_instance();
	$debit_info = $CI->db->query("SELECT * FROM `tblpurchasecreditnote` where id =  '".$id."' ")->row();
	//$tax_type = get_client_gst_type($debit_info->clientid);

	$total_tax = 0;

	//Getting the item list
	$po_items = get_purchase_creditnote_items_list($debit_info->id);
	$othercharges= $CI->db->query("SELECT * FROM `tblpurchasecreditnoteothercharges` where `proposalid`='".$debit_info->id."' and category_name > 0 ")->result_array();

	$ttl_value = 0;

    if(!empty($po_items)){
     	$total_price = 0;
     	foreach ($po_items as $key => $value) {

			$price = ($value['price']*$value['qty']*$value['days']);
			$tax_amt = ($price*$value['prodtax']/100);
			$final_price = ($price+$tax_amt);
			$total_tax += $tax_amt;
			$total_price += $final_price;
        }
    }

    $othercharges_ttl = 0;
    if(!empty($othercharges)){
      	foreach ($othercharges as $key => $value) {
			$total_price += $value['total_maount'];
			$othercharges_ttl += $value['total_maount'];
	    }

        if($debit_info->other_charges_tax == 2){

            $other_tax_amt = ($othercharges_ttl*18/100);
            $total_price = ($other_tax_amt+$total_price);
            $total_tax += $other_tax_amt;
        }
	}

    $final_amount = $total_price;
  	$update = $CI->db->query("Update `tblpurchasecreditnote` set total_tax = '".$total_tax."', totalamount = '".$final_amount."' where id = '".$id."' ");
}

function get_lead_assign_staff($id){
  	$CI =& get_instance();
  	$staff_names = '';
	$assignee_info = $CI->db->query("SELECT s.firstname as name FROM `tblstaff` as s LEFT JOIN  tblleadassignstaff as la ON s.staffid = la.staff_id where la.lead_id = '".$id."' ")->result();
	if(!empty($assignee_info)){
		foreach ($assignee_info as $key => $value) {
			if($key == 0){
				$staff_names .= $value->name;
			}else{
				$staff_names .= ', '.$value->name;
			}
		}
	}
	return $staff_names;
}

if(!function_exists('get_multiple_source'))
{
    function get_multiple_source($ids) {

    	$sources = '';
    	$id_arr = explode(',',$ids);
		if(!empty($id_arr)){
			foreach($id_arr as $id){
				$source_name = value_by_id('tblleadssources',$id,'name');
				$sources .= $source_name.' ,';
			}
		}

		return rtrim($sources,",");
    }
}

if(!function_exists('get_approval_counts'))
{
    function get_approval_counts()
    {
		$CI =& get_instance();
		$user_id = get_staff_user_id();
		$query_1 = $CI->db->query("SELECT COALESCE(count(id),0) as ttl_rows FROM `tblmasterapproval` where staff_id = '".$user_id."' and status = 0 and approve_status = 0 and `module_id` NOT IN (18,30,31,33,37,39,42,45,48,58,59)")->row();
		return $query_1->ttl_rows;
	}
}

if(!function_exists('get_activitytag_counts'))
{
    function get_activitytag_counts()
    {
		$CI =& get_instance();
		$user_id = get_staff_user_id();
		$query_1 = $CI->db->query("SELECT COALESCE(count(id),0) as ttl_rows FROM `tblmasterapproval` where staff_id = '".$user_id."' and status = 0 and approve_status = 0 and `module_id` IN (18,30,31,33,37,39,42,45,48,58,59)")->row();
		return $query_1->ttl_rows;
	}
}

if(!function_exists('getPoVendorProductName'))
{
    function getPoVendorProductName($vendor_id,$product_id)
    {
		$CI =& get_instance();

//		$product_code = value_by_id_empty('tblproducts',$product_id,'company_product_code');
		$product_code = "";

		$vendorProductInfo = $CI->db->query("SELECT product_name FROM `tblvendorproductsname` where vendor_id = '".$vendor_id."' and product_id = '".$product_id."' and status = 1 ")->row();
		if(!empty($vendorProductInfo->product_name)){
		   return	'<h3>'.$vendorProductInfo->product_name.' '.$product_code.'<h3>';
		}
	}
}

if(!function_exists('get_po_paid_amount'))
{
    function get_po_paid_amount($po_id)
    {
		$CI =& get_instance();
		$amount = $CI->db->query("SELECT COALESCE(sum(approved_amount),0) as ttl_amt FROM `tblpurchaseorderpayments` where po_id = '".$po_id."' and status IN (1,0) ")->row()->ttl_amt;
		$tdsamount = $CI->db->query("SELECT COALESCE(sum(tdsamount),0) as ttl_amt FROM `tblpurchaseorderpayments` where po_id = '".$po_id."' and status IN (1,0) ")->row()->ttl_amt;
		$tcsamount = $CI->db->query("SELECT COALESCE(sum(tcsamount),0) as ttl_amt FROM `tblpurchaseorderpayments` where po_id = '".$po_id."' and status IN (1,0) ")->row()->ttl_amt;
    $finalamount = $amount + $tdsamount + $tcsamount;
    $refund_info = $CI->db->query("SELECT `amount` FROM `tblpurchaseorderrefundpayment` WHERE `po_id` = '".$po_id."' AND `balance_amount` = '0.00' AND status = '1'")->row();
    if (!empty($refund_info)){
       $refund_amt = $refund_info->amount;
       $finalamount = $finalamount-$refund_info->amount;
    }
    return $finalamount;
	}
}

//for time function
if(!function_exists('due_days'))
{
    function due_days($payment_due_date)
    {
		$pay_date =strtotime("$payment_due_date");
        $datediff = time() - $pay_date;
        $due_days =  round($datediff / (60 * 60 * 24));
        if(!empty($due_days)){
        	return $due_days;
        }else{
        	return '--';
        }
	}

}

if(!function_exists('update_approval_status_tblproducts_log'))
{
    function update_approval_status_tblproducts_log($id,$status)
    {
		$CI =& get_instance();
		$CI->db->query("Update `tblproducts_log` set approval_send = '".$status."' where id = '".$id."' ");

    }
}

if(!function_exists('can_product_delete'))
{
    function can_product_delete($product_id)
    {
		$CI =& get_instance();
		$status = 1;

		//$lead_info = $CI->db->query("SELECT id FROM `tblproductinquiry` where product_id = '".$product_id."' and status = 1 ")->row();
		//$challan_info = $CI->db->query("SELECT id FROM `tblchalandetailsmst` where component_id = '".$product_id."' ")->row();
		//$dn_info = $CI->db->query("SELECT id FROM `tbldebitnoteproduct` where product_id = '".$product_id."' ")->row();
		//$purchaseorder_info = $CI->db->query("SELECT id FROM `tblpurchaseorderproduct` where product_id = '".$product_id."' ")->row();

		$lead_info = $CI->db->query("SELECT l.id,l.enquiry_date,p.enquiry_id FROM `tblproductinquiry` as p LEFT JOIN tblleads as l ON l.id = p.enquiry_id where p.product_id = '".$product_id."' and p.status = 1 group by p.enquiry_id")->row();
		$sales_info = $CI->db->query("SELECT id FROM `tblitems_in` where pro_id = '".$product_id."' and rel_type IN ('proposal','estimate','invoice')  ")->row();
		$challan_info = $CI->db->query("SELECT c.id,c.chalanno,c.service_type,c.challandate FROM `tblchalandetailsmst` as p LEFT JOIN tblchalanmst as c ON c.id = p.chalan_id where p.component_id = '".$product_id."' and c.status = 1 group by p.chalan_id ")->row();
		$dn_info = $CI->db->query("SELECT d.id,d.dabit_note_date,d.number,d.totalamount FROM `tbldebitnoteproduct` as p LEFT JOIN tbldebitnote as d ON d.id = p.debitnote_id where p.product_id = '".$product_id."' and d.status = 1 group by p.debitnote_id ")->row();
		$vendor_info = $CI->db->query("SELECT id FROM `tblvendorproductsname` where product_id = '".$product_id."' and status = 1 ")->row();
		$component_info = $CI->db->query("SELECT id FROM `tblproductitems` where item_id = '".$product_id."' and status = 1 ")->row();
		$purchaseorder_info = $CI->db->query("SELECT po.id,po.date,po.number,po.totalamount FROM `tblpurchaseorderproduct` as p LEFT JOIN tblpurchaseorder as po ON po.id = p.po_id where p.product_id = '".$product_id."' and po.status = 1 group by p.po_id")->row();

		if(!empty($lead_info)|| !empty($sales_info) || !empty($challan_info) ||!empty($dn_info) || !empty($vendor_info) || !empty($component_info) || !empty($purchaseorder_info)){
			$status = 0;
		}
		return $status;

    }
}


if(!function_exists('get_approval_counts_app'))
{
    function get_approval_counts_app($user_id)
    {
		/*$CI =& get_instance();
		$query_1 = $CI->db->query("SELECT COALESCE(count(id),0) as ttl_rows FROM `tblmasterapproval` where staff_id = '".$user_id."' and status = 0 and approve_status = 0 and approve_status = 0 and module_id = 4")->row();
		return $query_1->ttl_rows;*/

		$CI =& get_instance();
		$query_1 = $CI->db->query("SELECT COALESCE(count(id),0) as ttl_rows FROM `tblmasterapproval` where staff_id = '".$user_id."' and status = 0 and approve_status = 0")->row();
		return $query_1->ttl_rows;
	}
}

if(!function_exists('cc'))
{
    function cc($string)
    {
		return ucwords($string);
	}
}

if(!function_exists('get_hsn_code'))
{
    function get_hsn_code($product_id)
    {
		$CI =& get_instance();
		$hsn_code = $CI->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '".$product_id."' ")->row();
		if(!empty($hsn_code)){
			return $hsn_code->field_value;
		}

	}
}

if(!function_exists('get_sac_code'))
{
    function get_sac_code($product_id)
    {
		$CI =& get_instance();
		$sac_code = $CI->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '".$product_id."' ")->row();
		if(!empty($sac_code)){
			return $sac_code->field_value;
		}

	}
}

if(!function_exists('bank_info'))
{
    function bank_info($id)
    {
		$CI =& get_instance();

		return $CI->db->query("SELECT * FROM `tblbankmaster` where `id`= '".$id."' ")->row();

    }
}

if(!function_exists('purchase_percent'))
{
    function purchase_percent($id,$total)
    {
		$CI =& get_instance();

		$query = $CI->db->query("SELECT COALESCE(SUM(approved_amount),0) as amt from tblpurchaseorderpayments where po_id = '".$id."' and status = '1' and utr_no != '' ")->row();
		if(!empty($query)){
			$amt = $query->amt;

			$percentage = '0';
			if($total > 0){
				$percentage = ($amt*100)/$total;
			}

			return 	bcadd(0, $percentage, 2);
		}else{
			return '0.00';
		}
    }
}

/* by himanshu */
if(!function_exists('get_purchase_percent'))
{
    function get_purchase_percent($id,$total)
    {
		    $CI =& get_instance();
        $amt = 0;
        $query = $CI->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE `po_id` = '".$id."' and status = '1'")->result();
        // echo $CI->db->last_query();
        // exit;
        if (!empty($query)){
            foreach ($query as $value) {
                if ($value->payment_by == 1 && $value->utr_no != ""){
                    $amt += $value->approved_amount+$value->tdsamount+$value->tcsamount;
                }elseif($value->payment_by == 2 || $value->payment_by == 3 || $value->payment_by == 4){
                    $amt += $value->approved_amount+$value->tdsamount+$value->tcsamount;
                }
            }
            $percentage = ($total > 0) ? ($amt*100)/$total : '0';
            if (bcadd(0, $percentage, 2) > 100)
            {
                $refund_info = $CI->db->query("SELECT `id`,`amount`,`refund_to`,`account_confirmation`,`type` FROM `tblpurchaseorderrefundpayment` WHERE `po_id` = '".$id."' AND status = '1'")->row();
                if (!empty($refund_info)){
					if($refund_info->type == 2){
						$refund_amt = $refund_info->amount;
						$famount = $amt-$refund_info->amount;
						$percentage = ($total > 0) ? ($famount*100)/$total : '0';
					}elseif ($refund_info->refund_to == 1 && $refund_info->account_confirmation == 1){
						$refund_amt = $refund_info->amount;
						$famount = $amt-$refund_info->amount;
						$percentage = ($total > 0) ? ($famount*100)/$total : '0';
					}else{
						$pettycash_info = $CI->db->query("SELECT `confirmed_by_user`,`receive_status` FROM `tblpettycashrequest` WHERE `refund_id` ='".$refund_info->id."' ")->row();
						if (!empty($pettycash_info) && $pettycash_info->confirmed_by_user == 1 && $pettycash_info->receive_status == 1){
							$refund_amt = $refund_info->amount;
							$famount = $amt-$refund_info->amount;
							$percentage = ($total > 0) ? ($famount*100)/$total : '0';
						}
					}
                   
                }
                return bcadd(0, $percentage, 2);
            }else{
                return bcadd(0, $percentage, 2);
            }
        }else{
            return '0.00';
		    }
    }
}

if(!function_exists('client_running_closed_sales_status'))
{
    function client_running_closed_sales_status($client_ids,$sales_client_ids,$client_id)
    {
		$CI =& get_instance();
		$client_type = '--';
		$running_clinets = $CI->db->query("SELECT `userid`,`credit_limit` from `tblclientbranch` where userid IN (".$client_ids.") ")->result();
        $closed_clinets = $CI->db->query("SELECT `userid`,`credit_limit` from `tblclientbranch` where userid NOT IN (".$client_ids.") ")->result();
        $sales_clinets = $CI->db->query("SELECT `userid`,`credit_limit` from `tblclientbranch` where userid IN (".$sales_client_ids.") ")->result();

        $running = 0;
        $closed = 0;
        $sales = 0;

        $rent_bal_amt = client_balance_amt($client_id,1);
        $sales_bal_amt = client_balance_amt($client_id,2);

        if(!empty($running_clinets)){
        	foreach ($running_clinets as $value) {

        		if($value->credit_limit == 0 || $rent_bal_amt <= $value->credit_limit ){
        			if($rent_bal_amt > 1){
        				if($value->userid == $client_id){
		        			$client_type = 'Running Client';
		        			$running = 1;
		        		}
        			}
        		}
        	}
        }
        if(!empty($closed_clinets)){
        	foreach ($closed_clinets as $value) {

        		 if($value->credit_limit == 0 || $rent_bal_amt <= $value->credit_limit ){
        		 	if($rent_bal_amt > 1){
        		 		if($value->userid == $client_id){
		        			$client_type = 'Closed Client';
		        			$closed = 1;
		        		}
        		 	}
        		 }
        	}
        }
        if(!empty($sales_clinets)){
        	foreach ($sales_clinets as $value) {

        		if($value->credit_limit == 0 || $sales_bal_amt <= $value->credit_limit ){
        			if($sales_bal_amt > 1){
        				if($value->userid == $client_id){
		        			$client_type = 'Sales Client';
		        			$sales = 1;
		        		}
        			}
        		}


        	}
        }

        $client_type = '';
        $i = 0;
        if($running == 1){
        	$client_type = 'Running';
        	$i++;
        }
        if($closed == 1){
        	if($i > 0){
        		$client_type .= '/Closed';
        	}else{
        		$client_type = 'Closed';
        	}
        	$i++;
        }
        if($sales == 1){
        	if($i > 0){
        		$client_type .= '/Sales';
        	}else{
        		$client_type = 'Sales';
        	}
        	$i++;
        }
        if(!empty($client_type)){
        	return $client_type.' Client';
        }else{
        	return '--';
        }

    }
}


if(!function_exists('limit_word'))
{
    function limit_word($string)
    {
        $string = strip_tags($string);
        if (strlen($string) > 35) {

            // truncate string
            $stringCut = substr($string, 0, 35);
            $endPoint = strrpos($stringCut, ' ');

            //if the string doesn't contain any space then it will cut without word basis.
            $string = $endPoint? substr($stringCut, 0, $endPoint) : substr($stringCut, 0);
            $string .= '...';
        }
        return $string;

    }

}

if(!function_exists('generate_token'))
{
    function generate_token()
    {
        $token = openssl_random_pseudo_bytes(16);
        return bin2hex($token);

    }

}

/* this function use for check details of products */
if(!function_exists('check_products_details'))
{
    function check_products_details($product_id)
    {
		$CI =& get_instance();
		$status = 1;

//                $lead_info = $CI->db->query("SELECT l.id,l.enquiry_date,p.enquiry_id FROM `tblproductinquiry` as p LEFT JOIN tblleads as l ON l.id = p.enquiry_id where p.product_id = '".$product_id."' and p.status = 1 group by p.enquiry_id")->row();
//		$sales_info = $CI->db->query("SELECT id FROM `tblitems_in` where pro_id = '".$product_id."' and rel_type IN ('proposal','estimate','invoice')  ")->row();
//		$challan_info = $CI->db->query("SELECT c.id,c.chalanno,c.service_type,c.challandate FROM `tblchalandetailsmst` as p LEFT JOIN tblchalanmst as c ON c.id = p.chalan_id where p.component_id = '".$product_id."' and c.status = 1 group by p.chalan_id ")->row();
//		$dn_info = $CI->db->query("SELECT d.id,d.dabit_note_date,d.number,d.totalamount FROM `tbldebitnoteproduct` as p LEFT JOIN tbldebitnote as d ON d.id = p.debitnote_id where p.product_id = '".$product_id."' and d.status = 1 group by p.debitnote_id ")->row();
//		$vendor_info = $CI->db->query("SELECT id FROM `tblvendorproductsname` where product_id = '".$product_id."' and status = 1 ")->row();
//		$component_info = $CI->db->query("SELECT id FROM `tblproductitems` where item_id = '".$product_id."' and status = 1 ")->row();
//		$purchaseorder_info = $CI->db->query("SELECT po.id,po.date,po.number,po.totalamount FROM `tblpurchaseorderproduct` as p LEFT JOIN tblpurchaseorder as po ON po.id = p.po_id where p.product_id = '".$product_id."' and po.status = 1 group by p.po_id")->row();

                $invoice_info = $CI->db->query("SELECT s.service_type,s.total,s.invoice_date,s.id FROM `tblitems_in` as p LEFT JOIN tblinvoices as s ON s.id = p.rel_id where p.pro_id = '".$product_id."' and p.rel_type = 'invoice' group by p.rel_id order by s.invoice_date asc ")->result();
                $challan_info = $CI->db->query("SELECT c.id,c.chalanno,c.service_type,c.challandate FROM `tblchalandetailsmst` as p LEFT JOIN tblchalanmst as c ON c.id = p.chalan_id where p.component_id = '".$product_id."' and c.status = 1 group by p.chalan_id ")->row();
		$component_info = $CI->db->query("SELECT id FROM `tblproductitems` where item_id = '".$product_id."' and status = 1 ")->row();

		if(!empty($invoice_info) || !empty($challan_info) || !empty($component_info)){
			$status = 0;
		}
		return $status;

    }
}

/* this function use for get product unit */
if(!function_exists('get_product_unit'))
{
    function get_product_unit($product_id, $is_temp = 0)
    {
        $CI =& get_instance();
        if($is_temp == 0){
            $unit_id = value_by_id_empty('tblproducts',$product_id,'unit_2');
            $isOtherCharge = value_by_id('tblproducts',$product_id,'isOtherCharge');
        }else{
            $unit_id = value_by_id_empty('tbltemperoryproduct',$product_id,'unit');
            $isOtherCharge = 0;
        }

        $unit_name = ($isOtherCharge == 0 && !empty($unit_id)) ? value_by_id('tblunitmaster',$unit_id,'name') : '--';
	return $unit_name;
    }
}


function makeCall($data)
{
   	$url = 'https://'.CALL_API_KEY.':'.CALL_API_TOKEN.'@api.exotel.com/v1/Accounts/schachengineers1/Calls/connect.json?';
   	$curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    return $response;
}

function getCurrentFinancialYear()
{
   	$CI =& get_instance();
   	$year_info = $CI->db->query("SELECT id FROM `tblfinancialyear` where from_date <= '".date('Y-m-d')."' and to_date >= '".date('Y-m-d')."' ")->row();
   	if(!empty($year_info)){
   		return $year_info->id;
   	}

}

/* this function use for get archive target amount by staff */
/*if(!function_exists('getSaffArchiveTargetAmount'))
{
    function getSaffArchiveTargetAmount($staff_id, $month= "", $year= "", $pro_category_id= "", $f_date = "", $t_date = "", $othertarget ="", $service_type = "2", $invoice_ids ="")
    {
        //return 0;
        $CI =& get_instance();

        if (!empty($staff_id) && empty($month) && empty($year) && empty($pro_category_id) && empty($f_date) && empty($t_date)) {
            $where = '`ls`.`type` = "2" AND `i`.`service_type` = "'.$service_type.'" AND `ls`.`staff_id` = "'.$staff_id.'"';
        }else{
            $where = '`ls`.`type` = "2" AND `i`.`service_type` = "'.$service_type.'" AND `ls`.`staff_id` = "'.$staff_id.'" ';
            if(!empty($othertarget)){
            	$where .= ' AND `pro`.`product_cat_id` NOT IN ('.$othertarget.') ';
            }else if (!empty($pro_category_id)){
                $where .= ' AND `pro`.`product_cat_id` IN ('.$pro_category_id.') ';
            }
            if (!empty($f_date) && !empty($t_date)){
                $where .= " AND `i`.`date`  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }else{
                $where .= 'AND Month(`i`.`date`)="'.$month.'" AND YEAR(`i`.`date`)="'.$year.'"';
            }
        }
        if($invoice_ids != ""){
            $where .= ' AND `i`.`id` NOT IN ('.$invoice_ids.') ';
        }
        if($service_type == "1"){
            $where .= ' AND `i`.`parent_id` = 0';
        }
        //Remove service category from logic (Other Achivement)
        $where .= " AND `pro`.`product_cat_id` != 14";

        
        $target_list = $CI->db->query('SELECT `i`.`total` FROM `tblinvoices` as i LEFT JOIN `tblleadassignstaff` AS ls ON `ls`.`lead_id` = `i`.`lead_id` LEFT JOIN `tblitems_in` as item ON `item`.`rel_id` = `i`.`id` AND `item`.`rel_type` = "invoice" LEFT JOIN `tblproducts` AS pro ON `pro`.`id` = `item`.`pro_id` WHERE '.$where.' group by `i`.`id` ')->result();

        $total_amount = 0.00;
        if(!empty($target_list)){
        	foreach($target_list as $target){
        		$total_amount += $target->total;
        	}

        }
        return number_format($total_amount, 2, '.', '');
    }
}*/

if(!function_exists('getSaffArchiveTargetAmount'))
{
    function getSaffArchiveTargetAmount($staff_id, $month= "", $year= "", $pro_category_id= "", $f_date = "", $t_date = "", $othertarget ="", $service_type = "2", $invoice_ids ="")
    {
        //return 0;
        $CI =& get_instance();

        if (!empty($staff_id) && empty($month) && empty($year) && empty($pro_category_id) && empty($f_date) && empty($t_date)) {
            $where = '`ls`.`type` = "2" AND `i`.`service_type` = "'.$service_type.'" AND `ls`.`staff_id` = "'.$staff_id.'"';
        }else{
            $where = '`ls`.`type` = "2" AND `i`.`service_type` = "'.$service_type.'" AND `ls`.`staff_id` = "'.$staff_id.'" ';
            
            if (!empty($f_date) && !empty($t_date)){
                $where .= " AND `i`.`date`  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
            }else{
                $where .= 'AND Month(`i`.`date`)="'.$month.'" AND YEAR(`i`.`date`)="'.$year.'"';
            }
        }
        if($invoice_ids != ""){
            $where .= ' AND `i`.`id` NOT IN ('.$invoice_ids.') ';
        }
        if($service_type == "1"){
            $where .= ' AND `i`.`parent_id` = 0';
        }
		
		$invoice_list = $CI->db->query('SELECT `i`.`id` FROM `tblinvoices` as i LEFT JOIN `tblleadassignstaff` AS ls ON `ls`.`lead_id` = `i`.`lead_id` WHERE '.$where.' group by `i`.`id` ')->result();
		
		
		$invoice_where = ' AND `item`.`rel_type` = "invoice" ';
		if(!empty($othertarget)){
			$invoice_where .= ' AND `pro`.`division_id` NOT IN ('.$othertarget.') ';
		}else if (!empty($pro_category_id)){
			$invoice_where .= ' AND `pro`.`division_id` IN ('.$pro_category_id.') ';
		}
		//Remove service category from logic (Other Achivement)
		$invoice_where .= ' AND `pro`.`product_cat_id` != 14';
		$total_amount = 0.00;	
		if(!empty($invoice_list)){
			foreach($invoice_list as $invoice){
				
				$target_list = $CI->db->query('SELECT item.rel_id as invoice_id FROM `tblitems_in` as item LEFT JOIN `tblproducts` AS pro ON `pro`.`id` = `item`.`pro_id` WHERE `item`.`rel_id` = '.$invoice->id.' '.$invoice_where.' group by `item`.`rel_id` ')->result();
				
				if(!empty($target_list)){
					foreach($target_list as $target){
						
						$total = value_by_id_empty('tblinvoices',$target->invoice_id,'total');
						if(!empty($total)){
							$total_amount += $total;
						}
						
					}
				}
			}
		}        
        
        return number_format($total_amount, 2, '.', '');
    }
}

/*if(!function_exists('getSaffArchiveTargetList'))
{
    function getSaffArchiveTargetList($staff_id, $month= "", $year= "", $pro_category_id= "", $f_date = "", $t_date = "", $orthercategoryid = "",$service_type = "2", $invoice_ids ="" )
    {
        $CI =& get_instance();

        $where = '`ls`.`type` = "2" AND `i`.`service_type` = "'.$service_type.'" AND `ls`.`staff_id` = "'.$staff_id.'"';
        if (!empty($orthercategoryid)){
            $where .= ' AND `pro`.`product_cat_id` NOT IN ('.$orthercategoryid.') ';
        }else if(!empty($pro_category_id)){
            $where .= ' AND `pro`.`product_cat_id` IN ('.$pro_category_id.')';
        }

        if (!empty($f_date) && !empty($t_date)){
            $where .= " AND `i`.`date`  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
        }else{
            $where .= 'AND Month(`i`.`date`)="'.$month.'" && YEAR(`i`.`date`)="'.$year.'"';
        }
        if($invoice_ids != ""){
            $where .= ' AND `i`.`id` NOT IN ('.$invoice_ids.') ';
        }
        if($service_type == "1"){
            $where .= ' AND `i`.`parent_id` = 0';
        }
        //Remove service category from logic (Other Achivement)
        $where .= " AND `pro`.`product_cat_id` != 14";

        $target = $CI->db->query('SELECT i.* FROM `tblinvoices` as i LEFT JOIN `tblleadassignstaff` AS ls ON `ls`.`lead_id` = `i`.`lead_id` LEFT JOIN `tblitems_in` as item ON `item`.`rel_id` = `i`.`id` AND `item`.`rel_type` = "invoice" LEFT JOIN `tblproducts` AS pro ON `pro`.`id` = `item`.`pro_id` WHERE '.$where.' group by `i`.`id`')->result();

        if(!empty($target)){
            return $target;
        }

    }
}*/


if(!function_exists('getSaffArchiveTargetList'))
{
    function getSaffArchiveTargetList($staff_id, $month= "", $year= "", $pro_category_id= "", $f_date = "", $t_date = "", $orthercategoryid = "",$service_type = "2", $invoice_ids ="" )
    {
        $CI =& get_instance();

        $where = '`ls`.`type` = "2" AND `i`.`service_type` = "'.$service_type.'" AND `ls`.`staff_id` = "'.$staff_id.'"';
        

        if (!empty($f_date) && !empty($t_date)){
            $where .= " AND `i`.`date`  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
        }else{
            $where .= 'AND Month(`i`.`date`)="'.$month.'" && YEAR(`i`.`date`)="'.$year.'"';
        }
        if($invoice_ids != ""){
            $where .= ' AND `i`.`id` NOT IN ('.$invoice_ids.') ';
        }
        if($service_type == "1"){
            $where .= ' AND `i`.`parent_id` = 0';
        }
		
		
		$invoice_list = $CI->db->query('SELECT `i`.`id` FROM `tblinvoices` as i LEFT JOIN `tblleadassignstaff` AS ls ON `ls`.`lead_id` = `i`.`lead_id` WHERE '.$where.' group by `i`.`id` ')->result();
		
		
		$invoice_where = ' AND `item`.`rel_type` = "invoice" ';
		if (!empty($orthercategoryid)){
            $invoice_where .= ' AND `pro`.`division_id` NOT IN ('.$orthercategoryid.') ';
        }else if(!empty($pro_category_id)){
            $invoice_where .= ' AND `pro`.`division_id` IN ('.$pro_category_id.')';
        }		
        //Remove service category from logic (Other Achivement)
        $invoice_where .= " AND `pro`.`product_cat_id` != 14";
		
		$invoice_ids = 0;
		if(!empty($invoice_list)){
			foreach($invoice_list as $invoice){
				
				$target_list = $CI->db->query('SELECT item.rel_id as invoice_id FROM `tblitems_in` as item LEFT JOIN `tblproducts` AS pro ON `pro`.`id` = `item`.`pro_id` WHERE `item`.`rel_id` = '.$invoice->id.' '.$invoice_where.' group by `item`.`rel_id` ')->result();
				
				if(!empty($target_list)){
					foreach($target_list as $target){
						
						$invoice_ids .= ",".$target->invoice_id;
						
					}
				}
			}
		}
		$target = $CI->db->query('SELECT * FROM `tblinvoices` WHERE id IN ('.$invoice_ids.') ')->result();
        if(!empty($target)){
            return $target;
        }

    }
}

/*if(!function_exists('getArchiveInvoiceids'))
{
    function getArchiveInvoiceids($staff_id, $month= "", $year= "", $pro_category_id= "", $f_date = "", $t_date = "", $orthercategoryid = "",$service_type = "2" )
    {
		$CI =& get_instance();

        $where = '`ls`.`type` = "2" AND `i`.`service_type` = "'.$service_type.'" AND `ls`.`staff_id` = "'.$staff_id.'"';
        if (!empty($orthercategoryid)){
            $where .= ' AND `pro`.`product_cat_id` NOT IN ('.$orthercategoryid.') ';
        }else if(!empty($pro_category_id)){
            $where .= ' AND `pro`.`product_cat_id` IN ('.$pro_category_id.')';
        }

        if (!empty($f_date) && !empty($t_date)){
            $where .= " AND `i`.`date`  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
        }else{
            $where .= 'AND Month(`i`.`date`)="'.$month.'" && YEAR(`i`.`date`)="'.$year.'"';
        }

        //Remove service category from logic (Other Achivement)
        $where .= " AND `pro`.`product_cat_id` != 14";

        $target = $CI->db->query('SELECT i.id as ids FROM `tblinvoices` as i LEFT JOIN `tblleadassignstaff` AS ls ON `ls`.`lead_id` = `i`.`lead_id` LEFT JOIN `tblitems_in` as item ON `item`.`rel_id` = `i`.`id` AND `item`.`rel_type` = "invoice" LEFT JOIN `tblproducts` AS pro ON `pro`.`id` = `item`.`pro_id` WHERE '.$where.' group by `i`.`id`')->result();
        $invoice_ids = "0";
        if(!empty($target)){
            foreach ($target as $k => $invoiceids) {
                if (!empty($invoiceids->ids)){
                    $invoice_ids .= ",".$invoiceids->ids;
                }
            }
        }
        return $invoice_ids;
    }
}*/

if(!function_exists('getArchiveInvoiceids'))
{
    function getArchiveInvoiceids($staff_id, $month= "", $year= "", $pro_category_id= "", $f_date = "", $t_date = "", $orthercategoryid = "",$service_type = "2" )
    {
		$CI =& get_instance();

        $where = '`ls`.`type` = "2" AND `i`.`service_type` = "'.$service_type.'" AND `ls`.`staff_id` = "'.$staff_id.'"';
        
        if (!empty($f_date) && !empty($t_date)){
            $where .= " AND `i`.`date`  BETWEEN  '".db_date($f_date)."' and  '".db_date($t_date)."' ";
        }else{
            $where .= 'AND Month(`i`.`date`)="'.$month.'" && YEAR(`i`.`date`)="'.$year.'"';
        }
		
			
		$invoice_list = $CI->db->query('SELECT `i`.`id` FROM `tblinvoices` as i LEFT JOIN `tblleadassignstaff` AS ls ON `ls`.`lead_id` = `i`.`lead_id` WHERE '.$where.' group by `i`.`id` ')->result();
		
		
		
		$invoice_where = ' AND `item`.`rel_type` = "invoice" ';        
		
		if (!empty($orthercategoryid)){
            $invoice_where .= ' AND `pro`.`division_id` NOT IN ('.$orthercategoryid.') ';
        }else if(!empty($pro_category_id)){
            $invoice_where .= ' AND `pro`.`division_id` IN ('.$pro_category_id.')';
        }
		//Remove service category from logic (Other Achivement)
        $invoice_where .= ' AND `pro`.`product_cat_id` != 14 ';
		
		$invoice_ids = "0";
		if(!empty($invoice_list)){
			foreach($invoice_list as $invoice){
				$target_list = $CI->db->query('SELECT item.rel_id as invoice_id FROM `tblitems_in` as item LEFT JOIN `tblproducts` AS pro ON `pro`.`id` = `item`.`pro_id` WHERE `item`.`rel_id` = '.$invoice->id.' '.$invoice_where.' group by `item`.`rel_id` ')->result();
				
				if(!empty($target_list)){
					foreach ($target_list as $k => $invoiceids) {
						if (!empty($invoiceids->invoice_id)){
							$invoice_ids .= ",".$invoiceids->invoice_id;
						}
					}
				}
				
			}			
		}
		
        
        
        return $invoice_ids;
    }
}

if(!function_exists('dateDiffInDays'))
{
	function dateDiffInDays($date1, $date2)
	{
	    // Calculating the difference in timestamps
	    $diff = strtotime($date2) - strtotime($date1);

	    // 1 day = 24 hours
	    // 24 * 60 * 60 = 86400 seconds
	    return abs(round($diff / 86400));
	}
}

/* this is function use for get product categories */
function get_product_category_list($type, $id = 0) {
    $CI =& get_instance();
    $response = $output = $next_type = $final_category = $title_category = $main_edit_url = "";
    switch ($type) {
        case "category":
            $output = $CI->db->query("SELECT * FROM `tblproductcategory` WHERE `status` = '1'")->result();
            $next_type = "rootcategory";
            $final_category = 1;
            $title_category = '<spam class="text-success">( Main Category )</spam>';
            $main_edit_url = admin_url("productcategory/productcategory");
            break;
        case "rootcategory":
            $output = $CI->db->query("SELECT * FROM `tblproductsubcategory` WHERE `category_id` = '".$id."' AND `status` = '1'")->result();
            $next_type = "prarentcategory";
            $final_category = 2;
            $title_category = '<spam class="text-warning">( Root Category )</spam>';
            $main_edit_url = admin_url("productsubcategory/productsubcategory");
            break;
        case "prarentcategory":
            $output = $CI->db->query("SELECT * FROM `tblproductparentcategory` WHERE `root_category_id` = '".$id."' AND `status` = '1'")->result();
            $next_type = "childcategory";
            $final_category = 3;
            $title_category = '<spam class="text-info">( Parent Category )</spam>';
            $main_edit_url = admin_url("productsubcategory/parentcategory");
            break;
        case "childcategory":
            $output = $CI->db->query("SELECT * FROM `tblproductchildcategory` WHERE `parent_category_id` = '".$id."' AND `status` = '1'")->result();
            $next_type = "";
            $final_category = 4;
            $title_category = '<spam class="text-danger">( Child Category )</spam>';
            $main_edit_url = admin_url("productsubcategory/childcategory");
            break;
    }

    if ($output != ""){
        foreach ($output as $value) {
            $product_data = get_product_list_by_category($type, $value->id);
            $cls = $next_category = "";
            if ($next_type != ""){
                $next_category = get_product_category_list($next_type, $value->id);
                $cls = (!empty($next_category) OR !empty($product_data)) ? '<i class="fa fa-minus"></i> ' : '';
            }

            $edit_url = $main_edit_url."/".$value->id."/categorytree";
            $chk_custom_fields = $CI->db->query("SELECT `id` FROM `tblproductcustomfieldscategory` WHERE `final_category_id` = '".$value->id."' AND `final_category` = '".$final_category."'")->row();
            $custom_fields = "";
            if (!empty($chk_custom_fields)) {
                $furl = admin_url("productcustom/assignfields/".$chk_custom_fields->id);
                $custom_fields = ' <a class="btn-sm btn-success" target="_blank" href="'.$furl.'">Custom Field <i class="fa fa-edit"></i></a>';
            }
            $response .= '<li ><span>'.$cls.' '.cc($value->name).' '.$title_category.'</span> <a  class="btn-sm btn-primary" href="'.$edit_url.'"><i class="fa fa-edit"></i></a>'.$custom_fields.'<ul style="margin-left: 45px;">'.$next_category.$product_data.'</ul></li>';

        }
    }
    return $response;
}
/* this is function use for get product list */
function get_product_list_by_category($type, $id = 0) {
    $CI =& get_instance();
    $output = "";
    switch ($type) {
        case "category":
            $where = "product_cat_id = '".$id."' AND `product_sub_cat_id` = '0' AND `parent_category_id` = '0' AND `child_category_id` = '0' AND ";
            break;
        case "rootcategory":
            $where = "product_sub_cat_id = '".$id."' AND `parent_category_id` = '0' AND `child_category_id` = '0' AND ";
            break;
        case "prarentcategory":
            $where = "parent_category_id = '".$id."' AND `child_category_id` = '0' AND ";
            break;
        case "childcategory":
            $where = "child_category_id = '".$id."' AND ";
            break;
    }
    $product_list = $CI->db->query("SELECT * FROM `tblproducts` WHERE ".$where."`status` = '1'")->result();
    if (!empty($product_list)){
        foreach ($product_list as $pro_val) {
            $url = admin_url("product_new/product/".$pro_val->id."/categorytree");
            $output .= '<li> <span title = "Product">'.cc($pro_val->name).'</span> <a class="btn-sm btn-primary" href="'.$url.'"><i class="fa fa-edit"></i></a></li>';
        }
    }
    return $output;
}

    /* this is function use for get module head name list */
    function getModuleHeadName($module_id, $id = 0) {

        $CI =& get_instance();
        $head_name_arr = array("name" => "", "approved_by" => "", "notification_title" => "");
        switch ($module_id) {
            case 3:
                $vendor_id = value_by_id_empty('tblpurchaseorder',$id,'vendor_id');
                if (!empty($vendor_id)){
                    $vendor_name = value_by_id_empty('tblvendor',$vendor_id,'name');
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($vendor_name)." ]";
                    $head_name_arr["name"] = cc($vendor_name);
                }
                $approved_parson = $CI->db->query("SELECT GROUP_CONCAT(s.firstname) as names FROM `tblpurchaseorderapproval` as pa JOIN `tblstaff` as s ON s.staffid = pa.staff_id WHERE pa.po_id = ".$id." AND pa.approve_status = '1'")->row();
                if (!empty($approved_parson->names)){
                    $head_name_arr["notification_title"] .= "<br> <span style='color:#2196f3;'> Approved By: </span> &nbsp;".cc($approved_parson->names)." ";
                    $head_name_arr["approved_by"] = cc($approved_parson->names);
                }
                break;
            case 4:
                $vendor_id = value_by_id_empty('tblmaterialreceipt',$id,'vendor_id');
                if (!empty($vendor_id)){
                    $vendor_name = value_by_id_empty('tblvendor',$vendor_id,'name');
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($vendor_name)." ]";
                    $head_name_arr["name"] = cc($vendor_name);
                }
                $approved_parson = $CI->db->query("SELECT GROUP_CONCAT(s.firstname) as names FROM `tblmaterialreceiptapproval` as ma JOIN `tblstaff` as s ON s.staffid = ma.staff_id WHERE ma.mr_id = ".$id." AND ma.approve_status = '1'")->row();
                if (!empty($approved_parson->names)){
                    $head_name_arr["notification_title"] .= "<br> <span style='color:#2196f3;'> Approved By: </span> &nbsp;".cc($approved_parson->names)." ";
                    $head_name_arr["approved_by"] = cc($approved_parson->names);
                }
                break;
			case 8:
				$head_name_arr["notification_title"] = "&nbsp;[PAY-".$id." ]";
				$head_name_arr["name"] = "PAY-".$id;
				break;	
            case 9:
                $po_id = value_by_id_empty('tblpurchaseorderpayments',$id,'po_id');
                if (!empty($po_id)){
                    $vendor_id = value_by_id_empty('tblpurchaseorder',$po_id,'vendor_id');
                    if (!empty($vendor_id)){
                        $vendor_name = value_by_id_empty('tblvendor',$vendor_id,'name');
                        $head_name_arr["notification_title"] = "&nbsp;[".cc($vendor_name)." ]";
                        $head_name_arr["name"] = cc($vendor_name);
                    }


                }
                $approved_parson = $CI->db->query("SELECT GROUP_CONCAT(s.firstname) as names FROM `tblpurchaseorderpaymentapproval` as ma JOIN `tblstaff` as s ON s.staffid = ma.staff_id WHERE ma.pay_id = ".$id." AND ma.approve_status = '1'")->row();
	                if (!empty($approved_parson->names)){
	                    $head_name_arr["notification_title"] .= "<br> <span style='color:#2196f3;'> Approved By: </span> &nbsp;".cc($approved_parson->names)." ";
	                    $head_name_arr["approved_by"] = cc($approved_parson->names);
	                }
                break;
            case 10:
                $product_approve = $CI->db->query("SELECT product_id FROM tblproductapprovalsend_products WHERE main_id = ".$id."")->row();

                if(!empty($product_approve)){
                    $product_info = $CI->db->query("SELECT name FROM tblproducts_log WHERE id = ".$product_approve->product_id."")->row();
                    if (!empty($product_info)){
                        $head_name_arr["notification_title"] = "&nbsp;[".cc($product_info->name)." ]";
                        $head_name_arr["name"] = cc($product_info->name);
                    }
                }
                break;
            case 12:
                $client_id = value_by_id_empty('tblclientwaveoff',$id,'client_id');
                if (!empty($client_id)){
                    $client_name = client_info($client_id)->client_branch_name;
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($client_name)." ]";
                    $head_name_arr["name"] = cc($client_name);
                }
                break;
            case 13:
                $product_name = value_by_id_empty('tbltemperoryproduct',$id,'product_name');
                if (!empty($product_name)){
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($product_name)." ]";
                    $head_name_arr["name"] = cc($product_name);
                }
                break;
            case 14:
                $staff_id = value_by_id_empty('tblstaffitemsdetails',$id,'staff_id');
                if (!empty($staff_id)){
                    $name = get_staff_info($staff_id)->firstname;
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($name)." ]";
                    $head_name_arr["name"] = cc($name);
                }
                break;
            case 15:
                $client_id = value_by_id_empty('tblclientpayment',$id,'client_id');
                if (!empty($client_id)){
                    $client_name = client_info($client_id)->client_branch_name;
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($client_name)." ]";
                    $head_name_arr["name"] = cc($client_name);
                }
                break;
            case 16:
                $payment_info = $CI->db->query("SELECT * FROM tblpaymentrequest WHERE id =".$id." ORDER BY id DESC")->row();
                if (!empty($payment_info)){
                    if($payment_info->type == 2 && $payment_info->category_id == 6){
                        $party_name = $payment_info->party_name;
                    }else{
                        $party_name = value_by_id('tblcompanyexpenseparties',$payment_info->party_id,'name');
                    }

                    $head_name_arr["notification_title"] = (!empty($party_name)) ? "&nbsp;[".cc($party_name)." ]" : "";
                    $head_name_arr["name"] = (!empty($party_name)) ? cc($party_name) : "";

                    $approved_parson = $CI->db->query("SELECT GROUP_CONCAT(s.firstname) as names FROM `tblpaymentrequestapproval` as ma JOIN `tblstaff` as s ON s.staffid = ma.staffid WHERE ma.payment_id = ".$id." AND ma.approve_status = '1'")->row();
	                if (!empty($approved_parson->names)){
	                    $head_name_arr["notification_title"] .= "<br> <span style='color:#2196f3;'> Approved By: </span> &nbsp;".cc($approved_parson->names)." ";
	                    $head_name_arr["approved_by"] = cc($approved_parson->names);
	                }
                }
                break;
            case 17:
                $vendor_id = value_by_id_empty('tblstockconsumption',$id,'vendor_id');
                if (!empty($vendor_id)){
                    $vendor_name = value_by_id_empty('tblvendor',$vendor_id,'name');
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($vendor_name)." ]";
                    $head_name_arr["name"] = cc($vendor_name);
                }
                break;
            case 19:
                $client_id = value_by_id_empty('tblclientdeposits',$id,'client_id');
                if (!empty($client_id)){
                    $client_name = client_info($client_id)->client_branch_name;
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($client_name)." ]";
                    $head_name_arr["name"] = cc($client_name);
                }
                break;
            case 20:
                $staffid = value_by_id_empty('tblstafflog',$id,'staffid');
                if(!empty($staffid)){
                    $name = get_employee_fullname($staffid);
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($name)." ]";
                    $head_name_arr["name"] = cc($name);
                }
                break;
            case 21:
                $client_id = value_by_id_empty('tblcomplains',$id,'client_id');
                if (!empty($client_id)){
                    $client_name = client_info($client_id)->client_branch_name;
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($client_name)." ]";
                    $head_name_arr["name"] = cc($client_name);
                }
                break;
            case 22:
                $client_id = value_by_id_empty('tblcomplains',$id,'client_id');
                if (!empty($client_id)){
                    $client_name = client_info($client_id)->client_branch_name;
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($client_name)." ]";
                    $head_name_arr["name"] = cc($client_name);
                }
                break;
            case 23:
                $company_name = value_by_id_empty('tblenquirycall',$id,'company_name');
                if (!empty($company_name)){
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($company_name)." ]";
                    $head_name_arr["name"] = cc($company_name);
                }
                break;
            case 24:
                $vendor_id = value_by_id_empty('tblpurchaseinvoice',$id,'vendor_id');
                if (!empty($vendor_id)){
                    $vendor_name = value_by_id_empty('tblvendor',$vendor_id,'name');
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($vendor_name)." ]";
                    $head_name_arr["name"] = cc($vendor_name);
                }
                break;
            case 29:
                $clientid = value_by_id_empty('tblchalanmst',$id,'clientid');
                if (!empty($clientid)){
                    $client_name = client_info($clientid)->client_branch_name;
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($client_name)." ]";
                    $head_name_arr["name"] = cc($client_name);
                }
                break;
            case 32:
                $vendor_id = value_by_id_empty('tbljobdelivarychallan',$id,'vendor_id');
                if (!empty($vendor_id)){
                    $vendor_name = value_by_id_empty('tblvendor',$vendor_id,'name');
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($vendor_name)." ]";
                    $head_name_arr["name"] = cc($vendor_name);
                }
                break;
            case 40:
                $vendor_id = value_by_id_empty('tblpurchaseorderrefundpayment',$id,'vendor_id');
                if (!empty($vendor_id)){
                    $vendor_name = value_by_id_empty('tblvendor',$vendor_id,'name');
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($vendor_name)." ]";
                    $head_name_arr["name"] = cc($vendor_name);

					$approved_parson = $CI->db->query("SELECT GROUP_CONCAT(s.firstname) as names FROM `tblpurchaserefundpaymentapproval` as ma JOIN `tblstaff` as s ON s.staffid = ma.staffid WHERE ma.refund_id = ".$id." AND ma.approve_status = '1'")->row();
	                if (!empty($approved_parson->names)){
	                    $head_name_arr["notification_title"] .= "<br> <span style='color:#2196f3;'> Approved By: </span> &nbsp;".cc($approved_parson->names)." ";
	                    $head_name_arr["approved_by"] = cc($approved_parson->names);
	                }
                }
                break;
			case 47:
				$client_refund_info = $CI->db->query("SELECT * FROM tblclientrefund WHERE id =".$id." ")->row();
				if (!empty($client_refund_info)){
					$client_name = client_info($client_refund_info->client_id)->client_branch_name;
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($client_name)." ]";
                    $head_name_arr["name"] = cc($client_name);
				}
				break;
			case 50:
				$client_payment_info = $CI->db->query("SELECT * FROM tblclientpayment WHERE id =".$id." ")->row();
				if (!empty($client_payment_info)){
					$client_name = client_info($client_payment_info->client_id)->client_branch_name;
					$head_name_arr["notification_title"] = "&nbsp;[".cc($client_name)." ]";
					$head_name_arr["name"] = cc($client_name);
				}
				break;
			case 51:
				$client_payment_info = $CI->db->query("SELECT * FROM tblclientpayment WHERE id =".$id." ")->row();
				if (!empty($client_payment_info)){
					$client_name = client_info($client_payment_info->client_id)->client_branch_name;
					$head_name_arr["notification_title"] = "&nbsp;[".cc($client_name)." ]";
					$head_name_arr["name"] = cc($client_name);
				}
				break;
			case 53:
				$name = get_employee_fullname($id);
				$head_name_arr["notification_title"] = "&nbsp;[".cc($name)." ]";
				$head_name_arr["name"] = cc($name);
				break;
			case 56:
				$inspection_info = $CI->db->query("SELECT `product_id`,`type` FROM tblproductinspection WHERE id =".$id." ")->row();
				if (!empty($inspection_info)){
					$product_name = value_by_id("tblproducts", $inspection_info->product_id, "name");
					$ptype = ($inspection_info->type == '1') ? ' IN-WARDING INSPECTION ': ' FINAL INSPECTION ';
					$head_name_arr["notification_title"] = "&nbsp;[".cc($product_name)." ]&nbsp;(".$ptype.")";
					$head_name_arr["name"] = cc($product_name)." - ".$ptype;
				}
				
				break;	
			case 55:
                $clientid = value_by_id_empty('tblproformachalan',$id,'clientid');
                if (!empty($clientid)){
                    $client_name = client_info($clientid)->client_branch_name;
                    $head_name_arr["notification_title"] = "&nbsp;[".cc($client_name)." ]";
                    $head_name_arr["name"] = cc($client_name);
                }			
            default:
                break;
        }
        return $head_name_arr;
    }


    /* this functiom use for get client invoice records */
    function get_client_invoice_records($site_id, $service_type, $branch_str, $from_date = '', $to_date = ''){
		
        $CI =& get_instance();
        $site_info = $CI->db->query("SELECT * FROM tblsitemanager where id = '" . $site_id . "' ")->row();
        $output = array();
        $parent_ids = $allinvoice_ids = $alldn_ids = 0;
		$where_str = '';
		if ($from_date !='' && $to_date != ''){
			$where_str = "and invoice_date BETWEEN '".db_date($from_date)."' AND '".db_date($to_date)."'";
		}
        $parent_invoice = $CI->db->query("SELECT * FROM tblinvoices where clientid IN (" . $branch_str . ") and site_id = '" . $site_id . "' and service_type IN (" . $service_type . ") and parent_id = '0' and status != '5' $where_str order by date asc ")->result();
        if (!empty($parent_invoice)) {
            foreach ($parent_invoice as $parent) {
                $parent_ids .= ',' . $parent->id;
                $allinvoice_ids .= ',' . $parent->id;

                $output[] = array(
                                "id" => $parent->id,
                                "date" => $parent->invoice_date,
                                "number" => $parent->number,
                                "type" => "Invoice",
                                "amount" => $parent->total
                            );
                $payment_info = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date, p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '" . $parent->id . "' and cp.status = 1 order by p.id asc ")->result();
                if (!empty($payment_info)) {
                    foreach ($payment_info as $r1) {
                        $to_see = ($r1->payment_mode == 1 && $r1->chaque_status != 1) ? '0' : '1';
                        if ($to_see == 1) {
                            $output[] = array(
                                            "id" => $parent->id,
                                            "date" => $parent->invoice_date,
                                            "number" => $parent->number,
                                            "type" => "Invoice Payments",
                                            "amount" => $r1->amount
                                        );
                        }
                    }
                }

                //Getting Child Invoice
                $child_invoice = $CI->db->query("SELECT * FROM tblinvoices where clientid IN (" . $branch_str . ") and site_id = '" . $site_id . "' and service_type IN (" . $service_type . ") and parent_id = '" . $parent->id . "' and status != '5' $where_str order by date asc ")->result();
                if (!empty($child_invoice)) {
                    foreach ($child_invoice as $child) {
                        $allinvoice_ids .= ',' . $child->id;
                        $child_payment_info = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '" . $child->id . "' and cp.status = 1 order by p.id asc ")->result();

                        // IF there is only one recored of payment which is made by cheque and cheque is not clear
                        if (count($child_payment_info) == 1) {
                            if ($child_payment_info[0]->payment_mode == 1 && $child_payment_info[0]->chaque_status != 1) {
                                $child_payment_info = '';
                            }
                        }

                        $output[] = array(
                                            "id" => $child->id,
                                            "date" => $child->invoice_date,
                                            "number" => $child->number,
                                            "type" => "Invoice",
                                            "amount" => $child->total
                                        );
                        if (!empty($child_payment_info)){
                            foreach ($child_payment_info as $r2) {
                                $to_see = ($r2->payment_mode == 1 && $r2->chaque_status != 1) ? '0' : '1';
                                if ($to_see == 1) {
                                    $output[] = array(
                                            "id" => $child->id,
                                            "date" => $child->invoice_date,
                                            "number" => $child->number,
                                            "type" => "Invoice Payments",
                                            "amount" => $r2->amount
                                        );
                                }
                            }
                        }
                    }
                }
            }

            //Getting Debit Notes againt parent invoice
            $debit_note_info = $CI->db->query("SELECT * FROM tbldebitnote where invoice_id IN (" . $parent_ids . ") and invoice_id > '0' and status = '1' order by dabit_note_date asc ")->result();
            if (!empty($debit_note_info)) {
                foreach ($debit_note_info as $debitnote) {
                    $alldn_ids .= ',' . $debitnote->id;
                    $debitnote_payment = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '" . $debitnote->number . "' and cp.status = 1 order by p.id asc ")->result();

                    // IF there is only one recored of payment which is made by cheque and cheque is not clear
                    if (count($debitnote_payment) == 1) {
                        if ($debitnote_payment[0]->payment_mode == 1 && $debitnote_payment[0]->chaque_status != 1) {
                            $debitnote_payment = '';
                        }
                    }
                    $output[] = array(
                                    "id" => $debitnote->id,
                                    "date" => $debitnote->dabit_note_date,
                                    "number" => $debitnote->number,
                                    "type" => "Debit Note",
                                    "amount" => $debitnote->totalamount
                                );
                    if (!empty($debitnote_payment)) {
                        foreach ($debitnote_payment as $r3) {
                            $to_see = ($r3->payment_mode == 1 && $r3->chaque_status != 1) ? '0' : '1';
                            if ($to_see == 1) {
                                $output[] = array(
                                                "id" => $debitnote->id,
                                                "date" => $debitnote->dabit_note_date,
                                                "number" => $debitnote->number,
                                                "type" => "DN Payment",
                                                "amount" => $r3->amount
                                            );
                            }
                        }
                    }
                }
            }

            //Getting Credit Notes againt parent invoice
            $credit_note_info = $CI->db->query("SELECT * FROM tblcreditnote where invoice_id IN (" . $parent_ids . ") and invoice_id > '0' and status = '1' order by date asc ")->result();
            if (!empty($credit_note_info)) {
                foreach ($credit_note_info as $creditnote) {
                    $output[] = array(
                                    "id" => $creditnote->id,
                                    "date" => $creditnote->date,
                                    "number" => $creditnote->number,
                                    "type" => "Credit Note",
                                    "amount" => $creditnote->totalamount
                                );
                }
            }

            $payment_debitnote = $CI->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (" . $allinvoice_ids . ") and i.invoice_id > 0 and i.type = 1 GROUP by dn.id ")->result();
            if (empty($payment_debitnote)) {
                $payment_debitnote = $CI->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (" . $alldn_ids . ") and i.invoice_id > 0 and i.type = 2 GROUP by dn.id ")->result();
            }
            if (!empty($payment_debitnote)) {
                foreach ($payment_debitnote as $debitnote) {
                    $debitnote_payment = $CI->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '" . $debitnote->number . "' and cp.status = 1 order by p.id asc ")->result();
                    // IF there is only one recored of payment which is made by cheque and cheque is not clear
                    if (count($debitnote_payment) == 1) {
                        if ($debitnote_payment[0]->payment_mode == 1 && $debitnote_payment[0]->chaque_status != 1) {
                            $debitnote_payment = '';
                        }
                    }

                    $output[] = array(
                                    "id" => $debitnote->id,
                                    "date" => $debitnote->date,
                                    "number" => $debitnote->number,
                                    "type" => "Delay in Payment",
                                    "amount" => $debitnote->amount
                                );
                    if (!empty($debitnote_payment)) {
                        foreach ($debitnote_payment as $r4) {
                            $to_see = ($r4->payment_mode == 1 && $r4->chaque_status != 1) ? '0' : '1';
                            if ($to_see == 1) {
                                $output[] = array(
                                    "id" => $debitnote->id,
                                    "date" => $debitnote->date,
                                    "number" => $debitnote->number,
                                    "type" => "Delay in Payment Receipt",
                                    "amount" => $r4->amount
                                );
                            }
                        }
                    }
                }
            }
        }

        return $output;
    }

    function getvendorbalancesheet($invoicelist){

        $CI =& get_instance();
        $output = array();
        if(isset($invoicelist) && !empty($invoicelist)){
            foreach ($invoicelist as $invoice_row) {
                $bank_payment = $CI->db->query("SELECT `pop`.`id`, `bpd`.`method`,`pop`.* FROM `tblpurchaseorderpayments` as pop LEFT JOIN `tblbankpaymentdetails` as bpd ON bpd.`pay_type_id` = pop.`id` AND bpd.`pay_type`='po_payment'  LEFT JOIN `tblbankpayment` as bp ON bp.`id` = bpd.`main_id` WHERE `pop`.`po_id` = '".$invoice_row->po_id."' AND `bp`.`status` = 1")->result();

                $output[] = array(
                                "id" => $invoice_row->id,
                                "date" => _d($invoice_row->date),
                                "number" => "Inv-".str_pad($invoice_row->id, 4, '0', STR_PAD_LEFT),
                                "type" => "Invoice",
                                "amount" => $invoice_row->totalamount
                            );
                if (!empty($bank_payment)){
                    foreach ($bank_payment as $payment) {
                        $output[] = array(
                                    "id" => $payment->id,
                                    "date" => _d($invoice_row->date),
                                    "number" => "Inv-".str_pad($invoice_row->id, 4, '0', STR_PAD_LEFT),
                                    "type" => "Invoice Payments",
                                    "amount" => $payment->amount
                                );
                    }
                }

                $debitnoteinfo = $CI->db->query("SELECT `pdn`.* FROM `tblpurchasedabitnote` as pdn LEFT JOIN `tblpurchasechallanreturn` as pcr ON `pcr`.id = `pdn`.parchasechallanreturn_id WHERE `pcr`.`po_id` = '".$invoice_row->po_id."' ")->result();
                if (!empty($debitnoteinfo)){
                    foreach ($debitnoteinfo as $dvalue) {
                        $output[] = array(
                                    "id" => $dvalue->id,
                                    "date" => _d($dvalue->date),
                                    "number" => "PDN-".str_pad($dvalue->id, 4, '0', STR_PAD_LEFT),
                                    "type" => "DN Payment",
                                    "amount" => $dvalue->totalamount
                                );
                    }
                }
            }
        }
        return $output;
    }


    function asc_date_compare($a, $b)
    {
        $t1 = strtotime($a['date']);
        $t2 = strtotime($b['date']);
        return $t1 - $t2;
    }
    function desc_date_compare($a, $b)
    {
        $t1 = strtotime($a['date']);
        $t2 = strtotime($b['date']);
        return $t2 - $t1;
    }

    /* this function use for get junior staffs */
    function get_junior_staff($staff_id){
        $CI =& get_instance();

        $output = "";
        $staff_info = $CI->db->query("SELECT `branch_id`,`admin`,`bm_branch_id` FROM `tblstaff` WHERE staffid=".$staff_id." AND active = 1 ")->row();
        if(!empty($staff_info)){
            switch ($staff_info) {
                case $staff_info->admin == 1:
                    $branch_ids = explode(",",$staff_info->branch_id);
                    foreach ($branch_ids as $k => $b_id) {

                        $where = "active = 1 and FIND_IN_SET('".$b_id."', branch_id)";
                        $staffs = $CI->db->query("SELECT GROUP_CONCAT(staffid) as staff_ids FROM `tblstaff` WHERE " . $where . " ")->row();
                        if (!empty($staffs) && !empty($staffs->staff_ids)){
                            $output .= ($k > 0) ? ",".$staffs->staff_ids: $staffs->staff_ids ;
                        }
                    }
                    break;

                case $staff_info->admin != 1:

                    if ($staff_info->bm_branch_id != 0){
                        $branch_ids = explode(",",$staff_info->bm_branch_id);
                        foreach ($branch_ids as $k => $b_id) {
                            $where = "active = 1 AND staffid !=".$staff_id." AND FIND_IN_SET('".$b_id."', branch_id)";
                            $staffs = $CI->db->query("SELECT GROUP_CONCAT(staffid) as staff_ids FROM `tblstaff` WHERE " . $where . " ")->row();
                            if (!empty($staffs) && !empty($staffs->staff_ids)){
                                $output .= ($k > 0) ? ",".$staffs->staff_ids: $staffs->staff_ids ;
                            }
                        }
                    }else{
                        $branch_ids = explode(",",$staff_info->branch_id);
                        foreach ($branch_ids as $k => $b_id) {
                            $where = "active = 1 AND superior_id =".$staff_id." AND staffid !=".$staff_id." AND FIND_IN_SET('".$b_id."', branch_id)";
                            $staffs = $CI->db->query("SELECT GROUP_CONCAT(staffid) as staff_ids FROM `tblstaff` WHERE " . $where . " ")->row();
                            if (!empty($staffs) && !empty($staffs->staff_ids)){
                                $output .= ($k > 0) ? ",".$staffs->staff_ids: $staffs->staff_ids ;
                            }
                        }
                    }
                    break;
            }
        }
        return $output;
    }

    function get_lead_call_count($lead_id){
        $CI =& get_instance();
        $number_list = $CI->db->query("SELECT c.phonenumber from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$lead_id."' ")->result();

        $numbers = '';
    	if(!empty($number_list)){
            foreach ($number_list as $k => $no) {
                $numbers .= ($k == 0) ? $no->phonenumber : ','.$no->phonenumber;
            }
    	}

        $response = array("ttl_calls" => 0, "ttlattend_calls" => 0, "ttlmissed_calls" => 0, "ttlactivity" => 0);
        if(!empty($numbers)){
            $ttlattend_calls = $CI->db->query("SELECT COUNT(`id`) as ttlcalls FROM tblcalloutgoing WHERE customer_number IN (".$numbers.") AND recording_url != '' ORDER BY id DESC")->row();
            $ttlmissed_calls = $CI->db->query("SELECT COUNT(`id`) as ttlcalls FROM tblcalloutgoing WHERE customer_number IN (".$numbers.") AND recording_url = '' ORDER BY id DESC")->row();
            $ttl_activity = $CI->db->query("SELECT COUNT(`id`) as num FROM `tblfollowupleadactivity` WHERE lead_id = '".$lead_id."' ORDER BY id DESC")->row();
            $ttl_calls = $ttlattend_calls->ttlcalls + $ttlmissed_calls->ttlcalls;
            $response["ttl_calls"] = $ttl_calls;
            $response["ttlattend_calls"] = $ttlattend_calls->ttlcalls;
            $response["ttlmissed_calls"] = $ttlmissed_calls->ttlcalls;
            $response["ttlactivity"] = $ttl_activity->num;
        }
        return $response;
    }

    /**
    * use this method to encode anystring and this encrypted string will not decrypt from
    * online tool or any common method.
    *
    * @param type $str
    * @return type
    */
    function ci_enc($str) {
      $one = serialize($str);
      $two = @gzcompress($one, 9);
      $three = addslashes($two);
      $four = base64_encode($three);
      $five = strtr($four, '+/=', '-_.');
      return $five;
    }

    /**
     * Use this method to decript the encrypted string done by ci_enc function if the
     * string is not in correct format then this will not decript and return z1 response.
     *
     * @param type $str
     * @return string
     */
    function ci_dec($str) {
        $one = strtr($str, '-_.', '+/=');
        $two = base64_decode($one);
        $three = stripslashes($two);
        $four = @gzuncompress($three);
        if ($four == '') {
            return "z1"; //Please use the correct code / data string which you get.
        } else {
            $five = unserialize($four);
            return $five;
        }
    }

    function customer_satisfaction($question_id = 0){

        $response = array(
                1 => "Are you satisfied with our product ?",
                2 => "Do you receive delivery on time ?",
                3 => "How often do you find error in billing documents ?",
                4 => "Are you satisfied with reply to your enquirers ?",
                5 => "Do we fulfill your document & records requirement ?",
                6 => "Are you satisfied with our efforts on new product development for your company ?",
                7 => "Are you satisfied with our response on complaints reported by you ?",
                8 => "Are you satisfied with our support & communication ?",
            );
        $output = "--";
        if (array_key_exists($question_id, $response)){
            $output = $response[$question_id];
        }
        return $output;
    }


    function get_challan_freight_charges($challan_id){
    	$CI =& get_instance();
    	$product_info = $CI->db->query("SELECT p.* from tblitems_in as p LEFT JOIN tblinvoices as i ON p.rel_id = i.id where p.rel_type = 'invoice' and p.pro_id = '865' and i.challan_id = '".$challan_id."'  ")->row();

    	$freight_charges = '0.00';
    	if(!empty($product_info)){
    		 $price = ($product_info->rate * $product_info->qty);
    		 $dis_price = ($price*$product_info->discount/100);
    		 $final_price = ($price - $dis_price);
    		 $tax_amt = ($final_price*$product_info->prodtax/100);
       		 $freight_charges = ($final_price+$tax_amt);
       		 settype($freight_charges,'string');
    	}
    	return $freight_charges;

    }
    function get_outstanding_amount($staff_id){
        $CI =& get_instance();
        $amount = 0;
        $getlog = $CI->db->query("SELECT SUM(`net_salary`) as amt FROM `tblsalarypaidlog` WHERE `staff_id` = '".$staff_id."' AND `status` = '1' AND `is_outstanding` = '1' ")->row();
        if (!empty($getlog)){
            $amount = abs($getlog->amt);
        }
        return number_format($amount, 2, '.', '');
    }

    function getInvoiceOpening($type, $month, $year){
        $CI =& get_instance();
        if ($type == "count"){
          $response = $CI->db->query("SELECT COUNT(*) as ttl_row FROM `tblinvoices` WHERE status != 5 and parent_id=0 and service_type=1 and rental_status NOT IN (1,3) and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year."")->row()->ttl_row;
        }else{
          $response = $CI->db->query("SELECT COALESCE(SUM(total),0) as ttl_row FROM `tblinvoices` WHERE status != 5 and parent_id=0 and rental_status NOT IN (1,3) and service_type=1 and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year."")->row()->ttl_row;
        }
        return $response;
    }

    function getInvoiceClosing($type, $month, $year){
        $CI =& get_instance();
        if ($type == "count"){
          $response = $CI->db->query("SELECT COUNT(*) as ttl_row FROM `tblinvoices` WHERE service_type=1 and status != 5 and rental_status IN (1,3) and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year."")->row()->ttl_row;
        }else{
          $response = $CI->db->query("SELECT COALESCE(SUM(total),0) as ttl_row FROM `tblinvoices` WHERE status != 5 and rental_status IN (1,3) and service_type=1 and MONTH(invoice_date) = ".$month." and YEAR(invoice_date) = ".$year."")->row()->ttl_row;
        }
        return $response;
    }


	function checkMenuPermission($user_id,$type){
        $CI =& get_instance();
		if($type == 'production'){
			$designation_id = [2,3,8,18,34,49,11,13,14,20,21,22,29,30,54,55,5,19,45];
		}elseif($type == 'on_behalf'){
			$designation_id = [28,18,42,27,9];
		}elseif($type == 'edit_production'){
			$designation_id = [2,3,8,18,34,49];
		}
		$userDesignationId = get_staff_info($user_id)->designation_id;

		if(in_array($userDesignationId,$designation_id)){
			return '1';
		}else{
			return '0';
		}

	}
	/**
	 * Generate an array of string dates between 2 dates
	 *
	 * @param string $start Start date
	 * @param string $end End date
	 * @param string $format Output format (Default: Y-m-d)
	 *
	 * @return array
	 */
	function getDatesFromRange($start, $end, $format = 'Y-m-d') {
		$array = array();
		$interval = new DateInterval('P1D');

		$realEnd = new DateTime($end);
		$realEnd->add($interval);

		$period = new DatePeriod(new DateTime($start), $interval, $realEnd);

		foreach($period as $date) { 
			$array[] = $date->format($format); 
		}

		return $array;
	}


	if(!function_exists('getMonthsInRange'))
	{
		function getMonthsInRange($date1, $date2)
		{
		    $start    = (new DateTime($date1))->modify('first day of this month');
			$end      = (new DateTime($date2))->modify('first day of next month');
			$interval = DateInterval::createFromDateString('1 month');
			$period   = new DatePeriod($start, $interval, $end);

			$month_arr = array();
			foreach ($period as $dt) {
			    $month_arr[] = $dt->format("m");
			}
			return $month_arr;
		}
	}

	/* notification get count of pending module */
	if(!function_exists('getModulePendingCount'))
	{
		function getModulePendingCount($module_id, $staff_id=''){
			$CI =& get_instance();
			$user_id = ($staff_id != '') ? $staff_id : get_staff_user_id();
			return $CI->db->query("SELECT COUNT(*) as ttlcount FROM tblmasterapproval WHERE module_id ='".$module_id."' AND staff_id='".$user_id."' AND `status`='0' AND `approve_status`='0' ")->row()->ttlcount;
		}
	}

	if(!function_exists('get_approve_status'))
	{
		function get_approve_status($status)
		{
			$status_name = '--';
			if($status == '0'){
				$status_name = '<span class="btn-sm btn-warning">Pending</span>';
			}elseif($status == '1'){
				$status_name = '<span class="btn-sm btn-success">Approved</span>';
			}elseif($status == '2'){
				$status_name = '<span class="btn-sm btn-danger">Rejected</span>';
			}elseif($status == '3'){
				$status_name = '<span class="btn-sm btn-danger">Cancelled</span>';
			}elseif($status == '4'){
				$status_name = '<span class="btn-sm btn-danger" style="background-color: #800000;">Recalculation</span>';
			}elseif($status == '5'){
				$status_name = '<span class="btn-sm btn-warning" style="background-color: #e8bb0b;">On Hold</span>';
			}

			return $status_name;
		}
	}

	if(!function_exists('count_working_days')){
		function count_working_days($fromdate, $todate){
		
			$start = new DateTime($fromdate);
			$end = new DateTime($todate);
			
			// otherwise the  end date is excluded (bug?)
			$end->modify('+1 day');
	
			$interval = $end->diff($start);
	
			// total days
			$days = $interval->days;
	
			// create an iterateable period of date (P1D equates to 1 day)
			$period = new DatePeriod($start, new DateInterval('P1D'), $end);
			
			foreach($period as $dt) {
				$curr = $dt->format('D');
			
				// substract if day have Sunday
				if ($curr == 'Sun') {
					$days--;
				}else{
					$tdate = $dt->format('Y-m-d');

					// substract if days have holiday
					if (is_holiday($tdate)){
						$days--;
					}
				}
			}
			return $days; // 4
		}
	}

	if (!function_exists('is_holiday')){
		function is_holiday($date){
			$CI =& get_instance();
			$check_holiday = $CI->db->query("SELECT * FROM `tblholidays` WHERE `date` = '".$date."' ")->row();
			if (!empty($check_holiday)){
				return TRUE;
			}
			return FALSE;
		}
	}
	function desc_id_compare($a, $b)
    {
        $t1 = $a->id;
        $t2 = $b->id;
        return $t2 - $t1;
    }
	
