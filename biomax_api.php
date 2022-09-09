<?php
date_default_timezone_set('Asia/Kolkata');
function dbcon()
{
	$servername='localhost';     // Your MySql Server Name or IP address here
	$dbusername='biomaxuser';                // Login user id here
	$dbpassword='NvP^WKM!IdOU';                // Login password here
	$dbname='biomax_db';     // Your database name here
	$con = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);	
	return $con;
}

// $base_url = "https://schachengineers.com/schacrm_test/";


	$return_arr = array();

	$sql_1 = "SELECT * FROM emp_att WHERE status = 0 ";	
	
	$qry = mysqli_query(dbcon(),$sql_1);
	$numrows = mysqli_num_rows($qry);

	if($numrows > 0){
		while($row = mysqli_fetch_assoc($qry)){
	
			$data[] = array(
				'id' => $row['id'],
				'user_id' => $row['user_id'],
				'user_name' => $row['user_name'],
				'date' => $row['date'],
				'log_date_time' => $row['log_date_time'],
			);
            
            $update = "UPDATE `emp_att` set `status` = 1 where id = '".$row['id']."' ";
            mysqli_query(dbcon(),$update);

		
		}
		$return_arr['status'] = true;
        $return_arr['message'] = "Successfully";
        $return_arr['data'] = $data;		
	}else{
		$return_arr['status'] = false;
        $return_arr['message'] = "No Record Found!";
        $return_arr['data'] = [];	
	}	

	header('Content-type: application/json');
	echo json_encode($return_arr);

?>