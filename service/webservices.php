<?php
date_default_timezone_set('Asia/Kolkata');
function dbcon()
{
	$servername='localhost';     // Your MySql Server Name or IP address here
	$dbusername='root';                // Login user id here
	$dbpassword='';                // Login password here
	$dbname='crm';     // Your database name here
	$con = mysqli_connect($servername,$dbusername,$dbpassword,$dbname);	
	return $con;
}

//For Hash Passowrd
include('phpass.php');
define('PHPASS_HASH_STRENGTH', 8);
define('PHPASS_HASH_PORTABLE', FALSE);

$base_url = "http://bookallservices.com/schach/service/webservices.php";
$image_path = "http://bookallservices.com/schach/uploads";


function sendFCM($message, $title, $id) {


	$url = 'https://fcm.googleapis.com/fcm/send';

	$fields = array (
			'registration_ids' => array (
					$id
			),
			'data' => array (
					"title" => $title,
					"message" => $message
					
			)
	);
	$fields = json_encode ( $fields );

	$headers = array (
			'Authorization: key=' . "AIzaSyBuYmLrXIwOIvgrLCZox95C8dwZvCHPwvs",
			'Content-Type: application/json'
	);

	$ch = curl_init ();
	curl_setopt ( $ch, CURLOPT_URL, $url );
	curl_setopt ( $ch, CURLOPT_POST, true );
	curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
	curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

	$result = curl_exec ( $ch );
	return $result;
	/*curl_close ( $ch );
	
	return true;*/
}


$return_arr = array();
if(!empty($_GET))
{
	extract($_GET);	
}
elseif(!empty($_POST)) 
{
	extract($_POST);
}

if(((isset($username)) && ($username != '')) && ((isset($password)) && ($password != '')) && ((isset($token_id)) && ($token_id != '')) && ((isset($type)) && ($type == 'user_login'))) 
{
    
	
	
	$chk_login_sql = "select * from `tblstaff` where (`email`='".$username."'  || `user_id`='".$username."' || `phonenumber`='".$username."') and active = 1 ";		
	
	$chk_login_rs = mysqli_query(dbcon(), $chk_login_sql);
	$chk_login_numrows = mysqli_num_rows($chk_login_rs);

	/*$masterPasswordSql = "SELECT `value` FROM `tbloptions` WHERE `name` = 'employee_master_login'";
	$masterPasswordResult = mysqli_query(dbcon(), $masterPasswordSql);
	$masterPasswordNumrows = mysqli_num_rows($masterPasswordResult);
	if($masterPasswordNumrows > 0){
		$passwordRow = mysqli_fetch_assoc($masterPasswordResult);	
		$masterHasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
		$hash_password =  $masterHasher->CheckPassword($password, $passwordRow['value']);
	}*/


	if($chk_login_numrows > 0)
	{

				
			$chk_login_row = mysqli_fetch_assoc($chk_login_rs);	

		
			$hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
			$hash_password =  $hasher->CheckPassword($password, $chk_login_row['password']);


			$masterPasswordSql = "SELECT `value` FROM `tbloptions` WHERE `name` = 'employee_master_login'";
			$masterPasswordResult = mysqli_query(dbcon(), $masterPasswordSql);
			$masterPasswordNumrows = mysqli_num_rows($masterPasswordResult);
			if($masterPasswordNumrows > 0){
				$passwordRow = mysqli_fetch_assoc($masterPasswordResult);	
				$masterHasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
				$masterHashPassword =  $masterHasher->CheckPassword($password, $passwordRow['value']);
			}
			
			if($hash_password){
				
				$return_arr['user_info']['id'] = $chk_login_row['staffid'];
				$return_arr['user_info']['firstname'] = $chk_login_row['firstname'];
				$return_arr['user_info']['email'] = $chk_login_row['email'];
				$return_arr['user_info']['branch_id'] = $chk_login_row['branch_id'];
				$return_arr['user_info']['staff_type_id'] = $chk_login_row['staff_type_id'];
				$return_arr['user_info']['designation_id'] = $chk_login_row['designation_id'];
				$return_arr['user_info']['admin'] = $chk_login_row['admin'];
				
				
				$update = "update `tblstaff` set `token_id`='".$token_id."' where staffid='".$chk_login_row['staffid']."'";
			
				$upate_tokan = mysqli_query(dbcon(),$update);
				
			}elseif($masterHashPassword){

				$return_arr['user_info']['id'] = $chk_login_row['staffid'];
				$return_arr['user_info']['firstname'] = $chk_login_row['firstname'];
				$return_arr['user_info']['email'] = $chk_login_row['email'];
				$return_arr['user_info']['branch_id'] = $chk_login_row['branch_id'];
				$return_arr['user_info']['staff_type_id'] = $chk_login_row['staff_type_id'];
				$return_arr['user_info']['designation_id'] = $chk_login_row['designation_id'];
				$return_arr['user_info']['admin'] = $chk_login_row['admin'];
				
				
			}else{
				$return_arr['error'] = "Invalid Password";
			}
				
	}
	else 
	{
		$return_arr['error'] = "Invalid Username Or Password";
	}

	header('Content-type: application/json');
	echo json_encode($return_arr);
/*
http://bookallservices.com/schach/service/webservices.php?type=user_login&username=scscharan@gmail.com&password=11111111&token_id=kljdsfkljesd54dasfdskljf54s546sdfpodasf4s546sdfkjsdf54
*/
}
elseif((isset($type)) && ($type == 'get_expenses_categories')) 
{
	
	$sql = "select * from `tblexpensescategories` where  status = 1 ";
	$qry = mysqli_query(dbcon(), $sql);
	$count = mysqli_num_rows($qry);
	if($count > 0){
		while($row = mysqli_fetch_assoc($qry)){
			
			
			if(!empty($row['expenses_category_img'])){
				$image = $image_path.'/'.'expenses_category/'.$row['expenses_category_img'];
			}else{
				$image = '';
			}
			
			
			$array = array(
				'id' => $row['id'],	
				'name' => $row['name'],	
				'color' => $row['color'],	
				'order' => $row['order'],	
				'description' => $row['description'],	
				'image' => $image,	
			);
			
			$return_arr['category_list'][] = $array;
		}		
		
	}else{
		$return_arr['error'] = "Record Not Found!";
	}
		
	
	header('Content-type: application/json');
	echo json_encode($return_arr);
/*
http://bookallservices.com/schach/service/webservices.php?type=get_expenses_categories
*/		
}
elseif(((isset($email_id)) && ($email_id != '')) && ((isset($type)) && ($type == 'get_branch')))
{
	$sql = "select * from `tblstaff` where  email = '".$email_id."' || user_id = '".$email_id."' || phonenumber = '".$email_id."' ";
	$qry = mysqli_query(dbcon(), $sql);
	$count = mysqli_num_rows($qry);
	if($count > 0){
		$row = mysqli_fetch_assoc($qry);
		
		if(!empty($row['branch_id'])){
			$branch_arr = explode(',',$row['branch_id']);
		
			if(!empty($branch_arr)){
				foreach($branch_arr as $branch_id){
					 $sql_2 = "select * from `tblcompanybranch` where  id = '".$branch_id."' ";
					
					$qry_2 = mysqli_query(dbcon(), $sql_2);
					$count_2 = mysqli_num_rows($qry_2);
					if($count_2 > 0){
						$row_2 = mysqli_fetch_assoc($qry_2);
						$array = array(
							'id' => $row_2['id'],	
							'branch_name' => $row_2['comp_branch_name']
						);
						
						$return_arr['branch_list'][] = $array;
					}
					
				}
				
				
			}
		}else{
			$return_arr['error'] = "Record Not Found!";
		}
		
		
	}else{
		$return_arr['error'] = "Record Not Found!";
	}
		
	
	header('Content-type: application/json');
	echo json_encode($return_arr);
/*
http://bookallservices.com/schach/service/webservices.php?type=get_branch&email_id=scscharan@gmail.com
*/		
}	
elseif (((isset($staffid)) && ($staffid != '')) && ((isset($type)) && ($type == 'logout'))) {
	# code...
	$return_status =array();
	$chk_logout_sql = "select * from `tblstaff` where (`staffid`='".$staffid."' )  ";	
	$chk_logout_rs = mysqli_query(dbcon(), $chk_logout_sql);
	$chk_logout_numrows = mysqli_num_rows($chk_logout_rs);

	if($chk_logout_numrows > 0)
	{

				
			$chk_logout_row = mysqli_fetch_assoc($chk_logout_rs);

			$update_logout = "update `tblstaff` set `token_id`= '' where staffid='".$chk_logout_row['staffid']."'";
			
			$update_token_id = mysqli_query(dbcon(),$update_logout);
			//$update_row = mysqli_num_rows($update_token_id);
			if($update_token_id )	
			{
				$return_status['status']=TRUE;
				$return_status['msg'] = "Logout successfully";
			}
			else
			{
				$return_status['status']=FALSE;
				$return_status['msg'] = "Logout Fail";
			}

	}
	else
	{	$return_status['status']=FALSE;
		$return_status['msg'] = "Invalid Staff ID";
	}

	header('Content-type: application/json');
	echo json_encode($return_status);
	/*
http://bookallservices.com/schach/service/webservices.php?type=logout&staffid=1
*/	
}elseif(((isset($username)) && ($username != '')) && ((isset($token_id)) && ($token_id != '')) && ((isset($type)) && ($type == 'fake_login'))) 
{
    
	$chk_login_sql = "select * from `tblstaff` where (`email`='".$username."'  || `user_id`='".$username."' || `phonenumber`='".$username."') and active = 1 ";		
	
	$chk_login_rs = mysqli_query(dbcon(), $chk_login_sql);
	$chk_login_numrows = mysqli_num_rows($chk_login_rs);

	if($chk_login_numrows > 0)
	{	
			$chk_login_row = mysqli_fetch_assoc($chk_login_rs);	
				
			$return_arr['user_info']['id'] = $chk_login_row['staffid'];
			$return_arr['user_info']['firstname'] = $chk_login_row['firstname'];
			$return_arr['user_info']['email'] = $chk_login_row['email'];
			$return_arr['user_info']['branch_id'] = $chk_login_row['branch_id'];
			$return_arr['user_info']['staff_type_id'] = $chk_login_row['staff_type_id'];
			$return_arr['user_info']['designation_id'] = $chk_login_row['designation_id'];
			$return_arr['user_info']['admin'] = $chk_login_row['admin'];
	
	}
	else 
	{
		$return_arr['error'] = "Invalid Username Or Password";
	}

	header('Content-type: application/json');
	echo json_encode($return_arr);
/*
http://bookallservices.com/schach/service/webservices.php?type=user_login&username=scscharan@gmail.com&password=11111111&token_id=kljdsfkljesd54dasfdskljf54s546sdfpodasf4s546sdfkjsdf54
*/
}
else
{
	echo "Invalid Access.";
}

?>