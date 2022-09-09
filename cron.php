<?php
date_default_timezone_set('Asia/Kolkata');
function dbcon()
{
	$servername='localhost';     // Your MySql Server Name or IP address here
	$dbusername='crm_user';                // Login user id here
	$dbpassword='0iXc58m4kO';                // Login password here
	$dbname='crm';     // Your database name here
	$con = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);	
	return $con;
}

$base_url = "https://schachengineers.com/schacrm_test/";


// Sending reminder notification

	$sql_1 = "SELECT * FROM tblreminder WHERE status = 1 and  completed = 0 and reminder_date <= '".date('Y-m-d H:i:s')."' ";	
	
	$qry = mysqli_query(dbcon(),$sql_1);
	$numrows = mysqli_num_rows($qry);

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($qry)){
			//Deleteing last notification
			$sql_2 = "DELETE FROM tblnotifications WHERE module_id = 5 and  table_id = '".$row['id']."' ";
	
			$qry_2 = mysqli_query(dbcon(),$sql_2);

			//Inserting new notification    

            if($row['reminder_for'] == 1){
                $reminder_for = 'Payment Followup';
            }elseif($row['reminder_for'] == 2){
                $reminder_for = 'Lead Followup';
            }elseif($row['reminder_for'] == 3){
                $reminder_for = 'Task';
            }

            $description = "You have Reminder for ".$reminder_for;
            $link = 'reminder/details/'.$row['id'];


             $insert = "INSERT into `tblnotifications` set `isread` = 0, `isread_inline` = 0, `date` = '".date('Y-m-d H:i:s')."', `description` = '".$description."', `fromuserid` = '".$row['staff_id']."', `touserid` = '".$row['staff_id']."', `from_fullname` = 'Reminder', `link` = '".$link."', `module_id` = 5, `table_id` = '".$row['id']."'  ";

            $qry_3 = mysqli_query(dbcon(),$insert);

		
		}
	}

// Request Mark as Received by system
	$last_date = date('Y-m-d H:i:s', strtotime("-48 hours"));

	$req_sql = "SELECT r.id,r.category, r.tenure, r.approved_amount, r.addedfrom,  ra.updated_at from tblrequests as r LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where r.approved_status = 1 and ra.approve_status = 1 and r.confirmed_by_user = 0 and r.pettycash_id = 0 and r.category IN (1,2,4,3) and ra.updated_at < '".$last_date."'  ";	
	
	$req_qry = mysqli_query(dbcon(),$req_sql);
	$numrows = mysqli_num_rows($req_qry);

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($req_qry)){
			$update_request = "UPDATE `tblrequests` set `confirmed_by_user` = 1, `receive_status` = 1, `confirmed_date` = '".date('Y-m-d H:i:s')."', `user_confirmation_remark` = 'Received by System', `confirmation_payment_mode` = '4' where id = '".$row['id']."' ";

			mysqli_query(dbcon(),$update_request);

			if($row['category'] == 3){

				$tenure_sql = "SELECT  * FROM tblloantenues where id = '".$row['tenure']."'  ";	
				$tenure_qry = mysqli_query(dbcon(),$tenure_sql);
				$tenure_numrows = mysqli_num_rows($tenure_qry);

				$exist_log_sql = "SELECT  * FROM tblstaffloanlog where request_id = '".$row['id']."'  ";	
				$exist_log_qry = mysqli_query(dbcon(),$exist_log_sql);
				$exist_log_numrows = mysqli_num_rows($exist_log_qry);

				if($tenure_numrows > 0 and $exist_log_numrows == 0){
					$tenure_info = mysqli_fetch_assoc($tenure_qry);
					$part_amount = ($row['approved_amount']/$tenure_info['installment']);
					for($i=1; $i <= $tenure_info['installment']; $i++){
						$insert = "INSERT into `tblstaffloanlog` set `request_id` = '".$row['id']."', `staff_id` = '".$row['addedfrom']."', `amount` = '".$part_amount."', `instalment` = '".$i."'  ";
				         mysqli_query(dbcon(),$insert);
					}
				}

			}

            
		}

	}




	//Request Approved my pettycash 
	$req_byPettycash_sql = "SELECT r.id,r.category, r.tenure, r.approved_amount, r.addedfrom, ra.updated_at from tblrequests as r LEFT JOIN tblrequestapproval as ra ON r.id = ra.request_id where r.approved_status = 1 and ra.approve_status = 1 and r.confirmed_by_user = 0 and r.pettycash_id > 0 and r.manager_approved_status = 1 and r.category IN (1,2,4,3) and ra.updated_at < '".$last_date."'  ";	
	
	$req_qry_1 = mysqli_query(dbcon(),$req_byPettycash_sql);
	$numrows_1 = mysqli_num_rows($req_qry_1);

	if($numrows_1 > 0){
		while($row_1 = mysqli_fetch_assoc($req_qry_1)){
			$update_request = "UPDATE `tblrequests` set `confirmed_by_user` = 1, `receive_status` = 1, `confirmed_date` = '".date('Y-m-d H:i:s')."', `user_confirmation_remark` = 'Received by System', `confirmation_payment_mode` = '4' where id = '".$row_1['id']."' ";

            mysqli_query(dbcon(),$update_request);

            if($row['category'] == 3){

				$tenure_sql = "SELECT  * FROM tblloantenues where id = '".$row['tenure']."'  ";	
				$tenure_qry = mysqli_query(dbcon(),$tenure_sql);
				$tenure_numrows = mysqli_num_rows($tenure_qry);

				$exist_log_sql = "SELECT  * FROM tblstaffloanlog where request_id = '".$row['id']."'  ";	
				$exist_log_qry = mysqli_query(dbcon(),$exist_log_sql);
				$exist_log_numrows = mysqli_num_rows($exist_log_qry);

				if($tenure_numrows > 0 and $exist_log_numrows == 0){
					$tenure_info = mysqli_fetch_assoc($tenure_qry);
					$part_amount = ($row['approved_amount']/$tenure_info['installment']);
					for($i=1; $i <= $tenure_info['installment']; $i++){
						$insert = "INSERT into `tblstaffloanlog` set `request_id` = '".$row['id']."', `staff_id` = '".$row['addedfrom']."', `amount` = '".$part_amount."', `instalment` = '".$i."'  ";
				         mysqli_query(dbcon(),$insert);
					}
				}

			}
		}

	}

	// "SELECT r.*, ra.updated_at from tblpettycashrequest as r LEFT JOIN tblpettycashrequestapproval as ra ON r.id = ra.pettycash_id where r.approved_status = 1 and ra.approve_status = 1 and r.confirmed_by_user = 0  and ra.updated_at < '".$last_date."' "	

?>