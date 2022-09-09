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
//$biobax_data = file_get_contents('https://nturm.com/api/biomax_api.php'); 
$biobax_data = file_get_contents('http://www.nturm.in/api/biomax_api.php'); 

$output = json_decode($biobax_data);

if($output->status == true){
	if(!empty($output->data)){
		foreach ($output->data as  $value) {
			
			//the user id of 5000 which are not in crm 
			if($value->user_id < 5000){
				$user_id = $value->user_id;
				$user_name = $value->user_name;
				$date = $value->date;
				$log_date_time = $value->log_date_time;

				$insert = "INSERT into `tblbiomax_log` set  `user_id` = '".$user_id."', `user_name` = '".$user_name."', `log_date_time` = '".$log_date_time."', `date` = '".$date."' ";
	            $qry_3 = mysqli_query(dbcon(),$insert);
			}


			
		}
	}
}






?>